<html>
<style>

header{
	font-size:30px;
	align:center;
}
#box{
	width:250px;
	height:auto;
	border:1px solid black;
}
</style>
<body>
<center>
<header>Attendance Recorder</header>
<br><br>
<form action="lab11.php" id="myForm" method="post">

<div id="box">
<span>Email:<input type="text" name="user"><span>
<br>
<span>Password:<input type="text" name="pass"><span>
<br>
<center>
<input type="submit" name="Submit" value="Login">
</center>
</div>

</form>

<?php
if (isset($_POST['Submit'])) {
$link = mysql_connect('localhost', 'root', '');
mysql_select_db("attendance",$link);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$username = $_POST['user'];
$password = $_POST['pass'];

$result= mysql_query("SELECT email FROM user", $link);
$pw= mysql_query("SELECT password FROM user", $link);
$face=mysql_query("SELECT role FROM user", $link);
$check=false;
if($result){
	for($i = 0; $i < mysql_num_rows($result); $i++){
		$temp= mysql_result($result, $i);
		$temp1= mysql_result($pw, $i);
		
		if($temp==$username && $temp1==$password ){
			$check=true;
			$face=mysql_result($face, $i);
			echo 'Login Passed';
			if($face=='student'){header('Location: student.php'); }
			break;
		}
	
	}
	if($check==false){
		echo 'Invalid Credentials';}
}
else{
	echo 'Error!';	
}	

mysql_close($link);
}
?>

</center>



</body>
</html>