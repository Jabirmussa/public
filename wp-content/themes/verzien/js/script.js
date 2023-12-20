// Header scroll
function fixHeaderOnScroll() {
    const header = document.querySelector('header');
  
    if (window.scrollY >= 1) {
        header.classList.add('fixed');
    } else {
        header.classList.remove('fixed');
    }
}
  
window.addEventListener('scroll', fixHeaderOnScroll);
fixHeaderOnScroll();

// Header menu
const headerBurger = document.querySelector('.header-burger');
let scrollPosition = 0;

headerBurger.addEventListener('click', () => {
    if (document.body.classList.contains('menu-is-open')) {
        document.body.classList.remove('menu-is-open');
        window.scrollTo({top: scrollPosition, behavior: 'auto'});
    } else {
        scrollPosition = window.scrollY;
        document.body.classList.add('menu-is-open');
    }
});
  
window.addEventListener('resize', () => {
    document.body.classList.remove('menu-is-open');
});

// Tiny slider
const sliderWrap = document.querySelector('.slider-wrap');

if(sliderWrap){
    var slider = tns({
        container: '.slider-wrap',
        items: 1,
        mouseDrag: true,
        controls: true,
        nav: false,
        autoHeight: true
    });
}