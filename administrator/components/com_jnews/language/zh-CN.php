<?php
defined('_JEXEC') or die('Restricted access');
### © 2006-2016 Joobi Limited. All rights reserved.
### license GNU GPLv3 , link https://joobi.co

/**
* <p>Traditional Chinese language file</p>
* @author Mike Ho <mikeho1980@hotmail.com>
* @version $Id: traditional_chinese.php 491 2007-02-01 22:56:07Z chris $
* @link http://www.dogneighbor.com
*/

#######    NOTE TO TRANSLATORS  #######
# If you wish to translate the language file to your own language, please feel free to do so
# We would apprecaite if you could send you translation to the specified email
# so that other people could benefit from your contribution
# If you feel that the file is too long feel free to do as much as you want and probably
# someone else will be happy to pick up were you stopped.
#  We did our bestt to organize the subject by order of priority so start at the top
# If you update your translation please send you updates to translation@joobi.co
# IMPORTANT: make sure respect as much as posible the punctionation and spacing because
# sometimes the word constant are conbined...
# Don't ever remove a define as it will create an error in the code.
# when using apostrophy  '   add a back-slash before like this:  \'  otherwise it will create an error.
# sometimes you will see html tag in the define, please leave it the way it is.

# DONT FORGET if you want to be credited fro your work, make sure to change the credit
# with your name and email if you want people to contact you otherwise leave the email as it is.
# We will use that information to also include you into the About section of the component
# Thank you very much for your contribution translating in your language

### General ###
 //jnews Description
define('_JNEWS_DESC_CORE', 'jNews ж�ЇдёЂд»¶и®©дЅ жњ‰ж•€ењ°е’ЊдЅ зљ„з”Ёж€·еЏЉе®ўж€·йЂљи®Їзљ„й‚®еЇ„еђЌеЌ•, з”µе­ђжЉҐ, и‡ЄеЉЁеє”з­”, еЏЉи·џиї›е·Ґе…·.' .
		'jNews, дЅ зљ„йЂљи®Їж‹Ќж–‡д»¶пјЃ');
define('_JNEWS_DESC_GPL', 'jNews ж�ЇдёЂд»¶и®©дЅ жњ‰ж•€ењ°е’ЊдЅ зљ„з”Ёж€·еЏЉе®ўж€·йЂљи®Їзљ„й‚®еЇ„еђЌеЌ•, з”µе­ђжЉҐ, и‡ЄеЉЁеє”з­”, еЏЉи·џиї›е·Ґе…·.' .
		'jNews, дЅ зљ„йЂљи®Їж‹Ќж–‡д»¶пјЃ');
define('_JNEWS_FEATURES', 'jNews, дЅ зљ„йЂљи®Їж‹Ќж–‡д»¶пјЃ');

// Type of lists
define('_JNEWS_NEWSLETTER', 'з”µе­ђжЉҐ');
define('_JNEWS_AUTORESP', 'и‡ЄеЉЁеє”з­”');
define('_JNEWS_AUTORSS', 'и‡ЄеЉЁ RSS');
define('_JNEWS_ECARD', 'з”µе­ђеЌЎ');
define('_JNEWS_POSTCARD', 'ж�ЋдїЎз‰‡');
define('_JNEWS_PERF', 'ж•€иѓЅ');
define('_JNEWS_COUPON', 'дј�жѓ е€ё');
define('_JNEWS_CRON', 'жЋ’зЁ‹е·ҐдЅњ');
define('_JNEWS_MAILING', 'й‚®д»¶');
define('_JNEWS_LIST', 'жё…еЌ•');

 //jnews Menu
define('_JNEWS_MENU_LIST', 'жё…еЌ•');
define('_JNEWS_MENU_SUBSCRIBERS', 'и®ўй�…иЂ…');
define('_JNEWS_MENU_NEWSLETTERS', 'з”µе­ђжЉҐ');
define('_JNEWS_MENU_AUTOS', 'и‡ЄеЉЁеє”з­”');
define('_JNEWS_MENU_COUPONS', 'дј�жѓ е€ё');
define('_JNEWS_MENU_CRONS', 'жЋ’зЁ‹е·ҐдЅњ');
define('_JNEWS_MENU_AUTORSS', 'и‡ЄеЉЁ-RSS');
define('_JNEWS_MENU_ECARD', 'з”µе­ђеЌЎ');
define('_JNEWS_MENU_POSTCARDS', 'ж�ЋдїЎз‰‡');
define('_JNEWS_MENU_PERFS', 'ж•€иѓЅ');
define('_JNEWS_MENU_TAB_LIST', 'жё…еЌ•');
define('_JNEWS_MENU_MAILING_TITLE', 'й‚®д»¶');
define('_JNEWS_MENU_MAILING' , 'й‚®д»¶дєЋ');
define('_JNEWS_MENU_STATS', 'з»џи®Ў');
define('_JNEWS_MENU_STATS_FOR', 'з»џи®ЎдєЋ');
define('_JNEWS_MENU_CONF', 'и®ѕе®љ');
define('_JNEWS_MENU_UPDATE', 'ж›ґж–°');
define('_JNEWS_MENU_ABOUT', 'е…ідєЋ');
define('_JNEWS_MENU_LEARN', 'ж•™и‚Ідё­еїѓ');
define('_JNEWS_MENU_MEDIA', 'еЄ’дЅ“з®Ўзђ†е‘�');
define('_JNEWS_MENU_HELP', 'иЇґж�Ћ');
define('_JNEWS_MENU_CPANEL', 'жЋ§е€¶еЏ°');
define('_JNEWS_MENU_IMPORT', 'ж±‡е…Ґ');
define('_JNEWS_MENU_EXPORT', 'ж±‡е‡є');
define('_JNEWS_MENU_SUB_ALL', 'е…ЁйѓЁи®ўй�…');
define('_JNEWS_MENU_UNSUB_ALL', 'еЏ–ж¶€е…ЁйѓЁи®ўй�…');
define('_JNEWS_MENU_VIEW_ARCHIVE', 'е°Ѓе­�');
define('_JNEWS_MENU_PREVIEW', 'йў„и§€');
define('_JNEWS_MENU_SEND', 'еЏ‘йЂЃ');
define('_JNEWS_MENU_SEND_TEST', 'еЏ‘йЂЃжµ‹иЇ•з”µй‚®');
define('_JNEWS_MENU_SEND_QUEUE', 'жЊ‡д»¤й�џе€—');
define('_JNEWS_MENU_VIEW', 'жЈЂи§†');
define('_JNEWS_MENU_COPY', 'е¤Ќе€¶');
define('_JNEWS_MENU_VIEW_STATS' , 'жЈЂи§†з»џи®Ў');
define('_JNEWS_MENU_CRTL_PANEL' , ' жЋ§е€¶еЏ°');
define('_JNEWS_MENU_LIST_NEW' , ' е»єз«‹жё…еЌ•');
define('_JNEWS_MENU_LIST_EDIT' , ' зј–иѕ‘жё…еЌ•');
define('_JNEWS_MENU_BACK', 'иї”е›ћ');
define('_JNEWS_MENU_INSTALL', 'е®‰иЈ…');
define('_JNEWS_MENU_TAB_SUM', 'ж¦‚и§€');
define('_JNEWS_STATUS' , 'зЉ¶е†µ');

// messages
define('_JNEWS_ERROR' , ' еЏ‘з”џдє†й”™иЇЇ! ');
define('_JNEWS_SUB_ACCESS' , 'и®їй—®жќѓй™ђ');
define('_JNEWS_DESC_CREDITS', 'е€¶дЅњдєєе‘�');
define('_JNEWS_DESC_INFO', 'дїЎжЃЇ');
define('_JNEWS_DESC_HOME', 'й¦–йЎµ');
define('_JNEWS_DESC_MAILING', 'й‚®д»¶жё…еЌ•');
define('_JNEWS_DESC_SUBSCRIBERS', 'и®ўй�…иЂ…');
define('_JNEWS_PUBLISHED','е·ІеЏ‘еёѓ');
define('_JNEWS_UNPUBLISHED','жњЄеЏ‘еёѓ');
define('_JNEWS_DELETE','е€ й™¤');
define('_JNEWS_FILTER','иї‡ж»¤е™Ё');
define('_JNEWS_UPDATE','ж›ґиї‘');
define('_JNEWS_SAVE','е‚Ёе­�');
define('_JNEWS_CANCEL','еЏ–ж¶€');
define('_JNEWS_NAME','еђЌз§°');
define('_JNEWS_EMAIL','з”µй‚®');
define('_JNEWS_SELECT','йЂ‰ж‹©');
define('_JNEWS_ALL','е…ЁйѓЁ');
define('_JNEWS_SEND_A', 'еЏ‘йЂЃдёЂе°Ѓ ');
define('_JNEWS_SUCCESS_DELETED', ' е·Іж€ђеЉџе€ й™¤');
define('_JNEWS_LIST_ADDED', 'жё…еЌ•е·Іж€ђеЉџе»єз«‹');
define('_JNEWS_LIST_COPY', 'жё…еЌ•е·Іж€ђеЉџе¤Ќе€¶');
define('_JNEWS_LIST_UPDATED', 'жё…еЌ•е·Іж€ђеЉџж›ґж–°');
define('_JNEWS_MAILING_SAVED', 'й‚®д»¶е·Іж€ђеЉџе‚Ёе­�.');
define('_JNEWS_UPDATED_SUCCESSFULLY', 'е·Іж€ђеЉџж›ґж–°.');

### Subscribers information ###
//subscribe and unsubscribe info
define('_JNEWS_SUB_INFO', 'и®ўй�…иЂ…дїЎжЃЇ');
define('_JNEWS_VERIFY_INFO', 'иЇ·зЎ®е®љдЅ дј йЂЃзљ„й“ѕжЋҐпјЊдёЂдє›дїЎжЃЇзјєе¤±дє†.');
define('_JNEWS_INPUT_NAME', 'еђЌз§°');
define('_JNEWS_INPUT_EMAIL', 'з”µй‚®');
define('_JNEWS_RECEIVE_HTML', 'жЋҐж”¶ HTMLпјџ');
define('_JNEWS_TIME_ZONE', 'ж—¶еЊє');
define('_JNEWS_BLACK_LIST', 'й»‘еђЌеЌ•');
define('_JNEWS_REGISTRATION_DATE', 'з”Ёж€·жіЁе†Њж—Ґжњџ');
define('_JNEWS_USER_ID', 'з”Ёж€· id');
define('_JNEWS_DESCRIPTION', 'жЏЏиї°');
define('_JNEWS_ACCOUNT_CONFIRMED', 'дЅ зљ„иґ¦еЏ·е·Із»ЏеђЇеЉЁ.');
define('_JNEWS_SUB_SUBSCRIBER', 'и®ўй�…иЂ…');
define('_JNEWS_SUB_PUBLISHER', 'Publisher');
define('_JNEWS_SUB_ADMIN', 'Administrator');
define('_JNEWS_REGISTERED', 'Registered');
define('_JNEWS_SUBSCRIPTIONS', 'дЅ зљ„и®ўй�…');
define('_JNEWS_SEND_UNSUBCRIBE', 'еЏ‘йЂЃеЏ–ж¶€и®ўй�…и®ЇжЃЇ');
define('_JNEWS_SEND_UNSUBCRIBE_TIPS', 'з‚№е‡»гЂЊж�ЇгЂЌеЏ‘йЂЃеЏ–ж¶€и®ўй�…з”µй‚®зЎ®и®¤и®ЇжЃЇ.');
define('_JNEWS_SUBSCRIBE_SUBJECT_MESS', 'иЇ·зЎ®и®¤дЅ зљ„и®ўй�…');
define('_JNEWS_UNSUBSCRIBE_SUBJECT_MESS', 'зЎ®и®¤еЏ–ж¶€и®ўй�…');
define('_JNEWS_DEFAULT_SUBSCRIBE_MESS', '{tag:name}дЅ еҐЅпјЊ<br />' .
		'иї�е·®дёЂж­ҐдЅ дѕїдјљиў«еЉ е€°и®ўй�…жё…еЌ•.  иЇ·з‚№е‡»д»Ґдё‹иїћз»“зЎ®и®¤дЅ зљ„и®ўй�….' .
		'<br /><br />{tag:confirm}<br /><br />е¦‚жњ‰з–‘й—®иЇ·иЃ”зі»зЅ‘з«™з®Ўзђ†е‘�.');
define('_JNEWS_DEFAULT_UNSUBSCRIBE_MESS', 'иї™е°Ѓз”µй‚®ж�ЇзЎ®и®¤дЅ е·Із»Џд»Ћж€‘д»¬зљ„жё…еЌ•дё­еЏ–ж¶€и®ўй�….  ж€‘д»¬еѕ€йЃ—ж†ѕдЅ е†іе®љеЏ–ж¶€и®ўй�…, е¦‚дЅ е†іе®ље†Ќи®ўй�…, ж¬ўиїЋдЅ йљЏж—¶е€°ж€‘д»¬зљ„зЅ‘з«™.  е¦‚жњ‰з–‘й—®иЇ·иЃ”зі»ж€‘д»¬зљ„зЅ‘з«™з®Ўзђ†е‘�.');

// jNews subscribers
define('_JNEWS_SIGNUP_DATE', 'и®ўй�…ж—Ґжњџ');
define('_JNEWS_CONFIRMED', 'е·ІзЎ®и®¤');
define('_JNEWS_SUBSCRIB', 'и®ўй�…');
define('_JNEWS_HTML', 'HTML й‚®д»¶');
define('_JNEWS_RESULTS', 'з»“жћњ');
define('_JNEWS_SEL_LIST', 'йЂ‰ж‹©жё…еЌ•');
define('_JNEWS_SEL_LIST_TYPE', '- йЂ‰ж‹©жё…еЌ•з±»ећ‹ -');
define('_JNEWS_SUSCRIB_LIST', 'ж‰Ђжњ‰и®ўй�…иЂ…жё…еЌ•');
define('_JNEWS_SUSCRIB_LIST_UNIQUE', 'и®ўй�…иЂ…дєЋ : ');
define('_JNEWS_NO_SUSCRIBERS', 'ењЁж­¤жё…еЌ•ж‰ѕдёЌе€°и®ўй�…иЂ….');
define('_JNEWS_COMFIRM_SUBSCRIPTION', 'дёЂе°ЃзЎ®и®¤з”µй‚®е·ІеЏ‘йЂЃз»™дЅ .  иЇ·жЈЂжџҐдЅ зљ„з”µй‚®еЏЉз‚№е‡»ж‰ЂжЏђдѕ›зљ„иїћз»“.<br />' .
		'дЅ йњЂи¦ЃзЎ®и®¤дЅ зљ„з”µй‚®дЅ зљ„и®ўй�…ж‰Ќдјљз”џж•€.');
define('_JNEWS_SUCCESS_ADD_LIST', 'дЅ е·Із»Џж€ђеЉџеЉ е€°жё…еЌ•.');


 // Subcription info
define('_JNEWS_CONFIRM_LINK', 'з‚№е‡»иї™й‡ЊзЎ®и®¤дЅ зљ„и®ўй�…');
define('_JNEWS_UNSUBSCRIBE_LINK', 'з‚№е‡»иї™й‡Њд»Ћжё…еЌ•дё­еЏ–ж¶€дЅ зљ„и®ўй�…');
define('_JNEWS_UNSUBSCRIBE_MESS', 'дЅ зљ„з”µй‚®ењ°еќЂе·Ід»Ће€—иЎЁдё­з§»й™¤');

define('_JNEWS_QUEUE_SENT_SUCCESS' , 'ж‰Ђжњ‰е·ІжЋ’жњџй‚®д»¶е·Іж€ђеЉџеЏ‘йЂЃ.');
define('_JNEWS_MALING_VIEW', 'жЈЂи§†ж‰Ђжњ‰й‚®д»¶');
define('_JNEWS_UNSUBSCRIBE_MESSAGE', 'дЅ зЎ®е®љдЅ жѓід»Ћжё…еЌ•дё­еЏ–ж¶€и®ўй�…?');
define('_JNEWS_MOD_SUBSCRIBE', 'и®ўй�…');
define('_JNEWS_SUBSCRIBE', 'и®ўй�…');
define('_JNEWS_UNSUBSCRIBE', 'еЏ–ж¶€и®ўй�…');
define('_JNEWS_VIEW_ARCHIVE', 'жЈЂи§†е°Ѓе­�');
define('_JNEWS_SUBSCRIPTION_OR', ' ж€–з‚№е‡»иї™й‡Њж›ґж–°дЅ зљ„дїЎжЃЇ');
define('_JNEWS_EMAIL_ALREADY_REGISTERED', 'ж­¤з”µй‚®ењ°еќЂе·Із»ЏжіЁе†Њ.');
define('_JNEWS_SUBSCRIBER_DELETED', 'и®ўй�…иЂ…е·Іж€ђеЉџе€ й™¤.');


### UserPanel ###
 //User Menu
define('_JNEWS_UCP_USER_PANEL', 'з”Ёж€·жЋ§е€¶йќўжќї');
define('_JNEWS_UCP_USER_MENU', 'з”Ёж€·йЂ‰еЌ•');
define('_JNEWS_UCP_USER_CONTACT', 'ж€‘зљ„и®ўй�…');
 //jNews Cron Menu
define('_JNEWS_UCP_CRON_MENU', 'жЋ’зЁ‹е·ҐдЅњз®Ўзђ†');
define('_JNEWS_UCP_CRON_NEW_MENU', 'ж–°жЋ’зЁ‹');
define('_JNEWS_UCP_CRON_LIST_MENU', 'е€—е‡єж€‘зљ„жЋ’зЁ‹');
 //jNews Coupon Menu
define('_JNEWS_UCP_COUPON_MENU', 'дј�жѓ е€ёз®Ўзђ†');
define('_JNEWS_UCP_COUPON_LIST_MENU', 'дј�жѓ е€ёжё…еЌ•');
define('_JNEWS_UCP_COUPON_ADD_MENU', 'ж–°еўћдј�жѓ е€ё');

### lists ###
// Tabs
define('_JNEWS_LIST_T_GENERAL', 'жЏЏиї°');
define('_JNEWS_LIST_T_LAYOUT', 'з‰€йќўи®ѕи®Ў');
define('_JNEWS_LIST_T_SUBSCRIPTION', 'и®ўй�…');
define('_JNEWS_LIST_T_SENDER', 'еЏ‘д»¶дєєдїЎжЃЇ');

define('_JNEWS_LIST_TYPE', 'жё…еЌ•з±»ећ‹');
define('_JNEWS_LIST_NAME', 'жё…еЌ•еђЌз§°');
define('_JNEWS_LIST_ISSUE', 'еЏ‘иЎЊпјѓ');
define('_JNEWS_LIST_DATE', 'еЏ‘йЂЃж—Ґжњџ');
define('_JNEWS_LIST_SUB', 'й‚®д»¶ж ‡йў�');
define('_JNEWS_ATTACHED_FILES', 'й™„д»¶жЎЈжЎ€');
define('_JNEWS_SELECT_LIST', 'иЇ·йЂ‰ж‹©и¦Ѓзј–иѕ‘зљ„жё…еЌ•!');

// Auto Responder box
define('_JNEWS_AUTORESP_ON', 'жё…еЌ•з±»ећ‹');
define('_JNEWS_AUTO_RESP_OPTION', 'и‡ЄеЉЁеє”з­”йЂ‰йЎ№');
define('_JNEWS_AUTO_RESP_FREQ', 'и®ўй�…иЂ…еЏЇд»ҐйЂ‰ж‹©йў‘зЋ‡');
define('_JNEWS_AUTO_DELAY', 'е»¶иїџпј€д»Ґж—Ґи®Ўпј‰');
define('_JNEWS_AUTO_DAY_MIN', 'жњЂе°Џйў‘зЋ‡');
define('_JNEWS_AUTO_DAY_MAX', 'жњЂе¤§йў‘зЋ‡');
define('_JNEWS_FOLLOW_UP', 'жЊ‡е®љи·џиї›и‡ЄеЉЁеє”з­”');
define('_JNEWS_AUTO_RESP_TIME', 'и®ўй�…иЂ…еЏЇд»ҐйЂ‰ж‹©ж—¶й—ґ');
define('_JNEWS_LIST_SENDER', 'е€—е‡єеЏ‘д»¶дєє');

define('_JNEWS_LIST_DESC', 'жё…еЌ•жЏЏиї°');
define('_JNEWS_LAYOUT', 'з‰€йќўи®ѕи®Ў');
define('_JNEWS_SENDER_NAME', 'еЏ‘д»¶дєєеђЌз§°');
define('_JNEWS_SENDER_EMAIL', 'еЏ‘д»¶дєєз”µй‚®');
define('_JNEWS_SENDER_BOUNCE', 'еЏ‘д»¶дєєйЂЂе›ћењ°еќЂ');
define('_JNEWS_LIST_DELAY', 'е»¶иїџ');
define('_JNEWS_HTML_MAILING', 'HTML й‚®д»¶?');
define('_JNEWS_HTML_MAILING_DESC', '(е¦‚жћњеЏ�ж›ґе®ѓ, дЅ йњЂи¦Ѓе‚Ёе­�еЏЉиї”е›ћж­¤йЎµжЈЂи§†еЏ�ж›ґ.)');
define('_JNEWS_HIDE_FROM_FRONTEND', 'д»Ћй¦–йЎµйљђи—Џ?');
define('_JNEWS_SELECT_IMPORT_FILE', 'йЂ‰ж‹©и¦Ѓж±‡е…Ґзљ„жЎЈжЎ€');;
define('_JNEWS_IMPORT_FINISHED', 'ж±‡е…Ґе®Њж€ђ');
define('_JNEWS_DELETION_OFFILE', 'е€ й™¤жЎЈжЎ€');
define('_JNEWS_MANUALLY_DELETE', 'е¤±иґҐ, дЅ еє”иЇҐж‰‹еЉЁе€ й™¤жЎЈжЎ€');
define('_JNEWS_CANNOT_WRITE_DIR', 'дёЌиѓЅе†™е…Ґз›®еЅ•');
define('_JNEWS_NOT_PUBLISHED', 'дёЌиѓЅеЏ‘йЂЃй‚®д»¶, жё…еЌ•жњЄеЏ‘еёѓ.');

//  List info box
define('_JNEWS_INFO_LIST_PUB', 'з‚№е‡»гЂЊж�ЇгЂЌеЏ‘еёѓжё…еЌ•');
define('_JNEWS_INFO_LIST_NAME', 'ењЁж­¤иѕ“е…ҐдЅ зљ„жё…еЌ•зљ„еђЌз§°. дЅ еЏЇд»Ґж­¤еђЌз§°е€†иѕЁжё…еЌ•.');
define('_JNEWS_INFO_LIST_DESC', 'ењЁж­¤иѕ“е…ҐдЅ зљ„жё…еЌ•зљ„з®ЂеЌ•жЏЏиї°. дЅ зљ„зЅ‘з«™и®їе®ўе°†дјљзњ‹е€°ж­¤жЏЏиї°.');
define('_JNEWS_INFO_LIST_SENDER_NAME', 'иѕ“е…Ґй‚®д»¶еЏ‘д»¶дєєзљ„еђЌз§°. еЅ“и®ўй�…иЂ…д»Ћж­¤е€—иЎЁж”¶е€°и®ЇжЃЇж—¶еЏЇд»Ґзњ‹е€°ж­¤еђЌз§°.');
define('_JNEWS_INFO_LIST_SENDER_EMAIL', 'иѕ“е…ҐеЌіе°†еЏ‘йЂЃзљ„и®ЇжЃЇзљ„з”µй‚®ењ°еќЂ.');
define('_JNEWS_INFO_LIST_SENDER_BOUNCED', 'иѕ“е…Ґз”Ёж€·еЏЇд»Ґе›ће¤Ќе€°зљ„з”µй‚®ењ°еќЂ. ејєзѓ€е»єи®®дёЋеЏ‘д»¶дєєз”µй‚®з›ёеђЊ, е› дёєе¦‚жћње®ѓд»¬дёЌеђЊж»ҐеЏ‘иї‡ж»¤е™Ёе°†дјљз»™дє€дЅ зљ„и®ЇжЃЇж›ґй«�зљ„ж»ҐеЏ‘жЋ’еђЌ.');
define('_JNEWS_INFO_LIST_AUTORESP', 'йЂ‰ж‹©ж­¤жё…еЌ•зљ„й‚®д»¶з±»ећ‹. <br />' .
		'з”µе­ђжЉҐ: ж­Јеёёз”µе­ђжЉҐ<br />' .
		'и‡ЄеЉЁеє”з­”: и‡ЄеЉЁеє”з­”ж�Їи‡ЄеЉЁе®љжњџйЂЏиї‡зЅ‘з«™еЏ‘йЂЃзљ„жё…еЌ•.');
