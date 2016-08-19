<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>THAI TIME EMPLOYEE</title>
<link href="jquery-mobile/jquery.mobile.theme-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body> 

<div data-role="page" id="pagePopup">
	<div data-role="header" data-theme="e">
		<h1><font size="3">กรุณาล็อกอิน</font></h1>
	</div>
	<div data-role="content">
    <div align="center">
      <img src="pic/key.png" width="60" height="60"> </div>	
		<form action="http://112.121.150.67/thaitimeemployee/login.php" method="post">
Username : <input type="text" name="txtUsername">
Password :<input type="password" name="txtPassword">
<br />

<font size="4"><input type="submit" value="เข้าสู่ระบบ" data-theme="e"></font>

</form>
	</div>
	
</div>



 </body>
</html>