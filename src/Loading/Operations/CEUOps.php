<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
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
    private $cursosCEU, $oferecimentosCursos,
            $inscricoesCursos, $matriculasCursos,
            $ministrantesCursos, $coordenadoresCursos;

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
            CursoCulturaExtensao::class
        );
    }

    public function updateOferecimentosCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->oferecimentosCursos, 
            OferecimentoCCEx::class
        );
    }

    public function updateInscricoesCursos()
    {
        ExtractionUtils::updateTable(
            'paginated',
            $this->inscricoesCursos, 
            InscricaoCCEx::class
        );
    }

    public function updateMatriculasCursos()
    {
        ExtractionUtils::updateTable(
            'paginated',
            $this->matriculasCursos, 
            MatriculaCCEx::class
        );
    }

    public function updateMinistrantesCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->ministrantesCursos, 
            MinistranteCCEx::class
        );
    }

    public function updateCoordenadoresCursos()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->coordenadoresCursos, 
            CoordenadorCCEx::class
        );
    }
}