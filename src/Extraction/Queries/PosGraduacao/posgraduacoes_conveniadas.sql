SELECT
    a.codpes AS 'numero_usp'
    ,a.numseqpgm AS 'seq_programa'
    ,a.codare AS 'codigo_area'
    ,a.codcvn AS 'codigo_convenio'
    ,c.sglcvn AS 'sigla_convenio'
    ,c.nomcvn AS 'nome_convenio'
FROM AGINSCRICAO a
    LEFT JOIN CONVENIO c ON a.codcvn = c.codcvn
WHERE a.codcvn IS NOT NULL
    AND a.codare BETWEEN 8000 AND 9000
    AND a.staselare = 'APR'