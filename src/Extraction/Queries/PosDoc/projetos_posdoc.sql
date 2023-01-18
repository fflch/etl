SELECT
	pd.anoprj AS 'anoProjeto'
	,pd.codprj AS 'codigoProjeto'
	,pd.titprj AS 'tituloProjeto'
	,pd.dtainiprj AS 'dataInicioProjeto'
	,pd.dtafimprj AS 'dataFimProjeto'
	,pd.staatlprj AS 'situacaoProjeto'
	,pd.codpes_pd AS 'numeroUSP'
	,pd.codsetprj AS 'codigoDepartamento'
    ,s.nomset AS 'nomeDepartamento'
	,pd.codmdl AS 'codigoModalidade'
FROM PDPROJETO pd
    LEFT JOIN SETOR s ON pd.codsetprj = s.codset
WHERE pd.codund = 8
	AND YEAR(pd.dtainiprj) >= 2007