SELECT
	b.codbnfalu AS 'codigo_programa_usp'
	,b2.nombnfloc AS 'nome_programa_usp'
--	,b2.staavlsoceco AS 'exige_avaliacao_socioeconomica'
--	,b2.staftepgdusp AS 'fonte_pagadora_usp'
--	,b2.stapaf AS 'parte_papfe'
	,b.numseqgesbnf AS 'sequencia_programa_usp'
	,b.anoofebnf AS 'periodo_referencial' 
	,b.codprjbnf AS 'codigo_projeto_diverso'
	,t2.nomvin AS 'tipo_vinculo_bolsista'
	,b.codpes AS 'numero_usp'
	,b.codpgm AS 'sequencia_grad'
	,b.nivcurpgr AS 'nivel_pg_bolsista'
	,b.dtainiccd AS 'data_inicio_bolsa'
	,CASE
		WHEN b.dtacanccd IS NOT NULL -- // ver casos dtacanccd > dtafimccd
			THEN b.dtacanccd
		ELSE b.dtafimccd
		END AS 'data_fim_bolsa'
	,CASE
		WHEN b.dtacanccd >= GETDATE()
			THEN 'Ativo'
		WHEN b.dtacanccd < b.dtafimccd
			THEN 'Cancelado'
		WHEN b.dtafimccd < GETDATE()
			THEN 'Encerrado'
		WHEN b.dtainiccd > GETDATE()
			THEN 'Programado'
		ELSE 'Ativo'
		END AS 'situacao_bolsa'
	,b.juscanccd AS 'justificativa_cancelamento_bolsa'
	,b.vlrbnfepfbls AS 'valor_bolsa_especifico'
--	,b.codrgiitb // ver
--	,b.codslamon // ver
--	,b.codorgpiaudv // ver
FROM BENEFICIOALUCONCEDIDO b
	LEFT JOIN BENEFICIOALUNO b2 ON b.codbnfalu = b2.codbnfalu
	LEFT JOIN TIPOBENEFICIOALUNO t ON b2.tipbnfalu = t.tipbnfalu
	LEFT JOIN TIPOVINCULO t2 ON b.tipvin = t2.tipvin
	-- Filter out undergraduates from other institutes:
	LEFT JOIN (
		SELECT h.codpes, h.codpgm
		FROM HABILPROGGR h
		WHERE codcur BETWEEN 8000 AND 8999
		GROUP BY h.codpes, h.codpgm
	) j ON b.codpes = j.codpes AND b.codpgm = j.codpgm
WHERE (b.tipvin IS NULL OR b.tipvin <> 'ALUNOGR' OR j.codpes IS NOT NULL)
	--
    AND t.ctgbnf = 'B'
ORDER BY b.codbnfalu, b.dtainiccd