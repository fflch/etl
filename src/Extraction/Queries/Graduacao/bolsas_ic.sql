SELECT *
FROM 
    (
        SELECT
            i.anoprj AS 'ano_projeto'
            ,i.codprj AS 'codigo_projeto'
            ,CASE
                WHEN i.codctgedi = 1 THEN 'CNPQ - PIBIC'
                WHEN i.codctgedi = 2 THEN 'CNPQ - PIBIT'
            END AS 'nome_programa'
            ,i.codboledi AS 'bolsa_edital'
            ,i.dtainibol AS 'data_inicio_bolsa'
            ,i.dtafimbol AS 'data_fim_bolsa'
        FROM ICTPROJEDITALBOLSA i
        UNION
        SELECT
            i2.anoprj AS 'ano_projeto'
            ,i2.codprj AS 'codigo_projeto'
            ,p.nompgmfcm AS 'nome_programa'
            ,NULL AS 'bolsa_edital'
            ,i2.dtainifom AS 'data_inicio_bolsa'
            ,i2.dtafimfom AS 'data_fim_bolsa'
        FROM ICTPROJFOMENTO i2
            LEFT JOIN PROPESQFOMENTO p ON i2.codpgmfcm = p.codpgmfcm
        WHERE i2.codpgmfcm <> 889 -- 889 = 'Sem fomento'
    ) u
    INNER JOIN ICTPROJETO ip ON u.ano_projeto = ip.anoprj AND u.codigo_projeto = ip.codprj
    LEFT JOIN SETOR s ON ip.codsetprj = s.codset
WHERE ip.codpesalu IS NOT NULL
    AND ip.staprj NOT IN ('Incompleto', 'Denegado', 'Inscrito PIBI', 'Inscrito')
    AND s.codund = 8
ORDER BY u.data_inicio_bolsa ASC