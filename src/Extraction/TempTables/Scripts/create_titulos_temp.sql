-- // ver
SELECT
	codpes
	,numseqtitpes
	,titpes
	,CAST(dtatitpes AS DATETIME) AS 'dtatitpes'
	,grufor
	,codorg
	,codcur
	,codhab
	,codcurpgr
	,codare
INTO #all_titulos
FROM TITULOPES
WHERE codesc = 14
	AND nivesc = 9 
	AND (grufor IN (3, 4, 5, 9) OR grufor IS NULL);


--
UPDATE #all_titulos
SET grufor = (CASE grufor
				WHEN NULL THEN 1
				WHEN 3 THEN 2
				WHEN 4 THEN 3
				WHEN 9 THEN 4
				WHEN 5 THEN 5
			END);


--
UPDATE #all_titulos
SET codorg = 0
WHERE codorg IS NULL;


--
UPDATE #all_titulos
SET dtatitpes = '1800-01-01 00:00:00'
WHERE dtatitpes IS NULL;


--
UPDATE #all_titulos
SET dtatitpes = DATEADD(ss, numseqtitpes, dtatitpes);


--
SELECT a.codpes, j.max_grau, MAX(dtatitpes) AS max_date
INTO #maior_titulo -- o último em caso de dois títulos com o mesmo grau
FROM #all_titulos a
INNER JOIN (
	SELECT codpes, MAX(grufor) AS max_grau
	FROM #all_titulos
	GROUP BY codpes
) j ON a.codpes = j.codpes
		AND a.grufor = j.max_grau
GROUP BY a.codpes, j.max_grau;


--
UPDATE #all_titulos
SET dtatitpes = NULL
WHERE YEAR(dtatitpes) = 1800;


--
SELECT
	a.codpes AS 'numero_usp'
    ,CASE a.grufor
        WHEN 1 THEN 'Graduação'
        WHEN 2 THEN 'Mestrado'
        WHEN 3 THEN 'Doutorado'
        WHEN 4 THEN 'Pós-doutorado'
        WHEN 5 THEN 'Livre-docência'
        END AS 'nivel_titulo'
    ,YEAR(a.dtatitpes) AS 'ano_obtencao_titulo'
    ,a.titpes AS 'descricao_titulo'
    ,a.codcur AS 'codigo_curso_grad'
    ,a.codhab AS 'codigo_habilitacao_grad'
    ,a.codcurpgr AS 'codigo_programa_posgrad'
    ,a.codare AS 'codigo_area_posgrad'
    ,a.codorg AS 'codigo_instituicao'
	,o.sglorg AS 'sigla_instituicao'
	,o.nomrazsoc AS 'nome_instituicao'
	,CASE
		WHEN m.codpes IS NOT NULL 
			THEN 'S' 
		ELSE NULL 
		END AS 'ultimo_maior_titulo'
INTO #titulos_pessoas
FROM #all_titulos a
	LEFT JOIN #maior_titulo m
		ON a.codpes = m.codpes
			AND a.dtatitpes = m.max_date
			AND a.grufor = m.max_grau
	LEFT JOIN dbo.ORGANIZACAO o
		ON a.codorg = o.codorg;


-- Drop all unnecessary temp tables
DROP TABLE #all_titulos;
DROP TABLE #maior_titulo;