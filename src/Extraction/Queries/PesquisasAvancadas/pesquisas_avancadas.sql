SELECT
	pd.anoprj AS 'ano_projeto'
	,pd.codprj AS 'codigo_projeto'
	,pd.codmdl AS 'codigo_modalidade'
	,pd.codpes_pd AS 'numero_usp'
	,CASE
		WHEN pd.dtainiprj > GETDATE()
			THEN 'Programado'
		ELSE pd.staatlprj 
		END AS 'situacao_projeto'
	,pd.dtainiprj AS 'data_inicio_projeto'
	,pd.dtafimprj AS 'data_fim_projeto'
	,pti.dsctipifm AS 'motivo_cancelamento'
	,pd.epfmotcan AS 'descricao_cancelamento'
	,pd.codsetprj AS 'codigo_departamento'
    ,s.nomset AS 'nome_departamento'
	,pd.titprj AS 'titulo_projeto'
	,a.nomarecnh AS 'area_cnpq'
	,pd.palcha1 AS 'palcha_1'  
	,pd.palcha2 AS 'palcha_2' 
	,pd.palcha3 AS 'palcha_3'
FROM PDPROJETO pd
    LEFT JOIN SETOR s ON pd.codsetprj = s.codset
	LEFT JOIN PDTIPOINFO pti ON pd.codmotcan = pti.codtipifm
	LEFT JOIN AREACONHECIMENTOCNPQ a ON pd.codarecnhcpq = a.codarecnhcpq
WHERE pd.codund = 8
	AND YEAR(pd.dtainiprj) >= 2007