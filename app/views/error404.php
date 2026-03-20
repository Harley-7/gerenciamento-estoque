<div class="templateBanner">

    <div id="container404">
    
        <h1>Error 404</h1>
    
        <h2>Ops! Página não encontrada.</h2>

        <p>
            Desculpe, mas a página que você está procurando não existe, foi removida, teve o nome alterado ou está temporariamente indisponível.
        </p>

        <a class="simpleBtn" href="/<?php echo (isset($_SESSION['user'])) ? $_SESSION['user']->access_level : '' ?>">Voltar para a Home</a>
    
    </div>

</div>
