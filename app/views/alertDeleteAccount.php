<div class="centerContainer">

    <?php echo flash("deletedAccount"); ?>

    <div class="details">
        
        <h3 class="titleAlert">Aviso Importante</h3>

        <div class="alertContainer">

            <p>Prezado(a) <?php echo $_SESSION['user']->firstname ?>,</p>

           <p>A ação solicitada corresponde à exclusão definitiva da sua conta.</p>

           <p>
           Informamos que esta operação é <strong>irreversível</strong> e acarretará a remoção permanente de todos os dados, registros, configurações e histórico vinculados a esta conta. Após a confirmação, não será possível recuperar qualquer informação associada.
           </p>
        
        </div>

        <div class="btnContainer">
            <a href="/user/destroy" class="greenBtn">Confirmar</a>
            <a href="/user/id/<?php echo $_SESSION['user']->id; ?>" class="redBtn">Cancelar</a>
        </div>
        
    </div>

</div>