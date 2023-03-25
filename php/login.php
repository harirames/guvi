<?php
use Predis;
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

require '../vendor/autoload.php';

require "../vendor/predis/predis/autoload.php";

Predis\Autoloader::register();
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="guvi"; 
    
/* $redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "127.0.0.1",
    "port" => 6379,
    "password" => ""));
$redis->set("foovc", "bar");
$value = $redis->get("foo");
 */

    if(!$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    {
        die("failed to connect!");
    }
    if(!empty($email)&&!empty($password))
   {
    $sql = "SELECT * FROM users WHERE email=?"; // SQL with parameters
    $stmt = $con->prepare($sql); 
    $stmt->bind_param("s", $email);
    if($stmt->execute())
    {
    $res= $stmt->get_result();
    session_start();
    $count=isset($_SESSION['count'])?$_SESSION['count']:1;
    echo $count;
    $_SESSION['count']=++$count;
    if($res && mysqli_num_rows($res)>0)
        {
            $user_data = $res->fetch_assoc();
            if($user_data['password']==$password)
            {
                echo "Logged in";
            }
            else
            {
                echo "Wrong Password";
            }
            die;
        }
   }
    echo"WRONG USER NAME OR PASSWORD";
}
   else
   {
    echo"WRONG USER NAME OR PASSWORD";
   }
}