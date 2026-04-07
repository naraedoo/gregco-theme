<?php
/*
Template Name: checkerboard_video_ratio
*/
get_header();
?>

<style>
/* ===== Grid ===== */
.template-gallery-grid {
    column-count: 3;
    column-gap: 1em;
}
@media (max-width: 768px) { .template-gallery-grid { column-count: 2; } }
@media (max-width: 480px)  { .template-gallery-grid { column-count: 1; } }

/* ===== Card ===== */
.template-gallery-item {
    break-inside: avoid;
    margin-bottom: 0.9em;
    position: relative;
    transition: opacity 0.35s ease, transform 0.35s ease;
    opacity: 1;
}
.template-gallery-item.is-hiding {
    opacity: 0;
    transform: scale(0.97);
    pointer-events: none;
}
.template-gallery-item img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}
.template-gallery-item a {
    display: block;
    text-align: center;
}
.template-gallery-item.no-image {
    padding: 15rem 0;
    border-radius: 8px;
    background-color: #f0f0f0;
    margin-bottom: 20px;
}
@media (max-width: 768px) {
    .template-gallery-item.no-image { padding: 5rem 0; }
}

/* ===== Title / Description ===== */
.template-gallery-title {
    font-size: var(--font-size-sm);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80%;
    padding: 5px 0;
}
.template-gallery-title.title-black { color: #0e0e0e; }
.template-gallery-title.title-white { color: #ffffff; }

.template-gallery-description {
    position: absolute;
    font-size: 0.3em;
    font-weight: 400;
    line-height: 1.4em;
    bottom: 11px;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #9b9a9a;
}
.template-gallery-description p {
    color: #9b9a9a;
    font-size: 0.8em;
    font-weight: 400;
    line-height: 1.4em;
    margin: 0;
}

/* ===== Tag box ===== */
.tag-box {
    display: inline-block;
    position: absolute;
    top: 2rem;
    left: 50%;
    transform: translateX(-50%);
    border: 1px solid #333;
    border-radius: 15px;
    cursor: pointer;
    overflow: hidden;
    font-size: 0.3em;
}
@media (max-width: 768px) {
    .tag-box { top: 1rem; font-size: 0.45em; }
}
.tag-text, .view-text {
    display: block;
    padding: 0.4rem 0.8rem;
    text-align: center;
    transition: transform 0.3s ease;
}
.tag-text { transform: translateY(0); }
.view-text {
    transform: translateY(100%);
    position: absolute;
    top: 0; left: 0; right: 0;
    color: #333;
}
.tag-box:hover .tag-text  { transform: translateY(-100%); }
.tag-box:hover .view-text { transform: translateY(0); }

/* ===== Filter buttons ===== */
.list { text-align: center; }

ul.tagging.list.work-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    gap: 10px 8px;
    padding: 0;
    margin: 18px 0 20px;
    list-style: none;
}
ul.tagging.list.work-filters > li {
    display: inline-flex;
    margin: 0;
}
ul.tagging.list.work-filters > li > button.work-filter {
    -webkit-appearance: none;
    appearance: none;
    background: transparent;
    border: 1px solid #141414;
    border-radius: 999px;
    padding: 10px 14px;
    min-height: 36px;
    font: inherit;
    font-size: 15px;
    line-height: 1.2;
    color: #141414;
    -webkit-text-fill-color: #141414;
    cursor: pointer;
    transition: background 0.2s ease, color 0.2s ease;
}
ul.tagging.list.work-filters > li > button.work-filter.is-active {
    background: #141414;
    color: #fff;
    -webkit-text-fill-color: #fff;
}
@media (max-width: 480px) {
    ul.tagging.list.work-filters { margin: 14px 0 18px; gap: 12px 8px; }
    ul.tagging.list.work-filters > li > button.work-filter { font-size: 14px; padding: 9px 12px; }
}

/* ===== SVG cursor ===== */
svg#cursor {
    position: fixed;
    top: 0; left: 0;
    height: 100%; width: 100%;
    z-index: -1;
    transition: top 0.0125s ease-in-out, left 0.0125s ease-in-out, transform 0.3s ease-in-out;
}
</style>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="post page">
        <h2 class="up-on-scroll"><?php the_title(); ?></h2>
        <?php the_content(); ?>
    </article>

    <?php
    $ordered_slugs = ['all', 'strategy', 'branding', 'campaign', 'content', 'design'];
    $terms = get_terms(['taxonomy' => 'work_category', 'hide_empty' => false]);

    if (!is_wp_error($terms) && !empty($terms)) {
        $term_map = [];
        foreach ($terms as $t) $term_map[$t->slug] = $t;

        echo "<ul class='tagging list work-filters'>";
        foreach ($ordered_slugs as $slug) {
            $name = ($slug === 'all') ? 'All' : (isset($term_map[$slug]) ? $term_map[$slug]->name : null);
            if (!$name) continue;
            $is_active = ($slug === 'all') ? ' is-active' : '';
            $pressed   = ($slug === 'all') ? 'true' : 'false';
            echo "<li class='up-on-scroll'>
                    <button type='button' class='work-filter{$is_active}' data-filter='" . esc_attr($slug) . "' aria-pressed='{$pressed}'>{$name}</button>
                  </li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='opacity:.6'>work_category 텀이 없습니다.</p>";
    }
    ?>

    <br>

<?php endwhile; else : ?>
    <p>포스트가 없습니다.</p>
<?php endif; ?>

<?php
$current_page   = get_queried_object();
$subpages_query = new WP_Query([
    'post_type'      => 'page',
    'post_parent'    => $current_page->ID,
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ($subpages_query->have_posts()) :
?>

<div class="template-gallery-grid">
<?php while ($subpages_query->have_posts()) : $subpages_query->the_post();

    $work_terms   = get_the_terms(get_the_ID(), 'work_category');
    $primary_slug = (!is_wp_error($work_terms) && !empty($work_terms)) ? $work_terms[0]->slug : 'uncategorized';

    $title_color         = get_field('title_color');
    $style               = $title_color ? "color: {$title_color}; border-color: {$title_color};" : '';
    $display_the_excerpt = get_field('display_the_excerpt');
    $tag_on_picture      = get_field('tag_on_picture');
    $video_file          = get_field('video_greg');
    $video_ratio         = get_field('video_ratio');

    $is_original = ($video_ratio === 'original');
    $padding_top = '';
    if (!$is_original) {
        if ($video_ratio == '1:1')      $padding_top = '100%';
        elseif ($video_ratio == '4:3')  $padding_top = '75%';
        elseif ($video_ratio == '3:4')  $padding_top = '133.33%';
    }
    $no_media = !has_post_thumbnail() && !$video_file;
?>
    <div
        class="template-gallery-item up-on-scroll <?php echo $no_media ? 'no-image' : ''; ?>"
        data-cat="<?php echo esc_attr($primary_slug); ?>"
        style="<?php echo $no_media ? 'background-color: ' . esc_attr(get_field('background_color')) . ';' : ''; ?>"
    >
        <a href="<?php the_permalink(); ?>">
            <?php if ($video_file) :
                $video_url = $video_file['url'];
                if ($is_original) : ?>
                    <div class="video-container" style="position:relative;overflow:hidden;border-radius:8px;">
                        <video width="100%" height="auto" autoplay loop muted playsinline style="border-radius:8px;">
                            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php else : ?>
                    <div class="video-container" style="position:relative;width:100%;padding-top:<?php echo esc_attr($padding_top); ?>;overflow:hidden;border-radius:8px;">
                        <video style="object-fit:cover;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:100%;height:100%;" autoplay loop muted playsinline>
                            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php endif;
            elseif (has_post_thumbnail()) : ?>
                <div style="border-radius:8px;overflow:hidden;"><?php the_post_thumbnail(); ?></div>
            <?php endif; ?>

            <div class="template-gallery-title <?php echo ($title_color === 'black') ? 'title-black' : 'title-white'; ?>">
                <?php the_title(); ?>
            </div>

            <?php if ($display_the_excerpt === 'on') : ?>
                <div class="template-gallery-description <?php echo $no_media ? 'no-image' : ''; ?>" style="<?php echo esc_attr($style); ?>">
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

    // 태그박스 hover
    document.querySelectorAll('.template-gallery-item').forEach(function (item) {
        var tt = item.querySelector('.tag-text');
        var vt = item.querySelector('.view-text');
        if (!tt || !vt) return;
        item.addEventListener('mouseover', function () { tt.style.transform = 'translateY(-100%)'; vt.style.transform = 'translateY(0)'; });
        item.addEventListener('mouseout',  function () { tt.style.transform = 'translateY(0)'; vt.style.transform = 'translateY(100%)'; });
    });

    // ====== 필터 (fade in/out) ======
    var FADE      = 350;
    var buttons   = document.querySelectorAll('.work-filter');
    var items     = document.querySelectorAll('.template-gallery-item');
    var timer     = null;
    var ready     = false; // 초기 로드는 애니메이션 없이

    function setButtons(filter) {
        buttons.forEach(function (btn) {
            var on = btn.dataset.filter === filter;
            btn.classList.toggle('is-active', on);
            btn.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
    }

    function apply(filter) {
        setButtons(filter);
        if (!ready) return; // 첫 호출은 그냥 반환 (카드는 이미 표시됨)

        clearTimeout(timer);

        // Phase 1: 숨겨야 할 카드 fade out
        items.forEach(function (el) {
            var show = filter === 'all' || el.dataset.cat === filter;
            if (!show && el.style.display !== 'none') {
                el.classList.add('is-hiding');
            }
        });

        // Phase 2: fade out 완료 후 처리
        timer = setTimeout(function () {
            items.forEach(function (el) {
                var show = filter === 'all' || el.dataset.cat === filter;

                if (!show) {
                    // 완전히 숨기기
                    el.style.display = 'none';
                    el.classList.remove('is-hiding');
                } else if (el.style.display === 'none') {
                    // display:none → 보이게 + fade in
                    el.style.display = '';
                    el.classList.add('is-hiding');          // 일단 투명하게
                    requestAnimationFrame(function () {
                        requestAnimationFrame(function () {
                            el.classList.remove('is-hiding'); // 다음 프레임에 transition 발동
                        });
                    });
                } else {
                    // 이미 보이던 카드는 그냥 유지
                    el.classList.remove('is-hiding');
                }
            });
        }, FADE);
    }

    apply('all');
    ready = true; // 이후부터 애니메이션 활성화

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () { apply(btn.dataset.filter); });
    });
});
</script>

<svg id="cursor"></svg>

<?php
    wp_reset_postdata();
endif;

get_footer();
?>
