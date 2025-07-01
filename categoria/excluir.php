
<?php
include_once "../class/categoria.class.php";
include_once "../class/categoriaDAO.class.php";
$id = $_GET["id"];
$objDAO = new categoriaDAO();
$retorno = $objDAO->delete($id);
if ($retorno)
    header("location:listar.php?deleteOk");
else
    header("location:listar.php?deleteN");
?>
