<?php

namespace Src\Utils;

class Deparas
{
    const racas = [
        1 => 'Indígena',
        2 => 'Branca',
        3 => 'Preta',
        4 => 'Amarela',
        5 => 'Parda',
        6 => 'Não informada',
        NULL => 'Não informada',
    ];

    const situacoesGR = [
        'A' => 'Ativo',
        'E' => 'Encerrado',
        'T' => 'Trancado',
        'R' => 'Reativado',
        'S' => 'Suspenso',
        'P' => 'Pendente'
    ];

    const ingressos = [
        'Vestibular' => 'FUVEST',
        'Vestibular 2 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 3 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 4 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 5 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 6 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 7 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 8 Lista' => 'FUVEST - Lista Extra',
        'Vestibular 9 Lista' => 'FUVEST - Lista Extra',
        'Vestibular - Extra' => 'FUVEST - Lista Extra',
        'Vestibular - SISU' => 'SISU',
        'Vestibular SISU LE 1' => 'SISU - Lista Extra',
        'Vestibular SISU LE 2' => 'SISU - Lista Extra',
        'Vestibular SISU LE 3' => 'SISU - Lista Extra',
        'Vestibular SISU LE 4' => 'SISU - Lista Extra',
        'Vestibular SISU LE 5' => 'SISU - Lista Extra',
        'Vestibular SISU LE 6' => 'SISU - Lista Extra',
        'Vestibular - SISU LE' => 'SISU - Lista Extra',
        'Transf USP' => 'Transferência Interna',
        'Transf Externa' => 'Transferência Externa',
        'Liminar' => 'Liminar',
        'REGULAR' => 'Regular',
        'concurso público' => 'Concurso Público',
        'reintegração' => 'Reintegração',
        'processo seletivo' => 'Processo Seletivo',
        'Vínculo Temporário' => 'Vínculo Temporário',
        'Convênio PEC-G' => 'Convênio PEC-G',
        'Graduado' => 'Graduado',
        'Cortesia Diplomática' => 'Cortesia Diplomática',
        'anterior a out/2002' => 'Anterior a OUT/2002',
        'Conv. Duplo Diploma' => 'Convênio Duplo Diploma',
        'Transf Ex officio' => 'Transferência ex officio'
    ];

    const statusProjeto = [
        'Inscrito PIBI' => 'Inscrito PIBIC',
        'Não aprovado' => 'Denegado',
        'Transferido' => 'Cancelado'
    ];

    const tiposParticipantes = [
        'A' => 'Autor',
        'O' => 'Orientador',
        'C' => 'Colaborador',
        'D' => 'Autor adicional'
    ];

    const apresentacaoSIICUSP = [
        'S' => 'Apresentado',
        'N' => 'Não apresentado'
    ];

    const modalidadesPD = [
        2 => 'PD', // Pós-Doutorado
        24 => 'PC' // Pesquisador Colaborador
    ];

    const situacoesPD = [
        'I' => 'Inicial',
        'P' => 'Prorrogação',
        'S' => 'Substituição',
        'A' => 'Afastamento'
    ];

    const tiposVinculoPD = [
        'AR' => 'Afastamento Remunerado',
        'JP' => "Jornada Parcial"
    ];

    const situacoesServidores = [
        'A' => 'Ativo',
        'P' => 'Aposentado',
        'D' => 'Desativado'
    ];

    const tiposVinculoServidores = [
        'SERVIDOR' => 'Funcionário',
        'ESTAGIARIO' => 'Estagiário',
        'ESTAGIARIORH' => 'Estagiário',
        'ESTAGIARIOPOS' => 'Estagiário',
    ];

    const tipoCredenciamento = [
        'ORI' => 'Orientador',
        'COO' => 'Coorientador',
        'ESP' => 'Orientador específico',
        // "Atualmente só contempla o tipo ORI (orientador)" 
    ];

