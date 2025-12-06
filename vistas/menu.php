<?php require_once "dependencias.php";
  function esAdministrador() {
  return isset($_SESSION['rol']) && $_SESSION['rol'] != 'Administrador';
}

 ?>

<html>
<head>
<title></title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img src="../logo-menu.png" style=width="25"; height="25"></img>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
        </li>
        <?php if (!esAdministrador()): ?>
        <li class="nav-item">
          <a class="nav-link" href="usuarios.php">Usuarios</a>
        </li>
        <?php endif; ?>


        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Administrar Inventario <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="inventario.php">Inventario</a></li>
              <li><a class="dropdown-item" href="proveedores.php">Lista de Proovedores</a></li>
            </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="tareas.php">Tareas</a>
        </li>
        <li>
          <a class="nav-link" href="estado.php">Estado Articulos</a>
        </li>
<!--         <li class="nav-item">
          <a class="nav-link" href="quejas.php">Quejas</a>
        </li> -->

        <li>
          <a class="nav-link" href="generadorQR.php">Generador QR</a>
        </li>

        <li>
          <a class="nav-link" href="valesGen.php">Generador de Vales</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-danger" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Usuario: <?php echo $_SESSION['usuario']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item text-danger" href="../procesos/salir.php">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Buenas tardes Sistemas, le atiende Alexander -->
</body>
</html>
