<html>
    <head>
        <title>WELCOME TO PASSWORD RECOVERY PAGE</title>
        <link rel="stylesheet" type="text/css" href="css/hint.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

        <div class="ram">
            <div class="panel panel-success">
                <div class="panel-heading"><p class="aligncenter"><p class="a"><strong>WELCOME TO PASSWORD RECOVERY PAGE<strong></p></div>
                                <div class="panel-body">

                                    <?php
                                    session_start();
                                    include_once "class.php";


                                    /* $connect= mysql_connect('localhost', 'root', "");
                                      $databaseselect = mysql_select_db('cpd2374project', $connect); */
                                    $obj = new connection();

                                    if (isset($_SESSION["username"])) {
                                        $mailvalue = $_SESSION["username"];
                                        if (isset($_POST["emailforget"])) {

                                            $_SESSION["username"] = $_POST["emailforget"];
                                            $mailvalue = $_POST["emailforget"];
                                        }
                                    } else {
                                        if (isset($_POST["emailforget"])) {

                                            $_SESSION["username"] = $_POST["emailforget"];
                                            $mailvalue = $_POST["emailforget"];
                                        } else {
                                            $mailvalue = "";
                                        }
                                    }
                                    ?>
                                    <form action="hint.php" method="post" >

                                        <div class="form-group has-success has-feedback">
                                            <label class="control-label" for="inputSuccess2">Email Address</label>
                                            <input type="email" name="emailforget" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" value="<?php echo $mailvalue; ?>" required = "required" /> 
                                        </div>
                                        <?php
                                        if (isset($_POST) and isset($_POST['passwordsubmit'])) {

                                            if (isset($_SESSION["username"]) and ! (isset($_POST["emailforget"]))) {
                                                $mailvalue = $_SESSION["username"];
                                            } else {
                                                if (isset($_POST["emailforget"])) {
                                                    $mailvalue = $_POST["emailforget"];
                                                    $_SESSION["username"] = $_POST["emailforget"];
                                                } else {
                                                    $mailvalue = "";
                                                }
                                            }


                                            $mailvalue = $_POST["emailforget"];
                                            $_SESSION["username"] = $_POST["emailforget"];


                                            /* $sql = "SELECT emailaddress from accounts where emailaddress='$mailvalue'";
                                              $result=mysql_query( $sql, $connect);
                                              $row = mysql_fetch_row($result); */

                                            $row = $obj->usernamefetchrow($mailvalue);

                                            $flag = 1;
                                            if ($row[0]) {
                                                $flag = 10;
                                            }
                                            if ($flag > 3) {

                                                header('Location: hint1.php');
                                            } else {
                                                ?>
                                                <div>
                                                    <label>
                                                        <?php
                                                        echo "*Username not found. Seems like you haven't registered!!!!";
                                                        ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <br/>
                                        <input type="submit" name="passwordsubmit" class="btn btn-primary btn-lg" value="Request Password" /><br/><br/>
                                    </form>



                                </div>
                                </div>
                                </div>
                                </html>


