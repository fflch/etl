SELECT
	st.edisii AS 'edicaoSIICUSP'
	,st.codtrbsii AS 'codigoTrabalho'
	,st.tittrbptg AS 'tituloTrabalho'
	,st.anoprj AS 'anoProjeto'
	,st.codprj AS 'codigoProjeto'
	,st.sittrb AS 'situacaoInscricao'
	,st.statrbapt AS 'apresentadoSIICUSP'
	,st.tippcpapt AS 'tipoParticipanteApresentou'
	,st.starmdprxetp AS 'proxEtapaRecomendado'
	,st.staaptprxetp AS 'proxEtapaApresentado'
	,st.starcbmenhnr AS 'mencaoHonrosa'
	,sp.codsetpcp AS 'codigoDptoOrientador'
	,s.nomset AS 'nomeDptoOrientador'
FROM dbo.SIIUTRABALHO st
	LEFT JOIN SIIUPARTICIPTRABALHO spt ON st.edisii = spt.edisii AND st.codtrbsii = spt.codtrbsii AND spt.tipptptrb = 'O'
	LEFT JOIN SIIUPARTICIPANTE sp ON spt.codpcpsii = sp.codpcpsii
	LEFT JOIN SETOR s ON sp.codsetpcp = s.codset
WHERE st.sittrb = 'Validado'
	AND st.edisii >= 25
ORDER BY st.edisii, st.codtrbsii