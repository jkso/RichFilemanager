<?php
/**
 *	Filemanager PHP connector
 *  Initial class, put your customizations here
 *
 *	@license	MIT License
 *	@author		Riaan Los <mail (at) riaanlos (dot) nl>
 *  @author		Simon Georget <simon (at) linea21 (dot) com>
 *  @author		Pavel Solomienko <https://github.com/servocoder/>
 *	@copyright	Authors
 */

// only for debug
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// ini_set('display_errors', '1');

require_once('application/Fm.php');
require_once('application/FmHelper.php');


// This function is called for every server connection. It must return true.
//
// Implement this function to authenticate the user, for example to check a 
// password login, or restrict client IP address.
// 
// This function only authorizes the user to connect and/or load the initial page. 
// Authorization for individual files or dirs is provided by the two functions below.
// 
// NOTE: If this function returns false, the user will simply see an error. It 
// probably makes more sense to redirect the user to a login page instead.
//
// NOTE: If using session variables, the session must be started first (session_start()).
function fm_authenticate()
{
    // Customize this code as desired.
    return true;
}


// This function is called before any filesystem read operation, where 
// $filepath is the file or directory being read. It must return true,
// otherwise the read operation will be denied.
//
// Implement this function to do custom individual-file permission checks, such as
// user/group authorization from a database, or session variables, or any other custom logic.
//
// Note that this is not the only permissions check that must pass. The read operation
// must also pass
//   * Filesystem permissions (if any), e.g. POSIX `rwx` permissions on Linux
//   * The filepath must be allowed according to config['patterns'] and config['extensions']
//
function fm_has_write_permission($filepath) {
    // Customize this code as desired.
    return true;
}


// This function is called before any filesystem write operation, where 
// $filepath is the file or directory being written to. It must return true,
// otherwise the write operation will be denied.
//
// Implement this function to do custom individual-file permission checks, such as
// user/group authorization from a database, or session variables, or any other custom logic.
//
// Note that this is not the only permissions check that must pass. The write operation
// must also pass
//   * Filesystem permissions (if any), e.g. POSIX `rwx` permissions on Linux
//   * The filepath must be allowed according to config['patterns'] and config['extensions']
//   * config['read_only'] must be set to false, otherwise all writes are disabled
//
function fm_has_read_permission($filepath) {
    // Customize this code as desired.
    return true;
}


$config = array();

// example to override the default config
//$config = array(
//    'upload' => array(
//        'policy' => 'DISALLOW_ALL',
//        'restrictions' => array(
//            'pdf',
//        ),
//    ),
//);

$fm = Fm::app()->getInstance($config);

// example to setup files root folder
//$fm->setFileRoot('userfiles', true);

// example to set list of allowed actions
//$fm->setAllowedActions(["select", "move"]);

$fm->handleRequest();