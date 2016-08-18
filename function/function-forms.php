<?php
/**
 * Created by PhpStorm.
 * User: macbookpro
 * Date: 8/5/16
 * Time: 11:03 PM
 */


$test = '';


require_once PLUGIN_PATH_DIR . '/forms/form-top.php';
require_once PLUGIN_PATH_DIR . '/forms/form-step-2.php';
require_once PLUGIN_PATH_DIR . '/forms/form-step-3.php';
require_once PLUGIN_PATH_DIR . '/forms/form-step-final.php';
require_once PLUGIN_PATH_DIR . '/forms/form-client-data.php';


function get_cpt_data($index, $participant, $post_per_page, $post_type, $category)
{

	$query = new WP_Query(
		array(
			'posts_per_page' => $post_per_page,
			'post_type' => $post_type,
			'post_status' => 'publish',
			'meta_query' => array(
				array(
					'key' => '__lesson_post_attr',
					'value' => 's:' . strlen($category) . ':"' . $category . '"',
					'compare' => 'LIKE',
				)
			)
		)
	);

	foreach ($query->posts as $key => $value) {
		$post_meta = get_post_meta($value->ID, '__lesson_post_attr', $single = true);
		cpt_template($index, $participant, $value, $post_meta);
	}
}

function cpt_template($index, $participant, $post_data, $post_meta)
{
	?>

	<div class="infosbox gs-row-float">
		<div class="infosbox-left">
			<img width="150" height="150" src="<?php echo get_the_post_thumbnail_url($post_data->ID) ?>" class=""/>
		</div>
		<div class="infosbox-right">
			<div class="infosbox-top-left">
				<div class="infosbox-title"><?php echo $post_data->post_title ?></div>
				<div class="infosbox-desc"><?php echo $post_data->post_content ?></div>
			</div>
			<div class="">
				<div class="">
					PRICE/PERSON
					<?php
					if (isset($post_meta['price'])) {
						?>
						<span id="price-info<?php echo $index ?>" class="package-price"
						      data-price="<?php echo $post_meta['price'] ?>"><?php echo $post_meta['price'] ?></span>
						<?php
						$participant = $participant . "_" . $post_meta['price'];
					}
					?>
				</div>
				<div class="">BOOK
					<input name="surf_package[<?php echo $participant ?>]" type="checkbox"
					       id="chosen-package<?php echo $index ?>" value="<?php echo $post_data->ID ?>"/>
				</div>
			</div>
		</div>
	</div>
	<?php
}
