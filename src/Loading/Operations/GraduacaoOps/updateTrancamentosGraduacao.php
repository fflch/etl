<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Graduacao\TrancamentoGraduacaoReplicado;
use Src\Loading\Models\Graduacao\TrancamentoGraduacao;

class updateTrancamentosGraduacao
{
    private $trancamentosGraduacao;

    public function __construct()
    {
        $this->trancamentosGraduacao = new Transformer(new TrancamentoGraduacaoReplicado, 'Graduacao/trancamentos_graduacao');
    }
    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->trancamentosGraduacao,
            TrancamentoGraduacao::class
        );
    }
}
