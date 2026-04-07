<?php

function my_enqueue_assets() {

  // 메인 스타일시트
  wp_enqueue_style('style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));

  // header.css
  $header_css = get_template_directory() . '/css/header.css';
  wp_enqueue_style(
    'custom-header',
    get_template_directory_uri() . '/css/header.css',
    array('style'),
    filemtime($header_css),
    'all'
  );

  // custom.css (기존 custom2.css 대체)
  $custom_css = get_template_directory() . '/css/custom.css';
  wp_enqueue_style(
    'custom',
    get_template_directory_uri() . '/css/custom.css',
    array('style'),
    filemtime($custom_css),
    'all'
  );
}
add_action('wp_enqueue_scripts', 'my_enqueue_assets');
function my_theme_setup()
{
	// 메뉴등록 
	register_nav_menus(
		array(
			'primary' => __('Primary Menu'),
			'footer' => __('Footer Menu'),
		)
	);
	//포스트 썸네일 등록하기
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'my_theme_setup');
function custom_enqueue_scripts()
{
  $st_js   = get_template_directory() . '/js/st.js';
  $greg_js = get_template_directory() . '/js/greg_js.js';

  wp_enqueue_script('st-script', get_template_directory_uri() . '/js/st.js', array(), filemtime($st_js), true);
  wp_enqueue_script('greg-script', get_template_directory_uri() . '/js/greg_js.js', array(), filemtime($greg_js), true);
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');



function theme_prefix_setup()
{
	add_theme_support('custom-logo');
}

add_action('after_setup_theme', 'theme_prefix_setup');

///////////////////////////
/////커스텀필드 메인 추출
function add_image_size_metabox()
{
	add_meta_box('image_size', 'Image Size', 'image_size_metabox_callback', 'post');
}

function image_size_metabox_callback($post)
{
    $selected_size = get_post_meta($post->ID, '_image_size', true);

    ob_start(); // 🔹 출력 버퍼 시작
    ?>
    <select name="image_size">
        <option value="medium" <?php selected($selected_size, 'medium'); ?>>Medium</option>
        <option value="large" <?php selected($selected_size, 'large'); ?>>Large</option>
    </select>
    <?php

    echo ob_get_clean(); // 🔹 버퍼 출력 + 종료
}


add_action('add_meta_boxes', 'add_image_size_metabox');

function save_image_size($post_id)
{
	if (isset($_POST['image_size'])) {
		update_post_meta($post_id, '_image_size', $_POST['image_size']);
	}
}

add_action('save_post', 'save_image_size');


//토론 변경//
function remove_menus()
{
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_menus');

//코멘트//
function df_disable_comments_admin_bar()
{
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('admin_init', 'df_disable_comments_admin_bar');




//페이지 내용 추출 글 수 제한 , 목록 글 수 제한과 핀터레스트에 사용
function custom_excerpt_length($content, $limit) {
    $content = strip_tags($content); // HTML 태그 제거
    if (mb_strlen($content) > $limit) {
        $content = mb_substr($content, 0, $limit) . ''; // 내용을 $limit 글자로 제한
    }
    return $content;
}



// 페이지 내 요약글 삽입
function add_excerpt_support_for_pages()
{
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_support_for_pages');



/*
//front-page.php에서만 JavaScript 파일을 로드
function my_theme_enqueue_scripts()
{
	wp_register_script('my_custom_script', get_template_directory_uri() . '/js/greg_js.js', array('jquery'), '1.0.0', true);

	// front-page.php에만 스크립트를 추가
	if (is_front_page()) {
		wp_enqueue_script('my_custom_script');
	}
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');
*/


//요약글에 피태그 금지 page.php에서 제목 글씨 분절을 위해 적용함 이 때문에 프론트 페이지 요약에 P넣어줌
function remove_p_tags_from_excerpt( $excerpt ) {
    $excerpt = strip_tags($excerpt, '<a>'); // '<a>' 태그를 제외한 모든 태그 제거
    return $excerpt;
}
add_filter( 'the_excerpt', 'remove_p_tags_from_excerpt' );


//페이지에 태그 사용
function add_tags_to_pages() {
    register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tags_to_pages');

//태그를 생성된 순서대로 정렬
add_filter( 'get_terms_orderby', function( $orderby, $args ) {
    if ( isset( $args['taxonomy'] ) && 'post_tag' === $args['taxonomy'] ) {
        return 'term_id';
    }
    return $orderby;
}, 10, 2 );
////// 요약글 자르기
function custom_excerpt_length_by_char($content, $limit) {
    $content = strip_tags($content); // HTML 태그 제거
    if (mb_strlen($content) > $limit) {
        $content = mb_substr($content, 0, $limit) . '...'; // 내용을 $limit 글자로 제한
    }
    return $content;
}

////
function include_pages_in_tag_archives($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_tag()) {
        $query->set('post_type', array('post', 'page')); // 포스트와 페이지 모두 포함
    }
}
add_action('pre_get_posts', 'include_pages_in_tag_archives');

// Work Category taxonomy (pages)
function register_work_category_taxonomy() {

    $labels = array(
        'name'              => 'Work Categories',
        'singular_name'     => 'Work Category',
        'search_items'      => 'Search Work Categories',
        'all_items'         => 'All Work Categories',
        'parent_item'       => 'Parent Work Category',
        'parent_item_colon' => 'Parent Work Category:',
        'edit_item'         => 'Edit Work Category',
        'update_item'       => 'Update Work Category',
        'add_new_item'      => 'Add New Work Category',
        'new_item_name'     => 'New Work Category Name',
        'menu_name'         => 'Work Category',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,   // 블록에디터/REST
        'hierarchical'      => true,   // 카테고리처럼(계층형). 태그처럼 하려면 false
        'rewrite'           => array('slug' => 'work_category'),
    );

    register_taxonomy('work_category', array('page'), $args);
}
add_action('init', 'register_work_category_taxonomy');

