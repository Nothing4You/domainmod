<?php
// /system/email-settings.php
// 
// Domain Manager - A web-based application written in PHP & MySQL used to manage a collection of domain names.
// Copyright (C) 2010 Greg Chetcuti
// 
// Domain Manager is free software; you can redistribute it and/or modify it under the terms of the GNU General
// Public License as published by the Free Software Foundation; either version 2 of the License, or (at your
// option) any later version.
// 
// Domain Manager is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
// implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
// for more details.
// 
// You should have received a copy of the GNU General Public License along with Domain Manager. If not, please 
// see http://www.gnu.org/licenses/
?>
<?php
include("../_includes/start-session.inc.php");
include("../_includes/config.inc.php");
include("../_includes/database.inc.php");
include("../_includes/software.inc.php");
include("../_includes/timestamps/current-timestamp.inc.php");
include("../_includes/auth/auth-check.inc.php");

$page_title = "Edit Email Settings";
$software_section = "system";

// Form Variables
$new_expiration_email = $_POST['new_expiration_email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$sql = "UPDATE user_settings
			SET expiration_emails = '$new_expiration_email',
				update_time = '$current_timestamp'
			WHERE user_id = '" . $_SESSION['session_user_id'] . "'";
	$result = mysql_query($sql,$connection) or die(mysql_error());

	$_SESSION['session_expiration_email'] = $new_expiration_email;

	$_SESSION['session_result_message'] .= "Your Email Settings were updated<BR>";
	
	header("Location: index.php");
	exit;

} else {

	$sql = "SELECT expiration_emails
			FROM user_settings
			WHERE user_id = '" . $_SESSION['session_user_id'] . "'";
	$result = mysql_query($sql,$connection) or die(mysql_error());
	
	while ($row = mysql_fetch_object($result)) {
		
		$new_expiration_email = $row->expiration_emails;

	}

}
?>
<?php include("../_includes/doctype.inc.php"); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$software_title?> :: <?=$page_title?></title>
<?php include("../_includes/head-tags.inc.php"); ?>
</head>
<body>
<?php include("../_includes/header.inc.php"); ?>
<form name="email_settings_form" method="post" action="<?=$PHP_SELF?>">
<strong>Receive email notifications for upcoming Domain & SSL Certificate expirations?</strong> <input type="checkbox" name="new_expiration_email" value="1"<?php if ($new_expiration_email == "1") echo " checked"; ?>>
<BR><BR><BR>
<input type="submit" name="button" value="Update Email Settings&raquo;">
</form>
<?php include("../_includes/footer.inc.php"); ?>
</body>
</html>