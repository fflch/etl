SELECT
	spt.edisii AS 'edicaoSIICUSP'
	,spt.codtrbsii AS 'codigoTrabalho'
	,spe.codpes AS 'numeroUSP'
	,spe.nompcpsii AS 'nome'
	,spt.tipptptrb AS 'tipoParticipante'
	,spe.codundpcp AS 'codigoUnidade'
	,u.sglund AS 'siglaUnidade'
	,spe.codsetpcp AS 'codigoDepartamento'
	,s.nomset AS 'nomeDepartamento'
	,CASE
		WHEN st.codpcpsiiapt = spt.codpcpsii
			THEN 'S'
		WHEN spt.staapttrb = 'S'
			THEN 'S'
		ELSE NULL
		END AS 'apresentou'
FROM dbo.SIIUPARTICIPTRABALHO spt
	INNER JOIN SIIUTRABALHO st ON (spt.edisii = st.edisii AND spt.codtrbsii = st.codtrbsii)
	LEFT JOIN SIIUPARTICIPANTE spe ON spt.codpcpsii = spe.codpcpsii
	LEFT JOIN UNIDADE u ON spe.codundpcp = u.codund
	LEFT JOIN SETOR s ON spe.codsetpcp = s.codset
WHERE st.sittrb <> 'Incompleto'
	AND st.edisii >= 25
ORDER BY spt.edisii, spt.codtrbsii