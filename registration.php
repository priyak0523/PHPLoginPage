<!DOCTYPE html>
<html>
    <head>
        <title>REGISTRATION</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/registration.css">
    </head>
    <body>
        <div class="ram">
            <div class="panel panel-success">
                <div class="panel-heading"><p class="aligncenter"><p class="a"><strong>REGISTRATION<strong></p></div>
                                <div class="panel-body">
                                    <?php
                                    session_start();
                                    session_destroy();
                                    session_start();

                                    include_once "class.php";
                                    /* Database connection */
                                    /* $connect= mysql_connect('localhost', 'root', "");
                                      $databaseselect = mysql_select_db('cpd2374project', $connect); */
                                    $obj = new connection();

                                    /* if (!$databaseselect) 
                                      {
                                      die ('can\'t use cpd2374project  : ' . mysql_error().'<br>');

                                      } */
                                    if (isset($_POST) and isset($_POST['Submit'])) {
                                        session_destroy();
                                        session_start();
                                    }
                                    $_SESSION["mail"] = "";
                                    $_SESSION["fname"] = "";
                                    $_SESSION["lname"] = "";
                                    $_SESSION["pswd1"] = "";
                                    $_SESSION["pswd2"] = "";
                                    $_SESSION["quest"] = "";
                                    $_SESSION["hans"] = "";

                                    if (isset($_POST['Submit'])) {
                                        $_SESSION["mail"] = trim($_POST["mail"]);
                                        $_SESSION["mail2"] = trim($_POST["mail2"]);
                                        $_SESSION["fname"] = trim($_POST["fname"]);
                                        $_SESSION["lname"] = trim($_POST["lname"]);
                                        $_SESSION["pswd1"] = trim($_POST["pswd1"]);
                                        $_SESSION["pswd2"] = trim($_POST["pswd2"]);
                                        $_SESSION["quest"] = trim($_POST["quest"]);
                                        $_SESSION["hans"] = trim($_POST["hans"]);

                                        $value1 = $_SESSION["mail"];
                                        $valuemail = $_SESSION["mail2"];
                                        $value2 = $_SESSION["fname"];
                                        $value3 = $_SESSION["lname"];
                                        $value4 = $_SESSION["pswd1"];
                                        $value5 = $_SESSION["pswd2"];
                                        $value6 = $_SESSION["quest"];
                                        $value7 = $_SESSION["hans"];

                                        //echo $value6;
                                        $valuefalg = 10;
                                        $password = $value4;
                                        if (strlen($password) < 8)
                                            $valuefalg = 1;
                                        else if (!preg_match('`[A-Z]`', $password))
                                            $valuefalg = 1;
                                        else if (!preg_match('`[a-z]`', $password))
                                            $valuefalg = 1;
                                        else if (!preg_match('`[0-9]`', $password))
                                            $valuefalg = 1;
                                        else if (!preg_match('`[@#$%]`', $password))
                                            $valuefalg = 1;


                                        /* $sql = "SELECT emailaddress,password from accounts where emailaddress='$value1'";
                                          $result=mysql_query( $sql, $connect);
                                          $row = mysql_fetch_row($result); */
                                        $row = $obj->usernamefetchrow($value1);

                                        $flag = 1;
                                        if ($row[0]) {
                                            $flag = 10;
                                        }

                                        if (($value4 == $value5) && ($flag < 5) && ($value1 == $valuemail) && $valuefalg > 5) {
                                            $value44 = md5($value4);

                                            /* $sql = "INSERT INTO accounts (emailaddress, firstname , lastname , password , Hint , hintAnswer)
                                              VALUES ('$value1','$value2','$value3','$value44','$value6','$value7')";

                                              if (mysql_query( $sql, $connect )===true ) */
                                            $result = $obj->sqlConnect($value1, $value2, $value3, $value44, $value6, $value7);
                                            if ($result === true) {
                                                //echo "attendees values inserted successfully<br>";
                                                header('Location: print.php');
                                            } else {
                                                echo "not inserted" . mysql_error();
                                            }

                                            //echo "Account Created successfully";
                                            //sleep(5);
                                            //header('Location: index.php');
                                        } else {
                                            
                                        }
                                    }
                                    ?>

                                    <div>
                                        <form action="registration.php" method="post" class="form-inline" >
                                            <!--User Name Text Box-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">User Name</label>
                                                <div>
                                                    <input type="email" name="mail" required = "required" placeholder="email" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php
                                    if (isset($_SESSION) and isset($_SESSION["mail"])) {
                                        echo trim($_SESSION["mail"]);
                                    }
                                    ?>"
                                                           />


                                                    <label>
