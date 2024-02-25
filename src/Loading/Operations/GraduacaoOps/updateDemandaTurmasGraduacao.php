<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Graduacao\DemandaTurmaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\DemandaTurmaGraduacao;

class updateDemandaTurmasGraduacao
{
    private $demandaTurmasGraduacao;

    public function __construct()
    {
        $this->demandaTurmasGraduacao = new Transformer(new DemandaTurmaGraduacaoReplicado, 'Graduacao/demanda_turmas_graduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->demandaTurmasGraduacao, 
            DemandaTurmaGraduacao::class
        );
    }
}