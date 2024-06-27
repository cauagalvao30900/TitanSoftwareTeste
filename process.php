<?php
include 'db.php';

// Verifica se o formulário foi submetido
if (isset($_POST['inserir'])) {
    // Captura os dados do formulário
    $empresa = $_POST['empresa'];
    $data_pagar = $_POST['data_pagar'];
    $valor = $_POST['valor'];

    // Insere os dados na tabela tbl_conta_pagar
    $sql = "INSERT INTO tbl_conta_pagar (valor, data_pagar, id_empresa) VALUES ('$valor', '$data_pagar', '$empresa')";

    // Verifica se a inserção foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Nova conta adicionada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão e redireciona para a página inicial
    $conn->close();
    header("Location: index.php");
    exit();
}
?>
