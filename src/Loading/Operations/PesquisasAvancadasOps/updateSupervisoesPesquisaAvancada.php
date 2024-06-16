<?php

namespace Src\Loading\Operations\PesquisasAvancadasOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PesquisasAvancadas\SupervisaoPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\SupervisaoPesquisaAvancada;

class updateSupervisoesPesquisaAvancada
{
    private $supervisoesPesquisaAvancada;

    public function __construct()
    {
        $this->supervisoesPesquisaAvancada = new Transformer(new SupervisaoPesquisaAvancadaReplicado, 'PesquisasAvancadas/supervisoes_pesq_avancada');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->supervisoesPesquisaAvancada,
            SupervisaoPesquisaAvancada::class
        );
    }
}
