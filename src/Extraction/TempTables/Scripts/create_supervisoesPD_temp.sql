SELECT *
INTO #valid_dates_PDPROJETOSUPERVISOR
FROM PDPROJETOSUPERVISOR pps
WHERE pps.dtainispv < pps.dtafimspv


-- Create ultimosupervisor temp table
SELECT
	pps.anoprj
	,pps.codprj
	,pps.tipspv
	,MAX(pps.numseqspv) AS 'numseqspv'
INTO #ultimosupervisor
FROM #valid_dates_PDPROJETOSUPERVISOR pps
WHERE pps.tipspv LIKE 'Respons_vel'
GROUP BY pps.anoprj, pps.codprj, pps.tipspv;


-- Select columns and filter rows
SELECT 
	pps.anoprj AS 'ano_projeto'
	,pps.codprj AS 'codigo_projeto'
	,pps.tipspv AS 'tipo_supervisao'
	,pps.codpesspv AS 'numero_usp_supervisor'
	,pps.dtainispv AS 'data_inicio_supervisao'
	,pps.dtafimspv AS 'data_fim_supervisao'
	,CASE
		WHEN u.numseqspv IS NOT NULL
			THEN 'S'
		ELSE 'N'
		END AS 'ultimo_supervisor_resp'
INTO #all_supervisoespd
FROM #valid_dates_PDPROJETOSUPERVISOR pps
	LEFT JOIN PDPROJETO prj ON pps.anoprj = prj.anoprj AND pps.codprj = prj.codprj
	LEFT JOIN #ultimosupervisor u
        ON pps.anoprj = u.anoprj 
            AND pps.codprj = u.codprj
            AND pps.tipspv = u.tipspv
            AND pps.numseqspv = u.numseqspv
WHERE YEAR(prj.dtainiprj) >= 2007
    AND prj.codmdl = 2
    AND prj.staatlprj NOT IN ('Incompleto', 'Recusado');


-- gambi: Change data_inicio_supervisao dates so we don't have conflicts
UPDATE #all_supervisoespd
SET data_inicio_supervisao = DATEADD(minute, 
                                CASE WHEN tipo_supervisao LIKE 'Respons_vel' THEN 0
                                     WHEN tipo_supervisao LIKE 'Segundo' THEN 1
                                ELSE 0
                                END,
                                data_inicio_supervisao);


-- Now we can add sequencia_supervisao order
SELECT
	a1.*
	,COUNT(a2.data_inicio_supervisao) + 1 AS 'sequencia_supervisao'
INTO #ordered_supervisoespd
FROM #all_supervisoespd a1
LEFT JOIN #all_supervisoespd a2
	ON a1.ano_projeto = a2.ano_projeto 
		AND a1.codigo_projeto = a2.codigo_projeto 
		AND a1.data_inicio_supervisao > a2.data_inicio_supervisao
GROUP BY a1.ano_projeto, a1.codigo_projeto, a1.data_inicio_supervisao
ORDER BY a1.ano_projeto, a1.codigo_projeto, a1.data_inicio_supervisao;


-- Drop all tables that won't be needed
DROP TABLE #ultimosupervisor;
DROP TABLE #all_supervisoespd;
