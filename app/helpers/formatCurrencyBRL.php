<?php 

    function formatCurrencyBRL($valor){

        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($valor, 'BRL');

    }

?>