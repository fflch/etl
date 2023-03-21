SELECT 			
	ap.codpes AS 'numero_usp'
	,ap.numseqpgm AS 'seq_programa'
	,ap.codare AS 'codigo_area'
	,n.nomare AS 'nome_area'
	,a.codcur AS 'codigo_programa'
	,n2.nomcur AS 'nome_programa'
	,ap.dtaselpgm AS 'data_selecao'
	,jn.primeira_ocorrencia AS 'primeira_matricula'
	,jn3.tiphstpgm AS 'tipo_ultima_ocorrencia'
	,jn3.dtaocopgm AS 'data_ultima_ocorrencia'
	,ap.nivpgm AS 'nivel_programa'
	,ap.dtadpopgm AS 'data_deposito_trabalho'
	,ap.dtaaprbantrb AS 'data_aprovacao_trabalho'
FROM AGPROGRAMA ap
	LEFT JOIN
		(SELECT 
			h2.codpes AS 'numero_usp'
			,h2.numseqpgm AS 'seq_programa'
			,h2.codare AS 'codigo_area'
			,MIN(h2.dtaocopgm) AS 'primeira_ocorrencia'
		FROM HISTPROGRAMA h2
		WHERE h2.tiphstpgm = 'MAR'
		GROUP BY h2.codpes, h2.numseqpgm, h2.codare) jn
			ON jn.numero_usp = ap.codpes 
				AND jn.seq_programa = ap.numseqpgm
				AND jn.codigo_area = ap.codare
	LEFT JOIN (SELECT
					h3.codpes
					,h3.numseqpgm
					,h3.codare
					,h3.dtaocopgm
					,h3.tiphstpgm
				FROM HISTPROGRAMA h3
					INNER JOIN (SELECT 
									h2.codpes AS 'numero_usp'
									,h2.numseqpgm AS 'seq_programa'
									,h2.codare AS 'codigo_area'
									,MAX(h2.dtaocopgm) AS 'ultima_ocorrencia'
										FROM HISTPROGRAMA h2
										GROUP BY h2.codpes, h2.numseqpgm, h2.codare) jn2
											ON jn2.numero_usp = h3.codpes
												AND jn2.seq_programa = h3.numseqpgm
												AND jn2.codigo_area = h3.codare
												AND jn2.ultima_ocorrencia = h3.dtaocopgm
				) jn3 											
					ON jn3.codpes = ap.codpes
						AND jn3.numseqpgm = ap.numseqpgm
						AND jn3.codare = ap.codare
		LEFT JOIN NOMEAREA n
			ON ap.codare = n.codare
				AND ap.dtaselpgm >= n.dtainiare 
				AND (n.dtafimare >= ap.dtaselpgm OR n.dtafimare IS NULL)
		LEFT JOIN AREA a
			ON ap.codare = a.codare
		LEFT JOIN NOMECURSO n2
			ON a.codcur = n2.codcur
				AND ap.dtaselpgm >= n2.dtainicur
				AND (n2.dtafimcur >= ap.dtaselpgm OR n2.dtafimcur IS NULL)
WHERE YEAR(ap.dtaselpgm) >= 2007
	AND ap.codare BETWEEN 8000 AND 9000
	AND ap.vinalupgm = 'REGULAR'