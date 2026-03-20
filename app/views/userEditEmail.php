<div class="centerContainer">

    <div class="details">

        <div class="headerEdit">
            <h2 class="titleEdit">Atualizar E-mail</h2>
        </div>

        <div class="form edit">

            <form action="/user/update_email" method="post">
                
                <label for="email">E-mail</label>
                <input type="email" name="email" value="<?php echo $user->email ?>">
                <?php echo flash('email'); ?>
    
                <div class="btnContainerColumn">
    
                    <button type="submit" id="btnEdit">Atualizar</button>
                    <a href="/user/id/<?php echo $_SESSION['user']->id ?>" class="redBtn" id="btnBack">Voltar</a>
                    
                </div>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('updatedUser'); ?>
