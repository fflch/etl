<?php

namespace Src\Loading\Operations\PesquisasAvancadasOps;

use Src\Transformation\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\BolsaPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\BolsaPesquisaAvancada;

class updateBolsasPesquisaAvancada
{
    private $bolsasPesquisaAvancada;

    public function __construct()
    {
        $this->bolsasPesquisaAvancada = new Transformer(new BolsaPesquisaAvancadaReplicado, 'PesquisasAvancadas/bolsas_pesq_avancada');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->bolsasPesquisaAvancada,
            BolsaPesquisaAvancada::class
        );

        Capsule::delete(
            "DELETE bp
            FROM pesquisas_avancadas pa
            LEFT JOIN bolsas_pesq_avancada bp ON bp.id_projeto = pa.id_projeto
            WHERE pa.situacao_projeto IN ('Incompleto', 'Recusado')"
        );

        Capsule::update(
            "UPDATE bolsas_pesq_avancada bp
            INNER JOIN pesquisas_avancadas pa ON pa.id_projeto = bp.id_projeto
            SET bp.data_fim_fomento = pa.data_fim_projeto
            WHERE pa.situacao_projeto = 'Cancelado'"
        );
    }
}