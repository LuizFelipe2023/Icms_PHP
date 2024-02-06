<?php

$tabela_icms = [
    "Acre" => 0.19,
    "Alagoas" => 0.19,
    "Amazonas" => 0.2,
    "Amapá" => 0.18,
    "Bahia" => 0.19,
    "Ceará" => 0.2,
    "Distrito Federal" => 0.2,
    "Espirito Santo" => 0.17,
    "Goias" => 0.17,
    "Maranhão" => 0.2,
    "Minas Gerais" => 0.18,
    "Mato Grosso do Sul" => 0.17,
    "Mato Grosso" => 0.17,
    "Pará" => 0.19,
    "Paraíba" => 0.2,
    "Pernambuco" => 0.21,
    "Piauí" => 0.21,
    "Paraná" => 0.19,
    "Rio de Janeiro" => 0.18,
    "Rio Grande do Norte" => 0.18,
    "Rondônia" => 0.21,
    "Roraima" => 0.2,
    "Rio Grande do Sul" => 0.17,
    "Santa Catarina" => 0.17,
    "Sergipe" => 0.19,
    "São Paulo" => 0.18,
    "Tocatins" => 0.2
];

function calcularIcms($valor, $estado)
{
    global $tabela_icms;
    if (isset($tabela_icms[$estado])) {
        $icms = $valor * $tabela_icms[$estado];
        return $icms;
    } else {
        return "Estado não encontrado na tabela";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Calculadora de ICMS</title>
</head>

<body>

<div class="container">
    <h2 class="mt-5 mb-4">Calculadora de ICMS</h2>

    <form action="tabela_icms.php" method="post">
        <div class="form-group">
            <label for="valor">Valor da Mercadoria:</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>
        
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="" disabled selected>Selecione o estado</option>
                <?php
                $estados = array_keys($tabela_icms);
                foreach ($estados as $estado) {
                    echo "<option value=\"$estado\">$estado</option>";
                }
                ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Calcular ICMS</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = $_POST["valor"];
        $estado = $_POST["estado"];

        $icms = calcularIcms($valor, $estado);
        echo "<div class='container-fluid p-5 my-5 border'>
        <p class = 'text-center' >O valor do ICMS para uma mercadoria de R$ $valor em $estado é de R$ " . number_format($icms, 2) . ".</p>
        </div>";
    }
    ?>

</body>

</html>
