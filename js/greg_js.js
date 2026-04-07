gsap.registerPlugin(ScrollTrigger);

// 패널 팝
let uniquePanels = gsap.utils.toArray(".panel");

uniquePanels.pop(); // 마지막 항목 제거
uniquePanels.forEach((panel, i) => {
  let tl = gsap.timeline({
    scrollTrigger: {
      trigger: panel,
      start: "bottom bottom",
      pinSpacing: false,
      pin: true,
      scrub: true,
      onRefresh: () =>
        gsap.set(panel, {
          transformOrigin:
            "center " + (panel.offsetHeight - window.innerHeight / 2) + "px",
        }),
    },
  });

  tl.fromTo(
    panel,
    1,
    {
      y: 0,
      rotate: 0,
      scale: 1,
      opacity: 1,
    },
    {
      y: 0,
      rotateX: 0,
      scale: 0.5,
      opacity: 0.5,
    },
    0
  ).to(panel, 0.1, {
    opacity: 0,
  });
});

// 흘러내리는 메뉴
const toolbarAnim = gsap
  .from(".main-tool-bar", {
    yPercent: -100,
    paused: true,
    duration: 0.2,
  })
  .progress(1);

ScrollTrigger.create({
  start: "top top",
  end: 99999,
  onUpdate: (self) => {
    self.direction === -1 ? toolbarAnim.play() : toolbarAnim.reverse();
  },
});

console.clear();
//위로 올라오는 텍스트 시작
/*
// GSAP와 SplitText를 사용하여 텍스트 요소에 애니메이션 적용하기-로드 후 실행 첫단어 제외 
	let myText = document.getElementById("myText");
	if (myText) {
	let split = new SplitText(myText, { type: "words" });
	let wordsWithoutFirst = split.words.slice(1);

	if (split.words[0].textContent === "") {
		split.words[0].remove();
	}

	gsap.from(wordsWithoutFirst, {
		opacity: 0,
		y: 100,
		stagger: 0.2,
		duration: 0.5,
	});
  };


// GSAP와 SplitText를 사용하여 텍스트 요소에 애니메이션 적용하기-로드 후 실행 첫단어 제외 않음
let myText = document.getElementById("myText");
if (myText) {
    let split = new SplitText(myText, { type: "words" });

    // 모든 단어에 애니메이션 적용
    gsap.from(split.words, {
        opacity: 0,
        y: 100,
        stagger: 0.2,
        duration: 0.5,
    });
}
*/ 
///////페이지 내 요약을을 줄단위로 올라오게 해주는 소스 
let excerpt_greg = document.getElementById("excerpt_greg");
if (excerpt_greg) {
    let split = new SplitText(excerpt_greg, { type: "lines" });

    // 모든 단어에 애니메이션 적용
    gsap.from(split.lines, {
        opacity: 0,
        y: 40,
        stagger: 0.3,
        duration: 0.5,
    });
}
///////페이지 내 요약을을 줄단위로 올라오게 해주는 소스 
let excerpt_greg_single = document.getElementById("excerpt_greg_single");
if (excerpt_greg_single) {
    let split = new SplitText(excerpt_greg_single, { type: "lines" });

    // 모든 단어에 애니메이션 적용
    gsap.from(split.lines, {
        opacity: 0,
        y: 30,
        stagger: 0.85,
        duration: 0.5,
    });
}

//프론트 페이지에서는 올라오는 텍스트 첫단어 제외 나머진 첫단어 포함
document.addEventListener("DOMContentLoaded", function() {
  let myText = document.getElementById("myText");
  if (myText) {
    let split = new SplitText(myText, { type: "words" });

    // 페이지 ID가 813인 경우 첫 단어를 제외하고 애니메이션 적용
    if (document.body.classList.contains('page-id-813')) {
      let wordsWithoutFirst = split.words.slice(1);
    
      if (split.words[0].textContent === "") {
        split.words[0].remove();
      }
    
      gsap.from(wordsWithoutFirst, {
        opacity: 0,
        y: 100,
        stagger: 0.2,
        duration: 1,
      });
    } else {
        // 페이지 ID가 813이 아닌 경우 모든 단어에 애니메이션 적용
        gsap.from(split.words, {
            opacity: 0,
            y: 50,
            stagger: 0.2,
            duration: 1,
        });
    }
  }
});


