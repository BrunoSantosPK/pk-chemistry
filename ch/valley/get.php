<?php

    function getMM($formulaQuimica) {
        // Cria a classe de análise e de resposta
        $substancia = new Substancia($formulaQuimica, "Nome qualquer");
        $response = new Response();
        $response->add("formulaQuimica", $formulaQuimica);

        if($substancia->getIntegridade()) {
            // Cálculo realizado com sucesso
            $mm = $substancia->getMM();

            // Monta a resposta
            $response->validar();
            $response->add("massaMolar", $mm);
        } else {
            // Erro de montagem
            $response->add("erro", $substancia->getErro());
        }

        // Envia json de resposta
        return $response->getJSON();
    }

    function getElementos($query) {
        // Executa a busca de acordo com a query
        if($query == "all") {
            $dados = ElementoQuimico::getAll();
        } else {
            $dados = ElementoQuimico::getElemento($query);
        }

        // Monta a resposta
        $response = new Response();
        $response->validar();
        $response->add("buscador", $query);
        $response->add("resultado", $dados);

        // Envia json de resposta
        return $response->getJSON();
    }

?>