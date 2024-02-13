<?php

    require("admin/inc/assentials.php");

    session_start();
    session_destroy();

    redirect("index.php");

?>