<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\BolsaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\BolsaPosGraduacao;

class updateBolsasPG
{
    private $bolsasPG;

    public function __construct()
    {
        $this->bolsasPG = new Transformer(new BolsaPosGraduacaoReplicado, 'PosGraduacao/bolsas_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsasPG, 
            BolsaPosGraduacao::class
        );
    }
}