define('_JNEWS_INFO_LIST_FREQUENCY', 'е…Ѓи®ёз”Ёж€·йЂ‰ж‹©жЋҐж”¶е€—иЎЁзљ„йў‘зЋ‡.  иї™з»™дє€з”Ёж€·ж›ґе¤§зљ„еј№жЂ§.');
define('_JNEWS_INFO_LIST_TIME', 'и®©з”Ёж€·йЂ‰ж‹©жЋҐж”¶е€—иЎЁзљ„е–њеҐЅж—¶й—ґ.');
define('_JNEWS_INFO_LIST_MIN_DAY', 'е®љд№‰з”Ёж€·еЏЇйЂ‰ж‹©жЋҐж”¶е€—иЎЁзљ„жњЂе°Џйў‘зЋ‡');
define('_JNEWS_INFO_LIST_DELAY', 'жЊ‡е®љж­¤и‡ЄеЉЁеє”з­”дёЋд№‹е‰ЌдёЂдёЄд№‹й—ґе»¶иїџ.');
define('_JNEWS_INFO_LIST_DATE', 'е¦‚дЅ жѓіе»¶иїџеЏ‘еёѓиЇ·жЊ‡е®љеЏ‘еёѓж–°й—»жё…еЌ•зљ„ж—Ґжњџ. <br /> ж јејЏ : YYYY-MM-DD HH:MM:SS');
define('_JNEWS_INFO_LIST_MAX_DAY', 'е®љд№‰з”Ёж€·еЏЇйЂ‰ж‹©жЋҐж”¶е€—иЎЁзљ„жњЂе¤§йў‘зЋ‡');
define('_JNEWS_INFO_LIST_LAYOUT', 'ењЁж­¤иѕ“е…ҐдЅ зљ„й‚®д»¶жё…еЌ•зљ„з‰€йќўи®ѕи®Ў. дЅ еЏЇд»ҐењЁж­¤иѕ“е…Ґд»»дЅ•дЅ зљ„й‚®д»¶зљ„з‰€йќўи®ѕи®Ў.');
define('_JNEWS_INFO_LIST_SUB_MESS', 'ж­¤и®ЇжЃЇе°†дјљеЏ‘йЂЃе€°й¦–ж¬ЎжіЁе†Њзљ„и®ўй�…иЂ…. дЅ еЏЇд»ҐењЁж­¤е®љд№‰д»»дЅ•дЅ е–њж¬ўзљ„ж–‡е­—.');
define('_JNEWS_INFO_LIST_UNSUB_MESS', 'ж­¤и®ЇжЃЇе°†дјљеЏ‘е€°е€°еЏ–ж¶€и®ўй�…зљ„и®ўй�…иЂ…. еЏЇењЁж­¤иѕ“е…Ґд»»дЅ•и®ЇжЃЇ.');
define('_JNEWS_INFO_LIST_HTML', 'е¦‚дЅ еёЊжњ›еЏ‘йЂЃ HTML й‚®д»¶иЇ·йЂ‰еЏ–ж–№еќ—. еЅ“и®ўй�…ж—¶ HTML жё…еЌ•ж—¶и®ўй�…иЂ…е°†еЏЇд»ҐжЊ‡е®љж�Їеђ¦еёЊжњ›жЋҐж”¶ HTML и®ЇжЃЇ, ж€–зєЇж–‡жњ¬и®ЇжЃЇ.');
define('_JNEWS_INFO_LIST_HIDDEN', 'з‚№е‡»гЂЊж�ЇгЂЌ д»Ће‰ЌеЏ°йљђи—Џе€—иЎЁ, з”Ёж€·е°†дёЌиѓЅи®ўй�…дЅ†дЅ д»ЌеЏЇд»ҐеЏ‘йЂЃй‚®д»¶.');
define('_JNEWS_INFO_LIST_JNEWS_AUTO_SUB', 'дЅ и¦Ѓи‡ЄеЉЁи®ўй�…з”Ёж€·е€°ж­¤е€—иЎЁеђ—?<br /><B>ж–°з”Ёж€·:</B> е°†дјљжіЁе†ЊжЇЏдЅЌжіЁе†Ње€°зЅ‘з«™зљ„ж–°з”Ёж€·.<br /><B>ж‰Ђжњ‰з”Ёж€·:</B> е°†дјљжіЁе†ЊжЇЏдЅЌењЁж•°жЌ®еє“зљ„жіЁе†Њз”Ёж€·.<br />(ж‰Ђжњ‰йЂ‰йЎ№ж”ЇжЊЃ Community Builder)');
define('_JNEWS_INFO_LIST_ACC_LEVEL', 'йЂ‰ж‹©е‰ЌеЏ°е­�еЏ–е±‚зє§. е®ѓдјљеЇ№жІЎжњ‰жќѓй™ђзљ„з”Ёж€·зѕ¤з»„ж�ѕз¤єж€–йљђи—Џй‚®д»¶, е› ж­¤д»–д»¬дёЌиѓЅеЇ№е®ѓи®ўй�….');
define('_JNEWS_INFO_LIST_ACC_USER_ID', 'йЂ‰ж‹©дЅ жѓіе…Ѓи®ёзј–иѕ‘зљ„з”Ёж€·зѕ¤з»„зљ„е­�еЏ–е±‚зє§. иЇҐз”Ёж€·зѕ¤з»„еЏЉд»ҐдёЉе°†еЏЇд»Ґзј–иѕ‘й‚®д»¶еЏЉйЂЏиї‡е‰ЌеЏ°ж€–еђЋеЏ°е°†е®ѓеЏ‘йЂЃ.');
define('_JNEWS_INFO_LIST_FOLLOW_UP', 'е¦‚жћњдЅ жѓіи‡ЄеЉЁеє”з­”дёЂж—¦е€°иѕѕжњЂеђЋзљ„и®ЇжЃЇж—¶з§»е€°еЏ¦дёЂи®ЇжЃЇ, дЅ еЏЇд»ҐењЁж­¤жЊ‡е®љи·џиї›зљ„и‡ЄеЉЁеє”з­”.');
define('_JNEWS_INFO_LIST_JNEWS_OWNER', 'иї™ж�Їе»єз«‹жё…еЌ•иЂ…зљ„ ID.');
define('_JNEWS_INFO_LIST_WARNING', '   ж­¤жњЂеђЋйЂ‰йЎ№еЏЄдєЋе»єз«‹е€—иЎЁж—¶еђЇз”Ё.');
define('_JNEWS_INFO_LIST_SUBJET', ' й‚®д»¶зљ„ж ‡йў�.  иї™ж�Їи®ўй�…иЂ…е°†ж”¶е€°зљ„з”µй‚®зљ„ж ‡йў�.');
define('_JNEWS_INFO_MAILING_CONTENT', 'иї™ж�ЇдЅ жѓіеЏ‘йЂЃзљ„з”µй‚®зљ„дё»дЅ“йѓЁд»Ѕ.');
define('_JNEWS_INFO_MAILING_NOHTML', 'ењЁж­¤иѕ“е…ҐдЅ жѓіеЏ‘йЂЃе€°йЂ‰ж‹©дёЌжЋҐж”¶ HTML зљ„и®ўй�…иЂ…зљ„з”µй‚®. <BR/> жіЁж„Џ: е¦‚жћњдЅ з•™з©єе®ѓ jNews е°†дјљи‡ЄеЉЁиЅ¬жЌў HTML е†…е®№дёєзєЇж–‡жњ¬.');
define('_JNEWS_INFO_MAILING_VISIBLE', 'з‚№е‡»гЂЊж�ЇгЂЌдєЋе‰ЌеЏ°ж�ѕз¤єй‚®д»¶.');
define('_JNEWS_INSERT_CONTENT', 'жЏ’е…Ґе·Іе­�ењЁе†…е®№');

// Coupons
define('_JNEWS_SEND_COUPON_SUCCESS', 'дј�жѓ е€ёж€ђеЉџеЏ‘йЂЃпјЃ');
define('_JNEWS_CHOOSE_COUPON', 'йЂ‰ж‹©дј�жѓ е€ё');
define('_JNEWS_TO_USER', ' е€°ж­¤з”Ёж€·');

### Cron options
//drop down frequency(CRON)
define('_JNEWS_FREQ_CH1', 'жЇЏе°Џж—¶');
define('_JNEWS_FREQ_CH2', 'жЇЏ 6 е°Џж—¶');
define('_JNEWS_FREQ_CH3', 'жЇЏ 12 е°Џж—¶');
define('_JNEWS_FREQ_CH4', 'жЇЏж—Ґ');
define('_JNEWS_FREQ_CH5', 'жЇЏе‘Ё');
define('_JNEWS_FREQ_CH6', 'жЇЏжњ€');
define('_JNEWS_FREQ_NONE', 'ж— ');
define('_JNEWS_FREQ_NEW', 'ж–°з”Ёж€·');
define('_JNEWS_FREQ_ALL', 'ж‰Ђжњ‰з”Ёж€·');

//Label CRON form
define('_JNEWS_LABEL_FREQ', 'jNews жЋ’зЁ‹?');
define('_JNEWS_LABEL_FREQ_TIPS', 'е¦‚жћњдЅ жѓідЅїз”Ёе®ѓдЅњдёє jNews жЋ’зЁ‹з‚№е‡»гЂЊж�ЇгЂЌ, з‚№е‡»гЂЊеђ¦гЂЌдЅњдёєд»»дЅ•е…¶д»–зљ„жЋ’зЁ‹е·ҐдЅњ.<br />' .
		'е¦‚жћњдЅ з‚№е‡»гЂЊж�ЇгЂЌ дЅ дёЌйњЂи¦ЃжЊ‡е®љжЋ’зЁ‹ењ°еќЂ, е®ѓе°†дјљи‡ЄеЉЁењ°еЉ е…Ґ.');
define('_JNEWS_SITE_URL' , 'дЅ зљ„зЅ‘еќЂ');
define('_JNEWS_CRON_FREQUENCY' , 'жЋ’зЁ‹йў‘зЋ‡');
define('_JNEWS_STARTDATE_FREQ' , 'ејЂе§‹ж—Ґжњџ');
define('_JNEWS_LABELDATE_FREQ' , 'жЊ‡е®љж—Ґжњџ');
define('_JNEWS_LABELTIME_FREQ' , 'жЊ‡е®љж—¶й—ґ');
define('_JNEWS_CRON_URL', 'жЋ’зЁ‹зЅ‘еќЂ');
define('_JNEWS_CRON_FREQ', 'йў‘зЋ‡');
define('_JNEWS_TITLE_CRONLIST', 'жЋ’зЁ‹жё…еЌ•');
define('_JNEWS_NEW_LIST', 'е»єз«‹ж–°жё…еЌ•');

//title CRON form
define('_JNEWS_TITLE_FREQ', 'жЋ’зЁ‹зј–иѕ‘');
define('_JNEWS_CRON_SITE_URL', 'иЇ·иѕ“е…Ґжњ‰ж•€зљ„зЅ‘еќЂ, д»Ґ http:// ејЂе§‹');

### Mailings ###
define('_JNEWS_MAILING_ALL', 'ж‰Ђжњ‰й‚®д»¶');
define('_JNEWS_EDIT_A', 'зј–иѕ‘ ');
define('_JNEWS_SELCT_MAILING', 'иЇ·ењЁдё‹ж‹‰ејЏйЂ‰еЌ•дё­йЂ‰ж‹©жё…еЌ•д»Ґж–°еўћй‚®д»¶.');
define('_JNEWS_VISIBLE_FRONT', 'еЏЇдєЋе‰ЌеЏ°жЈЂи§†');

// mailer
define('_JNEWS_SUBJECT', 'ж ‡йў�');
define('_JNEWS_CONTENT', 'е†…е®№');
define('_JNEWS_NAMEREP', '{tag:name} = е®ѓдјљиў«и®ўй�…иЂ…ж‰Ђиѕ“е…Ґзљ„еђЌз§°еЏ–д»Ј, дЅ еЏЇд»Ґз”Ёе®ѓеЏ‘йЂЃдёЄдєєеЊ–з”µй‚®.<br />');
define('_JNEWS_FIRST_NAME_REP', '{tag:firstname} = е®ѓдјљиў«и®ўй�…иЂ…ж‰Ђиѕ“е…Ґзљ„еђЌе­—еЏ–д»Ј.<br />');
define('_JNEWS_NONHTML', 'йќћ-html з‰€жњ¬');
define('_JNEWS_ATTACHMENTS', 'й™„д»¶');
define('_JNEWS_SELECT_MULTIPLE', 'жЊ‰дЅЏ ctrlпј€ж€–е‘Ѕд»¤пј‰йЂ‰ж‹©е¤љдёЄй™„д»¶.<br />' .
		'й™„д»¶е€—иЎЁдё­ж�ѕз¤єзљ„жЎЈжЎ€ж”ѕењЁй™„д»¶ж–‡д»¶е¤№е†…, дЅ еЏЇд»ҐењЁжЋ§е€¶йќўжќїеЏ�ж›ґж­¤дЅЌзЅ®.');
define('_JNEWS_CONTENT_ITEM', 'е†…е®№йЎ№з›®');
define('_JNEWS_SENDING_EMAIL', 'з”µй‚®еЏ‘йЂЃдё­');
define('_JNEWS_MESSAGE_NOT', 'и®ЇжЃЇдёЌиѓЅеЏ‘йЂЃ');
define('_JNEWS_MAILER_ERROR', 'й‚®д»¶ж”¶еЏ‘жњєй”™иЇЇ');
define('_JNEWS_MESSAGE_SENT_SUCCESSFULLY', 'и®ЇжЃЇе·Іж€ђеЉџеЏ‘йЂЃ');
define('_JNEWS_SENDING_TOOK', 'еЏ‘йЂЃж­¤й‚®д»¶з”Ёдє†');
define('_JNEWS_SECONDS', 'з§’');
define('_JNEWS_NO_ADDRESS_ENTERED', 'ж— жЏђдѕ›з”µй‚®ењ°еќЂж€–и®ўй�…иЂ…');
define('_JNEWS_CHANGE_SUBSCRIPTIONS', 'еЏ�ж›ґ');
define('_JNEWS_CHANGE_EMAIL_SUBSCRIPTION', 'еЏ�ж›ґдЅ зљ„и®ўй�…');
define('_JNEWS_WHICH_EMAIL_TEST', 'жЊ‡е‡єеЏ‘йЂЃжµ‹иЇ•ж€–йЂ‰ж‹©йў„и§€зљ„з”µй‚®ењ°еќЂ');
define('_JNEWS_SEND_IN_HTML', 'д»Ґ HTML еЏ‘йЂЃпј€еЏЄй™ђ html й‚®д»¶пј‰пјџ');
define('_JNEWS_VISIBLE', 'еЏЇжЈЂи§†');
define('_JNEWS_INTRO_ONLY', 'еЏЄжњ‰з®Ђд»‹');

// stats
define('_JNEWS_GLOBALSTATS', 'е…Ёе±Ђз»џи®Ў');
define('_JNEWS_DETAILED_STATS', 'иЇ¦з»†з»џи®Ў');
define('_JNEWS_MAILING_LIST_DETAILS', 'е€—е‡єиЇ¦жѓ…');
define('_JNEWS_SEND_IN_HTML_FORMAT', 'д»Ґ HTML ж јејЏеЏ‘йЂЃ');
define('_JNEWS_VIEWS_FROM_HTML', 'жЈЂи§†пј€и‡Є html й‚®д»¶пј‰');
define('_JNEWS_SEND_IN_TEXT_FORMAT', 'д»ҐзєЇж–‡жњ¬ж јејЏеЏ‘йЂЃ');
define('_JNEWS_HTML_READ', 'HTML е·Ій�…иЇ»');
define('_JNEWS_HTML_UNREAD', 'HTML жњЄй�…иЇ»');
define('_JNEWS_TEXT_ONLY_SENT', 'зєЇж–‡жњ¬');

// Configuration panel
// main tabs
define('_JNEWS_MAIL_CONFIG', 'й‚®еЇ„');
define('_JNEWS_LOGGING_CONFIG', 'зєЄеЅ•еЏЉз»џи®Ў');
define('_JNEWS_SUBSCRIBER_CONFIG', 'и®ўй�…иЂ…');
define('_JNEWS_MISC_CONFIG', 'жќ‚йЎ№');
define('_JNEWS_MAIL_SETTINGS', 'й‚®еЇ„и®ѕе®љ');
define('_JNEWS_MAILINGS_SETTINGS', 'й‚®д»¶и®ѕе®љ');
define('_JNEWS_SUBCRIBERS_SETTINGS', 'и®ўй�…иЂ…и®ѕе®љ');
define('_JNEWS_CRON_SETTINGS', 'жЋ’зЁ‹и®ѕе®љ');
define('_JNEWS_SENDING_SETTINGS', 'еЏ‘йЂЃи®ѕе®љ');
define('_JNEWS_STATS_SETTINGS', 'з»џи®Ўи®ѕе®љ');
define('_JNEWS_LOGS_SETTINGS', 'зєЄеЅ•и®ѕе®љ');
define('_JNEWS_MISC_SETTINGS', 'жќ‚йЎ№и®ѕе®љ');
// mail settings
define('_JNEWS_SEND_MAIL_FROM', 'еЏ‘д»¶дєєз”µй‚®');
define('_JNEWS_SEND_MAIL_NAME', 'еЏ‘д»¶дєєеђЌз§°');
define('_JNEWS_MAILSENDMETHOD', 'й‚®д»¶ж”¶еЏ‘жњєжЁЎејЏ');
define('_JNEWS_SENDMAILPATH', 'Sendmail и·Їеѕ„');
define('_JNEWS_SMTPHOST', 'SMTP дё»жњє');
define('_JNEWS_SMTPAUTHREQUIRED', 'SMTP йњЂи¦ЃйЄЊиЇЃ');
define('_JNEWS_SMTPAUTHREQUIRED_TIPS', 'е¦‚дЅ зљ„ SMTP жњЌеЉЎе™ЁйњЂи¦ЃйЄЊиЇЃ, йЂ‰ж‹©гЂЊж�ЇгЂЌ');
define('_JNEWS_SMTPUSERNAME', 'SMTP з”Ёж€·еђЌз§°');
define('_JNEWS_SMTPUSERNAME_TIPS', 'е¦‚дЅ зљ„ SMTP жњЌеЉЎе™ЁйњЂи¦ЃйЄЊиЇЃ, иѕ“е…Ґ SMTP з”Ёж€·еђЌз§°');
define('_JNEWS_SMTPPASSWORD', 'SMTP еЇ†з Ѓ');
define('_JNEWS_SMTPPASSWORD_TIPS', 'е¦‚дЅ зљ„ SMTP жњЌеЉЎе™ЁйњЂи¦ЃйЄЊиЇЃ, иѕ“е…Ґ SMTP еЇ†з Ѓ');
define('_JNEWS_USE_EMBEDDED', 'дЅїз”Ёе†…еµЊе›ѕеѓЏ');
define('_JNEWS_USE_EMBEDDED_TIPS', 'е¦‚й™„еЉ ењЁе†…е®№йЎ№з›®зљ„е›ѕеѓЏж�Їе†…еµЊењЁ html и®ЇжЃЇз”µй‚®, йЂ‰ж‹©гЂЊж�ЇгЂЌ; дЅїз”Ёй»�и®¤е›ѕеѓЏеЌ·ж ‡й“ѕжЋҐе€°зЅ‘з«™е›ѕеѓЏ, йЂ‰ж‹©гЂЊеђ¦гЂЌ.');
define('_JNEWS_UPLOAD_PATH', 'дёЉиЅЅ/й™„д»¶и·Їеѕ„');
define('_JNEWS_UPLOAD_PATH_TIPS', 'дЅ еЏЇд»ҐжЊ‡е®љдёЉиЅЅз›®еЅ•.<br />' .
		'зЎ®е®љдЅ жЊ‡е®љзљ„з›®еЅ•е·Іе­�ењЁ, еђ¦е€™е»єз«‹е®ѓ.');

// subscribers settings
define('_JNEWS_ALLOW_UNREG', 'е…Ѓи®ёжњЄжіЁе†Њ');
define('_JNEWS_ALLOW_UNREG_TIPS', 'е¦‚дЅ жѓіе…Ѓи®ёз”Ёж€·ж— йњЂжіЁе†Ње€°зЅ‘з«™дѕїеЏЇи®ўй�…е€°жё…еЌ•, йЂ‰ж‹©гЂЊж�ЇгЂЌ.');
define('_JNEWS_REQ_CONFIRM', 'йњЂи¦ЃзЎ®и®¤');
define('_JNEWS_REQ_CONFIRM_TIPS', 'е¦‚дЅ йњЂи¦ЃжњЄжіЁе†Њи®ўй�…иЂ…зЎ®и®¤д»–д»¬зљ„з”µй‚®ењ°еќЂ, йЂ‰ж‹©гЂЊж�ЇгЂЌ.');
define('_JNEWS_SUB_SETTINGS', 'и®ўй�…и®ѕе®љ');
define('_JNEWS_SUBMESSAGE', 'и®ўй�…з”µй‚®');
define('_JNEWS_SUBSCRIBE_LIST', 'и®ўй�…е€°жё…еЌ•');

define('_JNEWS_USABLE_TAGS', 'еЏЇз”Ёзљ„ж ‡з­ѕ');
define('_JNEWS_NAME_AND_CONFIRM', '<b>{tag:confirm}</b> = е®ѓе»єз«‹еЏЇз‚№е‡»иїћз»“дЅїи®ўй�…иЂ…еЏЇд»ҐзЎ®и®¤д»–д»¬зљ„и®ўй�…. иї™ж�Їи®© jNews ж­ЈеёёиїђдЅњж‰Ђ<strong>еї…йЎ»зљ„</strong>.<br />'
.'<br />{tag:name} = е®ѓдјљиў«и®ўй�…иЂ…ж‰Ђиѕ“е…Ґзљ„еђЌз§°еЏ–д»Ј, дЅ еЏЇд»Ґз”Ёе®ѓеЏ‘йЂЃдёЄдєєеЊ–з”µй‚®.<br />'
.'<br />{tag:firstname} = е®ѓдјљиў«и®ўй�…иЂ…ж‰Ђиѕ“е…Ґзљ„еђЌе­—еЏ–д»Ј, еђЌе­—ж�Їз”±и®ўй�…иЂ…е®љд№‰.<br />');
define('_JNEWS_CONFIRMFROMNAME', 'зЎ®и®¤еЏ‘д»¶дєєеђЌз§°');
define('_JNEWS_CONFIRMFROMNAME_TIPS', 'иѕ“е…Ґж�ѕз¤єењЁзЎ®и®¤е€—иЎЁзљ„еЏ‘д»¶дєєеђЌз§°.');
define('_JNEWS_CONFIRMFROMEMAIL', 'еЏ‘д»¶дєєз”µй‚®зЎ®и®¤');
define('_JNEWS_CONFIRMFROMEMAIL_TIPS', 'иѕ“е…Ґж�ѕз¤єењЁзЎ®и®¤е€—иЎЁзљ„з”µй‚®ењ°еќЂ.');
//define('_JNEWS_CONFIRMBOUNCE', 'йЂЂе›ћењ°еќЂ');
//define('_JNEWS_CONFIRMBOUNCE_TIPS', 'иѕ“е…Ґж�ѕз¤єењЁзЎ®и®¤е€—иЎЁзљ„йЂЂе›ћењ°еќЂ.');
define('_JNEWS_HTML_CONFIRM', 'HTML зЎ®и®¤');
define('_JNEWS_HTML_CONFIRM_TIPS', 'е¦‚з”Ёж€·е…Ѓи®ё html зЎ®и®¤е€—иЎЁдѕїж�Ї html, йЂ‰ж‹©гЂЊж�ЇгЂЌ.');
define('_JNEWS_TIME_ZONE_ASK', 'иЇўй—®ж—¶еЊє');
define('_JNEWS_TIME_ZONE_TIPS', 'е¦‚дЅ жѓіиЇўй—®з”Ёж€·зљ„ж—¶еЊє, йЂ‰ж‹©гЂЊж�ЇгЂЌ. йЂ‚з”Ёж—¶жЋ’зЁ‹й‚®д»¶дјљжЊ‰ж—¶еЊєеЏ‘йЂЃ');

 // Cron Set up
 define('_JNEWS_AUTO_CONFIG', 'жЋ’зЁ‹');
