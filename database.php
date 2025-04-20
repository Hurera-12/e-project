<?php
$servername="localhost";
$username="root";
$password="";
$db="library_db";

$conn=new mysqli($servername,$username,$password,$db);

if($conn){
    echo "proud of you dua";
}else{
    echo "you can do it";
}