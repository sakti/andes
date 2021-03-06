<?php
session_start();
require_once('../lib/auth.php');
auth_page('');
?>

<!DOCTYPE html>
<html>
<head>
    <title>andes login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="../../css/south-street/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <link type="text/css" href="../../css/main.css" rel="stylesheet" />
    <style type="text/css">
        #wrapper{
            width:250px;
            padding:100px;
        }
        
        #content > h1{
            margin:0;
            text-align:left;
            font-size:15pt;
            font-weight:800;
            padding:6px;
            text-decoration:underline;
            text-shadow: 0 2px 3px green;
        }
        #container{
            padding:10px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <a href="/index.php"><img src="../../images/small_logo.png"/></a>
            <p><strong>An</strong>dromeda <strong>De</strong>livery <strong>S</strong>ystem</p>
        </div>
        <div id="content" class="ui-widget-content ui-corner-all">
            <h1>log In</h1>
            <div id="container">
                <div class="error">
                    <?php if(!empty($_SESSION['error_login'])):?>
                            <label class="error"><?php echo $_SESSION['error_login']; ?></label>
                    <?php endif;?>
                </div>
                <form id="login" class="def_form" action="control.php" method="post">
                    <label for="username">Username</label><input type="text" name="username" id="username" size="25" maxlength="9">
                    <label for="password">Password</label><input type="password" name="password" id="password" size="25">
                    <input type="hidden" name="op" value="login">
                    <hr/>
                    <input type="submit" class="tombol" name="kirim" value="LogIn" />
                    <input type="reset" class="tombol" name="hapus" value="Hapus" />
                </form>       
            </div>                     
        </div>
        <div id="footer" class="ui-corner-all">
            Under development &copy; 2010
        </div>        
    </div>
</body>
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/jquery.bgiframe-2.1.1.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript">
	$(function() {      
        $("#login").validate({
		    errorLabelContainer: $("#container .error"),
	        rules:{
	            username:{
	                required:true,
	                minlength:9
	                },
	            password:"required",
	            },
	        messages:{
			    username: {
				    required: "Tolong masukkan username anda",
				    minlength: "Username terdiri dari 9 digit"
			    },
	            password: "Isikan password anda",
	        }		    
	    });		  
	});
</script>
</html>
