<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad_10">
    <div class="table-list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="20%"><?php echo L('sms_scenes_name')?></th>
                <th width="15%"><?php echo L('sms_template_id')?> </th>
                <th width="25%"><?php echo L('sms_send_content')?> </th>
                <th width="10%"><?php echo L('addtime')?> </th>
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
                        <td width="20%" align="center"><?php echo $info['scenes_name']?></td>
                        <td width="20%" align="center"><?php echo $info['template_id']?></td>
                        <td width="20%" align="center"><?php echo $info['sms_content']?></td>
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
</body>
</html>