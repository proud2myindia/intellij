<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 3/26/2017
 * Time: 4:52 PM
 */

class connect_pdo
{
    protected $dbh;
    public $con;

    private static $instance = null;



    public function __construct()
    {

        $db = parse_ini_file("app.ini");
        try {

            $db_host = $db['host'];  //  hostname
            $db_name = $db['name']; //  databasename
            $db_user = $db['user'];  //  username
            $user_pw = $db['pass'];  //  password

            $this->con = new PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $user_pw);
            $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->con->exec("SET CHARACTER SET utf8");  //  return all sql requests as UTF-8
           // echo "Connected Sucessfully";
        }
        catch (PDOException $err) {
            echo "harmless error message if the connection fails";
            $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt',$err, FILE_APPEND);  // write some details to an error-log outside public_html
            die();  //  terminate connection
        }

       // return $con;
    }

    public function getDb() {
        if ($this->con instanceof PDO) {
            return $this->con;
        }
    }

}
#   put database handler into a var for easier access
//$con = new connect_pdo();
//$con = $con->dbh();