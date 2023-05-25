<?php

function openwebinars_badges_refresh_profile()
{
	$options = get_option('openwebinars_badges');
	$last_updated = $options['last_updated'];

	$current_time = time();

	$update_difference = $current_time - $last_updated;

	if ($update_difference > 86400){
		$openwebinars_email = $options['openwebinars_email'];
		$options['openwebinars_email'] = openwebinars_badges_get_profile($openwebinars_email);
		$options['last_updated'] = time();
		update_option('openwebinars_badges', $options);
	}

	die();
}

function openwebinars_badges_get_profile(mixed $openwebinars_email)
{
	return get_option('openwebinars_badges')['openwebinars_email'];
}




add_action('wp_ajax_openwebinars_badges_refresh_profile', 'openwebinars_badges_refresh_profile');

function openwebinars_badges_enable_frontend_ajax()
{
	?>

	<script>
		var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
	</script>

	<?php
}

add_action('wp_head', 'openwebinars_badges_enable_frontend_ajax');


function openwebinars_badges_styles()
{
	wp_enqueue_style('openwebinars_badges_styles', plugins_url('openwebinars_badges/openwebinars_badges.css'));
}

add_action('admin_head', 'openwebinars_badges_styles');

function openwebinars_badges_frontend_scripts_and_styles()
{
	wp_enqueue_style('openwebinars_badges_frontend-css', plugins_url('openwebinars_badges/openwebinars_badges.css'));
	wp_enqueue_script('openwebinars_badges_frontend-js', plugins_url('openwebinars_badges/openwebinars_badges.js'), array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'openwebinars_badges_frontend_scripts_and_styles');
