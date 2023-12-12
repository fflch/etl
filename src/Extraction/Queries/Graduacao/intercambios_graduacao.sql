SELECT
	i.codpes AS 'numero_usp'
	,i.codpgm AS 'sequencia_grad'
	,i.mdlitbusp AS 'modalidade_intercambio'
	,CASE WHEN i.dtainiitbori IS NOT NULL
		THEN i.dtainiitbori
		ELSE i.dtainiitb
		END AS 'data_inicio_intercambio'
	,i.dtafimitb AS 'data_fim_intercambio'
	,CASE
		WHEN i.dtainiitbori > GETDATE() OR i.dtainiitb > GETDATE()
			THEN 'Programado'
		ELSE i2.dsctipsititb
		END AS 'situacao_intercambio'
	,i.dtadsialu AS 'data_desistencia'
	,CASE WHEN i.dtainiitbori IS NOT NULL
		THEN 'S'
		ELSE 'N'
		END AS 'houve_prorrogacao'
	,i.codorgpnt AS 'codigo_instituicao'
	,CASE
		WHEN o2.sglorg IS NOT NULL
			THEN o2.sglorg
		ELSE o.sglorgpnt
		END AS 'sigla_instituicao'
	,o2.nomrazsoc AS 'nome_instituicao'
	,i.tipingitb AS 'tipo_ingresso_intercambio'
	,i.codediitb AS 'codigo_edital_intercambio'
	,CASE
		WHEN c.codcscitb IS NOT NULL
			THEN c.nomcscitb
		ELSE p2.nompgmitb
		END AS 'nome_programa_intercambio'
	,r.nomreditb AS 'nome_rede_intercambio'
FROM INTERCAMBIOUSPORGAO i
	LEFT JOIN CONSORCIOINTERCAMBIO c ON i.codpgmitb = c.codpgmitb AND i.codcscitb = c.codcscitb
	LEFT JOIN PROGRAMAINTERCAMBIO p2 ON i.codpgmitb = p2.codpgmitb
	LEFT JOIN REDEINTERCAMBIO r ON r.codreditb = i.codreditb
	LEFT JOIN INTERCAMTIPOSITUACAO i2 ON i2.codtipsititb = i.codtipsititb
	-- LEFT JOIN CONVENIO c2 ON c2.codcvn = i.codcvn // ver
	LEFT JOIN ORGAOPRETENDENTE o ON o.codorgpnt = i.codorgpnt
	LEFT JOIN ORGANIZACAO o2 ON o2.codorg = o.codorg