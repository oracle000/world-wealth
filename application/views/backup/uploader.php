


	<?php echo form_open_multipart('portal/uploader'); ?>
	<div class="futitle"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</div>
	<div id="formuploader">
		<div id="fuwrapper">
			<div id="uploadcol"><input type="file" name="userfile" size="20" /></div>
			<div id="uploadcol">
				<span><input type="submit" value="Upload" /></span>
				<span class="uploaderror"><?php echo $error;?></span>
			</div>
		</div>
	</div>
</div>
</body>
</html>

