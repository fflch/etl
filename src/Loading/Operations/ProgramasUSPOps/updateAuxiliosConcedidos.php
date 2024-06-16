<?php

namespace Src\Loading\Operations\ProgramasUSPOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\ProgramasUSP\AuxilioConcedidoReplicado;
use Src\Loading\Models\ProgramasUSP\AuxilioConcedido;

class updateAuxiliosConcedidos
{
    private $auxilios;

    public function __construct()
    {
        $this->auxilios = new Transformer(new AuxilioConcedidoReplicado, 'ProgramasUSP/auxilios_concedidos');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->auxilios,
            AuxilioConcedido::class
        );
    }
}
