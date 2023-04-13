<?php

namespace Src\Loading\Operations;

use Src\Transformation\ModelsReplicado\Transformer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Transformation\ModelsReplicado\Lattes\LattesReplicado;
use Src\Loading\Models\Lattes\Lattes;

class LattesOps
{
    public function __construct()
    {
        $this->lattes = new Transformer(new LattesReplicado, 'Lattes/lattes');
    }

    public function updateLattes()
    {
        putenv('REPLICADO_SYBASE=0'); //hotfix

        $pagination = ['limit' => 200, 'offset' => 0];
        $replace = $this->checkLastLattesExtraction();

        do {
            $data = $this->lattes->transformData($pagination, $replace);
            Lattes::upsert($data, ["numero_cnpq"]);

            $pagination['offset'] += $pagination['limit'];
        } while (!empty($data));

        putenv('REPLICADO_SYBASE=1'); //hotfix
    }

    private function checkLastLattesExtraction()
    {
        $lastExtractionDate = $this->getLastLattesExtractionDate();

        if(is_null($lastExtractionDate)) {
            return null;
        }
        else {
            return [
                "replacement" => "AND (d.dtapcsetc >= '$lastExtractionDate')",
                "subject" => "--AND1"
            ];
        }
    }

    private function getLastLattesExtractionDate()
    {
        $data = Capsule::select("SELECT MAX(data_extracao_cv) AS 'data' FROM lattes;");
        return $data[0]->data;
    }
}