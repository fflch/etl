SELECT
	st.edisii AS 'edicaoSIICUSP'
	,st.codtrbsii AS 'codigoTrabalho'
	,st.tittrbptg AS 'tituloTrabalho'
	,st.anoprj AS 'anoProjeto'
	,st.codprj AS 'codigoProjeto'
	,st.statrbapt AS 'apresentadoSIICUSP'
	,st.tippcpapt AS 'tipoParticipanteApresentou'
	,st.starmdprxetp AS 'proxEtapaRecomendado'
	,st.staaptprxetp AS 'proxEtapaApresentado'
	,st.starcbmenhnr AS 'mencaoHonrosa'
	,st.codsetapttrb AS 'codigoDptoApresentacao'
	,s.nomset AS 'nomeDptoApresentacao'
FROM dbo.SIIUTRABALHO st
	LEFT JOIN SETOR s ON st.codsetapttrb = s.codset
WHERE st.sittrb <> 'Incompleto'
	AND st.edisii >= 25
ORDER BY st.edisii, st.codtrbsii