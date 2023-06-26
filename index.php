<!DOCTYPE html>
<html lang="pt-br">

<?php
    require('api.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <!-- Import CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Import JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- Import external JS -->
    <script src="script.js"></script>
</head>

<body>

    <h4>Lista de funcionários</h4>
    <p>Filtros</p>

    <form class="form-inline" method="POST" action="index.php">
        <div class="form-group mx-sm-3 mb-2">
            <select id="nomeCompleto" name="filtroCampo" onchange="atualizarOpcoes()" 
            class="form-control" aria-label=".form-select-lg example" >
                <option value="id" selected>ID</option>
                <option value="NomeCompleto">NomeCompleto</option>
                <option value="DataNascimento">DataNascimento</option>
                <option value="Salario">Salario</option>s
            </select>
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2" class="sr-only">Valor</label>
            <input name="valor_filtrado" type="text" class="form-control" id="valor_filtrado" placeholder="Digite um valor" required>
        </div>
        
        <div class="form-group mx-sm-3 mb-2">
            <select name="filtroCondicao" id="filtro" class="form-control"></select>
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
        
    </form>
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="50%">
        <thead>
            <tr>
                <th class="th-sm">ID

                </th>

                <th class="th-sm">Nome Completo

                </th>
                <th class="th-sm">Data de Nascimento

                </th>
                <th class="th-sm">Salario

                </th>

            </tr>
        </thead>
        <tbody>
            <?php
                //echo 'valor_filtrado '.trim($_POST['valor_filtrado']);
                if (isset($_POST['valor_filtrado'])) {
                    $campo = $_POST['filtroCampo'];
                    $valor_filtrado = trim($_POST['valor_filtrado']);
                    $filtro_condicao = $_POST['filtroCondicao'];
                    $data = listar_filtro($campo,$valor_filtrado,$filtro_condicao);
                    $perPage = 12; // Itens por página
                    $totalItems = count($data); // Total de itens
                    $totalPages = ceil($totalItems / $perPage); // Total de páginas
                    
                    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual
                    $offset = ($page - 1) * $perPage; // Deslocamento para a página atual

                    // Extrair os itens para a página atual
                    $currentPageData = array_slice($data, $offset, $perPage);

                    foreach ($currentPageData as $funcionario) {
                        echo '<tr>';
                        echo '<td class="text-center">' . $funcionario->id . '</td>';
                        echo '<td>' . $funcionario->NomeCompleto . '</td>';
                        echo '<td>' . date("d/m/Y", strtotime($funcionario->DataNascimento)) . '</td>';
                        echo "<td>" . number_format($funcionario->Salario, 2, ',', '.') . "</td>";
                        echo '</tr>';
                    }

                }else{
                    $data = listar_todos('LISTAR-TODOS');
                    $perPage = 12; // Itens por página
                    $totalItems = count($data); // Total de itens
                    $totalPages = ceil($totalItems / $perPage); // Total de páginas
                    
                    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Página atual
                    $offset = ($page - 1) * $perPage; // Deslocamento para a página atual

                    // Extrair os itens para a página atual
                    $currentPageData = array_slice($data, $offset, $perPage);

                    foreach ($currentPageData as $funcionario) {
                        echo '<tr>';
                        echo '<td>' . $funcionario->id . '</td>';
                        echo '<td>' . $funcionario->NomeCompleto . '</td>';
                        echo '<td>' . date("d/m/Y", strtotime($funcionario->DataNascimento)) . '</td>';
                        echo "<td>" . number_format($funcionario->Salario, 2, ',', '.') . "</td>";
                        echo '</tr>';
                    }
                }
            ?>  

        </tbody>

    </table>

        <?php
            // Exibir a navegação de paginação
            echo '<ul class="pagination justify-content-center">';
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Anterior</a></li>';
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($page < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Próxima</a></li>';
            }
            echo '</ul>';

        ?>

</body>

</html>