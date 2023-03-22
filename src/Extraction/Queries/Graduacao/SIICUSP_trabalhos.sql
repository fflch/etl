SELECT
	st.edisii AS 'edicao_siicusp'
	,st.codtrbsii AS 'codigo_trabalho'
	,st.tittrbptg AS 'titulo_trabalho'
	,st.anoprj AS 'ano_projeto'
	,st.codprj AS 'codigo_projeto'
	,st.sittrb AS 'situacao_inscricao'
	,st.statrbapt AS 'apresentado_siicusp'
	,st.tippcpapt AS 'tipo_participante_apresentou'
	,st.starmdprxetp AS 'prox_etapa_recomendado'
	,st.staaptprxetp AS 'prox_etapa_apresentado'
	,st.starcbmenhnr AS 'mencao_honrosa'
	,sp.codsetpcp AS 'codigo_dpto_orientador'
	,s.nomset AS 'nome_dpto_orientador'
FROM dbo.SIIUTRABALHO st
	LEFT JOIN SIIUPARTICIPTRABALHO spt ON st.edisii = spt.edisii AND st.codtrbsii = spt.codtrbsii AND spt.tipptptrb = 'O'
	LEFT JOIN SIIUPARTICIPANTE sp ON spt.codpcpsii = sp.codpcpsii
	LEFT JOIN SETOR s ON sp.codsetpcp = s.codset
WHERE st.sittrb = 'Validado'
	AND st.edisii >= 25
ORDER BY st.edisii, st.codtrbsii