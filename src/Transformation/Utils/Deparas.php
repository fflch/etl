<?php

namespace Src\Transformation\Utils;

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

    const boolSIICUSP = [
        'S' => true,
        'N' => false,
        null => false
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
        // OBS: O status inicial é 'A' e após todas as notas 
        // serem transcritas e validadas pelo professor ou 
        //Serviço de Graduação o status muda para 'C'.
    ];

    const periodicidadeProf = [
        'N' => 'Semanalmente',
        'A' => 'Quinzenalmente',
    ];
}