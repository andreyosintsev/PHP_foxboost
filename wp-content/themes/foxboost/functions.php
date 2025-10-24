<?php
/**
 * functions.php
 *
 * This file loads the theme functions and definitions.
 *
 * @link        http://www.gopiplus.com/
 * @link        https://foxboost.ru/
 *
 * @author      www.gopiplus.com, Andrei Osintsev
 * @copyright   Copyright (c) 2013 www.gopiplus.com, 2025 asosintsev@yandex.ru
 */

/**
 * SimpleImage foreign image resample class
 */
include('utils/simpleimage.php');

/**
 * Sets up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
{
	$content_width = 1000;
}

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Premium Stylesupports.
 */
function premiumstyle_setup() 
{
	//  Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'gopiplustheme', get_template_directory() . '/languages' );
	
	// This theme styles the visual editor to match the theme style.
	add_editor_style();
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'gopiplustheme' ) );
	
	// Custom Background
	add_theme_support( 'custom-background', array('default-color' => 'FFFFFF',) );
	
	// This theme uses a custom image size for featured images, displayed on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); 
	// 200 pixels wide by 150 pixels high, hard crop mode
	add_image_size('excerpt-thumbnail', 200, 150, true); 
}
add_action( 'after_setup_theme', 'premiumstyle_setup' );

/**
 * Enqueues scripts and styles for front end.
 *
 */
