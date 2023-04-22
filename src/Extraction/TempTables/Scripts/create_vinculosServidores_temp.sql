SELECT 	
    v.codpes AS 'numero_usp'
	,v.numseqpes AS 'sequencia_vinculo'
	,CASE
        WHEN v.tipfnc = 'Docente'
            THEN 'Docente'
        ELSE v.tipvin
        END AS 'vinculo'
    ,v.sitatl AS 'situacao_atual'
	,v.dtainivin AS 'data_inicio_vinculo'
	,v.dtafimvin AS 'data_fim_vinculo'
    ,v.codset AS 'cod_ultimo_setor'
	,s.nomset AS 'nome_ultimo_setor'
    ,CASE
        WHEN v.tipvin = 'SERVIDOR' AND v.tipfnc <> 'Docente'
            THEN v.nomabvcla
        ELSE v.nomabvfnc
        END AS 'classe'
	,v.nivgrupvm AS 'referencia'
    ,v.tipmer AS 'merito'
    ,v.tipfnc AS 'ambito_funcao'
    ,v.tipjor AS 'tipo_jornada'
    ,v.tiping AS 'tipo_ingresso'
    ,v.dtainisitfun AS 'data_ultima_alteracao_funcional'
    ,CASE
		WHEN v.sitatl <> 'A' THEN v.sitoco
		ELSE NULL
		END AS 'ultima_ocorrencia'
    ,CASE
		WHEN v.sitatl <> 'A' THEN v.dtainisitoco
		ELSE NULL
		END AS 'data_inicio_ultima_ocorrencia'
INTO #filtered_servidores
FROM VINCULOPESSOAUSP v
	LEFT JOIN SETOR s ON v.codset = s.codset
WHERE v.tipvin IN ('SERVIDOR', 'ESTAGIARIO', 'ESTAGIARIORH', 'ESTAGIARIOPOS') 
	AND v.codfusclgund = 8;


--
SELECT f.*
INTO #vinculos_funcionarios
FROM #filtered_servidores f
	INNER JOIN ( -- limit 1 row for each employee (per last `dtainivin`)
				SELECT f2.numero_usp, f2.vinculo, MAX(f2.data_inicio_vinculo) AS 'ultimo_inicio'
				FROM #filtered_servidores f2 
				GROUP BY f2.numero_usp, f2.vinculo
				) f2 ON f.numero_usp = f2.numero_usp AND f.vinculo = f2.vinculo AND f.data_inicio_vinculo = f2.ultimo_inicio
WHERE f.vinculo <> 'Docente';


--
SELECT f.*
INTO #vinculos_docentes
FROM #filtered_servidores f
	INNER JOIN ( -- limit 1 row for each professor (per last `data_inicio_vinculo`)
				SELECT f2.numero_usp, f2.vinculo, MAX(f2.data_inicio_vinculo) AS 'ultimo_inicio'
				FROM #filtered_servidores f2 
				GROUP BY f2.numero_usp, f2.vinculo
				) f2 ON f.numero_usp = f2.numero_usp AND f.vinculo = f2.vinculo AND f.data_inicio_vinculo = f2.ultimo_inicio
WHERE f.vinculo = 'Docente';


--
SELECT *
INTO #vinculos_servidores
FROM (
    SELECT * FROM #vinculos_docentes
    UNION
    SELECT * FROM #vinculos_funcionarios
) un;


-- Drop all unnecessary temp tables
DROP TABLE #filtered_servidores;
DROP TABLE #vinculos_funcionarios;
DROP TABLE #vinculos_docentes;
