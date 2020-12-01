<?php

session_start();

include_once("config.php");


if(isset($_POST['register']))
{
    $con = config::connect();
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birthday = $_POST['birthday'];
    $password = $_POST['password'];

    if($birthday == "")
    {
        return;
    }

    if(insertDetails($con,$email,$fname,$lname,$birthday,$password));
    {
       $_SESSION['fname'] = $fname;
       header("Location: message.php");
    }
}


if(isset($_POST['login']))
{
    $con = config::connect();
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(checkLogin($con,$email,$password))
    {
        $_SESSION['email'] = $email;
        header("Location: message.php");
    }
    else{
        echo "The email and password are incorrect";
    }
}



function insertDetails($con,$email,$fname,$lname,$birthday,$password)
{
    $query = $con->prepare("
    
    INSERT INTO accounts (email,fname,lname,birthday,password)
    
    VALUES(:email,:fname,:lname,:birthday,:password)
    ");
    $query->bindparam(":email,$email");
    $query->bindparam(":fname,$fname");
    $query->bindparam(":lname,$lname");
    $query->bindparam(":birthday,$birthday");
    $query->bindparam(":password,$password");

    return $query->execute();
}

function checkLogin($con,$email,$password)
{
    $query = $con->prepare("
    
    SELECT * FROM accounts WHERE email=:email AND password=:password
    
    ");

    $query->bindparam(":email,$email");
    $query->bindparam(":password,$password");

    $query->execute();

    //check returns

    if($query->rowCount() ==1)
    {
        return true;
    }
    else {
        return false;
    }
}