// 대문 글씨 이동
let items = gsap.utils.toArray(".items"),
  pageWrapper = document.querySelector(".page-wrapper");

items.forEach((container) => {
  let localItems = container.querySelectorAll(".item"),
    distance = () => {
      let lastItemBounds =
          localItems[localItems.length - 1].getBoundingClientRect(),
        containerBounds = container.getBoundingClientRect();
      return Math.max(0, lastItemBounds.right - containerBounds.right);
    };
  gsap.to(container, {
    x: () => -distance(),
    ease: "none",
    scrollTrigger: {
      trigger: container,
      start: "top top",
      pinnedContainer: pageWrapper,
      end: () => "+=" + distance(),
      pin: pageWrapper,
      scrub: true,
      invalidateOnRefresh: true,
    },
  });
});

const items1 = document.querySelectorAll(".item1");

const expand1 = (item1, i1) => {
  let otherItems = Array.from(items1).filter((_, index) => index !== i1);
  gsap.to(otherItems, {
    width: "8vw",
    duration: 2,
    ease: "elastic(1, .6)",
  });
  gsap.to(item1, {
    width: item1.clicked ? "42vw" : "15vw",
    duration: 2.5,
    ease: "elastic(1, .3)",
  });
  item1.clicked = !item1.clicked;
};

items1.forEach((item1, i1) => {
  item1.clicked = false;
  item1.addEventListener("click", () => expand1(item1, i1));
});

// 메뉴 토글
/*function toggleMenu() {
  var menu = document.querySelector(".menu");
  if (menu.classList.contains("active")) {
    menu.classList.remove("active");
    menu.style.display = "none";
  } else {
    menu.classList.add("active");
    menu.style.display = "flex";
  }
}*/
function toggleMenu() {
  const menuWrapper = document.querySelector(".menu-wrapper");
  const menuToggleBtn = document.querySelector(".menu-toggle");

  menuWrapper.classList.toggle("active");

  // 메뉴 버튼의 텍스트 변경
  if (menuWrapper.classList.contains("active")) {
    menuToggleBtn.textContent = "Close";
  } else {
    menuToggleBtn.textContent = "Menu";
  }
}


// 흐르는 뉴스 시작 

/// 메인 페이지 프로젝트 자동 스크롤 관련 변수
const card = document.querySelector('.gallery-grid');
const boxes = card.querySelectorAll('.gallery-item');
const scrollSpeed = 1; // 스크롤 속도 (수치를 조절하세요)
let scrollPosition = 0;
let scrollInterval;

// 각 항목의 복사본 만들기
boxes.forEach(box => {
    const clone = box.cloneNode(true);
    card.appendChild(clone);
});

// 자동 스크롤 함수
function autoScroll() {
    scrollPosition += scrollSpeed;
    card.scrollLeft = scrollPosition;

    // 스크롤이 끝에 도달하면 스크롤 위치를 처음으로 되돌림
    if (scrollPosition >= card.scrollWidth / 2) {
        scrollPosition = 0;
    }
}

// 마우스 오버 시 자동 스크롤 중지
card.addEventListener('mouseenter', () => {
    clearInterval(scrollInterval);
});

// 마우스 아웃 시 자동 스크롤 재개
card.addEventListener('mouseleave', () => {
    scrollInterval = setInterval(autoScroll, 20);
});

// 마우스 휠 이벤트: 페이지 세로 스크롤 허용 (preventDefault 제거)
// 가로 스크롤은 자동 + 마우스오버 멈춤으로만 제어
card.addEventListener('wheel', (event) => {
    // deltaX(트랙패드 가로 스와이프)만 가로 스크롤에 반영
    if (Math.abs(event.deltaX) > Math.abs(event.deltaY)) {
        scrollPosition += event.deltaX * 0.5;
        card.scrollLeft = scrollPosition;
        event.preventDefault();
    }
    // 세로 스크롤(deltaY)은 막지 않음 → 페이지 아래로 자연스럽게 이동
}, { passive: false });

// 모바일 터치 이벤트 처리
let touchStartX = 0;
let touchEndX = 0;
let touchDelta = 0;

card.addEventListener('touchstart', (e) => {
    touchStartX = e.touches[0].clientX;
    clearInterval(scrollInterval);
}, false);