<?php
if (isset($_POST['Submit'])) {
    /* $sql = "SELECT emailaddress,password from accounts where emailaddress='$value1'";
      $result=mysql_query( $sql, $connect);
      $row = mysql_fetch_row($result); */

    $row = $obj->usernamefetchrow($value1);

    $flag = 1;
    if ($row[0]) {
        $flag = 10;
    }

    if ($flag > 3) {
        echo " *Username already Exists";
    }
}
?>
                                                    </label>
                                                </div>
                                            </div>
                                            <br />
                                            <!--End of User Name-->	

                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">Confirm Username </label>
                                                <div>
                                                    <input type="email" name="mail2" required = "required" placeholder="email" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" value="<?php
                                                        if (isset($_SESSION) and isset($_SESSION["mail2"])) {
                                                            echo trim($_SESSION["mail2"]);
                                                        }
                                                        ?>"
                                                           />
                                                    <label>
                                                        <?php
                                                        if (isset($_POST['Submit'])) {
                                                            if (isset($_POST['Submit'])) {
                                                                if (($valuemail != $value1)) {
                                                                    echo "*Email not matched";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <br />

                                            <!--Begin of First Name-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">First Name </label>
                                                <div>
                                                    <input type="text" name="fname"  required = "required"  placeholder="first name" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" value="<?php
                                                    if (isset($_SESSION) and isset($_SESSION["fname"])) {
                                                        echo trim($_SESSION["fname"]);
                                                    }
                                                    ?>"/>
                                                </div>
                                            </div><br />

                                            <!--Begin of Last Name-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">Last Name </label>
                                                <div>
                                                    <input type="text" name="lname"  required = "required" placeholder="last name" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" value="<?php
                                                        if (isset($_SESSION) and isset($_SESSION["lname"])) {
                                                            echo trim($_SESSION["lname"]);
                                                        }
                                                        ?>"/>
                                                </div>
                                            </div><br />


                                            <!--Begin of Password-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">Password </label>
                                                <div>
                                                    <input type="PASSWORD" name="pswd1" required = "required" placeholder="password" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" />
                                                    <label>
                                                    <?php
                                                    if (isset($_POST['Submit'])) {
                                                        $password = $value4;
                                                        if (strlen($password) > 8 && strlen($password) < 21 && preg_match('`[A-Z]`', $password) // at least one upper case 
                                                                && preg_match('`[a-z]`', $password) && preg_match('`[0-9]`', $password) && preg_match('`[@#$%]`', $password)) {
                                                            
                                                        } else {
                                                            if (strlen($password) < 8)
                                                                echo "Password should have atleast 8 characters";
                                                            else if (!preg_match('`[A-Z]`', $password))
                                                                echo "Password must contain atleast one uppercase character";
                                                            else if (!preg_match('`[a-z]`', $password))
                                                                echo "Password must contain atleast one lowercase character";
                                                            else if (!preg_match('`[0-9]`', $password))
                                                                echo "Password must contain atleast one digit";
                                                            else if (!preg_match('`[@#$%]`', $password))
                                                                echo "Password must contain atleast one special character";
                                                        }
                                                    }
                                                    ?>


                                                    </label>
                                                </div>
                                            </div>
                                            <br />

                                            <!--Begin of Confirm Password-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">Confirm Password </label>
                                                <div>
                                                    <input type="PASSWORD" name="pswd2"  required = "required" placeholder="password"  class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" />
                                                    <label>
                                                        <?php
                                                        if (isset($_POST['Submit'])) {
                                                            $password = $value4;
                                                            if (strlen($password) > 8 && strlen($password) < 21 && preg_match('`[A-Z]`', $password) // at least one upper case 
                                                                    && preg_match('`[a-z]`', $password) && preg_match('`[0-9]`', $password) && preg_match('`[@#$%]`', $password)) {
                                                                if (($value4 != $value5) and $value4 != "")
                                                                    echo "*Password not matched";
                                                            }
                                                        }
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <br />

                                            <!--Begin of Hint question-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">Hint Question </label>
                                                <div class="sel">

                                                    <select name="quest" class="form-control" >
                                                        <option value="Favourite Childhood Toy">Favourite childhood toy</option>
                                                        <option value="Favourite Movie">Favourite movie</option>
                                                        <option value="Mother Maiden Name">Mother's maiden name</option>
                                                        <option value="Mother Birth Place">Mother's birth place</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <br /> 

                                            <!--Begin of Hint Answer-->
                                            <div class="form-group has-success has-feedback">
                                                <label class="control-label" for="inputSuccess2">Field Hint </label>
                                                <div>
                                                    <input type="text" name="hans" placeholder="Hint"  required = "required"  class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status"  value="<?php
                                                        if (isset($_SESSION) and isset($_SESSION["hans"])) {
                                                            echo trim($_SESSION["hans"]);
                                                        }
                                                        ?>"/>
                                                </div>
                                            </div>
                                            <br /> <br />
                                            <div class="sub">
                                                <input class="btn btn-primary btn-lg" type="submit" name="Submit" value="SUBMIT" />
                                                <div>
                                                    </form>

                                                </div>
                                            </div> <!--From div-->
                                    </div> <!--end of Pannel body-->
                                </div> <!--End of bootstrap Panel-->
                                </div><!-- End of class ram-->
                                </body>
                                </html>


