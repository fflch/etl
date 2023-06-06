SELECT
	t.coddis AS 'codigo_disciplina'
	,t.verdis AS 'versao_disciplina'
	,t.codtur AS 'codigo_turma'
	,t.tiptur AS 'tipo_turma'
	,t.dtacritur AS 'data_criacao_turma'
	,t.dtainitur AS 'data_inicio_aulas'
	,t.dtafimtur AS 'data_fim_aulas'
	,t.statur AS 'status_turma'
	,t.cgahorteo AS 'carga_horaria_teorica'
	,t.cgahorpra AS 'carga_horaria_pratica'
	,c.numero_alunos_cursou
	,c.aprovados_pct
	,c.tracamentos_pct
	,c.reprov_nota_pct
	,c.reprov_freq_pct
	,c.reprov_ambos_pct
	,c.numero_alunos_finalizou
	,c.frequencia_media
	,c.nota_media
FROM TURMAGR t
	LEFT JOIN DISCIPGRCODIGO d ON t.coddis = d.coddis
	LEFT JOIN #consolidacao_turma c 
		ON t.coddis = c.disciplina 
			AND t.verdis = c.versao_disciplina 
			AND t.codtur = c.turma
WHERE d.codclg = 8
	AND YEAR(t.dtainitur) >= 2007
ORDER BY t.coddis, t.verdis, t.codtur