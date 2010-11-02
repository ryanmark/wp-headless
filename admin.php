<?php 
function headless_view() {
?><div class="wrap">
	<h2><?php _e( 'Headless' ); ?></h2>
	<form name="headless" method="post" action="admin.php">
		<h4><?php _e( 'Permalink format' ); ?></h4>
		<div>
			<p><input style="width: 300px;" type="text" name="headless_url" value="<?php echo $headless_url ?>" /></p>
		</div>
		
		 <p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options' ) ?>" /></p>
	</form>
</div>
<?php } ?>
