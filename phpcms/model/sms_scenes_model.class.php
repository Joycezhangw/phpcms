<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);

/**
 * 阿里云短信模板配置
 * Class sms_scenes_model
 */
class sms_scenes_model extends model
{
    public function __construct()
    {
        $this->db_config = pc_base::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'sms_scenes';
        parent::__construct();
    }
}

?>