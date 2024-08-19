<?php

namespace Src\Loading\Operations\ServidoresOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Servidores\VinculoServidorReplicado;
use Src\Loading\Models\Servidores\VinculoServidor;

class updateVinculosServidores
{
    private $vinculosServidores;

    public function __construct()
    {
        $this->vinculosServidores = new Transformer(new VinculoServidorReplicado, 'Servidores/vinculos_servidores');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->vinculosServidores,
            VinculoServidor::class
        );
    }
}
