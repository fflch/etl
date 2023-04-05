<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Src\Transformation\ModelsReplicado\Lattes\LattesReplicado;
use Src\Loading\Models\Lattes\Lattes;

class LattesOps
{
    public function __construct()
    {
        $this->lattes = new Transformer(new LattesReplicado, 'Lattes/lattes');
    }

    public function updateLattes()
    {
        putenv('REPLICADO_SYBASE=0'); //hotfix

        $rowsLimit = 500;
        $offset = 0;

        do {
            $data = $this->lattes->transformData($rowsLimit, $offset);
            Lattes::insert($data);

            $offset += $rowsLimit;
        } while (!empty($data));

        putenv('REPLICADO_SYBASE=1'); //hotfix
    }
}