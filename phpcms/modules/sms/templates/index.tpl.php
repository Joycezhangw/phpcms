<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<div class="pad_10">
    <div class="table-list">
        <form name="smsform" action="" method="get" >
            <input type="hidden" value="sms" name="m">
            <input type="hidden" value="sms" name="c">
            <input type="hidden" value="init" name="a">
            <input type="hidden" value="<?php echo $_GET['menuid']?>" name="menuid">
        </form>

        <div class="explain-col search-form">
            开启会员注册短信验证方法：后台->用户->会员模块配置->手机强制验证方式 选择 <font color="red">是</font>
        </div>
    </div>
</div>
<div class="pad_10">
    <div class="table-list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="20%"><?php echo L('scenes')?></th>
                <th width="15%"><?php echo L('mobile')?> </th>
                <th width="25%"><?php echo L('send_content')?> </th>
                <th width="10%"><?php echo L('userid')?> </th>
                <th width="10%"><?php echo L('sendtime')?> </th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(is_array($list)){
                $amount = $point = 0;
                foreach($list as $info){
                    ?>
                    <tr>
                        <td width="10%" align="center"><?php echo $info['id']?></td>
                        <td width="20%" align="center"><?php echo $info['id_code']?></td>
                        <td width="20%" align="center"><?php echo $info['mobile']?></td>
                        <td width="20%" align="center"><?php echo $info['msg']?></td>
                        <td width="10%" align="center"><?php echo $info['send_userid']?></td>
                        <td width="10%" align="center"><?php echo date('Y-m-d H:i:s',$info['posttime'])?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>

        <div id="pages"> <?php echo $pages?></div>
    </div>
</div>
<br>
<br>
</body>
</html>