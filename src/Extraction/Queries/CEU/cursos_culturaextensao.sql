SELECT
	c.codcurceu AS 'codigoCursoCEU'
	,u.sglund AS 'siglaUnidade'
	,c.codsetdep AS 'codigoDepartamento'
	,s.nomset AS 'nomeDepartamento'
	,m.dscmdlceu AS 'modalidadeCurso'
	,c.nomcurceu AS 'nomeCurso'
	,CASE c.fmtcurceu
		WHEN 'PRES' THEN 'Presencial'
		WHEN 'DIST' THEN 'EAD'
		ELSE c.fmtcurceu
		END AS 'tipo'
	,c.codclg AS 'codigoColegiado'
	,c.sglclg AS 'siglaColegiado'
	,a.nomarecnh AS 'areaConhecimento'
	,a2.nomaretem AS 'areaTematica'
	,l.nomlnhext AS 'linhaExtensao'
FROM CURSOCEU c
	LEFT JOIN UNIDADE u ON c.codund = u.codund
	LEFT JOIN SETOR s ON c.codsetdep = s.codset
	LEFT JOIN MODALIDCURSOCEU m ON c.codmdlceu = m.codmdlceu
	LEFT JOIN AREACONHECIMENTO a ON c.codarecnh = a.codarecnh
	LEFT JOIN AREATEMATICACEU a2 ON c.codaretem = a2.codaretem
	LEFT JOIN LINHAEXTENSAOCEU l ON c.codlnhext = l.codlnhext
WHERE c.codund = 8
	AND c.codcurceu IN (
                        SELECT e.codcurceu 
                        FROM EDICAOCURSOOFECEU e 
                        WHERE YEAR(e.dtainiofeedi) >= 2007
                        )