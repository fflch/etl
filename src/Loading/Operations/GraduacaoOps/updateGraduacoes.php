<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\GraduacaoReplicado;
use Src\Loading\Models\Graduacao\Graduacao;

class updateGraduacoes
{
    private $graduacoes;

    public function __construct()
    {
        $this->graduacoes = new Transformer(new GraduacaoReplicado, 'Graduacao/graduacoes');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->graduacoes,
            Graduacao::class
        );
    }
}
