<?php

include_once 'includes/user_session.php';

$userSession = new UserSession();

$userSession->closeSession();

header("Location: login.php");

?>