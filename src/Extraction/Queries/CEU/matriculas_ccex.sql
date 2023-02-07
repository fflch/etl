SELECT
	m.codmtrcurceu AS 'codigoMatriculaCEU'
	,m.codcurceu AS 'codigoCursoCEU'
	,m.codedicurceu AS 'codigoEdicaoCurso'
	,m.numseqofeedi AS 'sequenciaOferecimento'
	,m.codpes AS 'numeroUSP'
	,m.dtainc AS 'dataMatricula'
	,m.stamtrcurceu AS 'statusMatricula'
	,m.dtainiprj AS 'dataInicioCurso'
	,m.dtafimprj AS 'dataFimCurso'
	,m.frqmtrcur AS 'frequenciaAluno'
	,m.rstmtrcur AS 'conceitoFinalAluno'
FROM dbo.MATRICULACURSOCEU m
	INNER JOIN EDICAOCURSOOFECEU e ON (m.codcurceu = e.codcurceu AND m.codedicurceu = e.codedicurceu AND m.numseqofeedi = e.numseqofeedi)
WHERE m.codund = 8
	AND YEAR(e.dtainiofeedi) >= 2007