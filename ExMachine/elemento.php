<?php

    class ElementoQuimico {

        public static $elementos = array(
            array("simbolo" => "H", "nome" => "Hidrogênio", "mm" => 1.008),
            array("simbolo" => "He", "nome" => "Hélio", "mm" => 4.0026),
            array("simbolo" => "Li", "nome" => "Lítio", "mm" => 6.94),
            array("simbolo" => "Be", "nome" => "Berílio", "mm" => 9.0122),
            array("simbolo" => "B", "nome" => "Boro", "mm" => 10.81),
            array("simbolo" => "C", "nome" => "Carbono", "mm" => 12.011),
            array("simbolo" => "N", "nome" => "Nitrogênio", "mm" => 14.007),
            array("simbolo" => "O", "nome" => "Oxigênio", "mm" => 15.999),
            array("simbolo" => "F", "nome" => "Flúor", "mm" => 18.998),
            array("simbolo" => "Ne", "nome" => "Neon", "mm" => 20.18),
            array("simbolo" => "Na", "nome" => "Sódio", "mm" => 22.99),
            array("simbolo" => "Mg", "nome" => "Magnésio", "mm" => 24.305),
            array("simbolo" => "Al", "nome" => "Alumínio", "mm" => 26.982),
            array("simbolo" => "Si", "nome" => "Silício", "mm" => 28.085),
            array("simbolo" => "P", "nome" => "Fósforo", "mm" => 30.974),
            array("simbolo" => "S", "nome" => "Enxofre", "mm" => 32.06),
            array("simbolo" => "Cl", "nome" => "Cloro", "mm" => 35.45),
            array("simbolo" => "Ar", "nome" => "Argônio", "mm" => 39.948),
            array("simbolo" => "K", "nome" => "Potássio", "mm" => 39.098),
            array("simbolo" => "Ca", "nome" => "Cálcio", "mm" => 40.078),
            array("simbolo" => "Sc", "nome" => "Escândio", "mm" => 44.956),
            array("simbolo" => "Ti", "nome" => "Titânio", "mm" => 47.867),
            array("simbolo" => "V", "nome" => "Vanádio", "mm" => 50.942),
            array("simbolo" => "Cr", "nome" => "Crômio", "mm" => 51.996),
            array("simbolo" => "Mn", "nome" => "Manganês", "mm" => 54.938),
            array("simbolo" => "Fe", "nome" => "Ferro", "mm" => 55.845),
            array("simbolo" => "Co", "nome" => "Cobalto", "mm" => 58.933),
            array("simbolo" => "Ni", "nome" => "Níquel", "mm" => 58.693),
            array("simbolo" => "Cu", "nome" => "Cobre", "mm" => 63.546),
            array("simbolo" => "Zn", "nome" => "Zinco", "mm" => 65.38),
            array("simbolo" => "Ga", "nome" => "Gálio", "mm" => 69.723),
            array("simbolo" => "Ge", "nome" => "Germânio", "mm" => 72.63),
            array("simbolo" => "As", "nome" => "Arsênio", "mm" => 74.922),
            array("simbolo" => "Se", "nome" => "Selênio", "mm" => 78.971),
            array("simbolo" => "Br", "nome" => "Bromo", "mm" => 79.904),
            array("simbolo" => "Kr", "nome" => "Criptônio", "mm" => 83.798),
            array("simbolo" => "Rb", "nome" => "Rubídio", "mm" => 85.468),
            array("simbolo" => "Sr", "nome" => "Estrôncio", "mm" => 87.62),
            array("simbolo" => "Y", "nome" => "Itrio", "mm" => 88.906),
            array("simbolo" => "Zr", "nome" => "Zircônio", "mm" => 91.224),
            array("simbolo" => "Nb", "nome" => "Nióbio", "mm" => 92.906),
            array("simbolo" => "Mo", "nome" => "Molibdênio", "mm" => 95.95),
            array("simbolo" => "Tc", "nome" => "Tecnécio", "mm" => 98),
            array("simbolo" => "Ru", "nome" => "Rutênio", "mm" => 101.07),
            array("simbolo" => "Rh", "nome" => "Ródio", "mm" => 102.91),
            array("simbolo" => "Pd", "nome" => "Paládio", "mm" => 106.42),
            array("simbolo" => "Ag", "nome" => "Prata", "mm" => 107.87),
            array("simbolo" => "Cd", "nome" => "Cádmio", "mm" => 112.41),
            array("simbolo" => "In", "nome" => "Indio", "mm" => 114.82),
            array("simbolo" => "Sn", "nome" => "Estanho", "mm" => 118.71),
            array("simbolo" => "Sb", "nome" => "Antimônio", "mm" => 121.76),
            array("simbolo" => "Te", "nome" => "Telúrio", "mm" => 127.6),
            array("simbolo" => "I", "nome" => "Iodo", "mm" => 126.9),
            array("simbolo" => "Xe", "nome" => "Xenônio", "mm" => 126.9),
            array("simbolo" => "Cs", "nome" => "Césio", "mm" => 132.91),
            array("simbolo" => "Ba", "nome" => "Bário", "mm" => 137.33),
            array("simbolo" => "La", "nome" => "Lantânio", "mm" => 138.91),
            array("simbolo" => "Ce", "nome" => "Cério", "mm" => 140.12),
            array("simbolo" => "Pr", "nome" => "Preseodímio", "mm" => 140.91),
            array("simbolo" => "Nd", "nome" => "Neodímio", "mm" => 144.24),
            array("simbolo" => "Pm", "nome" => "Promécio", "mm" => 145),
            array("simbolo" => "Sm", "nome" => "Samário", "mm" => 150.36),
            array("simbolo" => "Eu", "nome" => "Európio", "mm" => 151.96),
            array("simbolo" => "Gd", "nome" => "Gadolínio", "mm" => 157.25),
            array("simbolo" => "Tb", "nome" => "Térbio", "mm" => 158.93),
            array("simbolo" => "Dy", "nome" => "Disprósio", "mm" => 162.5),
            array("simbolo" => "Ho", "nome" => "Hólmio", "mm" => 164.93),
            array("simbolo" => "Er", "nome" => "Érbio", "mm" => 167.26),
            array("simbolo" => "Tm", "nome" => "Túlio", "mm" => 168.93),
            array("simbolo" => "Yb", "nome" => "Itérbio", "mm" => 173.05),
            array("simbolo" => "Lu", "nome" => "Lutécio", "mm" => 174.97),
            array("simbolo" => "Hf", "nome" => "Háfnio", "mm" => 178.49),
            array("simbolo" => "Ta", "nome" => "Tântalo", "mm" => 180.95),
            array("simbolo" => "W", "nome" => "Tungstênio", "mm" => 183.84),
            array("simbolo" => "Re", "nome" => "Rênio", "mm" => 186.21),
            array("simbolo" => "Os", "nome" => "Osmio", "mm" => 190.23),
            array("simbolo" => "Ir", "nome" => "Irídio", "mm" => 192.22),
            array("simbolo" => "Pt", "nome" => "Platina", "mm" => 195.08),
            array("simbolo" => "Au", "nome" => "Ouro", "mm" => 196.97),
            array("simbolo" => "Hg", "nome" => "Mercúrio", "mm" => 200.59)
        );

        /**
         * Retorna as propriedades de um elemento químico.
         * @param String $buscador Representa o elemento a ser buscado. Pode ser a sigla dele na tabela ou o nome completo, em português do Brasil.
         * @return Array Retorna um array com as informações do elemento, ou retorna array() caso não encontre o elemento. Ocorre no caso de erro no buscador ou elemento não cadastrado no banco de dados.
        */
        public static function getElemento($buscador): array {
            // Verifica a quantidade de caracteres existentes
            $numCar = strlen(utf8_decode($buscador));

            // Inicia o tipo de busca
            $attr = "simbolo";
            $res = array();

            if($numCar > 2) {
                // Trata-se do nome do elemento
                $attr = "nome";
                $buscador = mb_convert_case($buscador, MB_CASE_TITLE, "UTF-8");
            }

            // Faz a busca
            foreach(ElementoQuimico::$elementos as $elemento) {
                if($elemento[$attr] == $buscador)
                    $res = $elemento;
            }

            return $res;
        }

        /**
         * Método estático para encontrar todos os elementos químicos cadastrados na classe ElementoQuimico. Retorna uma lista de arrays.
         * @return array Lista com arrays (JSON) para cada elemento.
         */
        public static function getAll(): array {
            $res = array();
            foreach(ElementoQuimico::$elementos as $elemento) {
                array_push($res, $elemento);
            }
            return $res;
        }

    }

?>