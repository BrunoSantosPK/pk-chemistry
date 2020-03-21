<?php

    class Conversor {

        public static $unidades = array(
            "massa" => array(
                "unidades" => array("kg", "g", "mg", "ug", "lbm", "oz", "ton"),
                "fatores" => array(1, 1000, 1000000, 1000000000, 2.20462, 35.274, 0.001),
                "convercao" => "simples"
            ),
            "tempo" => array(
                "unidades" => array("h", "min", "s", "ms"),
                "fatores" => array(1, 60, 3600, 3600000),
                "convercao" => "simples"
            ),
            "mol" => array(
                "unidades" => array("mol", "kmol", "lbmol"),
                "fatores" => array(1, 1000, 0.0022046226),
                "convercao" => "simples"
            ),
            "comprimento" => array(
                "unidades" => array("m", "cm", "mm", "um", "A", "in", "ft", "jardas", "milhas"),
                "fatores" => array(1, 100, 1000, 1000000, 10000000000, 39.37, 3.2808, 1.0936, 0.0006214),
                "convercao" => "simples"
            ),
            "area" => array(
                "unidades" => array("m2", "cm2", "mm2", "um2", "A2", "in2", "ft2", "jardas2", "milhas2"),
                "fatores" => array(1, 10000, 1000000, 1000000000000, 1549.9969, 10.76364864, 1.19596096, 0.00000038613796),
                "convercao" => "simples"
            ),
            "volume" => array(
                "unidades" => array("m3", "L", "cm3", "mL", "ft3", "gal"),
                "fatores" => array(1, 1000, 1000000, 1000000, 35.3145, 264.17),
                "convercao" => "simples"
            ),
            "forca" => array(
                "unidades" => array("N", "lbf", "kgf", "dina", "kN"),
                "fatores" => array(1, 0.22489, 0.1019716213, 100000, 0.001),
                "convercao" => "simples"
            ),
            "energia" => array(
                "unidades" => array("J", "kJ", "cal", "kcal", "lbf.ft", "BTU", "kW.h"),
                "fatores" => array(1, 0.001, 0.23901, 0.00023901, 0.7379, 0.0009486, 0.0000002778),
                "convercao" => "simples"
            ),
            "potencia" => array(
                "unidades" => array("W", "cal/s", "lbf.ft/s", "BTU/s", "HP", "BTU/h", "kJ/h", "kW", "kcal/h"),
                "fatores" => array(1, 0.23901, 0.7376, 0.0009486, 0.001341, 3.41496, 3.6, 0.001, 0.860436),
                "convercao" => "simples"
            ),
            "pressao" => array(
                "unidades" => array("atm", "Pa", "kPa", "bar", "dina/cm2", "kgf/cm2", "mmHg", "psi", "mH20"),
                "fatores" => array(1, 101325, 101.325, 1.01325, 1013250, 1.033, 760, 14.696, 10.333),
                "convercao" => "simples"
            ),
            "viscosidadeDinamica" => array(
                "unidades" => array("Pa.s", "P", "cP", "lbf.s/in2", "lbf.s/ft2", "lbm/ft.s"),
                "fatores" => array(1, 10, 1000, 0.0001450377, 0.0208854342, 0.6719689751),
                "convercao" => "simples"
            ),
            "temperatura" => array(
                "unidades" => array("C", "F", "K", "R"),
                "convercao" => "temperatura"
            )
        );

        private static function calcular($modo, $dados, $valor, $de, $para) {
            if($modo == "simples") {
                $i = array_search($de, $dados["unidades"]);
                $j = array_search($para, $dados["unidades"]);
                $valor = $valor * $dados["fatores"][$j] / $dados["fatores"][$i];
            } elseif($modo == "temperatura") {
                // Converte para Kelvin
                if($de == "C")
                    $valor += 273.15;
                elseif($de == "F")
                    $valor = ($valor + 459.67) / 1.8;
                elseif($de == "R")
                    $valor /= 1.8;

                // Converte para destino
                if($para == "C")
                    $valor -= 273.15;
                elseif($para == "F")
                    $valor = $valor * 1.8 - 459.67;
                elseif($para == "R")
                    $valor *= 1.8;
            }

            return $valor;
        }

        public static function converter($tipo, $valor, $de, $para) {
            // Obtêm padrão de resposta
            $res = Response::getSimple();

            if(array_key_exists($tipo, Conversor::$unidades)) {
                // Propriedade cadastrada para conversão
                $dados = Conversor::$unidades[$tipo];
                $modo = Conversor::$unidades[$tipo]["convercao"];

                if(in_array($de, $dados["unidades"]) && in_array($para, $dados["unidades"])) {
                    // As unidades informadas estão cadastradas
                    $valorConvertido = Conversor::calcular($modo, $dados, $valor, $de, $para);

                    // Define o data de resposta
                    $res["sucesso"] = true;
                    $res["data"] = array(
                        "antigo" => array(
                            "valor" => $valor,
                            "unidade" => $de
                        ),
                        "novo" => array(
                            "valor" => $valorConvertido,
                            "unidade" => $para
                        )
                    );
                } else {
                    // As unidades informadas não estão cadastradas
                    $res["data"] = "As unidades informadas não estão cadastradas no sistema.";
                }
            } else {
                // Propriedade não cadastrada
                $res["data"] = "A propriedade informada não está cadastrada no banco.";
            }

            return $res;
        }

    }

?>