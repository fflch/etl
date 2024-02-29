SELECT
	q.codqtn AS 'codigo_questionario'
	,q.codqst AS 'codigo_questao'
	,q.dscqst as 'descricao_questao'
	,a.numatnqst AS 'codigo_alternativa'
	,a.dscatn AS 'descricao_alternativa'
FROM QUESTOESPESQUISA q
	LEFT JOIN ALTERNATIVAQUESTAO a ON q.codqtn = a.codqtn AND q.codqst = a.codqst