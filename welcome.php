
<html>
    <head>
        <title>LOGIN PAGE</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/welcome.css">
    </head>

    <body>
        <?php
        session_start();

        if (empty($_SESSION["username"])) {
            header('Location: login.php');
        } else {
            
        }
        ?>

        <h1>Welcome <?php echo $_SESSION["fname"] . " " . $_SESSION["lname"]; ?>  </h1>
        <?php
        if (isset($_POST['Submitlast'])) {
            session_destroy();
            header('Location: session.php');
        }
        ?>


        <div class="out">	
            <form action="welcome.php" method="post" >
                <div class="form-group has-success has-feedback">
                    <input type="submit" name="Submitlast" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" value="Log Out" />
                </div>
        </div>
    </body>
    <form>
</html>



