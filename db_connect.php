<?php 
//connect to database
$conn=mysqli_connect("localhost","root","","hospital_management");//server/username/pass/db
//check connection
if(!$conn){
    echo"Connection error:". mysqli_connect_error();
}