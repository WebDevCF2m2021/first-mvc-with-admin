<?php

$recupUsers = theuserWithRightSelectAll($dbConnect);
// appel de la vue (cRud)
require_once "../view/adminView/usersAdminView.php";
