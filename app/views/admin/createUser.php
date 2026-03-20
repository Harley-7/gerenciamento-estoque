<div class="centerContainer">

    <a class="backBtn" href="/<?php echo $_SESSION['user']->access_level ?>"><i class="bi bi-arrow-90deg-left"></i></a>

    <div class="details">

        <div class="headerEdit">
            <h2 class="titleEdit">Adicione um novo usuário ao seu estoque</h2>
        </div>

        <div class="form">

            <form action="/admin/users/store" method="post">

                <label for="firstname">Nome</label>
                <input type="text" name="firstname" value="<?php echo old('firstname');?>">
                <?php echo flash('firstname'); ?>
            
                <label for="lastname">Sobrenome</label>
                <input type="text" name="lastname" value="<?php echo old('lastname'); ?>">
                <?php echo flash('lastname'); ?>
            
                <label for="email">E-mail</label>
                <input type="email" name="email" value="<?php echo old("email"); ?>">
                <?php echo flash('email'); ?>

                <label for="password">Senha</label>
                <input type="password" name="password">
                <?php echo flash('password'); ?>

                <label for="access_level">Nível de Acesso</label>
                <select name="access_level">
                    <option value="admin">Admin</option>
                    <option value="operador">Operador</option>
                    <option value="visualizador">Visualizador</option>
                </select>

                <button type="submit">Criar usuário</button>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('createdUser'); ?>