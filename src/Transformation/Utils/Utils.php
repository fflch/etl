<?php

namespace Src\Transformation\Utils;

use Uspdev\Replicado\Lattes;

class Utils
{
    public static function emptiesToNull(Array $attrs)
    {
        foreach($attrs as $key => $value){
            $newAttrs[$key] = !empty($value) ? $value : NULL;
        }

        return $newAttrs;
    }

    public static function utf8_converter($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public static function trim_recursivo($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            $item = trim($item);
        });
        return $array;
    }

    public static function extracaoDadosLattes(array $cvLattes)
    {
        $dadosLattes = [];
        $dadosLattes['orcid'] = Lattes::retornarOrcidID(null, $cvLattes);
        $dadosLattes['resumo'] = Lattes::retornarResumoCV(null, 'pt', $cvLattes);
        $dadosLattes['linhas_pesquisa'] = Lattes::listarLinhasPesquisa(null, $cvLattes);

        // array com as chaves do array final e os respectivos métodos a serem chamados
        $metodos = [
            'livros' => 'listarLivrosPublicados',
            'artigos' => 'listarArtigos',
            'capitulos' => 'listarCapitulosLivros',
            'jornal_revista' => 'listarTextosJornaisRevistas',
            'trabalhos_anais' => 'listarTrabalhosAnais',
            'outras_producoes_bibliograficas' => 'listarOutrasProducoesBibliograficas',
            'trabalhos_tecnicos' => 'listarTrabalhosTecnicos',
            'ultimo_vinculo_profissional' => 'listarFormacaoProfissional',
            'ultima_formacao' => 'retornarFormacaoAcademica',
            'organizacao_evento' => 'listarOrganizacaoEvento',
            'outras_producoes_tecnicas' => 'listarOutrasProducoesTecnicas',
            'curso_curta_duracao' => 'listarCursosCurtaDuracao',
            'relatorio_pesquisa' => 'listarRelatorioPesquisa',
            'material_didatico' => 'listarMaterialDidaticoInstrucional',
            'projetos_pesquisa' => 'listarProjetosPesquisa',
            'radio_tv' => 'listarRadioTV',
            'apresentacao_trabalho' => 'listarApresentacaoTrabalho',
        ];

        foreach ($metodos as $chave => $metodo) {
            $result = Lattes::$metodo(null, $cvLattes, 'anual', -1, null);
            $dadosLattes[$chave] = is_array($result) ? $result : null;
        }

        return $dadosLattes;
    }
}