    const statusTurma = [
        'A' => 'Ativa',
        'D' => 'Não ativa',
        'C' => 'Consolidada',
        // "OBS: O status inicial é 'A' e após todas as notas 
        // serem transcritas e validadas pelo professor ou 
        // Serviço de Graduação o status muda para 'C'".
    ];

    const periodicidadeProf = [
        'N' => 'Semanal',
        'A' => 'Quinzenal',
    ];

    const periodicidadeDisciplina = [
        // Identifica o tipo de disciplina como: 
        'A' => 'Anual',
        'S' => 'Semestral',
        'Q' => 'Quadrimestral',
    ];

    const situacoesDisciplina = [
        'PE' => 'Pendente',  // "Pendente",
        'AU' => 'Pendente',  // "Aguardando análise da própria UNIDADE",
        'AO' => 'Pendente',  // "Aguardando análise de OUTRAS unidades",
        'AT' => 'Ativa',  // "Ativada",
        'AP' => 'Aprovada',  // "Aprovada",
        'DT' => 'Desativada',  // "Desativada" 
    ];

    const formasExercicioCEU = [
        /* Indica se o coordenador ou vice-coordenador exerce as funções de 
           coordenação simultâneo ao regime CERT (recebe remuneração paralela) 
           ou como atividade de Extensão (não remunerada) (S/E). */
        'S' => 'Simultâneo ao regime CERT',
        'E' => 'Atividade de extensão'
    ];

    const situacoesInscricaoCCEx = [
        // Situação da inscrição do candidato: 
        'A' => 'Aceito',
        'R' => 'Recusado',
        'I' => 'Invalidado por falta de documento comprobatório',
        'S' => 'Sorteado',
        'N' => 'Não manifestou interesse', 
        'C' => 'Confirmada inscrição pelo candidato',
        'V' => 'inscrição em vagas remanescentes',
    ];

    const tiposDesignacaoServidor = [
        // Indica a hierarquia de subordinação da função de estrutura no setor: 
        'C' => 'Chefe',
        'D' => 'Designado', //(assessores, ATDI, ATDII, ATDIV), 
        'H' => 'Horizontal', // (secretárias..). 
    ];

    const origensInscricaoCCex = [
        // Indica a origem da inscrição: 
        'P' => 'Presencial', // Efetuada na secretaria
        'C' => 'Carga', // Via planilha
        'W' => 'Web'
    ];

    const statusMatriculaCCEx = [
        // Indica se a matrícula do aluno no curso está em 
        'AND' => 'Andamento',
        'ENC' => 'Encerrada', 
    ];

    const resultadoMatriculaCCEx = [
        // Conceito obtido como resultado final: 
        'APR' => 'Aprovado',
        'REP' => 'Reprovado',
        'DES' => 'Desistente',
        'TRF' => 'Transferido',
        'PEN' => 'Pendente',
        'CAN' => 'Curso Cancelado',
        'OUV' => 'Ouvinte',
    ];

    const situacaoEdicaoCCEx = [
        // Situação em que a edição do curso CEU se encontra: 
        'SOL' => 'Solicitada',
        'APR' => 'Aprovada',
        'HMG' => 'Homologada',
        'REP' => 'Reprovada',
        'PCE' => 'PC Entregue',
        'PCA' => 'PC Aceita',
        'PCR' => 'PC Reprovada',
        'CAN' => 'Cancelamento',
        'INV' => 'Invalidada', // Quando o curso for ministrado sem aprovação da PRCEU, devendo gerar certificado para os alunos mesmo assim; 
        'PCD' => 'PC devolvida para ajustes',
    ];

    const situacoesVacinaCovid = [
        // Indica a última situação de vacina COVID da pessoa: 
        'U' => 'Dose única',
        '1' => 'Incompleto (1/2)',
        '2' => 'Completo (2/2)',
        'R' => 'Reforço',
        'N' => 'Não Vacinado (Sem justificativa/Convicção pessoal)',
        'M' => 'Não Vacinado (Restrição médica)',
        'I' => 'Invalidado', // (A pessoa informou os dados da vacinação, mas houve alguma rejeição por parte do validador)
    ];
}
