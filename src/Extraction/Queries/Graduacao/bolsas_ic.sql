SELECT *
FROM 
    (
        SELECT
            i.anoprj AS 'anoProjeto'
            ,i.codprj AS 'codigoProjeto'
            ,CASE
                WHEN i.codctgedi = 1 THEN 'CNPQ - PIBIC'
                WHEN i.codctgedi = 2 THEN 'CNPQ - PIBIT'
            END AS 'nomePrograma'
            ,i.codboledi AS 'bolsaEdital'
            ,i.dtainibol AS 'dataInicioBolsa'
            ,i.dtafimbol AS 'dataFimBolsa'
        FROM ICTPROJEDITALBOLSA i
        UNION
        SELECT
            i2.anoprj AS 'anoProjeto'
            ,i2.codprj AS 'codigoProjeto'
            ,p.nompgmfcm AS 'nomePrograma'
            ,NULL AS 'bolsaEdital'
            ,i2.dtainifom AS 'dataInicioBolsa'
            ,i2.dtafimfom AS 'dataFimBolsa'
        FROM ICTPROJFOMENTO i2
            LEFT JOIN PROPESQFOMENTO p ON i2.codpgmfcm = p.codpgmfcm
        WHERE i2.codpgmfcm <> 889 -- 889 = 'Sem fomento'
    ) u
    INNER JOIN ICTPROJETO ip ON u.anoProjeto = ip.anoprj AND u.codigoProjeto = ip.codprj
    LEFT JOIN SETOR s ON ip.codsetprj = s.codset
WHERE ip.codpesalu IS NOT NULL
    AND ip.staprj <> 'Incompleto'
    AND s.codund = 8
ORDER BY u.dataInicioBolsa ASC