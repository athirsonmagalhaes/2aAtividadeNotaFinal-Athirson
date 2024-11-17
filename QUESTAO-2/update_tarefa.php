<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE tarefas SET concluida = 1 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Erro ao marcar tarefa como concluída.";
    }
}
?>