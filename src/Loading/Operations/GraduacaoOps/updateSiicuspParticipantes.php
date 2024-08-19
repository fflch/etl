<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\SIICUSPParticipanteReplicado;
use Src\Loading\Models\Graduacao\SIICUSPParticipante;

class updateSiicuspParticipantes
{
    private $SIICUSPParticipantes;

    public function __construct()
    {
        $this->SIICUSPParticipantes = new Transformer(new SIICUSPParticipanteReplicado, 'Graduacao/SIICUSP_participantes');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->SIICUSPParticipantes,
            SIICUSPParticipante::class
        );
    }
}
