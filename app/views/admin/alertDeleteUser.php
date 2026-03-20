<div class="centerContainer">

    <div class="details">
        
        <h3 class="titleAlert">Aviso Importante</h3>

        <div class="alertContainer">

            <p>Prezado(a) <?php echo $_SESSION['user']->firstname ?>,</p>

           <p>A ação solicitada corresponde à exclusão definitiva da conta do usuário(a) <strong><?php echo $user->firstname." ".$user->lastname ?></strong>.</p>

           <p>
           Informamos que esta operação é <strong>irreversível</strong> e acarretará a remoção permanente de todos os dados, registros, configurações e histórico vinculados a esta conta. Após a confirmação, não será possível recuperar qualquer informação associada.
           </p>
        
        </div>

        <div class="btnContainer">
            <a href="/admin/users/destroy/id/<?php echo $user->id ?>" class="greenBtn">Confirmar</a>
            <a href="/admin/users/details/id/<?php echo $user->id ?>" class="redBtn">Cancelar</a>
        </div>
        

    </div>

</div>

<?php echo alertMessages('deleteUser'); ?>