<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Dados Livraria</title>
    <style>
      body {
        background-color: lightblue;
        color: darkviolet;
        font-family: Arial, sans-serif;
      }
    </style>
    <script>
      function loadData() {
        fetch('database.php?action=read')
        .then(response => response.json())
        .then(data => {
          let table = document.getElementById('data');
          table.innerHTML = '';
          data.forEach(row => {
            table.innerHTML +=`
              <tr>
                <td>${row.id}</td>
                <td>${row.livro}</td>
                <td>${row.autor}</td>
                <td>${row.ano}</td>
                <td>
                  <button onclick="edit(${row.id}, '${row.livro}', '${row.autor}', '${row.ano}')">Editar</button>
                  <button onclick="remove(${row.id})">Excluir</button>
                </td>
              </tr>
              `
            ;
          });
        });
      }
      function save() {
        let id = document.getElementById('id').value;
        let livro = document.getElementById('livro').value;
        let autor = document.getElementById('autor').value;
        let ano = document.getElementById('ano').value;

        let formData = new FormData();
        formData.append('id', id);
        formData.append('livro', livro);
        formData.append('autor', autor);
        formData.append('ano', ano);

        let action = id ? 'update' : 'create';

        fetch(`database.php?action=${action}`, {
             method: 'POST', 
             body: formData
        })
        .then(response => response.text())
        .then(data => {
          alert(data);
          loadData();
          clearForm();
        });
      }
      function edit(id, livro, autor, ano) {
        document.getElementById('id').value = id;
        document.getElementById('livro').value = livro;
        document.getElementById('autor').value = autor;
        document.getElementById('ano').value = ano;
      }
      function remove(id) {
        if (confirm('Tem certeza que deseja excluir este livro?')) {
          fetch(`database.php?action=delete&id=${id}`)
          .then(response => response.text())
          .then(data => {
            alert(data);
            loadData();
          })
        }
      }
      function clearForm() {
        document.getElementById('id').value = '';
        document.getElementById('livro').value = '';
        document.getElementById('autor').value = '';
        document.getElementById('ano').value = '';
      }
      window.onload = loadData;
    </script>
    <body>
        <h2>Banco de Dados Livraria</h2>
        <form onsubmit="event.preventDefault(); save();">
          <input type="hidden" id="id">
          <label for="livro">Livro:</label>
          <input type="text" id="livro" required><br><br>
          
          <label for="autor">Autor:</label>
          <input type="text" id="autor" required><br><br>
          
          <label for="ano">Ano Publicado:</label>
          <input type="text" id="ano" required><br><br>
          
          <input type="submit" value="Salvar">
          <button type="button" onclick="clearForm()">Limpar</button>
        </form>
      
        <h3>Livros Registrados</h3>
        <table border="1">
        <thead>
          <tr>
              <th>ID</th>
              <th>Livro</th>
              <th>Autor</th>
              <th>Ano Publicado</th>
              <th>Ações</th>
          </tr>
        </thead>
      <tbody id="data">
      </tbody>
    </table>
  </body>
</html>
