SELECT
	h.coddis
	,h.verdis
	,h.codtur
	,CASE
		WHEN h.notfim2 IS NOT NULL
			THEN h.notfim2
		WHEN h.notfim2 IS NULL AND h.notfim IS NOT NULL 
			THEN h.notfim
		ELSE NULL END AS 'max_nota'
	,h.frqfim
	,h.rstfim
INTO #filtered_notas
FROM HISTESCOLARGR h
	LEFT JOIN TURMAGR t ON h.coddis = t.coddis AND h.verdis = t.verdis AND h.codtur = t.codtur
	LEFT JOIN DISCIPGRCODIGO d ON h.coddis = d.coddis
WHERE d.codclg = 8
	AND YEAR(t.dtainitur) >= 2007;


SELECT
	f.coddis AS 'disciplina'
	,f.verdis AS 'versao_disciplina'
	,f.codtur AS 'turma'
	,COUNT(*) AS 'numero_alunos_cursou'
	,(COUNT(CASE WHEN f.rstfim = 'A' THEN 1 END) * 100 / COUNT(*))  AS 'aprovados_pct'
	,(COUNT(CASE WHEN f.rstfim = 'T' THEN 1 END) * 100 / COUNT(*))  AS 'tracamentos_pct'
	,(COUNT(CASE WHEN f.rstfim = 'RN' THEN 1 END) * 100 / COUNT(*)) AS 'reprov_nota_pct'
	,(COUNT(CASE WHEN f.rstfim = 'RF' THEN 1 END) * 100 / COUNT(*))  AS 'reprov_freq_pct'
	,(COUNT(CASE WHEN f.rstfim = 'RA' THEN 1 END) * 100 / COUNT(*))  AS 'reprov_ambos_pct'
INTO #resultados_finais
FROM #filtered_notas f
WHERE f.rstfim IS NOT NULL
GROUP BY f.coddis, f.verdis, f.codtur;


SELECT
	f.coddis AS 'disciplina'
	,f.verdis AS 'versao_disciplina'
	,f.codtur AS 'turma'
	,COUNT(*) AS 'numero_alunos_finalizou'
	,ROUND(AVG(f.frqfim), 1) AS 'frequencia_media'
	,ROUND(AVG(f.max_nota), 1) AS 'nota_media'
INTO #medias
FROM #filtered_notas f
WHERE f.max_nota IS NOT NULL AND f.max_nota <> 0
GROUP BY f.coddis, f.verdis, f.codtur;


SELECT 
	m.disciplina
	,m.versao_disciplina
	,m.turma
	,r.numero_alunos_cursou
	,r.aprovados_pct
	,r.tracamentos_pct
	,r.reprov_nota_pct
	,r.reprov_freq_pct
	,r.reprov_ambos_pct
	,m.numero_alunos_finalizou
	,m.frequencia_media
	,m.nota_media
INTO #consolidacao_turma
FROM #resultados_finais r
	LEFT JOIN #medias m
		ON m.disciplina = r.disciplina 
			AND m.versao_disciplina = r.versao_disciplina 
			AND m.turma = r.turma


-- Drop all unnecessary temp tables
DROP TABLE #filtered_notas;
DROP TABLE #resultados_finais;
DROP TABLE #medias;