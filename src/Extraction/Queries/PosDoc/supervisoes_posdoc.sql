SELECT 
	pps.anoprj AS 'ano_projeto'
	,pps.codprj AS 'codigo_projeto'
	,pps.numseqspv AS 'sequencia_supervisao'
	,pps.tipspv AS 'tipo_supervisao'
	,pps.codpesspv AS 'numero_usp_supervisor'
	,p.nompes AS 'nome_supervisor'
	,pps.dtainispv AS 'data_inicio_supervisao'
	,pps.dtafimspv AS 'data_fim_supervisao'
	,CASE
		WHEN ultimoSupervisor.numseqspv IS NOT NULL
			THEN 'S'
		ELSE 'N'
		END AS 'ultimo_supervisor_resp'
FROM PDPROJETOSUPERVISOR pps
	LEFT JOIN PDPROJETO prj ON pps.anoprj = prj.anoprj AND pps.codprj = prj.codprj
	LEFT JOIN PESSOA p ON pps.codpesspv = p.codpes
	LEFT JOIN (
				SELECT
					pj.anoprj
					,pj.codprj
					,pj.tipspv
					,MAX(numseqspv) AS 'numseqspv'
				FROM PDPROJETOSUPERVISOR pj
				WHERE pj.tipspv LIKE 'Respons_vel'
				GROUP BY pj.anoprj, pj.codprj, pj.tipspv
				) ultimoSupervisor
					ON pps.anoprj = ultimoSupervisor.anoprj
						AND pps.codprj = ultimoSupervisor.codprj
						AND pps.tipspv = ultimoSupervisor.tipspv
						AND pps.numseqspv = ultimoSupervisor.numseqspv
WHERE YEAR(prj.dtainiprj) >= 2007
    AND prj.codmdl = 2
    AND prj.staatlprj NOT IN ('Incompleto', 'Recusado')
ORDER BY pps.anoprj, pps.codprj, pps.dtainispv, pps.tipspv