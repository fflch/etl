SELECT
	ag.codpes AS 'numero_usp'
	,ag.codare AS 'codigo_area'
	,ag.numseqpgm AS 'seq_programa'
	,ag.dtadfapgm AS 'data_defesa'
	,UPPER(ag.nomlocdfatrb) AS 'local_defesa'
	,ag.menccdpgm AS 'mencao_honrosa'
	,tp.tittrb AS 'titulo_trabalho'
FROM AGPROGRAMA ag
	INNER JOIN TRABALHOPROG tp
		ON tp.numseqpgm = ag.numseqpgm
		AND tp.codpes = ag.codpes
		AND tp.codare = ag.codare
WHERE ag.codare BETWEEN 8000 AND 8999
	-- filter out those thesis defenses that have not yet taken place
	AND ag.dtadfapgm IS NOT NULL
	-- limit register errors:
	AND ag.vinalupgm <> 'ESPECIAL'