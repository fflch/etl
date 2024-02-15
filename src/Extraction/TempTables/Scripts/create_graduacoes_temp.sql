--
CREATE TABLE #habilitacoes (
    id INT IDENTITY,
    codpes INT,
    codpgm SMALLINT,
    codcur INT,
    codhab INT,
    dtaini DATETIME,
    dtafim DATETIME NULL,
    tipenchab VARCHAR(40) NULL,
    tiphab CHAR(1),
    UNIQUE CLUSTERED (codpes, codpgm, codcur, codhab, dtaini)
);


--
INSERT INTO #habilitacoes (
    codpes,
    codpgm,
    codcur,
    codhab,
    dtaini,
    dtafim,
    tipenchab,
    tiphab
)
SELECT
	hp.codpes
	,hp.codpgm
	,hp.codcur
	,hp.codhab
	,hp.dtaini
	,hp.dtafim
	,hp.tipenchab
    ,hg.tiphab
FROM HABILPROGGR hp
	LEFT JOIN HABILITACAOGR hg ON hp.codcur = hg.codcur AND hp.codhab = hg.codhab
WHERE hp.codcur BETWEEN 8000 AND 9000
ORDER BY hp.codpes, hp.codpgm, hp.dtafim, hp.dtaini, hp.codcur, hp.codhab;


--
SET identity_update #habilitacoes ON;


--
UPDATE #habilitacoes
SET id = id + 1000000
WHERE tipenchab LIKE 'Conclus_o';


--
UPDATE #habilitacoes
SET id = id + 500000
WHERE dtaini = (
	SELECT MAX(dtaini)
	FROM #habilitacoes h
	WHERE #habilitacoes.codpes = h.codpes AND #habilitacoes.codpgm = h.codpgm 
        AND tiphab <> 'L'
        AND (
            tipenchab IS NULL
            OR
            (tipenchab NOT LIKE 'Conclus_o' 
            AND tipenchab NOT LIKE 'Op__o Curr_culo' 
            AND tipenchab NOT LIKE 'Transfer_ncia Interna')
        )
)
    AND tiphab <> 'L';


--
UPDATE #habilitacoes
SET id = id + 500000
WHERE dtaini = (
	SELECT MAX(dtaini)
	FROM #habilitacoes h
	WHERE #habilitacoes.codpes = h.codpes AND #habilitacoes.codpgm = h.codpgm 
        AND tiphab = 'L'
        AND (
            tipenchab IS NULL
            OR
            (tipenchab NOT LIKE 'Conclus_o' 
            AND tipenchab NOT LIKE 'Op__o Curr_culo' 
            AND tipenchab NOT LIKE 'Transfer_ncia Interna')
        )
)
    AND tiphab = 'L';


--
SET identity_update #habilitacoes OFF;


--
SELECT h.*
INTO #grau_principal
FROM (SELECT * FROM #habilitacoes WHERE tiphab <> 'L') h
LEFT JOIN (SELECT * FROM #habilitacoes WHERE tiphab <> 'L') h2
    ON h.codpes = h2.codpes
        AND h.codpgm = h2.codpgm
        AND h.id < h2.id
WHERE h2.id IS NULL;


--
SELECT h.*
INTO #licenciaturas
FROM (SELECT * FROM #habilitacoes WHERE tiphab = 'L') h
LEFT JOIN (SELECT * FROM #habilitacoes WHERE tiphab = 'L') h2
    ON h.codpes = h2.codpes
        AND h.codpgm = h2.codpgm
        AND h.id < h2.id
WHERE h2.id IS NULL;


--
SELECT
    p.codpes AS 'numero_usp'
    ,p.codpgm AS 'sequencia_grad'
    ,p.stapgm AS 'situacao_curso'
    ,p.dtaing AS 'data_inicio_vinculo'
    ,CASE
	    WHEN (g.codpes IS NOT NULL) AND (l.codpes IS NOT NULL)
	    	THEN CASE
	    		WHEN g.dtafim >= l.dtafim THEN g.dtafim
	    		ELSE l.dtafim
	    	END
	   	WHEN g.codpes IS NOT NULL
	   		THEN g.dtafim
	   	WHEN l.dtafim IS NOT NULL
	   		THEN l.dtafim
	   	ELSE NULL
    	END AS 'data_fim_vinculo'
    ,CASE WHEN g.codcur IS NOT NULL THEN g.codcur ELSE l.codcur END AS 'codigo_curso'
    ,CASE WHEN c.nomcur IS NOT NULL THEN c.nomcur ELSE c2.nomcur END AS 'nome_curso'
    ,p.tiping AS 'tipo_ingresso'
    ,p.sglacaafm AS 'categoria_ingresso'
    ,p.clsing AS 'rank_ingresso'
    ,CASE
    	WHEN g.codpes IS NOT NULL THEN 'S'
    	ELSE 'N'
    	END AS 'bacharelado'
    ,g.tipenchab AS 'tipo_encerramento_bacharel'
    ,g.dtafim AS 'data_encerramento_bacharel'
    ,CASE
    	WHEN l.codpes IS NOT NULL THEN 'S'
    	ELSE 'N'
    	END AS 'licenciatura'
    ,l.tipenchab AS 'tipo_encerramento_licenciatura'
    ,l.dtafim AS 'data_encerramento_licenciatura'
INTO #graduacoes
FROM PROGRAMAGR p
    -- Filter:
	INNER JOIN (SELECT DISTINCT codpes, codpgm FROM #habilitacoes) h ON (h.codpes = p.codpes AND h.codpgm = p.codpgm)
    --
    LEFT JOIN #grau_principal g ON (g.codpes = p.codpes AND g.codpgm = p.codpgm)
    LEFT JOIN #licenciaturas l ON (l.codpes = p.codpes AND l.codpgm = p.codpgm)
    LEFT JOIN CURSOGR c ON (g.codcur = c.codcur)
    LEFT JOIN CURSOGR c2 ON (l.codcur = c2.codcur);


-- Drop all tables that won't be needed
DROP TABLE #habilitacoes;
DROP TABLE #grau_principal;
DROP TABLE #licenciaturas;