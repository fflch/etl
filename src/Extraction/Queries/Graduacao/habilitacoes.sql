SELECT
	hp.codpes AS 'numero_usp'
	,hp.codpgm AS 'sequencia_grad'
	,hp.codcur AS 'codigo_curso'
	,hp.codhab AS 'codigo_habilitacao'
	,hg.nomhab AS 'nome_habilitacao'
	,hg.tiphab AS 'tipo_habilitacao'
	,hg.perhab AS 'periodo_habilitacao'
	,hp.dtaini AS 'data_inicio_habilitacao'
	,hp.dtafim AS 'data_fim_habilitacao'
	,hp.tipenchab AS 'tipo_encerramento'
	,hp.dtaclcgru AS 'data_colacao_grau'
	,hp.dtaexddpl AS 'data_expedicao_diploma'
FROM HABILPROGGR hp
	INNER JOIN PROGRAMAGR p ON (hp.codpes = p.codpes AND hp.codpgm = p.codpgm)
	LEFT JOIN HABILITACAOGR hg ON (hp.codcur = hg.codcur AND hp.codhab = hg.codhab)
WHERE hp.codcur BETWEEN 8000 and 8999