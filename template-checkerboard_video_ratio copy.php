<?php
/*
Template Name: checkerboard_video_ratio_copy
*/
get_header();
?>

<style>
.template-gallery-grid {
    column-count: 3; /* 데스크톱 뷰에서의 열 개수 */
    column-gap: 1em;
}

.template-gallery-item img {
    max-width: 100%; /* 이미지가 열의 너비를 넘어가지 않도록 함 */
    height: auto; /* 이미지의 높이를 자동으로 조절하여 비율 유지 */
	/*border: 1px solid #9b9a9a;*/
	border-radius: 8px;
}
.template-gallery-description{
    position: absolute;
    color: #9b9a9a;
	font-size: 0.8em;
    font-weight: 400;
    line-height: 1.4em;
    bottom: 11px;
    font-size: 0.3em;
    transform: translate(-50%, -50%);
    left: 50%;
}
.template-gallery-description p{
	color: #9b9a9a;
	font-size: 0.8em;
    font-weight: 400;
    line-height: 1.4em;
    color: #9b9a9a;
    margin: 0;
}
.video-ratio-1-1 {
    padding-top: 100%; /* 1:1 비율 */
}

.video-ratio-4-3 {
    padding-top: 75%; /* 4:3 비율 */
}

.video-ratio-3-4 {
    padding-top: 133.33%; /* 3:4 비율 */
}

@media (max-width: 768px) {
    .template-gallery-grid {
        column-count: 2; /* 태블릿 뷰에서의 열 개수 */
    }
}

@media (max-width: 480px) {
    .template-gallery-grid {
        column-count: 1; /* 모바일 뷰에서의 열 개수 */
    }

	
}

.template-gallery-item {
    break-inside: avoid; /* 열 바꿈 방지 */
    margin-bottom: 0.9em;
}


.template-gallery-item {
    position: relative; /* 자식 요소의 위치를 기준으로 설정 */
}

.template-gallery-item a {
    display: block; /* 링크를 블록 요소로 만들어 전체 영역이 클릭 가능하게 함 */
    text-align: center; /* 텍스트 중앙 정렬 */
}

.template-gallery-title {
    font-size: font-size: var(--font-size-sm);
    position: absolute; /* 절대 위치 설정 */
    top: 50%; /* 상단에서부터 50% 위치에 배치 */
    left: 50%; /* 왼쪽에서부터 50% 위치에 배치 */
    transform: translate(-50%, -50%); /* 정확한 중앙 위치로 조정 */
    width: 80%; /* 부모 요소의 전체 너비 */
    color: #0e0e0e; /* 타이틀의 글자 색상 (필요에 따라 변경) */
    /*background-color: rgba(0, 0, 0, 0.5); 배경색과 투명도 (필요에 따라 변경) */
    padding: 5px 0; /* 상하 패딩 */
}
.template-gallery-title.title-black {
    color: #0e0e0e; /* 검정색 */
}

.template-gallery-title.title-white {
    color: #ffffff; /* 흰색 */
}
/* 추가된 스타일 */
.template-gallery-item.no-image {
    padding: 2rem; /* 이미지가 없을 때의 패딩 */
    background-color: #f0f0f0; /* 기본 배경색, ACF 필드 값으로 대체 가능 */
	
}
.template-gallery-item.no-image {
    padding: 15rem 0;
    border-radius: 8px;
    /* 기본 배경색은 PHP 코드에서 설정됩니다. */
    margin-bottom: 20px;
}

.list{ text-align: center;

}
/* 모바일 화면 크기에 대한 미디어 쿼리 *//* 모바일 화면 크기에 대한 미디어 쿼리 *//* 모바일 화면 크기에 대한 미디어 쿼리 */


/* 태그 박스 스타일 */
.tag-box {
    display: inline-block; /* 기본적으로 표시 */
    position: absolute;
    top: 2rem; /* 상단에서 2rem 아래 */
    left: 50%;
    transform: translateX(-50%);
    border: 1px solid #333;
    border-radius: 15px;
    cursor: pointer;
    overflow: hidden;
	font-size: 0.3em;
}

/* 태그 텍스트 및 뷰 텍스트 스타일 */
.tag-text, .view-text {
    display: block;
    padding: 0.4rem 0.8rem;
    text-align: center;
    transition: transform 0.3s ease;
}

.tag-text {
    transform: translateY(0);
}

.view-text {
    transform: translateY(100%);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    color: #333;
}

/* 태그 박스에 마우스 오버 시 효과 */
.tag-box:hover .tag-text {
    transform: translateY(-100%);
}

.tag-box:hover .view-text {
    transform: translateY(0);
}
@media (max-width: 768px) {
    .template-gallery-item.no-image {
        padding: 5rem 0;
    }
	.tag-box {
    display: inline-block; /* 기본적으로 표시 */
    position: absolute;
    top: 1rem; /* 상단에서 2rem 아래 */
    border: 1px solid #333;
    border-radius: 15px;
    cursor: pointer;
    overflow: hidden;
	font-size: 0.45em;
}

}
svg#cursor {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: -1;
}



svg#cursor {
  transition: top 0.0125s ease-in-out, left 0.0125s ease-in-out,
    transform 0.3s ease-in-out;
}

</style>


<body <?php body_class(); ?>>

	<?php
	if (have_posts()) :
		while (have_posts()) : the_post();
	?>
			<article class="post page">
				<h2 class="up-on-scroll"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</article>


            <?php
// 워드프레스 환경을 불러옵니다.
require_once('wp-load.php');

// 부모 페이지 ID 설정
$parent_page_id = 564; // 부모 페이지 ID를 여기에 설정하세요.

