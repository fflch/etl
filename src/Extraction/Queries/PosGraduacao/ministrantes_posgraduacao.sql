SELECT
	rt.codpes AS 'numero_usp'
	,rt.sgldis AS 'codigo_disciplina'
	,rt.numseqdis AS 'versao_disciplina'
	,rt.numofe AS 'codigo_turma'
FROM R32TURMINDOC rt
-- Filter
	LEFT JOIN SETOR s
		ON s.nomabvset = LEFT(rt.sgldis, 3)
			AND s.codund = 8 
			AND s.tipset = 'Departamento de Ensino'
	LEFT JOIN OFERECIMENTO o
		ON rt.sgldis = o.sgldis
			AND rt.numseqdis = o.numseqdis
			AND rt.numofe = o.numofe 
WHERE YEAR(o.dtainiofe) >= 2007
	AND (s.nomabvset IS NOT NULL OR LEFT(rt.sgldis, 3) = 'HDL')