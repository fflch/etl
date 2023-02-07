SELECT
	i.codcurceu AS 'codigoCursoCEU'
	,i.codedicurceu AS 'codigoEdicaoCurso'
	,i.numseqofeedi AS 'sequenciaOferecimento'
	,i.codpesceu AS 'numeroCEU'
	,i.dtainc AS 'dataInscricao'
	,i.stacndceu AS 'situacaoInscricao'
	,i.oriins AS 'origemInscricao'
FROM INSCRICAOCEU i
	INNER JOIN EDICAOCURSOOFECEU e ON (i.codcurceu = e.codcurceu AND i.codedicurceu = e.codedicurceu AND i.numseqofeedi = e.numseqofeedi) 
WHERE YEAR(e.dtainiofeedi) >= 2007