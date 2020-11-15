<?php require_once('config.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysqli_select_db("delevery");
$query_book = "SELECT * FROM items";
$book = mysql_query($query_book) or die(mysql_error());
$row_book = mysql_fetch_assoc($book);
$totalRows_book = mysql_num_rows($book);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
 <p align="center"><img src="images/PIC-681-1354665003.gif" /></p>
<table height="112" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td width="41">تعديل</td>
    <td width="36">حذف</td>
    <td width="36">إدخال</td> 
		  <td width="89"><div align="center">سعر الصنف</div></td>
		   <td width="93"><div align="center">نوع الصنف</div></td>
		  	 <td width="89"><div align="center">اسم الصنف</div></td>
		  <td width="91"><div align="center">الكميه المتوفره</div></td>
		  <td width="74"><div align="center">رقم الصنف</div></td>
		 
   
  </tr>
  <?php do { ?>
    <tr>
	 <td> <div align="center"><a href="updi.php?mno=<?php echo $row_book['mno']; ?>" target="main">x</a> </div></td>
      <td><div align="center"><a href="delin.php?no=<?php echo $row_book['mno']; ?>" target="main">y</a></div></td>
      <td><div align="center"><a href="idel.php?mno=<?php echo $row_book['mno']; ?>" target="main">z</a></div></td>
				<td><?php echo $row_book['mprice']; ?></td>
				<td><?php echo $row_book['mtype']; ?></td>
				<td><?php echo $row_book['mname']; ?></td>
				<td><?php echo $row_book['mmount']; ?></td>
				 <td><?php echo $row_book['mno']; ?></td>
				
    </tr>
    <?php } while ($row_book = mysql_fetch_assoc($book)); ?>
</table>
<div align="center"></div>
 <p align="center"><img src="images/loo.png" /></p>
</body>
</html>
<?php
mysql_free_result($book);
?>
