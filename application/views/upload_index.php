<?php echo validation_errors(); ?>

<div class="upload-title">
    分享你的资料
</div>

<?php echo form_open('upload'); ?>
<h5>资料名称</h5>
<input type="text" name="filename" value="<?php echo set_value('filename'); ?>" size="50" class="file-title" />
<h5>资料简述</h5>
<input type="text" name="fileinfo" value="<?php echo set_value('fileinfo'); ?>" size="50" class="file_info" />
<h5>资料地址</h5>
<input type="text" name="fileaddr" value="<?php echo set_value('fileaddr'); ?>" size="50" />

<div><input type="submit" value="提交" /></div>
