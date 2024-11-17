<?php

include 'database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $data_vencimento = $_POST['data_vencimento'];

    $sql = "INSERT INTO tarefas (descricao, data_vencimento) VALUES (:descricao, :data_vencimento)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data_vencimento', $data_vencimento);

    if ($stmt->execute()) {
        header('Location: index.php'); 
    } else {
        echo "Erro ao adicionar tarefa.";
    }
}
?>