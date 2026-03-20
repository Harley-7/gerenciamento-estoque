<div class="centerContainer">

    <a class="backBtn" href="/<?php echo $_SESSION['user']->access_level ?>"><i class="bi bi-arrow-90deg-left"></i></a>

    <div class="title">Estoque</div>

    <?php if(!empty($produtos)){ ?>

        <div class="infoProducts">
            <p>Imagem</p>
            <p>Produto</p>
            <p>Preço por unidade</p>
            <p>Quantidade</p>
            <p>Categoria</p>
            <p>Detalhes</p>
        </div>

        <?php 

            foreach ($produtos as $produto) {
                
        ?>

            <div class="productContainer">
                
                <img src="<?php echo $produto->imagem ?>">

                <?php 
                    echo "<span>".$produto->produto."</span>";
                    echo "<span>".formatCurrencyBRL($produto->preco_venda)."</span>";
                    echo "<span>".$produto->estoque."</span>";
                    echo "<span>".$produto->categoria."</span>";
                ?>

                <a href="/stock/details_product/id/<?php echo $produto->id ?>" class="btnDetails"><i class="bi bi-card-list"></i></a>
            </div>

        <?php 
            }
        }else{    
        ?>  
            <div class="noFound">
                Nenhuma mercadoria encontrada
            </div>
        <?php }?>
        
</div>

<?php echo alertMessages('deleteProduct'); ?>