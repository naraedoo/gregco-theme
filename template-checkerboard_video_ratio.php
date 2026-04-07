<?php
/*
Template Name: checkerboard_video_ratio
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
    font-size: var(--font-size-sm);
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


/* ===== Work filter buttons (FIX: iOS blue + spacing) ===== */

/* ul 자체를 버튼 랩으로: 줄바꿈 + 간격 + 위아래 여백 */
.tagging.list.work-filters{
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start; /* ← 여기 */
  gap: 8px 8px;           /* 가로/세로 간격 */
  padding: 0;
  margin: 18px 0 18px;    /* 위아래 여백 */
  list-style: none;
}

/* li는 margin 주지 말고 gap으로 관리 */
.tagging.list.work-filters li{
  display: inline-flex;
  margin: 0;
}

/* 버튼 기본 상태: iOS 파란색 강제 제거 */
.tagging.list.work-filters .work-filter{
  -webkit-appearance: none;
  appearance: none;
  background: transparent;
  border: 1px solid var(--color-black);
  border-radius: 999px;
  padding: 10px 14px;     /* 터치 영역 + 여백 */
  font: inherit;
  font-size: 16px;
  line-height: 1;         /* 버튼 텍스트 수직 흔들림 방지 */

  color: var(--color-black);
  -webkit-text-fill-color: var(--color-black); /* iOS에서 파란 텍스트 방지 */
  text-decoration: none;
  cursor: pointer;
}

/* active */
.tagging.list.work-filters .work-filter.is-active{
  background: var(--color-black);
  color: #fff;
  -webkit-text-fill-color: #fff; /* iOS에서도 흰색 유지 */
}

/* 모바일 더 타이트하게 */
@media (max-width: 480px){
  .tagging.list.work-filters{
    margin: 14px 0 14px;
    gap: 8px 8px;
  }
  .tagging.list.work-filters .work-filter{
    font-size: 15px;
    padding: 9px 12px;
  }
}

/* ==================================================
   Work filter – Mobile FIX (iOS blue + spacing)
   ================================================== */

/* 필터 래퍼 */
ul.tagging.list.work-filters{
  display: flex !important;
  flex-wrap: wrap !important;
  justify-content: flex-start !important;

  row-gap: 10px !important;   /* ← 줄바꿈 시 위아래 여백 */
  column-gap: 8px !important;

  padding: 0 !important;
  margin: 18px 0 20px !important;
  list-style: none !important;
}

/* li는 레이아웃만 담당 */
ul.tagging.list.work-filters > li{
  display: inline-flex !important;
  margin: 0 !important;
}

/* 버튼 자체 */
ul.tagging.list.work-filters > li > button.work-filter{
  -webkit-appearance: none !important;
  appearance: none !important;
  background: transparent !important;

  border: 1px solid #141414 !important;
  border-radius: 999px !important;

  padding: 10px 14px !important;
  min-height: 36px !important;        /* 터치 영역 확보 */
  line-height: 1.2 !important;        /* ← 숨통 트이게 */

  font: inherit !important;
  font-size: 15px !important;

  color: #141414 !important;
  -webkit-text-fill-color: #141414 !important;
  background-clip: padding-box !important;

  text-decoration: none !important;
  cursor: pointer !important;
}

/* 활성 상태 */
ul.tagging.list.work-filters > li > button.work-filter.is-active{
  background: #141414 !important;
  color: #fff !important;
  -webkit-text-fill-color: #fff !important;
}

/* 모바일에서 살짝 더 컴팩트 */
@media (max-width: 480px){
  ul.tagging.list.work-filters{
    margin: 14px 0 18px !important;
    row-gap: 12px !important;   /* 모바일은 줄 간격 더 여유 */
  }

  ul.tagging.list.work-filters > li > button.work-filter{
    font-size: 14px !important;
    padding: 9px 12px !important;
  }
}

</style>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <article class="post page">
    <h2 class="up-on-scroll"><?php the_title(); ?></h2>
    <?php the_content(); ?>
  </article>

  <?php
  // ====== FILTER BUTTONS (NO LINKS) ======
  $ordered_slugs = ['all','strategy','branding','campaign','content','design'];

  $terms = get_terms([
    'taxonomy'   => 'work_category',
    'hide_empty' => false,
  ]);

  if (!is_wp_error($terms) && !empty($terms)) {

    $term_map = [];
    foreach ($terms as $t) {
      $term_map[$t->slug] = $t;
    }

    echo "<ul class='tagging list work-filters' data-filter-group='work'>";

    foreach ($ordered_slugs as $slug) {

      if ($slug === 'all') {
        $name = 'All';
      } else {
        if (!isset($term_map[$slug])) continue;
        $name = $term_map[$slug]->name;
      }

      $is_active = ($slug === 'all') ? ' is-active' : '';
      $pressed   = ($slug === 'all') ? 'true' : 'false';

      echo "<li class='up-on-scroll'>
              <button type='button' class='work-filter{$is_active}' data-filter='{$slug}' aria-pressed='{$pressed}'>
                {$name}
              </button>
            </li>";
    }

    echo "</ul>";

  } else {
    echo "<p style='opacity:.6'>work_category 텀이 없습니다.</p>";
  }
  ?>

  <br>

