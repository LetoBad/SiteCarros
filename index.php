<?php
session_start();

include_once "class/veiculoDAO.class.php";
include_once "class/categoriaDAO.class.php";

$veiculoDAO = new veiculoDAO();
$categoriaDAO = new categoriaDAO();

$id_categoria = $_GET['id_categoria'] ?? null;
$modelo = $_GET['modelo'] ?? null;
$ano = $_GET['ano'] ?? null;

$veiculos = $veiculoDAO->listarComFiltros($id_categoria, $modelo, $ano);
$categorias = $categoriaDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Início - Sistema de Veículos</title>
  <link rel="stylesheet" href="styles.css" />
  <!-- CDN Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Ajuste simples para os ícones */
    .action-button i {
      font-size: 1.1rem;
      vertical-align: middle;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="form-container" style="max-width: 800px;">
      <h2 class="detail-title" style="text-align: center;">Sistema de Veículos</h2>

      <form method="get" action="index.php">
        <div class="form-group">
          <label for="modelo" class="form-label">Modelo:</label>
          <input type="text" id="modelo" name="modelo" class="form-input" placeholder="Ex: Gol, Uno..." value="<?= htmlspecialchars($modelo ?? '') ?>" />
        </div>

        <div class="form-group">
          <label for="ano" class="form-label">Ano:</label>
          <input type="number" id="ano" name="ano" class="form-input" placeholder="Ex: 2020" value="<?= htmlspecialchars($ano ?? '') ?>" />
        </div>

        <button type="submit" class="form-button">Buscar</button>
      </form>

      <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;" />

      <div style="text-align: center;">
        <h3 class="categories-title">Categorias</h3>
        <div class="categories-list" style="justify-content: center;">
          <a href="index.php" class="category-item">Todos</a>
          <?php foreach ($categorias as $cat): ?>
            <a href="index.php?id_categoria=<?= $cat['id']; ?>" class="category-item">
              <?= htmlspecialchars($cat['nome']); ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <?php if (isset($_SESSION['usuario_logado'])): ?>
        <div style="text-align: center; margin-top: 30px;">
          <button onclick="toggleGerenciarCategorias()" class="action-button edit">Gerenciar Categorias</button>
        </div>

        <div id="gerenciar-categorias" style="display: none; margin-top: 20px;">
          <h3>Gerenciar Categorias</h3>
          <table class="vehicles-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categorias as $cat): ?>
                <tr>
                  <td><?= $cat['id'] ?></td>
                  <td><?= htmlspecialchars($cat['nome']) ?></td>
                  <td class="actions-cell">
                    <a href="categoria/editar.php?id=<?= $cat['id'] ?>" class="action-button edit" title="Editar">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="categoria/excluir.php?id=<?= $cat['id'] ?>" class="action-button delete" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>

      <?php if (count($veiculos) > 0): ?>
        <h3 style="margin-top: 40px;">Veículos encontrados</h3>
        <table class="vehicles-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Placa</th>
              <th>Modelo</th>
              <th>Ano</th>
              <th>Categoria</th>
              <th>Imagem</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($veiculos as $veiculo): ?>
              <tr>
                <td><?= $veiculo['id'] ?></td>
                <td><?= htmlspecialchars($veiculo['placa']) ?></td>
                <td><?= htmlspecialchars($veiculo['modelo']) ?></td>
                <td><?= $veiculo['ano'] ?></td>
                <td>
                  <?php
                    foreach ($categorias as $cat) {
                      if ($cat['id'] == $veiculo['id_categoria']) {
                        echo htmlspecialchars($cat['nome']);
                        break;
                      }
                    }
                  ?>
                </td>
                <td>
                  <img src="img/<?= htmlspecialchars($veiculo['imagem']) ?>" alt="Imagem" class="vehicle-image" />
                </td>
                <td class="actions-cell">
                  <a href="veiculo/ver.php?id=<?= $veiculo['id'] ?>" class="action-button view" title="Ver">
                    <i class="fas fa-eye"></i>
                  </a>
                  <?php if (isset($_SESSION['usuario_logado'])): ?>
                    <a href="veiculo/editar.php?id=<?= $veiculo['id'] ?>" class="action-button edit" title="Editar">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="veiculo/excluir.php?id=<?= $veiculo['id'] ?>" class="action-button delete" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este veículo?');">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="message">Nenhum veículo encontrado.</div>
      <?php endif; ?>

      <div style="text-align: center; margin-top: 40px;">
        <?php if (isset($_SESSION['usuario_logado'])): ?>
          <a href="veiculo/inserir.php" class="action-button view" title="Cadastrar Veículo">
            <i class="fas fa-plus"></i> Cadastrar Veículo
          </a>
          <a href="categoria/inserir.php" class="action-button edit" title="Cadastrar Categoria">
            <i class="fas fa-plus"></i> Cadastrar Categoria
          </a>
          <a href="usuario/logout.php" class="logout-button" style="margin-top: 10px;">Sair</a>
        <?php else: ?>
          <a href="usuario/login.php" class="form-button" style="width: auto; display: inline-block;">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    function toggleGerenciarCategorias() {
      const div = document.getElementById('gerenciar-categorias');
      div.style.display = div.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>
</html>