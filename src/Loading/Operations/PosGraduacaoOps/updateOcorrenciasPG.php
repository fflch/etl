<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\OcorrenciaPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\OcorrenciaPosGraduacao;

class updateOcorrenciasPG
{
    private $ocorrenciasPG;

    public function __construct()
    {
        $this->ocorrenciasPG = new Transformer(new OcorrenciaPosGraduacaoReplicado, 'PosGraduacao/ocorrencias_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->ocorrenciasPG,
            OcorrenciaPosGraduacao::class
        );
    }
}
