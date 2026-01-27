<?php 
    // -- Start Session if not already started
    if ((function_exists('session_status') && session_status() == PHP_SESSION_NONE) || session_id() == '')
        session_start();
?>