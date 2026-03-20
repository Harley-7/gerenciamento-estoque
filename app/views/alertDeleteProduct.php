<div class="centerContainer">

    <div class="details">
        
        <h3 class="titleAlert">Aviso Importante</h3>

        <?php echo flash("stockError"); ?>

        <div class="alertContainer">

            <p>Prezado(a) <?php echo $_SESSION['user']->firstname ?>,</p>

           <p>A ação solicitada corresponde à exclusão definitiva da mercadoria <b><?php echo $produto->produto;?></b></p>

           <p>
           Informamos que esta operação é <strong>irreversível</strong> e acarretará a remoção permanente de todos os dados, registros, configurações e histórico vinculados a esta mercadoria. Após a confirmação, não será possível recuperar qualquer informação associada.
           </p>
        
        </div>

        <div class="btnContainer">
            <a href="/stock/destroy/id/<?php echo $produto->id; ?>" class="greenBtn">Confirmar</a>
            <a href="/stock/details_product/id/<?php echo $produto->id; ?>" class="redBtn">Cancelar</a>
        </div>
        
    </div>

</div>