<?php
/**
* Oneline Plugin / EN Locale
*
* @package oneline
* @author Dmitri Beliavski
* @copyright (c) 2017-2023 seditio.by
*/

defined('COT_CODE') or die('Wrong URL.');

/**
 * Plugin Info
 */

$L['info_name'] = '[SEDBY] One Line Info';
$L['info_desc'] = 'Pricelists or compact one-line news';

/**
 * Plugin Config
 */

$L['cfg_fields'] = 'Manage fields & records in the admin panel:';
$L['cfg_pagination'] = 'Entries per page';
$L['cfg_pagination_hint'] = '0 to disable';

$L['cfg_showopen'] = 'Show OPEN button in the records list';

$L['cfg_display_date'] = 'Use dates';
$L['cfg_display_price1'] = 'Use price No.1';
$L['cfg_display_price1a'] = 'Use price No.1a';
$L['cfg_display_price2'] = 'Use price No.2';
$L['cfg_display_price2a'] = 'Use price No.2a';
$L['cfg_display_text'] = 'Use text';
$L['cfg_display_extra1'] = 'Use extratext No.1';
$L['cfg_display_extra2'] = 'Use extratext No.2';
$L['cfg_display_link'] = 'Use link';

$L['cfg_useajax'] = 'Use AJAX:';
$L['cfg_ajax'] = 'Use AJAX for pagination';
$L['cfg_ajax_hint'] = 'Works only with $ajax_block and $cfg[\'turnajax\']';
$L['cfg_encrypt_ajax_urls'] = 'Encode AJAX pagination URLs';
$L['cfg_encrypt_ajax_urls_hint'] = 'Works only with AJAX pagination, recommended for live projects and with $extra argument used with AJAX';
$L['cfg_encrypt_key'] = 'Secret key';
$L['cfg_encrypt_iv'] = 'Initialization vector';

/**
 * Plugin Tools
 */

$L['oneline_price1'] = 'Price No.1';
$L['oneline_price1a'] = 'Price No.1a';
$L['oneline_price2'] = 'Price No.2';
$L['oneline_price2a'] = 'Price No.2a';
$L['oneline_extra1'] = 'Extratext No.1';
$L['oneline_extra2'] = 'Extratext No.2';
$L['oneline_help'] = 'Plugin support: <a href="http://www.seditio.by/" class="strong">www.seditio.by</a>';
