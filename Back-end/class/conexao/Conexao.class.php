<?php

class Conexao
{
    public $db;
    public function __construct($db = null)
    {
        $this->db = new PDO("mysql:host=reduc-db.mysql.database.azure.com;dbname=reduc;", "reduc", "P#ssw0rdr");
        /*
        $parametros = "mysql:host=reduc-db.mysql.database.azure.com;dbname=reduc";
        $this->db = new PDO($parametros, "reduc", "P#ssw0rdr", array(
            PDO::MYSQL_ATTR_SSL_CA => '/ssl/reduc.crt.pem',
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        ));
        */
        /*
        $this->db = mysqli_init();
        mysqli_ssl_set($this->db, NULL, NULL, 'ssl/reduc.crt.pem', NULL, NULL);
        mysqli_real_connect($this->db, "reduc-db.mysql.database.azure.com", "reduc", "P#ssw0rdr", "reduc", 3306, MYSQLI_CLIENT_SSL);
        */
    }
}