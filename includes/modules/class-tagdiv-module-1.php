<?php

class Tagdiv_Module_1 extends Tagdiv_Module {

	function __construct( $post ) {
		//run the parrent constructor
		parent::__construct( $post );
	}

	function render() {
		ob_start();
		?>

		<div class="<?php echo $this->get_module_classes(); ?>" >
			<div class="td-module-image">
				<?php echo $this->get_image( 'td_300x220' ); ?>
				<div class="td-post-category-wrap">
					<?php echo $this->get_category(); ?>
				</div>
			</div>

			<?php echo $this->get_title(); ?>

			<div class="td-module-meta-info">
				<?php echo $this->get_author(); ?>
				<?php echo $this->get_date(); ?>
				<?php echo $this->get_comments(); ?>
			</div>

			<div class="tagdiv-excerpt">
				<?php echo $this->get_excerpt(25);?>
			</div>

		</div>

		<?php return ob_get_clean();
	}
}