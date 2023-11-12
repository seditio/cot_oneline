<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=admin.extrafields.first
[END_COT_EXT]
==================== */

/**
* Oneline Plugin / Global
*
* @package oneline
* @author Dmitri Beliavski
* @copyright (c) 2017-2023 seditio.by
*/

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('oneline', 'plug');

$extra_whitelist[$db_oneline] = array(
	'name' => $db_oneline,
	'caption' => $L['Plugin'] . ' Oneline Info',
	'type' => 'plug',
	'code' => 'oneline',
	'tags' => array(
		'oneline.tools.tpl' => '{ONELINE_XXXXX}, {ONELINE_XXXXX_TITLE}',
		'oneline.tpl' => '{ONELINE_FORM_XXXXX}, {ONELINE_FORM_XXXXX_TITLE}',
	)
);
