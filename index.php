<?php

    // Interfaces
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
    $subs1->norm($teste);

?>