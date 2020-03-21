<?php

    class Response {

        /**
         * Retorna um array simples, com chave de sucesso e dada.
         * @param bool $padrao Opcional. Define como a chave de sucesso será criada. O padrão é criar sempre com valor negativo booleano.
         * @return array Envia um array tipo array("sucesso" => false, "data" => "").
         */
        public static function getSimple($padrao = false) {
            $res = array("sucesso" => $padrao, "data" => "");
            return $res;
        }

    }

?>