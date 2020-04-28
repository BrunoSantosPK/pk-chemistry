<?php

    class Substancia implements Integridade {

        private $formulaQuimica = "";
        private $nome = "";
        private $mm = 0;
        private $h0;
        private $composicao = array();
        private $erro = false;
        private $descricaoErro = "";

        /**
         * Cria uma substância química, guardando uma fórmula química e um nome para ela. Se a fórmula estiver correta, a massa molar é automaticamente calculada.
         * @param string $formula String com a fórmula química da substância a ser criada. Ex.: H2O, H2SO4, NaCl e etc.
         * @param string $nome String com o nome para substância. Ex.: Água, Ácido Sulfúrico, Cloreto de Sódio e etc.
         */
        public function __construct($formula, $nome) {
            // Cálculos de definições
            $this->h0 = new UnidadeFisica(0, "J/mol");
            $this->setComp($formula)->setNome($nome)->criar();
        }

        /**
         * Altera a fórmula química da instância, podendo ser novamente montada pelo método público Substancia->criar().
         * @param string $formula String com a fórmula química da substância a ser criada. Ex.: H2O, H2SO4, NaCl e etc.
         * @return Substancia A própria instância da classe.
         */
        public function setComp($formula): Substancia {
            if(is_string($formula)) {
                $this->formulaQuimica = $formula;
            }
            return $this;
        }

        /**
         * Altera o nome interno para a substância. É chamada pelo construtor, mas pode ser alterado ao longo do código. Não é pre-requisito para a montagem do método público Substancia->criar().
         * @param string $nome String com o nome para substância. Ex.: Água, Ácido Sulfúrico, Cloreto de Sódio e etc.
         * @return Substancia A própria instância da classe.
         */
        public function setNome($nome): Substancia {
            if(is_string($nome)) {
                $this->nome = $nome;
            }
            return $this;
        }

        /**
         * Método para acessar a propriedade de massa molar.
         * @return float Massa molar da substância de fórmula química informada.
         */
        public function getMM(): float {
            return $this->mm;
        }

        // Implementação da interface
        public function getIntegridade(): bool {
            return !$this->erro;
        }

        // Implementação da interface
        public function getErro(): string {
            return $this->descricaoErro;
        }

        /**
         * Essa função permite a montagem dos elementos que compõem a fórmula química informada. Como resultado, calcula a massa molar da substância resultante.
         * @return Substancia Retorna a instância da classe Substancia utilizada.
         */
        public function criar(): Substancia {
            // Verifica se uma fórmula química e um nome foram devidamente setados
            if($this->formulaQuimica == "" || $this->nome == "") {
                $this->erro = true;
                $this->descricaoErro = "Nome ou fórmula química não declarados";
                return $this;
            }

            // Remove os parênteses, padronizando a string para leitura
            $formula = $this->norm($this->formulaQuimica);
            if($this->erro) {
                return $this;
            }

            // Verifica os elementos existentes e interpreta a fórmula
            $componentes = $this->interpretar($formula);
            if($this->erro) {
                return $this;
            }
            $this->composicao = $componentes;

            // Calcula a massa molar e atualiza o erro
            $this->calcMM();
            $this->erro = false;
            $this->descricaoErro = "";

            return $this;
        }

        public function detalhar() {
            $cards = array();

            // Verifica os elementos disponíveis, eliminando repetições
            foreach($this->composicao as $elemento) {
                $busca = $this->existe($elemento, $cards);

                if(!$busca[0]) {
                    $novoCard = array(
                        "simbolo" => $elemento["simbolo"],
                        "nome" => $elemento["elemento"]["nome"],
                        "mm" => $elemento["elemento"]["mm"],
                        "quantidade" => $elemento["multiplicador"],
                        "porcentagem" => $elemento["elemento"]["mm"] * ($elemento["multiplicador"]) / $this->mm
                    );

                    array_push($cards, $novoCard);
                } else {
                    $cards[$busca[1]]["quantidade"] += $elemento["multiplicador"];
                    $cards[$busca[1]]["porcentagem"] = ($cards[$busca[1]]["mm"] * $cards[$busca[1]]["quantidade"]) / $this->mm;
                }
            }

            return $cards;
        }

        private function existe($elemento, $lista) {
            for($i = 0; $i < count($lista); $i++) {
                if($lista[$i]["simbolo"] == $elemento["simbolo"]) {
                    return array(true, $i);
                }
            }
            return array(false, -1);
        }

        /**
         * Realiza o cálculo da massa molar, a partir de uma montagem prévia da molécula. É chamada sempre após a finalização do método público Substancia->criar(). Salva a massa molar na propriedade privada da classe.
         */
        private function calcMM(): void {
            $soma = 0;
            foreach($this->composicao as $unidade) {
                $soma += $unidade["elemento"]["mm"] * $unidade["multiplicador"];
            }
            $this->mm = $soma;
        }

        /**
         * Método interno de normalização de fórmula química. Na versão atual, trata dos parênteses nas fórmulas, transformando Fe2(SO4)3 em Fe2S3O12. Passo intermediário para interpretação dos elementos internamente.
         * @param string $formula Fórmula química originária.
         * @return string Fórmula química formatada.
         */
        private function norm($formula): string {
            // Verifica a existência de parênteses e correto fechamento
            $pares = $this->parear($formula);
            $init = $pares["init"];
            $finish = $pares["finish"];

            if(count($init) != count($finish)) {
                // Erro, parênteses não foram fechados
                $this->erro = true;
                $this->descricaoErro = "Os parênteses não estão pareados corretamente.";
                return $formula;
            }

            // Faz a substituição dos parênteses
            $novaFormula = $this->removerParenteses($init, $finish, $formula);

            // Controle: fórmula escrita com erro
            if($this->erro) {
                return $formula;
            } else {
                return $novaFormula;
            }
        }

        /**
         * Método interno para remoção de parênteses de uma fórmula química.
         * @param Array $init Array retornado do método interno Substancia->parear().
         * @param Array $finish Array retornado do método interno Substancia->parear().
         * @return string Fórmula química sem os parênteses, com coeficientes atualizados.
         */
        private function removerParenteses($init, $finish, $formula): string {
            // Critério de parada
            if(count($init) == 0 || count($finish) == 0) {
                return $formula;
            }

            // Inicialização de parâmetros
            $inicio = -1;
            $fim = strlen($formula) + 1;
            for($i = 0; $i < count($init); $i++) {
                // Encontra a abertura de parênteses
                $parInit = $init[$i]["par"];

                for($j = 0; $j < count($finish); $j++) {
                    // Encontra o fechamento de parênteses
                    $parFinish = $finish[$j]["par"];

                    if($parInit == $parFinish) {
                        // Verifica se é o par mais interno
                        if($init[$i]["indice"] > $inicio && $init[$i]["indice"] < $fim) {
                            $inicio = $init[$i]["indice"];
                            $fim = $finish[$j]["indice"];
                        }
                    }
                }
            }

            // Verifica a existência de multiplicador
            $multiplicador = "";
            $novoFim = $fim + 1;
            while($novoFim < strlen($formula) && $this->isNumber($formula[$novoFim])) {
                $multiplicador .= $formula[$novoFim];
                $novoFim++;
            }

            if($multiplicador === "")
                $multiplicador = "1";
            $multiplicador = intval($multiplicador);

            // Faz a nova string
            $intervalo = substr($formula, $inicio + 1, $fim - $inicio - 1);
            $dados = $this->interpretar($intervalo);

            // Controle de erro: fórmula com erro de escrita
            if($this->erro) {
                return $formula;
            }

            // Monta nova string
            $formulaFormat = "";
            foreach($dados as $dado) {
                $formulaFormat .= $dado["simbolo"] . ($multiplicador * $dado["multiplicador"]);
            }

            // Refatora a nova fórmula
            $formula = substr($formula, 0, $inicio) . $formulaFormat . substr($formula, $novoFim);

            // Refaz o pareamento
            $pares = $this->parear($formula);
            $init = $pares["init"];
            $finish = $pares["finish"];

            // Recursividade
            return $this->removerParenteses($init, $finish, $formula);
        }

        /**
         * Método interno que idendifica os elementos na fórmula. Coração da classe.
         * @param string $formula Fórmula química a ser lida e interpretada
         * @return Array Lista com os elementos identificados, com seus respectivos correspondentes na classe ElementoQuimico e suas quantidades.
         */
        private function interpretar($formula) {
            // Inicializa array de resposta e o ponteiro de busca na string
            $res = array();
            $i = 0;

            // Percorre a fórmula química
            while($i < strlen($formula)) {
                $char = $formula[$i];
                if($this->isNumber($char)) {
                    // Identificou um número
                    if($i == 0) {
                        // Lança erro, número não pode iniciar uma fórmula
                        $this->erro = true;
                        $this->descricaoErro = "Erro na escrita da fórmula química. Não pode ser inicializada com número";
                        break;
                    } else {
                        // Verifica se os próximos caracteres são números
                        $num = $char;
                        $j = $i + 1;
                        while($j < strlen($formula) && $this->isNumber($formula[$j])) {
                            $num .= $formula[$j];
                            $j++;
                        }

                        // Adiciona o multiplicador ao elemento anterior
                        $i = $j - 1;
                        $res[count($res) - 1]["multiplicador"] = intval($num);
                    }
                } else {
                    $elementoUmChar = ElementoQuimico::getElemento($char);
                    if($i + 1 < strlen($formula))
                        $elementoDoisChar = ElementoQuimico::getElemento($char . $formula[$i + 1]);
                    else
                        $elementoDoisChar = array();
                    $elemento = array();

                    if(count($elementoDoisChar) !== 0) {
                        // Identifica elemento composto por 2 caracteres
                        $char = $char . $formula[$i + 1];
                        $elemento = $elementoDoisChar;

                        // Avança o ponteiro de leitura
                        $i++;
                    } elseif(count($elementoUmChar) !== 0) {
                        // Identifica elemento composto por 1 caractere
                        $elemento = $elementoUmChar;
                    } else {
                        // Lança um erro
                        $this->erro = true;
                        $this->descricaoErro = "Erro na escrita da fórmula química. Caractere estranho (elemento não cadastrado ou não numérico).";
                        break;
                    }

                    // Cria elemento de adição
                    $dados = array(
                        "simbolo" => $char,
                        "elemento" => $elemento,
                        "multiplicador" => 1
                    );
                    array_push($res, $dados);
                }

                // Próximo caractere
                $i++;
            }

            return $res;
        }

        /**
         * Faz o pareamento dos parênteses. Método interno auxiliar.
         * @param string $formula Fórmula química.
         * @return Array Array com pares, init sendo as aberturas e finish sendo os fechamentos.
         */
        private function parear($formula): Array {
            $contPar = 1;
            $init = array();
            $finish = array();
            for($i = 0; $i < strlen($formula); $i++) {
                if($formula[$i] == "(") {
                    array_push($init, array("par" => $contPar, "indice" => $i, "close" => false));
                    $contPar++;
                }
                if($formula[$i] == ")") {
                    $par = 0;
                    for($j = count($init) - 1; $j >= 0; $j--) {
                        if(!$init[$j]["close"]) {
                            $par = $init[$j]["par"];
                            $init[$j]["close"] = true;
                            break;
                        }
                    }
                    array_push($finish, array("par" => $par, "indice" => $i));
                }
            }
            return array("init" => $init, "finish" => $finish);
        }

        /**
         * Esse método privado é apenas um auxílio para interpretação da fórmula química, utilizado pelo método público Substancia->criar().
         * @param string $str Caracter para validação.
         * @return bool Valor booleano que informa se é um modificador de quantidade.
         */
        private function isNumber($str): bool {
            $numeros = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
            $sim = false;
            for($i = 0; $i < count($numeros); $i++) {
                if($str == $numeros[$i]) {
                    $sim = true;
                    break;
                }
            }
            return $sim;
        }

    }

?>