-- First, get filtered, basic data
SELECT
	ap.codpes AS 'numero_usp'
	,ap.numseqpgm AS 'seq_programa'
	,ap.codare AS 'codigo_area'
	,ap.dtaselpgm AS 'data_selecao'
	,ap.nivpgm AS 'nivel_programa'
	,ap.dtadpopgm AS 'data_deposito_trabalho'
	,ap.dtaaprbantrb AS 'data_aprovacao_trabalho'
INTO #filtered
FROM AGPROGRAMA ap
WHERE YEAR(ap.dtaselpgm) >= 2007
	AND ap.codare BETWEEN 8000 AND 9000
	AND ap.vinalupgm = 'REGULAR';


-- Join NOMEAREA, AREA, NOMECURSO to get specifications
SELECT
	f.*
    ,n.nomare AS 'nome_area'
	,a.codcur AS 'codigo_programa'
	,n2.nomcur AS 'nome_programa'
INTO #specs
FROM #filtered f
    LEFT JOIN NOMEAREA n
        ON f.codigo_area = n.codare
            AND f.data_selecao >= n.dtainiare 
            AND (n.dtafimare >= f.data_selecao OR n.dtafimare IS NULL)
    LEFT JOIN AREA a
        ON f.codigo_area = a.codare
    LEFT JOIN NOMECURSO n2
        ON a.codcur = n2.codcur
            AND f.data_selecao >= n2.dtainicur
            AND (n2.dtafimcur >= f.data_selecao OR n2.dtafimcur IS NULL);


-- Join HISTPROGRAMA to get first enrollment
SELECT
    s.*
    ,jn.dtaocopgm AS 'primeira_matricula'
INTO #primeira_matricula
FROM #specs s
    LEFT JOIN
            (SELECT 
                h2.codpes AS 'numero_usp'
                ,h2.numseqpgm AS 'seq_programa'
                ,h2.codare AS 'codigo_area'
                ,MIN(h2.dtaocopgm) AS 'dtaocopgm'
            FROM HISTPROGRAMA h2
            WHERE h2.tiphstpgm = 'MAR'
            GROUP BY h2.codpes, h2.numseqpgm, h2.codare) jn
                ON jn.numero_usp = s.numero_usp 
                    AND jn.seq_programa = s.seq_programa
                    AND jn.codigo_area = s.codigo_area;


-- Create an occurrences table, adding minutes according to occurrence
SELECT
	h3.codpes AS 'numero_usp'
	,h3.numseqpgm AS 'seq_programa'
	,h3.codare AS 'codigo_area'
	,h3.tiphstpgm AS 'tipo_ocorrencia'
	,CASE h3.tiphstpgm
		WHEN 'CON' THEN DATEADD(mi, 5, h3.dtaocopgm)
		WHEN 'TFA' THEN DATEADD(mi, 4, h3.dtaocopgm)
		WHEN 'DES' THEN DATEADD(mi, 3, h3.dtaocopgm)
		WHEN 'RTO' THEN DATEADD(mi, 2, h3.dtaocopgm)
		WHEN 'NMT' THEN DATEADD(mi, 1, h3.dtaocopgm)
		ELSE h3.dtaocopgm
		END AS 'data_ocorrencia'
INTO #ocorrencias
FROM HISTPROGRAMA h3
WHERE h3.codare BETWEEN 8000 AND 9000;


-- Get last occurrence from occurrences table
SELECT 
	o.numero_usp
	,o.seq_programa
	,o.codigo_area
	,o.tipo_ocorrencia AS 'tipo_ultima_ocorrencia'
	,o.data_ocorrencia AS 'data_ultima_ocorrencia'
INTO #ultima_ocorrencia
FROM #ocorrencias o
	INNER JOIN (
		SELECT
			o2.numero_usp
			,o2.seq_programa
			,o2.codigo_area
			,MAX(o2.data_ocorrencia) AS 'data_ultima_ocorrencia'
	  	FROM #ocorrencias o2
	  	GROUP BY o2.numero_usp, o2.seq_programa, o2.codigo_area
	) o2 ON o.numero_usp = o2.numero_usp 
			AND o.seq_programa = o2.seq_programa 
			AND o.codigo_area = o2.codigo_area 
			AND o.data_ocorrencia = o2.data_ultima_ocorrencia;


-- Join our main table to our last_occurrence table
SELECT
	p.numero_usp
	,p.seq_programa
	,p.codigo_area
	,p.nome_area
	,p.codigo_programa
	,p.nome_programa
	,p.data_selecao
	,p.primeira_matricula
	,u.tipo_ultima_ocorrencia
	,u.data_ultima_ocorrencia
	,p.nivel_programa
	,p.data_deposito_trabalho
	,p.data_aprovacao_trabalho
INTO #posgraduacoes
FROM #primeira_matricula p
	LEFT JOIN #ultima_ocorrencia u
		ON p.numero_usp = u.numero_usp
			AND p.seq_programa = u.seq_programa
			AND p.codigo_area = u.codigo_area;


-- Drop all unnecessary temp tables
DROP TABLE #filtered;
DROP TABLE #specs;
DROP TABLE #primeira_matricula;
DROP TABLE #ocorrencias;
DROP TABLE #ultima_ocorrencia;
