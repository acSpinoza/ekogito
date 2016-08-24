<?php
/**
 * Text option.
 *
 * @package Page Builder Sandwich
 */

?>
<script type="text/html" id="tmpl-pbs-option-text">
	<div class="pbs-option-subtitle">{{ data.name }}</div>
	<input type="text" value="{{ data.value }}"/>
	<# if ( data.desc ) { #>
		<p class="pbs-description">{{{ data.desc }}}</p>
	<# }

	if ( typeof data.type_orig !== 'undefined' && typeof data.type !== 'undefined' && data.type_orig.toLowerCase() !== data.type.toLowerCase() && data.first_of_type ) { #>
		<p class="pbs-description-sc-map-premium">
		<# if ( data.type_orig === 'image' || data.type_orig === 'images' ) { #>
			<?php printf( esc_html__( 'Heads up! You can also pick images from the media manager and get access to more controls with our %sPremium Version%s.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'color' ) { #>
			<?php printf( esc_html__( 'You can also access a nifty color picker with our %sPremium Version%s.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'number' ) { #>
			<?php printf( esc_html__( 'The %sPremium Version%s comes with a neat number slider.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'boolean' ) { #>
			<?php printf( esc_html__( 'The %sPremium Version%s allows you to use switches to easily .', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'multicheck' ) { #>
			<?php printf( esc_html__( 'Get the %sPremium Version%s to use grouped checkboxes, and get access to more controls.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'multicheck_post_type' ) { #>
			<?php printf( esc_html__( 'You get to use post type checkboxes with the %sPremium Version%s.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'dropdown_post_type' ) { #>
			<?php printf( esc_html__( 'Get the %sPremium Version%s to use post type dropdowns, and get access to more controls.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } else if ( data.type_orig === 'dropdown_post' ) { #>
			<?php printf( esc_html__( 'The %sPremium Version%s will allow you to use post / CPT dropdowns, and get access to more controls.', PAGE_BUILDER_SANDWICH ), '<a href="https://pagebuildersandwich.com/compare?utm_source=lite-plugin&utm_medium=text-option&utm_campaign=Page%20Builder%20Sandwich" target="_blank">', '</a>' ) ?>
		<# } #>
		</p>
	<# } #>
</script>
