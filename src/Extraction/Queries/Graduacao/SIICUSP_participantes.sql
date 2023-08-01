SELECT
	spt.edisii AS 'edicao_siicusp'
	,spt.codtrbsii AS 'codigo_trabalho'
	,spt.tipptptrb AS 'tipo_participante'
	,spe.codpes AS 'numero_usp'
	,spe.nompcpsii AS 'nome_participante'
	,spe.codundpcp AS 'codigo_unidade'
	,u.sglund AS 'sigla_unidade'
	,spe.codsetpcp AS 'codigo_departamento'
	,s.nomset AS 'nome_departamento'
	,CASE
		WHEN st.codpcpsiiapt = spt.codpcpsii
			THEN 'S'
		WHEN spt.staapttrb = 'S'
			THEN 'S'
		ELSE 'N'
		END AS 'participante_apresentador'
FROM SIIUPARTICIPTRABALHO spt
	INNER JOIN SIIUTRABALHO st ON (spt.edisii = st.edisii AND spt.codtrbsii = st.codtrbsii)
	LEFT JOIN SIIUPARTICIPANTE spe ON spt.codpcpsii = spe.codpcpsii
	LEFT JOIN UNIDADE u ON spe.codundpcp = u.codund
	LEFT JOIN SETOR s ON spe.codsetpcp = s.codset
WHERE st.sittrb = 'Validado'
	AND st.edisii >= 25
ORDER BY spt.edisii, spt.codtrbsii