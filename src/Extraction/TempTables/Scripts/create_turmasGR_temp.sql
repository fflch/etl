-- Filter students enrolled in FFLCH courses dated > 2007
SELECT
	h.coddis AS 'codigo_disciplina'
	,h.verdis AS 'versao_disciplina'
	,h.codtur AS 'codigo_turma'
	,CASE
		WHEN h.notfim >= 3 AND h.notfim < 5 AND h.frqfim >= 70
			THEN 'S'
		ELSE NULL 
		END AS 'recuperacao'
	,CASE
		WHEN h.rstfim IS NOT NULL AND h.notfim2 IS NOT NULL
			THEN h.notfim2
		WHEN h.rstfim IS NOT NULL AND h.notfim IS NOT NULL 
			THEN h.notfim
		ELSE NULL END AS 'nota_final'
	,CASE
		WHEN h.rstfim IS NOT NULL
		THEN h.frqfim
		ELSE NULL END AS 'frequencia_final'
	,h.rstfim AS 'resultado_final'
INTO #filtered_results
FROM HISTESCOLARGR h
	LEFT JOIN TURMAGR t ON h.coddis = t.coddis AND h.verdis = t.verdis AND h.codtur = t.codtur
	LEFT JOIN DISCIPGRCODIGO d ON h.coddis = d.coddis
WHERE d.codclg = 8
	AND YEAR(t.dtainitur) >= 2007
	AND h.stamtr = 'M';


-- Consolidate final results
SELECT
	f.codigo_disciplina
	,f.versao_disciplina
	,f.codigo_turma
	,COUNT(*) AS 'numero_alunos_matriculados'
	,(COUNT(CASE WHEN f.recuperacao = 'S' THEN 1 END) * 100 / COUNT(*))  AS 'recuperacao_pct'
	,(COUNT(CASE WHEN f.resultado_final = 'A' THEN 1 END) * 100 / COUNT(*))  AS 'aprovados_pct'
	,(COUNT(CASE WHEN f.resultado_final = 'T' THEN 1 END) * 100 / COUNT(*))  AS 'trancamentos_pct'
	,(COUNT(CASE WHEN f.resultado_final = 'RN' THEN 1 END) * 100 / COUNT(*)) AS 'reprov_nota_pct'
	,(COUNT(CASE WHEN f.resultado_final = 'RF' THEN 1 END) * 100 / COUNT(*))  AS 'reprov_freq_pct'
	,(COUNT(CASE WHEN f.resultado_final = 'RA' THEN 1 END) * 100 / COUNT(*))  AS 'reprov_ambos_pct'
	,(COUNT(CASE WHEN f.resultado_final IS NULL THEN 1 END) * 100 / COUNT(*))  AS 'result_pendente_pct'
INTO #consolidated_results
FROM #filtered_results f
GROUP BY f.codigo_disciplina, f.versao_disciplina, f.codigo_turma;


-- Calculates the average among students who have finished the course with final grade > 0
SELECT
	f.codigo_disciplina
	,f.versao_disciplina
	,f.codigo_turma
	,ROUND(AVG(f.frequencia_final), 1) AS 'frequencia_media'
	,ROUND(AVG(f.nota_final), 1) AS 'nota_media'
INTO #averages
FROM #filtered_results f
WHERE f.nota_final IS NOT NULL AND f.nota_final > 0
GROUP BY f.codigo_disciplina, f.versao_disciplina, f.codigo_turma;


-- Join consolidated_results and averages
SELECT 
	c.codigo_disciplina
	,c.versao_disciplina
	,c.codigo_turma
	,c.numero_alunos_matriculados
	,c.recuperacao_pct
	,c.aprovados_pct
	,c.trancamentos_pct
	,c.reprov_nota_pct
	,c.reprov_freq_pct
	,c.reprov_ambos_pct
	,c.result_pendente_pct
	,a.frequencia_media
	,a.nota_media
INTO #consolidated_classes
FROM #consolidated_results c
	LEFT JOIN #averages a
		ON a.codigo_disciplina = c.codigo_disciplina 
			AND a.versao_disciplina = c.versao_disciplina 
			AND a.codigo_turma = c.codigo_turma


-- Get some other classes' info
SELECT
	t.coddis AS 'codigo_disciplina'
	,t.verdis AS 'versao_disciplina'
	,t.codtur AS 'codigo_turma'
	,t.tiptur AS 'tipo_turma'
	,t.dtacritur AS 'data_criacao_turma'
	,t.dtainitur AS 'data_inicio_aulas'
	,t.dtafimtur AS 'data_fim_aulas'
	,t.statur AS 'status_turma'
	,t.cgahorteo AS 'carga_horaria_teorica'
	,t.cgahorpra AS 'carga_horaria_pratica'
	,c.numero_alunos_matriculados
	,c.trancamentos_pct
	,c.result_pendente_pct
	,c.frequencia_media
	,c.nota_media
	,c.recuperacao_pct
	,c.aprovados_pct
	,c.reprov_nota_pct
	,c.reprov_freq_pct
	,c.reprov_ambos_pct
INTO #turmas_graduacao
FROM TURMAGR t
	LEFT JOIN DISCIPGRCODIGO d ON t.coddis = d.coddis
	LEFT JOIN #consolidated_classes c 
		ON t.coddis = c.codigo_disciplina 
			AND t.verdis = c.versao_disciplina 
			AND t.codtur = c.codigo_turma
WHERE d.codclg = 8
	AND YEAR(t.dtainitur) >= 2007
ORDER BY t.coddis, t.verdis, t.codtur


-- Drop all tables that won't be needed
DROP TABLE #enrolled;
DROP TABLE #filtered_results;
DROP TABLE #consolidated_results;
DROP TABLE #averages;
DROP TABLE #consolidated_classes;