define('_JNEWS_TIME_OFFSET_URL', 'з‚№е‡»иї™й‡ЊењЁе…Ёе±Ђи®ѕе®љжЋ§е€¶еЏ° -> ењ°еЊєе€†йЎµи®ѕе®љж—¶е·®');
define('_JNEWS_TIME_OFFSET_TIPS', 'и®ѕе®љдЅ зљ„жњЌеЉЎе™Ёж—¶е·®дЅїзєЄеЅ•ж—ҐжњџеЏЉж—¶й—ґе‡†зЎ®');
define('_JNEWS_TIME_OFFSET', 'ж—¶е·®');
define('_JNEWS_CRON_DESC','<br />дЅїз”ЁжЋ’зЁ‹еЉџиѓЅдЅ еЏЇд»ҐдёєдЅ зљ„ Joomla зЅ‘з«™и®ѕе®љи‡ЄеЉЁеЊ–е·ҐдЅњ!<br />' .
		'и¦Ѓи®ѕе®љдЅ йњЂи¦ЃењЁдЅ зљ„жЋ§е€¶йќўжќї crontab ж–°еўћд»Ґдё‹жЊ‡д»¤:<br />' .
		'<b>' . JNEWS_JPATH_LIVE . '/index.php?option=com_jnews&act=cron</b> ' .
		'<br /><br />е¦‚йњЂеЌЏеЉ©и®ѕе®љж€–жњ‰й—®йў�иЇ·е’ЁиЇўж€‘д»¬зљ„и®Ёи®єеЊє <a href="https://joobi.co" target="_blank">https://joobi.co</a>');
// sending settings
define('_JNEWS_PAUSEX', 'жЇЏи®ѕе®љж•°й‡Џз”µй‚®з­‰еѕ…пЅ�з§’');
define('_JNEWS_PAUSEX_TIPS', 'иѕ“е…Ґ jNews е°†дјљз»™дє€ SMTP жњЌеЉЎе™ЁењЁж‰§иЎЊдё‹дёЂи®ѕе®љж•°й‡Џи®ЇжЃЇе‰ЌеЏ‘йЂЃи®ЇжЃЇзљ„ж—¶й—ґз§’ж•°.');
define('_JNEWS_EMAIL_BET_PAUSE', 'з”µй‚®д№‹й—ґжљ‚еЃњ');
define('_JNEWS_EMAIL_BET_PAUSE_TIPS', 'жљ‚еЃње‰Ќи¦ЃеЏ‘йЂЃзљ„з”µй‚®ж•°з›®.');
define('_JNEWS_WAIT_USER_PAUSE', 'жљ‚еЃњж—¶з­‰еѕ…з”Ёж€·иѕ“е…Ґ');
define('_JNEWS_WAIT_USER_PAUSE_TIPS', 'еЅ“й‚®д»¶з»„д№‹й—ґжљ‚еЃњж—¶зЁ‹еєЏж�Їеђ¦еє”з­‰еѕ…з”Ёж€·иѕ“е…Ґ.');
define('_JNEWS_SCRIPT_TIMEOUT', 'зЁ‹еєЏйЂѕж—¶');
define('_JNEWS_SCRIPT_TIMEOUT_TIPS', 'зЁ‹еєЏеЏЇж‰§иЎЊе€†й’џж—¶ж•°пј€пјђд»ЈиЎЁдёЌй™ђпј‰.');
// Stats settings
define('_JNEWS_ENABLE_READ_STATS', 'е…Ѓи®ёй�…иЇ»з»џи®Ў');
define('_JNEWS_ENABLE_READ_STATS_TIPS', 'е¦‚дЅ жѓізєЄеЅ•жЈЂи§†ж•°з›®, йЂ‰ж‹©гЂЊж�ЇгЂЌ. ж­¤жЉЂжњЇеЏЄеЏЇз”ЁдєЋ html й‚®д»¶');
define('_JNEWS_LOG_VIEWSPERSUB', 'зєЄеЅ•жЇЏдЅЌи®ўй�…иЂ…жЈЂи§†');
define('_JNEWS_LOG_VIEWSPERSUB_TIPS', 'е¦‚дЅ жѓізєЄеЅ•жЇЏдЅЌи®ўй�…иЂ…зљ„жЈЂи§†ж•°з›®, йЂ‰ж‹©гЂЊж�ЇгЂЌ. ж­¤жЉЂжњЇеЏЄеЏЇз”ЁдєЋ html й‚®д»¶');
// Logs settings
define('_JNEWS_DETAILED', 'иЇ¦з»†зєЄеЅ•');
define('_JNEWS_SIMPLE', 'з®ЂеЌ•зєЄеЅ•');
define('_JNEWS_DIAPLAY_LOG', 'ж�ѕз¤єзєЄеЅ•');
define('_JNEWS_DISPLAY_LOG_TIPS', 'е¦‚дЅ жѓіењЁеЏ‘йЂЃй‚®д»¶ж—¶ж�ѕз¤єзєЄеЅ•, йЂ‰ж‹©гЂЊж�ЇгЂЌ.');
define('_JNEWS_SEND_PERF_DATA', 'еЏ‘йЂЃж•€иѓЅ');
define('_JNEWS_SEND_PERF_DATA_TIPS', 'е¦‚дЅ жѓіе…Ѓи®ё jNews еЏ‘йЂЃдЅ зљ„и®ѕе®љгЂЃжё…еЌ•дёЉи®ўй�…иЂ…ж•°з›®еЏЉеЏ‘йЂЃй‚®д»¶ж‰Ђж¶€иЂ—ж—¶й—ґзљ„ж�µеђЌжЉҐе‘Љ, йЂ‰ж‹©гЂЊж�ЇгЂЌ. иї™и®©ж€‘д»¬ж›ґдє†и§Ј jNews зљ„ж•€иѓЅеЏЉеё®еЉ©ж€‘д»¬ж”№иї› jNews е°†жќҐзљ„ејЂеЏ‘.');
define('_JNEWS_SEND_AUTO_LOG', 'еЏ‘йЂЃи‡ЄеЉЁеє”з­”зєЄеЅ•');
define('_JNEWS_SEND_AUTO_LOG_TIPS', 'е¦‚дЅ жѓіжЇЏж¬Ўж‰§иЎЊжЋ’зЁ‹ж—¶еЏ‘йЂЃз”µй‚®зєЄеЅ•, йЂ‰ж‹©гЂЊж�ЇгЂЌ.  и­¦е‘Љ: иї™еЏЇеЇји‡ґе¤§й‡Џз”µй‚®.');
define('_JNEWS_SEND_LOG', 'еЏ‘йЂЃзєЄеЅ•');
define('_JNEWS_SEND_LOG_TIPS', 'ж�Їеђ¦з”µй‚®й‚®д»¶зєЄеЅ•е€°еЏ‘йЂЃй‚®д»¶зљ„з”Ёж€·зљ„з”µй‚®ењ°еќЂ.');
define('_JNEWS_SEND_LOGDETAIL', 'еЏ‘йЂЃиЇ¦з»†зєЄеЅ•');
define('_JNEWS_SEND_LOGDETAIL_TIPS', 'иЇ¦з»†зєЄеЅ•еЊ…ж‹¬жЇЏдЅЌи®ўй�…иЂ…зљ„ж€ђеЉџеЏЉе¤±иґҐдїЎжЃЇеЏЉдїЎжЃЇж¦‚и§€. з®ЂеЌ•зєЄеЅ•еЏЄеЏ‘йЂЃж¦‚и§€.');
define('_JNEWS_SEND_LOGCLOSED', 'е¦‚иЃ”жњєе…ій—­еЏ‘йЂЃзєЄеЅ•');
define('_JNEWS_SEND_LOGCLOSED_TIPS', 'жњ‰дє†ж­¤йЂ‰йЎ№, еЏ‘йЂЃй‚®д»¶зљ„з”Ёж€·д»ЌдјљжЋҐж”¶е€°жЉҐе‘Љз”µй‚®.');
define('_JNEWS_SAVE_LOG', 'е‚Ёе­�зєЄеЅ•');
define('_JNEWS_SAVE_LOG_TIPS', 'ж�Їеђ¦й™„еЉ й‚®д»¶зєЄеЅ•е€°зєЄеЅ•ж–‡д»¶.');
define('_JNEWS_SAVE_LOGDETAIL', 'е‚Ёе­�иЇ¦з»†зєЄеЅ•');
define('_JNEWS_SAVE_LOGDETAIL_TIPS', 'иЇ¦з»†зєЄеЅ•еЊ…ж‹¬жЇЏдЅЌи®ўй�…иЂ…зљ„ж€ђеЉџеЏЉе¤±иґҐдїЎжЃЇеЏЉдїЎжЃЇж¦‚и§€. з®ЂеЌ•зєЄеЅ•еЏЄеЏ‘йЂЃж¦‚и§€.');
define('_JNEWS_SAVE_LOGFILE', 'е‚Ёе­�зєЄеЅ•ж–‡д»¶');
define('_JNEWS_SAVE_LOGFILE_TIPS', 'зєЄеЅ•дїЎжЃЇж‰Ђй™„еЉ е€°зљ„жЎЈжЎ€. ж­¤жЎЈжЎ€еЏЇиѓЅеЏ�еѕ—еѕ€е¤§.');
define('_JNEWS_CLEAR_LOG', 'жё…й™¤зєЄеЅ•');
define('_JNEWS_CLEAR_LOG_TIPS', 'жё…й™¤зєЄеЅ•ж–‡д»¶.');

### control panel
define('_JNEWS_CP_LAST_QUEUE', 'жњЂеђЋж‰§иЎЊжЋ’зЁ‹');
define('_JNEWS_CP_TOTAL', 'еђ€е…±');
define('_JNEWS_MAILING_COPY', 'ж€ђеЉџе¤Ќе€¶й‚®д»¶пјЃ');

// Miscellaneous settings
define('_JNEWS_SHOW_GUIDE', 'ж�ѕз¤єжЊ‡еЌ—');
define('_JNEWS_SHOW_GUIDE_TIPS', 'ењЁејЂе§‹ж—¶ж�ѕз¤єжЊ‡еЌ—еЌЏеЉ©ж–°з”Ёж€·е»єз«‹з”µе­ђжЉҐ, и‡ЄеЉЁеє”з­”еЏЉж­ЈзЎ®ењ°и®ѕе®љ jNews.');
define('_JNEWS_AUTOS_ON', 'дЅїз”Ёи‡ЄеЉЁеє”з­”');
define('_JNEWS_AUTOS_ON_TIPS', 'е¦‚дЅ дёЌжѓідЅїз”Ёи‡ЄеЉЁеє”з­”, йЂ‰ж‹©гЂЊеђ¦гЂЌ, ж‰Ђжњ‰и‡ЄеЉЁеє”з­”йЂ‰йЎ№е°†дјље…ій—­.');
define('_JNEWS_NEWS_ON', 'дЅїз”Ёз”µе­ђжЉҐ');
define('_JNEWS_NEWS_ON_TIPS', 'е¦‚дЅ дёЌжѓідЅїз”Ёз”µе­ђжЉҐ, йЂ‰ж‹©гЂЊеђ¦гЂЌ, ж‰Ђжњ‰з”µе­ђжЉҐйЂ‰йЎ№е°†дјље…ій—­.');
define('_JNEWS_SHOW_TIPS', 'ж�ѕз¤єжЏђз¤є');
define('_JNEWS_SHOW_TIPS_TIPS', 'ж�ѕз¤єжЏђз¤є, еЌЏеЉ©з”Ёж€·ж›ґжњ‰ж•€ењ°дЅїз”Ё jNews.');
define('_JNEWS_SHOW_FOOTER', 'ж�ѕз¤єи„љжіЁ');
define('_JNEWS_SHOW_FOOTER_TIPS', 'ж�Їеђ¦ж�ѕз¤єи„љжіЁз‰€жќѓйЂље‘Љ.');
define('_JNEWS_SHOW_LISTS', 'ењЁе‰ЌеЏ°ж�ѕз¤єе€—иЎЁ');
define('_JNEWS_SHOW_LISTS_TIPS', 'еЅ“з”Ёж€·жњЄжіЁе†Њж—¶ж�ѕз¤єд»–д»¬еЏЇи®ўй�…зљ„з”µе­ђжЉҐе€—иЎЁеЏЉе°Ѓе­�жЊ‰й’®ж€–з®ЂеЌ•ењ°ж�ѕз¤єз™»е…ҐзЄ—дЅ“и®©д»–д»¬жіЁе†Њ.');
define('_JNEWS_CONFIG_UPDATED', 'и®ѕе®љиЇ¦жѓ…е·Іж›ґж–°пјЃ');
define('_JNEWS_UPDATE_URL', 'ж›ґж–°зЅ‘еќЂ');
define('_JNEWS_UPDATE_URL_WARNING', 'и­¦е‘ЉпјЃй™¤йќћж�Ї jNews жЉЂжњЇе›ўй�џжЏђе‡єпјЊеђ¦е€™дёЌи¦ЃеЏ�ж›ґж­¤зЅ‘еќЂ.<br />');
define('_JNEWS_UPDATE_URL_TIPS', 'дѕ‹е¦‚пјљhttps://joobi.co/update/пј€еЊ…ж‹¬з»“е°ѕж–њзєїпј‰');

// module
define('_JNEWS_EMAIL_INVALID', 'ж‰Ђиѕ“е…Ґзљ„з”µй‚®ж— ж•€.');
define('_JNEWS_REGISTER_REQUIRED', 'ењЁдЅ и®ўй�…жё…еЌ•е‰ЌиЇ·е…€е€°зЅ‘з«™жіЁе†Њ.');

// Access level box
define('_JNEWS_OWNER', 'жё…еЌ•е»єз«‹иЂ…:');
define('_JNEWS_ACCESS_LEVEL', 'и®ѕе®љжё…еЌ•е­�еЏ–е±‚зє§');
define('_JNEWS_ACCESS_LEVEL_OPTION', 'е­�еЏ–е±‚зє§йЂ‰йЎ№');
define('_JNEWS_USER_LEVEL_EDIT', 'йЂ‰ж‹©е“ЄдёЄз”Ёж€·е±‚зє§е…Ѓи®ёзј–иѕ‘й‚®д»¶ (д»Ће‰ЌеЏ°ж€–еђЋеЏ°) ');

//  drop down options
define('_JNEWS_AUTO_DAY_CH1', 'жЇЏж—Ґ');
define('_JNEWS_AUTO_DAY_CH2', 'жЇЏж—ҐпјЊй™¤дє†е‘Ёжњ«');
define('_JNEWS_AUTO_DAY_CH3', 'жЇЏдёЂе…¶д»–ж—Ґе­ђ');
define('_JNEWS_AUTO_DAY_CH4', 'жЇЏдёЂе…¶д»–ж—Ґе­ђ, й™¤дє†е‘Ёжњ«');
define('_JNEWS_AUTO_DAY_CH5', 'жЇЏе‘Ё');
define('_JNEWS_AUTO_DAY_CH6', 'еЏЊе‘Ё');
define('_JNEWS_AUTO_DAY_CH7', 'жЇЏжњ€');
define('_JNEWS_AUTO_DAY_CH9', 'жЇЏе№ґ');
define('_JNEWS_AUTO_OPTION_NONE', 'ж— ');
define('_JNEWS_AUTO_OPTION_NEW', 'ж–°з”Ёж€·');
define('_JNEWS_AUTO_OPTION_ALL', 'ж‰Ђжњ‰з”Ёж€·');

//
define('_JNEWS_UNSUB_MESSAGE', 'еЏ–ж¶€и®ўй�…з”µй‚®');
define('_JNEWS_UNSUB_SETTINGS', 'еЏ–ж¶€и®ўй�…и®ѕе®љ');
define('_JNEWS_AUTO_ADD_NEW_USERS', 'и‡ЄеЉЁи®ўй�…з”Ёж€·?');

// Update and upgrade messages
define('_JNEWS_NO_UPDATES', 'жљ‚ж—¶жІЎжњ‰еЏЇз”Ёж›ґж–°.');
define('_JNEWS_VERSION', 'jNews з‰€жњ¬');
define('_JNEWS_NEED_UPDATED', 'йњЂи¦Ѓж›ґж–°зљ„жЎЈжЎ€:');
define('_JNEWS_NEED_ADDED', 'йњЂи¦Ѓж–°еўћзљ„жЎЈжЎ€пјљ');
define('_JNEWS_NEED_REMOVED', 'йњЂи¦Ѓз§»й™¤зљ„жЎЈжЎ€пјљ');
define('_JNEWS_FILENAME', 'ж–‡д»¶еђЌпјљ');
define('_JNEWS_CURRENT_VERSION', 'зЋ°ењЁз‰€жњ¬пјљ');
define('_JNEWS_NEWEST_VERSION', 'жњЂж–°з‰€жњ¬пјљ');
define('_JNEWS_UPDATING', 'ж›ґж–°дё­');
define('_JNEWS_UPDATE_UPDATED_SUCCESSFULLY', 'жЎЈжЎ€ж€ђеЉџж›ґж–°.');
define('_JNEWS_UPDATE_FAILED', 'ж›ґж–°е¤±иґҐпјЃ');
define('_JNEWS_ADDING', 'ж–°еўћдё­');
define('_JNEWS_ADDED_SUCCESSFULLY', 'ж–°еўћж€ђеЉџ.');
define('_JNEWS_ADDING_FAILED', 'ж–°еўће¤±иґҐпјЃ');
define('_JNEWS_REMOVING', 'з§»й™¤дё­');
define('_JNEWS_REMOVED_SUCCESSFULLY', 'з§»й™¤ж€ђеЉџ.');
define('_JNEWS_REMOVING_FAILED', 'з§»й™¤е¤±иґҐпјЃ');
define('_JNEWS_INSTALL_DIFFERENT_VERSION', 'е®‰иЈ…дёЌеђЊз‰€жњ¬');
define('_JNEWS_CONTENT_ADD', 'ж–°еўће†…е®№');
define('_JNEWS_UPGRADE_FROM', 'ж±‡е…Ґж•°жЌ®пј€з”µе­ђжЉҐеЏЉи®ўй�…иЂ…дїЎжЃЇпј‰и‡Є ');
define('_JNEWS_UPGRADE_MESS', 'ж­¤зЁ‹еєЏеЏЄз®ЂеЌ•ењ°ж±‡е…Ґж•°жЌ®е€° jNews ж•°жЌ®еє“. <br /> еЇ№дЅ зЋ°е­�зљ„ж•°жЌ®дёЌдјљжћ„ж€ђйЈЋй™©.');
define('_JNEWS_CONTINUE_SENDING', 'з»§з»­еЏ‘йЂЃ');

// jNews message
define('_JNEWS_UPGRADE1', 'дЅ еЏЇд»Ґз®Ђж�“ењ°дєЋж›ґж–°жЋ§е€¶йќўжќїж±‡е…ҐдЅ зљ„з”Ёж€·еЏЉз”µе­ђжЉҐд»Ћ ');
define('_JNEWS_UPGRADE2', ' е€° jNews.');
define('_JNEWS_UPDATE_MESSAGE', 'жњ‰ж–°з‰€жњ¬зљ„ jNewsпјЃ');
define('_JNEWS_UPDATE_MESSAGE_LINK', 'з‚№е‡»иї™й‡Њж›ґж–°!');
define('_JNEWS_THANKYOU', 'е¤љи°ўйЂ‰ж‹© jNews, дЅ зљ„йЂљи®Їж‹Ќж–‡д»¶пјЃ');
define('_JNEWS_NO_SERVER', 'ж›ґж–°жњЌеЉЎе™Ёжљ‚еЃњ, иЇ·зЁЌеђЋе†Ќе°ќиЇ•.');
define('_JNEWS_MOD_PUB', 'jNews жЁЎеќ—жњЄеЏ‘еёѓ.');
define('_JNEWS_MOD_PUB_LINK', 'з‚№е‡»иї™й‡ЊеЏ‘еёѓе®ѓпјЃ');
define('_JNEWS_IMPORT_SUCCESS', 'ж€ђеЉџж±‡е…Ґ');
define('_JNEWS_IMPORT_EXIST', 'и®ўй�…иЂ…е·Із»ЏдєЋж•°жЌ®еє“');

// jNews Install
define('_JNEWS_INSTALL_CONFIG', 'jNews и®ѕе®љ');
define('_JNEWS_INSTALL_SUCCESS', 'е®‰иЈ…ж€ђеЉџ');
define('_JNEWS_INSTALL_ERROR', 'е®‰иЈ…й”™иЇЇ');
define('_JNEWS_INSTALL_BOT', 'jNews жЏ’д»¶пј€Botпј‰');
define('_JNEWS_INSTALL_MODULE', 'jNews жЁЎеќ—');
//Others
define('_JNEWS_JAVASCRIPT','!и­¦е‘Љ! Javascript еї…йЎ»еђЇз”Ёж‰ЌеЏЇж­ЈеёёиїђдЅњ.');
define('_JNEWS_EXPORT_TEXT','и®ўй�…иЂ…ж�ЇеџєдєЋдЅ ж‰ЂйЂ‰жё…еЌ•еЇје‡є. <br />еЇје‡єи®ўй�…иЂ…е€°жё…еЌ•');
define('_JNEWS_IMPORT_TIPS','ж±‡е…Ґи®ўй�…иЂ…. жЎЈжЎ€е†…дїЎжЃЇйњЂи¦Ѓж�Їд»Ґдё‹ж јејЏ: <br />' .
		'еђЌз§°,з”µй‚®,жЋҐж”¶HTML(1/0),<span style="color: rgb(255, 0, 0);">е·ІзЎ®е®љ(1/0)</span>');
define('_JNEWS_SUBCRIBER_EXIT', 'е·Із»Џж�Їи®ўй�…иЂ…');
define('_JNEWS_GET_STARTED', 'з‚№е‡»иї™й‡ЊејЂе§‹!');

//News since 1.0.1
define('_JNEWS_WARNING_1011','и­¦е‘Љ: 1011: е› дЅ зљ„жњЌеЉЎе™Ёй™ђе€¶дёЌиѓЅж›ґж–°.');
define('_JNEWS_SEND_MAIL_FROM_TIPS', 'йЂ‰ж‹©еЏ‘д»¶дєєж�ѕз¤єе“ЄдёЄз”µй‚®ењ°еќЂ.');
define('_JNEWS_SEND_MAIL_NAME_TIPS', 'йЂ‰ж‹©еЏ‘д»¶дєєж�ѕз¤єд»Ђд№€еђЌз§°.');
define('_JNEWS_MAILSENDMETHOD_TIPS', 'йЂ‰ж‹©дЅїз”Ёе“ЄдёЄй‚®д»¶ж”¶еЏ‘жњє: PHP й‚®еЇ„еЉџиѓЅ, <span>Sendmail</span> ж€– SMTP жњЌеЉЎе™Ё.');
define('_JNEWS_SENDMAILPATH_TIPS', 'иї™ж�Їй‚®д»¶жњЌеЉЎе™Ёз›®еЅ•');
define('_JNEWS_LIST_T_TEMPLATE', 'дё»йў�');
define('_JNEWS_NO_MAILING_ENTERED', 'ж— жЏђдѕ›еЇ„д»¶');
define('_JNEWS_NO_LIST_ENTERED', 'ж— жЏђдѕ›жё…еЌ•');
define('_JNEWS_SENT_MAILING' , 'е·ІеЏ‘йЂЃй‚®д»¶');
define('_JNEWS_SELECT_FILE', 'иЇ·йЂ‰ж‹©жЎЈжЎ€ ');
define('_JNEWS_LIST_IMPORT', 'жЈЂжџҐдЅ жѓідёЋи®ўй�…иЂ…е…іиЃ”иїћзљ„жё…еЌ•.');
define('_JNEWS_PB_QUEUE', 'и®ўй�…иЂ…е·ІжЏ’е…ҐдЅ†иїћжЋҐе®ѓе€°жё…еЌ•ж—¶е‡єзЋ°й—®йў�. иЇ·ж‰‹еЉЁжЈЂжџҐ.');
define('_JNEWS_UPDATE_MESS' , '');
define('_JNEWS_UPDATE_MESS1' , 'ејєзѓ€е»єи®®ж›ґж–°пјЃ');
define('_JNEWS_UPDATE_MESS2' , 'иЎҐдёЃеЏЉиЅ»еѕ®дї®ж­Ј.');
define('_JNEWS_UPDATE_MESS3' , 'ж–°з‰€жњ¬.');
define('_JNEWS_UPDATE_MESS5' , 'ж›ґж–°йњЂи¦Ѓ Joomla 1.5.');
define('_JNEWS_UPDATE_IS_AVAIL' , ' е·Із»ЏжЋЁе‡є!');
define('_JNEWS_NO_MAILING_SENT', 'ж— еЏ‘йЂЃй‚®д»¶!');
define('_JNEWS_SHOW_LOGIN', 'ж�ѕз¤єз™»е…ҐзЄ—дЅ“');
define('_JNEWS_SHOW_LOGIN_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌдєЋ jNews жЋ§е€¶йќўжќїе‰ЌеЏ°ж�ѕз¤єз™»е…ҐзЄ—дЅ“дЅїз”Ёж€·иѓЅжіЁе†Ње€°зЅ‘з«™.');
define('_JNEWS_LISTS_EDITOR', 'е€—е‡єжЏЏиї°зј–иѕ‘');
define('_JNEWS_LISTS_EDITOR_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌдЅїз”Ё HTML зј–иѕ‘е™Ёзј–иѕ‘жё…еЌ•жЏЏиї°ж Џ.');
define('_JNEWS_SUBCRIBERS_VIEW', 'жЈЂи§†и®ўй�…иЂ…');

