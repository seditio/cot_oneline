<?php
/**
* Oneline Plugin / Functions
*
* @package oneline
* @author Dmitri Beliavski
* @copyright (c) 2017-2023 seditio.by
*/

defined('COT_CODE') or die('Wrong URL');

// define globals
define('SEDBY_ONELINE_REALM', '[SEDBY] Oneline');

require_once cot_incfile('cotlib', 'plug');

/**
 * Converts code into L or R resource string
 */
function sedby_oneline_conv($code, $prefix, $type) {
	global $L, $R;
	$prefix = !$prefix ? 'theme' : $prefix;
	$out = (!$type OR $type == 'L') ? $L[$prefix . '-' . $code] : $R[$prefix . '-' . $code];
	return $out;
}

/**
 * Counts records by section and/or SQL-condition
 */
function sedby_oneline_count($section, $extra) {
	Cot::$db->registerTable('oneline');
	$db_oneline = Cot::$db->oneline;
	if (!empty($section) && !empty($extra)) {
		$sql_cond = "WHERE oneline_section = " . $section . " AND " .$extra;
	} elseif (!empty($section) && empty($extra)) {
		$sql_cond = "WHERE oneline_section = '" . $section . "'";
	} elseif (empty($section) && !empty($extra)) {
		$sql_cond = "WHERE " . $extra;
	} else {
		$sql_cond = "";
	}
	return Cot::$db->query("SELECT COUNT(*) FROM $db_oneline $sql_cond")->fetchColumn();
}

/**
 * Checks if field value starts with substring
 */
function sedby_oneline_starts_with($str, $char) {
	$length = strlen($char);
	return substr($str, 0, $length ) === $char;
}

/**
 * Generates Oneline widget
 *
 * @param  string  $tpl					01. Template code
 * @param  integer $items				02. Number of items to show. 0 - all items
 * @param  string  $order				03. Sorting order (SQL)
 * @param  string  $extra				04. Custom selection filter (SQL)
 * @param  string  $section			05. Category selection mode (single, array, white, black)
 * @param  int     $offset			06. Exclude specified number of records starting from the beginning
 * @param  string  $pagination	07. Pagination parameter name for the URL, e.g. 'pld'. Make sure it does not conflict with other paginations
 * @param  string  $ajax_block	08. DOM block ID for ajax pagination
 * @param  string  $cache_name	09. Cache name
 * @param  string  $cache_ttl		10. Cache TTL
 * @return string								Parsed HTML
 */
