-- Create ultimosupervisor temp table
SELECT
	pj.anoprj
	,pj.codprj
	,pj.tipspv
	,MAX(numseqspv) AS 'numseqspv'
INTO #ultimosupervisor
FROM PDPROJETOSUPERVISOR pj
WHERE pj.tipspv LIKE 'Respons_vel'
GROUP BY pj.anoprj, pj.codprj, pj.tipspv;


-- Select columns and filter rows
SELECT 
	pps.anoprj AS 'ano_projeto'
	,pps.codprj AS 'codigo_projeto'
	,pps.tipspv AS 'tipo_supervisao'
	,pps.codpesspv AS 'numero_usp_supervisor'
	,p.nompes AS 'nome_supervisor'
	,pps.dtainispv AS 'data_inicio_supervisao'
	,pps.dtafimspv AS 'data_fim_supervisao'
	,CASE
		WHEN u.numseqspv IS NOT NULL
			THEN 'S'
		ELSE 'N'
		END AS 'ultimo_supervisor_resp'
INTO #all_supervisoespd
FROM PDPROJETOSUPERVISOR pps
	LEFT JOIN PDPROJETO prj ON pps.anoprj = prj.anoprj AND pps.codprj = prj.codprj
	LEFT JOIN PESSOA p ON pps.codpesspv = p.codpes
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


-- Drop all unnecessary temp tables
DROP TABLE #ultimosupervisor;
DROP TABLE #all_supervisoespd;