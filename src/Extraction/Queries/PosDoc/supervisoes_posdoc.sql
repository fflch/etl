SELECT 
	pps.anoprj AS 'anoProjeto'
	,pps.codprj AS 'codigoProjeto'
	,pps.numseqspv AS 'sequenciaSupervisao'
	,pps.tipspv AS 'tipoSupervisao'
	,pps.codpesspv AS 'numeroUSPSupervisor'
	,pps.dtainispv AS 'dataInicioSupervisao'
	,pps.dtafimspv AS 'dataFimSupervisao'
FROM PDPROJETOSUPERVISOR pps
	LEFT JOIN PDPROJETO prj ON pps.anoprj = prj.anoprj AND pps.codprj = prj.codprj
WHERE YEAR(prj.dtainiprj) >= 2007
    AND prj.codmdl = 2
    AND prj.staatlprj NOT IN ('Incompleto', 'Recusado')
ORDER BY pps.anoprj, pps.codprj, pps.dtainispv, pps.tipspv