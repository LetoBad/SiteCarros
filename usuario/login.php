
<?php
session_start();

// Redireciona se já estiver logado
if (isset($_SESSION['usuario_logado'])) {
    header("Location: ../index.php");
    exit();
}

// Lê a mensagem de erro, se houver
$erro = $_GET['erro'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Sistema de Veículos</title>
  <link rel="stylesheet" href="../styles.css" />
</head>
<body>
  <div class="container">
    <div class="form-container" style="max-width: 400px;">
      <h2>Login</h2>

      <?php if (!empty($erro)): ?>
        <div class="message error"><?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <form action="login_ok.php" method="post">
        <div class="form-group">
          <label for="email" class="form-label">Email:</label>
          <input type="email" id="email" name="email" class="form-input" required>
        </div>

        <div class="form-group">
          <label for="senha" class="form-label">Senha:</label>
          <input type="password" id="senha" name="senha" class="form-input" required>
        </div>

        <button type="submit" class="form-button">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>
