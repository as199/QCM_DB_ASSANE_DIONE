<?php
session_start();

if(empty($_SESSION['connecter'])){
header("location:../index.php");
exit();
}



$_SESSION['monscore']=0;
$_SESSION['trouver']=[];
$_SESSION['data']=[];
$_SESSION['total'] =[];
$_SESSION['rubrique'] =[];
header('location:../vue/configuration.php');
