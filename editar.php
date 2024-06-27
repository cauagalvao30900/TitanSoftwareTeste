<?php
include 'db.php';

// Verifica se o formulário de edição foi submetido
if (isset($_POST['editar'])) {
    // Captura os dados do formulário
    $id = $_POST['id'];
    $empresa = $_POST['empresa'];
    $data_pagar = $_POST['data_pagar'];
    $valor = $_POST['valor'];

    // Atualiza os dados da conta a pagar
    $sql = "UPDATE tbl_conta_pagar SET valor='$valor', data_pagar='$data_pagar', id_empresa='$empresa' WHERE id_conta_pagar='$id'";

    // Verifica se a atualização foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Conta atualizada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão e redireciona para a página inicial
    $conn->close();
    header("Location: index.php");
    exit();
}

// Verifica se um ID foi passado para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tbl_conta_pagar WHERE id_conta_pagar='$id'");
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Editar Conta a Pagar</title>
    </head>
    <body>
        <h1>Editar Conta a Pagar</h1>
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id_conta_pagar']; ?>">
            <label for="empresa">Empresa:</label>
            <select name="empresa" id="empresa" required>
                <?php
                // Busca todas as empresas cadastradas para preencher o select
                $empresas = $conn->query("SELECT * FROM tbl_empresa");
                while ($empresa = $empresas->fetch_assoc()) {
                    $selected = $empresa['id_empresa'] == $row['id_empresa'] ? 'selected' : '';
                    echo "<option value='" . $empresa['id_empresa'] . "' $selected>" . $empresa['nome'] . "</option>";
                }
                ?>
            </select>
            <br>
            <label for="data_pagar">Data a ser pago:</label>
            <input type="date" id="data_pagar" name="data_pagar" value="<?php echo $row['data_pagar']; ?>" required>
            <br>
            <label for="valor">Valor:</label>
            <input type="number" step="0.01" id="valor" name="valor" value="<?php echo $row['valor']; ?>" required>
            <br>
            <button type="submit" name="editar">Atualizar</button>
        </form>
    </body>
    </html>
    <?php
}
?>
