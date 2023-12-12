SELECT
	d.coddis AS 'codigo_disciplina'
	,d.verdis AS 'versao_disciplina'
	,d.nomdis AS 'nome_disciplina'
	,d.creaul AS 'credito_aula'
	,d.cretrb AS 'credito_trabalho'
	,d.dtaatvdis AS 'data_ativacao_disciplina'
	,d.dtadtvdis AS 'data_desativacao_disciplina'
	,d.durdis AS 'duracao_disciplina_semanas'
	,d.tipdis AS 'periodicidade_disciplina'
	,d.cgahoreto AS 'carga_horaria_estagio'
	,d.cgahorlcn AS 'carga_horaria_licenciatura'
	,d.cgaacdciecul AS 'carga_horaria_aacc'
    ,CASE
		WHEN GETDATE() > d.dtadtvdis
			THEN 'Desativado'
		WHEN d.dtaatvdis > GETDATE()
			THEN 'Programado'
		WHEN d.dtaatvdis IS NOT NULL
			THEN 'Ativo'
		WHEN d.sitdis IS NOT NULL
			THEN d.sitdis
		ELSE 'Pendente'
	    END AS 'situacao_disciplina'
FROM DISCIPLINAGR d
	LEFT JOIN DISCIPGRCODIGO d2 ON d.coddis = d2.coddis
WHERE d2.codclg = 8
