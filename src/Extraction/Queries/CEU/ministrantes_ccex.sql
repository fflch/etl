SELECT
	m.codpes AS 'numero_usp'
	,o.codcurceu AS 'codigo_curso_ceu'
	,o.codedicurceu AS 'codigo_edicao_curso'
	,o.numseqofeedi AS 'sequencia_oferecimento'
	,m.codofeatvceu AS 'turma'
	,a.dscatc AS 'funcao'
	,m.fmtexeatv AS 'forma_exercicio'
	,m.cgahormis AS 'carga_horaria_minutos'
	,m.dtainimisatv AS 'data_inicio_turma'
	,m.dtafimmisatv AS 'data_fim_turma'
FROM MINISTRANTECEU m
	LEFT JOIN ATUACAOCEU a 
		ON m.codatc = a.codatc
	LEFT JOIN OFERECIMENTOATIVIDADECEU o
		ON m.codofeatvceu = o.codofeatvceu
	LEFT JOIN dbo.EDICAOCURSOOFECEU e
		ON o.codcurceu = e.codcurceu AND o.codedicurceu = e.codedicurceu AND o.numseqofeedi = e.numseqofeedi
WHERE YEAR(e.dtainiofeedi) >= 2007
