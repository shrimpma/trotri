<?php
$this->widget('koala\widgets\FormBuilder', 
	array(
		'name' => 'create',
		'action' => $this->getUrlManager()->getUrl($this->action),
		'errors' => $this->errors,
		'elementCollections' => $this->helper,
		'elements' => array(
			'group_name',
			'generator_id',
			'sort',
			'description',
			'button_save' => array(
				'type' => 'button',
				'label' => $this->CFG_SYSTEM_GLOBAL_SAVE,
				'glyphicon' => 'save',
				'class' => 'btn btn-primary',
				'onclick' => "return Core.formSubmit('save', 'create');"
			),
			'button_save2close' => array(
				'type' => 'button',
				'label' => $this->CFG_SYSTEM_GLOBAL_SAVE2CLOSE,
				'glyphicon' => 'ok-sign',
				'class' => 'btn btn-default',
				'onclick' => "return Core.formSubmit('save_close', 'create');"
			),
			'button_save2new' => array(
				'type' => 'button',
				'label' => $this->CFG_SYSTEM_GLOBAL_SAVE2NEW,
				'glyphicon' => 'plus-sign',
				'class' => 'btn btn-default',
				'onclick' => "return Core.formSubmit('save_new', 'create');"
			),
			'button_cancel' => array(
				'type' => 'button',
				'label' => $this->CFG_SYSTEM_GLOBAL_CANCEL,
				'glyphicon' => 'remove-sign',
				'class' => 'btn btn-danger',
				'onclick' => 'return Core.href(\'' . $this->getUrlManager()->getUrl('index') . '\');'
			)
		)
	)
);
?>