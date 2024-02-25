<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PosGraduacao\MinistrantePosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\MinistrantePosGraduacao;

class updateMinistrantesPG
{
    private $ministrantesPG;

    public function __construct()
    {
        $this->ministrantesPG = new Transformer(new MinistrantePosGraduacaoReplicado, 'PosGraduacao/ministrantes_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->ministrantesPG, 
            MinistrantePosGraduacao::class
        );
    }
}