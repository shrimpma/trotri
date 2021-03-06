<?php
/**
 * Trotri Ui
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace ui\bootstrap;

use tfc\ap\Ap;
use tfc\mvc\Mvc;
use tfc\saf\Cfg;
use tfc\util\Language;
use tfc\util\String;

/**
 * Components class file
 * 页面小组件类，基于Bootstrap-v3前端开发框架
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: Components.php 1 2013-05-18 14:58:59Z huan.song $
 * @package ui.bootstrap
 * @since 1.0
 */
class Components
{
	/**
	 * @var string 表单提交后跳转方式：保存并跳转到编辑页
	 */
	const SUBMIT_TYPE_SAVE       = 'save';

	/**
	 * @var string 表单提交后跳转方式：保存并跳转到列表页
	 */
	const SUBMIT_TYPE_SAVE_CLOSE = 'save_close';

	/**
	 * @var string 表单提交后跳转方式：保存并跳转到新增页
	 */
	const SUBMIT_TYPE_SAVE_NEW   = 'save_new';

	/**
	 * @var string 表单提交后默认的跳转方式
	 */
	const SUBMIT_TYPE_DEFAULT    = self::SUBMIT_TYPE_SAVE;

	/**
	 * @var string 表单提交后所有的跳转方式
	 */
	public static $submitTypes = array(
		self::SUBMIT_TYPE_SAVE,
		self::SUBMIT_TYPE_SAVE_CLOSE,
		self::SUBMIT_TYPE_SAVE_NEW
	);

	/**
	 * @var string JS函数：链接
	 */
	const JSFUNC_HREF = 'Trotri.href';

	/**
	 * @var string JS函数：删除对话框
	 */
	const JSFUNC_DIALOGREMOVE = 'Core.dialogRemove';

	/**
	 * @var string JS函数：放入回收站对话框
	 */
	const JSFUNC_DIALOGTRASH = 'Core.dialogTrash';

	/**
	 * @var string JS函数：批量删除对话框
	 */
	const JSFUNC_DIALOGBATCHREMOVE = 'Core.dialogBatchRemove';

	/**
	 * @var string JS函数：批量放入回收站对话框
	 */
	const JSFUNC_DIALOGBATCHTRASH = 'Core.dialogBatchTrash';

	/**
	 * @var string Glyphicons图标：列表按钮
	 */
	const GLYPHICON_LIST = 'list';

	/**
	 * @var string Glyphicons图标：加号按钮
	 */
	const GLYPHICON_PLUS_SIGN = 'plus-sign';

	/**
	 * @var string Glyphicons图标：保存按钮
	 */
	const GLYPHICON_SAVE = 'save';

	/**
	 * @var string Glyphicons图标：编辑铅笔按钮
	 */
	const GLYPHICON_PENCIL = 'pencil';

	/**
	 * @var string Glyphicons图标：回收站按钮
	 */
	const GLYPHICON_TRASH = 'trash';

	/**
	 * @var string Glyphicons图标：还原
	 */
	const GLYPHICON_OK_SIGN = 'ok-sign';

	/**
	 * @var string Glyphicons图标：彻底删除
	 */
	const GLYPHICON_REMOVE_SIGN = 'remove-sign';

	/**
	 * @var string Glyphicons图标：工具
	 */
	const GLYPHICON_WRENCH = 'wrench';

	/**
	 * @var instance of tfc\mvc\Html
	 */
	protected static $_html = null;

	/**
	 * @var instance of tfc\util\Language
	 */
	protected static $_language = null;

	/**
	 * 获取表单的“保存”按钮信息
	 * @return array
	 */
	public static function getButtonSave()
	{
		$return = self::getHttpReturn();
		$return = String::urlencode($return);
		$output = array(
			'type'      => 'button',
			'label'     => self::_('UI_BOOTSTRAP_SAVE'),
			'glyphicon' => self::GLYPHICON_SAVE,
			'class'     => 'btn btn-primary',
			'onclick'   => 'return Core.formSubmit(this, \'' . self::SUBMIT_TYPE_SAVE . '\', \'' . $return . '\');'
		);

		return $output;
	}

	/**
	 * 获取表单的“保存并关闭”按钮信息
	 * @return array
	 */
	public static function getButtonSaveClose()
	{
		$return = self::getHttpReturn();
		$return = String::urlencode($return);
		$output = array(
			'type'      => 'button',
			'label'     => self::_('UI_BOOTSTRAP_SAVE_CLOSE'),
			'glyphicon' => self::GLYPHICON_OK_SIGN,
			'class'     => 'btn btn-default',
			'onclick'   => 'return Core.formSubmit(this, \'' . self::SUBMIT_TYPE_SAVE_CLOSE . '\', \'' . $return . '\');'
		);

		return $output;
	}

