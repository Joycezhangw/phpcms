<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<script type="text/javascript">
    <!--
    $(function(){
        $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'})}});
    })
    //-->
</script>
<div class="pad-10">
    <form action="?m=sms&c=sms&a=sms_scenes_add" method="post" id="myform">
        <table width="100%"  class="table_form">
            <tr>
                <th width="80"><?php echo L('sms_scenes_name')?>：</th>
                <td class="y-bg"><input type="text" class="input-text" name="scenes_name" id="scenes_name" size="30" /></td>
            </tr>
            <tr>
                <th width="80"><?php echo L('sms_template_id')?>：</th>
                <td class="y-bg"><input type="text" class="input-text" name="template_id" id="template_id" size="30" /></td>
            </tr>
            <tr>
                <th width="80"><?php echo L('sms_send_content')?>：</th>
                <td class="y-bg">
                    <textarea class="input-text" name="sms_content" id="sms_content" rows="5" cols="30"></textarea>
                </td>
            </tr>
        </table>
        <div class="bk15"></div>
        <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="" />
</div>
    </form>
</div>

</body>
</html>