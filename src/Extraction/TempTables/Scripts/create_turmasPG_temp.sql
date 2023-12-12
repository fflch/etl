-- Filter students enrolled (or pre-enrolled) in FFLCH graduate classes
SELECT
	rpg.*
INTO
	#all_preenrollments
FROM
	R41PGMMATTUR rpg
LEFT JOIN
	SETOR s
		ON s.nomabvset = LEFT(rpg.sgldis, 3)
		AND s.codund = 8 
		AND s.tipset = 'Departamento de Ensino'
WHERE
	(s.nomabvset IS NOT NULL OR LEFT(rpg.sgldis, 3) = 'HDL');


-- Filter classes that started before 2007 and those that were canceled
SELECT
	a.*
INTO
	#filtered_preenrollments
FROM 
	#all_preenrollments a
LEFT JOIN
	OFERECIMENTO o
		ON a.sgldis = o.sgldis
		AND a.numseqdis = o.numseqdis
		AND a.numofe = o.numofe
WHERE
	YEAR(o.dtainiofe) >= 2007
	AND o.dtacantur IS NULL;


-- Get unique pre-enrollments and enrollments (filters credit transfers)
SELECT
	f.sgldis AS 'codigo_disciplina'
 	,f.numseqdis AS 'versao_disciplina'
 	,f.numofe AS 'codigo_turma'
	,f.codpes AS 'numero_usp'
	,MAX(f.stamtrpgmofe) AS 'situacao_matricula'
	,MIN(f.cctpgmofe) AS 'conceito_final'
	,MAX(f.frqpgmofe) AS 'frequencia_final'
	-- gambi ¯\_(ツ)_/¯
	,SUM(
		CASE
			WHEN (f.staaprpgmofe IN ('U') AND f.statrf = 'S' AND (f.codare BETWEEN 8000 AND 8999)) THEN 4
			WHEN (f.staaprpgmofe IN ('U') AND (f.codare BETWEEN 8000 AND 8999)) THEN 3
			WHEN (f.staaprpgmofe IN ('N', 'D') AND (f.codare BETWEEN 8000 AND 8999)) THEN 1
			ELSE 0 END
		) AS 'enquanto_area_fflch'
	,SUM(
		CASE
			WHEN (f.staaprpgmofe IN ('U') AND f.statrf = 'S' AND (f.codare NOT BETWEEN 8000 AND 8999)) THEN 4
			WHEN (f.staaprpgmofe IN ('U') AND (f.codare NOT BETWEEN 8000 AND 8999)) THEN 3
			WHEN (f.staaprpgmofe IN ('N', 'D') AND (f.codare NOT BETWEEN 8000 AND 8999)) THEN 1
			ELSE 0 END
		) AS 'fora_area_fflch'
INTO
	#unique_preenrollments
FROM
	#filtered_preenrollments f
GROUP BY
	f.sgldis
	,f.numseqdis
	,f.numofe
	,f.codpes;


-- Get classes attendance rate (filtering those students who have never attended the class)
SELECT
	u.codigo_disciplina
	,u.versao_disciplina
	,u.codigo_turma
	,ROUND(AVG(u.frequencia_final), 1) AS 'frequencia_media'
INTO
	#attendance_rate
FROM
	#unique_preenrollments u
WHERE
	u.frequencia_final > 0
GROUP BY 
	u.codigo_disciplina
	,u.versao_disciplina
	,u.codigo_turma;


-- Get enrollment status between all unique (pre)enrollments
SELECT
	u.codigo_disciplina
 	,u.versao_disciplina
 	,u.codigo_turma
	,COUNT(*) AS 'num_inscritos'
 	,COUNT(CASE WHEN u.situacao_matricula = 'D' THEN 1 END) AS 'num_matriculas_deferidas'
 	,COUNT(CASE WHEN u.situacao_matricula = 'I' THEN 1 END) AS 'num_matriculas_indeferidas'
	,COUNT(CASE WHEN u.situacao_matricula = 'C' THEN 1 END) AS 'num_matriculas_canceladas'
INTO
	#preenrolled_stats
FROM
	#unique_preenrollments u
GROUP BY 
	u.codigo_disciplina
	,u.versao_disciplina
	,u.codigo_turma;


-- Get enrollment stats between those who effectively enrolled
SELECT
	u.codigo_disciplina
	,u.versao_disciplina
	,u.codigo_turma
	,(COUNT(CASE WHEN u.conceito_final IN ('A', 'B', 'C') THEN 1 END) * 100 / p.num_matriculas_deferidas) AS 'aprovacao_pct'
	,(COUNT(CASE WHEN u.conceito_final IN ('R') THEN 1 END) * 100 / p.num_matriculas_deferidas) AS 'reprovacao_pct'
	,(COUNT(CASE WHEN u.conceito_final IS NULL THEN 1 END) * 100 / p.num_matriculas_deferidas) AS 'pendencia_pct'
	,(COUNT(CASE WHEN u.enquanto_area_fflch > u.fora_area_fflch THEN 1 END) * 100 / p.num_matriculas_deferidas) AS 'alunos_fflch_pct'
	,(COUNT(CASE WHEN u.enquanto_area_fflch < u.fora_area_fflch THEN 1 END) * 100 / p.num_matriculas_deferidas) AS 'alunos_externos_pct'
