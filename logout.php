<?php

{
    session_start();
	session_destroy();
	echo "<script> location.href='edu-tech/header.php';</script>";
}