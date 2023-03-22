SELECT
	pgm.anoprj AS 'ano_projeto'
	,pgm.codprj AS 'codigo_projeto'
	,pgm.numseq_pd AS 'sequencia_periodo'
	,pgm.dtainipgm_pd AS 'data_inicio_periodo'
	,pgm.dtafimpgm_pd AS 'data_fim_periodo'
	,pgm.stapgm_pd AS 'situacao_periodo'
	,CASE
		WHEN ppf.numseqfom IS NOT NULL THEN 'Bolsa'
		WHEN ppv.numseqvinepr IS NOT NULL THEN 'Afastamento Empregatício'
		ELSE 'Sem Bolsa'
	END AS 'fonte_recurso'
	,pgm.numhorsmn AS 'horas_semanais'
FROM PDPROGRAMA pgm
	LEFT JOIN PDPROGRAMAFOMENTO ppf ON pgm.anoprj = ppf.anoprj AND pgm.codprj = ppf.codprj AND pgm.numseq_pd = ppf.numseq_pd
	LEFT JOIN PDPROGRAMAVINCEMPRESA ppv ON pgm.anoprj = ppv.anoprj AND pgm.codprj = ppv.codprj AND pgm.numseq_pd = ppv.numseq_pd
	LEFT JOIN PDPROJETO prj ON pgm.anoprj = prj.anoprj AND pgm.codprj = prj.codprj 
WHERE YEAR(prj.dtainiprj) >= 2007