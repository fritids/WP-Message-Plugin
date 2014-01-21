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
	
	<div class="single">
		<h3 class="subject"><?php echo $single->getSubject();?></h3>
		<div class="message">			
			<div class="from"><strong><?php echo get_userdata($single->getFrom())->data->display_name;?></strong></div>
			
			<br/>
			<div class="message-content">
				<?php echo $single->getMessage();?>
			</div>
			<div class="options">
				<a href="">Reply</a> | <a href="">Reply to All</a> | <a href="">Delete</a>
			</div>
			<hr/>
		</div>
		<!-- <div class="message">
			<div class="from"><strong>John Doe</strong></div>
			<br/>
			<div class="message-content">
				Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui.
			</div>
			<div class="options">
				<a href="">Reply</a> | <a href="">Reply to All</a> | <a href="">Delete</a>
			</div>
			<hr/>
		</div>
		<div class="message">
			<div class="from"><strong>Varun Srinivas</strong></div>
			<br/>
			<div class="message-content">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
			<div class="options">
				<a href="">Reply</a> | <a href="">Reply to All</a> | <a href="">Delete</a>
			</div>
			<hr/>
		</div> -->
	</div>
	
</div>