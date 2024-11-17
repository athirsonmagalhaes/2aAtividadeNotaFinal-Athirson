<?php
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
?>