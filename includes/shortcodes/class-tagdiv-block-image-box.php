<?php
class Tagdiv_Block_Image_Box extends Tagdiv_Block {


	function render($atts, $content = null) {
		parent::render($atts);

		extract(shortcode_atts(
			array(
				'height' => '',
				'gap' => '',
				'display' => '',
				'alignment' => '',
				'style' => '',


				'image_title_item0' => 'Custom title',
				'custom_url_item0' => '#',
				'open_in_new_window_item0' => '',
				'image_item0' => '',

				'image_title_item1' => 'Custom title',
				'custom_url_item1' => '#',
				'open_in_new_window_item1' => '',
				'image_item1' => '',

				'image_title_item2' => 'Custom title',
				'custom_url_item2' => '#',
				'open_in_new_window_item2' => '',
				'image_item2' => '',

				'image_title_item3' => 'Custom title',
				'custom_url_item3' => '#',
				'open_in_new_window_item3' => '',
				'image_item3' => '',

			), $atts));

		$ref_var = 'image_item';

		$items = array();
		for ($i = 0; $i < 4; $i++ ) {
			if ( ! empty( ${$ref_var . $i})) {
				$items[] = array(
					'image_title' => ${'image_title_item' . $i},
					'custom_url' => ${'custom_url_item' . $i},
					'open_in_new_window' => ${'open_in_new_window_item' . $i},
					'image' => ${'image_item' . $i}
				);
			}
		}



		// height
		$box_height = '';
		if(!empty($height)) {
			$box_height = ' height: ' . $height . 'px';
		}

		// gap
		$box_gap_padding = '';
		$box_gap_margin = '';
		if(isset($gap)) {
			$box_gap_padding = 'padding-left: ' . $gap . 'px; padding-right: ' . $gap . 'px;';
			$box_gap_margin = 'margin-left: -' . $gap . 'px; margin-right: -' . $gap . 'px;';
		}

		// layout
		$box_space = '';

		// additional classes
		$additional_classes = array();


		if(!empty($display)) {
			$additional_classes [] = 'td-box-horizontal';

			if(isset($gap)) {
				$box_space = ' margin-bottom: ' . $gap . 'px;';
			}
		}

		// alignment
		if(!empty($alignment)) {
			$additional_classes [] = 'td-image-box-' . $atts['alignment'];
		}

		// style
		if(!empty($atts['style'])) {
			$additional_classes [] = 'tagdiv-block-image-box td-image-box-' . $atts['style'];
		}

		$buffy = '';
		$buffy .= '<div class="' . $this->get_block_classes($additional_classes) . '" ' . $this->get_block_html_atts() . '>';

		//get the block css
		$buffy .= $this->get_block_css();

		// block title wrap
		$buffy .= '<div class="td-block-title-wrap">';
			$buffy .= $this->get_block_title();
		$buffy .= '</div>';

		$td_block_layout = new Tagdiv_Block_Layout();

		switch(count($items)) {
			case 1:
				$buffy .= '<div class="td-image-box-row td-big-image" style="' . $box_gap_margin . '">';
					$buffy .= '<div class="td-image-box-span" style="' . $box_gap_padding .  $box_space . '">';
					foreach($items as $item) {

						$target = '';

						if ( '' !== $item[ 'open_in_new_window' ] ) {
							$target = ' target="_blank" ';
						}

						$buffy .= '<div class="td-custom">';
							$buffy .= '<div class="td-custom-image">';
							$buffy .= '<a style="background-image: url(\'' . $item[ 'image' ] . '\');' . $box_height . '" href="' . $item[ 'custom_url' ] . '" ' . $target . ' rel="bookmark" title="' . $item[ 'image_title' ] . '"></a>';
							$buffy .= '</div>';
							$buffy .= '<div class="td-custom-title">';
							$buffy .= '<h3 class="entry-title"><a href="' . $item[ 'custom_url' ] . '">' . $item[ 'image_title' ] . '</a></h3>';
							$buffy .= '</div>';
						$buffy .= '</div>';
					}
					$buffy .= '</div>';
				$buffy .= '</div>';
				break;

			case 2:
				$buffy .= '<div class="td-image-box-row td-medium-image" style="' . $box_gap_margin . '">';
					foreach($items as $item) {
						$buffy .= '<div class="td-image-box-span" style="' . $box_gap_padding . $box_space . '">';

							$target = '';

							if ( '' !== $item[ 'open_in_new_window' ] ) {
								$target = ' target="_blank" ';
							}

							$buffy .= '<div class="td-custom">';
								$buffy .= '<div class="td-custom-image">';
								$buffy .= '<a style="background-image: url(\'' . $item[ 'image' ] . '\');' . $box_height . '" href="' . $item[ 'custom_url' ] . '" ' . $target . ' rel="bookmark" title="' . $item[ 'image_title' ] . '"></a>';
								$buffy .= '</div>';
								$buffy .= '<div class="td-custom-title">';
								$buffy .= '<h3 class="entry-title"><a href="' . $item[ 'custom_url' ] . '">' . $item[ 'image_title' ] . '</a></h3>';
								$buffy .= '</div>';
							$buffy .= '</div>';
						$buffy .= '</div>';
					}
				$buffy .= '</div>';
				break;

			case 3:
				$buffy .= '<div class="td-image-box-row td-small-image" style="' . $box_gap_margin . '">';
					foreach($items as $item) {
						$buffy .= '<div class="td-image-box-span" style="' . $box_gap_padding . $box_space . '">';

							$target = '';

							if ( '' !== $item[ 'open_in_new_window' ] ) {
								$target = ' target="_blank" ';
							}

							$buffy .= '<div class="td-custom">';
								$buffy .= '<div class="td-custom-image">';
								$buffy .= '<a style="background-image: url(\'' . $item[ 'image' ] . '\');' . $box_height . '" href="' . $item[ 'custom_url' ] . '" ' . $target . ' rel="bookmark" title="' . $item[ 'image_title' ] . '"></a>';
								$buffy .= '</div>';
								$buffy .= '<div class="td-custom-title">';
								$buffy .= '<h3 class="entry-title"><a href="' . $item[ 'custom_url' ] . '">' . $item[ 'image_title' ] . '</a></h3>';
								$buffy .= '</div>';
							$buffy .= '</div>';
						$buffy .= '</div>';
					}
				$buffy .= '</div>';
				break;

			case 4:
				$buffy .= '<div class="td-image-box-row td-tiny-image" style="' . $box_gap_margin . '">';
					foreach($items as $item) {
						$buffy .= '<div class="td-image-box-span" style="' . $box_gap_padding . $box_space . '">';

							$target = '';

							if ( '' !== $item[ 'open_in_new_window' ] ) {
								$target = ' target="_blank" ';
							}

							$buffy .= '<div class="td-custom">';
								$buffy .= '<div class="td-custom-image">';
								$buffy .= '<a style="background-image: url(\'' . $item[ 'image' ] . '\');' . $box_height . '" href="' . $item[ 'custom_url' ] . '" ' . $target . ' rel="bookmark" title="' . $item[ 'image_title' ] . '"></a>';
								$buffy .= '</div>';
								$buffy .= '<div class="td-custom-title">';
								$buffy .= '<h3 class="entry-title"><a href="' . $item[ 'custom_url' ] . '">' . $item[ 'image_title' ] . '</a></h3>';
								$buffy .= '</div>';
							$buffy .= '</div>';
						$buffy .= '</div>';
					}
				$buffy .= '</div>';
				break;

			default:
				$buffy .= '<div class="td-image-box-row td-small-image" style="' . $box_gap_margin . '">';

					$index = 0;
					while($index < 3) {
						$buffy .= '<div class="td-image-box-span" style="' . $box_gap_padding . $box_space . '">';
							$buffy .= '<div class="td-custom">';
								$buffy .= '<div class="td-custom-image">';
								$buffy .= '<a style="background-image: url(\'' . get_template_directory_uri() . '/images/no-thumb/td_640x400.png\');' . $box_height . '" href="#" rel="bookmark" title="Custom title"></a>';
								$buffy .= '</div>';
								$buffy .= '<div class="td-custom-title">';
								$buffy .= '<h3 class="entry-title"><a href="#">Custom title</a></h3>';
								$buffy .= '</div>';
							$buffy .= '</div>';
						$buffy .= '</div>';

						$index++;
					}
				$buffy .= '</div>';
				break;
		}


		$buffy .= '</div>';


		return $buffy;
	}
}