//News since 1.0.2
define('_JNEWS_FRONTEND_SETTINGS' , 'е‰ЌеЏ°и®ѕе®љ' );
define('_JNEWS_SHOW_LOGOUT', 'ж�ѕз¤єжіЁй”ЂжЊ‰й’®');
define('_JNEWS_SHOW_LOGOUT_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌењЁе‰ЌеЏ° jNews жЋ§е€¶йќўжќїж�ѕз¤єжіЁй”ЂжЊ‰й’®.');

//News since 1.0.3 CB integration
define('_JNEWS_CONFIG_INTEGRATION', 'ж•ґеђ€');
define('_JNEWS_CB_INTEGRATION', 'Community Builder ж•ґеђ€');
define('_JNEWS_INSTALL_PLUGIN', 'Community Builder жЏ’д»¶пј€jNews ж•ґеђ€пј‰');
define('_JNEWS_CB_PLUGIN_NOT_INSTALLED', 'жњЄе®‰иЈ… jNews зљ„ Community Builder жЏ’д»¶!');
define('_JNEWS_CB_PLUGIN', 'дєЋжіЁе†ЊиЎЁж�ѕз¤єе€—иЎЁ');
define('_JNEWS_CB_PLUGIN_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌдєЋ community builder жіЁе†ЊиЎЁж јж�ѕз¤єй‚®д»¶е€—иЎЁ');
define('_JNEWS_CB_LISTS', 'жё…еЌ• ID');
define('_JNEWS_CB_LISTS_TIPS', 'иї™ж�Їеї…еЎ«е­—ж®µ. д»ҐйЂ—еЏ·е€†йљ”иѕ“е…ҐдЅ жѓіе…Ѓи®ёз”Ёж€·и®ўй�…зљ„е€—иЎЁзљ„ id еЏ·з Ѓ (0 ж�ѕз¤єж‰Ђжњ‰е€—иЎЁ)');
define('_JNEWS_CB_INTRO', 'д»‹з»Ќж–‡е­—');
define('_JNEWS_CB_INTRO_TIPS', 'е€—иЎЁе€—е‡єе‰Ќе°†ж�ѕз¤єзљ„ж–‡е­—. з•™з©єе€™дёЌж�ѕз¤єд»»дЅ•ж–‡е­—.  дЅ еЏЇдЅїз”Ё HTML ж ‡з­ѕи‡Єе®љд№‰е¤–и§‚еЏЉж„џи§‰.');
define('_JNEWS_CB_SHOW_NAME', 'ж�ѕз¤єе€—иЎЁеђЌз§°');
define('_JNEWS_CB_SHOW_NAME_TIPS', 'йЂ‰ж‹©з®Ђд»‹еђЋж�Їеђ¦ж�ѕз¤єе€—иЎЁеђЌз§°.');
define('_JNEWS_CB_LIST_DEFAULT', 'й»�и®¤е‰”йЂ‰жё…еЌ•');
define('_JNEWS_CB_LIST_DEFAULT_TIPS', 'йЂ‰ж‹©ж�Їеђ¦и®©жЇЏдёЄжё…еЌ•зљ„ж–№еќ—й»�и®¤дёєе·Із‚№йЂ‰.');
define('_JNEWS_CB_HTML_SHOW', 'ж�ѕз¤єжЋҐж”¶ HTML');
define('_JNEWS_CB_HTML_SHOW_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌе…Ѓи®ёз”Ёж€·е†іе®љд»–д»¬жѓіжЋҐж”¶ HTML з”µй‚®дёЋеђ¦. йЂ‰ж‹©гЂЊеђ¦гЂЌдЅїз”Ёйў„и®ѕжЋҐж”¶ html.');
define('_JNEWS_CB_HTML_DEFAULT', 'йў„и®ѕжЋҐж”¶ HTML');
define('_JNEWS_CB_HTML_DEFAULT_TIPS', 'и®ѕе®љж­¤йЎ№ж�ѕз¤єй»�и®¤ html й‚®д»¶и®ѕе®љ. е¦‚ж�ѕз¤єжЋҐж”¶ HTML и®ѕе®љдёєгЂЊеђ¦гЂЌж­¤йЂ‰йЎ№е°†дёєй»�и®¤.');

// Since 1.0.4
define('_JNEWS_BACKUP_FAILED', 'дёЌиѓЅе¤‡д»Ѕж–‡д»¶! жЎЈжЎ€жІЎжњ‰иў«ж›їд»Ј.');
define('_JNEWS_BACKUP_YOUR_FILES', 'жЎЈжЎ€зљ„ж—§з‰€жњ¬е·Іе¤‡д»Ѕе€°д»Ґдё‹з›®еЅ•:');
define('_JNEWS_SERVER_LOCAL_TIME', 'жњЌеЉЎе™Ёжњ¬жњєж—¶й—ґ');
define('_JNEWS_SHOW_ARCHIVE', 'ж�ѕз¤єе°Ѓе­�жЊ‰й’®');
define('_JNEWS_SHOW_ARCHIVE_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌдєЋе‰ЌеЏ°з”µе­ђжЉҐе€—иЎЁж�ѕз¤єе°Ѓе­�жЊ‰й’®');
define('_JNEWS_LIST_OPT_TAG', 'ж ‡з­ѕ');
define('_JNEWS_LIST_OPT_IMG', 'е›ѕеѓЏ');
define('_JNEWS_LIST_OPT_CTT', 'е†…е®№');
define('_JNEWS_INPUT_NAME_TIPS', 'иѕ“е…ҐдЅ зљ„е…ЁеђЌпј€еђЌе­—е…€пј‰');
define('_JNEWS_IP_TIPS', 'IP of the subscriber' );
define('_JNEWS_INPUT_EMAIL_TIPS', 'иѕ“е…ҐдЅ зљ„з”µй‚®ењ°еќЂпј€е¦‚дЅ жѓіжЋҐж”¶ж€‘д»¬зљ„й‚®д»¶, иЇ·зЎ®е®љиї™ж�Їжњ‰ж•€зљ„з”µй‚®ењ°еќЂ.пј‰');
define('_JNEWS_RECEIVE_HTML_TIPS', 'е¦‚дЅ жѓіжЋҐж”¶ HTML й‚®д»¶, йЂ‰ж‹©гЂЊж�ЇгЂЌпјЌзєЇж–‡жњ¬й‚®д»¶пјЊйЂ‰ж‹©гЂЊеђ¦гЂЌ');
define('_JNEWS_TIME_ZONE_ASK_TIPS', 'жЊ‡е®љдЅ зљ„ж—¶еЊє.');

// Since 1.0.5
define('_JNEWS_FILES' , 'жЎЈжЎ€');
define('_JNEWS_FILES_UPLOAD' , 'дёЉиЅЅ');
define('_JNEWS_MENU_UPLOAD_IMG' , 'дёЉиЅЅе›ѕеѓЏ');
define('_JNEWS_TOO_LARGE' , 'жЎЈжЎ€е¤Єе¤§. жњЂе¤§й™ђе€¶ж�Ї');
define('_JNEWS_MISSING_DIR' , 'з›®зљ„ењ°з›®еЅ•дёЌе­�ењЁ');
define('_JNEWS_IS_NOT_DIR' , 'з›®зљ„ењ°з›®еЅ•дёЌе­�ењЁж€–ж�Їж™®йЂљжЎЈжЎ€.');
define('_JNEWS_NO_WRITE_PERMS' , 'з›®зљ„ењ°з›®еЅ•жІЎжњ‰е†™е…Ґжќѓй™ђ.');
define('_JNEWS_NO_USER_FILE' , 'дЅ жІЎжњ‰йЂ‰ж‹©и¦ЃдёЉиЅЅзљ„жЎЈжЎ€.');
define('_JNEWS_E_FAIL_MOVE' , 'дёЌеЏЇиѓЅз§»еЉЁжЎЈжЎ€.');
define('_JNEWS_FILE_EXISTS' , 'з›®зљ„ењ°жЎЈжЎ€е·Із»Џе­�ењЁ.');
define('_JNEWS_CANNOT_OVERWRITE' , 'з›®зљ„ењ°жЎЈжЎ€е·Іе­�ењЁеЏЉдёЌиѓЅиў«и¦†з›–.');
define('_JNEWS_NOT_ALLOWED_EXTENSION' , 'ж–‡д»¶з±»ећ‹дёЌиў«е…Ѓи®ё.');
define('_JNEWS_PARTIAL' , 'жЎЈжЎ€еЏЄж�ЇйѓЁд»Ѕиў«дёЉиЅЅ.');
define('_JNEWS_UPLOAD_ERROR' , 'дёЉиЅЅй”™иЇЇ:');
define('_JNEWS_DEV_NO_DEF_FILE' , 'жЎЈжЎ€еЏЄж�ЇйѓЁд»Ѕиў«дёЉиЅЅ.');

// already exist but modified  added a <br/ on first line and added [SUBSCRIPTIONS] line>
define('_JNEWS_CONTENTREP', '{tag:subscriptions} = е®ѓдјљиў«и®ўй�…иїћз»“еЏ–д»Ј.' .
		' иї™ж�Ї <strong>еї…еЎ«зљ„</strong> jNews ж‰ЌиѓЅж­ЈеёёиїђдЅњ.<br />' .
		'е¦‚дЅ ењЁж­¤ж–№еќ—ж”ѕзЅ®е…¶д»–е†…е®№, е®ѓдјљењЁж‰Ђжњ‰з›ёеє”е€°ж­¤е€—иЎЁзљ„й‚®д»¶е†…ж�ѕз¤є.' .
		' <br />ж–°еўћдЅ зљ„и®ўй�…и®ЇжЃЇдєЋз»“е°ѕ.  jNews дјљи‡ЄеЉЁдёєи®ўй�…иЂ…ж–°еўћеЏ�ж›ґдїЎжЃЇеЏЉеЏ–ж¶€и®ўй�…й“ѕжЋҐ.');

// since 1.0.6
define('_JNEWS_NOTIFICATION', 'йЂљзџҐ');  // shortcut for Email notification
define('_JNEWS_NOTIFICATIONS', 'йЂљзџҐ');
define('_JNEWS_USE_SEF', 'дєЋй‚®д»¶ејЂеђЇеЏ‹е–„жђњеЇ»');
define('_JNEWS_USE_SEF_TIPS', 'е»єи®®дЅ йЂ‰ж‹©гЂЊеђ¦гЂЌ.  дЅ†е¦‚дЅ жѓідЅ зљ„й‚®д»¶ж‰ЂеЊ…еђ«зљ„зЅ‘еќЂйѓЅдЅїз”Ё SEF, е€™йЂ‰ж‹©гЂЊж�ЇгЂЌ.' .
		' <br /><b>й“ѕжЋҐењЁдё¤з§ЌйЂ‰йЎ№дё‹еќ‡еЏЇиїђдЅњ.  йЂ‰ж‹©гЂЊеђ¦гЂЌзЎ®дїќй‚®д»¶дё­иїћз»“жЂ»ж�ЇиїђдЅњ, еЌідЅїдЅ еЏ�ж›ґдє†дЅ зљ„ SEF.</b> ');
define('_JNEWS_ERR_NB' , 'й”™иЇЇ #: ERR');
define('_JNEWS_ERR_SETTINGS', 'й”™иЇЇе¤„зђ†и®ѕе®љ');
define('_JNEWS_ERR_SEND' ,'еЏ‘йЂЃй”™иЇЇжЉҐе‘Љ');
define('_JNEWS_ERR_SEND_TIPS' ,'е¦‚дЅ жѓі jNews ж›ґе®Ње–„иЇ·йЂ‰ж‹©гЂЊж�ЇгЂЌ.  е®ѓдјљеЏ‘йЂЃй”™иЇЇжЉҐе‘Љз»™ж€‘д»¬.  ж•…ж­¤дЅ з”љи‡ідёЌйњЂи¦Ѓе†ЌжЉҐе‘Љи‡­и™« ;-) <br /> <b>дёЌдјљеЏ‘йЂЃд»»дЅ•з§ЃдєєдїЎжЃЇ</b>.  ж€‘д»¬з”љи‡ідёЌзџҐйЃ“й”™иЇЇд»Ће“ЄдёЄзЅ‘еќЂйЂЃжќҐ. ж€‘д»¬еЏЄеЏ‘йЂЃе…ідєЋ jNews зљ„дїЎжЃЇ, PHP и®ѕе®љеЏЉ SQL иЇўй—®. ');
define('_JNEWS_ERR_SHOW_TIPS' ,'йЂ‰ж‹©гЂЊж�ЇгЂЌдєЋе±Џе№•ж�ѕз¤єй”™иЇЇзј–еЏ·.  дё»и¦Ѓз”ЁдЅњй™¤й”™дЅњз”Ё. ');
define('_JNEWS_ERR_SHOW' ,'ж�ѕз¤єй”™иЇЇ');
define('_JNEWS_LIST_SHOW_UNSUBCRIBE', 'ж�ѕз¤єеЏ–ж¶€и®ўй�…й“ѕжЋҐ');
define('_JNEWS_LIST_SHOW_UNSUBCRIBE_TIPS', 'йЂ‰ж‹©гЂЊж�ЇгЂЌдєЋй‚®д»¶еє•йѓЁж�ѕз¤єеЏ–ж¶€й“ѕжЋҐи®©з”Ёж€·еЏ�ж›ґд»–д»¬зљ„и®ўй�…. <br /> йЂ‰ж‹©гЂЊеђ¦гЂЌе…ій—­и„љжіЁеЏЉиїћз»“.');
define('_JNEWS_UPDATE_INSTALL', '<span style="color: rgb(255, 0, 0);">й‡Ќи¦ЃйЂље‘ЉпјЃ</span> <br />е¦‚дЅ ж�Їд»Ћд№‹е‰Ќзљ„  jNews е®‰иЈ…еЌ‡зє§пјЊдЅ йњЂи¦Ѓз‚№е‡»д»Ґдё‹жЊ‰й’®еЌ‡зє§дЅ зљ„ж•°жЌ®еє“з»“жћ„пј€дЅ зљ„ж•°жЌ®дјље®Њж•ґдїќз•™пј‰');
define('_JNEWS_UPDATE_INSTALL_BTN' , 'еЌ‡зє§иЎЁж јеЏЉи®ѕе®љ');
define('_JNEWS_MAILING_MAX_TIME', 'жњЂе¤§жЋ’зЁ‹ж—¶й—ґ' );
define('_JNEWS_MAILING_MAX_TIME_TIPS', 'е®љд№‰жЇЏз»„жЋ’зЁ‹еЏ‘йЂЃз”µй‚®зљ„жњЂе¤§ж—¶й—ґ. е»єи®®ењЁ 30 з§’и‡і 2 е€†й’џд№‹й—ґ.');

// virtuemart integration beta
define('_JNEWS_VM_INTEGRATION', 'VirtueMart ж•ґеђ€');
define('_JNEWS_VM_COUPON_NOTIF', 'дј�жѓ е€ёйЂљзџҐ ID');
define('_JNEWS_VM_COUPON_NOTIF_TIPS', 'жЊ‡е®љдЅ жѓіз”ЁдЅњеЏ‘йЂЃдј�жѓ е€ёе€°дЅ зљ„йЎѕе®ўзљ„й‚®д»¶ ID еЏ·з Ѓ.');
define('_JNEWS_VM_NEW_PRODUCT', 'ж–°дє§е“ЃйЂљзџҐ ID');
define('_JNEWS_VM_NEW_PRODUCT_TIPS', 'жЊ‡е®љдЅ жѓіз”ЁдЅњеЏ‘йЂЃж–°дє§е“ЃйЂљзџҐзљ„й‚®д»¶ ID еЏ·з Ѓ.');

// since 1.0.8
// create forms for subscriptions
define('_JNEWS_FORM_BUTTON', 'е»єз«‹зЄ—дЅ“');
define('_JNEWS_FORM_COPY', 'HTML зј–з Ѓ');
define('_JNEWS_FORM_COPY_TIPS', 'е¤Ќе€¶ж‰Ђдє§з”џзљ„ HTML зј–з Ѓе€°дЅ зљ„ HTML йЎµ.');
define('_JNEWS_FORM_LIST_TIPS', 'йЂ‰ж‹©дЅ жѓіеЊ…ж‹¬зЄ—дЅ“зљ„е€—иЎЁ');
// update messages
define('_JNEWS_UPDATE_MESS4' , 'дёЌиѓЅи‡ЄеЉЁж›ґж–°.');
define('_JNEWS_WARNG_REMOTE_FILE' , 'дёЌиѓЅеЏ–еѕ—иїњзЁ‹жЎЈжЎ€.');
define('_JNEWS_ERROR_FETCH' , 'йў‰еЏ–жЎЈжЎ€й”™иЇЇ.');

define('_JNEWS_CHECK' , 'жЈЂжџҐ');
define('_JNEWS_MORE_INFO' , 'ж›ґе¤љдїЎжЃЇ');
define('_JNEWS_UPDATE_NEW' , 'ж›ґж–°е€°ж–°з‰€жњ¬');
define('_JNEWS_UPGRADE' , 'еЌ‡зє§е€°ж›ґй«�жЎЈдє§е“Ѓ');
define('_JNEWS_DOWNDATE' , 'иї”е›ћд№‹е‰Ќз‰€жњ¬');
define('_JNEWS_DOWNGRADE' , 'иї”е›ћеџєжњ¬дє§е“Ѓ');
define('_JNEWS_REQUIRE_JOOM' , 'йњЂи¦Ѓ Joomla');
define('_JNEWS_TRY_IT' , 'е°ќиЇ•е®ѓпјЃ');
define('_JNEWS_NEWER', 'иѕѓж–°зљ„');
define('_JNEWS_OLDER', 'иѕѓж—§зљ„');
define('_JNEWS_CURRENT', 'зЋ°ењЁзљ„');

// since 1.0.9
define('_JNEWS_CHECK_COMP', 'е°ќиЇ•е…¶д»–з»„д»¶');
define('_JNEWS_MENU_VIDEO' , 'еЅ±з‰‡ж•™е­¦');
define('_JNEWS_SCHEDULE_TITLE', 'и‡ЄеЉЁж—ҐзЁ‹еЉџиѓЅи®ѕе®љ');
define('_JNEWS_ISSUE_NB_TIPS' , 'еЏ‘иЎЊзј–еЏ·и‡ЄеЉЁз”±зі»з»џдє§з”џ' );
define('_JNEWS_SEL_ALL' , 'ж‰Ђжњ‰й‚®д»¶');
define('_JNEWS_SEL_ALL_SUB' , 'ж‰Ђжњ‰жё…еЌ•');
define('_JNEWS_INTRO_ONLY_TIPS' , 'е¦‚дЅ еЏЄз‚№йЂ‰ж­¤ж–№еќ—, жЏ’е…Ґе€°й‚®д»¶зљ„ж–‡з« з®Ђд»‹е°†дјљй™„жњ‰гЂЊиЇ¦з»†е†…е®№...гЂЌиїћз»“е€°е®Њж•ґж–‡з« .' );
define('_JNEWS_TAGS_TITLE' , 'е†…е®№ж ‡з­ѕ');
define('_JNEWS_TAGS_TITLE_TIPS' , 'е¤Ќе€¶еЏЉиґґдёЉж­¤ж ‡з­ѕе€°й‚®д»¶дё­дЅ жѓіж”ѕзЅ®е†…е®№зљ„дЅЌзЅ®.');
define('_JNEWS_PREVIEW_EMAIL_TEST', 'жЊ‡е®љеЏ‘йЂЃжµ‹иЇ•е€°иї™дёЄз”µй‚®ењ°еќЂ');
define('_JNEWS_PREVIEW_TITLE' , 'йў„и§€');
define('_JNEWS_AUTO_UPDATE' , 'ж›ґж–°йЂљзџҐ');
define('_JNEWS_AUTO_UPDATE_TIPS' , 'е¦‚ж¬ІеЅ“з»„д»¶жњ‰ж›ґж–°ж—¶йЂљзџҐдЅ , йЂ‰ж‹©гЂЊж�ЇгЂЌ. <br />й‡Ќи¦Ѓ!! ж­¤еЉџиѓЅйњЂи¦ЃејЂеђЇжЏђз¤є.');

// since 1.1.0
define('_JNEWS_LICENSE' , 'и®ёеЏЇеЌЏи®®дїЎжЃЇ');

// since 1.1.1
define('_JNEWS_NEW' , 'ж–°');
define('_JNEWS_SCHEDULE_SETUP', 'дЅ йњЂи¦ЃдєЋи®ѕе®љи®ѕе®љж—ҐзЁ‹иЎЁ, ж‰ЌеЏЇеЏ‘йЂЃи‡ЄеЉЁеє”з­”.');
define('_JNEWS_SCHEDULER', 'ж—ҐзЁ‹иЎЁ');
define('_JNEWS_jnews_CRON_DESC' , 'е¦‚дЅ жІЎжњ‰дЅ зЅ‘з«™жЋ’зЁ‹д»»еЉЎз®Ўзђ†е™Ёзљ„и®їй—®жќѓй™ђ, дЅ еЏЇд»ҐжіЁе†Ње…Ќиґ№зљ„ jNews Cron ж€·еЏЈдєЋ:' );
define('_JNEWS_CRON_DOCUMENTATION' , 'дЅ еЏЇд»ҐдєЋд»Ґдё‹зЅ‘еќЂж‰ѕе€°ж›ґе¤љи®ѕе®љ jNews ж—ҐзЁ‹иЎЁж•°жЌ®:');
define('_JNEWS_CRON_DOC_URL' , '<a href="https://joobi.co/index.php?option=com_content&view=article&id=4249&catid=29&Itemid=72"
 target="_blank">https://joobi.co/index.php?option=com_content&Itemid=72&view=category&layout=blog&id=29&limit=60</a>' );
define( '_JNEWS_QUEUE_PROCESSED' , 'ж€ђеЉџж‰§иЎЊжЋ’зЁ‹...' );
define( '_JNEWS_ERROR_MOVING_UPLOAD' , 'з§»еЉЁж±‡е…ҐжЎЈжЎ€й”™иЇЇ' );

//since 1.1.4
define( '_JNEWS_SCHEDULE_FREQUENCY' , 'ж—ҐзЁ‹иЎЁйў‘зЋ‡' );
define( '_JNEWS_CRON_MAX_FREQ' , 'ж—ҐзЁ‹иЎЁжњЂе¤§йў‘зЋ‡' );
define( '_JNEWS_CRON_MAX_FREQ_TIPS' , 'жЊ‡е®љж—ҐзЁ‹иЎЁеЏЇж‰§иЎЊзљ„жњЂе¤§йў‘зЋ‡пј€е€†й’џпј‰.  е®ѓдјљй™ђе€¶ж—ҐзЁ‹иЎЁеЌідЅїжЋ’зЁ‹е·ҐдЅњи®ѕе®љж›ґй«�йў‘зЋ‡.' );
define( '_JNEWS_CRON_MAX_EMAIL' , 'жЇЏд»¶е·ҐдЅњжњЂе¤§з”µй‚®' );
define( '_JNEWS_CRON_MAX_EMAIL_TIPS' , 'жЊ‡е®љжЇЏйЎ№е·ҐдЅњзљ„жњЂе¤§еЏ‘йЂЃз”µй‚®ж•°з›®. If this is set to O the maximim emails per task will be 1' );
define( '_JNEWS_CRON_MINUTES' , ' е€†й’џ' );
define( '_JNEWS_SHOW_SIGNATURE' , 'ж�ѕз¤єз”µй‚®и„љжіЁ' );
define( '_JNEWS_SHOW_SIGNATURE_TIPS' , 'дЅ ж�Їеђ¦жѓідєЋз”µй‚®и„љжіЁжЋЁе№ї jNews.' );
define( '_JNEWS_QUEUE_AUTO_PROCESSED' , 'и‡ЄеЉЁеє”з­”ж€ђеЉџж‰§иЎЊ...' );
define( '_JNEWS_QUEUE_NEWS_PROCESSED' , 'е·ІжЋ’зЁ‹з”µе­ђжЉҐж€ђеЉџж‰§иЎЊ...' );
define( '_JNEWS_MENU_SYNC_USERS' , 'еђЊж­Ґз”Ёж€·' );
define( '_JNEWS_SYNC_USERS_SUCCESS' , 'ж€ђеЉџеђЊж­Ґз”Ёж€·пјЃ' );

// compatibility with Joomla 15
if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'жіЁй”Ђ' );
if (!defined('_CMN_YES')) define( '_CMN_YES', 'ж�Ї' );
if (!defined('_CMN_NO')) define( '_CMN_NO', 'еђ¦' );
if (!defined('_HI')) define( '_HI', 'дЅ еҐЅ' );
if (!defined('_CMN_TOP')) define( '_CMN_TOP', 'йЎ¶йѓЁ' );
if (!defined('_CMN_BOTTOM')) define( '_CMN_BOTTOM', 'еє•йѓЁ' );
//if (!defined('_BUTTON_LOGOUT')) define( '_BUTTON_LOGOUT', 'жіЁй”Ђ' );

