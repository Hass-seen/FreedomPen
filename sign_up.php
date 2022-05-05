
<?php

session_start();
require "connection.php";

 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
    <link rel="stylesheet" href="sign_up.css">
    <script src="jquery-3.6.0.min.js"></script>
    </head>
<body>

   <div>
  <?php
     

     if (isset($_POST['go'])) {

         $Em = $_POST['E-Mail'];
         $do= True;

        $email  = filter_var($Em, FILTER_SANITIZE_EMAIL);

        $sql = "SELECT email FROM user";
        $result = $conn->query($sql);

        $arry = $result -> fetch_array(MYSQLI_NUM);
        

        for ($i=0; $i <count($arry); $i++) {

         if($email==$arry[$i]){

            $do=false;

          };
        }




         if ($do==True) {
          

        $fname= $_POST['firstname'];
        $lname= $_POST['lastname'];
      
       $name=$fname ." ".$lname;
       
       $passwo= $_POST['Password'];


       $name   = filter_var($name, FILTER_SANITIZE_STRING);
      
       $pass   = filter_var($passwo, FILTER_SANITIZE_STRING);
       $PFP    = file_get_contents($_FILES["pfp"]["tmp_name"]);
       $status ="......";
       $field  ="......";
       $bio    ="......";


       $sql= "INSERT INTO user (email,name,password,status,field,bio,pfp) VALUES(?,?,?,?,?,?,?)";
       $stmt= $conn->prepare($sql);
       $stmt->bind_param("ssssssb",$email,$name,$pass,$status,$field,$bio,$PFP);
       $stmt->execute();
       $result= $stmt->get_result();

       $_SESSION['email']=$email;
       header('Location: http://localhost/web%20project/home.php');
       die;

       }else{
        echo "<script>alert('Email Already has an account')</script>";
       }

     };

     
    ?>
</div>
    
<header>
    <h3><b class="free">Free</b>dom Pen</h3>
     <div class="links">
      <a href="">contact us</a>
  </div>
  </header>


	
    <div class="signe-up">




	<form method="post" enctype="multipart/form-data">

    <label for="pfp" style="width: 200px;
    height: 40px;
    font-size: 20px;
    background-color: #404040;
    border:none;
    color:white;
    padding: 4px;
    border-radius: 10px;
    margin-top: 30px;
    opacity: 1;
    cursor: pointer;
"><input type="file" name="pfp" id="pfp" style="display: none;" required> uplaod profile picture</label>

<br><br>

		<label for="firstname" class="red">First Name</label> 

  <input type="text" id="firstname" name="firstname" class="clear" required>

  <label for="lastname" class="red">Last Name</label>  

  <input type="text" id="lastname" name="lastname" class="clear" required>

  <label for="E-Mail" class="red">E-Mail</label>  

  <input type="email" id="email" name="E-Mail" class="clear" required>

  <label for="Password" class="red">Password</label>

  <input type="password" id="pass" name="Password" class="clear" required>


  <input class="button" type="submit" value="Sign up" name="go">
  </form>


    </div>

    

   


   
 


</script>
</body>
</html>