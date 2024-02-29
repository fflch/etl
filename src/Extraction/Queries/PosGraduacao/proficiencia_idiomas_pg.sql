SELECT
    r.codpes AS 'numero_usp'
    ,r.numseqpgm AS 'seq_programa'
    ,r.codare AS 'codigo_area'
    ,i.dsclin AS 'idioma'
    ,r.dtaexm AS 'data_exame'
FROM R46PGMPROIDI r
	LEFT JOIN IDIOMA i ON r.codlin = i.codlin
WHERE r.stacslexm = 'S'
	AND r.codare BETWEEN 8000 AND 9000