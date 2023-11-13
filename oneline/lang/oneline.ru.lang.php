<?php
/**
* Oneline Plugin / RU Locale
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
$L['info_desc'] = 'Прайс-листы или короткие новости в одну строку';

/**
 * Plugin Config
 */

$L['cfg_fields'] = 'Управление полями и записями в админке:';
$L['cfg_pagination'] = 'Количество записей на страницу в админке';
$L['cfg_pagination_hint'] = '0 для отключения паджинации';

$L['cfg_showopen'] = 'Показать кнопку ОТКРЫТЬ в списке записей';

$L['cfg_display_date'] = 'Использовать даты';
$L['cfg_display_price1'] = 'Использовать цену No.1';
$L['cfg_display_price1a'] = 'Использовать цену No.1a';
$L['cfg_display_price2'] = 'Использовать цену No.2';
$L['cfg_display_price2a'] = 'Использовать цену No.2a';
$L['cfg_display_text'] = 'Использовать текст';
$L['cfg_display_extra1'] = 'Использовать экстратекст No.1';
$L['cfg_display_extra2'] = 'Использовать экстратекст No.2';
$L['cfg_display_link'] = 'Использовать ссылку';

$L['cfg_useajax'] = 'Использование AJAX:';
$L['cfg_ajax'] = 'Использовать AJAX для паджинации';
$L['cfg_ajax_hint'] = 'Работает только при использовании аргумента $ajax_block и $cfg[\'turnajax\']';
$L['cfg_encrypt_ajax_urls'] = 'Шифровать URLы AJAX-паджинации';
$L['cfg_encrypt_ajax_urls_hint'] = 'Работает только при включенной AJAX-паджинации, рекомендуется для действующих сайтов в т. ч. при использовании аргумента $extra с AJAX';
$L['cfg_encrypt_key'] = 'Ключ шифрования';
$L['cfg_encrypt_iv'] = 'Вектор исполнения';

$L['cfg_code'] = 'Кастомный код для файла настроек';

/**
 * Plugin Tools
 */

$L['oneline_title'] = '[SEDBY] One Line Info';
$L['oneline_help'] = 'Разработка и сопровождение плагина: <a href="https://sed.by/" class="fb-bold">sed.by</a>';

$L['oneline_return'] = 'Назад к списку';

$L['oneline_msg_empty'] = 'Текст записи пустой';
