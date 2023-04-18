SELECT
	t.coddis AS 'codigo_disciplina'
	,t.verdis AS 'versao_disciplina'
	,t.codtur AS 'codigo_turma'
	,vagas_total = t.numvagtur + t.numvagopt + t.numvagoptlre + t.numvagecr + t.numvagturcpl
	,inscritos_total = t.numins + t.numinsopt + t.numinsoptlre + t.numinsecr + numinscpl
	,matriculados_total = t.nummtr + t.nummtropt + t.nummtroptlre + t.nummtrecr + t.nummtrturcpl
	,t.numvagtur AS 'vagas_tipo_obrigatoria'
	,t.numins AS 'inscritos_tipo_obrigatoria'
	,t.nummtr AS 'matriculados_tipo_obrigatoria'
	,t.numvagopt AS 'vagas_tipo_opt_eletiva'
	,t.numinsopt AS 'inscritos_tipo_opt_eletiva'
	,t.nummtropt AS 'matriculados_tipo_opt_eletiva'
	,t.numvagoptlre AS 'vagas_tipo_opt_livre'
	,t.numinsoptlre AS 'inscritos_tipo_opt_livre'
	,t.nummtroptlre AS 'matriculados_tipo_opt_livre'
	,t.numvagecr AS 'vagas_tipo_extracurricular'
	,t.numinsecr AS 'inscritos_tipo_extracurricular'
	,t.nummtrecr AS 'matriculados_tipo_extracurricular'
	,t.numvagturcpl AS 'vagas_tipo_especial'
	,t.numinscpl AS 'inscritos_tipo_especial'
	,t.nummtrturcpl AS 'matriculados_tipo_especial'
FROM TURMAGR t
	LEFT JOIN DISCIPGRCODIGO d ON t.coddis = d.coddis
WHERE d.codclg = 8
	AND YEAR(t.dtainitur) >= 2007