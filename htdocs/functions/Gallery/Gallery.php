<?php
namespace Practice\Function\Gallery;

/**
 * Class Gallery
 *
 * @package Practice\Function\Gallery
 */
class Gallery implements \IteratorAggregate {
	/**
	 * 画像ディレクトリの場所
	 */
	private const DOCUMENT_ROOT = __DIR__ . '/../../photos.example.com';

	/**
	 * サーバーURL
	 */
	private const DOCUMENT_URL = '/php_glob/htdocs/photos.example.com';

	private const IMAGE_DIR = 'photo';

	/**
	 * 画像のURLが格納された配列
	 *
	 * @var string[]
	 */
	private array $image_urls = array();

	/**
	 * Gallery constructor.
	 */
	public function __construct() {
		$this->setup_image_urls();
	}

	/**
	 * Iterator に変換する
	 *
	 * @return \ArrayIterator
	 */
	public function getIterator():\ArrayIterator {
		return new \ArrayIterator( $this->get_image_urls() );
	}

	/**
	 * 画像の配列を取得する
	 *
	 * @return array
	 */
	public function get_image_urls():array {
		return $this->image_urls;
	}

	/**
	 * $image_urls に画像のURLの配列を格納する
	 */
	private function setup_image_urls() {
		$file_paths = $this->search_images();
		$this->image_urls = array_map(
			array( $this, 'replace_image_paths_to_url' ), $file_paths
		);
	}

	/**
	 * 画像ディレクトリのパスを取得
	 *
	 * @return string
	 */
	private function get_dir_path():string {
		return implode( '/', array( self::DOCUMENT_ROOT, self::IMAGE_DIR ) );
	}

	/**
	 * 画像ディレクトリ内のサブディレクトリのパスを取得
	 *
	 * @return string[]
	 */
	private function get_images_sub_dirs():array {
		if ( ! is_dir( $this->get_dir_path() ) ) {
			return array();
		}

		$sub_dirs = glob( $this->get_dir_path() . '/*', GLOB_ONLYDIR );

		if ( empty( $sub_dirs ) ) {
			return array();
		}

		return $sub_dirs;
	}

	/**
	 * 指定したファイルパスから最後の文字列のみ抜き出す
	 *
	 * @param string $file_path
	 *
	 * @return string
	 */
	private function crop_dir( string $file_path ):string {
		$dir_name = explode( '/', $file_path );

		return end( $dir_name );
	}

	/**
	 * サブフォルダごとにjpgの連想配列をつくる
	 *
	 * @return string[]
	 */
	public function search_images():array {
		if ( empty( $this->get_images_sub_dirs() ) ) {
			return array();
		}

		$images = array();
		foreach ( $this->get_images_sub_dirs() as $image ) {
			$images[$this->crop_dir( $image )] = glob( $image . '/*.jpg' );
		}

		return $images;
	}

	/**
	 * 画像のパス部分をURLに置換する
	 *
	 * @param string[] $file_path
	 *
	 * @return array
	 */
	private function replace_image_paths_to_url( array $file_path ):array {
		return str_replace( self::DOCUMENT_ROOT, self::DOCUMENT_URL, $file_path );
	}
}
