<?php

    /*// Interfaces
    include("./ExMachine/integridade.php");

    // Classes
    include("./ExMachine/elemento.php");
    include("./ExMachine/conversor.php");
    include("./ExMachine/response.php");
    include("./ExMachine/unidade.php");
    include("./ExMachine/substancia.php");

    $fq1 = "Fe2(SO4)3";
    $nome1 = "Sulfato de Ferro III";
    $subs1 = new Substancia($fq1, $nome1);
    $mm1 = $subs1->getMM();
    echo "<br>Para a substância ".$nome1." (".$fq1."), temos a massa molar de: ".$mm1." g/mol<br>";

    $fq2 = "H2SO4";
    $nome2 = "Ácido da massa";
    $subs2 = new Substancia($fq2, $nome2);
    $mm2 = $subs2->getMM();
    echo "<br>Para a substância ".$nome2." (".$fq2."), temos a massa molar de: ".$mm2." g/mol<br>";

    $teste = "Fe2(SO4)3";
    echo "<br><br>Debug com nova funcionalidade: ".$teste."<br><br>";
    $subs1->norm($teste);*/

?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="testes.js"></script>
    </head>

    <style>
        .link { cursor: pointer; }
        .link:hover { text-decoration: underline; }
        .oculta { display: none; }
        .conteudo { height: 300px; border: 1px solid rgb(0,0,0); }
    </style>

    <body>
    
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Bem-vindo ao PKCHEMISTRY, uma biblioteca online para resolução de problemas da química.</h2>
                    <h5>Aos poucos, novas funcionalidades serão adicionadas aqui, com sua respectiva documentação. <a href="https://github.com/BrunoSantosPK/pk-chemistry">Link do projeto no GitHub.</a></h5>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-6">
                    <ul>
                        <li class="link" onclick="alterar('tabelaPeriodica')">Elementos Químicos (Tabela Periódica)</li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul>
                        <li class="link" onclick="alterar('mm')">Massa Molar de fórmulas químicas</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container mt-5 conteudo" id="mm">
            <div class="row">
                <div class="col-12">
                    <h3>Fórmula Química: Cálculo de Massa Molar</h3>
                    <p>Exemplo: NaCl, KCl, Fe2(SO4)3, CuSO4(H2O)5 e etc.</p>
                    <label>Infome aqui a fórmula química</label>
                    <input type="text" id="formula"><br>
                    <button onclick="calcMM()">Calcular</button>
                    <p id="resMM"></p>
                </div>
            </div>
        </div>

    </body>

    <script>
        function alterar(div) {
            $(".conteudo").addClass("oculta");
            $("#"+div).removeClass("oculta");
        }
    </script>

</html>