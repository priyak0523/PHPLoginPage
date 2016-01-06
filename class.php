<html>
    <head>
    </head>
    <body>
        <?php

        class connection {

            public $connect, $databaseselect;

            public function connect() {
                $connect = mysql_connect('localhost', 'root', "");
                $databaseselect = mysql_select_db('cpd2374project', $connect);
                if (!$databaseselect) {
                    die('can\'t use cpd2374project  : ' . mysql_error() . '<br>');
                }
                return $connect;
            }

            public function usernamefetchrow($username) {
                $connect = $this->connect();
                $sql = "SELECT emailaddress,password, firstname, lastname from accounts where emailaddress='$username'";
                $result = mysql_query($sql, $connect);
                $row = mysql_fetch_row($result);
                return $row;
            }

            public function sqlConnect($value1, $value2, $value3, $value44, $value6, $value7) {
                $connect = $this->connect();
                $sql = "INSERT INTO accounts (emailaddress, firstname , lastname , password , Hint , hintAnswer)
						VALUES ('$value1','$value2','$value3','$value44','$value6','$value7')";
                $result = mysql_query($sql, $connect);
                return $result;
            }

            public function hintQuestionfn($mailvalue) {
                $connect = $this->connect();
                $sql = "SELECT emailaddress, Hint, hintAnswer from accounts where emailaddress='$mailvalue'";
                $result = mysql_query($sql, $connect);
                $row = mysql_fetch_row($result);
                return $row;
            }

            public function hintAnswerfn($mailvalue, $ans) {
                $connect = $this->connect();
                $sql = "SELECT hintAnswer, firstname, lastname from accounts where emailaddress='$mailvalue' AND hintAnswer='$ans' ";
                $result = mysql_query($sql, $connect);
                $row = mysql_fetch_row($result);
                return $row;
            }

            public function captcha1() {
                if (isset($_SESSION['my_captcha'])) {
                    unset($_SESSION['my_captcha']);
                }
                $string1 = "abcdefghijklmnopqrstuvwxyz";
                $string2 = "1234567890";
                $string = $string1 . $string2;
                $string = str_shuffle($string);
                $random_text = substr($string, 0, 6);
                $_SESSION['my_captcha'] = $random_text;
                ?>
                <div class="capt">
                    <p>
                <?php
                echo $_SESSION['my_captcha'];
                ?>
                    </p>
                </div>
                <?php
                return $random_text;
            }

        }
        ?>
    </body>
</html>



