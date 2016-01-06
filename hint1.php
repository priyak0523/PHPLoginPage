<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN PAGE</title>
        <link rel="stylesheet" type="text/css" href="css/hint1.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="ram">
            <div class="panel panel-success">
                <div class="panel-heading"><p class="aligncenter"><p class="a"><strong>Hint Question<strong></p></div>
                                <div class="panel-body">
                                    <?php
                                    session_start();
                                    include_once "class.php";

                                    /* $connect= mysql_connect('localhost', 'root', "");
                                      $databaseselect = mysql_select_db('cpd2374project', $connect); */

                                    $obj = new connection();

                                    /* if (!$databaseselect) 
                                      {
                                      die ('can\'t use cpd2374project  : ' . mysql_error().'<br>');

                                      } */


                                    if (isset($_SESSION["username"])) {
                                        $mailvalue = $_SESSION["username"];
                                    } else {
                                        $mailvalue = "";
                                    }
                                    ?>

                                    <form action="hint1.php" method="post" class="form-inline">

                                        <div class="form-group has-success has-feedback">
                                            <label class="control-label" for="inputSuccess2">Email Address</label>
                                            <div>
                                                <input type="email" name="emailforget" required = "required" placeholder="Email" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" value="<?php echo $mailvalue; ?>"  /> <br /> <br />
                                                <?php
                                                /* $sql = "SELECT emailaddress, Hint, hintAnswer from accounts where emailaddress='$mailvalue'";
                                                  $result=mysql_query( $sql, $connect);
                                                  $row = mysql_fetch_row($result); */
                                                $row = $obj->hintQuestionfn($mailvalue);

                                                $flag = 1;
                                                if ($row[1]) {
                                                    $flag = 10;
                                                }

                                                if ($flag > 3) {

                                                    echo $row[1];
                                                } else {
                                                    echo "Username ";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <br /> <br />
                                        <div class="form-group has-success has-feedback">
                                            <label class="control-label" for="inputSuccess2">HINT ANSWER</label>
                                            <div>
                                                <input type="textbox" name="hans"  required = "required" placeholder="Password" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" />
                                                <?php
                                                if (isset($_POST['verify'])) {
                                                    $ans = $_POST["hans"];

                                                    /* 	$hint_ans = "SELECT hintAnswer, firstname, lastname from accounts where emailaddress='$mailvalue' AND hintAnswer='$ans' ";
                                                      $ans_result=mysql_query( $hint_ans, $connect);

                                                      $row = mysql_fetch_row($ans_result); */

                                                    $row = $obj->hintAnswerfn($mailvalue, $ans);

                                                    $flag = 1;
                                                    if ($row[0]) {
                                                        $flag = 10;
                                                    }

                                                    if ($flag > 3) {
                                                        $_SESSION["fname"] = $row[1];
                                                        $_SESSION["lname"] = $row[2];
                                                        header('Location: welcome.php');
                                                    } else {
                                                        echo "Incorrect answer";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <br/><br/>
                                        <input type="submit" class="btn btn-primary btn-lg" name="verify" value="verify" /><br/><br/>
                                    </form>
                                    </html>

