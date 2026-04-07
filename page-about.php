<?php
/*
Template Name: about Page
*/
 get_header(); ?>
<?php
$author_id = get_the_author_meta('ID'); // 현재 포스트의 저자 ID를 가져옴
$author_name = get_the_author_meta('display_name', $author_id); // 저자의 표시 이름을 가져옴
$author_description = get_the_author_meta('description', $author_id); // 저자의 간단한 설명을 가져옴
// 현재 작성자 정보 가져오기
$author_id = get_query_var('author');
$author = get_userdata($author_id);

// 작성자의 메타 디스크립션 가져오기
$author_description = get_the_author_meta('description', $author_id);
$admin_user = get_user_by('login', 'gregcompany'); // 'admin'은 관리자의 로그인 아이디입니다.
$admin_nickname = $admin_user->nickname;
$site_tagline = get_bloginfo('description'); // 태그 라인 가져오기
?>

<style>
    .gallery-grid{
  margin-top: 1em;
}
  .post-content:last-child {
    border-bottom: none; /* 마지막 요소에는 테두리 없음 */
}
.gallery-item img {
    width: 100%;
	max-width: 600px;
	min-width: 450px;
    /* 초기 높이는 0으로 설정 */
    /* 패딩을 사용하여 가로 크기와 같은 비율의 높이를 생성 */
    object-fit: cover;     /* 이미지가 박스 내부를 채우도록 설정, 필요한 경우 이미지가 잘릴 수 있음 */
    display:  inline-block;
	flex-direction: column;
	height: auto;       /* 이미지의 높이를 자동으로 설정 */
    object-fit: cover; 
	border: 0px solid #161515;
	display: inline-block;
}

