SELECT
	v.codpes AS 'numero_usp'
	,v.numseqpes AS 'numero_sequencia_vinculo'
	,v.tipvin AS 'tipo_vinculo'
	,v.dtainivin AS 'data_inicio_vinculo'
	,v.dtafimvin AS 'data_fim_vinculo'
	,v.sitatl AS 'situacao_atual'
	,v.codset AS 'cod_ultimo_setor'
	,s.nomset AS 'nome_ultimo_setor'
	,v.tiping AS 'tipo_ingresso'
	,CASE
		WHEN v.sitatl <> 'A' THEN v.sitoco
		ELSE NULL
	END AS 'ultima_ocorrencia'
	,v.dtainisitoco AS 'data_inicio_ultima_ocorrencia'
	,v.nomcaa AS 'nome_carreira'
	,v.nomabvfnc AS 'nome_funcao'
	,v.nomabvcla AS 'nome_classe'
	,v.nivgrupvm AS 'nome_grau_provimento'
	,v.dtainisitfun AS 'data_ultima_alteracao_funcional'
	,CASE l.tipvinext
		WHEN 'Servidor Designado' THEN l.nomfnc
		ELSE NULL
	END AS 'cargo'
	,v.tipjor AS 'tipo_jornada'
	,v.tipcon AS 'tipo_condicao'
FROM VINCULOPESSOAUSP v
	LEFT JOIN SETOR s ON v.codset = s.codset
	LEFT JOIN LOCALIZAPESSOA l ON v.codpes = l.codpes AND v.codset = l.codset AND v.tipvin = l.tipvin AND tipvinext = 'Servidor Designado'
WHERE v.tipvin IN ('SERVIDOR', 'ESTAGIARIO', 'ESTAGIARIORH', 'ESTAGIARIOPOS') 
	AND v.codfusclgund = 8
	AND v.tipfnc <> 'Docente'