INTO
	#enrolled_stats
FROM
	#unique_preenrollments u
INNER JOIN
	#preenrolled_stats p
		ON p.codigo_disciplina = u.codigo_disciplina
		AND p.versao_disciplina = u.versao_disciplina
		AND p.codigo_turma = u.codigo_turma
WHERE
	u.situacao_matricula = 'D'
GROUP BY 
	u.codigo_disciplina
	,u.versao_disciplina
	,u.codigo_turma
	,p.num_matriculas_deferidas;


-- Now let's join all of those
SELECT
	p.codigo_disciplina
	,p.versao_disciplina
	,p.codigo_turma
	,p.num_inscritos
	,p.num_matriculas_deferidas
	,p.num_matriculas_indeferidas
	,p.num_matriculas_canceladas
	,a.frequencia_media
	,e.aprovacao_pct
	,e.reprovacao_pct
	,e.pendencia_pct
	,e.alunos_fflch_pct
	,e.alunos_externos_pct
INTO
	#final_enrollment_stats
FROM 
	#preenrolled_stats p
LEFT JOIN
	#enrolled_stats e
		ON e.codigo_disciplina = p.codigo_disciplina
		AND e.versao_disciplina = p.versao_disciplina
		AND e.codigo_turma = p.codigo_turma
LEFT JOIN
	#attendance_rate a
		ON a.codigo_disciplina = p.codigo_disciplina
		AND a.versao_disciplina = p.versao_disciplina
		AND a.codigo_turma = p.codigo_turma;


--
SELECT
	o.sgldis AS 'codigo_disciplina'
	,o.numseqdis AS 'versao_disciplina'
	,o.numofe AS 'codigo_turma'
	,o.dtainiofe AS 'data_inicio_turma'
	,o.dtafimofe AS 'data_fim_turma'
	,o.numvagofe AS 'vagas_regulares'
	,o.numvagespofe AS 'vagas_especiais'
	,o.numvagofetot AS 'vagas_total'
	,f.num_inscritos
	,f.num_matriculas_deferidas
	,f.num_matriculas_indeferidas
	,f.num_matriculas_canceladas
	,CASE o.stacslofe
		WHEN 'N' THEN NULL
		ELSE o.stacslofe
		END AS 'consolidacao_turma'
	,o.stacslcct AS 'consolidacao_resultados'
	,o.dtacantur AS 'data_cancelamento'
	,t.dscmotcantur AS 'motivo_cancelamento'
	,f.frequencia_media
	,f.aprovacao_pct
	,f.reprovacao_pct
	,f.pendencia_pct
	,f.alunos_fflch_pct
	,f.alunos_externos_pct
	,o.codare AS 'codigo_area'
	,o.codcvn AS 'codigo_convenio'
	,o.nivcvn AS 'nivel_convenio'
	,i.dsclin AS 'lingua_turma'
	,CASE o.fmtofe 
		WHEN 'P' THEN 'Presencial'
		WHEN 'N' THEN 'Remoto'
		WHEN 'H' THEN 'Híbrido'
		END AS 'formato_oferecimento'
INTO
	#enrollments_info
FROM
	OFERECIMENTO o
LEFT JOIN
	#final_enrollment_stats f
		ON f.codigo_disciplina = o.sgldis
		AND f.versao_disciplina = o.numseqdis
		AND f.codigo_turma = o.numofe
LEFT JOIN
	IDIOMA i
		ON i.codlin = o.codlinofe
LEFT JOIN
	TIPOMOTCANCTURMA t
		ON t.tipmotcantur = o.tipmotcantur
LEFT JOIN
	SETOR s
		ON s.nomabvset = LEFT(o.sgldis, 3)
		AND s.codund = 8 
		AND s.tipset = 'Departamento de Ensino'
WHERE
	YEAR(o.dtainiofe) >= 2007
	AND (s.nomabvset IS NOT NULL OR LEFT(o.sgldis, 3) = 'HDL');


--
SELECT
	e.*
	,CASE
		WHEN e.data_cancelamento IS NOT NULL THEN 'Cancelada'
		WHEN e.consolidacao_resultados = 'S' THEN 'Encerrada'
		WHEN e.data_inicio_turma > GETDATE() THEN 'Programada'
		WHEN e.data_fim_turma >= GETDATE() THEN 'Ativa'
		ELSE 'Aberta'
		END AS 'situacao_turma'
INTO
	#turmas_posgraduacao
FROM 
	#enrollments_info e;


-- Cleaning table
UPDATE #turmas_posgraduacao
SET consolidacao_turma = NULL, consolidacao_resultados = NULL
WHERE situacao_turma = 'Cancelada';


-- Drop all tables that won't be needed
DROP TABLE #all_preenrollments;
DROP TABLE #filtered_preenrollments;
DROP TABLE #unique_preenrollments;
DROP TABLE #attendance_rate;
DROP TABLE #preenrolled_stats;
DROP TABLE #enrolled_stats;
DROP TABLE #final_enrollment_stats;