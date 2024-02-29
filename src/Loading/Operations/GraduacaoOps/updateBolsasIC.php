<?php

namespace Src\Loading\Operations\GraduacaoOps;

use Src\Transformation\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\Graduacao\BolsaICReplicado;
use Src\Loading\Models\Graduacao\BolsaIC;

class updateBolsasIC
{
    private $bolsasIC;

    public function __construct()
    {
        $this->bolsasIC = new Transformer(new BolsaICReplicado, 'Graduacao/bolsas_ic');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsasIC, 
            BolsaIC::class
        );

        Capsule::delete(
            "DELETE bi
            FROM iniciacoes i
            INNER JOIN bolsas_ic bi ON i.id_projeto = bi.id_projeto
            WHERE i.situacao_projeto = 'Denegado'"
        );

        Capsule::update(
            "UPDATE bolsas_ic bi
            INNER JOIN iniciacoes i ON bi.id_projeto = i.id_projeto
            SET bi.data_fim_fomento = i.data_fim_projeto
            WHERE i.situacao_projeto = 'Cancelado'"
        );
    }
}