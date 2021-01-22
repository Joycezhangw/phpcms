<?php


class smsapi
{

    /**
     * 发送短信
     * @param string $scense 场景
     * @param string $mobile 手机号码
     * @param string $content 短信内容
     * @param int $return_code
     * @return mixed
     */
    public function send_sms($scense='',$mobile='', $content='',$return_code = 0) {
        pc_base::load_app_class('aliSms', 'sms', 0);
        $siteid = get_siteid() ? get_siteid() : 1;
        $sms_setting = getcache('sms', 'sms');
        if ($sms_setting[$siteid]['aliyun_sms_key']==''){
            return -104;//$status['-104'];
        }
        if ($sms_setting[$siteid]['aliyun_sms_secret']==''){
            return -105;//$status['-105'];
        }
        if ($sms_setting[$siteid]['aliyun_sms_sign_name']==''){
            return -106;//$status['-106'];
        }
        $smsScenesModel = pc_base::load_model('sms_scenes_model');
        $scenesInfo=$smsScenesModel->get_one(['scenes_name'=>$scense]);

        if(!$scenesInfo){
            return -107;//$status['-107'];
        }
        try {
            $sms = new aliSms($sms_setting[$siteid]['aliyun_sms_key'], $sms_setting[$siteid]['aliyun_sms_secret']);
            $sms->setAction('SendSms')->setOptions([
                'PhoneNumbers' => $mobile,
                'SignName' => $sms_setting[$siteid]['aliyun_sms_sign_name'],
                'TemplateCode' => $scenesInfo['template_id'],
                'OutId' => $scense,
                'TemplateParam' => '{"code":"'.$content.'"}',
            ])->execute();
            $sms_report_db = pc_base::load_model('sms_report_model');
            $send_userid = param::get_cookie('_userid') ? intval(param::get_cookie('_userid')) : 0;
            $ip = ip();
            $sms_report_db->insert(array('mobile'=>$mobile,'posttime'=>SYS_TIME,'id_code'=>$scense,'send_userid'=>$send_userid,'status'=>200,'msg'=>$new_content,'return_id'=>'','ip'=>$ip));
            return 200;
        } catch (Exception $exception) {
            return $exception->getCode();
//            echo 'Code: ', $exception->getCode(), "\n";
//            echo 'Error: ', $exception->getMessage(), "\n";
        }
    }

    /**
     * 安全过滤函数
     *
     * @param $string
     * @return string
     */
    private function _safe_replace($string) {
        $string = str_replace('%20','',$string);
        $string = str_replace('%27','',$string);
        $string = str_replace('%2527','',$string);
        $string = str_replace('*','',$string);
        $string = str_replace('"','&quot;',$string);
        $string = str_replace("'",'',$string);
        $string = str_replace('"','',$string);
        $string = str_replace(';','',$string);
        $string = str_replace('<','&lt;',$string);
        $string = str_replace('>','&gt;',$string);
        $string = str_replace("{",'',$string);
        $string = str_replace('}','',$string);
        $string = str_replace('\\','',$string);
        return $string;
    }

}