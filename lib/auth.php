<?php
function auth_autentifikasi($username,$password){
    $query = sprintf("SELECT id, nama, jabatan, idkantorcabang FROM pegawai WHERE id='%s' AND password='%s'",
        mysql_real_escape_string($username),
        md5(mysql_real_escape_string($password)));        
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }    
    if(mysql_num_rows($result)!=1){
        return false;
    }
    $row = mysql_fetch_assoc($result);
    return $row;
}
function auth_page($menu){
    if(empty($_SESSION['nama'])){
        if($_SERVER["REQUEST_URI"]!='/view/index.php')header("Location: /view/index.php");
    }else if($menu!=$_SESSION['jabatan']){
        switch($_SESSION['jabatan']){
            case 'administratif':
                header("Location: /view/administratif");
                break;
            case 'peg. pengiriman':
                header("Location: /view/pengiriman");
                break;
            case 'customer service':
                header("Location: /view/cs/");
                break;
        }
    }
}
function auth_logout(){
    session_destroy();
    header("Location: /view/index.php");
}
