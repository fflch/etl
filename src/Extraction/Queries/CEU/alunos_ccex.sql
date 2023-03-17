SELECT
    p.codpes AS 'numero_usp'
    ,p.nompes AS 'nome_aluno'
    ,YEAR(p.dtanas) AS 'ano_nascimento'
    ,e.codema AS 'email'
    ,p2.nacpas AS 'nacionalidade'
    ,CASE WHEN l.codpas = 1 THEN l.cidloc ELSE NULL END AS 'cidade_nascimento'
    ,CASE WHEN l.codpas = 1 THEN l.sglest ELSE NULL END AS 'estado_nascimento'
    ,p3.nompas AS 'pais_nascimento'
    ,c.codraccor AS 'raca'
    ,p.sexpes AS 'sexo'
FROM PESSOA p
    LEFT JOIN COMPLPESSOA c ON p.codpes = c.codpes
    LEFT JOIN PAIS p2 ON c.codpasnac = p2.codpas
    LEFT JOIN PAIS p3 ON c.codpasnas = p3.codpas
    LEFT JOIN LOCALIDADE l ON c.codlocnas = l.codloc
    LEFT JOIN EMAILPESSOA e ON p.codpes = e.codpes AND e.stamtr = 'S'
WHERE p.codpes IN (
                    SELECT DISTINCT(m.codpes)
                    FROM dbo.MATRICULACURSOCEU m
                        INNER JOIN EDICAOCURSOOFECEU e ON (m.codcurceu = e.codcurceu AND m.codedicurceu = e.codedicurceu AND m.numseqofeedi = e.numseqofeedi)
                    WHERE m.codund = 8
                        AND YEAR(e.dtainiofeedi) >= 2007
)