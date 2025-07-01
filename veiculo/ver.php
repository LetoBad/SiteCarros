<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header("Location: ../usuario/login.php");
    exit();
}

include_once "../class/veiculoDAO.class.php";
include_once "../class/categoriaDAO.class.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: listar.php");
    exit();
}

$veiculoDAO = new veiculoDAO();
$veiculo = $veiculoDAO->retornarUnico($id);

if (!$veiculo) {
    header("Location: listar.php");
    exit();
}

$categoriaDAO = new categoriaDAO();
$categorias = $categoriaDAO->listar();

// Buscar o nome da categoria
$categoria_nome = '';
foreach ($categorias as $cat) {
    if ($cat['id'] == $veiculo['id_categoria']) {
        $categoria_nome = htmlspecialchars($cat['nome']);
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes do Veículo - Sistema de Veículos</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
  <div class="container">
    <div class="form-container" style="max-width: 700px;">
      <h2 style="text-align: center; margin-bottom: 10px;">
        Detalhes do Veículo: <?= htmlspecialchars($veiculo['modelo']) ?>
      </h2>

      <div style="text-align: center; margin-bottom: 20px;">
        <img src="../img/<?= htmlspecialchars($veiculo['imagem']) ?>" 
             alt="Imagem do veículo" class="vehicle-image" 
             style="max-width: 100%; border-radius: 10px;">
      </div>

      <div class="detail-grid">
        <div class="detail-item">
          <span class="detail-label">Placa:</span>
          <span class="detail-value"><?= htmlspecialchars($veiculo['placa']) ?></span>
        </div>

        <div class="detail-item">
          <span class="detail-label">Modelo:</span>
          <span class="detail-value"><?= htmlspecialchars($veiculo['modelo']) ?></span>
        </div>

        <div class="detail-item">
          <span class="detail-label">Marca:</span>
          <span class="detail-value"><?= htmlspecialchars($veiculo['marca']) ?></span>
        </div>

        <div class="detail-item">
          <span class="detail-label">Ano:</span>
          <span class="detail-value"><?= $veiculo['ano'] ?></span>
        </div>

        <div class="detail-item">
          <span class="detail-label">Cor:</span>
          <span class="detail-value"><?= htmlspecialchars($veiculo['cor']) ?></span>
        </div>

        <div class="detail-item">
          <span class="detail-label">Categoria:</span>
          <span class="detail-value"><?= $categoria_nome ?></span>
        </div>
      </div>

      <div style="text-align: center; margin-top: 20px;">
        <a href="editar.php?id=<?= $veiculo['id'] ?>" class="action-button edit">Editar</a>
        <a href="excluir.php?id=<?= $veiculo['id'] ?>" class="action-button delete">Excluir</a>
        <a href="../index.php" class="action-button back">Voltar</a>
      </div>
    </div>
  </div>
</body>
</html>