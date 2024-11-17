<?php

include 'database.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tarefas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: index.php'); 
    } else {
        echo "Erro ao excluir tarefa.";
    }
}
?>