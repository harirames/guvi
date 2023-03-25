<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

require '../vendor/autoload.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
    $update=$_POST['isup'];

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
if(!$update){
    $email=$_POST['email'];
    $mongoclient = new MongoDB\Client();
 $collection =  $mongoclient->guvi->user_details;

$result = $collection->find(['email'=>$email]);

  foreach ($result as $userdetails) {
    echo json_encode(array('name'=>$userdetails["name"],'age'=>$userdetails["age"],'mobile'=>$userdetails["mobile"],'email'=>$userdetails["email"]));
 /*  echo $userdetails["name"];
   echo $userdetails["age"];
   echo $userdetails["mobile"];
   echo $userdetails["email"];  */
   //var_dump($userdetails);
}; 
}else{
    $oldem=$_POST['oldem'];
    $dob=$_POST['dob'];
    $name=$_POST['name'];
    $mob=$_POST['mobile'];
    $age=$_POST['age'];
    $mongoclient = new MongoDB\Client();
 $collection =  $mongoclient->guvi->user_details;

$upresult = $collection->updateone( [ 'email' => $oldem ],
   [ '$set' => [ 'name' => $name , 'age' => $age,'mobile' => $mob,'dob' => $dob ]]);
$result = $collection->find(['email'=>$oldem]);
  foreach ($result as $userdetails) {
    echo json_encode(array('name'=>$userdetails["name"],'age'=>$userdetails["age"],'mobile'=>$userdetails["mobile"],'email'=>$userdetails["email"]));
 /*  echo $userdetails["name"];
   echo $userdetails["age"];
   echo $userdetails["mobile"];
   echo $userdetails["email"];  */
   //var_dump($userdetails);
}; 
}

}