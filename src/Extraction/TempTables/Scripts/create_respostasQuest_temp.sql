--
SELECT
	h.codpes
	,h.codpgm
	,MAX(p.dtaing) AS dtaing
INTO #fflch_undergrads
FROM HABILPROGGR h
LEFT JOIN PROGRAMAGR p
	ON h.codpes = p.codpes 
		AND h.codpgm = p.codpgm
WHERE h.codcur BETWEEN 8000 AND 9000
GROUP BY h.codpes, h.codpgm;


--
SELECT
	r.codpes
	,r.codqtn
	,r.codqst
	,r.numatnqst
	,ISNULL(CONVERT(DATETIME, r.dtarpa), '1900-01-01') AS dtarpa
	,f.codpgm
	,f.dtaing
	,q.dtainiqtn
	,q.dtafimqtn
INTO #fflch_answers
FROM RESPOSTASQUESTAO r
	INNER JOIN #fflch_undergrads f ON r.codpes = f.codpes
	LEFT JOIN QUESTIONARIO q ON (r.codqtn = q.codqtn);


--
UPDATE #fflch_answers
SET dtarpa = DATEADD(ss, numatnqst, dtarpa)
WHERE 1=1;


--
SELECT
	f.codpes AS 'numero_usp'
	,f.codpgm AS 'sequencia_grad'
	,f.codqtn AS 'codigo_questionario'
	,f.codqst AS 'codigo_questao'
	,f.numatnqst AS 'alternativa_escolhida'
INTO #respostas_questionario
FROM #fflch_answers f
	LEFT JOIN #fflch_answers f2
		ON f.codpes = f2.codpes
			AND f.codpgm = f2.codpgm
			AND f.codqtn = f2.codqtn
			AND f.codqst = f2.codqst
			AND f.dtarpa < f2.dtarpa
WHERE f2.codpes IS NULL
	AND (f.dtaing BETWEEN f.dtainiqtn AND f.dtafimqtn);


-- Drop all tables that won't be needed
DROP TABLE #fflch_undergrads;
DROP TABLE #fflch_answers;