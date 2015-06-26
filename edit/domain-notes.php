<?php
/**
 * /edit/domain-notes.php
 *
 * This file is part of DomainMOD, an open source domain and internet asset manager.
 * Copyright (C) 2010-2015 Greg Chetcuti <greg@chetcuti.com>
 *
 * Project: http://domainmod.org   Author: http://chetcuti.com
 *
 * DomainMOD is free software: you can redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * DomainMOD is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with DomainMOD. If not, see
 * http://www.gnu.org/licenses/.
 *
 */
?>
<?php
include("../_includes/start-session.inc.php");
include("../_includes/init.inc.php");

require_once(DIR_ROOT . "classes/Autoloader.php");
spl_autoload_register('DomainMOD\Autoloader::classAutoloader');

$system = new DomainMOD\System();

include(DIR_INC . "head.inc.php");
include(DIR_INC . "config.inc.php");
include(DIR_INC . "software.inc.php");
include(DIR_INC . "database.inc.php");

$system->authCheck();

$page_title = "Viewing a Domain's Notes";
$software_section = "domains";

$did = $_GET['did'];

$sql = "SELECT domain, notes
		FROM domains
		WHERE id = '$did'";
$result = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_object($result)) {

    $new_domain = $row->domain;
    $new_notes = $row->notes;

}
?>
<?php echo $system->doctype(); ?>
<html>
<head>
<title><?php echo $system->pageTitle($software_title, $page_title); ?></title>
<?php include(DIR_INC . "layout/head-tags-bare.inc.php"); ?>
</head>
<body>
<?php include(DIR_INC . "layout/header-bare.inc.php"); ?>
<strong>Notes For <?php echo $new_domain; ?></strong><BR>
<BR>
<?php
$note = new DomainMOD\Note();
$html_notes = $note->formatHtml($new_notes);
echo $html_notes;
?>
<?php include(DIR_INC . "layout/footer-bare.inc.php"); ?>
</body>
</html>
