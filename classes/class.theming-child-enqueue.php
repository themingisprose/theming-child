<?php
/**
 * Enqueue styles and scripts
 *
 * @since Theming Child 1.0.0
 */
class Theming_Child_Enqueue
{

	/**
	 * @var null
	 */
	protected static $instance = null;

	/**
	 * Enqueue
	 *
	 * @since Theming Child 1.0.0
	 */
	public function init()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_parent_styles' ), 999 );
	}

	/**
	 * Handle styles
	 *
	 * @since Theming Child 1.0.0
	 */
	public function styles()
	{
		wp_register_style( 'theming-child-style', get_stylesheet_directory_uri() .'/assets/dist/css/theming-child-style.css', array(), $this->theme_version() );
		wp_enqueue_style( 'theming-child-style' );
	}

	/**
	 * Dequeue parent styles
	 *
	 * @since Theming Child 1.0.0
	 */
	public function dequeue_parent_styles()
	{
		wp_dequeue_style( 'theming-style' );
		wp_deregister_style( 'theming-style' );
	}

	/**
	 * Get the theme version
	 *
	 * @since Theming Child 1.0.0
	 */
	public function theme_version()
	{
		return wp_get_theme()->get( 'Version' );
	}

	/**
	 * Get Instance
	 *
	 * @since Theming Child 1.0.0
	 */
    public static function get_instance() : self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

Theming_Child_Enqueue::get_instance()->init();
