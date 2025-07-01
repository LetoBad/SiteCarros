<?php
$id = $_GET["id"];
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";

$objDAO = new categoriaDAO();
$retorno = $objDAO->retornarUnico($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Categoria - Sistema de Veículos</title>
  <link rel="stylesheet" href="../styles.css" />
</head>
<body>
  <div class="container">
    <div class="form-container" style="max-width: 600px;">
      <h2 class="detail-title" style="text-align: center;">Editar Categoria</h2>

      <form action="editar_ok.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($retorno['id']) ?>" />

        <div class="form-group">
          <label for="nome" class="form-label">Nome da Categoria:</label>
          <input type="text" name="nome" id="nome" class="form-input"
                 value="<?= htmlspecialchars($retorno['nome']) ?>" required />
        </div>

        <button type="submit" class="form-button" style="width: 100%;">Salvar Alterações</button>
      </form>
    </div>
  </div>
</body>
</html>