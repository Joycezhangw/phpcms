<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad_10">
    <div class="common-form">
        <form name="myform" action="?m=sms&c=sms&a=sms_setting" method="post" id="myform">
            <table width="100%" class="table_form">
                <tr>
                    <td  width="120"><?php echo L('sms_enable')?></td>
                    <td><input name="setting[sms_enable]" value="1" type="radio" id="sms_enable" <?php if($this->sms_setting[sms_enable] == 1) {?>checked<?php }?>> <?php echo L('open')?>
                        <input name="setting[sms_enable]" value="0" type="radio" id="sms_enable" <?php if($this->sms_setting[sms_enable] == 0) {?>checked<?php }?>> <?php echo L('close')?></td>
                </tr>
                <tr>
                    <td width="200">AccessKeyId <font color="#C0C0C0">(<?php echo L('aliyun_sms_key') ?>)</font></td>
                    <td><input type="text" name="setting[aliyun_sms_key]" size="50"
                               value="<?php echo $this->sms_setting[aliyun_sms_key] ?>" id="aliyun_sms_key"></td>
                </tr>
                <tr>
                    <td width="200">AccessKeySecret <font color="#C0C0C0">(<?php echo L('aliyun_sms_secret') ?>)</font>
                    </td>
                    <td><input type="text" name="setting[aliyun_sms_secret]" size="50"
                               value="<?php echo $this->sms_setting[aliyun_sms_secret] ?>" id="aliyun_sms_secret"></td>
                </tr>
                <tr>
                    <td width="200">SignName <font color="#C0C0C0">(<?php echo L('aliyun_sms_sign_name') ?>)</font></td>
                    <td><label><input type="text" id="aliyun_sms_sign_name" name="setting[aliyun_sms_sign_name]"
                                      value="<?php echo $this->sms_setting[aliyun_sms_sign_name] ?>" size="50">
                            <input type="hidden" name="pc_hash" value="<?php echo $_GET['pc_hash']; ?>"
                                   size="50"></label>
                    </td>
                </tr>


            </table>
            <div class="bk15"></div>
            <input name="dosubmit" type="submit" value="<?php echo L('submit') ?>" class="button" id="dosubmit">
        </form>
    </div>
</div>
</body>
</html>