<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\PosDoc\ProjetoPosDocReplicado;
use Src\Loading\Models\PosDoc\ProjetoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\PeriodoPosDocReplicado;
use Src\Loading\Models\PosDoc\PeriodoPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\BolsaPosDocReplicado;
use Src\Loading\Models\PosDoc\BolsaPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\AfastEmpresaPosDocReplicado;
use Src\Loading\Models\PosDoc\AfastEmpresaPosDoc;
use Src\Transformation\ModelsReplicado\PosDoc\SupervisaoPosDocReplicado;
use Src\Loading\Models\PosDoc\SupervisaoPosDoc;

class PosDocOps
{
    public function __construct()
    {
        $this->projetosPosDoc = new Transformer(new ProjetoPosDocReplicado, 'PosDoc/projetos_posdoc');
        $this->periodosPosDoc = new Transformer(new PeriodoPosDocReplicado, 'PosDoc/periodos_posdoc');
        $this->bolsasPosDoc = new Transformer(new BolsaPosDocReplicado, 'PosDoc/bolsas_posdoc');
        $this->afastEmpresasPosDoc = new Transformer(new AfastEmpresaPosDocReplicado, 'PosDoc/afastempresas_posdoc');
        $this->supervisoesPosDoc = new Transformer(new SupervisaoPosDocReplicado, 'PosDoc/supervisoes_posdoc');
    }

    public function updateProjetosPosDoc()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->projetosPosDoc, 
            ProjetoPosDoc::class, 
            5400
        );

        Capsule::update("UPDATE projetos_posdoc pp
                        SET data_fim_projeto = NULL, data_inicio_projeto = NULL
                        WHERE pp.situacao_projeto IN ('Incompleto', 'Recusado')");
    }

    public function updatePeriodosPosDoc()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->periodosPosDoc, 
            PeriodoPosDoc::class, 
            5900
        );
    }

    public function updateFontesRecursoPosDoc()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->bolsasPosDoc, 
            BolsaPosDoc::class, 
            6500
        );

        ExtractionUtils::updateTable(
            'full',
            $this->afastEmpresasPosDoc, 
            AfastEmpresaPosDoc::class, 
            7200
        );

        Capsule::delete("DELETE bp, ap
                        FROM projetos_posdoc pp
                            LEFT JOIN bolsas_posdoc bp ON bp.id_projeto = pp.id_projeto
                            LEFT JOIN afastempresas_posdoc ap ON ap.id_projeto = pp.id_projeto
                        WHERE pp.situacao_projeto IN ('Incompleto', 'Recusado')");
        
        Capsule::update("UPDATE bolsas_posdoc bp
                            INNER JOIN projetos_posdoc pp ON pp.id_projeto = bp.id_projeto
                        SET bp.data_fim_fomento = pp.data_fim_projeto
                        WHERE pp.situacao_projeto = 'Cancelado'");

        Capsule::update("UPDATE afastempresas_posdoc ap
                            INNER JOIN projetos_posdoc pp ON pp.id_projeto = ap.id_projeto
                        SET ap.data_fim_afastamento = pp.data_fim_projeto
                        WHERE pp.situacao_projeto = 'Cancelado'");
    }

    public function updateSupervisoesPosDoc()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->supervisoesPosDoc, 
            SupervisaoPosDoc::class, 
            6500
        );
    }
}