<?php endwhile; else : ?>
  포스트가 없습니다.
<?php endif; ?>

<?php
// ====== SUBPAGES GRID ======
$current_page = get_queried_object();

$subpages_args = [
  'post_type'      => 'page',
  'post_parent'    => $current_page->ID,
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
];

$subpages_query = new WP_Query($subpages_args);

if ($subpages_query->have_posts()) :
?>

  <div class="template-gallery-grid">
    <?php while ($subpages_query->have_posts()) : $subpages_query->the_post();

      // ====== 카드가 어떤 카테고리인지 data-cat에 심기 ======
      $work_terms = get_the_terms(get_the_ID(), 'work_category');
      $primary_slug = 'uncategorized';
      if (!is_wp_error($work_terms) && !empty($work_terms)) {
        $primary_slug = $work_terms[0]->slug; // 1개만 선택 전제
      }

      // ACF
      $title_color = get_field('title_color');
      $style = $title_color ? "color: {$title_color}; border-color: {$title_color};" : '';
      $display_the_excerpt = get_field('display_the_excerpt');
      $tag_on_picture = get_field('tag_on_picture');
      $video_file = get_field('video_greg');
      $video_ratio = get_field('video_ratio');

      $padding_top = '';
      $is_original = ($video_ratio === 'original');
      if (!$is_original) {
        if ($video_ratio == '1:1') $padding_top = '100%';
        elseif ($video_ratio == '4:3') $padding_top = '75%';
        elseif ($video_ratio == '3:4') $padding_top = '133.33%';
      }
    ?>
      <div
        class="template-gallery-item up-on-scroll <?php if (!has_post_thumbnail() && !$video_file) : ?>no-image<?php endif; ?>"
        data-cat="<?php echo esc_attr($primary_slug); ?>"
        style="<?php if (!has_post_thumbnail() && !$video_file) : ?>background-color: <?php the_field('background_color'); ?>;<?php endif; ?>"
      >
        <a href="<?php the_permalink(); ?>">
          <?php
          if ($video_file) {
            $video_url = $video_file['url'];
            if ($is_original) {
              echo '<div class="video-container" style="position: relative; overflow: hidden; border-radius: 8px;">';
              echo '<video width="100%" height="auto" autoplay loop muted playsinline style="border-radius: 8px;"><source src="' . esc_url($video_url) . '" type="video/mp4"></video>';
              echo '</div>';
            } else {
              echo '<div class="video-container" style="position: relative; width: 100%; padding-top: ' . esc_attr($padding_top) . '; overflow: hidden; border-radius: 8px;">';
              echo '<video style="object-fit: cover; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%;" autoplay loop muted playsinline><source src="' . esc_url($video_url) . '" type="video/mp4"></video>';
              echo '</div>';
            }
          } elseif (has_post_thumbnail()) {
            echo '<div style="border-radius: 8px; overflow: hidden;">';
            the_post_thumbnail();
            echo '</div>';
          }
          ?>

          <div class="template-gallery-title <?php echo ($title_color === 'black') ? 'title-black' : 'title-white'; ?>">
            <?php the_title(); ?>
          </div>

          <?php if ($display_the_excerpt === 'on') : ?>
            <div class="template-gallery-description <?php echo (!has_post_thumbnail() && !$video_file) ? 'no-image' : ''; ?>" style="<?php echo esc_attr($style); ?>">
              <?php echo custom_excerpt_length_by_char(get_the_excerpt(), 70); ?>
            </div>
          <?php endif; ?>

          <?php if ($tag_on_picture) : ?>
            <div class="tag-box" style="<?php echo esc_attr($style); ?>">
              <span class="tag-text"><?php echo esc_html($tag_on_picture); ?></span>
              <span class="view-text" style="<?php echo esc_attr($style); ?>">View</span>
            </div>
          <?php endif; ?>

        </a>
      </div>
    <?php endwhile; ?>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
    // hover 효과 (기존)
    document.querySelectorAll('.template-gallery-item').forEach(function(item) {
      const tagText = item.querySelector('.tag-text');
      const viewText = item.querySelector('.view-text');
      if (!tagText || !viewText) return;

      item.addEventListener('mouseover', function() {
        tagText.style.transform = 'translateY(-100%)';
        viewText.style.transform = 'translateY(0)';
      });

      item.addEventListener('mouseout', function() {
        tagText.style.transform = 'translateY(0)';
        viewText.style.transform = 'translateY(100%)';
      });
    });

    // ====== filter (1개만 선택) ======
    const buttons = document.querySelectorAll('.work-filter');
    const items   = document.querySelectorAll('.template-gallery-item');

    function setActive(filter) {
      buttons.forEach(btn => {
        const on = btn.dataset.filter === filter;
        btn.classList.toggle('is-active', on);
        btn.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
    }

    function apply(filter) {
      items.forEach(el => {
        const cat = el.dataset.cat;
        const show = (filter === 'all') || (cat === filter);
        el.style.display = show ? '' : 'none';
      });
      setActive(filter);
    }

    buttons.forEach(btn => btn.addEventListener('click', () => apply(btn.dataset.filter)));
    apply('all');
  });
  </script>

  <svg id="cursor"></svg>

<?php
  wp_reset_postdata();
endif;

get_footer();
?>
