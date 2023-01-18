SELECT
	ppf.anoprj AS 'anoProjeto'
	,ppf.codprj AS 'codigoProjeto'
	,ppf.numseq_pd AS 'sequenciaPeriodo'
	,ppf.numseqfom AS 'sequenciaFomento'
	,ppf.codpgmfcm AS 'codigoFomento'
	,CASE
		WHEN ppf.codpgmfcm IS NULL
			THEN ppf.nomagefom
		ELSE ppfom.nompgmfcm
	END AS 'nomeFomento'
	,ppf.dtainifom AS 'dataInicioFomento'
	,ppf.dtafimfom AS 'dataFimFomento'
	,ppf.idfprofom AS 'idFomento'
FROM PDPROGRAMAFOMENTO ppf
	LEFT JOIN PROPESQFOMENTO ppfom ON ppf.codpgmfcm = ppfom.codpgmfcm
	LEFT JOIN PDPROJETO prj ON ppf.anoprj = prj.anoprj AND ppf.codprj = prj.codprj 
WHERE YEAR(prj.dtainiprj) >= 2007