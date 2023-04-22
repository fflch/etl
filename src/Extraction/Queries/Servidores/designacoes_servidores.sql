SELECT
	v.codpes AS 'numero_usp'
	,v.numseqpes AS 'sequencia_vinculo'
	,CASE
        WHEN v2.tipfnc = 'Docente'
            THEN 'Docente'
        ELSE v.tipvin
        END AS 'vinculo'
	,v.dtainidsg AS 'data_inicio_designacao'
	,v.dtafimdsg AS 'data_fim_designacao'
	,v.codsetdsg AS 'codigo_setor_designacao'
	,s.nomset AS 'nome_setor_designacao'
	,v.nomfncetr AS 'nome_funcao'
	,v.tipsbnogn AS 'tipo_designacao'
FROM VINCSATDESIGNACAO v
	LEFT JOIN VINCULOPESSOAUSP v2 ON v.codpes = v2.codpes AND v2.tipvin = 'SERVIDOR'
	LEFT JOIN SETOR s ON v.codsetdsg = s.codset