<?php

namespace Src\Loading\Operations\CEUOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\CEU\MinistranteCCExReplicado;
use Src\Loading\Models\CEU\MinistranteCCEx;

class updateMinistrantesCCEx
{
    private $ministrantesCCEx;

    public function __construct()
    {
        $this->ministrantesCCEx = new Transformer(new MinistranteCCExReplicado, 'CEU/ministrantes_ccex');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->ministrantesCCEx,
            MinistranteCCEx::class
        );
    }
}
