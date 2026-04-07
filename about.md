# Gregco WordPress Theme — 기술명세서

## 개요

| 항목 | 내용 |
|------|------|
| 테마명 | Gregco copy |
| 플랫폼 | WordPress |
| 제작자 | gregcompany |
| 언어 | PHP, CSS, JavaScript |
| 사이트 | https://greg.kr |
| 레포지토리 | https://github.com/naraedoo/gregco-theme |

Gregco 사이트를 위한 커스텀 WordPress 테마. 체커보드(격자) 갤러리 레이아웃과 다양한 포스트 템플릿을 지원하며, GSAP 기반의 스크롤 애니메이션과 Masonry 레이아웃을 제공합니다.

---

## 디렉토리 구조

```
Gregco copy/
├── style.css                         # 테마 메인 스타일시트
├── functions.php                     # 테마 핵심 기능 정의
├── header.php                        # 공통 헤더
├── footer.php                        # 공통 푸터
├── index.php                         # 블로그 인덱스
├── front-page.php                    # 프론트 페이지 (메인)
├── single.php                        # 단일 포스트
├── page.php                          # 정적 페이지
├── singular.php                      # 단일 포스트/페이지 공통
├── archive.php                       # 아카이브 공통
├── archive-blog.php                  # 블로그 아카이브
├── archive-news.php                  # 뉴스 아카이브
├── category.php                      # 카테고리 공통
├── category-blog.php                 # 블로그 카테고리
├── category-news.php                 # 뉴스 카테고리
├── tag.php                           # 태그 아카이브
├── comments.php                      # 댓글 템플릿
├── about-page.php                    # 어바웃 페이지
├── page-about.php                    # 어바웃 페이지 (슬러그 연동)
├── page-ex-page.php                  # 예시 페이지
├── page-yeojeong.php                 # 여정 페이지
├── template.php                      # 커스텀 기본 템플릿
├── first-template.php                # 첫 번째 커스텀 템플릿
├── first-template-checkerboard.php              # 체커보드 레이아웃
├── first-template-checkerboard_masonry.php      # 체커보드 + Masonry
├── first-template-checkerboard_tag.php          # 체커보드 + 태그
├── first-template-checkerboard _notitle.php     # 체커보드 (제목 없음)
├── first-template-checkerboard _notitle_yj.php  # 체커보드 변형
├── template-checkerboard_video.php              # 체커보드 + 비디오
├── template-checkerboard_video_ratio.php        # 체커보드 + 비디오 비율 고정
├── layout-size1.php                  # 레이아웃 사이즈 1
├── layout-size2.php                  # 레이아웃 사이즈 2
├── layout-size3.php                  # 레이아웃 사이즈 3
├── front-page_linktopage.php         # 프론트 페이지 (페이지 링크형)
├── css/
│   ├── custom.css                    # 공통 커스텀 스타일 (반응형)
│   └── header.css                    # 헤더 전용 스타일
├── js/
│   ├── greg_js.js                    # 메인 JavaScript
│   └── st.js                         # 보조 스크립트
├── fonts/                            # Switzer 폰트 패밀리 (전체 웨이트)
├── np/                               # 프로토타입 / 이펙트 테스트
│   ├── index.html / index2.html / index3.html
│   ├── css/ js/ img/ fonts/
└── del/                              # 삭제 예정 구 버전 파일
```

---

## 기술 스택

### 외부 라이브러리 (CDN)

| 라이브러리 | 버전 | 용도 |
|-----------|------|------|
| GSAP | 3.11.3 | 애니메이션 엔진 |
| GSAP ScrollTrigger | 3.11.3 | 스크롤 기반 애니메이션 |
| Typed.js | 2.0.12 | 타이핑 텍스트 애니메이션 |
| Font Awesome | kit | 아이콘 |
| Masonry.js | 4.2.2 | Pinterest형 격자 레이아웃 |

### 폰트

**Switzer** 폰트 패밀리를 로컬 자체 호스팅으로 사용.

