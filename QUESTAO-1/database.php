<?php
try {
  $pdo = new PDO('sqlite:database.db');
  
  $sql = "CREATE TABLE IF NOT EXISTS livros (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              livro TEXT NOT NULL,
              autor TEXT NOT NULL,
              ano TEXT NOT NULL
          )";
  $pdo->exec($sql);
  
  $action = isset($_GET['action']) ? $_GET['action'] : '';

  
  if ($action == 'create') {
     $id = $_POST['id'];
     $livro = $_POST['livro'];
     $autor = $_POST['autor'];
     $ano = $_POST['ano'];
     $stmt = $pdo->prepare("INSERT INTO livros (livro, autor, ano) VALUES (:livro, :autor, :ano)");
     $stmt->bindParam(':livro', $livro);
     $stmt->bindParam(':autor', $autor);
     $stmt->bindParam(':ano', $ano);
    if ($stmt->execute()) {
        echo "Livro registrado com sucesso!";
    } else {
        echo "Erro em registrar o livro!";
    }
  }
    if ($action == 'read') {
       $stmt = $pdo->query("SELECT * FROM livros");
       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
       echo json_encode($result);
    }
  
    if ($action == 'update') {
       $id = $_POST['id'];
       $livro = $_POST['livro'];
       $autor = $_POST['autor'];
       $ano = $_POST['ano'];
       $stmt = $pdo->prepare("UPDATE livros SET livro = :livro, autor = :autor, ano = :ano WHERE id = :id");
       $stmt->bindParam(':id', $id);
       $stmt->bindParam(':livro', $livro);
       $stmt->bindParam(':autor', $autor);
       $stmt->bindParam(':ano', $ano);
       if ($stmt->execute()) {
          echo "Registro de livro atualizado com sucesso!";
       } else {
          echo "Erro em atualizar o registro de livro!";
       }
    }
    if ($action == 'delete') {
       $id = $_GET['id'];
       $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
       $stmt->bindParam(':id', $id);
       if ($stmt->execute()) {
          echo "Registro de livro excluído com sucesso!";
       } else {
          echo "Erro ao excluir o registro de livro!";
       }
  }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>