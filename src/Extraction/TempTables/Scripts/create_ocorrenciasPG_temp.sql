-- Get every FFLCH graduate occurrence
SELECT
    h.*
    ,CAST(t.dschstpgm AS VARCHAR(96)) AS 'tipo_ocorrencia'
INTO
    #ocorrencias_pg
FROM 
    HISTPROGRAMA h
LEFT JOIN
    TABHISTPROG t 
        ON t.tiphstpgm = h.tiphstpgm
WHERE
    h.codare BETWEEN 8000 AND 8999;


-- Label this extension as a program extension to prevent confusion with the thesis defense deadline later
UPDATE
    #ocorrencias_pg
SET 
    tipo_ocorrencia = 'Prorrogação do Programa'
WHERE
    tipo_ocorrencia = 'Prorrogação';
   
  SELECT DISTINCT(tipo_ocorrencia) FROM #ocorrencias_pg


-- Differentiate occurrences whose requests were not accepted and therefore did not occur
UPDATE
    #ocorrencias_pg
SET 
    tipo_ocorrencia = ('Solicitação indeferida de ' + tipo_ocorrencia)
WHERE (
    staaprcpg = 'NF' 
    OR staaprcog = 'NF' 
    OR staaprccp = 'NF' 
    OR staaprcpgdst = 'NF' 
    OR staaprcogdst = 'NF'
);


-- Filter occurrences by type (excluding those that are not relevant)
SELECT 
    o.*
    ,t1.dscmotdlg
    ,t2.dscmottmt
INTO
    #filtered_ocorrencias_pg
FROM (
    SELECT *
    FROM #ocorrencias_pg o1
    WHERE o1.codare BETWEEN 8000 AND 9000
        AND o1.tiphstpgm IN ('DES', 'TFA', 'PRO', 'TRA')
    UNION ALL
    SELECT *
    FROM #ocorrencias_pg o2
    WHERE o2.tiphstpgm = 'MDN'
        AND o2.nivpgmant = 'ME'
        AND o2.nivpgmtrf IN ('DO', 'DD')
    ) o
LEFT JOIN
    TABMOTIVDESLIG t1 
        ON t1.codmotdlg = o.codmotdlg
LEFT JOIN
    TABMOTIVTRANCA t2 
        ON t2.codmottmt = o.codmottmt;


-- Consolidate program occurrences
SELECT
    f.codare AS 'codigo_area'
	,f.codpes AS 'numero_usp'
	,f.numseqpgm AS 'seq_programa'
	,f.dtaocopgm AS 'data_ocorrencia'
	,f.tipo_ocorrencia
    ,CASE
        WHEN f.dscmotdlg IS NOT NULL 
            THEN f.dscmotdlg
        WHEN f.dscmottmt IS NOT NULL
            THEN f.dscmottmt
        ELSE NULL
        END AS 'motivo_ocorrencia'
    ,f.przpgm AS 'prazo_afastamento'
    ,f.codaretrf AS 'codigo_area_destino'
    ,a.nomare AS 'nome_area_destino'
    ,CASE f.tiphstpgm
        WHEN 'TFA' THEN f.nivpgmtrf
        ELSE NULL END
        AS 'nivel_programa_destino'
    ,CAST(NULL AS SMALLINT) AS 'prorrogacao_def_solicitada_dias'
    ,CAST(NULL AS SMALLINT) AS 'prorrogacao_def_obtida_dias'
INTO
    #ocorrencias_regulares_pg
FROM 
    #filtered_ocorrencias_pg f
LEFT JOIN
    #areas a
        ON f.codaretrf = a.codare
        AND f.dtaocopgm BETWEEN a.dtainiare AND a.dtafimare
ORDER BY f.tipo_ocorrencia;


-- Consolidate thesis defenses occurrences (deadline extensions)
SELECT
    p.codare AS 'codigo_area'
	,p.codpes AS 'numero_usp'
	,p.numseqpgm AS 'seq_programa'
    ,p.dtasolpgc AS 'data_ocorrencia'
	,CASE
        WHEN p.staaprpgccpg = 'S' AND p.staaprpgccog = 'S'
        THEN 'Prorrogação do Prazo de Defesa'
        ELSE 'Solicitação indeferida de Prorrogação do Prazo de Defesa'
        END AS 'tipo_ocorrencia'
    ,CAST(NULL AS VARCHAR) AS 'motivo_ocorrencia'
    ,CAST(NULL AS SMALLINT) AS 'prazo_afastamento'
    ,NULL AS 'codigo_area_destino'
    ,CAST(NULL AS VARCHAR) AS 'nome_area_destino'
    ,CAST(NULL AS VARCHAR) AS 'nivel_programa_destino'
    ,p.qtddiapgcsol AS 'prorrogacao_def_solicitada_dias'
    ,p.qtddiapgc AS 'prorrogacao_def_obtida_dias'
        -- // ver quando prorrogacao é de fato obtida;
INTO
    #ocorrencias_defesas_pg
FROM
    PRORROGDEFESA p
WHERE
    p.codare BETWEEN 8000 AND 8999;


-- Union program and thesis defense occurrences
SELECT
    *
INTO
    #final_ocorrencias_pg
FROM (
    SELECT * FROM #ocorrencias_regulares_pg
    UNION
    SELECT * FROM #ocorrencias_defesas_pg
) o;


-- Drop all tables that won't be needed
DROP TABLE #ocorrencias_pg;
DROP TABLE #filtered_ocorrencias_pg;
DROP TABLE #ocorrencias_regulares_pg;
DROP TABLE #ocorrencias_defesas_pg;