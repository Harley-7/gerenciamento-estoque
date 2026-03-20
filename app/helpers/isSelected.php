<?php 

    function isSelected($field, $fieldTarget){

        if($field === $fieldTarget){ 
            return "selected";
        }else{ 
            return "";
        }

    }

?>