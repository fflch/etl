<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\SIICUSPTrabalhoReplicado;
use Src\Loading\Models\Graduacao\SIICUSPTrabalho;

class updateSiicuspTrabalhos
{
    private $SIICUSPTrabalhos;

    public function __construct()
    {
        $this->SIICUSPTrabalhos = new Transformer(new SIICUSPTrabalhoReplicado, 'Graduacao/SIICUSP_trabalhos');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->SIICUSPTrabalhos,
            SIICUSPTrabalho::class
        );
    }
}