function sedby_oneline($tpl = 'oneline.list', $items = 0, $order = '', $extra = '', $section = '', $offset = 0, $pagination = '', $ajax_block = '', $cache_name = '', $cache_ttl = '') {

	$enableAjax = $enableCache = $enablePagination = false;

  // Condition shortcut
  if (Cot::$cache && !empty($cache_name) && ((int)$cache_ttl > 0)) {
    $enableCache = true;
    $cache_name = str_replace(' ', '_', $cache_name);
  }

	if ($enableCache && Cot::$cache->db->exists($cache_name, SEDBY_ONELINE_REALM)) {
		$output = Cot::$cache->db->get($cache_name, SEDBY_ONELINE_REALM);
	} else {

		/* === Hook === */
		foreach (cot_getextplugins('oneline.first') as $pl)
		{
			include $pl;
		}
		/* ===== */

		// Condition shortcuts
    if ((Cot::$cfg['turnajax']) && (Cot::$cfg['plugin']['oneline']['ajax']) && !empty($ajax_block)) {
			$enableAjax = true;
		}

    if (!empty($pagination) && ((int)$items > 0)) {
			$enablePagination = true;
		}

		// DB tables shortcuts
		Cot::$db->registerTable('oneline');
		$db_oneline = Cot::$db->oneline;

		// Display the items
		(!isset($tpl) || empty($tpl)) && $tpl = 'oneline';
		$t = new XTemplate(cot_tplfile($tpl, 'plug'));

		// Get pagination if necessary
    if ($enablePagination) {
      list($pg, $d, $durl) = cot_import_pagenav($pagination, $items);
    } else {
      $d = 0;
    }

		// Compile items number
    ((int)$offset <= 0) && $offset = 0;
    $d = $d + (int)$offset;
    $sql_limit = ($items > 0) ? "LIMIT $d, $items" : "";

		// Compile order
		$sql_order = empty($order) ? " ORDER BY oneline_id DESC" : " ORDER BY $order";

		// Compile section
		$sql_section = empty($section) ? "" : "oneline_section = '" . $section . "'";

		// Compile extra SQL condition
		$sql_extra = empty($extra) ? "" : "$extra";

		$sql_cond = sedby_build_where(array($sql_section, $sql_extra));

		/* === Hook === */
		foreach (cot_getextplugins('oneline.query') as $pl)
		{
			include $pl;
		}
		/* ===== */

		$query = "SELECT * FROM $db_oneline $sql_cond $sql_order $sql_limit";
		$res = Cot::$db->query($query);
		$jj = 1;

		/* === Hook - Part 1 === */
		$extp = cot_getextplugins('oneline.loop');
		/* ===== */

		while ($row = $res->fetch()) {
			$t->assign(array(
				'PAGE_ROW_ID'				=> $row['oneline_id'],
				'PAGE_ROW_INDEX'		=> $row['oneline_index'],
				'PAGE_ROW_DATE'			=> $row['oneline_date'],
				'PAGE_ROW_PRICE1'		=> $row['oneline_price1'],
				'PAGE_ROW_PRICE1A'	=> $row['oneline_price1a'],
				'PAGE_ROW_PRICE2'		=> $row['oneline_price2'],
				'PAGE_ROW_PRICE2A'	=> $row['oneline_price2a'],
				'PAGE_ROW_TEXT'			=> $row['oneline_text'],
				'PAGE_ROW_EXTRA1'		=> $row['oneline_extra1'],
				'PAGE_ROW_EXTRA2'		=> $row['oneline_extra2'],
				'PAGE_ROW_LINK'			=> $row['oneline_link'],
				'PAGE_ROW_SECTION'	=> $row['oneline_text'],

				'PAGE_ROW_NUM'			=> $jj,
				'PAGE_ROW_ODDEVEN'	=> cot_build_oddeven($jj)
			));

			/* === Hook - Part 2 === */
			foreach ($extp as $pl) {
				include $pl;
			}
			/* ===== */

			$t->parse("MAIN.PAGE_ROW");
			$jj++;
		}

		($jj == 1) && $t->parse("MAIN.NO_ROW");

		// Render pagination
		if ($enablePagination) {
			$totalitems = Cot::$db->query("SELECT COUNT(*) FROM $db_oneline $sql_cond")->fetchColumn();

			$url_area = sedby_geturlarea();
			$url_params = sedby_geturlparams();
			$url_params[$pagination] = $durl;

			if ($enableAjax) {
				$ajax_mode = true;
				$ajax_plug = 'plug';
				if (Cot::$cfg['plugin']['oneline']['encrypt_ajax_urls']) {
					$h = $tpl . ',' . $items . ',' . $order . ',' . $extra . ',' . $section . ',' . $offset . ',' . $pagination . ',' . $ajax_block . ',' . $cache_name . ',' . $cache_ttl;
					$h = sedby_encrypt_decrypt('encrypt', $h, Cot::$cfg['plugin']['oneline']['encrypt_key'], Cot::$cfg['plugin']['oneline']['encrypt_iv']);
					$h = str_replace('=', '', $h);
					$ajax_plug_params = "r=oneline&h=$h";
				} else {
					$ajax_plug_params = "r=oneline&tpl=$tpl&items=$items&order=$order&extra=$extra&section=$section&offset=$offset&pagination=$pagination&ajax_block=$ajax_block&cache_name=$cache_name&cache_ttl=$cache_ttl";
				}
			} else {
				$ajax_mode = false;
				$ajax_plug = $ajax_plug_params = '';
			}

			$pagenav = cot_pagenav($url_area, $url_params, $d, $totalitems, $items, $pagination, '', $ajax_mode, $ajax_block, $ajax_plug, $ajax_plug_params);

			// Assign pagination tags
			$t->assign(array(
				'PAGE_TOP_PAGINATION'  => $pagenav['main'],
				'PAGE_TOP_PAGEPREV'    => $pagenav['prev'],
				'PAGE_TOP_PAGENEXT'    => $pagenav['next'],
				'PAGE_TOP_FIRST'       => $pagenav['first'],
				'PAGE_TOP_LAST'        => $pagenav['last'],
				'PAGE_TOP_CURRENTPAGE' => $pagenav['current'],
				'PAGE_TOP_TOTALLINES'  => $totalitems,
				'PAGE_TOP_MAXPERPAGE'  => $items,
				'PAGE_TOP_TOTALPAGES'  => $pagenav['total']
			));
		};

		// Assign service tags
    if ((!$enableCache) && (Cot::$usr['maingrp'] == 5)) {
      $t->assign(array(
        'PAGE_TOP_QUERY' => $query,
        'PAGE_TOP_RES' => $res,
      ));
    }

		/* === Hook === */
		foreach (cot_getextplugins('oneline.tags') as $pl)
		{
			include $pl;
		}
		/* ===== */

		$t->parse();
		$output = $t->text();

		if (($jj > 1) && $enableCache && !$enablePagination) {
			Cot::$cache->db->store($cache_name, $output, SEDBY_ONELINE_REALM, $cache_ttl);
		}
	}
	return $output;
}
