SELECT
	i.codpes AS 'numero_usp'
	,i.dtainiatvitb AS 'data_inicio_intercambio'
	,i.dtafimatvitb AS 'data_fim_intercambio'
	,CASE i.tipitbpfevst
		WHEN 'I' THEN 'Internacional'
		WHEN 'N' THEN 'Nacional'
		ELSE i.tipitbpfevst
		END AS 'tipo_intercambio'
	,i.codorgpntori AS 'codigo_instituicao_origem'
	,CASE
		WHEN o2.sglorg IS NOT NULL
			THEN o2.sglorg
		ELSE o.sglorgpnt
		END AS 'sigla_instituicao_origem'
	,o.nomorgpnt AS 'nome_instituicao_origem'
	,i.tipingitb AS 'tipo_ingresso_intercambio'
	,CASE
		WHEN c.codcscitb IS NOT NULL
			THEN c.nomcscitb
		ELSE p2.nompgmitb
		END AS 'nome_programa_intercambio'
	,r.nomreditb AS 'nome_rede_intercambio'
	,i.codpesrsp AS 'responsavel_numero_usp'
	,u.sglund AS 'responsavel_unidade'
	,i.codsetpesrsp AS 'responsavel_codigo_setor'
	,s.nomset AS 'responsavel_nome_setor'
FROM INTERCAMPROFVISITANTE i
	LEFT JOIN CONSORCIOINTERCAMBIO c ON i.codpgmitb = c.codpgmitb AND i.codcscitb = c.codcscitb
	LEFT JOIN PROGRAMAINTERCAMBIO p2 ON i.codpgmitb = p2.codpgmitb
	LEFT JOIN REDEINTERCAMBIO r ON r.codreditb = i.codreditb
	LEFT JOIN ORGAOPRETENDENTE o ON o.codorgpnt = i.codorgpntori
	LEFT JOIN ORGANIZACAO o2 ON o2.codorg = o.codorg
	LEFT JOIN UNIDADE u ON u.codund = i.codundpesrsp
	LEFT JOIN SETOR s ON s.codset = i.codsetpesrsp