SELECT
	r.codpes AS 'numero_usp'
	,r.codcurceu AS 'codigo_curso_ceu'
	,r.codedicurceu AS 'codigo_edicao_curso'
	,r.numseqofeedi AS 'sequencia_oferecimento'
	,CASE r.codpaprsp
		WHEN 1 THEN 'Coordenador'
		WHEN 2 THEN 'Vice-Coordenador'
		ELSE NULL
		END AS 'funcao'
	,r.fmtexeatv AS 'forma_exercicio'
FROM RESPONSAVELEDICAOCEU r
	LEFT JOIN EDICAOCURSOOFECEU e
		ON r.codcurceu = e.codcurceu AND r.codedicurceu = e.codedicurceu AND r.numseqofeedi = e.numseqofeedi
WHERE YEAR(e.dtainiofeedi) >= 2007
