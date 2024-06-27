<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Controle Financeiro</title>
</head>
<body>
    <h1>Adicionar Conta a Pagar</h1>
    <form action="process.php" method="POST">
        <label for="empresa">Empresa:</label>
        <select name="empresa" id="empresa" required>
            <?php
            // Busca todas as empresas cadastradas para preencher o select
            $result = $conn->query("SELECT * FROM tbl_empresa");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_empresa'] . "'>" . $row['nome'] . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="data_pagar">Data a ser pago:</label>
        <input type="date" id="data_pagar" name="data_pagar" required>
        <br>
        <label for="valor">Valor:</label>
        <input type="number" step="0.01" id="valor" name="valor" required>
        <br>
        <button type="submit" name="inserir">Inserir</button>
    </form>

    <h2>Contas a Pagar</h2>
    <table border="1">
        <tr>
            <th>Empresa</th>
            <th>Data a Pagar</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php
        // Busca todas as contas a pagar cadastradas para listar na tabela
        $result = $conn->query("SELECT cp.*, e.nome FROM tbl_conta_pagar cp JOIN tbl_empresa e ON cp.id_empresa = e.id_empresa");
        while ($row = $result->fetch_assoc()) {
            $status = $row['pago'] ? 'Pago' : 'Pendente';
            echo "<tr>
                    <td>" . $row['nome'] . "</td>
                    <td>" . $row['data_pagar'] . "</td>
                    <td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>
                    <td>" . $status . "</td>
                    <td>
                        <a href='editar.php?id=" . $row['id_conta_pagar'] . "'>Editar</a> |
                        <a href='deletar.php?id=" . $row['id_conta_pagar'] . "'>Deletar</a> |
                        <a href='marcar_pago.php?id=" . $row['id_conta_pagar'] . "'>Marcar como Pago</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Filtrar Contas a Pagar</h2>
    <form action="index.php" method="GET">
        <label for="filtro_empresa">Empresa:</label>
        <input type="text" id="filtro_empresa" name="filtro_empresa">
        <br>
        <label for="filtro_valor">Valor:</label>
        <select id="filtro_valor_condicao" name="filtro_valor_condicao">
            <option value="=">Igual</option>
            <option value=">">Maior</option>
            <option value="<">Menor</option>
        </select>
        <input type="number" step="0.01" id="filtro_valor" name="filtro_valor">
        <br>
        <label for="filtro_data">Data a Pagar:</label>
        <input type="date" id="filtro_data" name="filtro_data">
        <br>
        <button type="submit" name="filtrar">Filtrar</button>
    </form>

    <?php
    // Filtro para busca de contas a pagar
    if (isset($_GET['filtrar'])) {
        $query = "SELECT cp.*, e.nome FROM tbl_conta_pagar cp JOIN tbl_empresa e ON cp.id_empresa = e.id_empresa WHERE 1=1";
        if (!empty($_GET['filtro_empresa'])) {
            $query .= " AND e.nome LIKE '%" . $_GET['filtro_empresa'] . "%'";
        }
        if (!empty($_GET['filtro_valor'])) {
            $query .= " AND cp.valor " . $_GET['filtro_valor_condicao'] . " " . $_GET['filtro_valor'];
        }
        if (!empty($_GET['filtro_data'])) {
            $query .= " AND cp.data_pagar = '" . $_GET['filtro_data'] . "'";
        }
        $result = $conn->query($query);
        echo "<table border='1'>
                <tr>
                    <th>Empresa</th>
                    <th>Data a Pagar</th>
                    <th>Valor</th>
                    <th>Status
