SELECT
	i.anoprj AS 'ano_projeto'
	,i.codprj AS 'codigo_projeto'
    ,i.codsetprj AS 'codigo_departamento'
	,s.nomset AS 'nome_departamento'
	,i.dtainiprj AS 'data_inicio_projeto'
	,i.dtafimprj AS 'data_fim_projeto'
	,CASE
		WHEN i.dtainiprj > GETDATE()
			THEN 'Programado'
		ELSE i.staprj
		END AS 'situacao_projeto'
	,i.codpesalu AS 'numero_usp'
	,i.codpesrsp AS 'numero_usp_orientador'
	,i.titprj AS 'titulo_projeto'
    ,i.palcha AS 'palavras_chave'
FROM ICTPROJETO i
	LEFT JOIN SETOR s ON i.codsetprj = s.codset
WHERE i.codpesalu IS NOT NULL
	AND s.codund = 8
	AND i.staprj <> 'Incompleto'
ORDER BY i.anoprj, i.codprj