// For include title only or full article in content item tab in newsletter edit - p0stman911
define('_JNEWS_TITLE_ONLY_TIPS' , 'е¦‚дЅ йЂ‰ж‹©е®ѓ, еЏЄжњ‰жЏ’е…Ґе€°й‚®д»¶зљ„ж–‡з« ж ‡йў�дјљиїћз»“е€°е®Њж•ґж–‡з« .');
define('_JNEWS_TITLE_ONLY' , 'еЏЄжњ‰ж ‡йў�');
define('_JNEWS_FULL_ARTICLE_TIPS' , 'е¦‚дЅ йЂ‰ж‹©е®ѓ, е®Њж•ґж–‡з« дјљжЏ’е…Ґе€°й‚®д»¶');
define('_JNEWS_FULL_ARTICLE' , 'е®Њж•ґж–‡з« ');
define('_JNEWS_CONTENT_ITEM_SELECT_T', 'йЂ‰ж‹©й™„еЉ е€°и®ЇжЃЇзљ„е†…е®№йЎ№з›®. <br />е¤Ќе€¶еЏЉиґґдёЉ <b>е†…е®№ж ‡з­ѕ</b> е€°й‚®д»¶.  дЅ еЏЇ (е€†е€«ењ°з”Ё 0, 1, ж€– 2) йЂ‰ж‹©е®Њж•ґж–‡з« , еЏЄжњ‰з®Ђд»‹, ж€–еЏЄжњ‰ж ‡йў�. ');
define('_JNEWS_SUBSCRIBE_LIST2', 'й‚®д»¶жё…еЌ•');

// For sorting in content tab by date, section or category
define('_JNEWS_CONTENT_ITEM_SORT', 'Sort by: ');
define('_JNEWS_SORT_DATE' , 'Date');
define('_JNEWS_SORT_DATE_TIPS' , 'If you select this, the contents will be sorted according to date created');
define('_JNEWS_SORT_SECTION' , 'Section');
define('_JNEWS_SORT_SECTION_TIPS' , 'If you select this, the contents will be sorted according to its section');
define('_JNEWS_SORT_CATEGORY' , 'Category');
define('_JNEWS_SORT_CATEGORY_TIPS' , 'If you select this, the contents will be sorted according to its category');
define('_JNEWS_SORT_BUTTON' , 'Sort');


// smart-newsletter function
define('_JNEWS_AUTONEWS', 'ж™єиѓЅ-з”µе­ђжЉҐ');
define('_JNEWS_MENU_AUTONEWS', 'ж™єиѓЅ-з”µе­ђжЉҐ');
define('_JNEWS_AUTO_NEWS_OPTION', 'ж™єиѓЅ-з”µе­ђжЉҐйЂ‰йЎ№');
define('_JNEWS_AUTONEWS_FREQ', 'з”µе­ђжЉҐйў‘зЋ‡');
define('_JNEWS_AUTONEWS_FREQ_TIPS', 'жЊ‡е®љдЅ жѓіеЏ‘йЂЃж™єиѓЅ-з”µе­ђжЉҐзљ„йў‘зЋ‡.');
define('_JNEWS_AUTONEWS_SECTION', 'ж–‡з« еЌ•е…ѓ');
define('_JNEWS_AUTONEWS_SECTION_TIPS', 'жЊ‡е®љдЅ жѓійЂ‰ж‹©ж–‡з« жќҐи‡Єе“ЄдёЄеЌ•е…ѓ.');
define('_JNEWS_AUTONEWS_CAT', 'ж–‡з« е€†з±»');
define('_JNEWS_AUTONEWS_CAT_TIPS', 'жЊ‡е®љдЅ жѓійЂ‰ж‹©ж–‡з« жќҐи‡Єе“ЄдёЄе€†з±» (иЇҐеЌ•е…ѓе†…ж‰Ђжњ‰ж–‡з« ).');
define('_JNEWS_SELECT_SECTION', 'йЂ‰ж‹©еЌ•е…ѓ');
define('_JNEWS_SELECT_CAT', 'ж‰Ђжњ‰е€†з±»');
define('_JNEWS_AUTO_DAY_CH8', 'е­Јеє¦зљ„');
define('_JNEWS_AUTONEWS_STARTDATE', 'ејЂе§‹ж—Ґжњџ');
define('_JNEWS_AUTONEWS_STARTDATE_TIPS', 'жЊ‡е®љдЅ жѓіејЂе§‹еЏ‘йЂЃж™єиѓЅ-з”µе­ђжЉҐзљ„ж—Ґжњџ.');
define('_JNEWS_AUTONEWS_TYPE', 'е†…е®№зї»иЇ‘');// how we see the content which is included in the newsletter
define('_JNEWS_AUTONEWS_TYPE_TIPS', 'е®Њж•ґж–‡з« : е°†дєЋз”µе­ђжЉҐеЊ…еђ«е®Њж•ґж–‡з« .<br />' .
		'еЏЄжњ‰з®Ђд»‹: е°†дєЋз”µе­ђжЉҐеЊ…еђ«еЏЄжњ‰ж–‡з« зљ„з®Ђд»‹.<br/>' .
		'еЏЄжњ‰ж ‡йў�: е°†дєЋз”µе­ђжЉҐеЊ…еђ«еЏЄжњ‰ж–‡з« зљ„ж ‡йў�.');
define('_JNEWS_TAGS_AUTONEWS', '[SMARTNEWSLETTER] = е®ѓдјљз”±ж™єиѓЅ-з”µе­ђжЉҐеЏ–д»Ј.' );

//since 1.1.3
define('_JNEWS_MALING_EDIT_VIEW', 'е»єз«‹ / жЈЂи§†й‚®д»¶');
define('_JNEWS_LICENSE_CONFIG' , 'и®ёеЏЇеЌЏи®®' );
define('_JNEWS_ENTER_LICENSE' , 'иѕ“е…Ґи®ёеЏЇеЌЏи®®');
define('_JNEWS_ENTER_LICENSE_TIPS' , 'иѕ“е…ҐдЅ зљ„и®ёеЏЇеЌЏи®®еЏ·з ЃеЏЉе‚Ёе­�е®ѓ.');
define('_JNEWS_LICENSE_SETTING' , 'и®ёеЏЇеЌЏи®®и®ѕе®љ' );
define('_JNEWS_GOOD_LIC' , 'дЅ зљ„и®ёеЏЇеЌЏи®®жњ‰ж•€.' );
define('_JNEWS_NOTSO_GOOD_LIC' , 'дЅ зљ„и®ёеЏЇеЌЏи®®ж— ж•€пјљ' );
define('_JNEWS_PLEASE_LIC' , 'иЇ·иЃ”з»њ jNews ж”ЇжЊЃеЌ‡зє§дЅ зљ„и®ёеЏЇеЌЏи®®пј€license@joobi.coпј‰.' );
define('_JNEWS_DESC_PLUS', 'jNews Plus ж�Їй¦–дёЄ Joomla CMS зљ„и‡ЄеЉЁеє”з­”.  ' . _JNEWS_FEATURES );
define('_JNEWS_DESC_PRO', 'jNews PRO ж�Ї Joomla CMS зљ„з»€жћЃй‚®д»¶зі»з»џ.  ' . _JNEWS_FEATURES );

//since 1.1.4
define('_JNEWS_ENTER_TOKEN' , 'иѕ“е…Ґз­№еЏ·');

define('_JNEWS_ENTER_TOKEN_TIPS' , 'иЇ·иѕ“е…ҐдЅ ењЁжѓ йЎѕ jNews ж—¶д»Ћз”µй‚®ж”¶е€°зљ„з­№еЏ·. ');

define('_JNEWS_jnews_SITE', 'jNews зЅ‘з«™пјљ');
define('_JNEWS_MY_SITE', 'ж€‘зљ„зЅ‘з«™пјљ');

define( '_JNEWS_LICENSE_FORM' , ' ' .
 		'з‚№е‡»иї™й‡Ње‰ЌеѕЂи®ёеЏЇеЌЏи®®иЎЁж ј.</a>' );
define('_JNEWS_PLEASE_CLEAR_LICENSE' , 'иЇ·ж¶€й™¤и®ёеЏЇеЌЏи®®ж ЏеЏЉй‡ЌиЇ•.<br />  е¦‚й—®йў�жЊЃз»­, ' );

define( '_JNEWS_LICENSE_SUPPORT' , 'е¦‚дЅ д»Ќжњ‰з–‘й—®пјЊ' . _JNEWS_PLEASE_LIC );

define( '_JNEWS_LICENSE_TWO' , 'дЅ еЏЇдєЋи®ёеЏЇеЌЏи®®зЄ—дЅ“иѕ“е…ҐдЅ зљ„з­№еЏ·еЏ–еѕ—и®ёеЏЇеЌЏи®®ж‰‹е†ЊеЏЉзЅ‘еќЂпј€жњ¬йЎµйЎ¶йѓЁз»їи‰Ій«�дє®йѓЁе€†пј‰. '
			. _JNEWS_LICENSE_FORM . '<br /><br/>' . _JNEWS_LICENSE_SUPPORT );

define('_JNEWS_ENTER_TOKEN_PATIENCE', 'е‚Ёе­�дЅ зљ„з­№еЏ·еђЋи®ёеЏЇеЌЏи®®е°†дјљи‡ЄеЉЁдє§з”џ. ' .
		' йЂљеёёз­№еЏ·зЎ®и®¤йњЂж—¶ 2 е€†й’џ.  дЅ†ж�Їжџђдє›жѓ…е†µеЏЇиѓЅйњЂж—¶и‡і 15 е€†й’џ.<br />' .
		'<br />е‡ е€†й’џеђЋиї”е›ћж­¤жЋ§е€¶еЏ°жЈЂжџҐ.  <br /><br />' .
		'е¦‚дЅ ењЁ 15 е€†й’џе†…жЋҐж”¶дёЌе€°жњ‰ж•€зљ„и®ёеЏЇеЌЏи®®, '. _JNEWS_LICENSE_TWO);


define( '_JNEWS_ENTER_NOT_YET' , 'дЅ зљ„з­№еЏ·е°љжњЄзЎ®и®¤.');
define( '_JNEWS_UPDATE_CLICK_HERE' , 'иЇ·е€°и®ї <a href="https://joobi.co" target="_blank">Joobi</a> дё‹иЅЅжњЂж–°з‰€жњ¬.');
//define( '_JNEWS_NOTIF_UPDATE' , 'и¦ЃењЁжњ‰ж›ґж–°ж—¶йЂљзџҐдЅ , иѕ“е…ҐдЅ зљ„з”µй‚®ењ°еќЂеЏЉз‚№е‡»и®ўй�… ');

define('_JNEWS_THINK_PLUS', 'е¦‚дЅ жѓідЅ зљ„й‚®д»¶зі»з»џе…·е¤‡ж›ґе¤љеЉџиѓЅиЇ·иЂѓи™‘ Plus!');
define('_JNEWS_THINK_PLUS_1', 'иїћз»­зљ„и‡ЄеЉЁеє”з­”');
define('_JNEWS_THINK_PLUS_2', 'жЋ’зЁ‹дєЋйў„е®љж—Ґе­ђеЏ‘йЂЃдЅ зљ„з”µе­ђжЉҐ');
define('_JNEWS_THINK_PLUS_3', 'е†ЌжІЎжњ‰жњЌеЉЎе™Ёй™ђе€¶');
define('_JNEWS_THINK_PLUS_4', 'еЏЉж›ґе¤љ...');

//since 1.2.2
define( '_JNEWS_LIST_ACCESS', 'жё…еЌ•и®їй—®жќѓй™ђ' );
define( '_JNEWS_INFO_LIST_ACCESS', 'жЊ‡е®ље“ЄдёЄзѕ¤з»„зљ„з”Ёж€·еЏЇд»ҐжЈЂи§†еЏЉи®ўй�…е€°ж­¤жё…еЌ•' );
define( 'JNEWS_NO_LIST_PERM', 'дЅ жІЎжњ‰и¶іе¤џжќѓй™ђи®ўй�…ж­¤жё…еЌ•' );

//Archive Configuration
 define('_JNEWS_MENU_TAB_ARCHIVE', 'е°Ѓе­�');
 define('_JNEWS_MENU_ARCHIVE_ALL', 'е°Ѓе­�е…ЁйѓЁ');

//Archive Lists
 define('_JNEWS_FREQ_OPT_0', 'ж— ');
 define('_JNEWS_FREQ_OPT_1', 'жЇЏе‘Ё');
 define('_JNEWS_FREQ_OPT_2', 'жЇЏ 2 е‘Ё');
 define('_JNEWS_FREQ_OPT_3', 'жЇЏжњ€');
 define('_JNEWS_FREQ_OPT_4', 'жЇЏе­Ј');
 define('_JNEWS_FREQ_OPT_5', 'жЇЏе№ґ');
 define('_JNEWS_FREQ_OPT_6', 'е…¶д»–');

define('_JNEWS_DATE_OPT_1', 'е»єз«‹ж—Ґжњџ');
define('_JNEWS_DATE_OPT_2', 'дї®ж”№ж—Ґжњџ');

define('_JNEWS_ARCHIVE_TITLE', 'и®ѕе®љи‡ЄеЉЁ-е°Ѓе­�йў‘зЋ‡');
define('_JNEWS_FREQ_TITLE', 'е°Ѓе­�йў‘зЋ‡');
define('_JNEWS_FREQ_TOOL', 'е®љд№‰дЅ жѓіе°Ѓе­�з®Ўзђ†е‘�жЇЏйљ”е¤љд№…е°Ѓе­�дЅ зљ„зЅ‘з«™е†…е®№.');
define('_JNEWS_NB_DAYS', 'ж—Ґж•°');
define('_JNEWS_NB_DAYS_TOOL', 'еЏЄйЂ‚з”ЁдєЋе…¶д»–йЂ‰йЎ№! иЇ·жЊ‡е®љжЇЏж¬Ўе°Ѓе­�з›ёйљ”ж—Ґж•°.');
define('_JNEWS_DATE_TITLE', 'ж—Ґжњџз±»ећ‹');
define('_JNEWS_DATE_TOOL', 'е®љд№‰еє”еђ¦ењЁе»єз«‹ж—Ґжњџж€–дї®ж”№ж—Ґжњџе°Ѓе­�.');

define('_JNEWS_MAINTENANCE_TAB', 'з»ґжЉ¤и®ѕе®љ');
define('_JNEWS_MAINTENANCE_FREQ', 'з»ґжЉ¤йў‘зЋ‡');
define( '_JNEWS_MAINTENANCE_FREQ_TIPS', 'е®љд№‰дЅ жѓіе®љжњџж‰§иЎЊз»ґжЉ¤зљ„йў‘зЋ‡.' );
define( '_JNEWS_CRON_DAYS' , 'е°Џж—¶' );

define( '_JNEWS_LIST_NOT_AVAIL', 'жІЎжњ‰еЏЇз”Ёжё…еЌ•.');
define( '_JNEWS_LIST_ADD_TAB', 'ж–°еўћ/зј–иѕ‘' );

define( '_JNEWS_LIST_ACCESS_EDIT', 'ж–°еўћй‚®д»¶/зј–иѕ‘и®їй—®жќѓй™ђ' );
define( '_JNEWS_INFO_LIST_ACCESS_EDIT', 'жЊ‡е®ље“ЄдёЄзѕ¤з»„з”Ёж€·еЏЇд»Ґдёєж­¤е€—иЎЁж–°еўћж€–зј–иѕ‘ж–°й‚®д»¶' );
define( '_JNEWS_MAILING_NEW_FRONT', 'е»єз«‹ж–°й‚®д»¶' );

define('_JNEWS_AUTO_ARCHIVE', 'и‡ЄеЉЁе­�жЎЈ');
define('_JNEWS_MENU_ARCHIVE', 'и‡ЄеЉЁе­�жЎЈ');

//Extra tags:
define('_JNEWS_TAGS_ISSUE_NB', '{tag:issuenb} = е®ѓдјљз”±з”µе­ђжЉҐзљ„еЏ‘иЎЊеЏ·з ЃеЏ–д»Ј.');
define('_JNEWS_TAGS_DATE', '{tag:date} = е®ѓдјљз”±еЏ‘йЂЃж—ҐжњџеЏ–д»Ј.');
define('_JNEWS_TAGS_CB', '[CBTAG:{field_name}] = е®ѓдјљз”± Community Builder е­—ж®µеЏ–еѕ—зљ„ж•°еЂјеЏ–д»Ј: дѕ‹. [CBTAG:firstname] ');
define( '_JNEWS_MAINTENANCE', 'з»ґжЉ¤' );

define('_JNEWS_THINK_PRO', 'жњ‰дё“дёљйњЂи¦Ѓ, дЅїз”Ёдё“дёљз»„д»¶!');
define('_JNEWS_THINK_PRO_1', 'ж™єиѓЅ-з”µе­ђжЉҐ');
define('_JNEWS_THINK_PRO_2', 'дёєдЅ зљ„жё…еЌ•е®љд№‰жќѓй™ђе±‚зє§');
define('_JNEWS_THINK_PRO_3', 'е®љд№‰и°ЃеЏЇд»Ґзј–иѕ‘/ж–°еўћй‚®д»¶');
define('_JNEWS_THINK_PRO_4', 'ж›ґе¤љж ‡з­ѕ: ж–°еўћдЅ зљ„ CB е­—ж®µ');
define('_JNEWS_THINK_PRO_5', 'Joomla е†…е®№и‡ЄеЉЁе­�жЎЈ');
define('_JNEWS_THINK_PRO_6', 'дј�еЊ–ж•°жЌ®еє“');

define('_JNEWS_LIC_NOT_YET', 'дЅ зљ„и®ёеЏЇеЌЏи®®е°љжњЄзЎ®и®¤.  иЇ·жЈЂжџҐжЋ§е€¶еЏ°и®ёеЏЇеЌЏи®®е€†йЎµ.');
define('_JNEWS_PLEASE_LIC_GREEN' , 'зЎ®е®ље·ІжЏђдѕ›е€†йЎµйЎ¶йѓЁзљ„з»їи‰ІдїЎжЃЇз»™ж€‘д»¬зљ„ж”ЇжЊЃе›ўй�џ.' );

define('_JNEWS_FOLLOW_LINK' , 'еЏ–еѕ—дЅ зљ„и®ёеЏЇеЌЏи®®');
define( '_JNEWS_FOLLOW_LINK_TWO' , 'дЅ еЏЇд»ҐењЁи®ёеЏЇеЌЏи®®зЄ—дЅ“иѕ“е…Ґз­№еЏ·еЏЉзЅ‘еќЂеЏ–еѕ—и®ёеЏЇеЌЏи®® (жњ¬йЎµйЎ¶йѓЁз»їи‰Ій«�дє®йѓЁе€†). ');
define( '_JNEWS_ENTER_TOKEN_TIPS2', ' з„¶еђЋз‚№е‡»йЎ¶йѓЁеЏіж–№йЂ‰еЌ•зљ„еҐ—з”ЁжЊ‰й’®.' );
define( '_JNEWS_ENTER_LIC_NB', 'иѕ“е…ҐдЅ зљ„и®ёеЏЇеЌЏи®®' );
define( '_JNEWS_UPGRADE_LICENSE', 'еЌ‡зє§дЅ зљ„и®ёеЏЇеЌЏи®®');
define( '_JNEWS_UPGRADE_LICENSE_TIPS' , 'е¦‚дЅ ж”¶е€°еЌ‡зє§дЅ зљ„и®ёеЏЇеЌЏи®®з­№еЏ·иЇ·ењЁж­¤иѕ“е…Ґ, з‚№е‡»еҐ—з”ЁеЏЉз»§з»­з¬¬ <b>2</b> ж­ҐеЏ–еѕ—дЅ зљ„ж–°и®ёеЏЇеЌЏи®®еЏ·з Ѓ.' );

define( '_JNEWS_MAIL_FORMAT', 'зј–з Ѓж јејЏ' );
define( '_JNEWS_MAIL_FORMAT_TIPS', 'дЅ зљ„й‚®д»¶жѓіз”Ёд»Ђд№€ж јејЏзљ„зј–з Ѓ, зєЇж–‡жњ¬ж€– MIME' );
define( '_JNEWS_jnews_CRON_DESC_ALT', 'е¦‚дЅ жІЎжњ‰дЅ зЅ‘з«™жЋ’зЁ‹д»»еЉЎз®Ўзђ†е™Ёзљ„и®їй—®жќѓй™ђ, дЅ еЏЇд»ҐдЅїз”Ёе…Ќиґ№зљ„ jCron з»„д»¶д»ЋдЅ зљ„зЅ‘з«™е»єз«‹жЋ’зЁ‹е·ҐдЅњ.' );

//since 1.3.1
define('_JNEWS_SHOW_AUTHOR', 'ж�ѕз¤єдЅњиЂ…еђЌз§°');
define('_JNEWS_SHOW_AUTHOR_TIPS', 'е¦‚дЅ жѓіењЁй‚®д»¶ж–°еўћж–‡з« ж—¶ж–°еўћдЅњиЂ…еђЌз§°, йЂ‰ж‹©гЂЊж�ЇгЂЌ.');

//since 1.3.5
define('_JNEWS_REGWARN_NAME','иЇ·иѕ“е…ҐдЅ зљ„еђЌз§°.');
define('_JNEWS_REGWARN_MAIL','иЇ·иѕ“е…Ґжњ‰ж•€зљ„з”µй‚®ењ°еќЂ.');

//since 1.5.6
define('_JNEWS_ADDEMAILREDLINK_TIPS','е¦‚жћњдЅ йЂ‰ж‹©ж�Ї, з”Ёж€·зљ„з”µй‚®е°†дјљиў«ж–°еўћдЅ зљ„й‡Ќж–°еЇјеђ‘зЅ‘еќЂзљ„з»“е°ѕе¤„дЅњдёєеЏ‚ж•°.');
define('_JNEWS_ADDEMAILREDLINK','ж–°еўћз”µй‚®е€°й‡Ќж–°еЇјеђ‘й“ѕжЋҐ');

//since 1.6.3
define('_JNEWS_ITEMID','ItemId');
define('_JNEWS_ITEMID_TIPS','ж­¤ ItemId е°†дјљеЉ е€°дЅ зљ„ jNews иїћз»“.');

