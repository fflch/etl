SELECT 
	pps.anoprj AS 'anoProjeto'
	,pps.codprj AS 'codigoProjeto'
	,pps.numseqspv AS 'sequenciaSupervisao'
	,pps.tipspv AS 'tipoSupervisao'
	,pps.codpesspv AS 'numeroUSPSupervisor'
	,p.nompes AS 'nomeSupervisor'
	,pps.dtainispv AS 'dataInicioSupervisao'
	,pps.dtafimspv AS 'dataFimSupervisao'
	,CASE
		WHEN ultimoSupervisor.numseqspv IS NOT NULL
			THEN 'S'
		ELSE 'N'
		END AS 'ultimoSupervisorResp'
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