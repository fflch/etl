<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\CEU\CursoCulturaExtensaoReplicado;
use Src\Loading\Models\CEU\CursoCulturaExtensao;
use Src\Transformation\ModelsReplicado\CEU\OferecimentoCCExReplicado;
use Src\Loading\Models\CEU\OferecimentoCCEx;
use Src\Transformation\ModelsReplicado\CEU\InscricaoCCExReplicado;
use Src\Loading\Models\CEU\InscricaoCCEx;
use Src\Transformation\ModelsReplicado\CEU\MatriculaCCExReplicado;
use Src\Loading\Models\CEU\MatriculaCCEx;
use Src\Transformation\ModelsReplicado\CEU\MinistranteCCExReplicado;
use Src\Loading\Models\CEU\MinistranteCCEx;
use Src\Transformation\ModelsReplicado\CEU\CoordenadorCCExReplicado;
use Src\Loading\Models\CEU\CoordenadorCCEx;

class CEUOps
{
    public function __construct()
    {
        $this->cursosCEU = new Transformer(new CursoCulturaExtensaoReplicado, 'CEU/cursos_culturaextensao');
        $this->oferecimentosCursos = new Transformer(new OferecimentoCCExReplicado, 'CEU/oferecimentos_ccex');
        $this->inscricoesCursos = new Transformer(new InscricaoCCExReplicado, 'CEU/inscricoes_ccex');
        $this->matriculasCursos = new Transformer(new MatriculaCCExReplicado, 'CEU/matriculas_ccex');
        $this->ministrantesCursos = new Transformer(new MinistranteCCExReplicado, 'CEU/ministrantes_ccex');
        $this->coordenadoresCursos = new Transformer(new CoordenadorCCExReplicado, 'CEU/coordenadores_ccex');
    }

    public function updateCursosCEU()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->cursosCEU, 
            CursoCulturaExtensao::class, 
            4600
        );
    }

    public function updateOferecimentosCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->oferecimentosCursos, 
            OferecimentoCCEx::class, 
            3200
        );
    }

    public function updateInscricoesCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->inscricoesCursos, 
            InscricaoCCEx::class, 
            9000
        );
    }

    public function updateMatriculasCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->matriculasCursos, 
            MatriculaCCEx::class, 
            5900
        );
    }

    public function updateMinistrantesCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->ministrantesCursos, 
            MinistranteCCEx::class, 
            5900
        );
    }

    public function updateCoordenadoresCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->coordenadoresCursos, 
            CoordenadorCCEx::class, 
            5900
        );
    }
}