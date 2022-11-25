SELECT
	hp.codpes AS 'numeroUSP'
	,hp.codpgm AS 'sequenciaCurso'
	,hp.codcur AS 'codigoCurso'
	,hp.codhab AS 'codigoHabilitacao'
	,hg.nomhab AS 'nomeHabilitacao'
	,hg.tiphab AS 'tipoHabilitacao'
	,hg.perhab AS 'periodoHabilitacao'
	,hp.dtaini AS 'dataInicioHabilitacao'
	,hp.dtafim AS 'dataFimHabilitacao'
	,hp.tipenchab AS 'tipoEncerramento'
FROM HABILPROGGR hp
	INNER JOIN PROGRAMAGR p ON (hp.codpes = p.codpes AND hp.codpgm = p.codpgm)
	LEFT JOIN CURSOGR c ON (hp.codcur = c.codcur)
	LEFT JOIN HABILITACAOGR hg ON (hp.codcur = hg.codcur AND hp.codhab = hg.codhab)
WHERE hp.codcur BETWEEN 8000 AND 9000
	 AND YEAR(p.dtaing) >= 2007
ORDER BY hp.codpes