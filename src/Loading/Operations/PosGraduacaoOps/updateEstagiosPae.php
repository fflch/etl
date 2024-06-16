<?php

namespace Src\Loading\Operations\PosGraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;

use Src\Transformation\ReplicadoModels\PosGraduacao\EstagioPaeReplicado;
use Src\Loading\Models\PosGraduacao\EstagioPae;

class updateEstagiosPae
{
    private $estagiosPae;

    public function __construct()
    {
        $this->estagiosPae = new Transformer(new EstagioPaeReplicado, 'PosGraduacao/estagios_pae');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->estagiosPae,
            EstagioPae::class
        );
    }
}
