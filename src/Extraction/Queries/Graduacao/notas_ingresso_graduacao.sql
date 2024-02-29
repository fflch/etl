SELECT
	n.codpes AS 'numero_usp'
	,n.codpgm AS 'sequencia_grad'
	,n.codtipmiaing AS 'codigo_prova'
	,t.tipmiaing AS 'descricao_prova'
    ,CASE
        WHEN n.ptoing IS NOT NULL
            THEN n.ptoing
        ELSE n.noting
        END AS 'pontos_obtidos'
	,n.ptomax AS 'pontos_maximo'
FROM NOTASINGRESSOGR n
    LEFT JOIN dbo.TIPOMATERIAING t ON n.codtipmiaing = t.codtipmiaing
    -- FIlter:
    INNER JOIN #graduacoes g
        ON n.codpes = g.numero_usp
            AND n.codpgm = g.sequencia_grad