<?php

# CSIS 3280 - 004 Final Project
# Title : Group Project File Management System
# Group Member : (1) William, Lee (2) Gabrielle, Bocardi de Morais

# File : config

// define group member information
define('GROUP_MEMBER_1_NAME', 'William, Lee');
define('GROUP_MEMBER_1_ID', '300341465');
define('GROUP_MEMBER_2_NAME', 'Gabrielle, Bocardi de Morais');
define('GROUP_MEMBER_2_ID', '300351454');

// Define database
define("DB_HOST", "localhost");  
define("DB_USER", "root");  
define("DB_PASS", "");  
define("DB_NAME", "FinalProject_WLe41465_GBo51454");
define("DB_PORT", "3306");  

// define log file
define('LOGFILE','log/error_log.txt');
ini_set("log_errors", TRUE);  
ini_set('error_log', LOGFILE); 

?>