function premiumstyle_scripts_styles() 
{
	global $wp_styles;
	global $wp_scripts;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	{
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Loads Premium Stylemain stylesheet.
	wp_enqueue_style( 'premiumstyle-style', get_stylesheet_uri() );

//    if (!is_admin()) {
//        // Убираем стандартную версию jQuery
//        wp_deregister_script('jquery');
//    }
}
add_action( 'wp_enqueue_scripts', 'premiumstyle_scripts_styles' );

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 */
function premiumstyle_custom_header() 
{
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '333333',
		'default-image'          => '',
		// Callbacks for styling the header
		'wp-head-callback'    => 'premiumstyle_header_style',
	);

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'premiumstyle_custom_header' );
/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
function premiumstyle_widgets_init() 
{
	register_sidebar( array (
		'name' 			=> __( 'Sidebar', 'gopiplustheme' ),
		'id' 			=> 'sidebar',
		'description' 	=> __( 'Sidebar', 'gopiplustheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "<div class='clear'></div></div>",
		'before_title' 	=> '<p class="widget-title">',
		'after_title' 	=> '</p>',
	) );
}
add_action( 'widgets_init', 'premiumstyle_widgets_init' );

/**
 * Adding options page under Appearance menu 
 *
 */
function premiumstyle_theme_menu() 
{  
	add_theme_page( 'Premium Style', 'Premium Style', 'edit_theme_options', 'premiumstyle', 'premiumstyle_display');  
} 
add_action( 'admin_menu', 'premiumstyle_theme_menu' ); 

/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
if (!function_exists("premiumstyle_custom_comment")) 
{
	function premiumstyle_custom_comment($comment, $args, $depth) 
	{
	   $GLOBALS['comment'] = $comment; 
	   ?>       
		<li <?php comment_class(); ?>>
		<a name="comment-<?php comment_ID() ?>"></a>
		<div id="li-comment-<?php comment_ID() ?>" class="comment-container">
			<div class="comment-head">    
				<?php if(get_comment_type() == "comment"){ ?>
					<div class="avatar"><?php premiumstyle_commenter_avatar($args) ?></div>
				<?php } ?>        
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div> 	                          	
			</div>
			<div class="comment-entry"  id="comment-<?php comment_ID(); ?>">
				<span class="arrow"></span>
				<div class="comment-info">
					<div class="left">
						<span class="name"><?php premiumstyle_commenter_link() ?></span>
					</div>
					<div class="right">        
						<span class="date">
							<?php echo get_comment_date(get_option( 'date_format' )) ?> 
							<?php _e('at', 'gopiplustheme'); ?> 
							<?php echo get_comment_time(get_option( 'time_format' )); ?>
						</span>
						<span class="perma">
							<a href="<?php echo get_comment_link(); ?>" title="<?php _e('Direct link to this comment', 'gopiplustheme'); ?>">#</a>
						</span>
						<span class="edit"><?php edit_comment_link(__('Edit', 'gopiplustheme'), '', ''); ?></span>
					</div>
					<div class="clear"></div> 
				</div>	
				<?php comment_text() ?> 
				<?php if ($comment->comment_approved == '0') { ?>
					<p class='unapproved'><?php _e('Your comment is awaiting moderation.', 'gopiplustheme'); ?></p>
				<?php } ?>					
			</div>
		</div>		
	<?php 
	}
}
/**
 * Style the header text displayed on the blog.
 *
 */
function premiumstyle_header_style()
{
    $text_color = get_header_textcolor();

    // If no custom options for text are set.
    if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
    {
        return;
    }
    // If we get this far, we have custom styles.
    ?>
    <style type="text/css" id="premiumstyle-header-css">
        <?php
            // Has the text been hidden?
            if ( ! display_header_text() ) :
        ?>
        .site-title,
        .site-description {
            position: absolute;
            clip: rect(1px 1px 1px 1px); /* IE7 */
            clip: rect(1px, 1px, 1px, 1px);
        }
        <?php
            // If the user has set a custom color for the text, use that.
            else :
        ?>
        .site-header h1 a,
        .site-header h2 {
            color: #<?php echo $text_color; ?>;
        }
        <?php endif; ?>
    </style>
    <?php
}
/**
 * Premium Style customizer begins
 *
 */
function premiumstyle_customizer( $wp_customize ) 
{
	// Theme customizer text area control
	class PremiumStyle_WP_Theme_Textarea_Control extends WP_Customize_Control 
	{
		public $type = 'textarea';
		public function render_content() 
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	// Theme customizer text box control
	class PremiumStyle_WP_Theme_Textbox_control extends WP_Customize_Control 
	{
		public $type = 'textarea';
		public function render_content() 
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	// Social text area customizer
	class PremiumStyle_WP_Theme_Social_control extends WP_Customize_Control 
	{
		public $type = 'textarea';
		public function render_content() 
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="1" style="width:100%;" <?php $this->link(); ?>><?php echo esc_url( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	// Start upload site logo section
    $wp_customize->add_section( 'premiumstyle_sitelogo_section' , array(
    		'title'       	=> __( 'Logo', 'gopiplustheme' ),
    		'priority'    	=> 10,
    		'description' 	=> 'Upload a logo to replace the default site name and description in the header.',) );
	
	$wp_customize->add_setting( 'premiumstyle_sitelogo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'premiumstyle_sitelogo', array(
			'label'    		=> __( 'Logo', 'gopiplustheme' ),
			'section'  		=> 'premiumstyle_sitelogo_section',
			'settings' 		=> 'premiumstyle_sitelogo',) ) );
	// End upload site logo section
				
	// Start social icons link section
	$wp_customize->add_section('premiumstyle_social_sec' , array(
			'title' 		=> __('Social Icons','gopiplustheme'),
			'priority'  	=> 210,));

	$wp_customize->add_setting('twitter_url', array(
			'default' => 'http://www.twitter.com/', 
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'twitter_url', array(
			'label' 		=> 'Twitter url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'twitter_url',)));
			
	$wp_customize->add_setting('premiumstyle_social_activate');
	$wp_customize->add_control('premiumstyle_social_activate', array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Disable all social icons', 
			'section' 		=> 'premiumstyle_social_sec',));

	$wp_customize->add_setting('facebook_url', array(
			'default' 		=> 'http://www.facebook.com/',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'facebook_url', array(
			'label' 		=> 'Facebook url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'facebook_url',)));

	$wp_customize->add_setting('googleplus_url', array(
			'default' 		=> 'http://plus.google.com/',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'googleplus_url', array(
			'label' 		=> 'Google plus url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'googleplus_url',)));

	$wp_customize->add_setting('youtube_url', array(
			'default' 		=> 'http://www.youtube.com/',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'youtube_url', array(
			'label' 		=> 'Youtube url',
			'section' 		=> 'premiumstyle_social_sec', 
			'settings' 		=> 'youtube_url',)));

	$wp_customize->add_setting('rss_url', array(
			'default' 		=> '',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'rss_url', array(
			'label' 		=> 'Rss url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'rss_url',)));
	// End social icons link section
		
	// Start related & author box
	$wp_customize->add_section('premiumstyle_infobox_sec' , array(
			'title' 		=> __('Display Box Setting','gopiplustheme'),
			'priority'    	=> 230,));
	$wp_customize->add_setting('premiumstyle_related_box');
	$wp_customize->add_control('premiumstyle_related_box',array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Hide related posts box on your posts and pages.',
			'section'		=> 'premiumstyle_infobox_sec',));
	
	$wp_customize->add_setting('premiumstyle_author_box');
	$wp_customize->add_control('premiumstyle_author_box',array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Hide author information box on your posts and pages.',
			'section' 		=> 'premiumstyle_infobox_sec',));
			
	$wp_customize->add_setting('premiumstyle_thumbnail_box');
	$wp_customize->add_control('premiumstyle_thumbnail_box',array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Hide thumbnail image on your single view posts and pages.',
			'section' 		=> 'premiumstyle_infobox_sec',));
	// End related & author box
	
	// Start theme footer text
	$wp_customize->add_section('premiumstyle_footer_sec' , array(
			'title' 		=> __('Footer Text','gopiplustheme'),
			'priority'    	=> 240,));
	$wp_customize->add_setting('premiumstyle_footer_l', array(
			'default' 		=> 'Copyright &copy; 2013',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Textbox_control($wp_customize, 'premiumstyle_footer_l', array(
			'label'			=> 'Footer Left',
			'section' 		=> 'premiumstyle_footer_sec',
			'settings' 		=> 'premiumstyle_footer_l',)));
	
	$wp_customize->add_setting('premiumstyle_footer_r', array(
			'default' 		=> 'All rights reserved',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Textbox_control($wp_customize, 'premiumstyle_footer_r', array(
			'label' 		=> 'Footer Right',
			'section' 		=> 'premiumstyle_footer_sec',
			'settings' 		=> 'premiumstyle_footer_r',)));
	// End theme footer text
}
add_action('customize_register', 'premiumstyle_customizer');

/**
 * Premium Style sanitize URL, Now Its safe to use in database queries
 *
 */
function premiumstyle_sanitize( $value ) 
{
    $response = esc_url_raw( $value );
    return $response;
}

/**
 * Premium Style admin tips 
 *
 */
function premiumstyle_display() 
{
	define('premiumstyle_link', 'http://www.gopiplus.com/work/2013/11/11/premium-style-wordpress-theme/');
	define('premiumstyle_docs', 'http://www.gopiplus.com/work/2013/11/12/premium-style-wordpress-theme-documentation/');
	?>
	<div class="wrap">
	  <div id="icon-themes" class="icon32"></div>
	  <h2><?php _e( 'Premium Style WordPress Theme', 'gopiplustheme' ); ?></h2>
	  <div class="tool-box">
		<h3 style="color:#009933"><?php _e( 'Thank You for Selecting Premium Style Theme From', 'gopiplustheme' ); ?>
		<a style="color:#009933;text-decoration:none;" href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank">
		<?php _e( 'gopiplus.com', 'gopiplustheme' ); ?></a></h3>
		<h3><?php _e( 'Theme configuration', 'gopiplustheme' ); ?></h3>
			<?php _e( 'Please click customize link to configure your theme.', 'gopiplustheme' ); ?>
		<h3><?php _e( 'Features of this theme', 'gopiplustheme' ); ?></h3>
		<ol>
		  <li><?php _e( 'Free theme', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Highly customizable', 'gopiplustheme' ); ?></li>
		  <li><?php _e( '100% Responsive', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Valid XHTML5 + CSS', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Firefox, IE8+, Chrome and Safari compatible', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'WP 3.6+ compatible and Tested up tp 3.8', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Blog style structure', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Social Icon settings', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Option to enable/disable Author Info Box', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Breadcrumbs links', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Free 24x5 email support', 'gopiplustheme' ); ?></li>
		</ol>
		<h3><?php _e( 'Frequently asked questions', 'gopiplustheme' ); ?></h3>
		<ol>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How do I install the theme onto my wordpress blog?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to setup Featured image for post?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to Disable and Enable home page slider?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to configure Social Icon in the theme?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to add favicon?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to Enable and Disable AuthorInfo/Related Box in the single view post?', 'gopiplustheme' ); ?></a>
		  </li>
		</ol>
		<h3><?php _e( 'Theme documentation', 'gopiplustheme' ); ?></h3>
		<ol><li><a href="<?php _e( premiumstyle_docs, 'gopiplustheme' ); ?>" target="_blank"><?php _e( premiumstyle_docs, 'gopiplustheme' ); ?></a></li></ol>
	  </div>
	</div>
	<?php
}
?>
<?php
/**
 * Функции удаления эмодзи
 */
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
?>
<?php
/**
 * Функции для отключения RSS ленты за ненадобностью
 *
 * @return void
 */
function fb_disable_feed() {
wp_redirect(get_option('siteurl')); exit;
}

add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );

?>
<?php
/**
 *  Функция формирования тега Title страниц сайта в зависимости от открытой страницы
 */
add_filter('wp_title', 'headTitle', 10, 2 );
function headTitle($title, $sep) {
    $blogName = get_bloginfo('name');

    if (is_home()) {
        return 'Foxboost - будь в числе первых обладателей новинок';
    }

    if (is_category() || is_archive() || is_tag()) {
        return 'Фоксбусты на '. mb_lcfirst(single_cat_title('',false)) .' | ' . $blogName;
    }

    if (is_search()) {
        $s = $_GET['s'];
        if (empty($s))
            return 'Найти фоксбусты по названию' . ' | ' . $blogName;
        else
            return 'Фоксбусты на '. mb_lcfirst($s) . ' | ' . $blogName;
    }

    return $title . $blogName;
}
?>
<?php
/**
 *  Функция формирования метаполя Description страницы сайта в зависимости от открытой страницы
 */
add_action("wp_head", "headMetaDescription", 1);
function headMetaDescription() {
	if( is_category() or is_tag()) {
		echo '<meta name="description" content="Скачать сертификаты соответствия на ' . cutStringToWords(
                esc_attr(
                        mb_strtolower(
                                splitStringByDash(
                                        single_cat_title('',false)
                                )[1]
                        )
                ),
                256) .'">'."\r\n";
	}
    if (is_home()) {
        echo '<meta name="description" content="На этом сайте можно скачать сертификаты ГОСТ Р, ТС и декларации соответствия бесплатно и без регистрации">'."\r\n";
    }
    if (is_page('naiti-sertifikat-po-vidu-produktsii')) {
        echo '<meta name="description" content="Сертификаты соответствия по видам продукции">'."\r\n";
    }
    if (is_page('naiti-sertifikat-po-nomeru')) {
        if (empty($_GET['param'])) echo '<meta name="description" content="Сертификаты соответствия по номеру сертификата">'."\r\n";else
            echo '<meta name="description" content="Скачать сертификаты с номером '.$_GET['param'].'">'."\r\n";
    }
    if (is_page('kompanii')) {
        if (empty($_GET['manufacturer'])) echo '<meta name="description" content="Сертификаты соответствия по организациям-изготовителям">'."\r\n"; else
            echo '<meta name="description" content="Скачать сертификаты на продукцию '.$_GET['manufacturer'].'">'."\r\n";
     }
    if (is_page('reestr-sertifikatov')) {
        echo '<meta name="description" content="Реестр сертификатов и деклараций соответствия для бесплатного скачивания">'."\r\n";
    }
	if (is_page('organy-po-sertifikacii')) {
	    if (empty($_GET['agency'])) echo '<meta name="description" content="Сертификаты соответствия по органам по сертификации">'."\r\n"; else
            echo '<meta name="description" content="Скачать сертификаты выданные органом по сертификации '.$_GET['agency'].'">'."\r\n";
	}
	if (is_page('gosty')) {
		if (empty($_GET['norm'])) echo '<meta name="description" content="ГОСТы, технические регламенты и другие нормативы на материалы, товары, продукцию и услуги">'."\r\n"; else
		echo '<meta name="description" content="Скачать '.$_GET['norm'].' бесплатно и без регистрации">'."\r\n";
	}
	if (is_page('o-sajte')) {
		echo '<meta name="description" content="О сайте, отказ от ответственности и обратная связь">'."\r\n";
	}
	if (is_search()) {
		if (empty($_GET['s'])) echo '<meta name="description" content="Поиск сертификатов соответствия на продукцию">'."\r\n"; else
		echo '<meta name="description" content="Скачать сертификаты соответствия на '. mb_lcfirst($_GET['s']) .'">'."\r\n";
	}
}
?>
<?php
/**
 * Функция удаления rel="canonical" по умолчанию
 *
 * @return void
 */
function remove_default_canonical() {
    if (isset($_GET['manufacturer']) || isset($_GET['agency']) || isset($_GET['norm'])) {
        remove_action('wp_head', 'rel_canonical');
    }
}
add_action('wp', 'remove_default_canonical');
?>
<?php
/**
 * Функция возвращает случайную строку из массива вариантов
 *
 * @param $variants - массив вариантов строк
 * @return string - случайно выбранная строка
 */
function getRandomString($variants = []): string {
    if (!(is_array($variants) && count($variants) > 0)) return '';
    return $variants[rand(0, count($variants) - 1)];
}
?>
<?php
/**
 * Функция удаляет лишние символы и пробелы в начале и конце строки, приводит к нижнему регистру
 *
 * @param $search - исходная строка
 * @return string - строка, безопасная для поиска
 */
function searchSafe($search = ''): string {
    if (empty($search)) return '';

    $search = stripslashes($search);
    $search = htmlspecialchars($search);
    $search = mb_trim($search);
    $search = mb_strtolower($search, 'UTF-8');

    return $search;
}
?>
<?php
/**
 * Функция логгирования количества строк в поиске
 *
 * @param $searchWords - массив со словами для поиска
 * @param $logFile - ресурс лог-файла
 * @return void
 */
function logTotalSearchWords($searchWords, $logFile) {
    writeLog('SEARCH: Words to search: ', $logFile);
    foreach ($searchWords as $word) writelog($word, $logFile);
    writeLog('SEARCH: Total search words: '.count($searchWords), $logFile);
};
?>
<?php
/**
 * Функция поиска с сохранением в wp_search только существительных из поискового запроса
 *
 * @param string $search - строка с названием продукции или услуги для поиска
 * @return array - результат поиска - массив Id найденных записей
 */
function searchByTitle(string $search = '') {
	global $wpdb;
    $site_url         = site_url();

    mb_internal_encoding("UTF-8");
    date_default_timezone_set('Europe/Samara');

    $logDir = ABSPATH . '/logs/searchlogs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $logFileName = $logDir . '/search-'.date("Y_m_d_H-i-s").'.txt';
    $logFile = fopen($logFileName, "w");

	//Создание лог-файла поиска
	writeLog('===========SEARCH BY TITLE==========', $logFile);

    if ($search === '') {
        writeLog('NO SEARCH STRING SUPPLIED. Exiting...', $logFile);
        fclose($logFile);
        return [];
    }

    writeLog('Source search query: '.$search, $logFile);

    //Безопасная передача параметров
    $search = searchSafe($search);

	//Ограничим строку поиска 255 символами
	$search = mb_substr($search, 0, 255);

	//Разобъем на слова по пробелам и запятым, на 5 частей максимум
    writeLog('', $logFile);
	writeLog('SEARCH: STAGE 0: Splitting:', $logFile);

	$searchWords = mb_split("[ ,]+", $search, 5);

	logTotalSearchWords($searchWords, $logFile);

	//Удалим все слова с количеством букв менее 3
    writeLog('', $logFile);
    writeLog('SEARCH: STAGE 1: Removing short (<3):', $logFile);

	$searchWords = array_values(array_filter($searchWords, function($word) use ($logFile) {
        if (mb_strlen($word) >= 3) {
            return true; // Оставляем слово
        } else {
            writeLog('SEARCH: Word removed (too short): '.$word, $logFile);
            return false; // Убираем слово
        }
    }));

	logTotalSearchWords($searchWords, $logFile);

	//Удалим все стоп-слова
    writeLog('', $logFile);
    writeLog('SEARCH: STAGE 2: Not neeeded. Skipping: ', $logFile);

	writeLog('', $logFile);
	writeLog('SEARCH: STAGE 3: Not neeeded. Skipping: ', $logFile);

	//Берем первое слово, ищем его в таблице постов - выбираем ID и название поста
    writeLog('SEARCH: STAGE 4: Fetching results contain the first word: ', $logFile);

	$word = reset($searchWords);

	//Обрежем слово для поиска словоформ с конца
	//Если слово 4 символа - не обрезаем, 5 символов - обрезаем 1, 6 символов и более - 2

	if (mb_strlen($word) >= 6) $word = mb_substr($word, 0, -2);
	else if (mb_strlen($word) == 5) $word = mb_substr($word, 0, -1);

    writeLog('SEARCH: WORD: '.$word, $logFile);

	//Выполним поиск по таблице с постами
	$sql = $wpdb->get_results($wpdb->prepare("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'foxboost' AND post_title LIKE %s", '%' . $wpdb->esc_like($word) . '%'));
	
	//Теперь в sql содержится массив объектов, содержащих ID и названия постов, содержащих в названии слово из поиска
	
	//Необходимо просмотреть оставшиеся слова в наборе слов для поиска, и исключить из найденного те варианты,
	//которые не содержат данного слова

    writeLog('', $logFile);
    writeLog('SEARCH: STAGE 5: Removing missing words: ', $logFile);
    writeLog('SEARCH: Before Filtering ('. count($sql) .')', $logFile);

	foreach ($sql as $s) {
			//Преобразуем все буквы запроса в строчные
			$s->post_title = mb_strtolower($s->post_title, 'UTF-8');

            writeLog($s->ID.': '.$s->post_title, $logFile);
	}

    writeLog('', $logFile);
    writeLog('SEARCH: Filtering by Word-starting word', $logFile);

	$sqlFilteredA = [];

	foreach ($sql as $s) {
			//Отфильтруем все запросы, в которых слово поиска встречается в заголовке записи не с начала слова

			//Получим позицию первой буквы слова поиска
			$firstLetter = mb_strpos($s->post_title, $word);

			//Если слово в 0 позиции, то результат подходит, добавим в массив результатов
			if ($firstLetter === 0) {
                writeLog('SEARCH: GOOD START: '. $s->post_title, $logFile);
				$sqlFilteredA[] = $s;
				continue;
			}

			//Получим букву перед первой
			$initLetter = mb_substr($s->post_title, $firstLetter - 1, 1);

			//Если перед словом не пробел и не скобка, выбросим этот результат
            if (!in_array($initLetter, [' ', '(', '"', '«', '“'])) {
                writeLog('SEARCH: BAD START: INIT: ' . $initLetter . '   WORD: ' . $s->post_title, $logFile);
                continue;
            }

			$sqlFilteredA[] = $s;
            writeLog('SEARCH: GOOD START: '.$s->post_title, $logFile);
	}

	$sql = $sqlFilteredA;

    writeLog('', $logFile);
    writeLog('SEARCH: AFTER Filtering by Word-starting word ('.count($sql).')', $logFile);

	$sqlFilteredA = [];

	foreach ($sql as $s) {
			//Преобразуем все буквы запроса в строчные
			$s->post_title = mb_strtolower($s->post_title, 'UTF-8');

            writeLog($s->ID.': '.$s->post_title, $logFile);
	}

    writeLog('', $logFile);
    writeLog('SEARCH: STAGE 6: Filtering by not first word: ', $logFile);

	//Переберем оставшиеся слова, начиная со второго

	foreach ($searchWords as $index => $word) {
		
		//Первый элемент пропускаем
		if ($index < 1)	continue;

		//Обрежем слово для поиска словоформ с конца
		//Если слово 4 символа - не обрезаем, 5 символов - обрезаем 1, 6 символов и более - 2

		if (mb_strlen($word) >= 6) $word = mb_substr($word, 0, -2);
		else if (mb_strlen($word) == 5) $word = mb_substr($word, 0, -1);

        writeLog('', $logFile);
        writeLog('SEARCH: WORD: '.$word, $logFile);
        writeLog('', $logFile);
		
		//Выбрали слово. Теперь пробежим поля post_title объектов массива $sql, и попробуем найти это слово

		foreach ($sql as $s) {
			if (mb_strpos($s->post_title, $word) !== false) {
                writeLog('GOOD: STRPOST: '.mb_strpos($s->post_title, $word).' WORD: '.$word.' : ID:'.$s->ID.': '.$s->post_title, $logFile);
				$sqlFilteredA[] = $s;
			} else {
                writeLog('BAD: '.$s->post_title.' WORD: '.$word.' DOES NOT FOUND', $logFile);
            }
		}
		
		$sql = $sqlFilteredA;
		$sqlFilteredA = [];
	}

    writeLog('', $logFile);
    writeLog('SEARCH: After Filtering by not first word ('.count($sql).'):', $logFile);

	foreach ($sql as $s) {
        writeLog($s->ID.': '.$s->post_title, $logFile);
	}

    writeLog('', $logFile);
    writeLog('SEARCH RESULTS:', $logFile);

	$resultTotal = [];

	foreach ($sql as $s) {
		$resultTotal[] = $s->ID;
        writeLog('ID: '.$s->ID.' FOUND: '.get_the_title ($s->ID), $logFile);
	}

    writeLog('', $logFile);
    writeLog('Exiting SEARCH BY TITLE. FOUND '. count($resultTotal). ' RESULT(S)', $logFile);


    fclose($logFile);
	return $resultTotal;
}
?>
<?php
if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
    /**
     * mb_ucfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
               mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
if (!function_exists('mb_lcfirst') && extension_loaded('mbstring'))
{
    /**
     * Функция преобразует первый символ в нижний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
    function mb_lcfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtolower(mb_substr($str, 0, 1, $encoding), $encoding).
            mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
?>
<?php
/**
 * Функция удаляет атрибуты тегов script и style
 */

add_action( 'template_redirect', function(){
    ob_start( function( $buffer ){
        $buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
        $buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
        return $buffer;
    });
});
?>
<?php
/**
 * Функция получения нужной формы слова в зависимости от числа
 *
 * @param int $number - исходное число
 * @param array $titles - варианты словоформ
 * @return mixed - результат с нужной словоформой
 */
function declination(int $number, array $titles) {
    // Массив, где:
    // 0 — для чисел, заканчивающихся на 2, 3, 4, но не 12, 13, 14;
    // 1 — для числа 1;
    // 2 — для чисел, заканчивающихся на 5, 6, 7, 8, 9, 0 и чисел 11-19.

    $cases = array(2, 0, 1, 1, 1, 2);

    // Проверяем, если число в интервале от 11 до 19, то используем форму с индексом 2
    if ($number % 100 > 4 && $number % 100 < 20) {
        return $titles[2];  // Слово в форме для чисел 11-19
    }

    // Для всех остальных чисел выбираем форму в зависимости от последней цифры
    return $titles[$cases[min($number % 10, 5)]];
}
?>
<?php
/**
 * Функция получения разницы в днях между текущей датой и заданной
 *
 * @param string $dateString - заданная дата в формате yyyymmdd
  * @return int - результат разница в количестве дней
 */
function daysToGo(string $dateString)
{

    $timestamp = strtotime($dateString);
    $today = strtotime(date('Y-m-d'));

    $diffSeconds = $timestamp - $today;
    $diffDays = floor($diffSeconds / (60 * 60 * 24));

    return max($diffDays, 0);
}

?>
<?php
/**
 * Функция для сортировки по длине строки
 *
 * @param string $a - первая строка
 * @param string $b - вторая строка
 * @return int - -1 если первая строка длиннее, 0 - если они равны, 1 - если длиннее вторая строка
 */
function sortByLength(string $a, string $b): int {
    return mb_strlen($b) <=> mb_strlen($a);
}
?>
<?php
/**
 * Функция обрезает исходную строку по пробелу внутри заданной максимальной длины строки
 *
 * @param $str      - исходная строка
 * @param $length   - максимальная длина строки
 * @param $postfix  - постфикс
 * @param $encoding - кодировка
 * @return string   - результирующая обрезанная строка
 */
function cutStringToWords($str, $length, $postfix = '', $encoding = null): string {
    $encoding = $encoding ?: mb_detect_encoding($str);

    $str = mb_eregi_replace('[^a-zа-яё ]', '', $str);
    $str = mb_trim($str);

    $strLength = mb_strlen($str, $encoding);

    if ($strLength <= $length) {
        return $str;
    }

    $cutPoint = mb_strripos(mb_substr($str, 0, $length, $encoding), ' ', 0, $encoding);
    if ($cutPoint !== false) {
        return mb_substr($str, 0, $cutPoint, $encoding) . $postfix;
    }

    return mb_substr($str, 0, $length, $encoding) . $postfix;
}
?>
<?php
/**
 * Функция для разделения строки по одному из возможных
 * знаков тире пополам
 *
 * @param string $input - исходная строка
 * @return array|string[] - первый элемент - строка до тире, второй - после тире
 */
function splitStringByDash(string $input = '') {
    if ($input === '') return ['', ''];


    $input = str_replace(['–', '—'], '-', $input);

    // Ищем позицию символа "-"
    $position = strpos($input, '-');

    // Если символ "-" найден, разделяем строку
    if ($position !== false) {
        $beforeDash = mb_trim(substr($input, 0, $position)); // Часть до "-"
        $afterDash = mb_trim(substr($input, $position + 1)); // Часть после "-"

        return [$beforeDash, $afterDash];
    }

    // Если символ "-" не найден, возвращаем оригинальную строку
    return ['', $input];
}
?>
<?php
/**
 * Функция получения текста внутри внешних кавычек
 * и дополнение справа кавычкой, парной самой левой оставшейся.
 *
 * @param string $string - строка с исходным текстом
 * @return mixed|string - результат
 */
function getTextInsideQuotes(string $string = '') {
    if ($string === '') return $string;

    $quoteTypes = [
        '\'' => '\'',
        '"' => '"',
        '`' => '`',
        '«' => '»',
        '“' => '”',
    ];

    foreach ($quoteTypes as $quoteOpen => $quoteClose) {
        $startPos = mb_strpos($string, $quoteOpen);
        if ($startPos !== false) {
            $endPos = mb_strpos($string, $quoteClose, $startPos + 1);

            if ($endPos !== false) {
                $string = mb_substr($string, $startPos + 1, $endPos - $startPos - 1);
                break;
            }
        }
    }

    foreach (mb_str_split($string) as $sym) {
        if (array_key_exists($sym, $quoteTypes)) {
            $string .= $quoteTypes[$sym];
            break;
        }
    }

    return $string;
}
?>
<?php
/**
 * Функция для расчёта количества страниц, текущей страницы
 * и массива кнопок для отображения пагинации
 *
 * @param int $totalItems - общее количество элементов
 * @param int $st - номер первого элемента на странице
 * @param int $len - количество элементов на странице
 * @return array - массив кнопок для пагинации
 */
function calculatePagination($totalItems, $st, $len) {

    // Вычисляем общее количество страниц
    $totalPages = ceil($totalItems / $len);

    // Вычисляем текущую страницу
    $currentPage = ceil($st / $len) + 1;

    // Массив страниц для отображения
    $pages = [];

    // Вычисляем диапазон
    $startPage = max(1, $currentPage - 1); // минимум 1
    $endPage = min($totalPages, $currentPage + 1); // максимум общее количество страниц

    // Добавляем страницы до и после текущей
    for ($page = $startPage; $page <= $endPage; $page++) {
        $pages[] = $page;
    }

    // Если меньше 3 страниц, заполняем недостающие с другой стороны
    $pagesCount = count($pages);
    if ($pagesCount < 3) {
        // Если слева не хватает страниц
        if ($startPage == 1) {
            $pagesToAdd = 3 - $pagesCount;
            for ($i = $endPage + 1; $i <= $endPage + $pagesToAdd; $i++) {
                if ($i <= $totalPages) {
                    $pages[] = $i;
                }
            }
        }
        // Если справа не хватает страниц
        elseif ($endPage == $totalPages) {
            $pagesToAdd = 3 - $pagesCount;
            for ($i = $startPage - 1; $i >= $startPage - $pagesToAdd; $i--) {
                if ($i >= 1) {
                    array_unshift($pages, $i);
                }
            }
        }
    }

    // Возвращаем все данные
    return [
        'totalPages' => $totalPages,
        'currentPage' => $currentPage,
        'pages' => $pages
    ];
}
?>
<?php
/**
 * Функция записи сообщения в лог-файл с текущей датой и временем
 *
 * @param string $message - строка сообщения
 * @param $logFile - ресурс лог-файла
 * @return void
 */
function writeLog(string $message, $logFile) {
    if (is_resource($logFile)) {
        date_default_timezone_set('Europe/Samara');
        fwrite($logFile, date("Y_m_d_H-i-s") . ' : ' . $message . "\r\n");
    }
}
?>
<?php
/**
 * Функция возвращает разметку для сообщения об успешном действии
 *
 * @param string $message - строка с сообщением
 * @return string - строка с HTML-разметкой
 */
function resultSuccess(string $message = '') {
    return $message ? '<div class="add__result add__result_success">'. htmlspecialchars($message) .'</div>' : '';
}
?>
<?php
/**
 * Функция возвращает разметку для сообщения об ошибке
 *
 * @param string $message - строка с сообщением
 * @return string - строка с HTML-разметкой
 */
function resultFailed(string $message = '') {
    return $message ? '<div class="add__result add__result_failed">'. htmlspecialchars($message) .'</div>' : '';
}
?>
<?php
/**
 * Функция меняет двойные кавычки на одинарные
 *
 * @param $str - исходная строка
 * @return array|string|string[] - строка, в которой все " заменены на '
 */
function replaceQuotes(string $str = '') {
    if ($str === '') {
        return '';
    }

    return str_replace('"', "'", $str);
}
?>
<?php
/**
 * Функция загружает рекламу из файла и выводит в разметку
 *
 * @param string $fileUrl - строка с URL для рекламы
 * @return string - HTML-разметка с рекламой
 */
function getAdContent(string $fileUrl = ''): string {
    if ($fileUrl === '') {
        return '';
    }

    $fileUrl = site_url() . ADS_PATH . $fileUrl;

    if (@file($fileUrl) === false) return '';

    return  @file_get_contents($fileUrl) ?: '';
}
?>
<?php
/**
 * Функция возвращает общее количество заявок из БД
 *
 * @return int - общее количество заявок
 */
function getTotalApplications() {
    return 0;
}
?>
<?php
/**
 * Функция возвращает общее количество отправленных уведомлений из БД
 *
 * @return int - общее количество отправленных уведомлений
 */
function getTotalSentNotifications()
{
    return 0;
}
?>
<?php
/**
 * Функция возвращает массив заявок из БД
 *
 * @param int|null $foxboostId int - номер фоксбуста (совпадает с номером записи фоксбуста в WP)
 *
 * @return array[] - массив ассоциированных массивов с заявками
 */
function getApplicationsByFoxboostId(?int $foxboostId = null): array {
    if (empty($foxboostId)) return [];

    return [
        [
            'email' => 'ivanov_a@mail.ru',
            'name' => 'Иванов Андрей',
            'promocode' => '',
            'status' => 'sent-no'
        ],
        [
            'email' => 'Solnyshko_s@yandex.ru',
            'name' => 'Светлана С.',
            'promocode' => '',
            'status' => 'sent-no'
        ],
        [
            'email' => 'nashSlonyara@ibm.ru',
            'name' => 'Слоновский Эдуард Петрович',
            'promocode' => 'Промокод на 10%',
            'status' => 'sent-man'
        ],
        [
            'email' => 'ia@mail.ru',
            'name' => 'Петров Сергей',
            'promocode' => '',
            'status' => 'sent-no'
        ]
    ];
}
?>
<?php
/**
 * Функция возвращает массив фоксбустов по статусам БД
 *
 * @param string|null $status - статус фоксбуста:
 *      active - сбор заявок
 *      completed - сбор заявок завершен
 *      archive- в архиве
 *
 * @return int[] - массив номеров фоксбуста (совпадает с номером записи фоксбуста в WP)
 */
function getFoxboostIdsByStatus(?string $status = null): array {
    if (empty($status)) return [];

    return [32, 74, 79];
}
?>
<?php
/**
 * Функция возвращает название фоксбуста по его ID
 *
 * @param int|null $id - ID фоксбуста:

 * @return string - название фоксбуста
 */
function getFoxboostNameById(?int $id = null): string
{
    if (empty($id)) return '';

    switch ($id) {
        case 32: return 'Кресло FoxGear NETZ model X';
        case 74: return 'Клавиатура NuPhy Halo60 HE';
        case 79: return 'Ноутбучный столик FoxGear NTray';
    }

    return '';
}
?>
<?php
add_action('add_meta_boxes', function() {
    global $post_type;

    if ($post_type === 'brand') {
        remove_meta_box('categorydiv', 'brand', 'side');
        remove_meta_box('tagsdiv-post_tag', 'brand', 'side');
    }

    if ($post_type === 'ambassador') {
        remove_meta_box('categorydiv', 'ambassador', 'side');
        remove_meta_box('tagsdiv-post_tag', 'ambassador', 'side');
    }
});
?>