	/**
	 * 获取表单的“保存并新建”按钮信息
	 * @return array
	 */
	public static function getButtonSaveNew()
	{
		$output = array(
			'type'      => 'button',
			'label'     => self::_('UI_BOOTSTRAP_SAVE_NEW'),
			'glyphicon' => self::GLYPHICON_PLUS_SIGN,
			'class'     => 'btn btn-default',
			'onclick'   => 'return Core.formSubmit(this, \'' . self::SUBMIT_TYPE_SAVE_NEW . '\', \'\');'
		);

		return $output;
	}

	/**
	 * 获取表单的“取消”按钮信息
	 * @param string $url
	 * @return array
	 */
	public static function getButtonCancel($url)
	{
		if (($return = self::getHttpReturn()) !== '') {
			$url = $return;
		}

		$output = array(
			'type'      => 'button',
			'label'     => self::_('UI_BOOTSTRAP_CANCEL'),
			'glyphicon' => self::GLYPHICON_REMOVE_SIGN,
			'class'     => 'btn btn-danger',
			'onclick'   => 'return Trotri.href(\'' . $url . '\');'
		);

		return $output;
	}

	/**
	 * 获取美化版“是|否”选择项表单元素
	 * @param integer $id
	 * @param string $name
	 * @param string $value
	 * @param string $url
	 * @return string
	 */
	public static function getSwitch($id, $name, $value = 'n', $url = '')
	{
		$attributes = array(
			'id'             => 'label_switch_' . $name . '_' . $id,
			'name'           => 'label_switch',
			'class'          => 'make-switch switch-small',
			'data-on-label'  => self::_('UI_BOOTSTRAP_YES'),
			'data-off-label' => self::_('UI_BOOTSTRAP_NO'),
		);

		if ($url !== '') {
			$url = self::applyHttpReturn($url);
			$attributes['href'] = $url;
		}

		$html = self::getHtml();
		return $html->tag('div', $attributes, $html->checkbox($name, $value, ($value === 'y')));
	}

	/**
	 * 获取Glyphicons图标按钮和工具提示
	 * @param string $type
	 * @param string $url
	 * @param string $func
	 * @param string $title
	 * @param string $placement
	 * @return string
	 */
	public static function getGlyphicon($type, $url, $func, $title, $placement = 'left')
	{
		$url = self::applyHttpReturn($url);
		$click = $func . '(\'' . $url . '\')';
		$attributes = array(
			'class'               => 'glyphicon glyphicon-' . $type,
			'data-toggle'         => 'tooltip',
			'data-placement'      => $placement,
			'data-original-title' => $title,
			'onclick'             => 'return ' . $click . ';'
		);

		return self::getHtml()->tag('span', $attributes, '');
	}

	/**
	 * 在URL后拼接http_return参数
	 * @param string $url
	 * @return string
	 */
	public static function applyHttpReturn($url)
	{
		if (($return = self::getHttpReturn()) !== '') {
			$params = array('http_return' => $return);
			$url = Mvc::getView()->getUrlManager()->applyParams($url, $params);
		}

		return $url;
	}

	/**
	 * 获取返回列表页面链接
	 * @return string
	 */
	public static function getHttpReturn()
	{
		return Ap::getRequest()->getParam('http_return', '');
	}

	/**
	 * 获取页面辅助类
	 * @return tfc\mvc\Html
	 */
	public static function getHtml()
	{
		if (self::$_html === null) {
			self::$_html = Mvc::getView()->getHtml();
		}

		return self::$_html;
	}

	/**
	 * 通过键名获取语言内容
	 * @param string $string
	 * @param boolean $jsSafe
	 * @param boolean $interpretBackSlashes
	 * @return string
	 */
	public static function _($string, $jsSafe = false, $interpretBackSlashes = true)
	{
		return self::getLanguage()->_($string, $jsSafe, $interpretBackSlashes);
	}

	/**
	 * 获取语言国际化管理类
	 * @return tfc\util\Language
	 */
	public static function getLanguage()
	{
		if (self::$_language === null) {
			$type = Cfg::getApp('language');
			$baseDir = DIR_LIBRARIES . DS . 'ui' . DS . 'bootstrap' . DS . 'languages';
			self::$_language = Language::getInstance($type, $baseDir);
		}

		return self::$_language;
	}
}
