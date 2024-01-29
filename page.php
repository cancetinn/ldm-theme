<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

get_header();

if (!is_front_page() && !is_home()) :
	arina_breadcrumbs();
endif;

?>
<main>
	<?php echo do_shortcode('[contact_now]'); ?>
	<div data-nonce="<?php echo wp_create_nonce('contact_form_nonce'); ?>"></div>
	<script>
        document.addEventListener('DOMContentLoaded', function () {
            const getForm = selector("#contactform")
            const dataNonce = getDataset("[data-nonce]", "nonce")
            const ajax = new AjaxOperation()

            getForm.addEventListener('submit', e => {
                e.preventDefault()

                const formData = new FormData(getForm)
                formData.append('action', 'contact_form')
                formData.append('security', dataNonce)

                ajax.fetchForm(formData, getForm)
            })
        })
	</script>

	<form action="">
		<div class="form-field">
			<input id="checkx" type="checkbox" name="checkx">
			<label for="checkx">Checkbox</label>
		</div>

		<div class="form-field">
			<input id="radiox_yes" type="radio" name="radiox" value="evet">
			<label for="radiox_yes">Evet</label>

			<input id="radiox_no" type="radio" name="radiox" value="hayır">
			<label for="radiox_no">Hayır</label>
		</div>
	</form>

	<div class="svgIcons">
		<?php

		echo getIcon('5012');
		echo getIcon('5013', 'primary');
		echo getIcon('5014', 'secondary');
		echo getIcon('5015');

		echo getSvg('icon-linkedin', 'linkedin');

		?>
	</div>

	<div class="imgAttachment">
		<?php echo getImage('1362', sizes: 'blog_thumb'); ?>
	</div>

	<?php

	if (have_posts()) :

		while (have_posts()): the_post();

			the_content();

		endwhile;

	endif;

	?>
</main>

<?php get_footer();
