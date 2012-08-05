<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Soule
 * @subpackage Soule.Applications.Draffft
 * @version    1.0.0
 * @copyright  2011 - 2012 (c) devxdev.com
 * @license    Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0.html>
 * @author     Soule
 * @link       http://soule.io/
 * @since      1.0.0
 * @filesource
 */
defined('SF_EXEC') or die('This application requires Soule CMF v1.1.0 or greater to run.');
define('DTPRE', DB_PRE . 'draffft_');


require_once DT_BASE . 'Draffft.class.php';

$draffft 	= new Draffft\Draffft($db);

define('DT_CONFIGED', true);