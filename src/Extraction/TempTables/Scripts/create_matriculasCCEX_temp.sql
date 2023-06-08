SELECT
	m.codmtrcurceu AS 'codigo_matricula_ceu'
	,m.codcurceu AS 'codigo_curso_ceu'
	,m.codedicurceu AS 'codigo_edicao_curso'
	,m.numseqofeedi AS 'sequencia_oferecimento'
	,m.codpes AS 'numero_usp'
	,m.dtainc AS 'data_matricula'
	,m.stamtrcurceu AS 'status_matricula'
	,m.dtainiprj AS 'data_inicio_curso'
	,m.dtafimprj AS 'data_fim_curso'
	,m.frqmtrcur AS 'frequencia_aluno'
	,m.rstmtrcur AS 'conceito_final_aluno'
INTO #matriculas_ccex
FROM dbo.MATRICULACURSOCEU m
	INNER JOIN EDICAOCURSOOFECEU e ON (m.codcurceu = e.codcurceu AND m.codedicurceu = e.codedicurceu AND m.numseqofeedi = e.numseqofeedi)
WHERE m.codund = 8
	AND YEAR(e.dtainiofeedi) >= 2007
ORDER BY m.codmtrcurceu;