card.addEventListener('touchmove', (e) => {
    touchEndX = e.touches[0].clientX;
    touchDelta = touchStartX - touchEndX;
    scrollPosition += touchDelta;
    card.scrollLeft = scrollPosition;
    touchStartX = touchEndX; // 터치 이동 중 위치 업데이트
}, false);

card.addEventListener('touchend', () => {
    if (scrollPosition >= card.scrollWidth / 2) {
        scrollPosition = 0; // 루프 조건
    }
    scrollInterval = setInterval(autoScroll, 20);
}, false);

// 자동 스크롤 인터벌 설정
scrollInterval = setInterval(autoScroll, 20);

////////////////////////////////////////////////////////////////////////////////////자동 스크롤 시작 군중 움직임

console.clear()
console.log('')

const config = {
  src: '/test/open-peeps-sheet-1.png',
  rows: 15,
  cols: 7
}

// UTILS

const randomRange = (min, max) => min + Math.random() * (max - min)

const randomIndex = (array) => randomRange(0, array.length) | 0

const removeFromArray = (array, i) => array.splice(i, 1)[0]

const removeItemFromArray = (array, item) => removeFromArray(array, array.indexOf(item))

const removeRandomFromArray = (array) => removeFromArray(array, randomIndex(array))

const getRandomFromArray = (array) => (
  array[randomIndex(array) | 0]
)

// TWEEN FACTORIES

const resetPeep = ({ stage, peep }) => {
  const direction = Math.random() > 0.5 ? 1 : -1
  // using an ease function to skew random to lower values to help hide that peeps have no legs
  const offsetY = 100 - 250 * gsap.parseEase('power2.in')(Math.random())
  const startY = stage.height - peep.height + offsetY
  let startX
  let endX
  
  if (direction === 1) {
    startX = -peep.width
    endX = stage.width
    peep.scaleX = 1
  } else {
    startX = stage.width + peep.width
    endX = 0
    peep.scaleX = -1
  }
  
  peep.x = startX
  peep.y = startY
  peep.anchorY = startY
  
  return {
    startX,
    startY,
    endX
  }
}

const normalWalk = ({ peep, props }) => {
  const {
    startX,
    startY,
    endX
  } = props

  const xDuration = 10
  const yDuration = 0.25
  
  const tl = gsap.timeline()
  tl.timeScale(randomRange(0.5, 1.5))
  tl.to(peep, {
    duration: xDuration,
    x: endX,
    ease: 'none'
  }, 0)
  tl.to(peep, {
    duration: yDuration,
    repeat: xDuration / yDuration,
    yoyo: true,
    y: startY - 10
  }, 0)
    
  return tl
}

const walks = [
  normalWalk,
]

// CLASSES

class Peep {
  constructor({
    image,
    rect,
  }) {
    this.image = image
    this.setRect(rect)
    
    this.x = 0
    this.y = 0
    this.anchorY = 0
    this.scaleX = 1
    this.walk = null
  }
  
  setRect (rect) {
    this.rect = rect
    this.width = rect[2]
    this.height = rect[3]
    
    this.drawArgs = [
      this.image,
      ...rect,
      0, 0, this.width, this.height
    ]  
  }
  
  render (ctx) {
    ctx.save()
    ctx.translate(this.x, this.y)
    ctx.scale(this.scaleX, 1)
    ctx.drawImage(...this.drawArgs)
    ctx.restore()
  }
}

// MAIN 움직이는 사람들

const img = document.createElement('img')
img.onload = init
img.src = config.src

const canvas = document.querySelector('#canvas')
const ctx = canvas.getContext('2d')

const stage = {
  width: 0,
  height: 0,
}

const allPeeps = []
const availablePeeps = []
const crowd = []

function init () {  
  createPeeps()
  
  // resize also (re)populates the stage
  resize()

  gsap.ticker.add(render)
  window.addEventListener('resize', resize)
}

function createPeeps () {
  const {
    rows,
    cols
  } = config
  const {
    naturalWidth: width,
    naturalHeight: height
  } = img
  const total = rows * cols
  const rectWidth = width / rows
  const rectHeight = height / cols
  
  for (let i = 0; i < total; i++) {
    allPeeps.push(new Peep({
      image: img,
      rect: [
        (i % rows) * rectWidth,
        (i / rows | 0) * rectHeight,
        rectWidth,
        rectHeight,
      ]
    }))
  }  
}

