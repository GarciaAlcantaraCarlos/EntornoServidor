<?php

session_start();

session_destroy();

// Clear cookies

header('location: ../../index.php');