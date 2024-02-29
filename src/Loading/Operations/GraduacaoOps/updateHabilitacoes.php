<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Graduacao\HabilitacaoReplicado;
use Src\Loading\Models\Graduacao\Habilitacao;

class updateHabilitacoes
{
    private $habilitacoes;

    public function __construct()
    {
        $this->habilitacoes = new Transformer(new HabilitacaoReplicado, 'Graduacao/habilitacoes');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->habilitacoes, 
            Habilitacao::class
        );
    }
}