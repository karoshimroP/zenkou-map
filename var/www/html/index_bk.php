<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/* call Yii */
/*
$yii=dirname(__FILE__).'/yii/framework/YiiBase.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

class Yii extends YiiBase
{
    public static function autoload($className)
    {
        $wp_classes = array(
            'Translation_Entry',
            'Translations', 
            'NOOP_Translations',
            'POMO_Reader',
            'POMO_FileReader',
            'POMO_StringReader',
            'POMO_CachedFileReader',
            'POMO_CachedIntFileReader',
            'MO',
            //'',
        );
        if(!in_array($className, $wp_classes))
            YiiBase::autoload($className);
    }
}
spl_autoload_unregister(array('YiiBase', 'autoload'));
spl_autoload_register(array('Yii','autoload'));

Yii::createWebApplication($config);
*/

/** Loads the WordPress Environment and Template */
require('./wp-blog-header.php');
?>