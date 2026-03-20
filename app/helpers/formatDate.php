<?php 

    function formatDate($date){

        $dateTime = new DateTime($date);

        $formatterData = new IntlDateFormatter('pt_BR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
        $formatterHora = new IntlDateFormatter('pt_BR', IntlDateFormatter::NONE, IntlDateFormatter::SHORT);



        return $formatterData->format($dateTime)." às ". $formatterHora->format($dateTime);
    }

?>