<?php
/*
 * Captcha setting's for registers, login, etc.
 * Use CI captcha plugin
 */
$config['au_capcha_use'] = TRUE;
$config['au_captcha_store_path'] = './tmp/';
$config['au_captcha_img_url'] = base_url().'tmp/';

/*
 *  Confirm registration via e-mail
 */
$config['registers_via_email'] = TRUE;

/*
 * Real user ID in browser cookie * this value  for best security
 * If cookie ID is hacked system immediately log out
 *  value =  1..99
 */
$config['id_offset'] = 3;

/*
 * Time for log off from temporary login
 */
$config['autologin_timeout'] = 300; // 5 min

/*
 * Used lang for this auth system 
 */
$config['au_language'] = 'english';

/*
 *  E-mail "from" used for registers via e-mail 
 */
$config['admin_email'] = 'admin@site.com';

/*
 *     If turn ON, system check for table exist in DB  and create it, when need.
 *     Set "ON" for first time, then turn OFF
 */
$config['check_if_tables_exist'] = TRUE;
?>