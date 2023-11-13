<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=tools
[END_COT_EXT]
==================== */

/**
* Oneline Plugin / Admin Tools
*
* @package oneline
* @author Dmitri Beliavski
* @copyright (c) 2017-2023 seditio.by
*/

defined('COT_CODE') or die('Wrong URL.');

require_once cot_incfile('oneline', 'plug');
require_once cot_incfile('oneline', 'plug', 'settings.' . $cfg['plugin']['oneline']['code']);
require_once cot_langfile('oneline', 'plug');

require_once cot_incfile('forms');

$db_oneline = Cot::$db->oneline;

$t = new XTemplate(cot_tplfile('oneline.tools', 'plug', true));

$adminTitle = $L['oneline_title'];
$adminhelp = $L['oneline_help'];

if ($a == 'open') {

	$id = cot_import('id', 'G', 'INT');
	$editor_class = ($cfg['plugin']['html'] == 'none') ? 'form-control' : 'minieditor';

	if ($b == 'update') {
		$db_ins = [];
		$db_ins['oneline_date'] = (int)cot_import_date('oneline_date', true, false, 'P');
		$db_ins['oneline_text'] = cot_import('oneline_text', 'P', 'TXT');
		$db_ins['oneline_section'] = cot_import('oneline_section', 'P', 'ALP');

		if (!empty(Cot::$extrafields[Cot::$db->oneline])) {
      foreach (Cot::$extrafields[Cot::$db->oneline] as $exfld) {
        $db_ins['oneline_' . $exfld['field_name']] = cot_import_extrafields('oneline' . $exfld['field_name'], $exfld, 'P');
      }
    }

		$db->update($db_oneline, $db_ins, "oneline_id = $id");
		cot_redirect(cot_url('admin', 'm=other&p=oneline&a=open&id=' . $id, '', true));
	}

	$row = $db->query("SELECT * FROM $db_oneline WHERE oneline_id = ? LIMIT 1", [$id])->fetch();

	$t->assign([
		'ONELINE_URL_OPEN' => cot_url('admin', 'm=other&p=oneline&a=open&id=' . $id . '&b=update'),
		'ONELINE_DATE' => cot_selectbox_date((int)$row['oneline_date'], 'long', 'oneline_date', 2030, 2016, true, 'oneline_input_date'),
		'ONELINE_TEXT' => cot_textarea('oneline_text', $row['oneline_text'], 4, 56, ['class' => 'form-control']),
		'ONELINE_SECTION' => cot_selectbox($row['oneline_section'], 'oneline_section', $oneline_cats, $oneline_cats_titles, true, ['class' => 'form-control w-auto']),
	]);

	if (!empty(Cot::$extrafields[Cot::$db->oneline])) {
	  foreach (Cot::$extrafields[Cot::$db->oneline] as $exfld) {
	    $uname = strtoupper($exfld['field_name']);
	    $exfld_input = cot_build_extrafields('oneline' . $exfld['field_name'], $exfld, $row['oneline_' . $exfld['field_name']]);
	    $exfld_value = $row['oneline_' . $exfld['field_name']];
	    $exfld_title = cot_extrafield_title($exfld, 'oneline_');
	    $t->assign([
	      'ONELINE_EXTRAFIELD' => $exfld_input,
	      'ONELINE_EXTRAFIELD_VALUE' => $exfld_value,
	      'ONELINE_EXTRAFIELD_TITLE' => $exfld_title
	    ]);
	    $t->parse('MAIN.ONELINE_SINGLE.EXTRAFIELDS');
	  }
	}

	$t->parse('MAIN.ONELINE_SINGLE');

} else {

	$mrp = (int)$cfg['plugin']['oneline']['pagination'];

	if ($mrp > 0) {
		list($pg, $d, $durl) = cot_import_pagenav('d', $mrp);
		$sql_limit = "LIMIT $d, $mrp";
	} else {
		$sql_limit = "";
		$d = 0;
	}

	if ($b == 'delete') {

		cot_check_xg();
		$db->delete($db_oneline, "oneline_id = $id");
		cot_redirect(cot_url('admin', 'm=other&p=oneline', '', true));

	} elseif ($b == 'update_all') {

		$oneline_date = cot_import('oneline_date', 'P', 'ARR');
		$oneline_text = cot_import('oneline_text', 'P', 'ARR');
		$oneline_section = cot_import('oneline_section', 'P', 'ARR');

		foreach ($oneline_text as $key => $val) {
			$db_ins = [];
			$db_ins['oneline_date'] = (int)cot_import_date($oneline_date[$key], true, false, 'D');
			$db_ins['oneline_text'] = cot_import($oneline_text[$key], 'D', 'TXT');
			$db_ins['oneline_section'] = cot_import($oneline_section[$key], 'D', 'TXT');
			$db->update($db_oneline, $db_ins, "oneline_id = $key");
		}

		$flt = cot_import('oneline_filter', 'P', 'TXT');
		($flt) ? $_SESSION['filter'] = $flt : $_SESSION['filter'] = '';

		cot_redirect(cot_url('admin', 'm=other&p=oneline', '', true));

	} elseif ($b == 'add') {

		$db_ins['oneline_date'] = (int)cot_import_date('oneline_date', true, false, 'P');
		$db_ins['oneline_text'] = cot_import('oneline_text', 'P', 'TXT');
		$db_ins['oneline_section'] = cot_import('oneline_section', 'P', 'TXT');

		if(!empty($db_ins['oneline_text'])) {
			$db->insert($db_oneline, $db_ins);
			$_SESSION['filter'] = '';
		}
		else {
			cot_error('oneline_msg_empty');
		}
		cot_redirect(cot_url('admin', 'm=other&p=oneline', '', true));

	}

	($_SESSION['filter']) ? $where = 'WHERE oneline_section = "'.$_SESSION['filter'].'"' : $where = '';

	$ttl = $db->query("SELECT COUNT(*) FROM $db_oneline $where")->fetchColumn();
	$sql_order = ($ttl > 0) ? 'ORDER BY oneline_id DESC' : '';

	$sql = $db->query("SELECT * FROM $db_oneline $where $sql_order $sql_limit");
	$ii = 0;

	foreach ($sql->fetchAll() as $row) {
		$ii++;
		$t->assign([

			'ONELINE_FILTER_SELECT' => cot_selectbox($_SESSION['filter'], 'oneline_filter', $oneline_cats, $oneline_cats_titles, true),
			'ONELINE_FILTER_VALUE' => $_SESSION['filter'],

			'ONELINE_DATE' => cot_selectbox_date((int)$row['oneline_date'], 'long', 'oneline_date['.$row['oneline_id'].']', 2030, 2016, true, 'oneline_input_date'),

			'ONELINE_TEXT' => cot_inputbox('text', 'oneline_text['.$row['oneline_id'].']', $row['oneline_text'], 'class="form-control"'),
			'ONELINE_TEXT_RAW' => $row['oneline_text'],

			'ONELINE_SECTION' => cot_selectbox($row['oneline_section'], 'oneline_section['.$row['oneline_id'].']', $oneline_cats, $oneline_cats_titles, true),
			'ONELINE_SECTION_RAW' => $row['oneline_section'],

			'ONELINE_URL_DELETE' => cot_url('admin', 'm=other&p=oneline&b=delete&id=' . $row['oneline_id'] . '&'.cot_xg()),
			'ONELINE_URL_OPEN' => cot_url('admin', 'm=other&p=oneline&a=open&id=' . $row['oneline_id']),

			'ONELINE_ID' => $row['oneline_id'],

			'ONELINE_NUM' => $d + $ii,
			'ONELINE_ODDEVEN' => cot_build_oddeven($ii)
		]);
		$t->parse('MAIN.ONELINE_LIST.ONELINE_ROW');
	}

	if ($ii == 0) {
		$t->parse('MAIN.ONELINE_LIST.ONELINE_NOROW');
	}

	$t->assign([
		'ONELINE_ADDURL' => cot_url('admin', 'm=other&p=oneline&b=add'),
		'ONELINE_ADDDATE' => cot_selectbox_date($sys['now'], 'long', 'oneline_date', 2030, 2016, true, ''),
		'ONELINE_ADDTEXT' => cot_inputbox('text', 'oneline_text', '', 'class="form-control"'),
		'ONELINE_ADDSECTION' => cot_selectbox('', 'oneline_section', $oneline_cats, $oneline_cats_titles, true)
	]);

	$t->assign('ONELINE_URL_UPDATE', cot_url('admin', 'm=other&p=oneline&b=update_all'));

	$pagenav = cot_pagenav('admin', 'm=other&p=oneline', $d, $ttl, $mrp);
	$t->assign([
		'ONELINE_PREV'			=> $pagenav['prev'],
		'ONELINE_PAGINATION'	=> $pagenav['main'],
		'ONELINE_NEXT'			=> $pagenav['next'],
		'ONELINE_TOTAL'			=> $pagenav['entries'],
		'ONELINE_ONPAGE'		=> $pagenav['onpage']
	]);

	$t->parse('MAIN.ONELINE_LIST');

}

cot_display_messages($t);

$t->parse('MAIN');

if (COT_AJAX) {
	$t->out('MAIN');
} else {
	$adminmain = $t->text('MAIN');
}