.gallery-item.no-image {
    width: 100%;
    max-width: 600px;
    min-width: 450px;
    height: 500px;
    background-color: #f0f0f0; /* 기본 배경색 설정, 필요에 따라 변경 가능 */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.gallery-item.no-image .gallery-title,
.gallery-item.no-image .gallery-description {
    padding: 10px;
}

/* 이미지가 없을 때의 기본 텍스트 스타일 */
.gallery-item.no-image p {
    margin-top: 3em;
    margin-left: 2em;
    margin-right: 2em;
}

@media screen and (max-width: 600px) {
        .gallery-item img{
        max-width: 600px;
        min-width: 300px;
        }
        .gallery-item.no-image {
        max-width: 600px;
        min-width: 300px;
        }
}

.news-excerpt a{
    font-size: var(--font-size-ty);
    line-height: 1.1;
}
.spacer p{
    line-height: 1.2;
}
/*스크롤 시작*/
.scroll {
    margin: 0 auto;
	width: 60px;
	height: 60px;
	border: 2px solid #333;
	border-radius: 50%;
	position: relative;
	animation: down 1.5s infinite;
    cursor: pointer; /* 클릭 가능한 커서 설정 */
	-webkit-animation: down 1.5s infinite;
	&::before {
		content: '';
		position: absolute;
		top: 15px;
		left: 18px;
		width: 18px;
		height: 18px;
		border-left: 2px solid #333;
  	border-bottom: 2px solid #333;
		transform: rotate(-45deg);
	}
}

@keyframes down {
	0% {
		transform: translate(0);
	}
	20% {
		transform: translateY(15px);
	}
	40% {
		transform: translate(0);
	}
}

@-webkit-keyframes down {
	0% {
		transform: translate(0);
	}
	20% {
		transform: translateY(15px);
	}
	40% {
		transform: translate(0);
	}
}

.arrow {
	width: 0;
	height: 40px;
	border: 1px solid #333;
	position: relative;
	animation: scroll 1.5s infinite;
	-webkit-animation: scroll 1.5s infinite;
	&::after {
		content: '';
    display: block;
    position: absolute;
    top: 100%;
    left: -5px;
    width: 1px;
    height: 10px;
		
		// triangle
    border-top: 10px solid #333;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
	}
}

@keyframes scroll {
	0% {
		height: 40px;
	}
	30% {
		height: 70px;
	}
	60% {
		height: 40px;
	}
}

@-webkit-keyframes scroll {
	0% {
		height: 40px;
	}
	30% {
		height: 70px;
	}
	60% {
		height: 40px;
	}
}
/*스크롤 끝*/
.sub_title{
    margin-bottom: 15px;
}
.subscript {
	vertical-align: text-top;
	font-size: calc(0.2rem + 1vw);
}

</style>
  
<body <?php body_class(); ?>>

  <h1 class="site-tagline title">
    <p id="myText" class="sp_text"> <?php echo $site_tagline; ?> </p>
  </h1>
  <div class="spacer" style="height:110px;"></div>
  <div class="up-on-scroll">
  <a href="#target">
        <div class="scroll" id="scrollButton"></div>
    </a>
  </div>



<div class="line_greg"></div>
  <aside  id="target" class="subtitle">
      <h2 class="title left up-on-scroll"> Projects</h2>
    <a href="/work/" class="view-more up-on-scroll">View more</a>
  </aside>
        <?php
        // 특정 아이디(예: 204)에 해당하는 페이지를 가져옵니다.
        $page_id = 564;
        $page = get_post($page_id);

        // 페이지가 존재하는지 확인합니다.
        if ($page) {
            // 특정 페이지(예: 204)의 모든 하위 페이지를 가져옵니다.
            $child_pages = get_pages(array(
                'child_of' => $page->ID,
                'sort_column' => 'menu_order',
            ));

            if (!empty($child_pages)) {
                // 현재 페이지 데이터를 백업합니다.
                $backup_post = $post;

                ?>

<div class="gallery-grid box up-on-scroll">
    <?php
    foreach ($child_pages as $child_page) {
        // 하위 페이지 데이터를 설정합니다.
        $post = $child_page;
        setup_postdata($post);

        // ACF에서 background_color 필드의 값을 가져옵니다.
        $background_color = get_field('background_color');
        
        ?>     
     
        <div class="gallery-item <?php if (!has_post_thumbnail()) : ?>no-image<?php endif; ?>" style="<?php if (!has_post_thumbnail() && $background_color) : ?>background-color:<?php the_field('background_color'); ?>;<?php endif; ?>">
            <a href="/work/"><!--?/*php the_permalink(); /*?>"링크를 리스트로 보냄-->
                <?php
                if (has_post_thumbnail()) :
                    the_post_thumbnail();
                endif;
                ?>
                <div class="gallery-title"><?php the_title(); ?></div>
                <div class="gallery-description"><p><?php echo custom_excerpt_length_by_char(get_the_excerpt(), 70); // 100글자로 제한?></p></div>
            </a>
        </div>

        <?php
    }

    // 이전에 백업한 현재 페이지 데이터를 복원합니다.
    $post = $backup_post;
    wp_reset_postdata(); // 이전 페이지 데이터로 되돌립니다.
    ?>
</div> <!-- .gallery-grid -->


        <?php
    } else {
        echo '하위 페이지가 없습니다.';
    }
} else {
    echo '페이지를 찾을 수 없습니다.';
}
?>
  <div class="spacer up-on-scroll" style="height:auto;"><h2 class="sub_title">우리의 퍼포먼스 마케팅은 전환에 몰두합니다</h2> <p>관용적으로<span class="subscript">관용적</span> 적어둔 에이전시 <sub>소개에</sub> 현혹되지 마세요. 퍼포먼스 마케팅, 브랜딩, 콘텐츠의 목표와 성과는 모두 다르게 별도로 측정해야 합니다. 우리는 퍼포먼스 마케팅의 가치는 전환이라고 단언합니다. 이를 위해 브랜딩과 콘텐츠를 더욱 날카롭게 다듬어 전달합니다. 둘을 혼용해 혼동을 주지 않습니다. 우리는 명확한 목표와 검증 가능한 성과로 브랜드를 성장시킵니다. 광고 성과가 좋아졌다는 말로 설득거나 합리화 하지 않습니다. 광고 성과는 과정일뿐, 우리는 매출 성장을 통해 증명합니다. </p></div>
  <div class="line_greg"></div>
  <aside class="subtitle">
       <h2 class="title left up-on-scroll">Our Roles</h2>
    <a href="/" class="view-more up-on-scroll">View more </a>
  </aside>
  <div style="height:auto;">
  <div class="flex">
		<div class="box1 up-on-scroll">SHARPEN YOUR<br>COMMUNICATION<br>STRATEGY</div>
		<div class="box2 up-on-scroll">Boost your digital strategy & CRM<br>Establish your communication
			plan<br>Optimize your budget Organize your deployment</div>
	</div>

	<div class="flex">
		<div class="box1 up-on-scroll">CREATE / MAKE
			<br>YOUR BRAND STRONG
		</div>
		<div class="box2 up-on-scroll">Redesign your brand platform Imagine your graphic and visual identities<br>Create
			your brand storytelling
		</div>
	</div>
	<div class="flex">
		<div class="box1 up-on-scroll">PRODUCE CONTENT</div>
		<div class="box2 up-on-scroll">Design / writing<br>Photographic content<br>Video productions</div>
	</div>
	<div class="flex">
		<div class="box1 up-on-scroll">LAUNCH A SLAMMING<br>COM CAMPAIGN</div>
		<div class="box2 up-on-scroll">Establish your communication strategy<br>Find the creative concept<br>Produce and
			deploy the campaign</div>
	</div>
</div>
<div class="line_greg"></div>
  <aside class="subtitle">
    <h2 class="title left up-on-scroll "> News </h2>
    <a href="/category/news/" class="view-more up-on-scroll">View more </a>
  </aside>


<div class='post-container'> 
<?php
// 최신 포스트 4개를 가져오는 쿼리
$args = array(
    'posts_per_page' => 4, // 포스트 개수
    'orderby' => 'date', // 날짜 기준으로 정렬
    'order' => 'DESC', // 최신순으로 정렬
    'post_type' => 'post', // 페이지를 제외한 글만 가져옴
    /*'category_name' => 'news' // 'news' 카테고리의 글만 가져옴*/
);

// 쿼리 실행
$the_query = new WP_Query($args);

// 쿼리 결과가 있으면 반복
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();

  // 마지막 포스트인지 확인
        $is_last_post = ($the_query->current_post + 1) == $the_query->post_count;

        // 제목, 날짜, 태그, 요약글, 이미지, 링크 추출
        $title = get_the_title(); // 제목
        $date = get_the_date(); // 날짜
        $tags = get_the_tag_list('<ul class="tagging"><li>', '</li><li>', '</li></ul>'); // 태그 리스트
        $excerpt = get_the_excerpt(); // 요약글
        $image = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 특성화 이미지 URL
        $link = get_permalink(); // 포스트 링크

        // 출력
       echo "<div class='post-content up-on-scroll" . ($is_last_post ? " last-post" : "") . "'>";

        echo "<h2 class='news-title'><a href='$link'>$title</a></h2>";
        echo "<p class='news-date'>$date</p>";
        echo $tags;
        echo "<p class='news-excerpt'><a href='$link'>$excerpt</a></p>";
        echo "</div>";
        if ($image) {
            echo "<div class='ima'><img src='$image' alt='$title' class='featured-image' style='display: none;'>";
        }
        echo "</div>";
     
    }
    wp_reset_postdata();
} else {
    // 포스트가 없을 경우
    echo "<p>새로운 포스트가 없습니다.</p>";
}
?>
</div>


<div class="line_greg"></div>
<!--
<aside class="subtitle">
     <h2 class="title left up-on-scroll"> Clients </h2>
    <a href="/clients-2" class="view-more up-on-scroll">View more</a>
</aside> -->
<!--클라이언트 배너-->
<!-- <div class="logo-slider up-on-scroll" data-v-4ef8651c="">
  <div class="logos-slide up-on-scroll" data-v-4ef8651c="">
    <?php /*
    // "clients-2" 페이지의 ID를 지정합니다.
    $parent_id = 388; // "clients-2" 페이지의 실제 ID로 변경하세요.

    // 하위 페이지들을 가져오는 쿼리를 설정합니다.
    $args = array(
        'post_type'      => 'page', // 페이지 타입
        'posts_per_page' => -1,     // 모든 하위 페이지
        'post_parent'    => $parent_id, // "clients-2" 페이지의 하위 페이지
        'orderby'        => 'menu_order', // 메뉴 순서대로 정렬
        'order'          => 'ASC'        // 오름차순 정렬
    );

    // 쿼리 실행
    $child_query = new WP_Query($args);

    // 쿼리 결과가 있으면 반복
    if ($child_query->have_posts()) {
        while ($child_query->have_posts()) {
            $child_query->the_post();

            // 각 하위 페이지의 특성 이미지 URL을 가져옵니다.
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

            // 이미지 URL이 있으면 이미지 태그를 출력합니다.
            if ($img_url) {
                echo "<img src='" . esc_url($img_url) . "' alt='" . get_the_title() . "' data-v-4ef8651c=''>";
            }
        }
        wp_reset_postdata();
    }
   */ ?>
  </div>
</div>-->
 <canvas id="canvas" style="width: 100%;
  height: 600px;"></canvas>

<!--마우스 오버시 이미지 나옴-->
<!-- 클릭하면 부드럽게 스크롤-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var scrollLink = document.querySelector('a[href="#target"]');
        if (scrollLink) {
            scrollLink.addEventListener('click', function(e) {
                e.preventDefault();
                var targetElement = document.querySelector('#target');
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        }
    });
</script>

  <?php get_footer(); ?>
