<?php

    class UnidadeFisica {

        /**
         * Cria uma instância de unidade física
         * @param float $valor Valor numérico da unidade.
         * @param string $unidade String com a unidade física.
         */
        public function __construct($valor, $unidade) {
            $unidade = array(
                "valor" => $valor,
                "unidade" => $unidade
            );
        }

        public function getUnidade() {
            return $this->unidade["unidade"];
        }

        public function getValor() {
            return $this->unidade["valor"];
        }

    }

?>