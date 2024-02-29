<?php

namespace Src\Loading\Operations\PesquisasAvancadasOps;

use Src\Transformation\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\LoadingUtils;
use Src\Transformation\ModelsReplicado\PesquisasAvancadas\AfastEmpresaPesquisaAvancadaReplicado;
use Src\Loading\Models\PesquisasAvancadas\AfastEmpresaPesquisaAvancada;

class updateAfastEmpresasPesquisaAvancada
{
    private $afastEmpresasPesquisaAvancada;

    public function __construct()
    {
        $this->afastEmpresasPesquisaAvancada = new Transformer(new AfastEmpresaPesquisaAvancadaReplicado, 'PesquisasAvancadas/afastempresas_pesq_avancada');
    }

    public function update()
    {
        LoadingUtils::insertIntoTable(
            'full',
            $this->afastEmpresasPesquisaAvancada, 
            AfastEmpresaPesquisaAvancada::class
        );

        Capsule::delete(
            "DELETE ap
            FROM pesquisas_avancadas pa
            LEFT JOIN afastempresas_pesq_avancada ap ON ap.id_projeto = pa.id_projeto
            WHERE pa.situacao_projeto IN ('Incompleto', 'Recusado')"
        );

        Capsule::update(
            "UPDATE afastempresas_pesq_avancada ap
            INNER JOIN pesquisas_avancadas pa ON pa.id_projeto = ap.id_projeto
            SET ap.data_fim_afastamento = pa.data_fim_projeto
            WHERE pa.situacao_projeto = 'Cancelado'"
        );
    }
}