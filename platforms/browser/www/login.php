<?
session_start();
?>
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
<?
$objConnect = mysql_connect("119.59.125.117","employee","osstec1234") or die(mysql_error());

$objDB = mysql_select_db("employee_db_imc");
mysql_query("SET NAMES utf8", $objConnect);

$strSQL = " SELECT * FROM employee  WHERE emp_username = '".$_POST["txtUsername"]."' AND emp_password = '".$_POST["txtPassword"]."' "; 
$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);
?>

<div data-role="page" data-theme="e" id="pageLogin">
	<div data-role="header" data-theme="a">
   <a href="http://119.59.125.117/thaitimeemployee/logout.php" data-icon="home" data-iconpos="notext" data-direction="reverse" >Back</a>
<h1><font size="5">เข้าสู่ระบบ</font></h1>
		
	</div>


<?

if(!$objResult)

{
	
?>
<div align="center">

      <img src="pic/notuser.png" width="240" height="120"> 			</div>
<font size="4" ><a href="http://119.59.125.117/thaitimeemployee/mainmenu.php" data-icon="back" data-role="button" data-theme="a">ลองอีกครั้ง</a></font>
<?
}
else
{
$_SESSION["strUserID"] = $objResult["emp_id"];
?>

	<div style="padding-left:10px;padding-right:10px">
		
        <div align="center">
      <img src="pic/welcome1.png" width="240" height="120"> </div>
		<div data-role="fieldcontain" align="center">
			<font size="4" color="#990000"><label for="name">ชื่อผู้ใช้ : คุณ</label><? echo $objResult["emp_fname"];?> <? echo $objResult["emp_lname"];?></font>
		</div>
        <div data-role="fieldcontain" align="center">
			<font size="4" color="#990000"><label for="name">รหัสพนักงาน</font> <font size="3" color="#990000">: <? echo $objResult["emp_id"];?></font>
		</div>
		<font size="4" color="#990000"><a href="http://119.59.125.117/thaitimeemployee/mainemployee.php" data-icon="grid" data-role="button" data-theme="a">เข้าสู่เมนูหลัก</a></font>
    </div>    

<?
}
?>


 
</div>



</body>
</html>