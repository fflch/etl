<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PosGraduacao\OrientacaoPosGraduacaoReplicado;
use Src\Loading\Models\PosGraduacao\OrientacaoPosGraduacao;

class updateOrientacoesPG
{
    private $orientacoesPG;

    public function __construct()
    {
        $this->orientacoesPG = new Transformer(new OrientacaoPosGraduacaoReplicado, 'PosGraduacao/orientacoes_posgraduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->orientacoesPG,
            OrientacaoPosGraduacao::class
        );
    }
}
