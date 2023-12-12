SELECT
	i.codpes AS 'numero_usp'
	,i.numseqpgm AS 'seq_programa'
	,i.codare AS 'codigo_area'
	,CASE
		WHEN dtainibol < GETDATE() AND dtafimbol >= GETDATE()
			THEN 'Ativa'
		WHEN dtainibol < GETDATE() AND dtafimbol < GETDATE()
			THEN 'Encerrada'
		ELSE 'Programada' END AS 'situacao_bolsa'
	,i.dtainibol AS 'data_inicio_bolsa'
	,i.dtafimbol AS 'data_fim_bolsa'
	,i.codittfom AS 'codigo_instituicao_fomento'
	,i2.sglittfom AS 'sigla_instituicao_fomento'
	,i2.nomittfom AS 'nome_instituicao_fomento'
	,i.codpgmfom  AS 'codigo_programa_fomento'
	,i3.nompgmfom AS 'nome_programa_fomento'
	,i.codbolfom AS 'codigo_bolsa_fomento'
FROM INSTITFOMENTOBOLSA i
	LEFT JOIN INSTITUICAOFOMENTO i2 ON i.codittfom = i2.codittfom
	LEFT JOIN INSTITFOMENTOPROG i3 ON i.codittfom = i3.codittfom AND i.codpgmfom = i3.codpgmfom
WHERE i.codare BETWEEN 8000 AND 8999
	AND i.anosem = (SELECT MAX(i.anosem) FROM INSTITFOMENTOBOLSA i)
	AND i.tipsitbol = 'ativa'