<?php
/**
 * Trotri
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace library;

/**
 * UcenterFactory class file
 * Ucenter模块对象工厂类
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: UcenterFactory.php 1 2013-04-05 01:08:06Z huan.song $
 * @package library
 * @since 1.0
 */
class UcenterFactory
{
	/**
	 * @var string 当前模块名
	 */
	const MODULE_NAME = 'ucenter';

	/**
	 * 获取数据库操作层类
	 * @param string $className
	 * @return koala\Db
	 */
	public static function getDb($className)
	{
		return Factory::getDb($className, self::MODULE_NAME);
	}

	/**
	 * 获取字段信息配置类
	 * @param string $className
	 * @return ui\ElementCollections
	 */
	public static function getElements($className)
	{
		return Factory::getElements($className, self::MODULE_NAME);
	}

	/**
	 * 获取业务处理层类
	 * @param string $className
	 * @return koala\Model
	 */
	public static function getModel($className)
	{
		return Factory::getModel($className, self::MODULE_NAME);
	}

	/**
	 * 获取页面小组件类
	 * @param string $className
	 * @return ui object
	 */
	public static function getUi($className)
	{
		return Factory::getUi($className, self::MODULE_NAME);
	}
}
