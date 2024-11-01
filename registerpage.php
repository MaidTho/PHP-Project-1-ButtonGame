<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration Page </title>
    <link rel="icon" href="Button.png" type="image/x-icon"> 
    <link rel="stylesheet" type="text/css" href="styleloginreg.css">
</head>
<body>
    <form action="register.php" method="post" class="container">
        
    <h1>REGISTER</h1>
    
        <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
        <?php } ?>

    <label> Username </label> <br>
    <input type="text" name="username" placeholder="Enter username"> <br>

    <label> Password</label> <br>
    <input type="password" name="password" placeholder="Enter password"> <br>
    
    <br>
    <button type="submit">Complete Register</button>
    <button type="button" onclick="window.location.href='index.php';">Return Home</button>
    </form>
</body>
</html>