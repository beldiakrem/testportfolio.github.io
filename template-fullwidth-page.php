<?php

/**
 * Template Name: Fullwidth Page
 * @author: PaulThemes
 * @version: 1.0
 */

get_header();

?>

<main class="vlt-main">

	<?php

		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content/content', 'fullwidth-page' );
		endwhile;

	?>

</main>
<!-- /.vlt-main -->

<?php get_footer(); ?>