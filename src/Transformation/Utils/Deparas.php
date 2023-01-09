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

    const situacoes = [
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
        'Transf Ex officio' => 'Transf Ex officio'
    ];

    const statusProjeto = [
        'Inscrito PIBI' => 'Inscrito PIBIC',
        'Não aprovado' => 'Denegado',
        'Transferido' => 'Cancelado'
    ];

    const SIICUSPBool = [
        'S' => True,
        'N' => False,
        Null => False
    ];
}