<?php
include 'db.php';

// Verifica se um ID foi passado para marcar como pago
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Marca a conta como paga
    $sql = "UPDATE tbl_conta_pagar SET pago=1 WHERE id_conta_pagar='$id'";

    // Verifica se a atualização foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Conta marcada como paga!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão e redireciona para a página inicial
    $conn->close();
    header("Location: index.php");
    exit();
}
?>
