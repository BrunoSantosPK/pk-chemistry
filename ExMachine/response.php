<?php

    class Response {

        private $res = array("sucesso" => false);

        /**
         * Retorna um array simples, com chave de sucesso e dada.
         * @param bool $padrao Opcional. Define como a chave de sucesso será criada. O padrão é criar sempre com valor negativo booleano.
         * @return array Envia um array tipo array("sucesso" => false, "data" => "").
         */
        public static function getSimple($padrao = false) {
            $res = array("sucesso" => $padrao, "data" => "");
            return $res;
        }

        /**
         * Adiciona uma chave (atributo) do JSON
         * @param string $chave Nome do atributo.
         * @param any $valor Conteúdo do atributo a ser armazenado.
         * @return Response A instância manipulada
         */
        public function add($chave, $valor): Response {
            $this->res[$chave] = $valor;
            return $this;
        }

        /**
         * Altera o atributo padrão de sucesso de envio.
         * @return Response A instância manipulada
         */
        public function validar(): Response {
            $this->res["sucesso"] = true;
            return $this;
        }

        /**
         * Faz a transformação dos dados internos para o padrão JSON, em uma string.
         * @return string String no formato JSON.
         */
        public function getJSON(): string {
            return json_encode($this->res);
        }

    }

?>