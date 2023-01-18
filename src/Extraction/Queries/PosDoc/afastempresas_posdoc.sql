SELECT
	pve.anoprj AS 'anoProjeto'
	,pve.codprj AS 'codigoProjeto'
	,pve.numseq_pd AS 'sequenciaPeriodo'
	,pve.numseqvinepr AS 'seqVinculoEmpresa'
	,pve.nomrazsocepr AS 'nomeEmpresa'
	,pve.dtainiafaepr AS 'dataInicioAfastamento'
	,pve.dtafimafaepr AS 'dataFimAfastamento'
	,pve.tipvinepd_pd AS 'tipoVinculo'
FROM dbo.PDPROGRAMAVINCEMPRESA pve
	LEFT JOIN PDPROJETO prj ON pve.anoprj = prj.anoprj AND pve.codprj = prj.codprj 
WHERE YEAR(prj.dtainiprj) >= 2007