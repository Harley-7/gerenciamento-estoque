<div class="centerContainer">
    
    <a class="backBtn" href="/<?php echo $_SESSION['user']->access_level ?>"><i class="bi bi-arrow-90deg-left"></i></a>

    <div class="title">usuários</div>

    <?php if(count($users) > 1){  ?>

        <?php
            foreach($users as $user)
            {
                if($user->id !== $_SESSION['user']->id){
        ?>  
                <div class="userContainer">
                    <?php if($user->imagem_path){ ?>
                        <img src="/<?php echo $user->imagem_path; ?>" alt="<?php echo $user->firstname." ".$user->lastname ?>">
                    <?php }else{ ?>
                        <i class="bi bi-person"></i>
                    <?php } ?> 
                   
                    <?php  
                        echo $user->firstname." ".$user->lastname."<br>";
                        echo status($user->status_online);
                        echo ucfirst($user->access_level);
                    ?>

                    <a href="/admin/users/details/id/<?php echo $user->id ?>" class="btnDetails"><i class="bi bi-person-vcard"></i></a>
                </div>

    <?php 
            }
        }
    }else{   
    ?>   
        <div class="noFound">
            Nenhum usuário encontrado
        </div>
    <?php }?>


</div>

<?php echo alertMessages('deleteUser'); ?>