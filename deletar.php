<?php
include 'db.php';

// Verifica se um ID foi passado para exclusão
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Deleta a conta a pagar
    $sql = "DELETE FROM tbl_conta_pagar WHERE id_conta_pagar='$id'";

    // Verifica se a exclusão foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        echo "Conta deletada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão e redireciona para a página inicial
    $conn->close();
    header("Location: index.php");
    exit();
}
?>
