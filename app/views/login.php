<div class = "templateForm">

    <div class="welcome">

        <h1>Bem-Vindo de Volta</h1>

        Nosso sistema de gerenciamento de estoque ajuda você a controlar entradas e saídas de produtos, acompanhar níveis em tempo real e evitar rupturas. Tenha mais eficiência e segurança na gestão do seu negócio.

    </div>

    <div class="form">

        <h1>Sign in</h1>

        <form action="login/store" method="post">

            <label for="email">E-mail</label>
            <input type="text" name="email" value="<?php echo old('email'); ?>">
            <?php echo flash('email'); ?>

            <label for="password">Password</label>
            <input type="password" name="password">
            <?php echo flash('password'); ?>

            <button type="submit">Sign in now</button>

            <p class="more">
                Don't have an account ? <a href="signup">Register here</a><br>
                By clicking on 'Sign in now' you agree to<br>
                <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a>
            </p>

        </form>

    </div>

</div>

<?php echo alertMessages("createdStock");?>
<?php echo alertMessages('login'); ?>