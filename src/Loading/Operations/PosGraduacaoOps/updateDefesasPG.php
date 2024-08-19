<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\DefesaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\DefesaPosGraduacao;

class updateDefesasPG
{
    private $defesasPG;

    public function __construct()
    {
        $this->defesasPG = new Transformer(new DefesaPosGraduacaoReplicado, 'PosGraduacao/defesas_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->defesasPG,
            DefesaPosGraduacao::class
        );
    }
}
