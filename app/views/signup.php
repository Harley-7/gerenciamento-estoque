<div class="templateForm">

    <div class="welcome">

        <h1>Bem-Vindo</h1>

        Nosso sistema de gerenciamento de estoque ajuda você a controlar entradas e saídas de produtos, acompanhar níveis em tempo real e evitar rupturas. Tenha mais eficiência e segurança na gestão do seu negócio.

    </div>

    <div class="form">

        <h1>Crie o seu estoque</h1>
        
        <form action="signup/store" method="post">

            <label for="stock_name">Nome do estoque</label>
            <input type="text" name="stock_name" value="<?php echo old('stock_name'); ?>">
            <?php echo flash('stock_name');?>

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

            <button type="submit">Criar estoque</button>

            <p class="more">
                Already have account ? <a href="/login">sign in here</a><br>
                By clicking on 'Sign Up' you agree to<br>
                <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a>
            </p>
        
        </form>

    </div>

</div>

<?php echo alertMessages('createdStock'); ?>