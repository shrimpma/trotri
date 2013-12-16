<?php
/**
 * Trotri
 *
 * @author    Huan Song <trotri@yeah.net>
 * @link      http://github.com/trotri/trotri for the canonical source repository
 * @copyright Copyright &copy; 2011-2013 http://www.trotri.com/ All rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

$urls = array(
	'navbar' => array(
		0 => array(
			0 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_INDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'index'
			),
			1 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_INDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'index',
			),
			2 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_CREATE_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'create'
			),
			3 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_TRASHINDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'trashindex'
			)
		),
		1 => array(
			0 => array(
				'label' => 'CFG_SYSTEM_URLS_ABOUT_LABEL',
				'm' => 'test', 'c' => 'test', 'a' => 'index'
			)
		),
	),
	'sidebar' => array(
		'generator_index' => array(
			0 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_INDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'index',
				'icon' => array(
					'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_CREATE_LABEL',
					'm' => 'generator', 'c' => 'index', 'a' => 'create'
				)
			),
			1 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_TRASHINDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'trashindex'
			),
			2 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_TYPES_INDEX_LABEL',
				'm' => 'generator', 'c' => 'types', 'a' => 'index'
			)
		),
		'generator' => array(
			0 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_INDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'index',
				'icon' => array(
					'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_CREATE_LABEL',
					'm' => 'generator', 'c' => 'index', 'a' => 'create'
				)
			),
			1 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_INDEX_TRASHINDEX_LABEL',
				'm' => 'generator', 'c' => 'index', 'a' => 'trashindex'
			),
			2 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_FIELDS_INDEX_LABEL',
				'm' => 'generator', 'c' => 'fields', 'a' => 'index',
			),
			3 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_GROUPS_INDEX_LABEL',
				'm' => 'generator', 'c' => 'groups', 'a' => 'index',
			),
			4 => array(
				'label' => 'CFG_SYSTEM_URLS_GENERATOR_TYPES_INDEX_LABEL',
				'm' => 'generator', 'c' => 'types', 'a' => 'index',
			),
		),
	)
);

$generatorId = isset($_GET['generator_id']) ? (int) $_GET['generator_id'] : 0;
if ($generatorId > 0) {
	$urls['sidebar']['generator'][2]['params']['generator_id'] = $generatorId;
	$urls['sidebar']['generator'][3]['params']['generator_id'] = $generatorId;
	$urls['sidebar']['generator'][4]['params']['generator_id'] = $generatorId;
}

return $urls;
