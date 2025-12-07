<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "<!DOCTYPE html>
    <html>
    <head>
        <style>
            /* 1. LAYOUT SETTINGS */
            body {
                margin: 0;
                height: 100vh;
                display: flex;
                
                /* This is the key line that fixes your issue: */
                flex-direction: column;  /* Stacks items top-to-bottom */
                
                justify-content: center;
                align-items: center;
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }

            /* 2. RED BOX STYLES */
            .error-box {
                text-align: center;
                border: 3px solid red;
                padding: 50px;
                min-width: 400px;
                font-size: 24px;
                color: red;
                font-weight: bold;
                border-radius: 15px;
                background-color: #fff0f0;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }

            /* 3. LOGOUT LINK STYLES */
            .logout-link {
                margin-top: 20px;  /* Adds space between box and link */
                text-decoration: none;
                color: #333;
                font-size: 18px;
                padding: 10px 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: white;
            }
            
            .logout-link:hover {
                background-color: #eee;
            }
        </style>
    </head>
    <body>
        
        <div class='error-box'>
            <img src='sad.png' alt='sad emoji' width='100' height='100'> <br>
            Email already exists change to another
        </div>
        
        <a href='logouttoindex.php' class='logout-link'>Go Back</a>

    </body>
    </html>";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                       VALUES ('$firstName','$lastName','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    header("Location: homepage.php");
    exit();
   }
   else {
    echo "
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            /* 1. LAYOUT SETTINGS */
            body {
                margin: 0;
                height: 100vh;
                display: flex;
                
                /* This is the key line that fixes your issue: */
                flex-direction: column;  /* Stacks items top-to-bottom */
                
                justify-content: center;
                align-items: center;
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
            }

            /* 2. RED BOX STYLES */
            .error-box {
                text-align: center;
                border: 3px solid red;
                padding: 50px;
                min-width: 400px;
                font-size: 24px;
                color: red;
                font-weight: bold;
                border-radius: 15px;
                background-color: #fff0f0;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }

            /* 3. LOGOUT LINK STYLES */
            .logout-link {
                margin-top: 20px;  /* Adds space between box and link */
                text-decoration: none;
                color: #333;
                font-size: 18px;
                padding: 10px 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: white;
            }
            
            .logout-link:hover {
                background-color: #eee;
            }
        </style>
    </head>
    <body>
        
        <div class='error-box'>
            <img src='sad.png' alt='sad emoji' width='100' height='100'> <br>
            User Not Found, Incorrect Email or Password
        </div>
        
        <a href='logout.php' class='logout-link'>Go Back</a>

    </body>
    </html>
    ";
}
}
?>