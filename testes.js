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
            div.append(`Massa Molar (g/mol): ${res.massaMolar.toString().replace(".", ",")}<br>`);
            div.append(`Foram encontrados ${res.detalhes.length} elementos.<br>`);

            // Callback para normalizar uma porcentagem
            const norm = (valor) => {
                return (valor * 100).toFixed(2).replace(".", ",");
            };

            // Percorre os elementos
            for(let i = 0; i < res.detalhes.length; i++) {
                div.append(`${i + 1}) ${res.detalhes[i].nome}: ${norm(res.detalhes[i].porcentagem)} %.<br>`);
            }
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