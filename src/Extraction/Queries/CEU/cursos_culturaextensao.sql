SELECT
	c.codcurceu AS 'codigo_curso_ceu'
	,u.sglund AS 'sigla_unidade'
	,c.codsetdep AS 'codigo_departamento'
	,s.nomset AS 'nome_departamento'
	,m.dscmdlceu AS 'modalidade_curso'
	,c.nomcurceu AS 'nome_curso'
	,CASE c.fmtcurceu
		WHEN 'PRES' THEN 'Presencial'
		WHEN 'DIST' THEN 'EAD'
		ELSE c.fmtcurceu
		END AS 'tipo'
	,c.codclg AS 'codigo_colegiado'
	,c.sglclg AS 'sigla_colegiado'
	,a.nomarecnh AS 'area_conhecimento'
	,a2.nomaretem AS 'area_tematica'
	,l.nomlnhext AS 'linha_extensao'
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