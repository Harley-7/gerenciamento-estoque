<script src="/assets/js/uploadImage.js" defer></script>

<div class="centerContainer">

    <div class="details">

        <div class="headerEdit">

            <h2 class="titleEdit">Adicione uma foto de perfil</h2>      

        </div>

        <div class="form">

            <form action="/user/submit_photo" method="post" enctype="multipart/form-data">

                <label for="photo" class="fileInput">
                    <div class="dropZone">
                        <p><b>Selecione uma imagem</b> ou solte aqui</p>
                    </div>
                    <input type="file" name="photo" >
                </label>
                <?php echo flash('imagem'); ?>

                <div class="btnContainerColumn">
        
                    <button type="submit" id="btnEdit">Adicionar</button>
                    <a href="/user/id/<?php echo $_SESSION['user']->id; ?>" class="redBtn" id="btnBack">Voltar</a>
                        
                </div>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('photo'); ?> 