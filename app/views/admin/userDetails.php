<div class="centerContainer">

    <div class="details">

        <div class="userProfile">
            <i class="bi bi-person"></i>
        </div>

        <h1 class="titleDetails"><?php echo $user->firstname." ".$user->lastname ?></h1>

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

        <div class="btnContainer">
            <a href="/admin/users" class="simpleBtn">Voltar</a>
        </div>
        
    </div>
    
    <?php if($user->access_level !== 'admin'){?>
       
        <a href="/admin/users/edit/id/<?php echo $user->id ?>" class="function">
            <i class="bi bi-pencil-square"></i>
            Alterar nível de acesso
        </a>

        <a href="/admin/users/alert/id/<?php echo $user->id ?>" class="function red">
            <i class="bi bi-person-dash"></i>
            Deletar Usuário
        </a>

    <?php }?> 

</div>