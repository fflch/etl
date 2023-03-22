<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\CEU\CursoCulturaExtensaoReplicado;
use Src\Loading\Models\CEU\CursoCulturaExtensao;
use Src\Transformation\ModelsReplicado\CEU\OferecimentoCCExReplicado;
use Src\Loading\Models\CEU\OferecimentoCCEx;
use Src\Transformation\ModelsReplicado\CEU\InscricaoCCExReplicado;
use Src\Loading\Models\CEU\InscricaoCCEx;
use Src\Transformation\ModelsReplicado\CEU\MatriculaCCExReplicado;
use Src\Loading\Models\CEU\MatriculaCCEx;

class CEUOperations
{
    public function __construct()
    {
        $this->cursosCEU = new Transformer(new CursoCulturaExtensaoReplicado, 'CEU/cursos_culturaextensao');
        $this->oferecimentosCursos = new Transformer(new OferecimentoCCExReplicado, 'CEU/oferecimentos_ccex');
        $this->inscricoesCursos = new Transformer(new InscricaoCCExReplicado, 'CEU/inscricoes_ccex');
        $this->matriculasCursos = new Transformer(new MatriculaCCExReplicado, 'CEU/matriculas_ccex');
    }

    public function updateCursosCEU()
    {
        $cursosCEU = $this->cursosCEU->transform();

        // Insert placeholders limit is 65535.
        // We need 12 placeholders for each row at the moment. Let's make room for 14.
        foreach(array_chunk($cursosCEU, 4600) as $chunk) 
        {
            CursoCulturaExtensao::insert($chunk);
        }
    }

    public function updateOferecimentosCursos()
    {
        $oferecimentosCursos = $this->oferecimentosCursos->transform();

        // Insert placeholders limit is 65535.
        // We need 18 placeholders for each row at the moment. Let's make room for 20.
        foreach(array_chunk($oferecimentosCursos, 3200) as $chunk) 
        {
            OferecimentoCCEx::insert($chunk);
        }
    }

    public function updateInscricoesCursos()
    {
        $inscricoesCursos = $this->inscricoesCursos->transform();

        // Insert placeholders limit is 65535.
        // We need 5 placeholders for each row at the moment. Let's make room for 7.
        foreach(array_chunk($inscricoesCursos, 9300) as $chunk) 
        {
            InscricaoCCEx::insert($chunk);
        }
    }

    public function updateMatriculasCursos()
    {
        $matriculasCursos = $this->matriculasCursos->transform();

        // Insert placeholders limit is 65535.
        // We need 9 placeholders for each row at the moment. Let's make room for 11.
        foreach(array_chunk($matriculasCursos, 5900) as $chunk) 
        {
            MatriculaCCEx::insert($chunk);
        }
    }
}