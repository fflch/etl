SELECT DISTINCT(codpes) AS 'numero_usp'
INTO #nusps_lattes
FROM (    
    -- alunos_posgraduacao
    SELECT a.codpes
    FROM AGPROGRAMA a
    WHERE a.codare BETWEEN 8000 and 8999
        AND a.vinalupgm <> 'ESPECIAL'
    UNION ALL
    -- pesquisadores_avancados (posdoc/pesquisadores colaboradores)
    SELECT pd.codpes_pd AS 'codpes'
    FROM PDPROJETO pd
    WHERE pd.codund = 8
        AND YEAR(pd.dtainiprj) >= 2007
    UNION ALL
    -- docentes fflch
    SELECT v.codpes
    FROM VINCULOPESSOAUSP v
    WHERE v.tipvin = 'SERVIDOR'
        AND v.tipfnc = 'Docente' 
        AND v.codfusclgund = 8
    -- credenciados areas fflch
    UNION ALL
    SELECT rc.codpes
    FROM R25CRECREDOC rc
    WHERE rc.codare BETWEEN 8000 and 8999
) u;