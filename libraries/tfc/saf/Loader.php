<?php
/**
 * Trotri Foundation Classes
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright (c) 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace tfc\saf;

/**
 * Loader Define file
 * 定义项目常用目录，自动加载规则
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: Loader.php 1 2013-03-29 16:48:06Z huan.song $
 * @package tfc.saf
 * @since 1.0
 */

/**
 * 为true时表示测试环境，会打印Debug日志，页面上展示调试信息
 */
defined('DEBUG') || define('DEBUG', false);

/**
 * 设置PHP报错级别
 */
error_reporting(DEBUG ? E_ALL : 0);

/**
 * 是否自动将GET、POST、COOKIE中的"'"、'"'、'\'加上反斜线
 */
defined('MAGIC_QUOTES_GPC') || define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

/**
 * 调用此框架前需要先定义常量：项目名称
 */
defined('APP_NAME') || exit('Request Error, No defined APP_NAME');

/**
 * 不同操作系统的目录分割符
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

/**
 * 不同操作系统的路径分割符
 */
defined('PS') || define('PS', PATH_SEPARATOR);

/**
 * tfc\saf目录
 */
defined('DIR_TFC_SAF') || define('DIR_TFC_SAF', dirname(__FILE__));

/**
 * TFC框架目录
 */
defined('DIR_TFC') || define('DIR_TFC', substr(DIR_TFC_SAF, 0, -4));

/**
 * 公共框架和代码库目录
 */
defined('DIR_LIBRARIES') || define('DIR_LIBRARIES', substr(DIR_TFC, 0, -4));

/**
 * ROOT目录
 */
defined('DIR_ROOT') || define('DIR_ROOT', substr(DIR_LIBRARIES, 0, -10));

/**
 * 当前项目目录
 */
defined('DIR_APP') || define('DIR_APP', DIR_ROOT . DS . 'app' . DS . APP_NAME);

/**
 * 当前项目的所有组件存放目录
 */
defined('DIR_APP_COMPONENTS') || define('DIR_APP_COMPONENTS', DIR_APP . DS . 'components');

/**
 * 当前项目的所有语言包存放目录
 */
defined('DIR_APP_LANGUAGES') || define('DIR_APP_LANGUAGES', DIR_APP . DS . 'languages');

/**
 * 当前项目的公共代码库目录
 */
defined('DIR_APP_LIBRARY') || define('DIR_APP_LIBRARY', DIR_APP . DS . 'library');

/**
 * 当前项目的所有模块存放目录
 */
defined('DIR_APP_MODULES') || define('DIR_APP_MODULES', DIR_APP . DS . 'modules');

/**
 * 当前项目的所有插件存放目录
 */
defined('DIR_APP_PLUGINS') || define('DIR_APP_PLUGINS', DIR_APP . DS . 'plugins');

/**
 * 当前项目的所有脚本存放目录
 */
defined('DIR_APP_SCRIPTS') || define('DIR_APP_SCRIPTS', DIR_APP . DS . 'scripts');

/**
 * 当前项目的所有测试代码存放目录
 */
defined('DIR_APP_TESTS') || define('DIR_APP_TESTS', DIR_APP . DS . 'tests');

/**
 * 当前项目的所有模板存放目录
 */
defined('DIR_APP_VIEWS') || define('DIR_APP_VIEWS', DIR_APP . DS . 'views');

/**
 * 当前项目的所有模板部件存放目录
 */
defined('DIR_APP_WIDGETS') || define('DIR_APP_WIDGETS', DIR_APP . DS . 'widgets');

/**
 * 配置文件根目录
 */
defined('DIR_CFG') || define('DIR_CFG', DIR_ROOT . DS . 'cfg');

/**
 * 当前项目的配置文件存放目录
 */
defined('DIR_CFG_APP') || define('DIR_CFG_APP', DIR_CFG . DS . 'app' . DS . APP_NAME);

/**
 * 数据库的配置文件存放目录
 */
