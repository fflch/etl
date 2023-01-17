SELECT
	pgm.anoprj AS 'anoProjeto'
	,pgm.codprj AS 'codigoProjeto'
	,pgm.numseq_pd AS 'sequenciaPeriodo'
	,pgm.dtainipgm_pd AS 'dataInicioPeriodo'
	,pgm.dtafimpgm_pd AS 'dataFimPeriodo'
	,pgm.stapgm_pd AS 'situacaoPeriodo'
	,CASE
		WHEN ppf.numseqfom IS NOT NULL THEN 'Bolsa'
		WHEN ppv.numseqvinepr IS NOT NULL THEN 'Afastamento Empregatício'
		ELSE 'Sem Bolsa'
	END AS 'fonteRecurso'
	,pgm.numhorsmn AS 'horasSemanais'
FROM PDPROGRAMA pgm
	LEFT JOIN PDPROGRAMAFOMENTO ppf ON pgm.anoprj = ppf.anoprj AND pgm.codprj = ppf.codprj AND pgm.numseq_pd = ppf.numseq_pd
	LEFT JOIN PDPROGRAMAVINCEMPRESA ppv ON pgm.anoprj = ppv.anoprj AND pgm.codprj = ppv.codprj AND pgm.numseq_pd = ppv.numseq_pd
	LEFT JOIN PDPROJETO prj ON pgm.anoprj = prj.anoprj AND pgm.codprj = prj.codprj 
WHERE YEAR(prj.dtainiprj) >= 2007