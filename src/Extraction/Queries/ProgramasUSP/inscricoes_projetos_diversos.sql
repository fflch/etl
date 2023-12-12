SELECT
	b.codpes AS 'numero_usp'
	,t2.nomvin AS 'tipo_vinculo_inscrito'
	,b.codbnfalu AS 'codigo_programa_usp'
	,b.numseqgesbnf AS 'sequencia_programa_usp'
	,b.anoofebnf AS 'periodo_referencial'
	,b.codprjbnf AS 'codigo_projeto_diverso'
	,b.dtainsprj AS 'data_inscricao_projeto'
	,ISNULL(b.stainssel, 'N') AS 'inscricao_selecionada'
	,b.dtaaltsel AS 'data_selecao_rejeicao'
	,b.staseldct AS 'selecionado_docente_outro_projeto'
	,b.staevi AS 'comparecimento_entrevista'
	,b.stacurdis AS 'cursou_disciplina'
	,b.staactalu AS 'status_aceite_aluno'
	,b.dtaactalu AS 'data_aceite_aluno'
	,b.staactdct AS 'status_aceite_docente'
	,b.dtaactdct AS 'data_aceite_docente'
--	,b.dtaenvprogrd
--	,b.dtaenvprrceu
--	,b.codpesenvceu
	,b.dtasoldlgbls AS 'data_solicitacao_desligamento'
	,b.codmotdlgsol AS 'codigo_motivo_solicitacao_desligamento'
	,b2.motdlg AS 'motivo_desligamento'
	,b.motdlgsolout AS 'motivo_desligamento_solicitacao_outro'
	,b.stasoldlgbls AS 'status_resultado_solicitacao_desligamento'
	,b.dtarstsoldlg AS 'data_resultado_solicitacao_desligamento'
	,b.dtaenvrelfim AS 'data_envio_relatorio_final'
	,b.stasolsbtbls AS 'solicitou_substituicao'
	,b.codpessbtbls AS 'numero_usp_substituto'
	,b.staalublsvlt AS 'bolsista_ou_voluntario'
FROM BENEFICIOPROJINSCRICAO b
	LEFT JOIN BENTIPOMOTIVODESLIG b2 ON b.codmotdlgsol = b2.codmotdlg
	LEFT JOIN TIPOVINCULO t2 ON b.tipvin = t2.tipvin