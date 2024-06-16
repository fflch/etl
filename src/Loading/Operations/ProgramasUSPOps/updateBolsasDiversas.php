<?php

namespace Src\Loading\Operations\ProgramasUSPOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\ProgramasUSP\BolsaDiversaReplicado;
use Src\Loading\Models\ProgramasUSP\BolsaDiversa;

class updateBolsasDiversas
{
    private $bolsas;

    public function __construct()
    {
        $this->bolsas = new Transformer(new BolsaDiversaReplicado, 'ProgramasUSP/bolsas_diversas');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsas,
            BolsaDiversa::class
        );
    }
}
