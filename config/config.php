<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Soule
 * @version    2.0
 * @copyright  2011 - 2012 (c) devxdev.com
 * @license    http://soule.io/license
 * @author     Soule
 * @link       http://soule.io/
 * @since      1.0
 * @filesource
 */
define('DT_PRE',         DB_PRE  . 'draffft_');
define('DT_CONFIG',      DT_BASE . 'config' . DS);
define('DT_CONTROLLERS', DT_BASE . 'controllers' . DS);
define('DT_MODELS', 	 DT_BASE . DS);

Soule\IO\Autoloader::alias(DT_CONFIG);
Soule\IO\Autoloader::directory([DT_BASE, DT_MODELS, DT_CONTROLLERS]);

$fi = new FilesystemIterator(DT_CONTROLLERS, FilesystemIterator::SKIP_DOTS);
foreach ($fi as $file)
{
	if ($file->isFile() && $file->isReadable() && $file->getExtension() == 'php')
	{
		require $file->getPathname();
	}
}
define('DT_CONFIGED', true);
