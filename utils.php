/*
 utils.php
 Algumas funcoes uteis em PHP
 ---
 Ivan S. Vargas
*/
<?php
    function get_conexao() {
        return new PDO('firebird:dbname=localhost:C:\DATABASE.FDB;charset=utf8', 'SYSDBA', 'masterkey');    
    }
    
    function normalizar($str){
       $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿŔŕ';
       $b = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYBSaaaaaaaceeeeiiiidnoooooouuuuyybyRr';
       $str = strtr($str, utf8_decode($a), $b);
       return utf8_decode($str);
    }
    
    function normalizar_array($array) {
        //remover acentos array
        @array_walk_recursive(
                $array,
                function (&$entry) {
                    $entry = normalizar($entry);
                }
            );
		return $array;
    }
    
    function array_to_json($array) {
        /*
         * Esta funcao converte todos os elementos de um array para UTF-8
         * e depois converte para json.
         * Na pesquisa de Clifor nao retornava dados, pq o json_enconde
         * funciona apenas com UTF-8
         */
        
        @array_walk_recursive(
                $array,
                function (&$entry) {
                    $entry = iconv('Windows-1250', 'UTF-8', $entry);
                }
            );

        return json_encode($array);
    }

    /*
     * Retorna da data atual do banco de dados Firebird
     */
    function get_db_data() {
            $con = get_conexao();
            $q = $con->query('select current_date as data from rdb$database');
            $q->execute();
            $r = $q->fetch(PDO::FETCH_ASSOC);
            $con = null;
            return dateToFirebird($r['DATA']);
    }
    
    /*
     * Retorna data e hora do banco de dados Firebird
     */
    function get_db_datahora() {
            $con = get_conexao();
            $q = $con->query('select current_timestamp as datahora from rdb$database');
            $q->execute();
            $r = $q->fetch(PDO::FETCH_ASSOC);
            $con = null;
            return dateTimeToFirebird($r['DATAHORA']);
    }

    /*
     * Converte uma data do padrao yyyy-MM-dd para dd.MM.yyyy (Firebird)
     */
    function dateToFirebird($date) {
            //2016-09-02
            //0123456789
            return $date[8].$date[9].".".$date[5].$date[6].".".$date[0].$date[1].$date[2].$date[3];
    }
    
    /*
     * Converte uma data e hora do padrao yyyy-MM-dd hh:mm:ss para o padrao Firebird dd.MM.yyyy hh:mm:ss
     */
    function dateTimeToFirebird($date) {
            //2016-09-02 00:00:00
            //0123456789
            $d = $date[8].$date[9].".".$date[5].$date[6].".".$date[0].$date[1].$date[2].$date[3];
            for ($i=10 ; $i<=18; $i++) {
                $d .= $date[$i];
            }
            return $d;
    }
