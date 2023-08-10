-- Get disciplinas PG
SELECT
	d.sgldis AS 'codigo_disciplina'
	,d.numseqdis AS 'versao_disciplina'
	,d.nomdis AS 'nome_disciplina'
	,CASE d.tipcurdis 
		WHEN 'POS' THEN 'Pós-graduação'
		WHEN 'ESP' THEN 'Especialização'
		WHEN 'APE' THEN 'Aperfeiçoamento'
		ELSE d.tipcurdis
		END AS 'tipo_curso'
	,CASE
		WHEN d.dtaatvdis IS NULL
			THEN 'Não ativada'
		WHEN d.dtaatvdis > GETDATE()
			THEN 'Futura'
		WHEN d.dtadtvdis < GETDATE()
			THEN 'Desativada'
		ELSE 'Ativa'
		END AS 'status_disciplina'
	,d.dtaprpdis AS 'data_proposicao_disciplina'
	,d.dtaatvdis AS 'data_ativacao_disciplina'
	,d.dtadtvdis AS 'data_desativacao_disciplina'
	,d.durdis AS 'duracao_disciplina_semanas'
	,d.cgahorteodis AS 'carga_horaria_teorica'
	,d.cgahorpradis AS 'carga_horaria_pratica'
	,d.cgahoresddis AS 'carga_horaria_estudo'
	,d.cgahordis AS 'carga_horaria_total'
	,d.numcretotdis AS 'total_creditos'
	,d.codare AS 'codigo_area'
	,CASE d.tipofedis  
		WHEN 'P' THEN 'Presencial'
		WHEN 'N' THEN 'Remoto'
		WHEN 'H' THEN 'Híbrido'
		END AS 'formato_disciplina'
INTO #disciplinaspg_temp
FROM DISCIPLINA d;


-- Filter
SELECT d.*, s.nomset AS 'departamento'
INTO #filtered_disciplinas
FROM #disciplinaspg_temp d
	LEFT JOIN SETOR s
		ON s.nomabvset = LEFT(d.codigo_disciplina, 3)
			AND s.codund = 8 
			AND s.tipset = 'Departamento de Ensino'
WHERE (s.nomabvset IS NOT NULL OR LEFT(d.codigo_disciplina, 3) = 'HDL');


-- Add area and program names
SELECT
    f.*
    ,a.nomare AS 'nome_area'
    ,a.codcur AS 'codigo_programa'
    ,p.nomcur AS 'nome_programa'
INTO #disciplinaspg_final
FROM #filtered_disciplinas f
    LEFT JOIN #areas a
        ON f.codigo_area = a.codare 
            AND f.data_proposicao_disciplina BETWEEN a.dtainiare AND a.dtafimare
    LEFT JOIN #programas p 
        ON a.codcur = p.codcur 
            AND f.data_proposicao_disciplina BETWEEN p.dtainicur AND p.dtafimcur;


--
UPDATE #disciplinaspg_final
SET codigo_area = NULL
WHERE data_proposicao_disciplina IS NULL;


-- Drop all unnecessary temp tables
DROP TABLE #disciplinaspg_temp;
DROP TABLE #filtered_disciplinas;