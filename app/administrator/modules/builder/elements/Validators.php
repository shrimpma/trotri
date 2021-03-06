<?php
/**
 * Trotri
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace modules\builder\elements;

use tfc\saf\Text;
use ui\ElementCollections;
use library\BuilderFactory;

/**
 * Validators class file
 * 字段信息配置类，包括表格、表单、验证规则、选项
 * @author 宋欢 <trotri@yeah.net>
 * @version $Id: Validators.php 1 2014-01-20 15:58:15Z huan.song $
 * @package modules.builder.elements
 * @since 1.0
 */
class Validators extends ElementCollections
{
	/**
	 * @var string option_category：boolean
	 */
	const OPTION_CATEGORY_BOOLEAN = 'boolean';

	/**
	 * @var string option_category：integer
	 */
	const OPTION_CATEGORY_INTEGER = 'integer';

	/**
	 * @var string option_category：string
	 */
	const OPTION_CATEGORY_STRING = 'string';

	/**
	 * @var string option_category：array
	 */
	const OPTION_CATEGORY_ARRAY = 'array';

	/**
	 * @var string when：all
	 */
	const WHEN_ALL = 'all';

	/**
	 * @var string when：create
	 */
	const WHEN_CREATE = 'create';

	/**
	 * @var string when：modify
	 */
	const WHEN_MODIFY = 'modify';

	/**
	 * @var ui\bootstrap\Components 页面小组件类
	 */
	public $uiComponents = null;

	/**
	 * 构造方法：初始化页面小组件类
	 */
	public function __construct()
	{
		$this->uiComponents = BuilderFactory::getUi('Validators');
	}

	/**
	 * (non-PHPdoc)
	 * @see ui.ElementCollections::getViewTabsRender()
	 */
	public function getViewTabsRender()
	{
		$output = array(
		);

		return $output;
	}

	/**
	 * 获取“主键ID”配置
	 * @param integer $type
	 * @return array
	 */
	public function getValidatorId($type)
	{
		$output = array();
		$name = 'validator_id';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_ID_LABEL'),
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$output = array(
				'__tid__' => 'main',
				'type' => 'text',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_ID_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_ID_HINT'),
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
			);
		}

