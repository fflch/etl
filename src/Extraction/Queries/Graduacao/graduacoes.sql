SELECT
    p.codpes AS 'numero_usp'
    ,p.codpgm AS 'sequencia_grad'
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
    INNER JOIN PROGRAMAGR p ON (hp.codpes = p.codpes AND hp.codpgm = p.codpgm)
    LEFT JOIN HABILITACAOGR hg ON (hp.codcur = hg.codcur AND hp.codhab = hg.codhab)
    LEFT JOIN CURSOGR c ON (hp.codcur = c.codcur)
    -- Filter:
    INNER JOIN #ultimo_bacharelado ub ON (ub.codpes = hp.codpes AND ub.codpgm = hp.codpgm AND ub.data_ultimo_bacharelado = hp.dtaini)
WHERE hp.codcur BETWEEN 8000 and 8999
    AND hg.tiphab <> 'L'
    AND YEAR(p.dtaing) >= 2007
ORDER BY p.codpes