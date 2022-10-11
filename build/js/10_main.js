gsap.registerPlugin(ScrollTrigger);

/**
 * Scrolls Cheker
 */
function scrollBarWidth(){
  let sw = window.innerWidth - document.getElementsByTagName('html')[0].clientWidth;
  window.addEventListener('resize', function(){
    sw = window.innerWidth - document.getElementsByTagName('html')[0].clientWidth;
  })
  return sw;
};	

/**
 * Cursor
 */
/*
document.head.insertAdjacentHTML("beforeend", `<style> 
 @media screen and (min-width: 1024px) {
   body {cursor: none;} 
   *:hover, 
   *:link  {cursor: none;} 
   #cursor {display: block;} 
 }
</style>`);
*/

function cursorReset(){
  const cursor = document.getElementById('cursor');
  cursor.classList.remove('click');
  cursor.classList.remove('hover');
}

function cursorAnimated(){
  const body = document.getElementsByTagName('body')[0];
  const sections = document.querySelectorAll('.section-layout, .site-footer');
  const sectionsLength = sections.length;

  const cursor = document.getElementById('cursor');
  const cursorDataOnbg = cursor.dataset.onbg;
  const moveCursor = (e)=> {
  const mouseY = e.clientY;
  const mouseX = e.clientX; 
  cursor.classList.add('move');
  cursor.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0)`;
  }

  window.addEventListener('mousemove', moveCursor);
  window.addEventListener('mousedown', function(){
    cursor.classList.add('click');
  });
  window.addEventListener('mouseup', function(){
    cursor.classList.remove('click');
  });

  function cursorDefaultData(){
  if (body.classList.contains('site-bg-dark')){
    cursor.dataset.onbg = 'bg-dark';
  } else {
    cursor.dataset.onbg = 'bg-white';
  }
  }

  cursorDefaultData();

  for (let i = 0; i < sectionsLength; i++){
  let section = sections[i];
  let onbg = section.dataset.onbg;

  section.addEventListener('mouseenter', function(){
    if (onbg){
      cursor.dataset.onbg = onbg;
    } else {
      cursorDefaultData();
    }
  });
  }

  const links = document.querySelectorAll('a, .active-element, .button-element');
  Array.from(links).forEach(item => {
  item.addEventListener('mouseover', () => {
    cursor.classList.add('hover');
  });
  item.addEventListener('mouseleave', () => {
    cursor.classList.remove('hover');
  });
  });
}

/**
 * Navigation
 */
function navigation(){
  const body = document.getElementsByTagName('body')[0];
  const logo = document.getElementById('logo');
  const logoText = document.getElementById('logo-text');
  const mainMenu = document.getElementById('main-menu');
  const sections = document.querySelectorAll('.section-layout, .site-footer, .global-hero');
  const sectionsLength = sections.length;
  const heroActions = document.getElementById('hero-actions');
  const siteHeader = document.getElementById('site-header');

  let bodyOnBg = 'bg-white';
  if (body.classList.contains('site-bg-dark')){
    bodyOnBg = 'bg-dark';
  }

  window.addEventListener('scroll', function(){

    let st = window.scrollY || document.documentElement.scrollTop
    if (st > 0){
      logoText.classList.add('logo-text-hide');
      mainMenu.classList.add('main-menu-hide');
    } else {
      logoText.classList.remove('logo-text-hide');
      mainMenu.classList.remove('main-menu-hide');
    }

    let logoTop = logo.getBoundingClientRect().top;
    let logoBottom = logo.getBoundingClientRect().bottom;

    for (let i = 0; i < sectionsLength; i++){
      let section = sections[i];
      let sectionTop = section.getBoundingClientRect().top;
      let sectionBottom = section.getBoundingClientRect().bottom;
      let onbg = section.dataset.onbg;
      
      if (heroActions){
        let heroActionsTop = heroActions.getBoundingClientRect().top;
        let heroActionsBottom = heroActions.getBoundingClientRect().bottom;

        if (heroActionsTop >= sectionTop){
          if (onbg){
            if (onbg === 'bg-white'){
              heroActions.querySelector('.button').classList.add('button-dark');
            }
            if (onbg === 'bg-dark'){
              heroActions.querySelector('.button').classList.remove('button-dark');
            }
          } else {
            heroActions.querySelector('.button').classList.remove('button-dark');
          }
        }
      }

      if (logoBottom >= sectionTop){
        if (onbg){
          if (onbg === 'bg-white'){
            siteHeader.setAttribute('data-onbg', onbg);
          } else if (onbg === 'bg-dark'){
            siteHeader.setAttribute('data-onbg', onbg);
          }
        } else {
          siteHeader.setAttribute('data-onbg', bodyOnBg);
        }
      }

    }

  });
};

/**
 * Logos
 */
function logos(){
  gsap.utils.toArray('.logos-slider-inner').forEach(function(elem){
    if (elem){
      let dataWidth = elem.dataset.width;
      let dataWidthHalf = elem.dataset.widthHalf;

      let durationTime = 90;

      let logosTL = gsap.timeline({
        paused: true,
        reversed: true,
        repeat: -1, 
        repeatDelay: 0,
      });

      if (elem.classList.contains('ltr')){
        logosTL.to(elem, {x: -dataWidthHalf, duration: durationTime, ease: "linear"})
        logosTL.to(elem, {x: 0, duration: durationTime, ease: "linear"})
      } else {
        logosTL.to(elem, {x: dataWidthHalf, duration: durationTime, ease: "linear"})
        logosTL.to(elem, {x: 0, duration: durationTime, ease: "linear"})
      }

      logosTL.play();
    }
  });
}

/**
 * Swiper
 */
function swipers(){

  const swiperCards = new Swiper('.swiper-cards', {
    direction: 'horizontal',
    slidesPerView: 'auto',
    //enabled: false,
    scrollbar: {
      el: '.swiper-scrollbar-cards',
    },
  });

  const swiperPosts = new Swiper('.swiper-blog-posts', {
    direction: 'horizontal',
    slidesPerView: 'auto',
    enabled: false,
    scrollbar: {
      el: '.swiper-scrollbar-blog-posts',
    },
  });

  const featuredProjects = new Swiper('.swiper-featured-projects', {
    direction: 'horizontal',
    slidesPerView: 'auto',
    enabled: false,
    scrollbar: {
      el: '.swiper-scrollbar-featured-project',
    },
  });

  function initSwipers(){

    if (window.matchMedia("(max-width: 1024px)").matches) {

      featuredProjects.enable();
      swiperPosts.enable();

    } else {

      featuredProjects.slideTo('0');
      featuredProjects.disable();

      swiperPosts.slideTo('0');
      swiperPosts.disable();

    }
  }

  initSwipers();
  window.addEventListener('resize', function(){
    initSwipers();
  });
};

/**
 * Isotope Filter
 */
function isotopeFilter(){
  const worksFilter = document.getElementById('works-filter');
  const worksGrid = document.getElementById('works-grid');

  if (worksGrid){

    const isotopeGrid = new Isotope( worksGrid , {
      itemSelector: '.works-loop-item',
      layoutMode: 'fitRows',
    });

    const filterButtons = worksFilter.querySelectorAll('.works-filter-button');

    function clearButtons(){
      for(let i = 0; i < filterButtons.length; i++){
        filterButtons[i].classList.remove('works-filter-button-active');
      }
    }

    for(let i = 0; i < filterButtons.length; i++){
      filterButtons[i].addEventListener('click', function(){
        let filterValue = this.getAttribute('data-filter');
        clearButtons();
        this.classList.add('works-filter-button-active');
        isotopeGrid.arrange({ filter: filterValue });
      })
    }
  }
}


/**
 * Menu
 */
function headerTlClose(){
  const headerMenu = document.getElementById('header-menu');
  headerMenu.classList.remove('header-menu-active');
}
function headerLayout(){
  const headerMenuLayout = document.getElementById('header-menu-layout');
  headerMenuLayout.classList.add('active');
}

function menuOpen(){
  const menuToggleButton = document.getElementById('menu-toggle-button');
  const body = document.getElementsByTagName('body')[0];
  const headerMenu = document.getElementById('header-menu');

  const headerTL = gsap.timeline({
    paused: true, 
    defaults: {
      stagger: 0.07,
      ease: "none",
    },
  });

  menuToggleButton.addEventListener('click', function(){
    body.style.overflow = 'hidden';
    headerMenu.classList.add('header-menu-active');

    headerTL.to(headerMenu,
      {
        autoAlpha: 1,
        duration: 0.25, 
        //ease: "Expo.out",
      },
      //'-=0.5',
    );
    headerTL.fromTo('.header-block-appear', 
      {opacity: 0, y: '20'}, 
      {
        y: '0', 
        opacity: 1, 
        duration: 0.4, 
        ease: "Expo.out",
        onComplete: headerLayout,
      }
    );
    headerTL.play();
  });

}
function menuClose(){
  const headerMenuCloseButton = document.getElementById('header-menu-close-button');
  const headerMenu = document.getElementById('header-menu');
  const body = document.getElementsByTagName('body')[0];

  headerMenuCloseButton.addEventListener('click', function(){

    body.style.overflow = 'auto';

    const headerMenuLayout = document.getElementById('header-menu-layout');
    headerMenuLayout.classList.remove('active');

    const headerTL = gsap.timeline({
      paused: true, 
      defaults: {
        stagger: 0.07,
        ease: "none",
      },
    });

    headerTL.fromTo('.header-block-appear', 
      {opacity: 1, y: '0'}, 
      {
        y: '20', 
        opacity: 0, 
        duration: 0.25, 
        ease: "Expo.out",
        overwrite: true, 
        stagger: 0.02,
      }
    );
    headerTL.to(headerMenu,
      {
        autoAlpha: 0,
        duration: 0.4, 
        //ease: "Expo.out",
        onComplete: headerTlClose
      },
      //'-=0.5',
    );
    headerTL.play();
  });
}

/**
 * Hero Appear
 */
function heroAppear(){
  gsap.set('.global-hero-content-item, .hero-text', {
    //opacity: 0,
  });
  const transitionTL = gsap.timeline({
    paused: true, 
    defaults: {
      stagger: 0.1
    },
  });
  transitionTL.to('.global-hero-content-item, .hero-text', {opacity: 0, y: '40'}, '-=0.1');
  transitionTL.to('.global-hero-content-item, .hero-text', {y: '0', opacity: 1}, '-=0.3');
  transitionTL.to('.site-header', {opacity: 1, duration: 0.2}, '-=0.5');
  transitionTL.play();
}

/**
 * Services Cards
 */
function servicesCards(){
  let cards = document.querySelectorAll('.services-cards-loop-item');
  if (cards.length > 0){
    gsap.defaults({ease: "power4"});
    gsap.set(".services-cards-loop-item", {y: 32});
    ScrollTrigger.batch(".services-cards-loop-item", {
      onEnter: batch => gsap.to(batch, {duration: 1, opacity: 1, y: 0, stagger: 0.15, overwrite: true}),
      onLeave: batch => gsap.set(batch, {duration: 1, opacity: 0, y: -32, overwrite: true}),
      onEnterBack: batch => gsap.to(batch, {duration: 1, opacity: 1, y: 0, stagger: 0.15, overwrite: true}),
      onLeaveBack: batch => gsap.set(batch, {duration: 1, opacity: 0, y: 32, overwrite: true}),
      invalidateOnRefresh: true,
    });
    ScrollTrigger.addEventListener("refreshInit", () => gsap.set(".services-cards-loop-item", {y: 32}));
  }
}

/**
* Features Text List
*/
function featuresTextList(){
  const featuresNums = document.getElementsByClassName('features-text-nums');

  if (featuresNums[0]){
    
    function createBox(t, h){
      let textDiv = '';
      textDiv = document.createElement('div');
      textDiv.classList.add('text');
      textDiv.innerHTML = t.innerHTML;

      return textDiv;
    }

    function clearActiveState(arr){
      arr.forEach((e)=>{
        e.classList.remove('active');
      })
    }

    for( let i = 0; i < featuresNums.length; i++ ){
      let parent = featuresNums[i];
      let height = parent.offsetHeight;
      let appearContainer = parent.nextElementSibling;
      let childs = featuresNums[i].querySelectorAll('li');
      let liChild = featuresNums[i].querySelector('li');
      let textChilds = featuresNums[i].querySelectorAll('.features-text-nums-item-text');

      let activeLi = childs[0];
      let boxText = activeLi.querySelector('.features-text-nums-item-text');
      let box = createBox(boxText, height);
      box.classList.add('active');
      appearContainer.appendChild(box);

      function featuresBoxes(){
        for (let i = 0; i < childs.length; i++){

          childs[i].addEventListener('click', function(el){
            const li = el.currentTarget;

            clearActiveState(childs);
            li.classList.add('active');
            let textBox = li.querySelector('.features-text-nums-item-text');

            if (window.matchMedia("(max-width: 1024px)").matches) {

              let shadeBox = appearContainer.querySelector('.text.active');
              shadeBox.classList.remove('active');
              shadeBox.classList.add('shaded');
              let box = createBox(textBox, height);
              box.classList.add('active');

              appearContainer.innerHTML = '';
              appearContainer.appendChild(shadeBox);
              appearContainer.appendChild(box);

              const transitionTL = gsap.timeline({
                paused: true,
                //overwrite: true, 
              });
              transitionTL.to(
                textChilds,
                {
                  opacity: 0, 
                  height: '0px',
                  repeat: 0,
                }
              )
              transitionTL.to(
                textBox, 
                {
                  opacity: 1, 
                  height: 'auto',
                }
              )
              transitionTL.play();
            } else {
              transitionTL.pause();
            };

          });
        }
      }

      function boxesHover(){
        for (let i = 0; i < childs.length; i++){
          childs[i].addEventListener('mouseenter', function(event){
            if (window.matchMedia("only screen and (min-width: 1024px)").matches) {
              clearActiveState(childs);
              this.classList.add('active');
              let shadeBox = appearContainer.querySelector('.text.active');
              shadeBox.classList.remove('active');
              shadeBox.classList.add('shaded');

              let boxText = this.querySelector('.features-text-nums-item-text');
              let box = createBox(boxText, height);
              box.classList.add('active');

              appearContainer.innerHTML = '';
              appearContainer.appendChild(shadeBox);
              appearContainer.appendChild(box);
            }
          });
        }
      }

      featuresBoxes();
      boxesHover();
      window.addEventListener('resize', function(){
        gsap.to(
          '.features-text-nums-item-text',
          {
            opacity: 0, 
            height: '0px',
          }
        )
        if (window.matchMedia("(max-width: 1024px)").matches) {
          gsap.to(
            '.active .features-text-nums-item-text',
            {
              opacity: 1, 
              height: 'auto',
            }
          )
        }
      });

    }
  }
}

/**
 * Reveal
 */
function revealElements(){

  function hideElement(elem){
    if (elem){
      gsap.set(elem, {opacity: 0});
    }
  }

  function animatedEnter(x, y, dur, elem){

    const xSet = x;
    const ySet = y;
    const duration = dur;

    let leftElem = elem.querySelector('.r-left');
    if(leftElem){
      gsap.fromTo(leftElem, {x: xSet},
        {
          duration: duration, 
          x: 0,
          ease: "ease", 
          overwrite: "auto",
        },
        //'-=0.5',
      );
    }

    let rightElem = elem.querySelector('.r-right');
    if (rightElem){
      gsap.fromTo(rightElem, {x: -xSet},
        {
          duration: duration, 
          x: 0,
          ease: "ease", 
          overwrite: "auto",
        },
        //'-=0.5',
      )
    }

    gsap.fromTo(
      elem, 
      {
        x: 0, 
        y: ySet
      }, 
      {
        duration: duration, 
        x: 0,
        y: 0, 
        opacity: 1, 
        ease: "ease", 
        //overwrite: "auto",
      }
    );

  }

  function animatedEnterBack(x, y, dur, elem){

    const xSet = x;
    const ySet = y;
    const duration = dur;

    let leftElem = elem.querySelector('.r-left');
    if (leftElem){
      gsap.fromTo(leftElem, {x: xSet},
        {
          duration: duration, 
          x: 0,
          ease: "ease", 
          overwrite: "auto",
        }
      );
    }
    
    let rightElem = elem.querySelector('.r-right');
    if (rightElem){
      gsap.fromTo(rightElem, {x: -xSet},
        {
          duration: duration, 
          x: 0,
          ease: "ease", 
          overwrite: "auto",
        }
      )
    }

    gsap.fromTo(
      elem, 
      {
        opacity: 0, 
        y: 0
      }, 
      {
        duration: duration, 
        y: ySet, 
        opacity: 1, 
        ease: "ease", 
        //overwrite: "auto",
      }
    );

  }

  let revealElements = gsap.utils.toArray('.reveal');
  revealElements.forEach(function(elem) {
    hideElement(elem);
    ScrollTrigger.create({
        trigger: elem,
        onEnter: function() { 
          animatedEnter(80, 120, 1.2, elem); 
        }, 
        onEnterBack: function() { 
          animatedEnterBack(80, 120, 1.2, elem); 
        },
    });
  });


  let revealElementsSmall = gsap.utils.toArray('.reveal-small');
  revealElementsSmall.forEach(function(elem) {
    hideElement(elem);
    ScrollTrigger.create({
        trigger: elem,
        onEnter: function() { 
          animatedEnter(36, 80, 0.6, elem); 
        }, 
        onEnterBack: function() { 
          animatedEnterBack(36, 80, 0.6, elem); 
        },
    });
  });

}

/**
 * Footer Appear
 */
function footerAppear(){
  const siteFooter = document.getElementById('site-footer');
  const footerTimeline = gsap.timeline({
    paused: true, 
    defaults: {
      stagger: 0.07
    }
  });
  footerTimeline.fromTo('.footer-block-appear', 
    {
      opacity: 0,
      y: '24'
    }, 
    {
      y: '0',
      opacity: 1, 
      duration: 0.5
    }
  );
  ScrollTrigger.create({
    trigger: siteFooter,
    onEnter: function() { 
      footerTimeline.restart(); 
    },
    invalidateOnRefresh: true,
  });
}

function loaderScreen(){
  const domLoaderScreen = document.getElementById('page-transition-screen');
  const swupBlock = document.getElementById('swup');

  gsap.set('.global-hero-content-item, .hero-text, #site-header', {opacity: 0});
  gsap.set(swupBlock, {opacity: 0});

  const loaderTimeline = gsap.timeline({
    paused: true, 
    onComplete: heroAppear
  });

  loaderTimeline.to(domLoaderScreen, 
    {
      height: '100%',
      duration: 0.6,
    }
  ).to(domLoaderScreen, 
    {
      top: 'auto',
      bottom: '0',
      height: '0',
      duration: 0.6,
    }
  ).to(swupBlock, {
    opacity: 1,
    duration: 0.2
  })

  loaderTimeline.play();
}
document.addEventListener("DOMContentLoaded", function(event) {
  loaderScreen();
});

/**
 * Play Promo
 */
function promoPlay(){
  const playButtons = document.querySelectorAll('.play-button');
  const videoCloseButtons = document.querySelectorAll('.video-close');
  const siteHeader = document.getElementById('site-header');
  const body = document.getElementsByTagName('body')[0];

  const playTimeline = gsap.timeline({
    paused: true, 
  });

  if (playButtons[0]){
    for(let i = 0; i < playButtons.length; i++){

      let playButton = playButtons[i];

      if (playButton){
        playButton.addEventListener('click', function(){
          
          let holder = this.closest('.content-block-promo-video');
          let video = holder.querySelector('.video');

          siteHeader.classList.add('display-none');
          body.style.overflow = 'hidden';

          playTimeline.to(video,
            {
              autoAlpha: 1,
              duration: 0.6, 
            },
          );
          playTimeline.play();

        });
      }

    }
  }

  if (videoCloseButtons[0]){
    for(let i = 0; i < videoCloseButtons.length; i++){

      let videoCloseButton = videoCloseButtons[i];

      if (videoCloseButton){
        videoCloseButton.addEventListener('click', function(){
          
          let holder = this.closest('.content-block-promo-video');
          let video = holder.querySelector('.video');
          
          function siteHeaderDisplay(){
            siteHeader.classList.remove('display-none');
          }
          body.style.overflow = 'auto';

          playTimeline.to(video,
            {
              autoAlpha: 0,
              duration: 0.6,
              onComplete: siteHeaderDisplay 
            },
          );
          playTimeline.play();

        });
      }

    }
  }

}

/**
 * Makers
 */
function makers(){

  const makersContainer = document.getElementById('makers-container');
  const makersList = document.querySelectorAll('.maker');
  const makersListInners = document.querySelectorAll('.maker-inner');
  const makersInitial = document.getElementById('makers-initial');
  const makersTablet = document.getElementById('makers-tablet');
  const makersMobile = document.getElementById('makers-mobile');
  const makersContainerHeight = document.getElementById('makers-container-height');
  const makersContainerHeightTablet = document.getElementById('makers-container-height-tablet');
  const makersContainerHeightMobile = document.getElementById('makers-container-height-mobile');

  if(makersContainer){

  function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)

    );
  }

  function makersUp(arr){
    arr.forEach((e)=>{
      if (isInViewport(e)) { 
        e.style.transform = 'translateY(-24px)' 
      }
    });
  }
  function makersDown(arr){
    arr.forEach((e)=>{
      if (isInViewport(e)) { 
        e.style.transform = 'translateY(24px)' 
      }
    });
  }
  
  function makersScroll(){
    let oldValue = 0
    let newValue = 0
    window.addEventListener('scroll', (e) => {
      newValue = window.pageYOffset;
      if (oldValue < newValue) {
        makersUp(makersListInners);
      } else if (oldValue > newValue) {
        makersDown(makersListInners); 
      }
      oldValue = newValue;
    });
  }
  makersScroll();

  function clearActiveMakers(arr){
    arr.forEach((e)=>{
      e.classList.add('inactive');
      e.classList.remove('active');
    })
  };
  function refreshMakers(arr){
    arr.forEach((e)=>{
      e.classList.remove('inactive', 'active', 'sibling-left', 'sibling-right', 'sibling-top', 'sibling-bottom');
    })
  };

  function getSiblingsMakers(elem, width, height, top, left, arr){
    arr.forEach((box)=>{

      let rect = box.getBoundingClientRect();
      let boxTop = rect.top;
      let boxLeft = rect.left;
      let boxHeight = box.offsetHeight;
      let boxWidth = box.offsetWidth;

      let elemTopHeight = Number(top) + Number(height);
      let elemLeftWidth = Number(left) + Number(width);
      let boxTopHeight = boxTop + boxHeight;
      let boxLeftWidth = boxLeft + boxWidth;

      let condition = (boxTop <= elemTopHeight && top <= boxTopHeight) && (boxLeft <= elemLeftWidth && left <= boxLeftWidth);

      if (elem != box){
        if (condition){
          if (boxLeft <= left) {
            box.classList.add('sibling-left');
          }
          if (left <= boxLeft) {
            box.classList.add('sibling-right');
          }

          if (boxTop <= top) {
            box.classList.add('sibling-top');
          }
          if (top <= boxTop) {
            box.classList.add('sibling-bottom');
          }

        }
      }

    })
  }

  function isJson(str) {
      try {
          JSON.parse(str);
      } catch (e) {
          return false;
      }
      return true;
  };

  function setMakers(elem, data){
    let elemID = String(elem.id);
    let elemObj = data[''+elemID+''];
    if (elemObj){

      let thumb = elem.querySelector('.maker-thumb');
      let setX = elemObj.x;
      let setY = elemObj.y;
      let setIndex = elemObj.index;
      let setTextPosition = elemObj.textpos;
      let setWidth = parseInt(elemObj.width, 10);
      let setHeight = parseInt(elemObj.height, 10);

      elem.dataset.index = setIndex;
      elem.dataset.textPosition = setTextPosition;
      elem.dataset.width = setWidth;
      elem.dataset.height = setHeight;

      elem.dataset.top = parseInt(setY, 10);
      elem.dataset.left = parseInt(setX, 10);

      thumb.style.width = setWidth+'px';
      thumb.style.height = setHeight+'px';

      elem.style.zIndex = setIndex;

      gsap.to(
          elem, { 
              top: setY, 
              left: setX,
          }
      );
    }
  }

  function returnData(elem){
    let elemValue = elem.value;
    let makersDataJSON = {};
    let makersDataParsed = '';
    if (elemValue){
        makersDataJSON = elemValue;
        if(isJson(makersDataJSON)){
          makersDataParsed = JSON.parse(makersDataJSON);
        }
    }

    return makersDataParsed;
  }

  function makersInit(e, from, h){
    gsap.utils.toArray(e).forEach(function(elem){
      setMakers(elem, returnData(from));
    });
    makersContainer.style.height = h.value+'px';
  }

  function makerResize(W){
    for (let i = 0; i < makersList.length; i++){
      let e = makersList[i];
      let dataLeft = e.dataset.left;
      let cw = makersContainer.offsetWidth;
      let wp = (((W - cw) / W) * 100).toFixed();
      let nl = ((wp / 100) * dataLeft).toFixed();
      let newLeft = nl;
      //e.style.transform = 'translateX(-'+newLeft+'px)';
      e.style.transform = 'translateX(-'+newLeft+'px)';
    }
  }

  function makersPositions(){
    if (window.matchMedia("(min-width: 1024px)").matches) {
      makersInit('.maker', makersInitial, makersContainerHeight);
      makerResize(1248);
    }
    if (window.matchMedia("(max-width: 1024px) and (min-width: 600px)").matches) {
      makersInit('.maker', makersTablet, makersContainerHeightTablet);
      makerResize(1024);
    }
    if (window.matchMedia("(max-width: 600px)").matches) {
      makersInit('.maker', makersMobile, makersContainerHeightMobile);
      makerResize(600);
    }
  }
  makersPositions();

  //let resized;
  window.addEventListener('resize', function(){

    makersPositions();

    //clearTimeout(resized);
    //resized = setTimeout(makersPositions, 300);
  });

  
  for (let i = 0; i < makersList.length; i++){
    let maker = makersList[i];

    maker.addEventListener('mouseenter', function(){

      let rect = this.getBoundingClientRect();
      let top = rect.top;
      let left = rect.left;

      let width = this.dataset.width;
      let height = this.dataset.height;

      clearActiveMakers(makersList);
      this.classList.remove('inactive');
      this.classList.add('active');

      getSiblingsMakers(this, width, height, top, left, makersList);

    });

    maker.addEventListener('mouseleave', function(){
      refreshMakers(makersList);
    });

  }

}
  
}
makers();


/**
 * Model Carousel
 */
function model_carousel(){
  const modelCarousels = document.querySelectorAll('.model-carousel-itself');

  function clearActive(arr){
    arr.forEach((e)=>{
      e.classList.remove('active');
    })
  };

  function activeMedia(arr, id){
    arr.forEach((e)=>{
      e.classList.remove('active');
    })
    let item = document.querySelector('[data-id="'+id+'"]');
    item.classList.add('active');
  }

  if(modelCarousels.length > 0){
    for(let i = 0; i < modelCarousels.length; i++){

      let carousel = modelCarousels[i];
      let medias = carousel.querySelectorAll('.media');
      let names = carousel.querySelectorAll('.name');

      for(let i = 0; i < names.length; i++){
        names[i].addEventListener('mouseenter', function(){
          
          let dataID = this.dataset.id;

          clearActive(names);
          activeMedia(medias, dataID);

          this.classList.add('active');
        });
      }


    }
  }
}
model_carousel();

/**
 * Forms
 */
const forms = document.querySelectorAll('.wpcf7');
if (forms.length > 0){
  for(let i = 0; i < forms.length; i++){
    let form = forms[i];
  }
}

document.addEventListener( 'wpcf7mailsent', function( event ) {

  const dialogContainer = document.getElementById('message-dialog');
  const dialogTitleText = document.getElementById('dialog-title-text');
  const dialogText = document.getElementById('dialog-text');
  const contactForm = document.getElementById('contact-form');

  let message = event.detail.apiResponse.message;

  let dialogTitle = 'Message received';
  let dialogMessage = message;

  contactForm.classList.add('hide-output-message');
  dialogContainer.classList.add('success');
  dialogTitleText.innerHTML = dialogTitle;
  dialogText.innerHTML = dialogMessage;

  const fancybox = new Fancybox(
    [
      { 
        src: '#message-dialog',
        type: "inline",
      },
    ],
    {
      mainClass: 'dialog',
      closeButton: 'inside',
    },
  );
  
  fancybox.on('destroy', (fancybox, slide) => {
    contactForm.reset();
    contactForm.classList.remove('hide-output-message');
    dialogContainer.classList.remove('success');
  });

}, false );


const textareas = document.querySelectorAll('textarea');
if (textareas.length > 0){
  textareas.forEach(el => {
    el.style.height = el.setAttribute('style', 'height: ' + el.scrollHeight + 'px');
    //el.style.height = el.setAttribute('style', 'height: 32px');
    el.classList.add('auto');
    el.addEventListener('input', e => {
        el.style.height = 'auto';
        el.style.height = (el.scrollHeight) + 'px';
    });
  });
}


const selects = document.querySelectorAll('.custom-select');
if (selects.length){

  function removeActiveOptions(arr){
    arr.forEach((e) => {
      e.classList.remove('selected');
    })
  }

  function closeSelect(elem, select){
    document.addEventListener('click', (event) => {
      let isClickInside = elem.contains(event.target);
      let isClickInsideSelect = select.contains(event.target);
      if (!isClickInside && !isClickInsideSelect) {
        elem.classList.remove('opened');
        elem.classList.add('closed');
      }
    })
  }

  selects.forEach(el => {
    let select = el.querySelector('select');
    let options = select.querySelectorAll('option');
    let firstOption = options[0];

    select.classList.add('select-hidden-accessible');

    let view = document.createElement('div');
    view.classList.add('select-view');
    el.prepend(view);
    let viewText = document.createElement('div');
    viewText.classList.add('select-view-text');
    view.prepend(viewText);

    let viewTextInnerHtml = firstOption.value;
    if (firstOption.value){
      viewText.innerHTML = viewTextInnerHtml;
    } else {
      viewText.innerHTML = firstOption.innerHTML;
    }

    let dropdown = document.createElement('div');
    dropdown.classList.add('select-dropdown');
    dropdown.classList.add('closed');
    el.prepend(dropdown);

    closeSelect(dropdown, view);

    view.addEventListener('click', function(){
      dropdown.classList.remove('closed');
      dropdown.classList.add('opened');
    });

    for(let i = 0; i < options.length; i++){
      let optItem = document.createElement('div');
      let value = options[i].value;

      if (value){
        optItem.classList.add('select-option');
        optItem.dataset.value = value;
        optItem.innerHTML = value;
      } else {
        optItem.innerHTML = options[i].innerText;
        optItem.classList.add('select-label');
      }

      dropdown.appendChild(optItem);
    }

    let optItems = dropdown.querySelectorAll('.select-option');
    for(let i = 0; i < optItems.length; i++){
      let blockOpt = optItems[i];
      blockOpt.addEventListener('click', function(){
        removeActiveOptions(optItems);
        this.classList.add('selected');
        view.classList.add('selected');
        let data = this.dataset.value;

        select.value = data;
        viewText.innerHTML = data;

        dropdown.classList.remove('opened');
        dropdown.classList.add('closed');
      });
    }


  });
}


/**
 * Init All
 */
 function initAll(){

  menuOpen();
  menuClose();
  cursorAnimated();
  navigation();
  swipers();
  logos();
  servicesCards();
  revealElements();
  footerAppear();
  isotopeFilter();
  featuresTextList();

  //heroAppear();
  //promoPlay();

  loadMore(1); /* 04_loadmore.js */
}

function init(){
  initAll();
};
init();