<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\TurmaGraduacaoReplicado;
use Src\Loading\Models\Graduacao\TurmaGraduacao;

class updateTurmasGraduacao
{
    private $turmasGraduacao;

    public function __construct()
    {
        $this->turmasGraduacao = new Transformer(new TurmaGraduacaoReplicado, 'Graduacao/turmas_graduacao');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'paginated',
            $this->turmasGraduacao,
            TurmaGraduacao::class
        );
    }
}
