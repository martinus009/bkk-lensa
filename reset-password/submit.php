<?php
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  mysql_connect('localhost','root','db_lowker');
  mysql_select_db('sample');
  $select=mysql_query("update user set password='$pass' where email='$email'");
}
?>