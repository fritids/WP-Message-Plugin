<?php
/**
 *
 * @package   Varun's Message Plugin
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
					<tr>
						<td>1</td>
						<td>Varun Srinivas</td>
						<td><a href="<?php echo admin_url("admin.php?page=vmp-msgs&view=single");?>">Lorem Ipsum Dolor Sit Amet.</a></td>
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
		<div id="send">
			<form action="">
				<h3>Send Message</h3>
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="to">Send To</label></th>
							<td><input type="text" placeholder="To.." class="regular-text"> <span class="description">Start Typing and Select user from the DropDown</span></td>
						</tr>
						<tr>
							<th><label for="subject">Subject</label></th>
							<td><input type="text" placeholder="Subject.." class="regular-text"></td>
						</tr>
						<tr>
							<th><label for="message">Message</label></th>
							<td>
								<?php wp_editor("", "message");?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" class="button-primary" value="Send"></td>
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
