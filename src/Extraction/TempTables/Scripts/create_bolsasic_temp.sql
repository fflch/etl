-- Get bolsas PIBIC
SELECT
    i.anoprj AS 'ano_projeto'
    ,i.codprj AS 'codigo_projeto'
    ,CASE
        WHEN i.codctgedi = 1 THEN 'CNPQ - PIBIC'
        WHEN i.codctgedi = 2 THEN 'CNPQ - PIBIT'
    END AS 'nome_programa'
    ,i.codboledi AS 'bolsa_edital'
    ,i.dtainibol AS 'data_inicio_bolsa'
    ,i.dtafimbol AS 'data_fim_bolsa'
INTO #bolsas_pibic
FROM ICTPROJEDITALBOLSA i;


-- Get outras bolsas
SELECT
    i2.anoprj AS 'ano_projeto'
    ,i2.codprj AS 'codigo_projeto'
    ,p.nompgmfcm AS 'nome_programa'
    ,NULL AS 'bolsa_edital'
    ,i2.dtainifom AS 'data_inicio_bolsa'
    ,i2.dtafimfom AS 'data_fim_bolsa'
INTO #outras_bolsas
FROM ICTPROJFOMENTO i2
    LEFT JOIN PROPESQFOMENTO p ON i2.codpgmfcm = p.codpgmfcm
WHERE i2.codpgmfcm <> 889; -- 889 = 'Sem fomento'


-- Join all bolsas
SELECT *
INTO #all_bolsas
FROM (
    SELECT *
    FROM #bolsas_pibic
    UNION
    SELECT *
    FROM #outras_bolsas
) b;


-- gambi: Change data_inicio_bolsa dates so we don't have conflicts
UPDATE #all_bolsas
SET data_inicio_bolsa = DATEADD(minute, 
                                CASE WHEN nome_programa LIKE '%PIBI%' THEN 1
                                     WHEN nome_programa LIKE '%USP%' THEN 2
                                     WHEN nome_programa LIKE '%FAPESP%' THEN 3
                                END,
                                data_inicio_bolsa)
WHERE nome_programa LIKE '%PIBI%' OR nome_programa LIKE '%USP%' OR nome_programa LIKE '%FAPESP%';


-- Now we can add sequencia_bolsa order
SELECT
	a1.*
	,COUNT(a2.data_inicio_bolsa) + 1 AS 'sequencia_bolsa'
INTO #ordered_bolsas
FROM #all_bolsas a1
LEFT JOIN #all_bolsas a2
	ON a1.ano_projeto = a2.ano_projeto 
		AND a1.codigo_projeto = a2.codigo_projeto 
		AND a1.data_inicio_bolsa > a2.data_inicio_bolsa
GROUP BY a1.ano_projeto, a1.codigo_projeto, a1.data_inicio_bolsa
ORDER BY a1.ano_projeto, a1.codigo_projeto, a1.data_inicio_bolsa;


-- Filter
SELECT o.*
INTO #bolsas_ic
FROM #ordered_bolsas o
    INNER JOIN ICTPROJETO ip ON o.ano_projeto = ip.anoprj AND o.codigo_projeto = ip.codprj
    LEFT JOIN SETOR s ON ip.codsetprj = s.codset
WHERE ip.codpesalu IS NOT NULL
    AND ip.staprj NOT IN ('Incompleto', 'Denegado', 'Inscrito PIBI', 'Inscrito')
    AND s.codund = 8;

-- Drop all unnecessary temp tables
DROP TABLE #bolsas_pibic;
DROP TABLE #outras_bolsas;
DROP TABLE #all_bolsas;
DROP TABLE #ordered_bolsas;