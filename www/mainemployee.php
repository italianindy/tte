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

$strSQL = " SELECT * FROM employee  WHERE emp_id = '".$_SESSION["strUserID"]."'";
$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);

$sql = "select branch_id,count(*)
from employee
group by branch_id";
$objQuery3 = mysql_query($sql) or die (mysql_error());
while($objResult3 = mysql_fetch_array($objQuery3)) {
	$TotalEmp[$objResult3[0]] = $objResult3[1];
}


?>

<div data-role="page" data-theme="e" id="pageMparent">
	<div data-role="header" data-theme="a">
    <a href="http://112.121.150.67/thaiemployeecare/logout.php" data-icon="home" data-iconpos="notext" data-direction="reverse" >Back</a>
		<h1><font size="2" >ชื่อผู้ใช้ : คุณ<? echo $objResult["emp_fname"];?> <? echo $objResult["emp_lname"];?></font></h1>
	</div>
<?
$strSQL2 = "SELECT
Count(*) AS ComeCount,
Sum(if(date_format(employeecome.emc_in,'%H:%i:%s') > date_format(chap_late,'%H:%i:%s'),1,0)) AS LateCount, 
branch.branch_name, branch.branch_id, COUNT(employee.emp_id) AS NumEmp
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
employee.emp_id = employeecome.emp_id AND
employee.emp_status = 'ปกติ' AND
date_format(employeecome.emc_in,'%Y-%m-%d') = date_format(now(),'%Y-%m-%d') AND
branch.branch_id = employee.branch_id
GROUP BY
employee.branch_id

 ";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
?>   

	<div data-role="content">	
    <div align="center">
      <img src="pic/mainemployee.png" width="270" height="80"> 			</div>
		<ul data-inset="true"  data-role="listview" data-theme="a">
<?
while($objResult2 = mysql_fetch_array($objQuery2)) {
	if(isset($TotalEmp[$objResult2["branch_id"]])){		
		$leave = $TotalEmp[$objResult2["branch_id"]] - $objResult2["ComeCount"];
		$total = $TotalEmp[$objResult2["branch_id"]];
	}else{
		$leave = 0 - $objResult2["ComeCount"];
		$total = 0;
	}
	
		
	
	 
?>
  <li><a href="#">
    <h3><font size="4" >สาขา<? echo $objResult2["branch_name"]?> </font><font size="3" >พนักงานทั้งหมด </font><font size="2" ><? echo $total;?></font> <font size="3" >คน</font></h3>
    <p> <font size="3" >เข้างานแล้ว </font><font size="2" ><? echo $objResult2["ComeCount"]?> <font size="3" >คน</font>  </font> <font size="3" >เข้าสาย </font><font size="2" ><? echo $objResult2["LateCount"]?> <font size="3" >คน</font>  </font> <font size="3" >ยังไม่มา </font><font size="2" ><? echo $leave;?> <font size="3" >คน</font></font></p>
  </a><a href="http://112.121.150.67/thaiemployeecare/detailemployee.php?bid=<?=$objResult2["branch_id"];?>">รายละเอียด</a></li>
<?
}
?> 
</ul>
	</div>
    <div data-role="footer" data-theme="a" data-position="fixed">
		<div data-role="navbar">
          <ul>
            <li><a href="http://112.121.150.67/thaiemployeecare/logout.php"><font size="4">ออกจากระบบ</font></a></li>
           
          </ul>
        </div>
  </div>
</div>

</body>
</html>