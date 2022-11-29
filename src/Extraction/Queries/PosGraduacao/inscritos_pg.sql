SELECT
	ai.codpes AS 'numeroUSP'
	,ai.numseqpgm AS 'seqPrograma'
	,ai.codare AS 'codigoArea'
	,ai.dtainsare AS 'dataInscricao'
	,CASE
		WHEN ai.stadoudto IS NULL OR ai.stadoudto = 'N' THEN ai.nivare
		WHEN ai.stadoudto = 'S' THEN 'DD'
	END AS 'nivelInscricao'
	,ai.staselare AS 'resultadoInscricao'
FROM AGINSCRICAO ai
WHERE ai.codare BETWEEN 8000 AND 9000
	AND YEAR(ai.dtainsare) >= 2007