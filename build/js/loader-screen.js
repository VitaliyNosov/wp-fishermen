/*
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

loaderScreen();
*/
