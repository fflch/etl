<?php

namespace Src\Loading\Operations\PesquisasAvancadasOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\PesquisasAvancadas\PeriodoPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\PeriodoPesquisaAvancada;

class updatePeriodosPesquisaAvancada
{
    private $periodosPesquisaAvancada;

    public function __construct()
    {
        $this->periodosPesquisaAvancada = new Transformer(new PeriodoPesquisaAvancadaReplicado, 'PesquisasAvancadas/periodos_pesq_avancada');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->periodosPesquisaAvancada,
            PeriodoPesquisaAvancada::class
        );
    }
}
