SELECT
	pve.anoprj AS 'ano_projeto'
	,pve.codprj AS 'codigo_projeto'
	,pve.numseq_pd AS 'sequencia_periodo'
	,pve.numseqvinepr AS 'seq_vinculo_empresa'
	,pve.nomrazsocepr AS 'nome_empresa'
	,pve.dtainiafaepr AS 'data_inicio_afastamento'
	,pve.dtafimafaepr AS 'data_fim_afastamento'
	,pve.tipvinepd_pd AS 'tipo_vinculo'
FROM dbo.PDPROGRAMAVINCEMPRESA pve
	LEFT JOIN PDPROJETO prj ON pve.anoprj = prj.anoprj AND pve.codprj = prj.codprj 
WHERE YEAR(prj.dtainiprj) >= 2007