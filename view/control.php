<?php
session_start();
require_once('../lib/koneksi.php');
require_once('../lib/auth.php');
require_once('../modules/kantor_cabang.php');
require_once('../modules/tracking.php');

if(!empty($_REQUEST['op'])){
    switch($_REQUEST['op']){
        case 'login':
            $hasil=auth_autentifikasi($_POST['username'],$_POST['password']);
            if($hasil){
                $_SESSION['id']=$hasil['id'];
                $_SESSION['nama']=$hasil['nama'];
                $_SESSION['jabatan']=$hasil['jabatan'];
                if($_SESSION['jabatan']=='peg. pengiriman'){
                    $_SESSION['rute']=track_getRuteByIdPeg($_SESSION['id']);
                }
                $_SESSION['idkantorcabang']=$hasil['idkantorcabang'];
                $_SESSION['namakantorcabang']=kc_getNamaKC($hasil['idkantorcabang']);
                $_SESSION['idkecamatan']=kc_getIdKecKC($hasil['idkantorcabang']);
                unset($_SESSION['error_login']);
                header("Location: administratif/index.php");
            }else{
                $_SESSION['error_login']="username atau password tidak valid";
                header("Location: index.php");
            }
            break;
        case 'logout':
            auth_logout();
            break;
    }
}else{
    header("Location: ../index.php");
}

