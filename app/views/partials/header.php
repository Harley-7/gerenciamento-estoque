<header class="headerContainer">

  <a href="/<?php echo $_SESSION['user']->access_level; ?>">
    <img id="logo" src="/assets/img/logo_gerenciamento_estoque.png" alt=""> 
  </a>
  
  <nav class="navContainer">

    <ul>
      <li><a href="/<?php echo $_SESSION['user']->access_level; ?>">Home</a></li>
      <li><a href="/stock"><i class="bi bi-box-seam"></i> Estoque</a></li>
      <li><a href="/user/id/<?php echo $_SESSION['user']->id; ?>"><i class="bi bi-person"></i> Conta</a></li>
      <li><a class="exit" href="/login/destroy"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
    </ul>

  </nav>

</header>

