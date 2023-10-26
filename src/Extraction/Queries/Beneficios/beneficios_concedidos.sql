SELECT
	b.codbnfalu AS 'codigo_beneficio'
	,b2.nombnfloc AS 'nome_beneficio'
	,CASE t.ctgbnf
		WHEN 'A' THEN 'Auxílio'
		WHEN 'B' THEN 'Bolsa'
		END AS 'tipo_beneficio'
--	,b2.staavlsoceco AS 'exige_avaliacao_socioeconomica'
--	,b2.staftepgdusp AS 'fonte_pagadora_usp'
--	,b2.stapaf AS 'parte_papfe'
	,b.numseqgesbnf AS 'numero_sequencial_beneficio'
	,b.anoofebnf AS 'periodo_projeto_beneficio' 
	,b.codprjbnf AS 'codigo_projeto_beneficio'
	,t2.nomvin AS 'tipo_vinculo'
	,b.codpes AS 'numero_usp'
	,b.codpgm AS 'sequencia_grad'
	,b.nivcurpgr AS 'nivel_pos_graduacao'
	,b.dtainiccd AS 'data_inicio_concessao'
	,CASE
		WHEN b.dtacanccd IS NULL
			THEN b.dtafimccd
		WHEN b.dtacanccd NOT BETWEEN b.dtainiccd AND b.dtafimccd -- // ver
			THEN b.dtafimccd
		WHEN b.dtacanccd BETWEEN b.dtainiccd AND b.dtafimccd
			THEN b.dtacanccd
		ELSE NULL
		END AS 'data_fim_concessao'
	,CASE
		WHEN b.dtacanccd IS NOT NULL AND b.dtacanccd < GETDATE()
			THEN 'Cancelado'
		WHEN b.dtacanccd IS NOT NULL AND b.dtacanccd >= GETDATE()
			THEN 'Ativo'
		WHEN b.dtafimccd >= GETDATE()
			THEN 'Ativo'
		ELSE 'Encerrado'
		END AS 'situacao_beneficio'
	,b.cotmespvs AS 'cota_mensal_prevista'
	,b.juscanccd AS 'justificativa_cancelamento_concessao'
	,b.vlrbnfepfbls AS 'valor_beneficio_especifico'
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
ORDER BY b.codbnfalu, b.dtainiccd