<?php

namespace Src\Loading\Operations\ServidoresOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Servidores\ProfessorVisitanteReplicado;
use Src\Loading\Models\Servidores\ProfessorVisitante;

class updateProfessoresVisitantes
{
    private $professoresVisitantes;

    public function __construct()
    {
        $this->professoresVisitantes = new Transformer(new ProfessorVisitanteReplicado, 'Servidores/professores_visitantes');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->professoresVisitantes,
            ProfessorVisitante::class
        );
    }
}
