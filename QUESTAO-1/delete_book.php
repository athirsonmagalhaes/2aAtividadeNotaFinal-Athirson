<?php
function remove(id) {
if (confirm('Tem certeza que deseja excluir este livro?')) {
  fetch(`database.php?action=delete&id=${id}`)
  .then(response => response.text())
  .then(data => {
    alert(data);
    loadData();
  })
?>