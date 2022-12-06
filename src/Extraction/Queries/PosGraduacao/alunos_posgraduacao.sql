SELECT
    p.codpes AS 'numeroUSP'
    ,p.nompes AS 'nomeAluno'
    ,YEAR(p.dtanas) AS 'anoNascimento'
    ,p2.nacpas AS 'nacionalidade'
    ,CASE WHEN l.codpas = 1 THEN l.cidloc ELSE NULL END AS 'cidadeNascimento'
    ,CASE WHEN l.codpas = 1 THEN l.sglest ELSE NULL END AS 'estadoNascimento'
    ,p3.nompas AS 'paisNascimento'
    ,c.codraccor AS 'raca'
    ,p.sexpes AS 'sexo'
FROM PESSOA p
    LEFT JOIN COMPLPESSOA c ON p.codpes = c.codpes
    LEFT JOIN PAIS p2 ON c.codpasnac = p2.codpas
    LEFT JOIN PAIS p3 ON c.codpasnas = p3.codpas
    LEFT JOIN LOCALIDADE l ON c.codlocnas = l.codloc
WHERE p.codpes IN (
                    SELECT a.codpes
                    FROM AGPROGRAMA a
                        WHERE a.codare BETWEEN 8000 AND 9000
                            AND YEAR(a.dtaselpgm) >= 2007
                            AND a.vinalupgm = 'REGULAR'
                  )