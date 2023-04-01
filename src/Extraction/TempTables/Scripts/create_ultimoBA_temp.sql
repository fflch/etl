SELECT
    hp.codpes AS 'codpes'
    ,hp.codpgm AS 'codpgm'
    ,MAX(hp.dtaini) AS 'data_ultimo_bacharelado'
INTO #ultimo_bacharelado
FROM HABILPROGGR hp
    LEFT JOIN HABILITACAOGR hg ON (hp.codcur = hg.codcur AND hp.codhab = hg.codhab)
WHERE hg.tiphab <> 'L'
GROUP BY hp.codpes, hp.codpgm