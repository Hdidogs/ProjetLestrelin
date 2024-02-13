<?php
include "user/User.php";
class SQLConnexion {
    public function conbdd(): PDO {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $bddname = "gestionStock";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=".$bddname, $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {

        }

        return $conn;
    }
}