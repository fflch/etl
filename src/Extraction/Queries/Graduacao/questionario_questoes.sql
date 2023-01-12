SELECT
	q.codqtn AS 'codigoQuestionario'
	,q.codqst AS 'codigoQuestao'
	,q.dscqst as 'descricaoQuestao'
	,a.numatnqst AS 'codigoAlternativa'
	,a.dscatn AS 'descricaoAlternativa'
FROM QUESTOESPESQUISA q
	LEFT JOIN ALTERNATIVAQUESTAO a ON q.codqtn = a.codqtn AND q.codqst = a.codqst