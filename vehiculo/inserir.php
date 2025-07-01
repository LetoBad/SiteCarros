
<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../usuario/login.php");
    exit();
}

include_once "../class/categoriaDAO.class.php";

$categoriaDAO = new categoriaDAO();
$categorias = $categoriaDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastrar Veículo - Sistema de Veículos</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <div class="container">
    <div class="form-container" style="max-width: 600px;">
      <h2 style="text-align: center;">Cadastrar Novo Veículo</h2>

      <?php if (isset($_SESSION['message'])): ?>
        <div class="message <?= $_SESSION['message_type'] ?>">
          <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <form action="inserir_ok.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="placa" class="form-label">Placa:</label>
          <input type="text" id="placa" name="placa" class="form-input" required>
        </div>

        <div class="form-group">
          <label for="modelo" class="form-label">Modelo:</label>
          <input type="text" id="modelo" name="modelo" class="form-input" required>
        </div>

        <div class="form-group">
          <label for="marca" class="form-label">Marca:</label>
          <input type="text" id="marca" name="marca" class="form-input" required>
        </div>

        <div class="form-group">
          <label for="ano" class="form-label">Ano:</label>
          <input type="number" id="ano" name="ano" class="form-input" min="1900" max="2099" required>
        </div>

        <div class="form-group">
          <label for="cor" class="form-label">Cor:</label>
          <input type="text" id="cor" name="cor" class="form-input" required>
        </div>

        <div class="form-group">
          <label for="id_categoria" class="form-label">Categoria:</label>
          <select id="id_categoria" name="id_categoria" class="form-input" required>
            <option value="">Selecione uma categoria</option>
            <?php foreach ($categorias as $categoria): ?>
              <option value="<?= $categoria['id'] ?>">
                <?= htmlspecialchars($categoria['nome']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="imagem" class="form-label">Imagem:</label>
          <input type="file" id="imagem" name="imagem" class="form-input" accept="image/*" required>
        </div>

        <button type="submit" class="form-button">Cadastrar Veículo</button>
      </form>

      <div style="text-align: center; margin-top: 20px;">
        <a href="../index.php" class="action-button back">Voltar</a>
      </div>
    </div>
  </div>
</body>
</html>
