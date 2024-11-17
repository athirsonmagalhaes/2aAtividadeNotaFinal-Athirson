<?php
include 'database.php'; 

$query = "SELECT * FROM tarefas ORDER BY id DESC";
$stmt = $pdo->query($query);
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>
    <form action="add_tarefa.php" method="POST">
        <label for="descricao">Descrição da Tarefa:</label>
        <input type="text" name="descricao" required>
        <label for="data_vencimento">Data de Vencimento:</label>
        <input type="date" name="data_vencimento" required>
        <button type="submit">Adicionar Tarefa</button>
    </form>

    <h2>Tarefas Pendentes</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <?php if ($tarefa['concluida'] == 0): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['descricao']); ?> (Vencimento: <?php echo $tarefa['data_vencimento']; ?>)
                    <a href="update_tarefa.php?id=<?php echo $tarefa['id']; ?>">Marcar como concluída</a> |
                    <a href="delete_tarefa.php?id=<?php echo $tarefa['id']; ?>">Excluir</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <h2>Tarefas Concluídas</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <?php if ($tarefa['concluida'] == 1): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['descricao']); ?> (Vencimento: <?php echo $tarefa['data_vencimento']; ?>)
                    <a href="delete_tarefa.php?id=<?php echo $tarefa['id']; ?>">Excluir</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

</body>
</html>