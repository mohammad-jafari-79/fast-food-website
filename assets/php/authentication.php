<?php
session_start();
$servername = "localhost";
$username = "pizoo";
$password = "mypizoo";
$dbname = "pizoo";
$pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['sub'])) {
    if ($_POST['sub'] == "signup") {
        $first_name = filter_input(INPUT_POST, 'name');
        $last_name = filter_input(INPUT_POST, 'lname');
        $email = filter_input(INPUT_POST, 'email');
        $password1 = filter_input(INPUT_POST, 'pass1');
        $password2 = filter_input(INPUT_POST, 'pass2');
        $phone_number = filter_input(INPUT_POST, 'mob');
        $address = filter_input(INPUT_POST, 'address');
        $sql = "INSERT INTO Users (`first_name`, `last_name`,`email`,`password`,`phone_number`,`address`) VALUES (?,?,?,?,?,?)";
        $pdo->prepare($sql)->execute([$first_name, $last_name, $email, $password1, $phone_number, $address]);
        setlogin($email);
        echo '1';
    }
    if ($_POST['sub'] == "signin") {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $sql = "SELECT * from Users where `email`=:email and `password`=:pass ";
        $sth = $pdo->prepare($sql);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->bindParam(':pass', $pass, PDO::PARAM_STR);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            echo '0';
        } else {
            setlogin($email);
            echo '1';
        }
    }
}
// check login
if (isset($_GET['islogin'])) {
    if (@$_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']) || @$_SESSION['HTTP_USER'] != md5(@$_SESSION['HTTP_USER_STAMP']) || $_COOKIE["login"] != md5("myhash")) {
        echo '0';
    } else {
        echo $_SESSION['HTTP_USER_NAME'];
    }
}
function setlogin($username)
{
    setcookie("login", md5("myhash"), time() + 655500);
    $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
    $_SESSION['HTTP_USER_STAMP'] = time();
    $_SESSION['HTTP_USER'] = md5($_SESSION['HTTP_USER_STAMP']);
    $_SESSION['HTTP_USER_NAME'] = $username;
}

