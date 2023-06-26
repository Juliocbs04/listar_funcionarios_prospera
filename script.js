

function atualizarOpcoes() {
    var nomeCompleto = document.getElementById("nomeCompleto").value;
    var filtro = document.getElementById("filtro");

    // Limpar as opções existentes
    filtro.innerHTML = "";
    // Definir as opções com base na seleção da SELECT via js
    if (nomeCompleto === "NomeCompleto") {
        var opcao1 = new Option("NãoContém", "NAO_CONTEM");
        var opcao2 = new Option("CONTEM", "CONTEM");
        var opcao3 = new Option("IGUAL", "IGUAL");
        filtro.add(opcao1);
        filtro.add(opcao2);
        filtro.add(opcao3);
    } else if (nomeCompleto === "DataNascimento") {
        var opcao1 = new Option("MENOR_IGUAL(<=)", "MENOR_IGUAL");
        var opcao2 = new Option("MENOR(<)", "MENOR");
        var opcao3 = new Option("MAIOR_IGUAL(>=)", "MAIOR_IGUAL");
        var opcao4 = new Option("MAIOR(>)", "MAIOR");
        var opcao5 = new Option("DIFERENTE", "DIFERENTE");
        var opcao6 = new Option("IGUAL", "IGUAL");

        filtro.add(opcao1);
        filtro.add(opcao2);
        filtro.add(opcao3);
        filtro.add(opcao4);
        filtro.add(opcao5);
        filtro.add(opcao6);
    } else if (nomeCompleto === "Salario") {
        var opcao1 = new Option("MENOR_IGUAL(<=)", "MENOR_IGUAL");
        var opcao2 = new Option("MENOR(<)", "MENOR");
        var opcao3 = new Option("MAIOR_IGUAL(>=)", "MAIOR_IGUAL");
        var opcao4 = new Option("MAIOR(>)", "MAIOR");
        var opcao5 = new Option("DIFERENTE", "DIFERENTE");
        var opcao6 = new Option("IGUAL", "IGUAL");

        filtro.add(opcao1);
        filtro.add(opcao2);
        filtro.add(opcao3);
        filtro.add(opcao4);
        filtro.add(opcao5);
        filtro.add(opcao6);
    }


}