//since 1.6.5
define('_JNEWS_SHOW_JCALPRO','jCalPRO');
define('_JNEWS_SHOW_JCALPRO_TIPS','ж�ѕз¤є jCalPRO зљ„ж•ґеђ€е€†йЎµ<br/>пј€еЏЄйЂ‚з”ЁдєЋе¦‚жћњ jCalPRO е·Із»Џе®‰иЈ…ењЁдЅ зљ„зЅ‘з«™пјЃпј‰');
define('_JNEWS_JCALTAGS_TITLE','jCalPRO ж ‡з­ѕ:');
define('_JNEWS_JCALTAGS_TITLE_TIPS','е¤Ќе€¶еЏЉиґґдёЉж­¤еЌ·ж ‡дєЋй‚®д»¶е€—иЎЁе†…дЅ ж¬Іж”ѕзЅ®йЎ№з›®пј€Eventпј‰зљ„дЅЌзЅ®.');
define('_JNEWS_JCALTAGS_DESC','жЏЏиї°:');
define('_JNEWS_JCALTAGS_DESC_TIPS','е¦‚жћњдЅ жѓіжЏ’е…ҐйЎ№з›®зљ„жЏЏиї°пјЊйЂ‰ж‹©гЂЊж�ЇгЂЌ');
define('_JNEWS_JCALTAGS_START','ејЂе§‹ж—Ґжњџ:');
define('_JNEWS_JCALTAGS_START_TIPS','е¦‚жћњдЅ жѓіжЏ’е…ҐйЎ№з›®зљ„ејЂе§‹ж—ҐжњџпјЊйЂ‰ж‹©гЂЊж�ЇгЂЌ');
define('_JNEWS_JCALTAGS_READMORE','й�…иЇ»ж›ґе¤љ:');
define('_JNEWS_JCALTAGS_READMORE_TIPS','е¦‚жћњдЅ жѓіжЏ’е…Ґ <b>й�…иЇ»ж›ґе¤љй“ѕжЋҐ</b> е€°ж­¤йЎ№з›®пјЊйЂ‰ж‹©гЂЊж�ЇгЂЌ');
define('_JNEWS_REDIRECTCONFIRMATION','й‡Ќж–°еЇјеђ‘ URL');
define('_JNEWS_REDIRECTCONFIRMATION_TIPS','е¦‚жћњдЅ йњЂи¦ЃзЎ®и®¤з”µй‚®, еЅ“з”Ёж€·з‚№е‡»зЎ®и®¤й“ѕжЋҐж—¶д»–е°†дјљиў«зЎ®и®¤еЏЉй‡Ќж–°еЇјеђ‘е€°ж­¤ URL.');

//since 2.0.0 compatibility with Joomla 1.5
if(!defined('_CMN_SAVE') and defined('CMN_SAVE')) define('_CMN_SAVE',CMN_SAVE);
if(!defined('_CMN_SAVE')) define('_CMN_SAVE','Save');
if(!defined('_NO_ACCOUNT')) define('_NO_ACCOUNT','No account yet?');
if(!defined('_CREATE_ACCOUNT')) define('_CREATE_ACCOUNT','Register');
if(!defined('_NOT_AUTH')) define('_NOT_AUTH','You are not authorised to view this resource.');

//since 3.0.0
define('_JNEWS_DISABLETOOLTIP', 'Disable Tooltip');
define('_JNEWS_DISABLETOOLTIP_TIPS', 'Disable the tooltip on the frontend');
define('_JNEWS_MINISENDMAIL', 'Use Mini SendMail');
define('_JNEWS_MINISENDMAIL_TIPS', 'If your server use Mini SendMail, select this option to don\'t add the name of the user in the header of the e-mail');

//Since 3.1.5
define('_JNEWS_READMORE','Read more...');
define('_JNEWS_VIEWARCHIVE','Click here');

//since 4.0.0
define('_JNEWS_SHOW_JLINKS','Link Tracking');
define('_JNEWS_SHOW_JLINKS_TIPS','Enables the integration with jLinks to be able to do link tracking for each links in the newsletter.');

//since 4.1.0
define( '_JNEWS_MAIL_ENCODING', 'Mail encoding' );
define( '_JNEWS_MAIL_ENCODING_TIPS', 'What encoding format do you want to use UTF-8 (highly recommended) or ISO-8859-2' );
define( '_JNEWS_COPY_SUBJECT', 'Copy Subject' );

//since 5.0.0
//fieldset for column configuration
define('_JNEWS_COLUMN','User-defined Columns');
define('_JNEWS_COL1_NAME', 'Column 1 Name');
define('_JNEWS_COL2_NAME', 'Column 2 Name');
define('_JNEWS_COL3_NAME', 'Column 3 Name');
define('_JNEWS_COL4_NAME', 'Column 4 Name');
define('_JNEWS_COL5_NAME', 'Column 5 Name');
define('_JNEWS_COLUMN1_REP', '{tag:profile nb=1} = This will be replaced by your user defined column 1');
define('_JNEWS_COLUMN2_REP', '{tag:profile nb=2} = This will be replaced by your user defined column 2');
define('_JNEWS_COLUMN3_REP', '{tag:profile nb=3} = This will be replaced by your user defined column 3');
define('_JNEWS_COLUMN4_REP', '{tag:profile nb=4} = This will be replaced by your user defined column 4');
define('_JNEWS_COLUMN5_REP', '{tag:profile nb=5} = This will be replaced by your user defined column 5');
//url
define('_JNEWS_URL_PASS','Password');
define('_JNEWS_URL_PASS_TIPS','Enter the password to be able to add a subscriber by entering the url. Append the catcher variable password in the URL.<br>(For Plus and PRO this code will used for captcha.)');
define('_JNEWS_URL_MES','Please subscribe through the Subscriber Module or subscribe through the frontend.');
define('_JNEWS_URL_PASS_WARN','(In the PRO If you change this password, please update the hidden password in your external form as well.)');
define('_JNEWS_ENABLE_CAPTCHA', 'Enable Captcha');
define('_JNEWS_ENABLE_CAPTCHA_TIPS','Enable captcha functionality in the subscriber module and in the subscription via external form in the PRO.');
//url
// subscription notification
define('_JNEWS_SUBSCRIPTION_NOTIFY','Send Subscription Notification');
define('_JNEWS_SUBSCRIPTION_NOTIFY_TIPS','Specify here if you want to send a subscription notification to the list owner or not.');
define('_JNEWS_SUBSCRIPTION_NOTIFY_MSG1','A subscription notification email has been sent to the administrator.');
define('_JNEWS_SUBSCRIPTION_NOTIFY_MSG2','No subscription notification email sent.');
define('_JNEWS_NEW_SUB','jNews Newsletter Subscription');
define('_JNEWS_SUBSCRIPTION_NOTIFY_ERR','Unable in sending a subscription notification to the administrator.');
//subscription notification messages
//for captcha
define('_JNEWS_CAPTCHA_CAPTION','Code: ');
define('JNEWS_WRONG_CAPTCHA_ENTERED','<p style=\'text-align: justify;\'><b>CAPTCHA security code is incorrect or the information you provided are invalid.</b><br>(The security code is necessary to prevent automatic registrations by bots and to verify that registrations are made by a person.)<br><br><b><font color=#ff0000>Your subscription was not processed.</font></b><br><br>Please fill in your information and the security code more carefully and click the <b>Subscribe</b> button.<br><br>Thanks for your understanding.</p><br>');
define('_JNEWS_REGWARN_CAPTCHA','Enter the captcha code.');
define('_JNEWS_SUB_ERR','<br>Error in subscribing.');

//since 6.0.0
define('_JNEWS_MOOTOOLS_BTNTEXT' , 'Subscribe Here');
define('_JNEWS_QUEUE_SUBJECT','Subject');
define('_JNEWS_QUEUE_EMAIL','Email');
define('_JNEWS_QUEUE_PRIOR','Priority');
define('_JNEWS_QUEUE_ATT','Attempts');
define('_JNEWS_QUEUE_DEL', 'Delete');
define('_JNEWS_PROCESS_Q','Process Queue');
define('_JNEWS_CLEAN_Q','Clean Queue');
define('_JNEWS_SENDDATE','Send date');
define('_JNEWS_MAILING_Q','All Mailings in Queue');
define('_JNEWS_MENU_QUEUE', 'Queue');
define('_JNEWS_MENU_TEMPLATES','Templates');
define('_JNEWS_MENU_TAB_QUEUE' , 'Queue');
define('_JNEWS_Q_PROCESS' , 'Queue Configuration');
define('_JNEWS_MAX_Q','Maximum number of e-mails per batch');
define('_JNEWS_SUBS_LIST_LABEL' , 'This Newsletter will be sent to the subscribers of the following selected lists:');
define('_JNEWS_SUBS_LIST_CAMPAIGN' , 'This auto-responder will be sent to the subscribers of the following selected auto-responder:');
define('_JNEWS_SUBS_LIST_RECEIVE', 'Receive' );
define('_JNEWS_SUBS_LIST_TOALL', 'Select All' );
define('_JNEWS_SUBS_LIST_TONONE', 'None' );
define('_JNEWS_LIST_COLOR','Color');
define('_JNEWS_LIST_COLOR_TIP','Select the color for your list. It can be usefull for the statistics.');
define('_JNEWS_MENU_NEW', 'New');
define('_JNEWS_MENU_EDIT', 'Edit');
define('_JNEWS_MENU_APPLY', 'Apply');
define('_JNEWS_MENU_CANCEL', 'Cancel');
define('_JNEWS_MENU_TEMPLATE', 'Template');
define('_JNEWS_HTML_VERSION', 'HTML Version');
define('_JNEWS_NONHTML_VERSION', 'Non-HTML Version');
define('_JNEWS_TAG_NAME_DESC' , 'This will be replaced by the name the subscriber entered, you will be sending personalized email when using this.');
define('_JNEWS_TAG_FNAME_DESC' , 'This will be replaced by the FIRST name of the subscriber entered.');
define('_JNEWS_TAG_ISSUENB_DESC' , 'This will be replaced by the issue number of the newsletter.');
define('_JNEWS_TAG_DATE_DESC' , 'This will be replaced by the sent date.');
define('_JNEWS_TAG_CBNAME' , '[CBTAG:{field_name}]');
define('_JNEWS_TAG_CBNAME_DESC' , 'This will be replaced by the value taken from the Community Builder field: eg. [CBTAG:firstname] ');
define('_JNEWS_TAG_LOADMODINFO_DESC' , 'This will be replaced by the Joomla module where id is equal to id of the joomla module. For example {module=1}.<br /> The modules can only be loaded through the cron task. <br /> ');
define('_JNEWS_DATETIME' , 'Date and Time');
define('_JNEWS_TEMPLATE_COPY' , '_copy');
define('_JNEWS_TEMPLATE_DEFAULT_NODEL' , 'You cannot delete a default template!');
define('_JNEWS_TEMPLATE_DEFAULT_SUCCS' , 'Successfully set to default!');
define('_JNEWS_TEMPLATE' , 'Template');
define('_JNEWS_TEMPLATES' , 'Templates');
define('_JNEWS_AR' , 'Auto-responder');
define('_JNEWS_SELCT_MAILINGLIST', 'Please select a list in the List tab in order to add a mailing.');
define('_JNEWS_SELCT_MAILINGCAMPAIGN', 'Please select a campaign in the List tab in order to add a mailing.');
define('_JNEWS_TEMPLATE_AVAIL', 'All Available Templates');
define('_JNEWS_TEMPLATE_NAME', 'Name');
define('_JNEWS_TEMPLATE_NAME_T', 'Enter the name of the template.');
define('_JNEWS_TEMPLATE_NAMEKEY', 'Namekey');
define('_JNEWS_TEMPLATE_NAMEKEY_T', 'Enter the namekey of the template.');
define('_JNEWS_TEMPLATE_DESC', 'Description');
define('_JNEWS_TEMPLATE_DEFAULT', 'Default');
define('_JNEWS_TEMPLATE_DEFAULT_T', 'Select "Yes" to set as the default template.');
define('_JNEWS_TEMPLATE_PUBLISH', 'Publish');
define('_JNEWS_TEMPLATE_PUBLISH_T', 'Select "Yes" to publish the template.');
define('_JNEWS_TEMPLATE_BG', 'Background Color');
define('_JNEWS_TEMPLATE_BG_T', 'Select the template background color.');
define('_JNEWS_TEMPLATE_UPLOAD', 'Upload Thumbnail');
define('_JNEWS_TEMPLATE_UPLOAD_T', 'Upload an image thumbnail of the template.');
define('_JNEWS_TEMPLATE_DESC_T', 'Enter the description of the template.');
define('_JNEWS_TEMPLATE_STYLE_TH1', 'Title h1');
define('_JNEWS_TEMPLATE_STYLE_TH2', 'Title h2');
define('_JNEWS_TEMPLATE_STYLE_TH3', 'Title h3');
define('_JNEWS_TEMPLATE_STYLE_TH4', 'Title h4');
define('_JNEWS_TEMPLATE_STYLE_UNSUB', 'Style for the Unsubscribe Link');
define('_JNEWS_TEMPLATE_STYLE_SUB', 'Style for the "Change Your Subscription" Link');
define('_JNEWS_TEMPLATE_STYLE_CONTENT', 'Style for the content area');
define('_JNEWS_TEMPLATE_STYLE_CHEAD', 'Style for the content title');
define('_JNEWS_TEMPLATE_STYLE_CREADMORE', 'Style for the read more link');
define('_JNEWS_TEMPLATE_STYLE_VONLINE', 'Style for the "View it online" Link');
define('_JNEWS_TEMPLATE_STYLE_NEW', 'Add a New Style');
define('_JNEWS_TEMPLATE_STYLE_NEWC', 'Name of the CSS Class');
define('_JNEWS_TEMPLATE_STYLE_NEWAPPLIED', 'CSS styles that will be applied to the class.');

//statistics & reports
define('_JNEWS_REPORTS_SUBS', 'Subscribers Reports');
define('_JNEWS_REPORTS_MAIL', 'Mailing Reports');
define('_JNEWS_REPORTS_LIST', 'List Reports');
define('_JNEWS_LIST_SUBCRIBERS', 'No. of Subscribers');
define('_JNEWS_LIST_UNSUBSCRIBERS', 'No. of Unsubscribers');
define('_JNEWS_LIST_CONFIRMED', 'No. of Confirmed Emails');
define('_JNEWS_LIST_UNCONFIRMED', 'No. of Unconfirmed Emails');
define('_JNEWS_LIST_SUB_DATE', 'Subscribed Date');
define('_JNEWS_MAILING_SEND_DATE','Send Date');
define('_JNEWS_MAILING_SUBJECT', 'Subject');
define('_JNEWS_MAILING_SENT_HTML','Sent in HTML');
define('_JNEWS_MAILING_SENT_TEXT','Sent in Text');
define('_JNEWS_MAILING_FAILED', 'Send Fails');
define('_JNEWS_MAILING_PENDING', 'Mail Pending');
define('_JNEWS_MAILING_BOUNCES','Bounces');
define('_JNEWS_MAILING_SENT', 'Total Sent');
//Mailing Reports
define('_JNEWS_MAIL_GRAPH', 'Graph');
define('_JNEWS_MAIL_DETAILS', 'Details');
define('_JNEWS_MAIL_DETAILS_READ', 'HTML Read');
define('_JNEWS_MAIL_DETAILS_UNREAD', 'HTML Unread');
define('_JNEWS_MAIL_DETAILS_TEXT', 'TEXT Only');

//stats filters
define('_JNEWS_GROUP_PREDEFINED_DATE','Predefined Date');		//legend
define('_JNEWS_GROUP_SPECIFIED_DATE','Specified Date');
define('_JNEWS_LABEL_SET_INTERVAL', 'Set Interval');		//labels
define('_JNEWS_LABEL_DATE_RANGE','Date Range');
define('_JNEWS_LABEL_CURRENT_SERVER_TIME', 'Current Server Time');
define('_JNEWS_LABEL_REPORT_TYPE','Report Type');
define('_JNEWS_INTERVAL_DAILY','Daily');					//intervals
define('_JNEWS_INTERVAL_WEEKLY','Weekly');
define('_JNEWS_INTERVAL_MONTHLY', 'Monthly');
define('_JNEWS_INTERVAL_YEARLY','Yearly');
define('_JNEWS_DEFINED_RANGE_YESTERDAY','Yesterday');		//predefined range
define('_JNEWS_DEFINED_RANGE_TODAY', 'Today');
define('_JNEWS_DEFINED_RANGE_THIS_WEEK','This Week');
define('_JNEWS_DEFINED_RANGE_LAST_WEEK','Last Week');
define('_JNEWS_DEFINED_RANGE_LAST_TWO_WEEK','Last 2 Weeks');
define('_JNEWS_DEFINED_RANGE_THIS_MONTH','This Month');
define('_JNEWS_DEFINED_RANGE_LAST_MONTH','Last Month');
define('_JNEWS_DEFINED_RANGE_THIS_YEAR','This Year');
define('_JNEWS_DEFINED_RANGE_LAST_YEAR','Last Year');
define('_JNEWS_DEFINED_RANGE_TWO_YEARS_AGO','2 Years Ago');
define('_JNEWS_DEFINED_RANGE_3_YEARS_AGO','3 Years Ago');
define('_JNEWS_BUTTON_REFRESH','Refresh');				//buttons
define('_JNEWS_BUTTON_GENERATE','Generate');
define('_JNEWS_BUTTON_RESET', 'Reset');
define('_JNEWS_SPECIFIED_DATE_START','Start');			//specified date
define('_JNEWS_SPECIFIED_DATE_END','End');
define('_JNEWS_REPORT_LISTING','Listing');
define('_JNEWS_REPORT_GRAPH','Graph');
define('_JNEWS_REPORT_EXPORT','Export');
define('_JNEWS_SUBSCRIBERS_ALL_USERS', 'All Users');		//subscribers
define('_JNEWS_SUBSCRIBERS_REGISTERED', 'Registered');
define('_JNEWS_SUBSCRIBERS_GUESTS','Guests');
define('_JNEWS_REPORT_WARN_MESSAGE', 'Incomplete Date Selection in Specified Fieldset!');

//stats export
define('_JNEWS_STATS_EXPORT', 'Export');
define('_JNEWS_EXPORT_WARN_MESSAGE', 'No Data to be Exported');
define('_JNEWS_GRAPH_WARN_MESSAGE', 'No Data to be Displayed');
define('_JNEWS_REPORT_HEADER', 'Report');
define('_JNEWS_REPORT_HEADER_TO', 'to');
define('_JNEWS_PIE_PROCESS_WARN_MESSAGE', 'No Data for Mailing Process');
define('_JNEWS_PIE_FORMAT_WARN_MESSAGE', 'No Data for HTML/Text Format');

//stats graph labels
define('_JNEWS_GRAPH_LBL_HTML', 'HTML');
define('_JNEWS_GRAPH_LBL_TEXT', 'TEXT');
define('_JNEWS_GRAPH_TITLE_FORMAT', 'HTML/TEXT Format');
define('_JNEWS_GRAPH_PIE_TITLE_MAIL', 'Mailing Process');
define('_JNEWS_PIE_SUBS', 'Subscribers');
define('_JNEWS_PIE_UNSUBS', 'Unsubscribers');
define('_JNEWS_PIE_UNCONFIRMED', 'Unconfirmed');
define('_JNEWS_PIE_CONFIRMED', 'Confirmed');
define('_JNEWS_MAILING_SUBJECT_HEADER', 'Subject');


//Wizards
define('_JNEWS_WIZARD', 'Wizard');
define('_JNEWS_CHECKLISTFOUND', 'Please create your list first and be sure that it is published.');

define('_JNEWS_CHECKCAMPAIGNFOUND', 'Please create your campaign(list) first and be sure that it is published.');
define('_JNEWS_TEMPLATE_ALERT_NAMEKEY', 'Template must have a namekey!');
define('_JNEWS_LIST_GUIDE', '<strong>List Management:</strong> <br/>'.
       '<ul><li>The first thing you have to do to start with jNews is to create your list.</li>'.
       '<li>You will be able to subscribe users to this list and send one or more Newsletters.</li>'.
       '<li>You can specify here the basic information of the list including your <i><u>Sender Information</u></i>.</li>'.
       '<li>And be able to specify users or group of users who can subscribe to that list.</li>'.
       '<li>For <i>Plus</i> and <i>Pro</i> version you can specify what group of user or user who can add or edit mailings for this list.</li>'.
       '<li>For <i>Pro</i> version you have the option to send <i><u>Unsubscription</u></i> and <i><u>Subscription Notification</u></i> to the owner of the list or the admin of the site.</li></ul>');
define('_JNEWS_SUBSCRIBERS_GUIDE', '<strong>Subscriber Management:</strong> </br>' .
	    '<ul><li><strong>During Creation: </strong></li><br>'.
        '<ul><li>You can proceed here adding your subscribers.</li>'.
        '<li>Specify your <i><u>Subscriber Information</i></u></li>'.
        '<li>And select which <i><u>List</u></i> you want your subscriber to subscribe to, provided that you have created list.</li>'.
        '<li>You can Confirm your added subscriber to receive your newsletters.</li>'.
        '<li>You can also allow your subscriber to recieve the HTML format of your newsletter.</li>'.
        '<li><i><u>IP</u></i> field is added to automatically detect the IP of your subscriber from the frontend of your site. </li></ul></ul>'.
        '<ul><li><strong>Export Button</strong></li>' .
        '<ul><li>This allows you to <i><u>Export</u></i> your subscribers from all your lists or selected lists.</li></ul></ul>' .
        '<ul><li><strong>Import Button</strong></li>' .
        '<ul><li>This allows you to <i><u>Import</u></i> your subscribers to all your lists or selected lists.</li></ul></ul>');
define('_JNEWS_NEWSLETTER_GUIDE', '<strong>Newsletter Management:</strong> <br/>'.
        '<ul><li>Provided that you have created List(s) you can now proceed creating your <i><u>Newsletters</u></i>.</li>'.
        '<li>For the <i><u>Plus</u></i> version you can create <i><u>Scheduled Newsletter</u></i> and also <i><u>Autoresponder</u></i> or <i><u>Auto-responder</u></i> type of mailing.</li>'.
        '<li>For <i><u>PRO</u></i> you have the functionality with <i><u>Smart-Newsletter</u></i>, which takes your <i>latest created</i>, <i>modified</i> and <i>published articles</i> of your site.</li></ul>'.
        '<ul><li><strong>During Creation:</strong></li>'.
		'<ul><li><i><u>Newsletter Content Area</u></i> -> where you put all the contents of your Newsletter.</li>'.
		'<li><i><u>List Tab</u></i> -> the area where you can send the newsletter to one or more Lists.</li>'.
		'<li><i><u>Sender Tab</u></i> -> the area of the Sender Information Settings of your Newsletter.</li>'.
		'<li><i><u>Content Tab</u></i> -> the area where you can look for the contents of your site and specify which article to insert into your Newsletter.</li>'.
        '<li><i><u>Attachments</u></i> -> Newsletter Attachement Information area.</li></ul></ul>' .
        '<ul><li><strong>Unpublished Button</strong></li>' .
        '<ul><li>Enables you to unpublished your newsletter.</li></ul></ul>' .
        '<ul><li><strong>Preview Button</strong></li>' .
        '<ul><li>Preview the content and format of your newsletter.</li></ul></ul>' .
        '<ul><li><strong>Send Button</strong></li>' .
        '<ul><li>Enables you to manually send the newsletter to your list of subscribers.</li></ul></ul>' .
        '<ul><li><i>Note: You can only edit an unpublished newsletter.</i></li></ul>');
define('_JNEWS_AUTORESPONDER_GUIDE', '<strong>Autoresponder Management:</strong><br/>'.
		  '<ul><li>Provided that you have created <i><u>Auto-responder</u></i> type of list you can proceed creating your <i><u>Autoresponder</u></i>.</li>'.
		  '<li>During the creation process you can specify the <i><u>Number of Delays</u></i> for your autoresponder, after the previous one has been processed.</li>' .
		  '<li> The process is more or less the same on how to create your newsletter.</li></ul>');
