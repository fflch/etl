<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\MinistranteGraduacaoReplicado;
use Src\Loading\Models\Graduacao\MinistranteGraduacao;

class updateMinistrantesGraduacao
{
    private $ministrantesGraduacao;

    public function __construct()
    {
        $this->ministrantesGraduacao = new Transformer(new MinistranteGraduacaoReplicado, 'Graduacao/ministrantes_graduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->ministrantesGraduacao,
            MinistranteGraduacao::class
        );
    }
}
