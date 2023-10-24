-- Get FFLCH undergrads
SELECT p.codpes, p.codpgm
INTO #gr
FROM PROGRAMAGR p
LEFT JOIN HABILPROGGR h
	ON p.codpes = h.codpes
		AND p.codpgm = h.codpgm
WHERE YEAR(p.dtaing) >= 2007
	AND h.codcur BETWEEN 8000 AND 9000
GROUP BY p.codpes, p.codpgm;


-- Get HISTPROGGR info from FFLCH undergrads
SELECT
	h.codpes
	,h.codpgm
	,h.stapgm
    ,h.dtaoco
	,CONVERT(VARCHAR, anoref)
		+ SUBSTRING(perref, 1, 1) 
		+ CONVERT(VARCHAR(32), dtaoco, 140)
		AS periodo
INTO #fflch_hpg
FROM HISTPROGGR h
-- Filter:
INNER JOIN #gr g
	ON h.codpes = g.codpes
		AND h.codpgm = g.codpgm;


/* Get next Ativação (A), Encerramento (E) and Trancamento (T) dates for each undergrad occurrence.
 * We are doing this so we can find out later what happened directly after student's leave of absence.
 * That is, if she/he was reinstalled, dropped out or requested another leave of absence. */
-- P.S. For some reason this mess is way faster then subselecting #fflch_mpg
SELECT
	*
	,ISNULL((
		SELECT 
			MIN(CONVERT(VARCHAR, anoref)
				+ SUBSTRING(perref, 1, 1)
				+ CONVERT(VARCHAR(100), dtaoco, 140))
   		FROM HISTPROGGR h
   		WHERE f.codpes = h.codpes
   			AND f.codpgm = h.codpgm
   			AND CONVERT(VARCHAR, anoref) 
   				+ SUBSTRING(perref, 1, 1) 
   				+ CONVERT(VARCHAR(100), dtaoco, 140) 
   					> f.periodo
   			AND h.stapgm = 'T'
	), '777') AS prox_t
	,ISNULL((
		SELECT 
			MIN(CONVERT(VARCHAR, anoref)
				+ SUBSTRING(perref, 1, 1)
				+ CONVERT(VARCHAR(100), dtaoco, 140))
   		FROM HISTPROGGR h
   		WHERE f.codpes = h.codpes
   			AND f.codpgm = h.codpgm
   			AND CONVERT(VARCHAR, anoref) 
   				+ SUBSTRING(perref, 1, 1) 
   				+ CONVERT(VARCHAR(100), dtaoco, 140) 
   					> f.periodo
   			AND h.stapgm = 'E'
	), '777') AS prox_e
	,ISNULL((
		SELECT 
			MIN(CONVERT(VARCHAR, anoref)
				+ SUBSTRING(perref, 1, 1)
				+ CONVERT(VARCHAR(100), dtaoco, 140))
   		FROM HISTPROGGR h
   		WHERE f.codpes = h.codpes
   			AND f.codpgm = h.codpgm
   			AND CONVERT(VARCHAR, anoref) 
   				+ SUBSTRING(perref, 1, 1) 
   				+ CONVERT(VARCHAR(100), dtaoco, 140) 
   					> f.periodo
   			AND h.stapgm = 'A'
	), '777') AS prox_a
INTO #pos_trancamentos
FROM #fflch_hpg f;


-- Get what happened directly after student's leave of absence by analysing both `perref` and `dtaoco` of student's next occurrences.
SELECT
	*
	,CASE
		WHEN prox_a = '777' AND prox_t = '777' AND prox_e = '777'
			THEN 'Trancamento em andamento'
		WHEN prox_a <= prox_t AND prox_a <= prox_e
			THEN 'Retorno ao curso'
		WHEN prox_t <= prox_a AND prox_t <= prox_e
			THEN 'Renovação do trancamento'
		WHEN (prox_a <> '777' OR prox_t <> '777')
			THEN 'Desligamento seguido de reativação'
		WHEN prox_e <= prox_t AND prox_e <= prox_a
			THEN 'Desligamento'
		ELSE 'X' END AS 'sequencia_trancamento'
INTO #definicao_pos_trancamentos
FROM #pos_trancamentos p
WHERE p.stapgm = 'T';


-- Establish reference semester and date of occurrence of both start and end of the student's license of absence.
SELECT
	d.codpes AS 'numero_usp'
	,d.codpgm AS 'sequencia_grad'
	,d.dtaoco AS 'data_registro_inicio_tranc'
	,SUBSTRING(d.periodo, 1, 5) AS 'periodo_inicio_trancamento'
	,CASE d.sequencia_trancamento
		WHEN 'Retorno ao curso'
			THEN CONVERT(DATETIME, SUBSTRING(prox_a, 6, 23), 140)
		WHEN 'Renovação do trancamento'
			THEN CONVERT(DATETIME, SUBSTRING(prox_t, 6, 23), 140)
		WHEN 'Desligamento seguido de reativação'
			THEN CONVERT(DATETIME, SUBSTRING(prox_e, 6, 23), 140)
		WHEN 'Desligamento'
			THEN CONVERT(DATETIME, SUBSTRING(prox_e, 6, 23), 140)
		ELSE NULL
		END AS 'data_registro_fim_tranc'
	,CASE d.sequencia_trancamento
		WHEN 'Retorno ao curso'
			THEN SUBSTRING(prox_a, 1, 5)
		WHEN 'Renovação do trancamento'
			THEN SUBSTRING(prox_t, 1, 5)
		WHEN 'Desligamento seguido de reativação'
			THEN SUBSTRING(prox_e, 1, 5)
		WHEN 'Desligamento'
			THEN SUBSTRING(prox_e, 1, 5)
		ELSE NULL
		END AS 'periodo_fim_trancamento'
	,d.sequencia_trancamento
INTO #fim_trancamentos
FROM #definicao_pos_trancamentos d;


-- Tries to calculate the duration, in semesters, of the student's leave of absence
-- It does not look very reliable, though, as `perref` is apparently used in a loose way.
-- // ver `SELECT * FROM #trancamentos_graduacao WHERE YEAR(data_registro_fim_tranc) > CAST(SUBSTRING(periodo_fim_trancamento, 1, 4) AS INT)`
SELECT *,
	((CAST(SUBSTRING(periodo_fim_trancamento, 1, 4) AS SMALLINT) * 2)
		+ CAST(SUBSTRING(periodo_fim_trancamento, 5, 1) AS SMALLINT))
			- ((CAST(SUBSTRING(periodo_inicio_trancamento, 1, 4) AS SMALLINT) * 2)
				+ CAST(SUBSTRING(periodo_inicio_trancamento, 5, 1) AS SMALLINT)) AS 'semestres_trancados'
INTO #trancamentos_graduacao
FROM #fim_trancamentos;


-- Drop all unnecessary temp tables
DROP TABLE #gr;
DROP TABLE #fflch_hpg;
DROP TABLE #pos_trancamentos;
DROP TABLE #definicao_pos_trancamentos;
DROP TABLE #fim_trancamentos;