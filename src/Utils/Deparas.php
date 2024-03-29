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
        'R' => 'Ativo', // Reativado
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
        'CAN' => 'Cancelada',
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

    const funcoesBanca = [
        'PRE' => 'Presidente',
        'TIT' => 'Titular',
        'SUP' => 'Suplente',
        'SUB' => 'Substituído'
    ];

    const tiposOrientacaoPG = [
        'PGM' => 'Provisório',
        'ORI' => 'Orientador',
        'COO' => 'Coorientador',
        'EXC' => 'Em caráter exepcional',
    ];

    const tiposMatriculaPG = [
        'REGULAR' => 'Regular',
        'ARTIG103' => 'Artigo 103 (RG-USP)'
    ];

    const niveisPG = [
        'ME' => 'Mestrado',
        'DO' => 'Doutorado',
        'DD' => 'Doutorado Direto'
    ];

    const tiposIngressoIntercambio = [
        'A' => 'Acordo USP',
        'C' => 'Convênio USP',
        'N' => 'Outro',
        'P' => 'Rede, programa ou consórcio',
    ];

    const modalidadesIntercambio = [
        'I' => 'Regular', // "Intercâmbio de Graduação no modelo Convênio de Intercâmbio de Graduação"
        'D' => 'Duplo Diploma',
        'C' => 'Curta Duração',
        'N' => 'Não Informado'
    ];

    const situacoesEstagioPAE = [
        'O' => 'Obrigatório',
        'P' => 'Optativo'
    ];

    const situacoesEPP = [
        'C' => 'Cursando',
        'F' => 'Finalizada', // (concluída)
        'P' => 'Paralela', // (concomitante)
    ];

    const modalidadesEPP = [
        'D' => 'Disciplina',
        // D = disciplina de Pós-Graduação oferecendo créditos, cujo conteúdo estará 
        // voltado para as questões da Universidade e do Ensino Superior;
        'C' => 'Conjunto Conferência',
        // C = conjunto de conferências, com especialistas da área de Educação, 
        // condensadas num tempo menor, tendo como tema as questões do Ensino Superior;
        'N' => 'Núcleo de Atividade',
        // N = núcleo de atividades, envolvendo preparo de material didático, discussões de 
        // curriculum, de ementas de disciplinas e planejamento de cursos, coordenadas por professores. 
        'E' => 'Disciplina Externa à USP',
    ];

    const situacoesInscricaoPAE = [
        'I' => 'Inscrito',
        'S' => 'Selecionado',
        'E' => 'Lista de Espera',
        'M' => 'Selecionado Manualmente',
        'C' => 'Cancelado',
    ];

    const validacaoPAE = [
        'A' => 'Avalizada',
        // inscrição foi avalizada pelo docente, 
        // efetivando a inscrição do aluno no estágio PAE;
        'S' => 'Avalizada automaticamente',
        'AS' => 'Avalizada pelo secretário',
        // no lugar do orientador;
        'D' => 'Desautorizada',
        // inscrição foi desautorizada pelo docente, 
        // de modo que o aluno não poderá iniciar o estágio PAE, 
        // ao menos até fazer as devidas correções e encaminhar a inscrição para reanálise; 
        'DS' => 'Desautorizada pelo secretário',
        // no lugar do orientador. 
        null => 'Esperando manifestação'
        // ainda não houve manifestação por parte do docente,

        // Obs.: o status S (avalização automática) foi desativado em jul/2016.
    ];

    const vinculoEmpregaticioPAE = [
        'NA' => 'Sem vínculo',
        'VE' => 'Vinculo Externo à USP',
        'VU' => 'Vínculo de Servidor USP,'
    ];

    const tiposHabilitacao = [
        'B' => 'Grau Principal Exclusivo',
        'E' => 'Licenciatura Exclusiva',
        'G' => 'Grau Principal com Sequência Opcional',
        'H' => 'Habilitação, modalidade, ênfase, área',
        'I' => 'Grau Principal após Núcleo Geral',
        'J' => 'Habilitação Exclusiva',
        'L' => 'Licenciatura Sequencial a Bacharelado Obrigatório',
        'M' => 'Licenciatura de Primeiro Grau',
        'N' => 'Licenciatura sem Bacharelado Anterior',
        'O' => 'Núcleo Específico Sequencial',
        'P' => 'Habilitação em Português',
        'S' => 'Núcleo Específico',
        'U' => 'Núcleo Básico ou Geral',
    ];

    public static function nToNull($v)
    {
        if(strtoupper($v) == 'N') {
            return null;
        }

        return $v;
    }
}
