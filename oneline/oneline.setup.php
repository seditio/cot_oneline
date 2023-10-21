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
code=00:string::default:Custom Code for Settings

fields=01:separator:::
pagination=02:select:0,5,10,15,20,50:0:News on page (0 viewall)
showopen=03:radio::1:Show open button
display_date=04:radio::1:Display date
display_price1=05:radio::1:Display price No.1
display_price1a=06:radio::1:Display price No.1a
display_price2=07:radio::1:Display price No.2
display_price2a=08:radio::1:Display price No.2a
display_text=09:radio::1:Display text
display_extra1=10:radio::1:Display extra text field No.1
display_extra2=11:radio::1:Display extra text field No.2
display_link=12:radio::1:Display link

useajax=20:separator:::
ajax=21:radio::0:Use AJAX
encrypt_ajax_urls=22:radio::0:Encrypt ajax URLs
encrypt_key=23:string::1234567890123456:Secret Key
encrypt_iv=24:string::1234567890123456:Initialization Vector
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
