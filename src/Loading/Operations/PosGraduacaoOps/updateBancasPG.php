<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\BancaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\BancaPosGraduacao;

class updateBancasPG
{
    private $bancasPG;

    public function __construct()
    {
        $this->bancasPG = new Transformer(new BancaPosGraduacaoReplicado, 'PosGraduacao/bancas_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bancasPG, 
            BancaPosGraduacao::class
        );
    }
}