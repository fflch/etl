SELECT
	pd.anoprj AS 'anoProjeto'
	,pd.codprj AS 'codigoProjeto'
	,pd.codmdl AS 'codigoModalidade'
	,pd.codpes_pd AS 'numeroUSP'
	,pd.dtainiprj AS 'dataInicioProjeto'
	,pd.dtafimprj AS 'dataFimProjeto'
	,pd.staatlprj AS 'situacaoProjeto'
	,pd.codsetprj AS 'codigoDepartamento'
    ,s.nomset AS 'nomeDepartamento'
	,pd.titprj AS 'tituloProjeto'
	,pd.palcha1 AS 'palcha1'  
	,pd.palcha2 AS 'palcha2' 
	,pd.palcha3 AS 'palcha3'
FROM PDPROJETO pd
    LEFT JOIN SETOR s ON pd.codsetprj = s.codset
WHERE pd.codund = 8
	AND YEAR(pd.dtainiprj) >= 2007