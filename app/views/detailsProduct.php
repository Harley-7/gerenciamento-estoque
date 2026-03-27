<div class="centerContainer">

    <a class="backBtn" href="/stock"><i class="bi bi-arrow-90deg-left"></i></a>

    <div class="details">
        
        <img class="imgProduct" src="/<?php echo $produto->imagem; ?>" alt="">
        
        <h1 class="titleDetails"><?php echo $produto->produto; ?></h1>

        <ul class="infosProduct">

            <?php if ($_SESSION['user']->access_level !== 'visualizador'){ ?>

                <li><span class="infoProduct">Id: </span><?php echo $produto->id; ?></li>
                <li><span class="infoProduct">Categoria: </span><?php echo $produto->categoria; ?></li>
                <li><span class="infoProduct">Preço de Compra: </span><?php echo formatCurrencyBRL($produto->preco_compra); ?></li>
                <li><span class="infoProduct">Preço de Venda: </span><?php echo formatCurrencyBRL($produto->preco_venda); ?></li>
                <li><span class="infoProduct">Quantidade em estoque: </span><?php echo $produto->estoque; ?></li>
                <li><span class="infoProduct">Estoque mínimo: </span><?php echo $produto->estoque_minimo;?></li>
                <li><span class="infoProduct">Produto adicionado em: </span><?php echo formatDate($produto->adicionado_em);?></li>
                <li><span class="infoProduct">Data de validade: </span><?php echo date("d/m/Y", strtotime($produto->data_validade));?></li>
                <li><span class="infoProduct">Lote: </span><?php echo $produto->lote;?></li>
                <li><span class="infoProduct">Unidade de medida: </span><?php echo $produto->unidade_medida;?></li>
                <li><span class="infoProduct">Marca: </span><?php echo $produto->marca;?></li>
                
            <?php }; ?>

            <?php if($_SESSION['user']->access_level == 'visualizador'){ ?>
           
                 <li><span class="infoProduct">Preço: </span><?php echo formatCurrencyBRL($produto->preco_venda); ?></li>
                 <li><span class="infoProduct">Quantidade em estoque: </span><?php echo $produto->estoque; ?></li>
            
            <?php };?>

        </ul>

    </div>

    <?php if ($_SESSION['user']->access_level !== 'visualizador'){ ?>

        <a href="/product/replacement/<?php echo $produto->id;?>" class="function"><i class="bi bi-box2"></i> Reposição de estoque</a>
    
        <a href="/stock/edit/id/<?php echo $produto->id;?>" class="function"><i class="bi bi-sliders"></i>Editar dados da mercadoria</a>

        <a href="/stock/alert_destroy/id/<?php echo $produto->id;?>" class="function red">
            <i class="bi bi-trash3"></i>
            Deletar a mercadoria
        </a>

    <?php };?>

</div>