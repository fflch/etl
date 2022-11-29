SELECT 			
	ap.codpes AS 'numeroUSP'
	,ap.numseqpgm AS 'seqPrograma'
	,ap.codare AS 'codigoArea'
	,n.nomare AS 'nomeArea'
	,a.codcur AS 'codigoPrograma'
	,n2.nomcur AS 'nomePrograma'
	,ap.dtaselpgm AS 'dataSelecao'
	,jn.primeiraOcorrencia AS 'primeiraMatricula'
	,jn3.tiphstpgm AS 'tipoUltimaOcorrencia'
	,jn3.dtaocopgm AS 'dataUltimaOcorrencia'
	,ap.nivpgm AS 'nivelPrograma'
	,ap.dtadpopgm AS 'dataDepositoTrabalho'
	,ap.dtaaprbantrb AS 'dataAprovacaoTrabalho'
FROM AGPROGRAMA ap
	LEFT JOIN
		(SELECT 
			h2.codpes AS 'numeroUSP'
			,h2.numseqpgm AS 'seqPrograma'
			,h2.codare AS 'codigoArea'
			,MIN(h2.dtaocopgm) AS 'primeiraOcorrencia'
		FROM HISTPROGRAMA h2
		WHERE h2.tiphstpgm = 'MAR'
		GROUP BY h2.codpes, h2.numseqpgm, h2.codare) jn
			ON jn.numeroUSP = ap.codpes 
				AND jn.seqPrograma = ap.numseqpgm
				AND jn.codigoArea = ap.codare
	LEFT JOIN (SELECT
					h3.codpes
					,h3.numseqpgm
					,h3.codare
					,h3.dtaocopgm
					,h3.tiphstpgm
				FROM HISTPROGRAMA h3
					INNER JOIN (SELECT 
									h2.codpes AS 'numeroUSP'
									,h2.numseqpgm AS 'seqPrograma'
									,h2.codare AS 'codigoArea'
									,MAX(h2.dtaocopgm) AS 'ultimaOcorrencia'
										FROM HISTPROGRAMA h2
										GROUP BY h2.codpes, h2.numseqpgm, h2.codare) jn2
											ON jn2.numeroUSP = h3.codpes
												AND jn2.seqPrograma = h3.numseqpgm
												AND jn2.codigoArea = h3.codare
												AND jn2.ultimaOcorrencia = h3.dtaocopgm
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