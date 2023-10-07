SELECT
	r.codpesdct AS 'numero_usp_membro'
	,r.codare AS 'codigo_area'
	,r.codpes AS 'numero_usp_aluno'
	,r.numseqpgm AS 'seq_programa'
	,r.numseqptpban AS 'sequencia_participacao'
	,r.vinptpbantrb AS 'vinculo_participacao'
	,r.staptp AS 'participacao_assinalada'
    ,r.nottrb AS 'nota_defesa'
    ,CASE
		WHEN r.avldfa = 'AP' THEN 'Aprovado'
		WHEN r.avldfa = 'RP' THEN 'Reprovado'
		ELSE r.avldfa
        END AS 'avaliacao_defesa' 
	,r.staesp AS 'especialista'
	,CASE
		WHEN r.rstavlect = 'AP' THEN 'Apto'
		WHEN r.rstavlect = 'NA' THEN 'Não apto'
		ELSE r.rstavlect 
		END AS 'avaliacao_escrita'
	,r.stavotduptit AS 'voto_dupla_titulacao'
FROM R48PGMTRBDOC r
	INNER JOIN AGPROGRAMA ag
		ON r.codare = ag.codare
			AND r.codpes = ag.codpes
			AND r.numseqpgm = ag.numseqpgm
	INNER JOIN TRABALHOPROG tp
		ON tp.codare = ag.codare
			AND tp.codpes = ag.codpes
			AND tp.numseqpgm = ag.numseqpgm
-- Ou foram registrados como participantes, ou deram nota, ou avaliaram a defesa
WHERE (r.staptp IS NOT NULL OR r.nottrb IS NOT NULL OR r.avldfa IS NOT NULL)
	AND ag.codare BETWEEN 8000 AND 8999
	-- filter out those thesis defenses that have not yet taken place
	AND ag.dtadfapgm IS NOT NULL
	-- limit register errors:
	AND ag.vinalupgm <> 'ESPECIAL'