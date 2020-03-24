<?php
    // Interfaces
    include("../ExMachine/integridade.php");

    // Inclui as classes
    include("../ExMachine/unidade.php");
    include("../ExMachine/elemento.php");
    include("../ExMachine/response.php");
    include("../ExMachine/substancia.php");

    // Inclui as funções de manipulação de informação
    include("./valley/get.php");

    // Recupera informações da requisição
    $acao = $_REQUEST["acao"] ?? "";

    if($acao == "mm") {
        // Recupera informações e filtra falta de parâmetros
        $formula = $_REQUEST["formula"] ?? "";

        // Processa
        echo getMM($formula);
    } elseif($acao == "elementos") {
        // Verifica se busca um ou todos elementos, filtrando o parâmetro
        $query = $_REQUEST["query"] ?? "all";

        // Processa e envia
        echo getElementos($query);
    } else {
        $response = new Response();
        $response->add("erro", "Erro na URL");
        echo $response->getJSON();
    }

?>