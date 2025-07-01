<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../usuario/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Categoria - Sistema de Veículos</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <div class="container">
    <div class="form-container">
      <h2>Cadastrar Nova Categoria</h2>

      <?php if (isset($_SESSION['message'])): ?>
        <div class="message <?= $_SESSION['message_type'] ?>">
          <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <form action="inserir_ok.php" method="post">
        <div class="form-group">
          <label for="nome" class="form-label">Nome da Categoria:</label>
          <input type="text" id="nome" name="nome" class="form-input" required>
        </div>

        <button type="submit" class="form-button">Cadastrar Categoria</button>
      </form>

      <a href="../index.php" class="action-button back" style="display: block; text-align: center; margin-top: 20px;">Voltar</a>
    </div>
  </div>
</body>
</html>