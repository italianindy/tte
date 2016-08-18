<?
session_start();
if($_SESSION["strUserID"] == "")
{
header("location:http://112.121.150.67/thaiemployeecare/mainmenu.php");
exit();
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>jQuery Mobile Web App</title>
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

$strSQL = " SELECT * FROM branch  WHERE branch_id = '".$_GET["bid"]."'";


$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);
?>

<div data-role="page" data-theme="e" id="pageMparent">
	<div data-role="header" data-theme="a">
    <a href="mainemployee.php" data-icon="back" data-iconpos="notext" data-direction="reverse" >Back</a>
		<h1><font size="3" >สาขา : <? echo $objResult["branch_name"];?> </font></h1>
	</div>
<?
$strSQL2 = "SELECT
employeecome.emp_id,
employeecome.emc_in,
date_format(employeecome.emc_in, '%H:%i:%s'),
employee.chap_id,
chapter.chap_in,
chapter.chap_late,
if (date_format(employeecome.emc_in, '%H:%i:%s') > date_format(chap_late, '%H:%i:%s'),1,0) AS Late, branch.branch_id, branch.branch_name,employee.emp_prefix,employee.emp_fname, employee.emp_lname
FROM
employeecome ,
employee
LEFT JOIN (
						select chapter.chap_id
						 ,chapter.chap_in
						 ,chapter.chap_late
						 from chapter    
					) AS chapter ON chapter.chap_id= employee.chap_id ,
branch
WHERE
branch.branch_id = '".$_GET["bid"]."' AND
employee.emp_id = employeecome.emp_id AND
employee.emp_status = 'ปกติ' AND
branch.branch_id = employee.branch_id
AND
date_format(employeecome.emc_in,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d') 

 ";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
?>   

	<div data-role="content">	
    <div align="center">
      <img src="pic/choosebrancht1.png" width="250" height="80"> 			</div>
		<ul data-inset="true"  data-role="listview" data-theme="a">
        <li data-role="list-divider">รายชื่อพนักงานเข้าสาย</li>
<?
while($objResult2 = mysql_fetch_array($objQuery2)) {
	if($objResult2["Late"] == "1"){
?>
  <li><a href="#">
    <h3><font size="3" ><? echo $objResult2["emp_prefix"]?></font><font size="3" ><? echo $objResult2["emp_fname"]?> </font> <font size="3" ><? echo $objResult2["emp_lname"]?></font></h3>
    
  </a><a href="#">รายละเอียด</a></li>
<?
	}
}
?> 
</ul>
<?
/*
$strSQL3 = "SELECT
employeecome.emp_id,
employeecome.emc_in,
date_format(employeecome.emc_in, '%H:%i:%s'),
employee.chap_id,
chapter.chap_in,
chapter.chap_late,
if (date_format(employeecome.emc_in, '%H:%i:%s') > date_format(chap_late, '%H:%i:%s'),1,0) AS Late, branch.branch_id, branch.branch_name,employee.emp_prefix,employee.emp_fname, employee.emp_lname
FROM
employeecome ,
employee
LEFT JOIN (
						select chapter.chap_id
						 ,chapter.chap_in
						 ,chapter.chap_late
						 from chapter    
					) AS chapter ON chapter.chap_id= employee.chap_id ,
branch
WHERE
branch.branch_id = '".$_GET["bid"]."' AND
employee.emp_id = employeecome.emp_id AND
employee.emp_status = 'ปกติ' AND
branch.branch_id = employee.branch_id
AND
date_format(employeecome.emc_in,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d') 

 ";
 */
$strSQL3 =  "select employee.*
from employee
where employee.emp_id not in (select emp_id from employeecome where date_format(employeecome.emc_in,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d'))
and employee.emp_status = 'ปกติ'
and employee.branch_id = '".$_GET["bid"]."'";
$objQuery3 = mysql_query($strSQL2) or die (mysql_error());
?>   
<ul data-inset="true"  data-role="listview" data-theme="a">
        <li data-role="list-divider">รายชื่อพนักงานที่ยังไม่เข้างาน</li>
<?
while($objResult3 = mysql_fetch_array($objQuery3)) {
?>
  <li><a href="#">
    <h3><font size="3" ><? echo $objResult3["emp_prefix"]?></font><font size="3" ><? echo $objResult3["emp_fname"]?> </font> <font size="3" ><? echo $objResult3["emp_lname"]?></font></h3>
    
  </a><a href="#">รายละเอียด</a></li>
<?
}
?> 
</ul>
	</div>
    <div data-role="footer" data-theme="a" data-position="fixed">
		<div data-role="navbar">
          <ul>
            <li><a href="logout.php"><font size="4">ออกจากระบบ</font></a></li>
           
          </ul>
        </div>
  </div>
</div>

</body>
</html>