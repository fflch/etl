<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\IntercambioGraduacaoReplicado;
use Src\Loading\Models\Graduacao\IntercambioGraduacao;

class updateIntercambiosGraduacao
{
    private $intercambiosGraduacao;

    public function __construct()
    {
        $this->intercambiosGraduacao = new Transformer(new IntercambioGraduacaoReplicado, 'Graduacao/intercambios_graduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->intercambiosGraduacao,
            IntercambioGraduacao::class
        );
    }
}
