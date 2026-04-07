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
- 페이지 ID 하드코딩 금지
- `get_queried_object()->ID` 로 현재 페이지 기준으로 처리

### 템플릿 파일
`template-checkerboard_video_ratio.php`

### 필터 작동 방식
- 필터 버튼: `<button>` (링크 `<a>` 아님)
- 카드에 `data-cat="strategy"` 같은 속성 부여
- JS로 `opacity` + `transform` inline style 제어 (fade in/out) 완료
- `up-on-scroll` 스크롤 애니메이션과 간섭 방지: inline style로 강제 덮어쓰기

### FTP 업로드 주의사항
- VSCode ftp-simple 사용 중
- 파일 수정 후 `Cmd+S` → 자동 업로드
- **로그인 상태에서만 변경사항이 즉시 보임** (캐시 우회)
- JS 파일은 브라우저 캐시 때문에 `Cmd+Shift+R` 강제 새로고침 필요
- 로그아웃 상태에서는 캐싱 플러그인 or 카페24 서버 캐시로 이전 버전이 보일 수 있음

### GitHub
- 저장소: `naraedoo/gregco-theme` (main 브랜치)
- 주요 커밋:
  - `949f0fb` — Work 필터 버튼 + JS 필터 최초 적용
  - `39c360e` — fade in/out 버그 수정
  - `0872f0d` — up-on-scroll 간섭 방지 (inline style 방식)
  - `9f41edf` — withai.md 업데이트

---

## 프론트 페이지 — News 섹션 hover 이미지

### 파일
`js/greg_js.js` (약 547번째 줄)

### 문제 및 해결 과정
1. **z-index 문제**: 이미지가 다른 `.post-row` 아래로 깔림
   - 원인: 이미지가 `.post-row` 내부에 있어서 부모의 stacking context에 갇힘
   - **해결: 이미지를 `document.body`에 직접 append** 완료

2. **이미지 전환 뚝뚝 끊기는 문제**
   - **해결: lerp(선형보간) + opacity fade 추가**
   - `lerpFactor = 0.1` (0.05=느리고 탄성강함, 0.2=빠르고 탄성약함)
   - 이미지 교체 시 opacity 0 → src 교체 → opacity 1 (0.25s ease)

### 현재 구조
- body에 공용 hoverImg 엘리먼트 1개 생성
- lerp 루프로 부드럽게 마우스 추종
- mouseenter: fade out → src 교체 → fade in
- mousemove: mouse 좌표 업데이트
- mouseleave: fade out → display none
- 이미지 크기: `max-width: 320px`
- 위치 오프셋: `left: clientX + 16px`, `top: clientY - 180px`

---

## 다음 작업 후보
- [x] Work 필터 fade 애니메이션 완료
- [x] News hover 이미지 z-index 수정 완료
- [x] News hover 이미지 lerp + fade 전환 완료
- [ ] News hover 이미지 lerp/fade 최종 확인
- [ ] 캐시 플러그인 확인 (로그아웃 상태 즉시 반영)
- [ ] 개별 Work 페이지 템플릿 설계
- [ ] /insights 또는 /journal (뉴스/블로그) 구조 분리
