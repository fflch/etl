<?php

namespace Src\Loading\Operations\PesquisasAvancadasOps;

use Src\Transformation\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\PesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\PesquisaAvancada;

class updatePesquisasAvancadas
{
    private $pesquisasAvancadas;

    public function __construct()
    {
        $this->pesquisasAvancadas = new Transformer(new PesquisaAvancadaReplicado, 'PesquisasAvancadas/pesquisas_avancadas');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->pesquisasAvancadas,
            PesquisaAvancada::class
        );

        Capsule::update(
            "UPDATE pesquisas_avancadas pa
            SET data_fim_projeto = NULL, data_inicio_projeto = NULL
            WHERE pa.situacao_projeto IN ('Incompleto', 'Recusado')"
        );

        Capsule::update(
            "UPDATE pesquisas_avancadas pa
            SET palavras_chave = NULL
            WHERE pa.palavras_chave = ''"
        );
    }
}