define('_JNEWS_SMARTNEWSLETTER_GUIDE', '<strong>Smart-Newsletter Management:</strong> <br/>' .
		 '<ul><li>Provided that you have created <i>list(s)</i> and <i>latest created</i>, <i>modified</i> and <i>published article</i> on your site you can proceed creating <i><u>SmartNewsletter</u></i>.</li>'.
         '<li>The creation process is more or less the same with Newsletter Creation.</li>' .
         '<li>From the <i><u>Smart-Newsletter Tab</u></i> during creation you can specify your settings for the processing of your Smart-Newsletters.</li>');
define('_JNEWS_TEMPLATES_GUIDE', '<strong>Template Management:</strong><br><ul><li>Templates can be very useful in creating newsletter.</li>' .
		'<li>This view will allow you to create Templates for your newsletters</li>' .
		'<li><i><u>Default Template</u></i> will be applied to the newly created newsletter.</li>' .
		'<li><i><u>Inline CSS</u></i> of the template will be applied/inherited to the created newsletter.</li>' .
		'<li>You can also choose a <i><u>Background Color</u></i> that will be a background of the newsletter.</li>' .
		'<li>Note: Only newly created newsletter will get the html of the default template</li></ul>' .
		'<ul><strong>Default Button</strong>'.
		'<ul><li>Inorder to make your Template as the default template to be used in your newsletter you just need to click on this button.</li></ul></ul>');
define('_JNEWS_QUEUE_GUIDE','<strong>Queue Management:</strong><br/> ' .
		'<ul><li>This view enables you to see your <i><u>Queued Mailings</u></i>.' .
		'<li>These are your <i><u>Scheduled Newsletters</i></u>, <i><u>Autoresponders</i></u> and <i><u>Smart-Newsletters</i></u></li>'.
        '<li>The <i><u>Process Queue Button</i></u> will allow you to proces your queued mailings manually by just clicking the said button.</li>' .
        '<li>The <i><u>Reset S.N. Counter Button</i></u> will allow you to reset the <i>next send date</i> or <i>generated date</i> of your Smart-Newsletter.</li>' .
        '<li>The <i><u>Empty Queue Button</i></u> will allow you to clean the whole queue.</li></ul>');
define('_JNEWS_ABOUT_GUIDE','jnews');
define('_JNEWS_IMPORT_GUIDE','<strong>Import Management:</strong><br/>'.
         '<ul><li>Here you can import your subscribers to all your lists or to select lists.</li>'.
         '<li>By following the link given below, you can proceed importing your subscribers.</li>'.
         '<li><i>Note: You need to create first your lists before importing your subscribers.</i></li></ul>');
define('_JNEWS_CONFIGURATION_GUIDE','<strong>Configuration:</strong><br/>'.
        '<ul>All the jnews configuration settings can be done in this area.<br/><br/>'.
	    '<strong>Mail Tab:</strong>'.
	    '<ul><li>The area where you can define the Mail Settings and Sending Settings of jNews depending on your server requirements.</li></ul>'.
	    '<br/><strong>Subscribers Tab:</strong>'.
	    '<ul><li>The area where we can define the subscription settings both from the backend and frontend of your site.</li></ul>'.
	    '<br/><strong>Scheduler Tab:</strong>'.
	    '<ul><li>The area where we can specify the Scheduler Frequency so do with Maintenance Settings on the sending of your mailings.</li>
         <li>The Information entered on this area depends also on your server requirements or server limitation.</li></ul>'.
	    '<br/><strong>Logs & Stats Tab:</strong>'.
	    '<ul><li>The area to specify the Statistics Settings and Logs Settings.</li></ul>'.
	    '<br/><strong>Archive Tab:</strong>'.
	    '<ul><li>This is mainly used for the auto archive frequency.</li></ul>'.
	    '<br/><strong>Miscellaneous Tab:</strong>'.
	    '<ul><li>All the other settings and preferences can be found here.</li></ul>'.
	    '<br/><strong>Queue Tab:</strong>'.
	    '<ul><li>Mainly used for the Queue Management View (available for Plus and Pro Version).</li></ul>'.
	    '<br/><strong>License Tab:</strong>'.
	    '<ul><li>The area where we can validate the license by just following the steps presented.</li></ul></ul>');
