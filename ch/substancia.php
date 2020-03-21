<?php
    // Interfaces
    include("../ExMachine/integridade.php");

    // Inclui as classes
    include("../ExMachine/unidade.php");
    include("../ExMachine/elemento.php");
    include("../ExMachine/response.php");
    include("../ExMachine/substancia.php");

    // Recupera informações da requisição
    $acao = $_REQUEST["acao"] ?? "";

    if($acao == "mm") {
        // Recupera informações
        $formula = $_REQUEST["formula"];

        // Cria a classe de análise
        $substancia = new Substancia($formula, "Nome qualquer");

        if($substancia->getIntegridade()) {
            // Cálculo realizado com sucesso
            $mm = $substancia->getMM();
            $res = array("sucesso" => true, "massaMolar" => $mm);
        } else {
            // Erro de montagem
            $res = array("sucesso" => false, "erro" => $substancia->getErro());
        }

        echo json_encode($res);
    } else {
        echo json_encode(array("sucesso" => false, "erro" => "Erro na URL"));
    }

?>