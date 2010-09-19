<?php
session_start();
require_once('../../lib/auth.php');
require_once('../../lib/koneksi.php');
require_once('../../modules/tracking.php');
require_once('../../modules/pegawai.php');
auth_page('peg. pengiriman');

?>

<!DOCTYPE html>
<html>
<head>
    <title>andes pegawai pengiriman</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="../../css/south-street/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <link type="text/css" href="../../css/main.css" rel="stylesheet" />
    <link type="text/css" href="../../css/dashboard.css" rel="stylesheet" />
    <link type="text/css" href="../../css/pengiriman.css" rel="stylesheet" />
    <style type="text/css">

    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div id="panelid">
                <h1>Peg. Pengiriman Dashboard</h1>
                <div>
                    <a href="../control.php?op=logout"><button id="logout" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-power"></span><span class="ui-button-text">Logout</span></button></a>
                    <p><span class="nama"><?php echo $_SESSION['nama'];?></span></p><hr/>
                    <p>Cabang: <?php echo $_SESSION['namakantorcabang'];?></p>
                </div>
            </div>
            
        </div>
        <div id="content">
