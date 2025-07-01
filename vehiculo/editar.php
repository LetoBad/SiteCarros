<?php
$id = $_GET["id"];
include_once "../class/veiculo.class.php";
include_once "../class/veiculoDAO.class.php";
include_once "../class/categoriaDAO.class.php";

$objDAO = new veiculoDAO();
$retorno = $objDAO->retornarUnico($id);

$categoriaDAO = new categoriaDAO();
$categorias = $categoriaDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Editar Veículo - Sistema de Veículos</title>
  <link rel="stylesheet" href="../styles.css" />
</head>
<body>
  <div class="container">
    <div class="form-container" style="max-width: 600px;">
      <h2 class="detail-title" style="text-align: center;">Editar Veículo</h2>

      <form action="editar_ok.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($retorno['id']) ?>" />
        <input type="hidden" name="imagem_atual" value="<?= htmlspecialchars($retorno['imagem']) ?>" />

        <div class="form-group">
          <label for="placa" class="form-label">Placa:</label>
          <input type="text" name="placa" id="placa" class="form-input" value="<?= htmlspecialchars($retorno['placa']) ?>" required />
        </div>

        <div class="form-group">
          <label for="cor" class="form-label">Cor:</label>
          <input type="text" name="cor" id="cor" class="form-input" value="<?= htmlspecialchars($retorno['cor']) ?>" required />
        </div>

        <div class="form-group">
          <label for="modelo" class="form-label">Modelo:</label>
          <input type="text" name="modelo" id="modelo" class="form-input" value="<?= htmlspecialchars($retorno['modelo']) ?>" required />
        </div>

        <div class="form-group">
          <label for="marca" class="form-label">Marca:</label>
          <input type="text" name="marca" id="marca" class="form-input" value="<?= htmlspecialchars($retorno['marca']) ?>" required />
        </div>

        <div class="form-group">
          <label for="ano" class="form-label">Ano:</label>
          <input type="number" name="ano" id="ano" class="form-input" value="<?= htmlspecialchars($retorno['ano']) ?>" required />
        </div>

        <div class="form-group">
          <label for="id_categoria" class="form-label">Categoria:</label>
          <select name="id_categoria" id="id_categoria" class="form-input" required>
            <?php foreach ($categorias as $cat): ?>
              <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $retorno['id_categoria']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['nome']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Imagem atual:</label><br />
          <?php if (!empty($retorno['imagem'])): ?>
            <img src="../img/<?= htmlspecialchars($retorno['imagem']) ?>" alt="Imagem do veículo" style="max-width: 100%; max-height: 200px; margin-bottom: 10px;">
          <?php else: ?>
            <span>Nenhuma imagem cadastrada.</span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="imagem" class="form-label">Alterar imagem:</label>
          <input type="file" name="imagem" id="imagem" class="form-input" accept="image/*" />
          <small>Deixe vazio para manter a imagem atual.</small>
        </div>

        <button type="submit" class="form-button" style="width: 100%;">Salvar Alterações</button>
      </form>
    </div>
  </div>
</body>
</html>