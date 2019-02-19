<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*$config['protocol'] = 'smtp';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_user'] = 'khmg13@gmail.com';
$config['smtp_pass'] = 'kehumoga_131193';
$config['smtp_port'] = 465;
$config['smtp_crypto'] = 'ssl';*/
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';