		return $output;
	}

	/**
	 * 获取“验证类名”配置
	 * @param integer $type
	 * @return array
	 */
	public function getValidatorName($type)
	{
		$output = array();
		$options = BuilderFactory::getModel('Validators')->getValidatorOptions(false);

		$name = 'validator_name';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_NAME_LABEL'),
				'callback' => array($this->uiComponents, 'getValidatorNameUrl')
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$output = array(
				'__tid__' => 'main',
				'type' => 'select',
				'options' => $options,
				'value' => BuilderFactory::getModel('Validators')->getValidatorOptions(true),
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_NAME_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_NAME_HINT'),
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
				'InArray' => array(array_keys($options), sprintf(Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_VALIDATOR_NAME_INARRAY'), implode(', ', $options))),
			);
		}

		return $output;
	}

	/**
	 * 获取“表单字段ID”配置
	 * @param integer $type
	 * @return array
	 */
	public function getFieldId($type)
	{
		$output = array();
		$name = 'field_id';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_FIELD_ID_LABEL'),
				'callback' => array($this->uiComponents, 'getFieldNameByFieldId')
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$fieldId = BuilderFactory::getModel('Validators')->getFieldId();
			$output = array(
				'__tid__' => 'main',
				'type' => 'hidden',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_FIELD_ID_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_FIELD_ID_HINT'),
				'value' => $fieldId
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
				'Integer' => array(true, Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_FIELD_ID_INTEGER')),
			);
		}

		return $output;
	}

	/**
	 * 获取“字段名”表单元素和验证规则
	 * @param integer $type
	 * @return array
	 */
	public function getFieldName($type)
	{
		$output = array();
		$name = 'field_name';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELDS_FIELD_NAME_LABEL')
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$fieldId = BuilderFactory::getModel('Validators')->getFieldId();
			$fieldName = BuilderFactory::getModel('Fields')->getFieldNameByFieldId($fieldId);
			$output = array(
				'type' => 'string',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELDS_FIELD_NAME_LABEL'),
				'value' => $fieldName
			);
		}

		return $output;
	}

	/**
	 * 获取“验证时对比值，可以是布尔类型、整型、字符型、数组序列化”配置
	 * @param integer $type
	 * @return array
	 */
	public function getOptions($type)
	{
		$output = array();
		$name = 'options';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTIONS_LABEL'),
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$output = array(
				'__tid__' => 'main',
				'type' => 'text',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTIONS_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTIONS_HINT'),
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
			);
		}

		return $output;
	}

	/**
	 * 获取“验证时对比值类型”配置
	 * @param integer $type
	 * @return array
	 */
	public function getOptionCategory($type)
	{
		$output = array();
		$options = array(
			self::OPTION_CATEGORY_BOOLEAN => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_BOOLEAN_LABEL'),
			self::OPTION_CATEGORY_INTEGER => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_INTEGER_LABEL'),
			self::OPTION_CATEGORY_STRING => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_STRING_LABEL'),
			self::OPTION_CATEGORY_ARRAY => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_ARRAY_LABEL'),
		);

		$name = 'option_category';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_LABEL'),
				'callback' => array($this->uiComponents, 'getOptionCategoryLabel')
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$mod = BuilderFactory::getModel('Validators');
			$htmlLabel = BuilderFactory::getModel('Fields')->getHtmlLabelByFieldId($mod->getFieldId());
			$validator = $mod->getValidatorMessages($htmlLabel, $mod->getValidatorOptions(true));
			$output = array(
				'__tid__' => 'main',
				'type' => 'radio',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_HINT'),
				'options' => $options,
				'value' => $validator['option_category'],
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
				'InArray' => array(array_keys($options), sprintf(Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_OPTION_CATEGORY_INARRAY'), implode(', ', $options))),
			);
		}
		elseif ($type === self::TYPE_OPTIONS) {
			$output = $options;
		}

		return $output;
	}

	/**
	 * 获取“出错提示消息”配置
	 * @param integer $type
	 * @return array
	 */
	public function getMessage($type)
	{
		$output = array();
		$name = 'message';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_MESSAGE_LABEL'),
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$mod = BuilderFactory::getModel('Validators');
			$htmlLabel = BuilderFactory::getModel('Fields')->getHtmlLabelByFieldId($mod->getFieldId());
			$validator = $mod->getValidatorMessages($htmlLabel, $mod->getValidatorOptions(true));
			$output = array(
				'__tid__' => 'main',
				'type' => 'text',
				'value' => $validator['message'],
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_MESSAGE_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_MESSAGE_HINT'),
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
			);
		}

		return $output;
	}

	/**
	 * 获取“排序”配置
	 * @param integer $type
	 * @return array
	 */
	public function getSort($type)
	{
		$output = array();
		$name = 'sort';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_SORT_LABEL'),
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$output = array(
				'__tid__' => 'main',
				'type' => 'text',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_SORT_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_SORT_HINT'),
				'required' => true,
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
				'Numeric' => array(true, Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_SORT_NUMERIC')),
			);
		}

		return $output;
	}

	/**
	 * 获取“验证环境，任意时候验证、只在新增数据时验证、只在编辑数据时验证”配置
	 * @param integer $type
	 * @return array
	 */
	public function getWhen($type)
	{
		$output = array();
		$options = array(
			self::WHEN_ALL => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_ALL_LABEL'),
			self::WHEN_CREATE => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_CREATE_LABEL'),
			self::WHEN_MODIFY => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_MODIFY_LABEL'),
		);

		$name = 'when';

		if ($type === self::TYPE_TABLE) {
			$output = array(
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_LABEL'),
				'callback' => array($this->uiComponents, 'getWhenLabel')
			);
		}
		elseif ($type === self::TYPE_FORM) {
			$output = array(
				'__tid__' => 'main',
				'type' => 'radio',
				'label' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_LABEL'),
				'hint' => Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_HINT'),
				'options' => $options,
				'value' => self::WHEN_ALL,
			);
		}
		elseif ($type === self::TYPE_FILTER) {
			$output = array(
				'InArray' => array(array_keys($options), sprintf(Text::_('MOD_BUILDER_BUILDER_FIELD_VALIDATORS_WHEN_INARRAY'), implode(', ', $options))),
			);
		}
		elseif ($type === self::TYPE_OPTIONS) {
			$output = $options;
		}

		return $output;
	}

}
