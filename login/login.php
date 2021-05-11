<?php
error_reporting(E_ALL & ~ E_NOTICE);
session_start();
 $pagetitle="LogIn Page";
?>
<?php
       if ($_POST['submit']){
        include 'connection.php';
        $username=($_POST['username']);
        $password=($_POST['password']);

        $sql="SELECT id, username, password,utype FROM users WHERE username='$username' AND password='$password'";
        $query=mysqli_query($dbcon, $sql);
        if($query){
          $row= mysqli_fetch_row($query);
          $userId= $row[0];
          $dbusername=$row[1];
          $dbpassword=$row[2];
		  $utype=$row[3];
        }
            //verify the entered password by hashed one from db
          if($username== $dbusername && password_verify($password,$dbpassword) /*$password== $dbpassword*/ && $utype=='Admin'){
          $_SESSION['username']=$username;
          $_SESSION['id']=$userId;
          header('Location:adminDashbored.php');
        }
		else if($username== $dbusername && $password== $dbpassword && $utype=='user'){
          $_SESSION['username']=$username;
          $_SESSION['id']=$userId;
          header('Location:userDashbored.php');
		}
		
		
		else{
            echo "<span style='color:red;'>User name or password is incorrect!</span>";
          }    
	   }
?>

     
