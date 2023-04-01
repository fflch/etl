-- Get NUSPs
SELECT DISTINCT(codpes)
INTO #nusps
FROM (
    -- alunos_graduacao
    SELECT p.codpes
    FROM HABILPROGGR hp
        INNER JOIN PROGRAMAGR p ON (hp.codpes = p.codpes AND hp.codpgm = p.codpgm)
    WHERE hp.codcur BETWEEN 8000 AND 9000
        AND YEAR(p.dtaing) >= 2007
    UNION ALL
    -- alunos_posgraduacao
    SELECT a.codpes
    FROM AGPROGRAMA a
    WHERE a.codare BETWEEN 8000 AND 9000
        AND YEAR(a.dtaselpgm) >= 2007
            AND a.vinalupgm = 'REGULAR'
    UNION ALL
    -- pesquisadores_posdoc
    SELECT pd.codpes_pd AS 'codpes'
    FROM PDPROJETO pd
    WHERE pd.codund = 8
        AND YEAR(pd.dtainiprj) >= 2007
    UNION ALL
    -- alunos_ceu
    SELECT m.codpes
    FROM dbo.MATRICULACURSOCEU m
        INNER JOIN EDICAOCURSOOFECEU e ON (m.codcurceu = e.codcurceu AND m.codedicurceu = e.codedicurceu AND m.numseqofeedi = e.numseqofeedi)
    WHERE m.codund = 8
        AND YEAR(e.dtainiofeedi) >= 2007
    UNION ALL
    -- servidores e docentes
    SELECT v.codpes
    FROM VINCULOPESSOAUSP v
    WHERE v.tipvin IN ('SERVIDOR', 'ESTAGIARIO', 'ESTAGIARIORH', 'ESTAGIARIOPOS') 
        AND v.codfusclgund = 8
) u;


-- Get info
SELECT
    p.codpes AS 'numero_usp'
    ,p.nompes AS 'nome'
    ,p.dtanas AS 'data_nascimento'
    ,e.codema AS 'email'
    ,p2.nacpas AS 'nacionalidade'
    ,CASE WHEN l.codpas = 1 THEN l.cidloc ELSE NULL END AS 'cidade_nascimento'
    ,CASE WHEN l.codpas = 1 THEN l.sglest ELSE NULL END AS 'estado_nascimento'
    ,p3.nompas AS 'pais_nascimento'
    ,c.codraccor AS 'raca'
    ,p.sexpes AS 'sexo'
    ,p.numcpf AS 'cpf'
INTO #geral
FROM PESSOA p
    LEFT JOIN COMPLPESSOA c ON p.codpes = c.codpes
    LEFT JOIN PAIS p2 ON c.codpasnac = p2.codpas
    LEFT JOIN PAIS p3 ON c.codpasnas = p3.codpas
    LEFT JOIN LOCALIDADE l ON c.codlocnas = l.codloc
    LEFT JOIN EMAILPESSOA e ON p.codpes = e.codpes AND e.stamtr = 'S'
WHERE p.codpes IN (SELECT codpes FROM #nusps);

-- Drop all unnecessary temp tables
DROP TABLE #nusps;