// 부모 페이지의 하위 페이지들을 가져옵니다.
$args = array(
    'post_parent' => $parent_page_id,
    'post_type'   => 'page', 
    'numberposts' => -1,
    'post_status' => 'publish'
);
$child_pages = get_children($args);

// 각 하위 페이지의 태그를 출력합니다.
$tags_list = array();
foreach ($child_pages as $page) {
    $tags = wp_get_post_tags($page->ID);
    foreach ($tags as $tag) {
        if (!in_array($tag->term_id, array_keys($tags_list))) {
            $tags_list[$tag->term_id] = $tag->name;
        }
    }
}

echo "<ul class='tagging list '>";
foreach ($tags_list as $tag_id => $tag_name) {
    $tag_link = get_tag_link($tag_id);
    echo "<li class='up-on-scroll'><a href='{$tag_link}'>{$tag_name}</a></li>";
}
echo "</ul>";
?>
<br>

	<?php
		endwhile;
	else :
		echo '포스트가 없습니다.';
	endif;
	?>

	<?php
	// 현재 페이지의 정보를 가져옵니다.
	$current_page = get_queried_object();

	// 현재 페이지의 하위 페이지 목록을 가져옵니다.
	$subpages_args = array(
		'post_type'      => 'page',
		'post_parent'    => $current_page->ID,
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);

	$subpages_query = new WP_Query($subpages_args);

	// 하위 페이지의 루프를 시작합니다.
	if ($subpages_query->have_posts()) :
	?>

<div class="template-gallery-grid">
    <?php
    while ($subpages_query->have_posts()) : $subpages_query->the_post();

        global $post; // 현재 포스트를 글로벌 포스트 객체로 설정

        // ACF 필드에서 색상 및 기타 값 가져오기
        $title_color = get_field('title_color');
        $style = $title_color ? "color: {$title_color}; border-color: {$title_color};" : '';
        $display_the_excerpt = get_field('display_the_excerpt');
        $tag_on_picture = get_field('tag_on_picture');
        $video_file = get_field('video_greg'); // 동영상 파일 필드
        $video_ratio = get_field('video_ratio'); // 비디오 비율 필드

        // 비디오 비율에 따른 패딩 설정
        $padding_top = '';
        $is_original = $video_ratio === 'original'; // 원래 비율인지 확인
        if (!$is_original) {
            if ($video_ratio == '1:1') {
                $padding_top = '100%'; // 1:1 비율
            } elseif ($video_ratio == '4:3') {
                $padding_top = '75%'; // 4:3 비율
            } elseif ($video_ratio == '3:4') {
                $padding_top = '133.33%'; // 3:4 비율
            }
        }

    ?>
        <div class="template-gallery-item up-on-scroll <?php if (!has_post_thumbnail() && !$video_file) : ?>no-image<?php endif; ?>" style="<?php if (!has_post_thumbnail() && !$video_file) : ?>background-color: <?php the_field('background_color'); ?>;<?php endif; ?>">
            <a href="<?php the_permalink(); ?>">
                <?php 
                // 동영상 파일이 있으면 동영상 표시
                if ($video_file) {
                    $video_url = $video_file['url'];
                    if ($is_original) {
                        // 원래 비율로 동영상 표시
                        echo '<div class="video-container" style="position: relative; overflow: hidden; border-radius: 8px;">';
                        // 비디오 태그: 자동 재생, 루프, 음소거, 인라인 재생
                        echo '<video width="100%" height="auto" autoplay loop muted playsinline style="border-radius: 8px;"><source src="' . $video_url . '" type="video/mp4"></video>';
                        echo '</div>';
                    } else {
                        // 지정된 비율로 동영상 표시
                        echo '<div class="video-container" style="position: relative; width: 100%; padding-top: ' . $padding_top . '; overflow: hidden; border-radius: 8px;">';
                        // 비디오 태그: 자동 재생, 루프, 음소거, 인라인 재생, 커버 효과
                        echo '<video style="object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%;" autoplay loop muted playsinline><source src="' . $video_url . '" type="video/mp4"></video>';
                        echo '</div>';
                    }
                } elseif (has_post_thumbnail()) {
                    // 특성화 이미지가 있으면 이미지 표시
                    echo '<div style="border-radius: 8px; overflow: hidden;">';
                    the_post_thumbnail();
                    echo '</div>';
                }
                ?>
                <div class="template-gallery-title <?php echo $title_color === 'black' ? 'title-black' : 'title-white'; ?>">
                    <?php the_title(); ?>
                </div>
                <?php if ($display_the_excerpt === 'on') : ?>
                    <div class="template-gallery-description <?php echo !has_post_thumbnail() && !$video_file ? 'no-image' : ''; ?>" style="<?php echo $style; ?>">
                        <?php echo custom_excerpt_length_by_char(get_the_excerpt(), 70); // 100글자로 제한?>
                    </div>
                <?php endif; ?>
                <?php if ($tag_on_picture) : ?>
                    <div class="tag-box" style="<?php echo $style; ?>">
                        <span class="tag-text"><?php echo $tag_on_picture; ?></span>
                        <span class="view-text" style="<?php echo $style; ?>">View</span>
                    </div>
                <?php endif; ?>
            </a>
        </div>
    <?php endwhile; ?>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.template-gallery-item').forEach(function(item) {
        item.addEventListener('mouseover', function() {
            this.querySelector('.tag-text').style.transform = 'translateY(-100%)';
            this.querySelector('.view-text').style.transform = 'translateY(0)';
        });

        item.addEventListener('mouseout', function() {
            this.querySelector('.tag-text').style.transform = 'translateY(0)';
            this.querySelector('.view-text').style.transform = 'translateY(100%)';
        });
    });
});
</script>
<svg id="cursor"></svg>	
	<?php
		wp_reset_postdata();
	endif;
	?>
	<?php get_footer(); ?>

