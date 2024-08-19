<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Src\Utils\LoadingUtils;
use Src\Transformation\ReplicadoModels\Graduacao\NotasIngressoGraduacaoReplicado;
use Src\Loading\Models\Graduacao\NotasIngressoGraduacao;

class updateNotasIngressoGraduacao
{
    private $notasIngresso;

    public function __construct()
    {
        $this->notasIngresso = new Transformer(new NotasIngressoGraduacaoReplicado, 'Graduacao/notas_ingresso_graduacao');
    }
    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->notasIngresso,
            NotasIngressoGraduacao::class
        );
    }
}
