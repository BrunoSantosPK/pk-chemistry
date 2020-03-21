<?php

    interface Integridade {
        /**
         * Verifica se a classe executou seus cálculos internos sem encontrar erro.
         */
        public function getIntegridade(): bool;

        /**
         * Retorna o texto para um erro de execução de cálculo interno da classe.
         */
        public function getErro(): String;
    }

?>