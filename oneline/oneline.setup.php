<?php
/* ====================
[BEGIN_COT_EXT]
Code=oneline
Name=[SEDBY] One Line Info
Description=Short One-Line News and Promotions
Version=2.00b
Date=2023-09-06
Category=
Author=Dmitri Beliavski
Copyright=&copy; Seditio.by 2017-2023
Notes=
Auth_guests=R
Lock_guests=WA12345
Auth_members=R
Lock_members=WA12345
Requires_modules=
Requires_plugins=cotlib
Recommends_modules=
Recommends_plugins=
[END_COT_EXT]
[BEGIN_COT_EXT_CONFIG]
fields=00:separator:::
pagination=01:select:0,5,10,15,20,50:0:News on page (0 viewall)
showopen=02:radio::1:Show open button

useajax=10:separator:::
ajax=11:radio::0:Use AJAX
encrypt_ajax_urls=12:radio::0:Encrypt ajax URLs
encrypt_key=13:string::1234567890123456:Secret Key
encrypt_iv=14:string::1234567890123456:Initialization Vector

misc=20:separator:::
code=21:string::default:Custom Code for Settings
[END_COT_EXT_CONFIG]
==================== */

/**
* Oneline Plugin / Setup
*
* @package oneline
* @author Dmitri Beliavski
* @copyright (c) 2017-2023 seditio.by
*/

defined('COT_CODE') or die('Wrong URL');
