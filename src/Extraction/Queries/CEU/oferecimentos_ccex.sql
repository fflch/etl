SELECT
	ec.codcurceu AS 'codigoCursoCEU'
	,ec.codedicurceu AS 'codigoEdicaoCurso'
	,e.numseqofeedi AS 'sequenciaOferecimento'
	,CASE 
		WHEN ec.staediiva IS NOT NULL
			THEN 'INV'
		WHEN ec.staedicvl IS NOT NULL
			THEN 'APR' --HMG?
		ELSE ec.staedi 
		END AS 'situacaoOferecimento'
	,e.dtainiofeedi AS 'dataInicioOferecimento'
	,e.dtafimofeedi AS 'dataFimOferecimento'
	,p.totcgahorpgm AS 'totalCargaHoraria'
	,e.qtdvagofe AS 'qntdVagasOfertadas'
	,e.stacurpag AS 'cursoPago'
	,e.vlrins AS 'valorInscricaoEdicao'
	,CASE e.stacurpag
		WHEN 'N' THEN e.qtdvagofe
		ELSE e.qtdvaggrt
		END AS 'qntdVagasGratuitas'
	,e.vlrpvsarc AS 'valorPrevistoArrecadacao'
	,e.vlrpvscus AS 'valorPrevistoCustos'
	,e.vlrpvsprrceu AS 'valorPrevistoPRCE'
	,e.stacurepr AS 'cursoParaEmpresas'
	,e.dsclocexe AS 'localCurso'
	,e.stainsweb AS 'permiteInscricaoOnline'
	,CASE 
		WHEN (e.dtainiins < e.dtainiinsweb OR e.dtainiinsweb IS NULL)
			THEN e.dtainiins
		ELSE e.dtainiinsweb
		END AS 'dataInicioInscricoes'
	,CASE 
		WHEN (e.dtafimins > e.dtafiminsweb OR e.dtafiminsweb IS NULL)
			THEN e.dtafimins
		ELSE e.dtafiminsweb
		END AS 'dataFimInscricoes'
FROM CURSOCEU c
	INNER JOIN EDICAOCURSOCEU ec ON c.codcurceu = ec.codcurceu
	INNER JOIN EDICAOCURSOOFECEU e ON (ec.codcurceu = e.codcurceu AND ec.codedicurceu = e.codedicurceu)
	LEFT JOIN PROGRAMACURSOCEU p ON (e.codcurceu = p.codcurceu AND e.codpgmceu = p.codpgmceu)
WHERE c.codund = 8
	AND YEAR(e.dtainiofeedi) >= 2007
ORDER BY p.totcgahorpgm DESC