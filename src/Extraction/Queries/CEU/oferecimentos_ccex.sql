SELECT
	ec.codcurceu AS 'codigo_curso_ceu'
	,ec.codedicurceu AS 'codigo_edicao_curso'
	,e.numseqofeedi AS 'sequencia_oferecimento'
	,CASE 
		WHEN ec.staediiva IS NOT NULL
			THEN 'INV'
		WHEN ec.staedicvl IS NOT NULL
			THEN 'APR' --HMG?
		ELSE ec.staedi 
		END AS 'situacao_oferecimento'
	,e.dtainiofeedi AS 'data_inicio_oferecimento'
	,e.dtafimofeedi AS 'data_fim_oferecimento'
	,p.totcgahorpgm AS 'total_carga_horaria'
	,e.qtdvagofe AS 'qntd_vagas_ofertadas'
	,e.stacurpag AS 'curso_pago'
	,e.vlrins AS 'valor_inscricao_edicao'
	,CASE e.stacurpag
		WHEN 'N' THEN e.qtdvagofe
		ELSE e.qtdvaggrt
		END AS 'qntd_vagas_gratuitas'
	,e.vlrpvsarc AS 'valor_previsto_arrecadacao'
	,e.vlrpvscus AS 'valor_previsto_custos'
	,e.vlrpvsprrceu AS 'valor_previsto_prce'
	,e.stacurepr AS 'curso_para_empresas'
	,e.dsclocexe AS 'local_curso'
	,e.stainsweb AS 'permite_inscricao_online'
	,CASE 
		WHEN (e.dtainiins < e.dtainiinsweb OR e.dtainiinsweb IS NULL)
			THEN e.dtainiins
		ELSE e.dtainiinsweb
		END AS 'data_inicio_inscricoes'
	,CASE 
		WHEN (e.dtafimins > e.dtafiminsweb OR e.dtafiminsweb IS NULL)
			THEN e.dtafimins
		ELSE e.dtafiminsweb
		END AS 'data_fim_inscricoes'
FROM CURSOCEU c
	INNER JOIN EDICAOCURSOCEU ec ON c.codcurceu = ec.codcurceu
	INNER JOIN EDICAOCURSOOFECEU e ON (ec.codcurceu = e.codcurceu AND ec.codedicurceu = e.codedicurceu)
	LEFT JOIN PROGRAMACURSOCEU p ON (e.codcurceu = p.codcurceu AND e.codpgmceu = p.codpgmceu)
WHERE c.codund = 8
	AND YEAR(e.dtainiofeedi) >= 2007
ORDER BY p.totcgahorpgm DESC