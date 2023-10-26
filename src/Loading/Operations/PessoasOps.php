<?php

namespace Src\Loading\Operations;

use Src\Transformation\Transformer;
use Src\Utils\ExtractionUtils;
use Src\Transformation\ModelsReplicado\Pessoas\PessoaReplicado;
use Src\Loading\Models\Pessoas\Pessoa;
use Src\Transformation\ModelsReplicado\Pessoas\TituloPessoaReplicado;
use Src\Loading\Models\Pessoas\TituloPessoa;

class PessoasOps
{
    private $pessoas, $titulosPessoas;

    public function __construct()
    {
        $this->pessoas = new Transformer(new PessoaReplicado, 'Pessoas/pessoas');
        $this->titulosPessoas = new Transformer(new TituloPessoaReplicado, 'Pessoas/titulos_pessoas');
    }

    public function updatePessoas()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->pessoas, 
            Pessoa::class
        );
    }

    public function updateTitulosPessoas()
    {
        ExtractionUtils::updateTable(
            'full',
            $this->titulosPessoas, 
            TituloPessoa::class
        );
    }
}