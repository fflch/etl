SELECT
    p.codpes AS 'numeroUSP'
    ,p.codpgm AS 'sequenciaCurso'
    ,p.stapgm AS 'situacao'
    ,p.dtaing AS 'dataInicioVinculo'
    ,CASE WHEN p.tipencpgm <> NULL THEN p.dtaini ELSE NULL END AS 'dataFimVinculo'
    ,hp.codcur AS 'codigoCurso'
    ,c.nomcur AS 'nomeCurso'
    ,p.tiping AS 'tipoIngresso'
    ,p.sglacaafm AS 'categoriaIngresso'
    ,p.clsing AS 'rankIngresso'
    ,p.tipencpgm AS 'tipoEncerramento'
FROM HABILPROGGR hp
    INNER JOIN (
        SELECT hp2.codpes AS 'codpes', hp2.codpgm as 'codpgm', MAX(hp2.dtaini) AS 'ultimoBA'
        FROM HABILPROGGR hp2
            LEFT JOIN HABILITACAOGR hg ON (hp2.codcur = hg.codcur AND hp2.codhab = hg.codhab)
        WHERE hg.tiphab <> 'L'
        GROUP BY hp2.codpes, hp2.codpgm) jn
            ON (jn.codpes = hp.codpes AND jn.ultimoBA = hp.dtaini)
    INNER JOIN PROGRAMAGR p ON (hp.codpes = p.codpes AND hp.codpgm = p.codpgm)
    LEFT JOIN HABILITACAOGR hg ON (hp.codcur = hg.codcur AND hp.codhab = hg.codhab)
    LEFT JOIN CURSOGR c ON (hp.codcur = c.codcur)
WHERE hp.codcur BETWEEN 8000 AND 9000
    AND hg.tiphab <> 'L'
    AND YEAR(p.dtaing) >= 2007
ORDER BY p.codpes