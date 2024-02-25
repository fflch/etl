<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Graduacao\IniciacaoCientificaReplicado;
use Src\Loading\Models\Graduacao\IniciacaoCientifica;

class updateIniciacoes
{
    private $iniciacoes;

    public function __construct()
    {
        $this->iniciacoes = new Transformer(new IniciacaoCientificaReplicado, 'Graduacao/iniciacoes_cientificas');    }

    public function update()
    {
        Capsule::statement("SET FOREIGN_KEY_CHECKS = 0"); //gambi

        LoadingUtils::insertIntoTable(
            'full',
            $this->iniciacoes, 
            IniciacaoCientifica::class
        );

        Capsule::statement("SET FOREIGN_KEY_CHECKS = 1"); //gambi

        Capsule::update(
            "UPDATE iniciacoes i
            SET data_fim_projeto = NULL, data_inicio_projeto = NULL
            WHERE i.situacao_projeto = 'Denegado'"
        );
    }
}