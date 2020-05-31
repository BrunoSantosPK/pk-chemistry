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
    } elseif($acao == "novidades") {
        // Texto para novidades
        $novidades = "O aplicativo Massa Molar está na versão 1.0.1, verifique na Play Store a sua e atualize. Agora o aplicativo conta com uma Tabela Periódica interativa e uma breve descrição sobre Propriedades Periódicas. E claro, com uma interface bem mais legal.";

        $response = new Response();
        $response->validar();
        $response->add("novidades", $novidades);
        echo $response->getJSON();
    } else {
        $response = new Response();
        $response->add("erro", "Erro na URL");
        echo $response->getJSON();
    }

?>