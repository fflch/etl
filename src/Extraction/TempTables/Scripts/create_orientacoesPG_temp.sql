-- Create a temp advisor table
SELECT *
INTO #orientadores
FROM R39PGMORIDOC rpg;

-- gambi: change data_inicio_orientacao dates so we don't have conflicts
UPDATE #orientadores
SET dtainiort = DATEADD(minute, 
                    CASE tiport
                        WHEN 'PGM' THEN 0
                        WHEN 'EXC' THEN 1
                        WHEN 'COO' THEN 2
                        WHEN 'ORI' THEN 3
                    ELSE 0
                    END,
                    dtainiort);


-- Create ultimoorientador temp table
SELECT
	o.codare
	,o.codpespgm
	,o.numseqpgm
	,MAX(o.dtainiort) AS 'ultimo_inicio_orientacao'
INTO #ultimoorientadorpg
FROM #orientadores o
WHERE o.tiport <> 'COO'
GROUP BY o.codare, o.codpespgm, o.numseqpgm;


-- Select columns and filter rows
SELECT
	o.codpes AS 'numero_usp_orientador'
	,o.codare AS 'codigo_area'
	,o.codpespgm AS 'numero_usp_aluno'
	,o.numseqpgm AS 'seq_programa'
	,o.dtainiort AS 'data_inicio_orientacao'
	,o.dtafimort AS 'data_fim_orientacao'
	,o.tiport AS 'tipo_orientacao'
	,CASE
		WHEN u.ultimo_inicio_orientacao IS NOT NULL
			THEN 'S'
		ELSE 'N'
		END AS 'ultimo_orientador'
	,o.staortepf AS 'orientacao_especifica'
	,CASE
		WHEN o.dtacvscdmdou IS NOT NULL THEN o.dtacvscdmdou
		WHEN o.dtacvscdmmdo IS NOT NULL THEN o.dtacvscdmmdo
		ELSE NULL
		END AS 'data_conversao_para_plena'
	,o.dtacvsmudniv AS 'data_conversao_para_especifica'
INTO #all_orientacoespg
FROM #orientadores o
    LEFT JOIN #ultimoorientadorpg u
        ON o.codpespgm = u.codpespgm 
            AND o.codare = u.codare
            AND o.numseqpgm = u.numseqpgm
            AND o.dtainiort = u.ultimo_inicio_orientacao
    -- Filter
    INNER JOIN AGPROGRAMA ap
        ON (
            o.codpespgm = ap.codpes 
            AND o.codare = ap.codare 
            AND o.numseqpgm = ap.numseqpgm
            AND ap.codare BETWEEN 8000 AND 8999
	        AND ap.vinalupgm <> 'ESPECIAL');


-- Now we can add sequencia_orientacao order
SELECT
	a1.*
	,COUNT(a2.data_inicio_orientacao) + 1 AS 'sequencia_orientacao'
INTO #ordered_orientacoespg
FROM #all_orientacoespg a1
LEFT JOIN #all_orientacoespg a2
	ON a1.numero_usp_aluno = a2.numero_usp_aluno 
		AND a1.codigo_area = a2.codigo_area 
        AND a1.seq_programa = a2.seq_programa 
		AND a1.data_inicio_orientacao > a2.data_inicio_orientacao
GROUP BY a1.numero_usp_aluno, a1.codigo_area, a1.seq_programa, a1.data_inicio_orientacao
ORDER BY a1.numero_usp_aluno, a1.codigo_area, a1.seq_programa, a1.data_inicio_orientacao;


-- Drop all tables that won't be needed
DROP TABLE #ultimoorientadorpg;
DROP TABLE #orientadores;
DROP TABLE #all_orientacoespg;