| 웨이트 | 파일 형식 |
|--------|----------|
| Thin / ThinItalic | eot, ttf, woff, woff2 |
| Extralight / ExtralightItalic | eot, ttf, woff, woff2 |
| Light / LightItalic | eot, ttf, woff, woff2 |
| Regular / Italic | eot, ttf, woff, woff2 |
| Medium / MediumItalic | eot, ttf, woff, woff2 |
| Semibold / SemiboldItalic | eot, ttf, woff, woff2 |
| Bold / BoldItalic | eot, ttf, woff, woff2 |
| Extrabold / ExtraboldItalic | eot, ttf, woff, woff2 |
| Black / BlackItalic | eot, ttf, woff, woff2 |
| Variable / VariableItalic | eot, ttf, woff, woff2 |

---

## 주요 기능 (functions.php)

### 에셋 로드

- `style.css` — 메인 스타일, 파일 수정 시각 기반 캐시버스팅
- `css/header.css` — 헤더 전용 CSS
- `css/custom.css` — 공통 커스텀 CSS
- `js/st.js`, `js/greg_js.js` — 페이지 하단에 로드

### 메뉴

- `primary` — 상단 내비게이션
- `footer` — 푸터 내비게이션

### 커스텀 기능

| 기능 | 설명 |
|------|------|
| 포스트 썸네일 | `add_theme_support('post-thumbnails')` |
| 커스텀 로고 | `add_theme_support('custom-logo')` |
| 이미지 사이즈 메타박스 | 포스트별 이미지 사이즈(medium/large) 선택 저장 |
| 댓글 기능 비활성화 | 관리자 바 및 메뉴에서 댓글 항목 제거 |
| 글자 수 제한 요약 | `custom_excerpt_length()` — HTML 제거 후 mb_substr 처리 |
| 페이지 요약글 지원 | `add_post_type_support('page', 'excerpt')` |
| 페이지 태그 지원 | `register_taxonomy_for_object_type('post_tag', 'page')` |
| 태그 정렬 | 태그를 생성 순서(term_id)로 정렬 |
| 요약글 P태그 제거 | `the_excerpt` 필터 — `<a>` 태그만 허용 |

---

## 헤더 구조

```html
<header class="transition">
  <div class='main-tool-bar'>
    <div class="logotitle"> <!-- 사이트명/로고 -->
    <div class="menu-toggle btn"> <!-- 햄버거 메뉴 버튼 -->
    <nav class="menu-wrapper transition noselect"> <!-- 내비게이션 -->
  </div>
</header>
<div class="scrollable-area"></div>
<div class="container_main"> <!-- 콘텐츠 영역 시작 -->
```

---

## CSS 아키텍처

| 파일 | 역할 |
|------|------|
| `style.css` | 테마 등록 정보, 기본 스타일 |
| `css/custom.css` | 레이아웃, 갤러리, 반응형 스타일 (모바일 퍼스트) |
| `css/header.css` | 헤더 전용 스타일 |

- 기본 폰트: `Switzer-Regular`, `helvetica neue`, `Helvetica`, `Arial`
- CSS 변수 활용: `--padding-general`, `--font-size-ty`
- 반응형: 모바일 퍼스트 설계

---

## 프로토타입 (np/ 폴더)

Three.js + GSAP TweenLite 기반의 이미지 호버 이펙트 프로토타입.

| 파일 | 이펙트 |
|------|--------|
| index.html | RGB Shift Effect |
| index2.html | Stretch Effect |
| index3.html | Trails Effect |

관련 JS 모듈: `EffectShell.js`, `RGBShiftEffect.js`, `StretchEffect.js`, `TrailsEffect.js`, `Math.js`

---

## 개발 참고사항

- `del/` 폴더: 과거 버전 파일 보관 (실서버 미적용)
- `*_safe_save_*.php`, `* copy*.php`: 작업 중 백업 스냅샷
- `footer_0817.php`, `index1.php` 등: 날짜/버전 기반 백업 파일
- 코멘트 기능은 완전 비활성화 상태 (관리자 설정 포함)
