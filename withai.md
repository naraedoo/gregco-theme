# greg.kr 작업 진행 기록 (with AI)

## SSL 인증서
- Let's Encrypt 수동 발급 완료 (DNS TXT 레코드 방식)
- **중요: RSA 방식으로 발급해야 함** (ECDSA는 카페24 미지원)
- 카페24 외부 SSL 설치 신청 완료 → 최대 3영업일 내 설치
- 만료일: **2026-07-06** (갱신 목표: 2026-06-15 이전)
- 갱신 명령어:
  ```bash
  sudo certbot certonly --manual --preferred-challenges dns \
    --key-type rsa \
    -d greg.kr -d www.greg.kr
  ```
- 갱신 후 카페24 관리자 → 외부 SSL 재등록 필요

---

## Work 페이지 (/work)

### 구조 결정사항
- Work = 포트폴리오 허브 (블로그/뉴스 아님, 신뢰 증명용)
- 모든 Work 항목은 **Page** (Post 아님)
- 카테고리 = taxonomy `work_category` (page에 등록)
- 필터: `/work` 안에서 JS로 show/hide (페이지 이동 없음)
- 필터 선택: **1개만** (라디오 방식)
- URL 이동 없음, 리프레시 없음

### 카테고리 순서
`all → strategy → branding → campaign → content → design`

### 핵심 결정: 하드코딩 금지
- ❌ `$parent_page_id = 564` 같은 ID 하드코딩
- ✅ `get_queried_object()->ID` 로 현재 페이지 기준으로 처리

### 템플릿 파일
`template-checkerboard_video_ratio.php`

### 필터 작동 방식
- 필터 버튼: `<button>` (링크 `<a>` 아님)
- 카드에 `data-cat="strategy"` 같은 속성 부여
- JS로 `opacity` + `transform` inline style 제어 (fade in/out)
- `up-on-scroll` 스크롤 애니메이션과 간섭 방지: inline style로 강제 덮어쓰기

### GitHub
- 저장소: `naraedoo/gregco-theme` (main 브랜치)
- 롤백 방법:
  ```bash
  git checkout <커밋해시> -- template-checkerboard_video_ratio.php
  ```
- 주요 커밋:
  - `949f0fb` — 필터 버튼 + JS 필터 최초 적용
  - `39c360e` — fade in/out 버그 수정
  - `0872f0d` — up-on-scroll 간섭 방지 (inline style 방식)

---

## 다음 작업 후보
- [ ] 필터 fade 애니메이션 최종 확인
- [ ] 개별 Work 페이지 템플릿 설계
- [ ] /insights 또는 /journal (뉴스/블로그) 구조 분리
