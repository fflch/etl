SELECT
	i.codcurceu AS 'codigo_curso_ceu'
	,i.codedicurceu AS 'codigo_edicao_curso'
	,i.numseqofeedi AS 'sequencia_oferecimento'
	,i.codpesceu AS 'numero_ceu'
	,i.dtainc AS 'data_inscricao'
	,i.stacndceu AS 'situacao_inscricao'
	,i.oriins AS 'origem_inscricao'
FROM INSCRICAOCEU i
	INNER JOIN EDICAOCURSOOFECEU e ON (i.codcurceu = e.codcurceu AND i.codedicurceu = e.codedicurceu AND i.numseqofeedi = e.numseqofeedi) 
WHERE YEAR(e.dtainiofeedi) >= 2007
ORDER BY i.codcurceu, i.codedicurceu, i.numseqofeedi, i.codpesceu, i.dtainc