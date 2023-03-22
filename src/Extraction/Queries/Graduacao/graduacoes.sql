SELECT
    p.codpes AS 'numero_usp'
    ,p.codpgm AS 'sequencia_curso'
    ,p.stapgm AS 'situacao_curso'
    ,p.dtaing AS 'data_inicio_vinculo'
    ,CASE WHEN p.tipencpgm IS NOT NULL THEN p.dtaini ELSE NULL END AS 'data_fim_vinculo'
    ,hp.codcur AS 'codigo_curso'
    ,c.nomcur AS 'nome_curso'
    ,p.tiping AS 'tipo_ingresso'
    ,p.sglacaafm AS 'categoria_ingresso'
    ,p.clsing AS 'rank_ingresso'
    ,hp.tipenchab AS 'tipo_encerramento_bacharel'
    ,hp.dtafim AS 'data_encerramento_bacharel'
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