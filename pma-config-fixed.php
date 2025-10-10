<?php
$cfg['blowfish_secret'] = 'this_should_be_random_min_32_chars_abcdef123456';
$i = 0;
$i++;
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['host'] = 'hudson-mysql';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = 'password';
$cfg['Servers'][$i]['AllowNoPassword'] = false;
