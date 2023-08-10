-- hotfix areas
SELECT * 
INTO #areas
FROM NOMEAREA n;

UPDATE #areas
SET dtainiare = '1900-01-01'
WHERE dtainiare = (
    SELECT MIN(dtainiare)
    FROM #areas a2
    WHERE a2.codare = #areas.codare
);

UPDATE #areas
SET dtafimare = DATEADD(day, 1, GETDATE())
WHERE dtainiare = (
    SELECT MAX(dtainiare)
    FROM #areas a2
    WHERE a2.codare = #areas.codare
);

UPDATE #areas
SET dtafimare = DATEADD(mi, -1, dtafimare);


-- hotfix programas
SELECT * 
INTO #programas
FROM NOMECURSO n;

UPDATE #programas
SET dtainicur = '1900-01-01'
WHERE dtainicur = (
    SELECT MIN(dtainicur)
    FROM #programas p2
    WHERE p2.codcur = #programas.codcur
);

UPDATE #programas
SET dtafimcur = DATEADD(day, 1, GETDATE())
WHERE dtainicur = (
    SELECT MAX(dtainicur)
    FROM #programas p2
    WHERE p2.codcur = #programas.codcur
);

UPDATE #programas
SET dtafimcur = DATEADD(mi, -1, dtafimcur);