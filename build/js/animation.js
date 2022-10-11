/**
 * Consts
 */
const site = document.getElementById('swup');
const siteHeader = document.getElementById('site-header');
const siteFooter = document.getElementById('site-footer');
const html = document.getElementsByTagName('html')[0];
const body = document.getElementsByTagName('body')[0];
const heroActions = document.getElementById('hero-actions');

const logo = document.getElementById('logo');
const logoText = document.getElementById('logo-text');
const mainMenu = document.getElementById('main-menu');

const sections = document.querySelectorAll('.section-layout, .site-footer');
const sectionsLength = sections.length;

const menuToggleButton = document.getElementById('menu-toggle-button');
const headerMenuContent = document.getElementById('header-menu-content');

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
 * Hide
 */
function hide(elem) {
  gsap.set(elem, {opacity: 0});
}


/**
 * Cursor
 */
document.head.insertAdjacentHTML("beforeend", `<style> 
 @media screen and (min-width: 1024px) {
   body {cursor: none;} 
   *:hover, 
   *:link  {cursor: none;} 
   #cursor {display: block;} 
 }
</style>`);

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
  const sections = document.querySelectorAll('.section-layout, .site-footer');
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
      }
    );
    headerTL.play();
  });

}
function menuClose(){
  const headerMenuCloseButton = document.getElementById('header-menu-close-button');
  const headerMenu = document.getElementById('header-menu');

  headerMenuCloseButton.addEventListener('click', function(){

    body.style.overflow = 'auto';

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
  
  function animateFrom(elem, direction) {
    direction = direction || 1;
    let x = 0,
        y = direction * 100;
    if(elem.classList.contains("fromLeft")) {
      x = -100;
      y = 0;
    } else if (elem.classList.contains("fromRight")) {
      x = 100;
      y = 0;
    }
    elem.style.transform = "translate3d(" + x + "px, " + y + "px, 0)";
    elem.style.opacity = "0";
    gsap.fromTo(elem, {x: x, y: y}, {
      duration: 1.25, 
      x: 0,
      y: 0, 
      opacity: 1, 
      ease: "power4", 
      overwrite: "auto",
    });
  }

  gsap.utils.toArray(".reveal").forEach(function(elem) {
    ScrollTrigger.create({
        trigger: elem,
        scrub: 1,
        onEnter: function() { 
            animateFrom(elem) 
        }, 
        onEnterBack: function() { 
            animateFrom(elem, -1) 
        },
        onLeave: function() { 
            hide(elem);
        },
        invalidateOnRefresh: true,
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
 * Init All
 */
function initAll(){
  menuOpen();
  menuClose();
  cursorAnimated();
  navigation();
  //heroAppear();
  swipers();
  logos();
  servicesCards();
  revealElements();
  footerAppear();
  isotopeFilter();
  featuresTextList();
}

const swup = new Swup({
  plugins: [
    new SwupBodyClassPlugin(),
    new SwupJsPlugin(),
    new SwupScrollPlugin(),
    new SwupPreloadPlugin(),
  ]
});
function init(){
  initAll();
};
init();

swup.on('transitionStart', (event) => {
  let Alltrigger = ScrollTrigger.getAll()
  for (let i = 0; i < Alltrigger.length; i++) {
    Alltrigger[i].kill(true)
  }
});
swup.on('contentReplaced', (event) => {

  const body = document.getElementsByTagName('body')[0];
  body.style.overflow = 'auto';

  const swupBlock = document.getElementById('swup');
  swupBlock.style.opacity = '1';

  cursorReset();

  let Alltrigger = ScrollTrigger.getAll()
  for (let i = 0; i < Alltrigger.length; i++) {
    Alltrigger[i].kill(true)
  }

  gsap.utils.toArray(".reveal").forEach(function(elem) {
    hide(elem);
  });

  init();

});

swup.on('transitionStart', function(e){
});
swup.on('transitionEnd', function(e){
});

swup.on('animationInStart', function(e){
  gsap.set('.global-hero-content-item, .hero-text, #site-header', {opacity: 0});
  loaderScreen();
});