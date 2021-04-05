<?php
namespace Practice\Function\Image;

/**
 * Class Image
 *
 * @package Practice\Function\Image
 */
class Image {
	/**
	 * 画像を取得する配列
	 *
	 * @var string[]
	 */
	private array $image_urls;

	/**
	 * Image constructor.
	 *
	 * @param string[] image_urls
	 */
	public function __construct( array $image_urls ) {
		$this->image_urls = $image_urls;
		$this->render_image( $image_urls );
	}

	/**
	 * 指定した配列のキーから値を描写する
	 *
	 * @param array $value
	 */
	private function render_image( array $value ) {
		foreach ( $value as $item ) {
			echo '<div><img src="' . htmlspecialchars( $item ) . '" alt=""></div>';
		}
	}
}
