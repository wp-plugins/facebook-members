<?php
/*
Plugin Name: Facebook Members
Plugin URI: http://crunchmeme.com/plugins/facebook-members/
Description: Facebook Members is a WordPres Social Plugin that enables Facebook Page owners to attract and gain Likes from their own website. It uses Like Box.
Version: 2.4.5
Author: Arpit Shah
Author URI: http://arpitshah.com
*/

/*
    Copyright (C) 2009-10 Arpit Shah.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Some default options
add_option('as_facebook_mem_page_name', 'wordpress');
add_option('as_facebook_mem_width', '292');
add_option('as_facebook_mem_height', '255');
add_option('as_facebook_mem_no_connection', '10');
add_option('as_facebook_mem_stream', 'false');
add_option('as_facebook_mem_header', 'true');

add_option('as_facebook_mem_widget_page_name', 'wordpress');
add_option('as_facebook_mem_widget_title', 'Like Box');
add_option('as_facebook_mem_widget_width', '292');
add_option('as_facebook_mem_widget_height', '255');
add_option('as_facebook_mem_widget_stream', 'false');
add_option('as_facebook_mem_widget_no_connection', '10');

function filter_as_facebook_mem_likebox($content)
{
    if (strpos($content, "<!--facebook-members-->") !== FALSE)
    {
        $content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        $content = str_replace('<!--facebook-members-->', as_facebook_mem_likebox(), $content);
    }
    return $content;
}


function as_facebook_mem_likebox()
{
	$fm_pagename = get_option('as_facebook_mem_page_name');
	$fm_width = get_option('as_facebook_mem_width');
	$fm_height = get_option('as_facebook_mem_height');
	$fm_no_connection = get_option('as_facebook_mem_no_connection');
	$fm_stream = get_option('as_facebook_mem_stream');
	$fm_header = get_option('as_facebook_mem_header');

	$fm_widget_title = get_option('as_facebook_mem_widget_title');
	$fm_widget_width = get_option('as_facebook_mem_widget_width');
	$fm_widget_height = get_option('as_facebook_mem_widget_height');

	$sponsor_link1 = '<font size="1"><br/><i> Generated by: <a href="http://crunchmeme.com/plugins/facebook-members/" target="_blank">Facebook Members</a></i></font>';

	$T1 = '<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F' . $fm_pagename . '&amp;width='.$fm_width.'&amp;connections='.$fm_no_connection.'&amp;stream='.$fm_stream.'&amp;header='.$fm_header.'&amp;height='.$fm_height.'" scrolling="no"  frameborder="0" style="border:none; overflow:hidden; width:'.$fm_width.'px; height:'.$fm_height.'px;" allowTransparency="true"></iframe>';

	$output = $T1 . $sponsor_link1;

	return $output;
}



// Displays Wordpress Blog Facebook Members Options menu
function as_facebook_mem_add_option_page() {
    if (function_exists('add_options_page')) {
        add_options_page('Facebook Members', 'Facebook Members', 8, __FILE__, 'as_facebook_mem_options_page');
    }
}

function as_facebook_mem_options_page() {

	$as_facebook_mem_stream = $_POST['as_facebook_mem_stream'];
	$as_facebook_mem_header = $_POST['as_facebook_mem_header'];
	$as_facebook_mem_widget_stream = $_POST['as_facebook_mem_widget_stream'];

    if (isset($_POST['info_update']))
    {
		update_option('as_facebook_mem_page_name', (string)$_POST["as_facebook_mem_page_name"]);
        update_option('as_facebook_mem_width', (string)$_POST["as_facebook_mem_width"]);
        update_option('as_facebook_mem_height', (string)$_POST['as_facebook_mem_height']);
		update_option('as_facebook_mem_no_connection', (string)$_POST['as_facebook_mem_no_connection']);
		update_option('as_facebook_mem_widget_title', (string)$_POST['as_facebook_mem_widget_title']);


		update_option('as_facebook_mem_widget_page_name', (string)$_POST['as_facebook_mem_widget_page_name']);
		update_option('as_facebook_mem_widget_title', (string)$_POST['as_facebook_mem_widget_title']);
		update_option('as_facebook_mem_widget_width', (string)$_POST['as_facebook_mem_widget_width']);
		update_option('as_facebook_mem_widget_height', (string)$_POST['as_facebook_mem_widget_height']);
		update_option('as_facebook_mem_widget_stream', (string)$_POST['as_facebook_mem_widget_stream']);
		update_option('as_facebook_mem_widget_no_connection', (string)$_POST['as_facebook_mem_widget_no_connection']);

		update_option('as_facebook_mem_stream', (string)$_POST['as_facebook_mem_stream']);
		update_option('as_facebook_mem_header', (string)$_POST['as_facebook_mem_header']);
		update_option('as_facebook_mem_widget_stream', (string)$_POST['as_facebook_mem_widget_stream']);

        echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
        echo '</strong></p></div>';
    }else
	{
			$as_facebook_mem_stream = get_option('as_facebook_mem_stream');
			$as_facebook_mem_header = get_option('as_facebook_mem_header');
			$as_facebook_mem_widget_stream = get_option('as_facebook_mem_widget_stream');
	}

    $new_icon = '<img border="0" src="'.$icon_url.'/wp-content/plugins/facebook-members/new.gif" /> ';

    ?>

    <div class="wrap">

    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <input type="hidden" name="info_update" id="info_update" value="true" />


    <u><h2>Facebook Members Like Box Plugin</h2></u>


	<div id="poststuff" class="metabox-holder has-right-sidebar" >
		<div style="float:left;width:60%;">

			<div class="postbox">
				<h3>Facebook Members - Option Panel <?=$new_icon?></h3>
				<div>
				<table class="form-table">

				<tr valign="top" class="alternate">
          			<th scope="row" style="width:29%;"><label>Facebook Page Name</label></th>
                      <td><textarea name="as_facebook_mem_page_name" cols="18" rows="1"><?php echo get_option('as_facebook_mem_page_name'); ?></textarea>
                      <a href="http://www.facebook.com/pages/create.php" target="_blank">Create Fanpage</a>
                      </td>

				</tr>
				<tr valign="top">
          			<th scope="row" style="width:29%;"><label>Like Box Width</label></th>
                      <td><textarea name="as_facebook_mem_width" cols="18" rows="1"><?php echo get_option('as_facebook_mem_width'); ?></textarea></td>
				</tr>
				<tr valign="top" class="alternate">
          			<th scope="row" style="width:29%;"><label>Like Box Height</label></th>
                      <td><textarea name="as_facebook_mem_height" cols="18" rows="1"><?php echo get_option('as_facebook_mem_height'); ?></textarea></td>
				</tr>
				<tr valign="top">
          			<th scope="row" style="width:29%;"><label># of Connection?</label></th>
                      <td><textarea name="as_facebook_mem_no_connection" cols="18" rows="1"><?php echo get_option('as_facebook_mem_no_connection'); ?></textarea></td>
				</tr>

					<tr valign="top" class="alternate">
						<th scope="row"><label>Show Stream?</label></th>
						<td>
							<input name="as_facebook_mem_stream" type="radio" value="true" <?php checked('true', $as_facebook_mem_stream); ?> />
						&nbsp;YES

							<input name="as_facebook_mem_stream" type="radio" value="false" <?php checked('false', $as_facebook_mem_stream); ?> />
						&nbsp;NO (default)

						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label>Show Header?</label></th>
						<td>
							<input name="as_facebook_mem_header" type="radio" value="true" <?php checked('true', $as_facebook_mem_header); ?> />
						&nbsp;YES

							<input name="as_facebook_mem_header" type="radio" value="false" <?php checked('false', $as_facebook_mem_header); ?> />
						&nbsp;NO (default)

						</td>
					</tr>
				</table>
			</div>
   		 <div class="submit">
	        <input type="submit" name="info_update" class="button-primary" value="<?php _e('Update options'); ?> &raquo;" />
	    </div>
			</div>

			<div class="postbox">
				<h3>Facebook Members - Widget/Sidebar Options <?=$new_icon?></h3>
					<div>
					<table class="form-table">

				<tr valign="top">
          			<th scope="row" style="width:29%;"><label>Widget Title</label></th>
                      <td><textarea name="as_facebook_mem_widget_title" cols="18" rows="1"><?php echo get_option('as_facebook_mem_widget_title'); ?></textarea></td>
				</tr>
				<tr valign="top" class="alternate">
          			<th scope="row" style="width:29%;"><label>Facebook Page Name</label></th>
                      <td><textarea name="as_facebook_mem_widget_page_name" cols="18" rows="1"><?php echo get_option('as_facebook_mem_widget_page_name'); ?></textarea></td>
				</tr>
				<tr valign="top">
          			<th scope="row" style="width:29%;"><label>Widget Width</label></th>
                      <td><textarea name="as_facebook_mem_widget_width" cols="18" rows="1"><?php echo get_option('as_facebook_mem_widget_width'); ?></textarea></td>
				</tr>
				<tr valign="top" class="alternate">
          			<th scope="row" style="width:29%;"><label>Widget Height</label></th>
                      <td><textarea name="as_facebook_mem_widget_height" cols="18" rows="1"><?php echo get_option('as_facebook_mem_widget_height'); ?></textarea></td>
				</tr>
				<tr valign="top">
          			<th scope="row" style="width:29%;"><label># of Connection?</label></th>
                      <td><textarea name="as_facebook_mem_widget_no_connection" cols="18" rows="1"><?php echo get_option('as_facebook_mem_widget_no_connection'); ?></textarea></td>
				</tr>
				<tr valign="top" class="alternate">
					<th scope="row"><label>Show Stream?</label></th>
					<td>
						<input name="as_facebook_mem_widget_stream" type="radio" value="true" <?php checked('true', $as_facebook_mem_widget_stream); ?> />
					&nbsp;YES

						<input name="as_facebook_mem_widget_stream" type="radio" value="false" <?php checked('false', $as_facebook_mem_widget_stream); ?> />
					&nbsp;NO (default)

					</td>
				</tr>

 					</table>
					</div>
   		 <div class="submit">
	        <input type="submit" name="info_update" class="button-primary" value="<?php _e('Update options'); ?> &raquo;" />
	    </div>

		</div>

    </form>

</div>

         <div id="side-info-column" class="inner-sidebar">
			<div class="postbox">
			  <h3 class="hndle"><span>Facebook Members Plugin by Arpit Shah</span></h3>
			  <div class="inside">
				<ul>
				<li><a href="http://crunchmeme.com/plugins/facebook-members/" title="Facebook Members" target="_blank">Plugin Homepage</a></li>
				<li><a href="http://arpitshah.com" title="Visit Arpit's Personal Site" target="_blank">Arpit's Website</a></li>
				</ul>
			  </div>
			</div>
	     </div>
			<br>
			<div id="side-info-column" class="inner-sidebar">
				<div class="postbox">
				  <h3 class="hndle"><span>Visit my other Plugins</span></h3>
				  <div class="inside">
					<ul>
					<li>1) <a href="http://crunchmeme.com/plugins/wp-google-buzz/" title="WP Google-buzz" target="_blank">WP Google-buzz</a></li>
					<li>2) <a href="http://crunchmeme.com/plugins/all-in-one-webmaster/" title="All in One Webmaster" target="_blank">All in One Webmaster</a></li>
					<li>3) <a href="http://crunchmeme.com/plugins/wp-archive-sitemap-generator/" title="WP Archive-Sitemap Generator" target="_blank">WP Archive-Sitemap Generator</a></li>
					<li>4) <a href="http://crunchmeme.com/plugins/foursquare-integration/" title="FourSquare Integration" target="_blank">FourSquare Integration</a></li>
					<li>5) <a href="http://crunchmeme.com/plugins/twitter-goodies/" title="Twitter Goodies" target="_blank">Twitter Goodies</a></li>
					</ul>
				  </div>
				</div>
		     </div>
			 <br>
			  <div id="side-info-column" class="inner-sidebar">
				<div class="postbox">
				  <h3 class="hndle"><span>Thanks for your support</span></h3>
				  <div class="inside">
					<ul>
					If you like this plugin and find it useful, help keep this plugin free and actively developed by clicking the donate button.<br><br>
					<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="10641755">
					<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>

					</ul>
				  </div>
				</div>
			</div>
	</div>
    </div>

<?php

}

function show_as_facebook_mem_likebox_widget($args)
{
	extract($args);

	$fm_pagename = get_option('as_facebook_mem_page_name');
	$fm_header = get_option('as_facebook_mem_header');


	$fm_widget_page_name = get_option('as_facebook_mem_widget_page_name');
	$fm_widget_stream = get_option('as_facebook_mem_widget_stream');
	$fm_widget_title = get_option('as_facebook_mem_widget_title');
	$fm_widget_width = get_option('as_facebook_mem_widget_width');
	$fm_widget_height = get_option('as_facebook_mem_widget_height');
	$fm_widget_no_connection = get_option('as_facebook_mem_widget_no_connection');


	$T2 = '<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F' . $fm_widget_page_name . '&amp;width='.$fm_widget_width.'&amp;connections='.$fm_widget_no_connection.'&amp;stream='.$fm_widget_stream.'&amp;header=false&amp;height='.$fm_widget_height.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$fm_widget_width.'px; height:'.$fm_widget_height.'px;" allowTransparency="true"></iframe>';

	echo $before_widget;
	echo $before_title . $fm_widget_title . $after_title;
    echo $T2;
    echo $after_widget;
}


function as_facebook_mem_likebox_widget_control()
{
    ?>
    <p>
    <? _e("Please go to <b>Settings -> Facebook Members</b> for all required options. "); ?>
    </p>
    <?php
}


function widget_as_facebook_mem_likebox_init()
{
    $widget_options = array('classname' => 'widget_as_facebook_mem_likebox', 'description' => __( "Display Facebook Members") );
    wp_register_sidebar_widget('as_facebook_mem_likebox_widgets', __('Facebook Members'), 'show_as_facebook_mem_likebox_widget', $widget_options);
    wp_register_widget_control('as_facebook_mem_likebox_widgets', __('Facebook Members'), 'as_facebook_mem_likebox_widget_control' );
}


add_filter('the_content', 'filter_as_facebook_mem_likebox');

add_action('init', 'widget_as_facebook_mem_likebox_init');

// Insert the as_facebook_mem_add_option_page in the 'admin_menu'
add_action('admin_menu', 'as_facebook_mem_add_option_page');

?>