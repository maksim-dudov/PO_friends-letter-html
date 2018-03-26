<?php
echo '<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>';

// get the list of email addresses
require_once('email_lib.php');

// echo welcom page with possible links
if (!isset($_GET['tpl']))
    echo '<br /><br />'
    .'<a href="?tpl=1">Разослать шаблон №1</a>'
    .'<br /><br /><br /><br />'
    .'<a href="?tpl=2">Разослать шаблон №2</a>';

// handle mail delivery
else {
    $template_numder = isset($_GET['tpl']) ? $_GET['tpl'] : '';
    $file_path = './template_'.$template_numder.'.html';
    if (file_exists($file_path) === false) die('Номер шаблона либо указан неверною');

    $content = file_get_contents($file_path);
    $subject = 'Friends Hostels - mail delivery test - '.date('d.m.Y H:i:s');
    $headers = 'Content-type: text/html; charset=UTF-8' . "\r\n";

    $result[]='';

    // emails sending
    foreach($mail_addresses as $email){
        $result[$email] = mail($email,$subject,$content)?'ok':'failure';
    }

    // print the results
    foreach($mail_addresses as $email){
        echo $email.' - '.$result[$email].'<br />';
    }

    echo '<br /><br />'
        .'<a href="/">Вернуться на главную</a>';
}