define('_JNEWS_EMPTY_Q','Empty Queue');
define('_JNEWS_RESET_SN','Reset S.N. Counter');
define('_JNEWS_Q_M1','There are no emails in the queue.');
define('_JNEWS_INSTALL_CLICKSTART', 'Click here to get started!');
define('_JNEWS_INSTALL_DESC', 'Thank you for choosing jNews.<br><br>
jNews is a mailing lists, newsletters, auto-responders and follow up tool for communicating effectively with your users and customers.');
define('_JNEWS_INSTALL_ERRORN' , 'If you have error during the installation process, please refer to our');
define('_JNEWS_INSTALL_DOC' , 'documentation here.');
define('_JNEWS_INSTALL_SUCC' , 'Successfuly Installed.');
define('_JNEWS_INSTALL_STATUS_CONFIG' , 'jNews Configuration:');
define('_JNEWS_INSTALL_STATUS_PLUGIN' , 'jNews Plugin(Bot):');
define('_JNEWS_INSTALL_STATUS_MOD' , 'jNews Module:');
define('_JNEWS_INSTALL_UPDATES' , 'jNews Updates');
define('_JNEWS_STATS_GUIDE', '<strong>Mailing Reports: </strong><br/>'.
		'<ul> <li>It will generate a list of mailings sent based on the given date range. </li> ' .
		'<li>It will count the following: <ul><li> the no. of mails sent in HTML & Text Format,</li>' .
			'<li> no. of how many viewed the mails in HTML format, </li>' .
			'<li>how many mail sent that are failed, </li><li>still on-process (pending), ' .
			'</li><li>email bounced,</li> <li>and the total sent is the no. of emails sent on each mailing.</li> </ul></li></ul>'.
		'<strong>List Reports:</strong> <br/>'.
		'<ul> <li>It will generate a listing of List Names based on the date of subscriptions on a given date range. </li>' .
			'<li>It will list the following:  <ul><li>total no. of subscribers who made a subscription </li> ' .
			'<li>total no. of subscribers who unsubscribed, </li>' .
			'<li>total no. of confirmed and unconfirmed subscribers on each list type. </li>  </ul></li></ul>'.
		'<strong>Subscribers Report:</strong> <br/>'.
		'<ul> <li>It will generate a report on the total no. of subscribers on a given date range.</li> </ul>'.
		'<strong>How to Export the Report into CSV File:</strong>'.
		'<ul> <li>On each Reports (Mailing, List and Subscribers), an export icon is found at the upper right of each tab.</li>'.
		'<li>Click the export icon to export the file.</li></ul>'
		);
define('_JNEWS_TEMPLATE_ALIAS' , 'Alias');
define('_JNEWS_SEARCH' , 'Search');
define('_JNEWS_SEARCH_GO' , 'Go');
define('_JNEWS_SEARCH_RESET' , 'Reset');
define('_JNEWS_SENDER_LIST_INFO', 'Click to select sender from list' );
define('_JNEWS_FILTER_MAILING' , 'Select a Mailing ');
define('_JNEWS_MESSAGE_QUEUE' , 'All Mailings in the Queue ');
define('_JNEWS_FILTER_LIST' , 'Select Type');
define('_JNEWS_MAILING_TAG' , 'Tag');
define('_JNEWS_MAILING_TAGINSERT' , 'Insert');
define('_JNEWS_MAILING_TAG_INSTRUCT' , '<p>Select the desired tag to be added and click insert.<br> Note: <i>Make sure to place the cursor in the text editor where you want to insert.</i></p>');
define('_JNEWS_TAG_SUBSCRIPTION', '{tag:subscriptions}');
define('_JNEWS_TAG_UNSUBSCRIBE', '{tag:unsubscribe}');
define('_JNEWS_TAG_SUBSCRIPTION_DESC', 'This will be replaced by the defined constant "_JNEWS_CHANGE_EMAIL_SUBSCRIPTION" in the translation.');
define('_JNEWS_TAG_UNSUBSCRIBE_DESC', 'This will be replaced by the defined constant "_JNEWS_UNSUBSCRIBE" in the translation.');
define('_JNEWS_TAG_VIEWONLINETXT', '{viewonline:text here}');
define('_JNEWS_TAG_VIEWONLINE', 'view it in your browser');
define('_JNEWS_TAG_VIEWONLINE_DESC', 'This will be replaced by either the default text or what you put in the "text here" with a link.');

//since 1.1.0
define('_JNEWS_SHOW_CRON','Enable joobi cron');

define('_JNEWS_SHOW_CRON_TIPS','Enables the cron set up upon the installation of jNews.<br>This cron was set up in https://joobi.co and will be triggered every 15 minutes');
define('_JNEWS_CRON_FSETTINGS' , 'Cron Settings');

define('_JNEWS_INSTALL_ACAUPDATEMSG' , 'Do you want to import your database from Acajoom to jNews?');
define('_JNEWS_INSTALL_ACAUPDATEBTN' , 'Import Acajoom Data');
define('_JNEWS_INSTALL_ACAUPDATENOTE' , 'NOTE : This will transfer data stored from Acajoom tables to jNews tables.');

define('_JNEWS_MAILING_UPDATED' , 'Mailings successfully imported.');
define('_JNEWS_DETAIL_UPDATED' , 'Stats Details successfully imported');
define('_JNEWS_GLOBAL_UPDATED' , 'Stats Globals successfully imported');
define('_JNEWS_SUBSCRIBER_UPDATED' , 'Subscribers successfully imported');
define('_JNEWS_QUEUE_UPDATED' , 'Queues successfully imported');
define('_JNEWS_LISTSUBSCRIBER_UPDATED' , 'List Subscribers successfully imported');

define('_JNEWS_LIST_UPDATED_FAILED' , 'No Lists successfully imported');
define('_JNEWS_MAILING_UPDATED_FAILED' , 'No Mailings successfully imported');
define('_JNEWS_DETAIL_UPDATED_FAILED' , 'No Detailed Statistics successfully imported');
define('_JNEWS_GLOBAL_UPDATED_FAILED' , 'No Global Statistics successfully imported');
define('_JNEWS_SUBSCRIBER_UPDATED_FAILED' , 'No Subscribers successfully imported');
define('_JNEWS_QUEUE_UPDATED_FAILED' , 'No records successfully imported to Queue');
define('_JNEWS_LISTSUBSCRIBER_UPDATED_FAILED' , 'No records successfully imported to List Subscribers');

define('_JNEWS_LEGEND' , 'Legend');
define('_JNEWS_NOTVISIBLE', 'Not Visible');
define('_JNEWS_SCHEDULED', 'Scheduled');
define('_JNEWS_SUBSCRIBERS_UNREGISTERED', 'Unregistered');
define('_JNEWS_TEMPLATE_UPLOAD_SUCCESS', 'Successfully uploaded template' );
define('_JNEWS_TEMPLATE_UPLOAD_FAIL', 'Fail to upload template. Kindly verify the zip file if it has the main index.html file.' );
define('_JNEWS_UPLOAD_ZIP_INVALID', 'Can only upload templates in zip files' );
define('_JNEWS_CUSTOMCSS', 'Input your Custom CSS here');
define('_JNEWS_TEMPLATE_ALERT', 'Template name and alias are required!');

//since 2.2.0
define('_JNEWS_UNSUB_NOTIFYMSG','Send Unsubscribe Notification');
define('_JNEWS_SEND_UNSUBNOTIFY_TIPS','Specify here if you want to send an unsubscription notification to the list owner or not.');
define('_JNEWS_UNSUB_ADMINMESSAGE', 'Unsubscribe Notification Message');
define('_JNEWS_INFO_AMIN_UNSUB_NOTIFY', 'This message will be send to List Owner or List creator when someone unsubscribes to the list. Any message can be entered here.');

//templates
define('_JNEWS_CSS_TOGGLESTYLE','Toggle Styling');
define('_JNEWS_EXTERNALCSS_LINK','Add External CSS Link');
define('_JNEWS_EXTERNALCSS_PROCESS','Process');
define('_JNEWS_TEMP_COMBINECLASS','Combined class selector');
define('_JNEWS_COMBINECLASS_SUPPORT','is not supported');
define('_JNEWS_TEMP_COMBINECLASS_IN','in');
define('_JNEWS_TEMP_HTMLTAG','Found html tag ');
define('_JNEWS_TEMP_CONTDEV','You may contact developer for it to be added');
define('_JNEWS_TEMP_COMBCLASSPSEUDO','Combined pseudo-class selector');
define('_JNEWS_TEMP_COMBCLASSEID','or element id');

//Menus
define('_JNEWS_MENU_LIVE_SUPPORT','Live Support');

//Tags
define ('_JNEWS_SMART_TAG', 'This will be replaced by the latest created, modified and published article when you create a Smart-Newsletter type of mailing.');

//Toobar Menus
define('_JNEWS_DONEW_SUBSCRIBERB', 'Name and Email are required!');

//since 3.1.0
define('_JNEWS_IP', 'IP');
define('_JNEWS_MENU_STATS_REPORTS', 'Statistics');
define('_JNEWS_LIST_T_ADMIN_NOTIFICATION' , 'Notification');
define('_JNEWS_MENU_REFRESH_STATS' , 'Refresh');
define('_JNEWS_MENU_GENERATE_STATS' , 'Generate');

//since 3.2.0
define('_JNEWS_LIST_T_LIST' , 'List');
define('_JNEWS_UNSUBSCRIBE_ADMIN_NOTIFICATION', '<p>Dear [LISTOWNERNAME],<br /> <br /></p> <p style="padding-left: 30px;">This is an automated message from [SITE]. To inform you that a user unsubscribed to your newsletter list.</p> <p style="padding-left: 60px;"><strong>Details</strong></p> <p style="padding-left: 60px;">Date and Time of Unsubscription: <strong>{tag:date}</strong><br />Subscriber Name: <strong>[SUBSCRIBERNAME]</strong><br />Subscriber Email: <strong>[SUBSCRIBEREMAIL]</strong></p> <p style="padding-left: 60px;">Unsubscribed List: <strong>[LISTID] - [LISTNAME]</strong></p> <p style="padding-left: 30px;">Please do not response to this message as it is automatically generated and is for information purposes only.</p> <p> </p> <p>Thank You!</p>');

//Tagging
define('_JNEWS_TAG_MODNAME' , 'Module Name');
define('_JNEWS_TAG_MODTYPE' , 'Type');
define('_JNEWS_TAG_MODPOSITION' , 'Position');
define('_JNEWS_TAG_ACL' , 'Access Level');
define('_JNEWS_TAG_SPECIAL' , 'Special');
define('_JNEWS_TAG_PUBLIC' , 'Public');
define('_JNEWS_TAG_ARTICLESECTION' , 'Section');
define('_JNEWS_TAG_ARTICLECATEGORY' , 'Category');
define('_JNEWS_TAGMENU_MODULE' , 'Joomla Module');
define('_JNEWS_TAGMENU_AUTOCONTENT' , 'Auto Content');
define('_JNEWS_TAGMENU_AUTOCONTENT_K2' , 'Auto K2');
define('_JNEWS_TAGMENU_SUBSCRIPTION' , 'Subscription');
define('_JNEWS_TAGMENU_USERS' , 'Users');
define('_JNEWS_TAGMENU_DATETIME' , 'Date/Time');
define('_JNEWS_TAGMENU_WEBSITE' , 'Site Links');
define('_JNEWS_TAGMENU_CONTENT' , 'Content');
define('_JNEWS_TAGPICKLIST_ORDERING' , 'Ordering');
define('_JNEWS_TAGPICKLIST_ORDERINGTIP' , 'Select the way you want your articles to be ordered.');
define('_JNEWS_TAGPICKLIST_CREATED' , 'Created Date (Newest First)');
define('_JNEWS_TAGPICKLIST_TITLE' , 'Title');
define('_JNEWS_TAGPICKLIST_Order' , 'Order');

define('_JNEWS_SELECT_MAILING', 'Please select a mail to edit!');
define('_JNEWS_DELETE_MAILING', 'Please select a mail to delete!');
define('_JNEWS_COPY_MAILING', 'Please select a mail to copy!');
define('_JNEWS_TAG_CONFIRM_DESC', 'This will be replaced by the defined constant "_JNEWS_CONFIRM_SUBSCRIPTION" in the translation with the confirmation link.');
define('_JNEWS_TEMPLATE_SAVED', 'Template successfully saved.');
define('_JNEWS_SUBSCRIPTION_NOT_AVAIL_LIST', 'You are trying to subscribe to a listid that does not exist.');

//since 4.0.0
define('_JNEWS_MENU_TAG' , 'Tags');
define('_JNEWS_TAG_EMAIL_DESC', 'This will be replaced by the email of the subscriber.');
define('_JNEWS_TAG_FWDTOFRIEND', 'Forward to a friend.');
define('_JNEWS_TAGTITLE_SITE', 'Site Links');
define('_JNEWS_TAGTITLE_CONTENT', 'Joomla Contents');
define('_JNEWS_TAGTITLE_AUTOCONTENT', 'Automatic Joomla Contents');
define('_JNEWS_TAGTITLE_MOD', 'Joomla Modules');
define('_JNEWS_TAGCAPTION_ALL', 'ALL');
define('_JNEWS_SUCCESS_COPIED' , ' successfully copied.');
define('_JNEWS_TAGCAPTION_ALLSECCAT' , 'ALL SECTIONS AND CATEGORIES');
define('_JNEWS_FWD_MYDETAILS' , 'My Details');
define('_JNEWS_FWD_WANTTO' , 'I want to forward this email to');
define('_JNEWS_FWD_MESSAGE' , 'Enter a message');
define('_JNEWS_FWD_MESSAGEHID' , 'This email was forwarded to you by');
define('_JNEWS_FWD_SENDEMAIL' , 'Send Email');
define('_JNEWS_FWD_ADDFIELD' , 'Add another friend.');

define('_JNEWS_NEWSLETTER_ARCHIVE', 'Newsletter Archive');
define('_JNEWS_FWDTOFRIEND_ALRT_UNAME', 'Please enter your name.');
define('_JNEWS_FWDTOFRIEND_ALRT_UEMAIL', 'Please enter your valid e-mail address.');
define('_JNEWS_FWDTOFRIEND_ALRT_FNAME', 'Please enter your friend\'s name.');
define('_JNEWS_FWDTOFRIEND_ALRT_FEMAIL', 'Please enter a valid e-mail address of your friend.');
define('_JNEWS_FWDTOFRIEND_SUCCESS', 'Mailing successfully forwarded to ');
define('_JNEWS_FWDTOFRIEND_FAILED', 'Mailing not successfully forwarded to ');
define('_JNEWS_TAGSITE_TAGTIP', 'Click Insert to add the tag in the newsletter.');
define('_JNEWS_TAGSITE_CAPTION', 'Tag Caption');
define('_JNEWS_TAGSITE_CAPTIONTIP', 'Change the tag caption or text here.');
define('_JNEWS_TAGSMART_ALERT_SELECT', 'Please select your Automatic Content to be added in your newsletter!');
define('_JNEWS_ARLIST', 'Auto-responders');
define('_JNEWS_NEW_SUBSCRIBER', 'Subscriber Succesfully Saved.');
define('_JNEWS_EDIT_AR', 'Edit an Auto-responder');
define('_JNEWS_ARINFO_LIST_DELAY', 'Specify the delay(in days) of this autoresponder from the date of subscription.');
define('_JNEWS_SUBS_LIST', 'This Auto-responder will be attached to the following selected lists:');
define('_JNEWS_SUBS_LIST2', 'Attach lists');
define('_JNEWS_SUBS_LIST_TIPS', 'Attach this auto-responder to the following lists . If a user subscribes to these lists they will also be subscribed to the autoresponder. ');
define('_JNEWS_PRIORD_LISTTYPE','Prioritized list type');
define('_JNEWS_PRIORD_LISTTYPE_TIPS', 'If there is a conflict between lists in subscription of a user prioritize either the list or the auto-responder.');
define('_JNEWS_PRIORD_SUBS','Prioritized subscription');
define('_JNEWS_PRIORD_SUBS_TIPS', 'If there is a conflict between subscription or unsubscription to a list prioritize either the subscription, unsubscription or just do nothing to the existing subscriptions.<br/><b>Ignore Changes</b>: We do not change the subscription if there is a conflict.<br/><b>Subscription</b>: We force the subscription of the user to the auto-responders.<br/><b>Unsubscription</b>: We unsubscribe the user from the auto-responder.');
define('_JNEWS_REMAIN_SUBS','Ignore Changes');
define('_JNEWS_UNSUBS','Unsubscription');
define('_JNEWS_SUBSCRIPTION_AR','Subscription to Auto-responder');
define('_JNEWS_SUBSCRIPTION_LIST','Subscription to List');
define('_JNEWS_YOUR_CRON', 'Your Cron url');
define('_JNEWS_LAUNCH_CRON', 'Launch Cron');

define('_JNEWS_SAFEUNSUBSCRIBE', 'Safe Unsubscribe');
define('_JNEWS_INVIUNPUB', 'The lists you subscribed are either in invisible status or unpublished.<br> Only the admin of the site can unsubscribe you from those lists as of now.');
define('_JNEWS_UNSUBSTOLISTS_MESSAGE','Are you sure you want to unsubscribe from these lists?');
define('_JNEWS_SELECT_ALLLISTS','Click to select all List');
define('_JNEWS_SELECT_ALLLAUTOR','Click to select all Auto-responder');
define('_JNEWS_UNSUBSLINK_TIP','Select yes if you prefer to show unsubscribe link on mailings');
define('_JNEWS_CHANGESUBSLINK_TIP','Select yes if you prefer to show subscription link on mailings for subscriber to change his subscription');
define('JNEWS_AUTOMATIC_CRON', 'An automatic cron is created upon the installation of jNews.<br/>This cron was automatically set up in joobi.co. This cron has the frequency of 15 minutes.');
define('_JNEWS_IMPORTSUB_TIPS','Import subscribers. The information in the file need to be to the following format: <b>Name, email, receiveHTML(1/0), <span style="color: rgb(255, 0, 0);">confirmed(1/0)</span></b>');
define('_JNEWS_NOSMARTTAG', 'The smartnewsletter doesn\'t contain a [SMARTNEWSLETTER] tag yet. Please insert the tag in the content.');
define('_JNEWS_DELETEBTN','Delete Queue');
define('_JNEWS_MENU_STOPQ','Stop Queue');
define('_JNEWS_MENU_STARTQ','Start Queue');
define('_JNEWS_MAILING_QUEUE_DELETED', 'The queue entry have been successfully deleted for this mailing.');
define('_JNEWS_QUEUE_SETTING','Queue Setting');
define('_JNEWS_QUEUESTATS_ON','On');
define('_JNEWS_QUEUESTATS_OF','Off');
define('_JNEWS_QUEUESTATS_TIPS','Turn On if you want the Process Queue to start or Off if you want it to stop.');
define('_JNEWS_MENU_STARTQ_MSG','The processing of queue has been started.');
define('_JNEWS_MENU_STOPQ_MSG','The processing of queue has been stopped.');
define('_JNEWS_QUEUESTATS_NOTIFY','The queue has been stopped if you want to continue proccessing it, you need to ');

//since
define('_JNEWS_NEW_URL_PASS_TIPS','Enter the password to be able to add a subscriber via url. Append the catcher variable passwordA in the URL.');
define('_JNEWS_CRON_PASSWORD', 'Cron Password');
define('_JNEWS_USE_CRON_PASS', 'Use Password for Cron');

//since 4.2.0
define('_JNEWS_QUEUE_STATUS','Queue Status');
define('_JNEWS_SMTPPORT','SMTP Port');
define('_JNEWS_SMARTQUEUE','Smart Queue');
define('_JNEWS_SMARTQ_ON','On');
define('_JNEWS_SMARTQ_OF','Off');
define('_JNEWS_SMARTQ_TIPS','Turn On if you want to enable the Smart processing of queue which will overcome your server limitation.');
define('_JNEWS_SUB_INFO_FIELDS', 'Show More Subscriber Info');
define('_JNEWS_SUB_INFO_FIELDS_TIPS', 'Show IP ,Register Date, User id and Black List fields in the subscriber form in the frontend');
define('_JNEWS_JSUB', 'Frontend Management');
define('_JNEWS_JSUB_TIPS', 'Choose if only the owner of the list or the super admin can only edit and create/view newsletters in the frontend. A user can own a list if he is subscribed via jSubscription');
define('_JNEWS_BYOWNER', 'By Owner');
define('_JNEWS_LIST_ACESS', 'By List Access');
define('_JNEWS_CAPTCHA_WARN',   'Cannot create Captcha Image either you do not have php GD Library installed or php GD Library has not been loaded with TFF support <br>Check your phpinfo() or you can turn off the Enable Captcha option from ');
define('_JNEWS_CAPTCHA_LINK','jNews Configuration under Subscriber Tab');
define('_JNEWS_MORE_TEMPLATES','More Templates');

//Since 5.0.0
define('_JNEWS_TAGMENU_K2CONTENT', 'K2 Contents');
define('_JNEWS_TAGMENU_VMPRODUCTS', 'Virtuemart Products');
define('_JNEWS_TEMPLATE_AVLB','Availability');
define('_JNEWS_TEMPLATE_INS','Installed');
define('_JNEWS_TEMPLATE_DWN','Download');
define('_JNEWS_TEMPLATE_FDWN','Free Download');
define('_JNEWS_TEMPLATE_IMG','Image');
define('_JNEWS_SUBS_INFO','You do not have subscription record to any mailing lists so it is not possible to unsubscribe here.');
define ('_JNEWS_UNSUBS_STATUS','You are already unsubscribe to the list.');
define('_JNEWS_CAPTCHAW', 'Captcha Width');
define('_JNEWS_CAPTCHAW_TIPS', 'Define the width of the captcha in the subscriber module');
define('_JNEWS_CAPTCHAH', 'Captcha Height');
define('_JNEWS_CAPTCHAH_TIPS', 'Define the height of the captcha in the subscriber module');
define('_JNEWS_CAPTCHA_MSG', 'Kindly enter the correct captcha code.');
define('_JNEWS_MCRYPT_MESSAGE', 'The captcha has been turned on without the mcrypt library enabled.<br>Kindly enable the mcrypt extension in your php.ini.<br>You may also want to disable captcha in ');

//Since 5.1.0
define('_JNEWS_FORCED_HTML', 'Send HTML Mailing Only?');
define('_JNEWS_FORCED_HTML_TIP','Yes if you want to force only html mailing will be sent to your subscribers.');

//Since social edition
define('_JNEWS_LISTS_CONFIG','Lists');
define('_JNEWS_LISTS_SETTINGS','Lists Settings');
define('_JNEWS_USE_MASTERLISTS','Use Master Lists?');
define('_JNEWS_USE_MASTERLISTS_TIPS','Yes if you want to use master lists [All Potential Site Members, All Registered Subscribers, All Front-end Lists Subscribers] of your subscribers, No otherwise');
define('_JNEWS_LIST_CREATORFE','Front-end List Creator');
define('_JNEWS_LIST_CREATORFE_TIPS','Define the access level who you will allow to create lists on Front-end');
define('_JNEWS_LIST_CREATORFE_WARN','(You need to specify here the group level of user who can create list on the frontend.)');

define('_JNEWS_BLOG_RENDERING', 'Blog Rendering');
define('_JNEWS_BLOG_TIPS', 'Full Blog: this will load the full blog in the newsletter<br>Intro Only: this will load the x number of characters of the blog with a read more link to the complete blog in your site');
define('_JNEWS_TAGMENU_BLOGS', 'Lyften Bloggie');
define('_JNEWS_TAGMENU_DEALS', 'Deal');
define('_JNEWS_DEALS_INTRO', 'Intro Box');
define('_JNEWS_DEALS_FULL', 'Full Description');
define('_JNEWS_DEAL_NAME', 'Deal Name/<br> Short Description');
define('_JNEWS_DEAL_INDUSTRY', 'Industry/<br> Country');
define('_JNEWS_DEAL_TARGET', 'Target Amount/<br> Inv Range');
define('_JNEWS_DEAL_TYPE_TIPS', 'Full Description: will include the entire deal in the newsletter.<br />' .
		'Intro box: will include only the introduction of the deal in the newsletter.<br/>');
define('_JNEWS_CONTENT_TIP', 'ID of the content to be inserted in the newsletter');
define('_JNEWS_CONTENT_ID', 'Content ID');
define('_JNEWS_BLOG_TIP', 'ID of the blog to be inserted in the newsletter');
define('_JNEWS_BLOG_ID', 'Blog ID');
define('_JNEWS_TAGMENU_JOMSOCIAL','JomSocial');
define('_JNEWS_TAGCAPTION_ALLCAT','All Categories'); //_JNEWS_TAG_ARTICLECATEGORY
define('_JNEWS_PLUG_INSTALLED','Plugin %s installed successfully');
define('_JNEWS_MODULE_INSTALLED','Module %s installed successfully');
define('_JNEWS_EMAIL_LISTS', 'Lists');
define('_JNEWS_LEADS_REP', 'Leads Reports');
define('_JNEWS_SUBSCRIBERS', 'Subscribers');
define('_JNEWS_ALLOW_SN', 'Allow Smart-Newsletter');
define('_JNEWS_ALLOW_SN_TIP', 'Allow creation of smart-newsletter in the frontend.');
define('_JNEWS_UNSUBSCRIBE_SUBJECT_NOT', 'Unsubscription Notification');
define('_JNEWS_RED_SUBSCRIPTION', 'Redirect After Subscription');
define('_JNEWS_RED_SUBS_TIP', 'Redirect page after subscription from the module.');
define('_JNEWS_PLEASE_WAIT', 'Please wait...');
define('_JNEWS_MOD_MESSAGE', 'Pop-up Subscription Message');
define('_JNEWS_MOD_MESSAGE_TIP', 'Select Yes to pop-up the subscription message. Select No to put the message in the module');

//since 6.1.0
define('_JNEWS_CREATE_NEWSUBS_TIPS', 'Specify here the default number of rows of subscribers information to be created or added in the front-end.');
define('_JNEWS_CREATE_NEWSUBS','Add New Subsbcribers in');
define('_JNEWS_ROWS', 'rows');
define('_JNEWS_USE_BACKENDVIEW', 'Add Subscribers Using Default View');
define('_JNEWS_USE_BACKENDVIEW_TIPS', 'Specify here if you want to add subscribers in front-end using the default view used in the back-end');

define('_JNEWS_TERMS_CONDITIONS', 'Terms and Condition');
define('_JNEWS_TERMS_WARN', 'Please check the terms and conditions option. To read the terms and conditions kindly click on the Terms and Conditions link');
define('_JNEWS_TERMS_LINK','Terms and Condtion Link');
define('_JNEWS_TERMS_LINK_TIPS','Enter the complete link for the terms and conditions here.<br><strong>(ex. http://www.yoursite.com/index.php?option=com_content&view=article&id=[article_id]&Itemid=[Item_id]</strong>');
define('_JNEWS_SHOW_TERMS','Show Terms and Condition');
define('_JNEWS_SHOW_TERMS_TIPS','Add the Terms and Condition in the subscriber module');
define('_JNEWS_CHECK_TERMS','Check Terms and Condition');
define('_JNEWS_CHECK_TERMS_TIPS','Check or uncheck the terms and condition by default.');

//since 7.0.0
define('_JNEWS_CRON_SYSTEM', 'Cron System');
define('_JNEWS_CRON_SYSTEM_TIPS', 'Defines the cron used to launched the automatic scheduling of jNews.<br><br> [0] <strong> No Cron </strong> - if you do not want to use the automatic sending of mailing.' .
		'<br><br>[1] <strong>jNews Cron System Plugin</strong> - if you want your jNews Cron will be triggered within your site itself.<br><br>[2] <strong>Joobi Cron</strong> - if you want to avail the free Cron Task provided by <a href="https://joobi.co">Joobi</a>. ' .
		'<br><br>[3] <strong>External Cron</strong> - if you prefer to have your own cron task on your server.');
define('_JNEWS_NO_CRON', 'No Cron');
define('_JNEWS_CRON_PLUGIN', 'jNews Cron System Plugin');
define('_JNEWS_CRON_JOOBI','Joobi Cron');
define('_JNEWS_CRON_EXTERNAL','External Cron');
define('JNEWS_CAPTCHA_FTWARN','Cannot view the captcha image because FreeType Support of your GD Library is disabled. ' .
		'<br/>You may go to the backend of your site -> Help -> System Info -> PHP Information Tab -> gd section and check if FreeType Support is enable or not. ' .
		'<br/> If disabled you can enable it in the php.ini file of your server.');

//since 7.1.0
define('_JNEWS_SUBSCRIPTION_SETTINGS', 'Subscription Settings');
define('_JNEWS_SUBNOTIFY_MSG', 'Subscribe Notify Message');
define('_JNEWS_SUBNOTIFY_MSG_TIPS','This message will be send to List Owner or List creator when a subscriber subscribes to the list. Any message can be entered here.');
define('_JNEWS_SUBSDEFAULT_NOTIFYMSG', '<p>Dear [LISTOWNERNAME],<br /> <br /></p>
<p style="padding-left: 30px;">This is an automated message from [SITE] to notify you that a user subscribed to your newsletter list.</p>
<p style="padding-left: 60px;"><strong>Details</strong></p>
<p style="padding-left: 60px;">Date and Time of Subscription: <strong>{tag:date}</strong><br />Subscriber Name: <strong>[SUBSCRIBERNAME]</strong><br />Subscriber Email: <strong>[SUBSCRIBEREMAIL]</strong></p>
<p style="padding-left: 60px;">Subscribed List: <strong>[LISTID] - [LISTNAME]</strong></p>
<p style="padding-left: 30px;">Please do not response to this message as it is automatically generated and is for information purposes only.</p>
<p> </p>
<p>Thank You!</p>');
define('_JNEWS_SUBS_NOTIFYSUBJECT','Subscription Notification');
define('_JNEWS_UNSUBS_NOTIFYSUBJECT','Unsubscription Notification');
define('_JNEWS_SENDTEST_CONFIGSUCC','If you receive this email, it means that you will be able to send any other e-email from the website.');
define('_JNEWS_SENDTEST_CONFIGERROR','Kindly review your mail configuration there might be some settings that were not set properly.');
define('_JNEWS_LIST_UNPUBMSG','Your list is unpublished, in order to use the list you created you need to publish it first.');
define('_JNEWS_LIST_INVIMSG','Your list is invisible on frontend, for your subscriber to see it you need to make your list visible first.');
define('_JNEWS_TEMPLATE_STYLE_TH5','Title h5');
define('_JNEWS_TEMPLATE_STYLE_TH6','Title h6');
define('_JNEWS_SENDTEST_TEMP','Send Test Template');
define('_JNEWS_NOCRON_USED','No cron task created or used for jNews.');

//since 7.2.0
define('_JNEWS_LISTS_UNSUBMSG','You are already unsubscribe from the Mailing Lists.');
define('_JNEWS_SEND_NEWSLETTER','Send Newsletter');
define('_JNEWS_MSG_SENT_SUCCESS', 'sent successfully to');
define('_JNEWS_MSG_SENT_FAIL', 'not sent successfully to');
define('_JNEWS_QUEUE_STATUSSEND', 'Queue Status');
define('_JNEWS_MENU_CONTINUE','Continue');
define('_JNEWS_QUEUE_EMPTYINFO','The queue is empty and there are no scheduled mailings to be processed.');
define('_JNEWS_QUEUE_READYTOSEND','Mailings Ready to be Sent');
define('_JNEWS_QUEUE_SCHEDULED','Scheduled Mailings');
define('_JNEWS_QUEUE_STILLONQUEUE','Mailings still on Queue at');
define('_JNEWS_SENDBTN','Send');

//since 7.3.0
define('_JNEWS_SMTPSECURE', 'SMTP Secure');
define('_JNEWS_SMTPSECURE_TIPS', 'If you use a SMTP Server, you can add a secure process before connecting to the SMTP Server.');
define('_JNEWS_NO_LISTS_AVAILABLE', 'No lists available for this type.');

//since 7.4.0
//define('_JNEWS_NO_LISTS_AVAILABLE', 'No lists available for this type.');
define('_JNEWS__LIST_HTML_EDITOR', 'List HTML editor is turned off. <br /> If you wish to add a description for the list kindly turn on the List Description editor in the Configuration>>Miscellaneoous tab.');
define('_JNEWS_TAGMODULE_REPLACE_MESSAGE', 'If your module tag was not replaced or has been replaced with an empty string, please check if the allow_url_fopen is set to on in your php.ini or if not please check if your server supports cURL.<br />It is a requirement to turn on the allow_url_fopen or curl to be able to replace the module tag in the preview and in sending from the backend. If you don\'t have either of the two the module tag will only be replaced if it is sent via the cron');
define('_JNEWS_QUEUE_PROCESS_ERROR', 'An error occured while retrieving queue entries to be processed; there is too much entries to be retrieved from the queue.<br /> Please reduce the maximum emails per task in the Scheduler tab in the jNews Configuration.');
define('_JNEWS_TOO_MUCH_CRON_MAX_EMAILS', 'You have too much max cron emails to be processed per task.<br /> Please reduce the number of emails to be processed per task to avoid a problem when loading the entries in the queue for processing. <br />Kindly lessen the maximum emails per task but increase the max cron frequency(frequency approved by your provider) to still send newsletters fast.');
define('_JNEWS_VIEW_BROWSER', 'View on the Browser');
define('_JNEWS_THE_MAILING', 'The mailing ');
define('_JNEWS_SENT_ALL', ' successfully sent to the subscribers.');
define('_JNEWS_NO_MAILINGS_YET', 'There are no mailings to be sent on this time.');
define('_JNEWS_CRON_TRIGGERRED', 'Last time cron triggered');
define('_JNEWS_CRON_TRIGGERRED_TIPS', 'Last time cron triggered');
define('_JNEWS_CRON_TRIGGERRED_ADD_INFO', 'Note: Even though the cron is triggerred it still can be that the queue and scheduled newsletters are not being processed.');
define('_JNEWS_UNSUBSCRIBE_ALL', 'Unsubscribe to All Lists');
define('_JNEWS_UNSUBSCRIBE_ALL_OR', 'or click here to Unsubscribe from All Lists');
define('_JNEWS_UNSUBSCRIBE_ALL_MESS', 'You have been unsubscribed from all lists!');
define('_JNEWS_UNSUBSCRIBE_ALL_CAPTION', 'Show Unsubscribe to All Lists');
define('_JNEWS_UNSUBSCRIBE_ALL_CAPTION_TIPS', 'Select Yes to show the Unsubscribe To All Lists button in the frontend.');
define('_JNEWS_ATTEMPTED', 'Attempted to send');
define('_JNEWS_RESCHEDULED', 'This newsletter has been rescheduled and will attempt to send again.');
define('_JNEWS_REACHED_MAX_ATTEMPT', 'Note: If the no. of attempts in trying to send the newsletter already exceeded the maximum no. of attempts, this entry will be deleted from the queue.');
define('_JNEWS_REGWARN_COLUMN','Please enter');
define('_JNEWS_COLUMN_SHOW','Show Column ');
define('_JNEWS_SHOW_COLUMN_TIPS','Show/hide this column in your subscribers list-BE');
define('_JNEWS_INPUT_COLUMN','Column ');
define('_JNEWS_INPUT_COLUMN_TIPS','Enter your column ');
define('_JNEWS_COLUMN_DESC', 'This will be replaced by your user defined column ');
define('_JNEWS_HELP', 'Help');
define('_JNEWS_SEND_LOG_TO_TIPS', 'Send mailing reports to this email. If none is specified the mailing report will be sent to the first admin of the site');
define('_JNEWS_SEND_LOG_TO', 'Send mailing reports to');
define('_JNEWS_ASSIGN_LIS_TEMPLATE', 'List Template');
define('_JNEWS_ASSIGN_LIS_TEMPLATE_TIPS', 'Select default template to be used for this list');
define('_JNEWS_AUTO_OPTION_NO_SYNC', 'Sync No Users');
define('_JNEWS_QUEUE_BLOCK', 'Block');
define('_JNEWS_QUEUE_UNBLOCK', 'Unblock');
define('_JNEWS_TAGMENU_MEDIA_SHARE', 'Social Share');
define('_JNEWS_JOOBI_CRON', 'Joobi Cron System');
define('_JNEWS_JOOBI_CRON_TIPS', 'Select Yes to publish Joobi Cron and be able to use this cron system. Select No if you don\'t want to use this cron. This cron will be triggered every 15 minutes.');
define('_JNEWS_JNEWS_CRON', 'jNews Cron System Plugin');
define('_JNEWS_JNEWS_CRON_TIPS', 'Select Yes to publish jNews Cron System Plugin and be able to use this cron system. Select No if you don\'t want to use this cron. This cron will be triggered ever 15 minutes.');
define('_JNEWS_JOOBICRON_YES', 'Yes');
define('_JNEWS_JOOBICRON_NO', 'No');
define('_JNEWS_TITLE', 'This will be replaced with the title of the newsletter.');

//since 7.5.x
define('_JNEWS_CREATE_DATE', 'Create Date');
define('_JNEWS_MENU_SEND_TEST_TEXT', 'Send Test Email(Text)');
define('_JNEWS_CRON_NEXTTRIGGER', 'Next Cron Task');
define('_JNEWS_CRON_NEXTTRIGGER_TIPS', 'This date indicate when the cron task will be able to be triggered. If the URL get triggered before that time it will NOT trigger the queue.');
define('_JNEWS_AUTONEWS_DATE', 'Start Date');
define('_JNEWS_AUTONEWS_DATE_TIPS', 'Created: will only include the article last created.<br />Modified: will include the article last created AND modifed.');
define('_JNEWS_AUTONEWS_DATE_CREATED', 'Created');
define('_JNEWS_AUTONEWS_DATE_MODIFIED', 'Modified');
define('_JNEWS_UNSUBCRIBERS_VIEW', 'Unsubscribed');
define('_JNEWS_UNSUBSCRIBER_CONFIG', 'Unsubscribers');
define('_JNEWS_SUB_LISTTYPE_ALL', 'All Subscribers');
define('_JNEWS_SUB_LISTTYPE_ONLY_SUBCRIBED', 'Subscribed');
define('_JNEWS_SUB_LISTTYPE_ONLY_UNSUBCRIBED', 'Unsubscribed');
define('_JNEWS_SUB_LISTTYPE_ONLY_WAITINGCONF', 'Waiting Confirmation' );
define('_JNEWS_SUB_LISTTYPE_ONLY_BLOCKED', 'Blocked Users');
define('_JNEWS_MENU_SEND_TESTSPAM', 'Test for Spam');
define('_JNEWS_SPAMTEXT_MESSAGE_SENT_SUCCESSFULLY', 'Spam Test Email successfully sent, please check your mail box!');
define('_JNEWS_AUTONEWS_NEXT_GEN', 'Next generated date' );
define('_JNEWS_AUTONEWS_NEXT_GEN_TIPS', 'The next time jNews will generate a Newsletter' );
define('_JNEWS_AUTONEWS_SMARTNEWS_PROCESS', 'The system processed the SmartNewsletter ( %s ) and found %s  new published articles between %s and %s .' );
define('_JNEWS_AUTONEWS_NO_SMARTNEWS_GENERATE_IDS', 'There is no SmartNewsletter to generate yet for the ID %s .' );
define('_JNEWS_AUTONEWS_NO_SMARTNEWS_GENERATE_DATE', 'A SmartNewsletter will be generated after this date: %s .' );
define('_JNEWS_AUTONEWS_NO_SMARTNEWS_GENERATE_TIME', 'The current time is: %s .' );
define('_JNEWS_NEWSLETTER_BE_SENT', ' will be sent to ' );
define('_JNEWS_NEWSLETTER_BE_SUBCRIBERS', 'subscribers.' );
define('_JNEWS_NEWSLETTER_BE_NEXT', 'The next mailing will be sent after %s .' );
define('_JNEWS_NEWSLETTER_BE_READY_SENT', ' ready to be sent to ' );
define('_JNEWS_DESC_SUPERPACK', 'jNews SuperPack the ultimate mailing system including lots of preloaded templates. jNews! Your Communication Partner!');
define('_JNEWS_DESC_SOCIAL', 'jNews Social the ultimate mailing system for your Social community. jNews! Your Communication Partner!');

//since 7.6.x
define('_JNEWS_SNTAG_NO_REQUIRED', 'Multi-Purpose Smart-Newsletter');
define('_JNEWS_SNTAG_NO_REQUIRED_TIP', 'If YES the Smart-Newsletter will NOT require a [SMARTNEWSLETTER] tag and therefore can be used to schedule anything else, eg: latest members in JomSocial or latest calendar events.');
define('_JNEWS_SEND_MAIL_EMAIL', 'From email');
define('_JNEWS_SEND_MAIL_EMAIL_TIPS', 'Choose what email will show as the sender.');
define('_JNEWS_SUB_REDIRECT_URL', 'Subscription redirect URL');
define('_JNEWS_SUB_REDIRECT_URL_TIPS', 'Specified a redirect URL for the front-end component subscirption form.');
define('_JNEWS_SUCCESS_ALREADY_SUB', 'Your email already exists in our mailing list.');
define('_JNEWS_SUBSCRIBE_NOTIFICATION', 'List Subscription Notification');
define('_JNEWS_SUBSCRIBE_NOTIFICATION_TIPS', 'Specified a list of emails seperated by comma (,) to which you want the subscription notification to be sent to.');
define('_JNEWS_UNSUBSCRIBE_NOTIFICATION', 'List Unsubscription Notification');
define('_JNEWS_UNSUBSCRIBE_NOTIFICATION_TIPS', 'Specified a list of emails seperated by comma (,) to which you want the unsubscription notification to be sent to.');
define('_JNEWS_COMPONENT_THEME', 'Component Theme');
define('_JNEWS_COMPONENT_THEME_TIPS', 'Choose the theme you want to use for back-end and front-end.');
define('_JNEWS_TAGSITE_THEME', 'Display newsletter');
define('_JNEWS_TAGSITE_THEME_TIPS', 'Define if you want to display only the newsletter or if you want to include also Joomla template.');
define('_JNEWS_TAG_INSERT_TAG', 'Insert Tag');
define('_JNEWS_ALLOW_FE_AUTORESPONDERS', 'Allow FE Auto-Responders');
define('_JNEWS_ALLOW_FE_AUTORESPONDERS_TIPS', 'Allow the creation of auto-responders in the frontend.');

//since 7.7.x
define('_JNEWS_ARCHIVELINK_STANDARD', 'Standard');
define('_JNEWS_ARCHIVELINK_POPUP', 'Pop-Up');
define('_JNEWS_ARCHIVELINK_PAGE', 'New Page');
define('_JNEWS_ARCHIVE_LINK', 'Link to Archive');
define('_JNEWS_ARCHIVE_LINK_TIPS', 'Chose the type of link / windows for the display of the archived newsletter.');
define('_JNEWS_AUTONEWS_DATE_PUBLISHUP', 'Start Publishing');
define('_JNEWS_AUTONEWS_NO_ARTICLE', 'There is no Article to add to the Smart Newsletter at this moment.');
define('_JNEWS_CAPTCHA_TIPS', 'Enter Security Code Here');
define('_JNEWS_EXPORT_TEXT_ALL','All subscribers will be exported!');

//since 8.0.x
define('_JNEWS_HIDE_TITLE','Hide title');
define('_JNEWS_HIDE_TITTLE_ARTICLE_TIPS', 'Yes to hide the title of the inserted article.'); 
define('_JNEWS_UNSUBSCRIBE_MESSAGE_TEXTAREA', 'Please let us know why you unsubscribe:'); 
define('_JNEWS_UNSUBSCRIBE_MESSAGE_TEXTAREA_TITLE', 'Feedback');

// since 8.3.x
define('_JNEWS_DKIM_SETTINGS', 'DKIM Settings');
define('_JNEWS_DKIMACTIVATED_TIPS', 'If you want your emails to have the DKIM signature , select yes to activate DKIM');
define('_JNEWS_DKIMACTIVATED', 'Activate  DKIM ?');
define('_JNEWS_PRIVATE_KEY_PATH_TIPS', 'Provide the path for the system to access your DKIM private key. e.g. If the file has been kept along with the .htaccess the value to be entered here would be /.htkeyprivate. If its inside a folder then /xyz/.htkeyprivate');
define('_JNEWS_PRIVATE_KEY_PATH', 'Private Key Location');
define('_JNEWS_DKIM_PASSPHRASE_TIPS', 'Enter the passphrase that was created while generating the public-private keys. e.g. 123456789');
define('_JNEWS_DKIM_PASSPHRASE', 'Passphrase');
