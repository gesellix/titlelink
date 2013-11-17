<?php
// This is global bootstrap for autoloading 

if (!defined('JOOMLA_BASE_DIR')) {
    define('JOOMLA_BASE_DIR', dirname(dirname(__FILE__) . '../../joomla-cms'));
}

if (!defined('JOOMLA_BASE_DIR')) {
    define('TITLELINK_BASE_DIR', dirname(__FILE__));
}

require_once JOOMLA_BASE_DIR . '/tests/unit/bootstrap.php';
