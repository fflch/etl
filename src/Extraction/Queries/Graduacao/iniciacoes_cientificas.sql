SELECT
	i.anoprj AS 'anoProjeto'
	,i.codprj AS 'codigoProjeto'
    ,i.codsetprj AS 'codigoDepartamento'
	,s.nomset AS 'nomeDepartamento'
	,i.dtainiprj AS 'dataInicioProjeto'
	,i.dtafimprj AS 'dataFimProjeto'
	,i.staprj AS 'statusProjeto'
	,i.codpesalu AS 'numeroUSP'
	,i.codpesrsp AS 'numeroUSPorientador'
	,i.titprj AS 'tituloProjeto'
    ,i.palcha AS 'palavrasChave'
FROM ICTPROJETO i
	LEFT JOIN SETOR s ON i.codsetprj = s.codset
WHERE i.codpesalu IS NOT NULL
	AND s.codund = 8
	AND i.staprj <> 'Incompleto'
ORDER BY i.anoprj, i.codprj