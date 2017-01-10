<?php

$name = "Bart";
$pw = "bartman";

if (is_correct_password($name, $pw)) {
	# redirect?
	session_start();
	print "succesfful";
} else {
	print "--,.--;;;;;;;;;";
}


function is_correct_password($name, $pw) {
	$db = new PDO("mysql:dbname=blog_app", "root", "");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$rows = $db->query("SELECT password FROM users WHERE name = '$name'");
	foreach ($rows as $row) {
		$correct_password = $row["password"];
		if ($pw == $correct_password) {
			return TRUE;
		}
	}
	return FALSE;
}


 ?>
