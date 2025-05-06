<?php
	require get_template_directory() . '/templates/blocks/accordion/block.php';
	require get_template_directory() . '/templates/blocks/accordionpicture/block.php';
	require get_template_directory() . '/templates/blocks/blocs/block.php';
	require get_template_directory() . '/templates/blocks/calltoaction/block.php';
	require get_template_directory() . '/templates/blocks/calltoactionmultiple/block.php';
	require get_template_directory() . '/templates/blocks/clients/block.php';
	require get_template_directory() . '/templates/blocks/contact/block.php';
	require get_template_directory() . '/templates/blocks/gallery/block.php';
	require get_template_directory() . '/templates/blocks/herosimple/block.php';
	require get_template_directory() . '/templates/blocks/keynumbers/block.php';
	require get_template_directory() . '/templates/blocks/partners/block.php';
	require get_template_directory() . '/templates/blocks/partnersrich/block.php';
	require get_template_directory() . '/templates/blocks/relation/block.php';
	require get_template_directory() . '/templates/blocks/paragraph/block.php';
	require get_template_directory() . '/templates/blocks/slidetextpicture/block.php';
	require get_template_directory() . '/templates/blocks/team/block.php';
	require get_template_directory() . '/templates/blocks/textpicture/block.php';
	require get_template_directory() . '/templates/blocks/textitle/block.php';

	function allow_only_custom_blocks( $allowed_blocks, $editor_context ) {
		return array(
			'acf/accordion',
			'acf/accordionpicture',
			'acf/blocs',
			'acf/calltoaction',
			'acf/calltoactionmultiple',
			'acf/clients',
			'acf/contact',
			'acf/gallery',
			'acf/herosimple',
			'acf/keynumbers',
			'acf/partners',
			'acf/partnersrich',
			'acf/relation',
			'acf/paragraph',
			'acf/slidetextpicture',
			'acf/team',
			'acf/textpicture',
			'acf/textitle',
		);
	}
	add_filter( 'allowed_block_types_all', 'allow_only_custom_blocks', 10, 2 );