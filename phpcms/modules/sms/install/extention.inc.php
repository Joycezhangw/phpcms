<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name' => 'sms', 'parentid' => '29', 'm' => 'sms', 'c' => 'sms', 'a' => 'init', 'data' => '', 'listorder' => 0, 'display' => '1'), true);
$menu_db->insert(array('name' => 'sms_setting', 'parentid' => $parentid, 'm' => 'sms', 'c' => 'sms', 'a' => 'sms_setting', 'data' => '', 'listorder' => 0, 'display' => '1'));
$menu_db->insert(array('name' => 'sms_scenes', 'parentid' => $parentid, 'm' => 'sms', 'c' => 'sms', 'a' => 'sms_scenes', 'data' => '', 'listorder' => 0, 'display' => '1'));
$menu_db->insert(array('name' => 'sms_scenes_add', 'parentid' => $parentid, 'm' => 'sms', 'c' => 'sms', 'a' => 'sms_scenes_add', 'data' => '', 'listorder' => 0, 'display' => 0));

$language = array(
    'sms' => '短信平台',
    'sms_setting' => '平台设置',
    'sms_scenes' => '场景设置',
    'sms_scenes_add' => '添加场景',
);
?>