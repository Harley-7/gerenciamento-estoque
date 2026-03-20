<div class="centerContainer">

    <div class="details">

        <div class="headerEdit">

            <h2 class="titleEdit">Atualizar Dados</h2>

        </div>

        <div class="form edit">

            <form action="/user/update" method="post">
    
                <label for="firstname">Nome</label>
                <input type="text" name="firstname" value="<?php echo $user->firstname ?>">
                <?php echo flash('firstname'); ?>

                <label for="lastname">Sobrenome</label>
                <input type="text" name="lastname" value="<?php echo $user->lastname ?>">
                <?php echo flash('lastname'); ?>

                <div class="btnContainerColumn">
                    <button type="submit" id="btnEdit">Atualizar</button>
                    <a href="/user/id/<?php echo $_SESSION['user']->id ?>" class="redBtn" id="btnBack">Voltar</a>
                </div>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('updatedUser'); ?>