<?php

try {
    $pdo = new PDO('sqlite:questao-2.db'); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db = "CREATE TABLE IF NOT EXISTS tarefas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        descricao TEXT NOT NULL,
        data_vencimento TEXT,
        concluida INTEGER DEFAULT 0
    )";
    $pdo->exec($db);

} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit;
}
?>