<?php
require('mysql/config.php');

if(isset($_GET['mid'])){
	$mid = $_GET['mid'];
} else {
	$mid = "";
}

if(isset($_GET['bid'])){
	$bid = $_GET['bid'];
} else {
	$bid = "";
}

$msg = "";
$v1 = 0;

$sql = "SELECT DATEDIFF(NOW(), tlend) FROM transections WHERE bid='$bid' AND mid='$mid' AND tstat='1'";
require('mysql/connect.php');
$result = mysqli_query($conn, $sql);

if (!$result) {
	die("เกิดข้อผิดพลาดในการคิวรี: " . mysqli_error($conn));
}

$row = mysqli_fetch_array($result);
$numday = (int)$row[0];
require('mysql/unconn.php');

if ($numday > 7) {
	$tstat = 2;
} else {
	$tstat = 0;
}

$sql = "UPDATE transections SET trest=NOW(), tstat='$tstat' WHERE bid='$bid' AND mid='$mid' AND tstat='1'";
require('mysql/connect.php');
$result = mysqli_query($conn, $sql);

if ($result) {
	$msg = "การส่งคืนเสร็จสิ้น";
	$v1 = 1;
} else {
	$msg = "การส่งคืนเกิดข้อผิดพลาด";
	$v1 = 0;
}
require('mysql/unconn.php');
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>การคืนหนังสือ</title>
</head>
<body>
<script language="javascript">
var v1 = <?php echo($v1); ?>;
alert('<?php echo($msg); ?>');
if (v1 == 1) {
	window.location.replace("mbr_detail.php?mid=<?php echo($mid); ?>");
} else {
	window.history.back();
}
</script>
</body>
</html>
