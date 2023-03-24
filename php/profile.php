<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

require '../vendor/autoload.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $email=$_POST['email'];
/*     $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="guvi";
    if(!$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    {
        die("failed to connect!");
    }
    if(!empty($email))
   {
    $sql = "SELECT * FROM users WHERE email=?"; 
    $stmt = $con->prepare($sql); 
    $stmt->bind_param("s", $email);
    if($stmt->execute())
    {
    $res= $stmt->get_result();
    if($res && mysqli_num_rows($res)>0)
        {
            $user_data = $res->fetch_assoc();
                echo json_encode($user_data);
            die;
        }
   }
} */
$mongoclient = new MongoDB\Client();
 $collection =  $mongoclient->guvi->user_details;

$result = $collection->find(['email'=>$email]);

   //echo json_encode($result);

 foreach ($result as $userdetails) {
   echo $userdetails;
   //var_dump($userdetails);
}; 


}