<?php
/**
 * Soule Content Management Framework
 *
 * Open Source, Super Simple CMF
 *
 * @package    Draffft
 * @version    1.3
 * @copyright  2011 - 2013 (c) devxdev.com
 * @license    http://soule.io/license
 * @author     Soule
 * @link       http://soule.io/draffft
 * @since      1.0
 */
namespace apps\draffft\models;

use Soule\Database\Modules\Query;

class Pingback extends XMLRPC
{

    private static $table = DT_PINGBACK_TABLE;
    
    /**
     * Required method for pinging $target
     *
     * @param   string      $source Uri of the ping-er
     * @param   string      $target Uri of the ping-ee
     *
     * @return  string
     */
    public static function ping($source, $target)
    {
        
    }
}
