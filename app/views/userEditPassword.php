<div class="centerContainer">

    <div class="details">

        <div class="headerEdit">

            <h2 class="titleEdit">Atualizar Senha</h2>

        </div>


        <div class="form edit">

            <form action="/user/update_password" method="post">

                <label for="password">Nova Senha</label>
                <input type="password" name="password">
                <?php echo flash('password'); ?>

                <label for="password_confirm">Confirme a Nova Senha</label>
                <input type="password" name="password_confirm">
                <?php echo flash('password_confirm'); ?>

                <div class="btnContainerColumn">

                    <button type="submit" id="btnEdit">Atualizar</button>
                    <a href="/user/id/<?php echo $_SESSION['user']->id ?>" class="redBtn" id="btnBack">Voltar</a>
                
                </div>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('updatedUser'); ?>