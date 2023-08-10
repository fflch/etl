SELECT
	o.sgldis AS 'codigo_disciplina'
	,o.numseqdis AS 'versao_disciplina'
	,o.numofe AS 'sequencia_turma'
	,o.numvagofe AS 'vagas_regulares'
	,o.numvagespofe AS 'vagas_especiais'
	,o.numvagofetot AS 'vagas_total'
	,o.dtainiofe AS 'data_inicio_turma'
	,o.dtafimofe AS 'data_fim_turma'
	,o.stacslofe AS 'consolidacao_turma'
	,o.stacslcct AS 'consolidacao_resultados'
	,o.codare AS 'codigo_area'
	,o.codcvn AS 'codigo_convenio'
	,o.nivcvn AS 'nivel_convenio'
	,o.dtacantur AS 'data_cancelamento'
	,t.dscmotcantur AS 'motivo_cancelamento'
	,i.dsclin AS 'lingua_turma'
	,CASE o.fmtofe 
		WHEN 'P' THEN 'Presencial'
		WHEN 'N' THEN 'Remoto'
		WHEN 'H' THEN 'Híbrido'
		END AS 'formato_oferecimento'
FROM OFERECIMENTO o
	LEFT JOIN IDIOMA i
		ON i.codlin = o.codlinofe
	LEFT JOIN TIPOMOTCANCTURMA t
		ON t.tipmotcantur = o.tipmotcantur
	LEFT JOIN SETOR s
		ON s.nomabvset = LEFT(o.sgldis, 3)
			AND s.codund = 8 
			AND s.tipset = 'Departamento de Ensino'
WHERE (s.nomabvset IS NOT NULL OR LEFT(o.sgldis, 3) = 'HDL')