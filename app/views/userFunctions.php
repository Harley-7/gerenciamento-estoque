<div class="centerContainer">

    <div class="details">

        <div class="userProfile">
            <?php if($photo){ ?>
                <img src="/<?php echo $photo; ?>" alt="<?php echo $user->firstname." ".$user->lastname ?>">
            <?php }else{ ?>
                <i class="bi bi-person"></i>
            <?php } ?>    
        </div>

        <h1 class="titleUser"><?php echo $user->firstname." ".$user->lastname ?></h1>

        <?php echo status($user->status_online); ?>

        <div class="infos">

            <ul class="infosUser">

                <?php 
                    foreach($user as $info => $value){
                    
                        if(str_contains($info, '_')){
                            $infoFormat = ucfirst(str_replace('_', " ", $info));
                        }else{
                            $infoFormat = ucfirst($info);
                        }

                        if($info === 'ultima_atividade'){
                            $value = formatDate($value);
                        }

                        if($info !== 'status_online'){
                            echo "<li><span class='infoUser'>{$infoFormat}</span>: {$value}</li>";
                        }

                    }
                ?>

            </ul>

        </div>

    </div>

    <a href="/user/add_photo" class="function">
        <i class="bi bi-person"></i>
        Adicionar foto de perfil
    </a>

    <a href="/user/edit" class="function">
        <i class="bi bi-pencil-square"></i>
        Editar Dados
    </a>
    
    <a href="/user/edit_email" class="function">
        <i class="bi bi-pencil-square"></i>
        Editar E-mail
    </a>

    <a href="/user/edit_password" class="function">
        <i class="bi bi-pencil-square"></i>
        Editar Senha
    </a>

    <a href="/user/alert_destroy" class="function red">
        <i class="bi bi-person-x"></i>
        Deletar conta
    </a>

</div>