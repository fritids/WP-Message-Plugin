<?php
/**
 *
 * @package   vmp
 * @author    Varun Srinivas<varun@varun1505.com>
 * @license   GPL-2.0+
 * @link      http://varun1505.com
 * @copyright 2013 SudoSaints
 */
?>
<div class="wrap">
	<?php screen_icon('messages'); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<hr/>
	<form method="post" action="<?php echo admin_url('admin.php?page=vmp-settings') ?>">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">User Roles</th>
					<td>
						<fieldset>
							<?php
							global $wp_roles;
							$roles = $wp_roles->get_names();
							$selected = unserialize(get_option('vmp_user_roles'));
							foreach($roles as $key=>$role) { ?>
								<input name="<?php echo $key?>" type="checkbox" id="" <?php echo array_key_exists($key, $selected)?'checked="checked"':'';?>><?php echo $role; ?>
								<br/>
							<?php } ?>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
		</p>
	</form>
	
</div>