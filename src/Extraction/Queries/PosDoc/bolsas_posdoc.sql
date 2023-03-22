SELECT
	ppf.anoprj AS 'ano_projeto'
	,ppf.codprj AS 'codigo_projeto'
	,ppf.numseq_pd AS 'sequencia_periodo'
	,ppf.numseqfom AS 'sequencia_fomento'
	,ppf.codpgmfcm AS 'codigo_fomento'
	,CASE
		WHEN ppf.codpgmfcm IS NULL
			THEN ppf.nomagefom
		ELSE ppfom.nompgmfcm
	END AS 'nome_fomento'
	,ppf.dtainifom AS 'data_inicio_fomento'
	,ppf.dtafimfom AS 'data_fim_fomento'
	,ppf.idfprofom AS 'id_fomento'
FROM PDPROGRAMAFOMENTO ppf
	LEFT JOIN PROPESQFOMENTO ppfom ON ppf.codpgmfcm = ppfom.codpgmfcm
	LEFT JOIN PDPROJETO prj ON ppf.anoprj = prj.anoprj AND ppf.codprj = prj.codprj 
WHERE YEAR(prj.dtainiprj) >= 2007