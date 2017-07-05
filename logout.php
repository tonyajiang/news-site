<?php
            session_start();
            session_destroy();
            header("Location: index.php");
            //end session to log out user
?>