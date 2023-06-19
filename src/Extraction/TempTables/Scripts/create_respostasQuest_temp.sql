SELECT
	p.codpes AS 'numero_usp'
	,p.codpgm AS 'sequencia_curso'
	,r.codqtn AS 'codigo_questionario'
	,r.codqst AS 'codigo_questao'
	,r.numatnqst AS 'alternativa_escolhida'
INTO #respostasQuest
FROM PROGRAMAGR p
	LEFT JOIN RESPOSTASQUESTAO r ON p.codpes = r.codpes
	INNER JOIN QUESTIONARIO q ON (r.codqtn = q.codqtn AND p.dtaing BETWEEN q.dtainiqtn AND q.dtafimqtn)
	--Filter:
	INNER JOIN (
				SELECT hp.codpes, hp.codpgm
				FROM HABILPROGGR hp
					INNER JOIN (
						SELECT hp2.codpes AS 'codpes', hp2.codpgm as 'codpgm', MAX(hp2.dtaini) AS 'ultimoBA'
						FROM HABILPROGGR hp2
							LEFT JOIN HABILITACAOGR hg ON (hp2.codcur = hg.codcur AND hp2.codhab = hg.codhab)
						WHERE hg.tiphab <> 'L'
						GROUP BY hp2.codpes, hp2.codpgm) jn
							ON (jn.codpes = hp.codpes AND jn.ultimoBA = hp.dtaini)
					INNER JOIN PROGRAMAGR p ON (hp.codpes = p.codpes AND hp.codpgm = p.codpgm)
					LEFT JOIN HABILITACAOGR hg ON (hp.codcur = hg.codcur AND hp.codhab = hg.codhab)
				WHERE hp.codcur BETWEEN 8000 and 8999
					AND hg.tiphab <> 'L'
					AND YEAR(p.dtaing) >= 2007
			   ) ij ON p.codpes = ij.codpes AND p.codpgm = ij.codpgm;