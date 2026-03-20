<div class="centerContainer">

    <div class="details">

        <div class="headerEdit">
            <h2 class="titleEdit">Alterar Nível de Acesso de <?= $firstname ?></h2>
        </div>

        <div class="form edit">

            <form action="/admin/users/update/id/<?php echo $id . "/" . $access_level ?>" method="post">

                <?php if($access_level !== 'admin'){ ?>
                    <label for="access_level">Nível de Acesso</label>

                    <select name="access_level">
                        <option value="admin">Admin</option>
                        <option value="operador">Operador</option>
                        <option value="visualizador">Visualizador</option>
                    </select>
                <?php } ?>


                <div class="btnContainerColumn">
    
                    <?php if($access_level !== 'admin'){ ?>
                        <button type="submit" id="btnEdit">Atualizar</button>
                    <?php } ?>

                    <a href="/admin/users/details/id/<?php echo $id ?>" class="redBtn" id="btnBack">Voltar</a>
                    
                </div>

            </form>

        </div>

    </div>

</div>

<?php echo alertMessages('updatedAcessLevel'); ?>