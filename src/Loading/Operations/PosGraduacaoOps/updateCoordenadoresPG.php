<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\CoordenadorPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\CoordenadorPosGraduacao;

class updateCoordenadoresPG
{
    private $coordenadoresPG;

    public function __construct()
    {
        $this->coordenadoresPG = new Transformer(new CoordenadorPosGraduacaoReplicado, 'PosGraduacao/coordenadores_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->coordenadoresPG, 
            CoordenadorPosGraduacao::class
        );
    }
}