function resize () {
  stage.width = canvas.clientWidth
  stage.height = canvas.clientHeight
  canvas.width = stage.width * devicePixelRatio
  canvas.height = stage.height * devicePixelRatio
  
  crowd.forEach((peep) => {
    peep.walk.kill()
  })
  
  crowd.length = 0
  availablePeeps.length = 0
  availablePeeps.push(...allPeeps)
  
  initCrowd()
}

function initCrowd () {
  while (availablePeeps.length) {
    // setting random tween progress spreads the peeps out
    addPeepToCrowd().walk.progress(Math.random())
  }
}

function addPeepToCrowd () {
  const peep = removeRandomFromArray(availablePeeps)
  const walk = getRandomFromArray(walks)({
    peep,
    props: resetPeep({
      peep,
      stage,
    })
  }).eventCallback('onComplete', () => {
    removePeepFromCrowd(peep)
    addPeepToCrowd()
  })
  
  peep.walk = walk
  
  crowd.push(peep)
  crowd.sort((a, b) => a.anchorY - b.anchorY)
  
  return peep
}

function removePeepFromCrowd (peep) {
  removeItemFromArray(crowd, peep)
  availablePeeps.push(peep)
}

function render () {
  canvas.width = canvas.width
  ctx.save()
  ctx.scale(devicePixelRatio, devicePixelRatio)
  
  crowd.forEach((peep) => {
    peep.render(ctx)
  })
  
  ctx.restore()
}
////////////////////////////////////////////////////////////////////////////////////자동 스크롤 시작 군중 움직임 끝

/////흐르는 프로젝트 이미지
var hoverImg = document.createElement('img');
hoverImg.style.cssText = [
  'position: fixed',
  'top: 0',
  'left: 0',
  'z-index: 9999',
  'pointer-events: none',
  'display: none',
  'max-width: 320px',
  'height: auto',
  'border-radius: 4px',
  'opacity: 0',
  'transition: opacity 0.25s ease'
].join(';');
document.body.appendChild(hoverImg);

// lerp 추종 변수
var mouse  = { x: 0, y: 0 };
var target = { x: 0, y: 0 };
var isHovering = false;
var lerpFactor = 0.1; // 0.05(느림/탄성강함) ~ 0.2(빠름/탄성약함)

// lerp 루프
function lerpLoop() {
  target.x += (mouse.x - target.x) * lerpFactor;
  target.y += (mouse.y - target.y) * lerpFactor;
  hoverImg.style.left = (target.x + 16)  + 'px';
  hoverImg.style.top  = (target.y - 180) + 'px';
  requestAnimationFrame(lerpLoop);
}
lerpLoop();

document.querySelectorAll('.post-content').forEach(function(post) {
  var imaDiv = post.nextElementSibling;
  if (!imaDiv) return;
  var srcImg = imaDiv.querySelector('img');
  if (!srcImg) return;

  imaDiv.style.display = 'none';

  post.addEventListener('mouseenter', function() {
    // 이미지 전환: 살짝 fade out → src 교체 → fade in
    hoverImg.style.opacity = '0';
    setTimeout(function() {
      hoverImg.src = srcImg.src;
      hoverImg.alt = srcImg.alt;
      hoverImg.style.display = 'block';
      setTimeout(function() {
        hoverImg.style.opacity = '1';
      }, 30);
    }, 150);
    isHovering = true;
  });

  post.addEventListener('mousemove', function(event) {
    mouse.x = event.clientX;
    mouse.y = event.clientY;
  });

  post.addEventListener('mouseleave', function() {
    hoverImg.style.opacity = '0';
    setTimeout(function() {
      if (!isHovering) hoverImg.style.display = 'none';
    }, 260);
    isHovering = false;
  });
});


/////흐르는 뉴스 이미지 끝
/////////////스크롤 이벤트 

var copy = document.querySelector(".logos-slide").cloneNode(true);
document.querySelector(".logo-slider").appendChild(copy);



/////////line_greg 레이지 로딩////////
document.addEventListener("DOMContentLoaded", function() {
  const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-line_greg');
      }
    });
  }, { threshold: 0.1 });

  // 모든 .line_greg 요소를 선택하고 각각을 observer에 등록
  const lines = document.querySelectorAll('.line_greg');
  lines.forEach(line => observer.observe(line));
});

