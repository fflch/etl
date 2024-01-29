SELECT
	b.*
	,CASE
		WHEN b2.codpes IS NOT NULL
			THEN 'S' 
		ELSE NULL
		END AS 'inscrito'
	,b2.coddisetopae AS 'codigo_disciplina_estagio'
	,b2.verdisetopae AS 'versao_disciplina_estagio'
	,b2.staetopae AS 'situacao_estagio'
    ,u1.sglund AS 'unidade_estagio'
	,b2.codpesspv AS 'numero_usp_supervisor'
	,b2.anosemmdlepp AS 'periodo_epp'
	,b2.staepp AS 'situacao_epp'
	,b2.mdlepp AS 'modalidade_epp'
	,b2.sgldisepp AS 'sigla_disciplina_epp'
    ,u2.sglund AS 'unidade_epp'
	,b2.stainspae AS 'situacao_inscricao'
	,b2.clsalubnf AS 'classificacao_bolsa'
	,b2.stablsvlt AS 'bolsista_ou_voluntario'
    ,u3.sglund AS 'unidade_inscricao'
	,b2.obspcsccdbnf AS 'observacao2'
	,o.nomrazsoc AS 'organizacao_disciplina_externa'
    ,u4.sglund AS 'unidade_cota_interunidades'
	,b2.stavalinsort AS 'validacao_inscricao_orientador'
	,b2.stavalinsspv AS 'validacao_inscricao_supervisor'
	,b2.staaprrelclg AS 'validacao_inscricao_unidade'
	,b2.staaprrelprr AS 'validacao_inscricao_pro_reitoria'
	,b2.stavinepd AS 'vinculo_empregaticio'
FROM (
	SELECT
		b.anoofebnf AS 'periodo_referencial'
		,b.codpes AS 'numero_usp'
		,b.nivcurpgr AS 'nivel_programa'
		,'Bolsista' AS 'modalidade_pae'
		,b.dtainiccd AS 'data_inicio_pae'
		,CASE
			WHEN b.dtacanccd IS NOT NULL
				THEN b.dtacanccd
			ELSE b.dtafimccd
			END AS 'data_fim_pae'
		,b.obsbnfccd AS 'observacao'
		,b.juscanccd AS 'justificativa_cancelamento'
	FROM dbo.BENEFICIOALUCONCEDIDO b
	WHERE b.codbnfalu = 69
	UNION ALL
	SELECT
		b.anoofebnf AS 'periodo_referencial'
		,b.codpes AS 'numero_usp'
		,b.nivcurpgr AS 'nivel'
		,'Voluntário' AS 'modalidade_pae'
		,b.dtainivlt AS 'data_inicio_pae'
		,CASE
			WHEN b.dtacanvlt IS NOT NULL
				THEN b.dtacanvlt
			ELSE b.dtafimvlt
			END AS 'data_fim_pae'
		,b.obsvlt AS 'observacao'
		,b.juscanvlt AS 'justificativa_cancelamento'
	FROM dbo.BENVOLUNTARIOPAE b
) b
    LEFT JOIN dbo.BENINSCRITOPAE b2
	    ON b.periodo_referencial = b2.anoofebnf
		    AND b.numero_usp = b2.codpes
    LEFT JOIN dbo.UNIDADE u1
        ON u1.codund = b2.codclgetopae
    LEFT JOIN dbo.UNIDADE u2
        ON u2.codund = b2.codclgepp
    LEFT JOIN dbo.UNIDADE u3
        ON u3.codund = b2.codclgrsp
    LEFT JOIN dbo.UNIDADE u4
        ON u4.codund = b2.codclgcotinu
    LEFT JOIN dbo.ORGANIZACAO o
        ON o.codorg = b2.codorgdisexr
