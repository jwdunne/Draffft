<?php
/**
 * @package 	Draffft
 * @copyright	2011 - 2012 (c) devxdev.com
 * @license		GPL v2
 * @Author		Devon Hazelett <xdev@devxdev.com>
 *
 * $Id: config.php 25 2012-05-17 18:13:30Z Devon $
 * $Revision: 25 $
 */
defined('SF_EXEC') or $core->di->Error->error(['title' => 'INVALID REQUEST', 'message' => 'You cannot access this script directly!'], 2);
define('DTPRE', DB_PRE . 'draffft_');


require_once $application->lib('Draffft', true);

$draffft 	= new SF_Draffft($db);

define('DT_CONFIGED', 1);