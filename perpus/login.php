<?php
session_start();
$loginpage=true;
$_SESSION['hrdadmin']='';
require_once('system/config.php');
require_once(LIBDIR.'common.php');
?>
<html>
<head>
<?php
//require_once('xhead.php');
?>
<style type="text/css">
.login_input {
	-moz-border-radius: 5px;border-radius: 5px;
	border:none;
	width:200px;
	height:28px;
	padding:4px;
	font-size:11px;
	font-family: Verdana, Tahoma, Arial;
}

.login_button{
	width: 100%;
    height: 34px;
    color: #fff;
    font-size: 12px;
    font-weight: bold;
    text-shadow: 0px -1px 0px #5b6ddc;
    outline: none;
    border: 1px solid rgba(0, 0, 0, .49);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding-box;
    background-clip: padding-box;
    border-radius: 6px;
    background-color: #5466da;
    background-image: -webkit-linear-gradient(bottom, #5466da 0%, #768ee4 100%);
    background-image: -moz-linear-gradient(bottom, #5466da 0%, #768ee4 100%);
    background-image: -o-linear-gradient(bottom, #5466da 0%, #768ee4 100%);
    background-image: -ms-linear-gradient(bottom, #5466da 0%, #768ee4 100%);
    background-image: linear-gradient(bottom, #5466da 0%, #768ee4 100%);
    cursor: pointer;
    -webkit-box-shadow: inset 0px 1px 0px #9ab1ec;
    box-shadow: inset 0px 1px 0px #9ab1ec;
}
.login_button:hover{
	background-color: #5f73e9;
    background-image: -webkit-linear-gradient(bottom, #5f73e9 0%, #859bef 100%);
    background-image: -moz-linear-gradient(bottom, #5f73e9 0%, #859bef 100%);
    background-image: -o-linear-gradient(bottom, #5f73e9 0%, #859bef 100%);
    background-image: -ms-linear-gradient(bottom, #5f73e9 0%, #859bef 100%);
    background-image: linear-gradient(bottom, #5f73e9 0%, #859bef 100%);
    -webkit-box-shadow: inset 0px 1px 0px #aab9f4;
    box-shadow: inset 0px 1px 0px #aab9f4;
}
.login_button:active{
	background-color: #7588e1;
    background-image: -webkit-linear-gradient(bottom, #7588e1 0%, #7184df 100%);
    background-image: -moz-linear-gradient(bottom, #7588e1 0%, #7184df 100%);
    background-image: -o-linear-gradient(bottom, #7588e1 0%, #7184df 100%);
    background-image: -ms-linear-gradient(bottom, #7588e1 0%, #7184df 100%);
    background-image: linear-gradient(bottom, #7588e1 0%, #7184df 100%);
    -webkit-box-shadow: inset 0px 1px 0px #93a9e9;
    box-shadow: inset 0px 1px 0px #93a9e9;
}

.login_box{
	width:220px;
	margin:auto;
	position:relative;
	border:1px solid #fff;
	padding-top:10px;
	top:150px;
	background-clip: padding-box;
    -moz-border-radius: 6px;border-radius: 6px;
    background: url('images/bgop.png');
}

.notif_red{
	font:12px Verdana,Tahooma;
	color:yellow;
]
</style>
</head>
<body style="background:url('images/blu1.jpg') center top no-repeat fixed;">
<div class="login_box">
<form action="<?=RLNK?>s.php" method="post">
	<table cellspacing="10px" cellpadding="0">
	<?php if(gets('login')=='reqauth'){?><tr><td><div class="notif_red">You have entered wrong username or password.</div></td></tr> <?php } ?>
	<tr><td><input class="login_input" type="text" name="username" placeholder="User ID"></td></tr>
	<tr><td><input class="login_input" type="password" name="password" placeholder="Password"></td></tr>
	<tr><td><input class="login_button" type="submit" value="Log In"></td></tr>
	<tr><td><input class="login_button" type="button" onclick="document.location='../'" value="Home Menu"></td></tr>
	</table>
</form>
</div>

</body>
</html> 