SELECT * 
FROM (
		SELECT
			m.codpes AS 'numero_usp'
			,m.coddis AS 'codigo_disciplina'
			,m.verdis AS 'versao_disciplina'
			,m.codtur AS 'codigo_turma'
			,MAX(m.stamis) AS 'periodicidade_ministrante'
		FROM MINISTRANTE m
			LEFT JOIN DISCIPGRCODIGO d ON m.coddis = d.coddis
		WHERE d.codclg = 8
			AND YEAR(m.dtainiaul) >= 2007
		GROUP BY m.coddis, m.verdis, m.codtur, m.codpes
	  ) l
ORDER BY l.codigo_disciplina, l.versao_disciplina, l.codigo_turma, l.numero_usp
-- Não pega disciplinas ministradas por docentes da FFLCH fora da unidade