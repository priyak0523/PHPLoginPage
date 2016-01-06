<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>LOGIN PAGE</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>

    <body>			
        <div class="ram">
            <div class="panel panel-success">
                <div class="panel-heading"><p class="aligncenter"><p class="a"><strong>LOGIN PAGE<strong></p></div>
                                <div class="panel-body">
                                    <?php
                                    global $tempvalue;
                                    session_start();
                                    include "database.php";
                                    include_once "class.php";
                                    if (isset($_SESSION['my_captcha'])) {
                                        $tempvalue = $_SESSION['my_captcha'];
                                    }
                                    $cookie_name = "";
                                    $cookie_value = "";

                                    session_destroy();
                                    session_start();

                                    /* Database connection */
                                    /* $connect= mysql_connect('localhost', 'root', "");
                                      $databaseselect = mysql_select_db('cpd2374project', $connect); */
                                    $obj = new connection();

                                    if (isset($_POST['Submit1'])) {
                                        /* Creating session */
                                        $_SESSION["username"] = $_POST["username"];
                                        $_SESSION["pswd"] = $_POST["pswd"];

                                        $username = trim($_SESSION["username"]);
                                        $password = trim($_SESSION["pswd"]);

                                        /* 	if (isset($_POST['remember']))
                                          {
                                          $value = 'something from somewhere';
                                          setcookie("TestCookie", $value);
                                          echo $_COOKIE["TestCookie"];
                                          }
                                         */

                                        /* $sql = "SELECT emailaddress,password, firstname, lastname from accounts where emailaddress='$username'";
                                          $result=mysql_query( $sql, $connect);
                                          $row = mysql_fetch_row($result); */

                                        $row = $obj->usernamefetchrow($username);

                                        $flagcaptcha = 0;
                                        if ($tempvalue == $_POST["captcha"]) {
                                            $flagcaptcha = 9;
                                            $_SESSION['my_captcha'] = $tempvalue;
                                        }
                                        $flag = 1;
                                        if ($row[0]) {
                                            $flag = 10;
                                        }
                                        if (($flag > 3) && ($flagcaptcha > 3)) {
                                            if (($row[1] == md5($password)) && ($row[0] == $username)) {
                                                $_SESSION["fname"] = $row[2];
                                                $_SESSION["lname"] = $row[3];
                                                if (isset($_POST['remember'])) {
                                                    $cookie_name = "cookieusername";
                                                    $cookie_value = $username;
                                                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                                                }


                                                header('Location: welcome.php');
                                            }
                                        }
                                    }
                                    ?>

                                    <div>
                                        <form action="index.php" method="post" class="form-inline">
                                            <fieldset>
                                                <!--Begin of User Name-->	

                                                <!--User Name Text Box-->
                                                <div class="form-group has-success has-feedback">
                                                    <label class="control-label" for="inputSuccess2">User Name</label>
                                                    <div>
                                                        <input type="text" name="username"  required = "required" placeholder="Email" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php
                                                        if (isset($_SESSION) and isset($_SESSION["username"])) {
                                                            /* $sql = "SELECT emailaddress,password from accounts where emailaddress='$username'";
                                                              $result=mysql_query( $sql, $connect);
                                                              $row = mysql_fetch_row($result); */

                                                            $row = $obj->usernamefetchrow($username);
                                                            $flag = 1;
                                                            if ($row[0]) {
                                                                $flag = 10;
                                                            }
                                                            if ($flag > 3) {
                                                                if ($row[0] != $username) {
                                                                    echo "";
                                                                } else {
                                                                    echo $username;
                                                                }
                                                            }
                                                        }
                                                        ?>"/>	

                                                        <!--User Name Validation-->	

                                                        <label>
                                                            <?php
                                                            if (isset($_POST['Submit1'])) {
                                                                /* $sql = "SELECT emailaddress,password from accounts where emailaddress='$username'";
                                                                  $result=mysql_query( $sql, $connect);
                                                                  $row = mysql_fetch_row($result); */

                                                                $row = $obj->usernamefetchrow($username);

                                                                // echo $username;
                                                                $flag = 1;

                                                                if ($row[0]) {
                                                                    $flag = 10;
                                                                }

                                                                if ($flag > 3) {
                                                                    
                                                                } else {
                                                                    echo " *Username Not Found";
                                                                }
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                </div>		
                                                <br />
                                                <!--End of User Name-->	

                                                <!--Begin of Password-->

                                                <!--Password Text Box-->
                                                <br/>
                                                <div class="form-group has-success has-feedback">
                                                    <label class="control-label" for="inputSuccess2">Password</label>
                                                    <div>
                                                        <input type="password" name="pswd"  placeholder="Password" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" required = "required" >

                                                        <!--Password Validation-->	
                                                        <label>
                                                            <?php
                                                            if (isset($_POST['Submit1'])) {
                                                                /* $sql = "SELECT emailaddress, password from accounts where emailaddress='$username'";
                                                                  $result = mysql_query( $sql, $connect);
                                                                  $row = mysql_fetch_row($result); */

                                                                $row = $obj->usernamefetchrow($username);

                                                                $flag = 1;
                                                                if ($row[1]) {
                                                                    $flag = 10;
                                                                }
                                                                if ($flag > 3) {
                                                                    if ($row[1] != md5($password)) {
                                                                        echo "*Incorrect password";
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </label>

                                                    </div>	
                                                </div>
                                                <br /><br />
                                                <!--End of Password-->	

                                                <!--Begin of Captcha-->		

                                                <?php
                                                $tempvalue = $obj->captcha1();
                                                /* $tempvalue=captcha1(); */
                                                ?>
                                                <br />

                                                <!--Captcha TextBox-->	
                                                <div class="form-group has-success has-feedback">
                                                    <label class="control-label" for="inputSuccess2">Captcha</label>
                                                    <div>
                                                        <input type="text" name="captcha" placeholder="Case Insensitive" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status"  required = "required" /> 
                                                    </div>
                                                </div>

                                                <!--Captcha Validation-->	

                                                <label>
                                                    <?php
                                                    if (isset($_POST['Submit1'])) {
                                                        /* $sql = "SELECT emailaddress, password from accounts where emailaddress='$username'";
                                                          $result = mysql_query( $sql, $connect);
                                                          $row = mysql_fetch_row($result); */

                                                        $row = $obj->usernamefetchrow($username);

                                                        $flag = 1;
                                                        if ($row[1]) {
                                                            $flag = 10;
                                                        }
                                                        if ($flag > 3) {
                                                            if ($row[1] == md5($password)) {
                                                                if ($_SESSION['my_captcha'] != $_POST["captcha"]) {
                                                                    echo "*Capcha is Not equal";
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </label>
                                                <br /><br />

                                                <!--End of Captcha-->	

                                                <!--Begin of Checkbox-->

                                                <div class="has-success">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="remember" id="checkboxSuccess" value="option1">
                                                        <label style="color:#3c763d;font-weight:bold;">  Remember Me </label>
                                                    </div>
                                                </div>						
                                                <br />							
                                                <!--End of Checkbox-->		

                                                <!--Begin of Submit-->
                                                <input class="btn btn-primary btn-lg" type="submit" name="Submit1" value="Submit"/>
                                                <br/>
                                                <br/>
                                                <!--End of Submit-->

                                                <!--anchor Tag-->
                                                <a href="registration.php" > New Register</a> 
                                                <a href="hint.php" class="second"> Forgot password? </a>
                                                <!--anchor Tag-->

                                            </fieldset>
                                        </form>
                                    </div> <!--From div-->
                                </div> <!--end of Pannel body-->
                                </div> <!--End of bootstrap Panel-->
                                </div><!-- End of class ram-->			

                                </body>

                                </html>

