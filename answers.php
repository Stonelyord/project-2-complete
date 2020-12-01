<?php

include_once("config.php");

$con = config::connect();

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $body = $_POST['body'];
    $skills = $_POST['skills'];

    if($title == "" || $body =="" || $skills =="")
    {
        return;
    }

    if(insertDetails($con,$title,$body,$skills));
    {
        echo "questions Inserted Successfully";
    }
}

function insertDetails($con,$title,$body,$skills)
{
    $query = $con->prepare ("
    
    INSERT INTO questions (title,body,skills)
    
    VALUES(:title,:body,:skills)
    ");

    $query->bindparam(":title,$title");
    $query->bindparam(":body,$body");
    $query->bindparam(":skills,$skills");

    return $query->execute();
}
