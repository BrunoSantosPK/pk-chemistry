function calcMM() {
    const formula = $("#formula").val();
    const url = `./ch/comando.php?acao=mm&formula=${formula}`;
    const type = "GET";
    const data = {};
    const callback = (res) => {
        const div = $("#resMM");
        div.html("");
        div.append(`Fórmula Química Informada: ${formula}<br>`);
        
        if(res.sucesso) {
            div.append(`Massa Molar (g/mol): ${res.massaMolar.toString().replace(".", ",")}`);
        } else {
            div.append(`Um erro ocorreu: ${res.erro}`);
        }
    };
    req(url, type, data, callback);
    return false;
}


function req(url, type, data, callback) {
    $.ajax({
        url,
        dataType: "json",
        type,
        data,
        success: data => callback(data),
        error: erro => {
            console.log(erro);
        }
    });
}