<?php



$hostname = "ftp.famtec.com.ar";

$username = "Synapsis.cli16101";

$password = "Synapsis2017";

$database = "famtec_cms";



$mysqli = new mysqli($hostname, $username, $password, $database);

if($mysqli->connect_errno){

    echo "Fallo al contectar a MySQL: (" .$mysqli->connect_errno. ") ".$mysqli->connect_error;

}



$mysqli->set_charset('utf8');

