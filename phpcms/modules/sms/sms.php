<?php
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin', 'admin', 0);
pc_base::load_sys_class('form', '', 0);
pc_base::load_sys_class('format', '', 0);
pc_base::load_app_func('global', 'sms');

class sms extends admin
{

    function __construct()
    {
        parent::__construct();
        $this->log_db = pc_base::load_model('sms_report_model');
        $this->module_db = pc_base::load_model('module_model');
        $this->member_db = pc_base::load_model('member_model');

        //获取短信平台配置信息
        $siteid = get_siteid();
        $this->sms_setting_arr = getcache('sms');
        if (!empty($this->sms_setting_arr[$siteid])) {
            $this->sms_setting = $this->sms_setting_arr[$siteid];
        } else {
            $this->sms_setting = array (
                'sms_enable' => '1',
                'aliyun_sms_key' => '',
                'aliyun_sms_secret' => '',
                'aliyun_sms_sign_name' => '',
            );
        }

        //初始化smsapi
    }

    public function init()
    {
        $page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
        $list = $this->log_db->listinfo('', '`id` desc', $page);
        $pages = $this->log_db->pages;
        include $this->admin_tpl('index');
    }

    public function sms_setting()
    {
        $siteid = get_siteid();
        if (isset($_POST['dosubmit'])) {
            $this->sms_setting_arr[$siteid] = $_POST['setting'];
            $setting = array2string($this->sms_setting);
            setcache('sms', $this->sms_setting_arr);
            $this->module_db->update(array('setting'=>$setting),array('module'=>'sms'));
            showmessage(L('operation_success'), HTTP_REFERER);
        } else {
            $show_pc_hash = '';
            include $this->admin_tpl('sms_setting');
        }
    }

    public function sms_scenes()
    {
        $big_menu = array('javascript:window.top.art.dialog({id:\'sms_scenes_add\',iframe:\'?m=sms&c=sms&a=sms_scenes_add\', title:\'' . L('sms_add_scenes') . '\', width:\'700\', height:\'300\', lock:true}, function(){var d = window.top.art.dialog({id:\'sms_scenes_add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'sms_scenes_add\'}).close()});void(0);', L('sms_add_scenes'));
        $smsScenesModel = pc_base::load_model('sms_scenes_model');
        $page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
        $list = $smsScenesModel->listinfo('', '`id` desc', $page);
        $pages = $smsScenesModel->pages;
        include $this->admin_tpl('sms_scenes');
    }

    public function sms_scenes_add()
    {
        pc_base::load_app_func('global');
        if (isset($_POST['dosubmit'])) {
            $smsScenesModel = pc_base::load_model('sms_scenes_model');
            $template_id = isset($_POST['template_id']) && trim($_POST['template_id']) ? trim($_POST['template_id']) : showmessage(L('sms_template_id') . L('empty'));
            $scenes_name = isset($_POST['scenes_name']) && trim($_POST['scenes_name']) ? trim($_POST['scenes_name']) : showmessage(L('sms_scenes_name') . L('empty'));
            $sms_content = isset($_POST['sms_content']) && trim($_POST['sms_content']) ? trim($_POST['sms_content']) : showmessage(L('sms_send_content') . L('empty'));

            //检查短信模板是否已经存在
            if ($smsScenesModel->get_one(array('template_id' => $template_id))) {
                showmessage(L('sms_template_id') . L('exists'));
            }
            //检查短信模板是否已经存在
            if ($smsScenesModel->get_one(array('scenes_name' => $scenes_name))) {
                showmessage(L('sms_scenes_name') . L('exists'));
            }
            $sql = array();
            //初始化数据
            $sql['template_id'] = $template_id;
            $sql['scenes_name'] = $scenes_name;
            $sql['sms_content'] = $sms_content;
            $sql['addtime'] = time();
            if ($smsScenesModel->insert($sql, true)) {
                showmessage('', '', '', 'sms_scenes_add');
            } else {
                showmessage(L('operation_failure'));
            }
        } else {
            $show_header = $show_validator = true;
            include $this->admin_tpl('sms_scenes_add');
        }
    }


}










