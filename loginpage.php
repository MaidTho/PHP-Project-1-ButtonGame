<!-- http://localhost/demo/ -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login Page </title>
    <link rel="icon" href="Button.png" type="image/x-icon"> 
    <link rel="stylesheet" type="text/css" href="styleloginreg.css">
</head>
<body>
    <form action="login.php" method="post" class="container">

        <h1>LOGIN</h1>
        
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>
    
        <label> Username </label><br>
        <input type="text" name="username" placeholder="Username"> 

        <label> Password</label><br>
        <input type="password" name="password" placeholder="Password"> 

        <button type="button1" onclick="window.location.href='login.php';">Login</button>
        <button type="button" onclick="window.location.href='register.php';">Register</button>

    </form>
</body>
</html>