defined('DIR_CFG_DB') || define('DIR_CFG_DB', DIR_CFG . DS . 'db');

/**
 * Ral的配置文件存放目录
 */
defined('DIR_CFG_RAL') || define('DIR_CFG_RAL', DIR_CFG . DS . 'ral');

/**
 * 缓存的配置文件存放目录
 */
defined('DIR_CFG_CACHE') || define('DIR_CFG_CACHE', DIR_CFG . DS . 'cache');

/**
 * 数据文件存放根目录
 */
defined('DIR_DATA') || define('DIR_DATA', DIR_ROOT . DS . 'data');

/**
 * 当前项目的数据文件存放目录
 */
defined('DIR_DATA_APP') || define('DIR_DATA_APP', DIR_DATA . DS . 'app' . DS . APP_NAME);

/**
 * 运行时生成的临时文件存放目录
 */
defined('DIR_DATA_RUNTIME') || define('DIR_DATA_RUNTIME', DIR_DATA . DS . 'runtime');

/**
 * 运行时生成的表实体类存放目录
 */
defined('DIR_DATA_RUNTIME_ENTITIES') || define('DIR_DATA_RUNTIME_ENTITIES', DIR_DATA_RUNTIME . DS . 'entities');

/**
 * 日志文件存放根目录
 */
defined('DIR_LOG') || define('DIR_LOG', DIR_ROOT . DS . 'log');

/**
 * 当前项目的日志文件存放目录
 */
defined('DIR_LOG_APP') || define('DIR_LOG_APP', DIR_LOG . DS . APP_NAME);

/**
 * 网站入口目录
 */
defined('DIR_WEBROOT') || define('DIR_WEBROOT', DIR_ROOT . DS . 'webroot');

/**
 * 所有项目公共的静态文件存放目录
 */
defined('DIR_WEBROOT_STATIC') || define('DIR_WEBROOT_STATIC', DIR_WEBROOT . DS . 'static' . DS . APP_NAME);

/**
 * 初始化日志文件存放根目录、当前项目的日志文件存放目录
 */
is_dir(DIR_LOG_APP) || mkdir(DIR_LOG_APP, 0664, true);
is_dir(DIR_LOG_APP) || exit('Request Error, Create Log Dir Failed');

/**
 * 初始化数据文件存放根目录、当前项目的数据文件存放目录
 */
is_dir(DIR_DATA_RUNTIME) || mkdir(DIR_DATA_RUNTIME, 0664, true);
is_dir(DIR_DATA_RUNTIME) || exit('Request Error, Create RunTime Dir Failed');

/**
 * 初始化表实体类存放目录
 */
is_dir(DIR_DATA_RUNTIME_ENTITIES) || mkdir(DIR_DATA_RUNTIME_ENTITIES, 0664, true);
is_dir(DIR_DATA_RUNTIME_ENTITIES) || exit('Request Error, Create RunTime Entities Dir Failed');

/**
 * 设置公共框架和代码库目录、当前项目的公共代码库目录、当前项目的所有模块存放目录到PHP INI自动加载目录
 */
set_include_path('.' . PS . DIR_LIBRARIES . PS . DIR_APP . PS . trim(get_include_path(), '.' . PS)) || exit('Request Error, your server configuration not allowed to change PHP include path');

/**
 * 自动加载PHP文件
 * @param string $className
 * @return void
 */
function spl_autoload($className)
{
    require $className;
}

/**
 * 注册__autoload方法
 */
spl_autoload_register('spl_autoload') || exit('Request Error, unable to register autoload as an autoloading method');

if (!function_exists('debug_dump')) {
    /**
     * 测试打印数据，只有DEBUG或者强制的时候才输出
     * @param mixed $expression
     * @param boolean $coercion
     * @return void
     */
    function debug_dump($expression, $coercion = false)
    {
        if (DEBUG || $coercion) {
            echo '<pre>';
            var_dump($expression);
            echo '</pre>';
            exit;
        }
    }
}
