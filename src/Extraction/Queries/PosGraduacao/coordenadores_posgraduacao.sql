SELECT
	r.codpes AS 'numero_usp'
	,CASE r.fncpescur
		WHEN 'COO' THEN 'Coordenador'
		WHEN 'VCO' THEN 'Vice-coordenador'
		ELSE r.fncpescur END
		AS 'funcao'
	,r.codcur AS 'codigo_programa'
	,p.nomcur AS 'nome_programa'
	,r.dtainifnc AS 'data_inicio_funcao'
	,r.dtafimfnc AS 'data_fim_funcao'
FROM
    R10DOCCOOCUR r
LEFT JOIN
    #programas p
		ON r.codcur = p.codcur
		AND r.dtainifnc BETWEEN p.dtainicur AND p.dtafimcur
WHERE r.codcur BETWEEN 8000 AND 8999