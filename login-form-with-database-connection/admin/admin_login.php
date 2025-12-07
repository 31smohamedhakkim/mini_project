<?php
session_start();
include '../connect.php';

if(isset($_POST['adminLogin'])){
    $name = $conn->real_escape_string($_POST['name']);
    $password = md5($_POST['password']); 

    $sql = "SELECT * FROM admin WHERE name='$name' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['admin_name'] = $name;
        header("Location: homepage.php");
        exit();
    } else {
        $error = "Incorrect Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #2c3e50; }
        .login-box { background: white; padding: 30px; border-radius: 8px; width: 300px; text-align: center; }
        input { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 97%; padding: 10px; background-color: #2c3e50; color: white; border: none; cursor: pointer; border-radius: 4px; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Portal</h2>
        <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        
        <form method="post" autocomplete="off">
            
            <input type="text" name="name" placeholder="Admin Name" required autocomplete="off">
            
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            
            <button type="submit" name="adminLogin">Login</button>
        </form>
    </div>
</body>
</html>