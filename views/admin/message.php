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
	
	<div id="tabs">
		<ul >
			<li><a href="#inbox">Inbox</a></li>
			<li><a href="#send">Send Message</a></li>
			<li><a href="#sent">Sent Mail</a></li>
		</ul>
		<div id="inbox">
			
			<table class="widefat">
				<thead>
					<tr>
						<th>#</th>
						<th>From</th>
						<th>Subject</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1;?>
					<?php foreach($inboxes as $msg) {?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php
								$by = get_userdata($msg['msg_from']);
								echo $by->data->display_name;
							?></td>
							<td><a href="<?php echo admin_url("admin.php?page=vmp-msgs&view=single&id=".$msg['id']);?>"><?php echo $msg['subject'];?></a></td>
							<td><a href="">View</a> | <a href="">Reply</a> | <a href="">Delete</a></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>From</th>
						<th>Subject</th>
						<th>Actions</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<div id="send">
			<form action="<?php echo admin_url('admin.php?page=vmp-msgs&view=send-msg');?>" method="post">
				<h3>Send Message</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="to">Send To</label></th>
							<td>
								<?php $roles = unserialize(get_option('vmp_user_roles'));?>
								<?php $users = array();?>
								<?php foreach($roles as $role=>$val) {
									$temp = get_users(array('role' => $role));
									foreach($temp as $user){
										$users[] = $user;
									}
								} ?>
								<select name="msgTo[]" id="to" multiple="multiple" class="regular-text" style="width: 25em;">
									<?php foreach($users as $user) { ?>
										<option value="<?php echo $user->ID;?>"><?php echo $user->data->display_name;?></option>										
									<?php } ?>
								</select>
								<span class="description">Start Typing and Select user from the DropDown</span>
							</td>
						</tr>
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><input name="subject" type="text" placeholder="Subject.." class="regular-text"></td>
						</tr>
						<tr>
							<th><label for="message">Message</label></th>
							<td>
								<?php wp_editor("", "message",array('textarea_rows' => 5));?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input name="send-msg" type="submit" class="button-primary" value="Send"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<div id="sent" >
			<table class="widefat">
				<thead>
					<tr>
						<th>#</th>
						<th>From</th>
						<th>Subject</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Varun Srinivas</td>
						<td><a href="#message">Lorem Ipsum Dolor Sit Amet.</a></td>
						<td><a href="">View</a> | <a href="">Reply</a> | <a href="">Delete</a></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>#</th>
						<th>From</th>
						<th>Subject</th>
						<th>Actions</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
