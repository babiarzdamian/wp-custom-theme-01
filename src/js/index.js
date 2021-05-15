import { Offcanvas } from 'bootstrap';
import Splide from '@splidejs/splide';
import SmoothScroll from 'smooth-scroll';

(function (root, undefined) {
    'use strict';
    console.log('ready');

    var scroll = new SmoothScroll('a[href*="#"]', {
        topOnEmptyHash: true,
        speed: 500,
        speedAsDuration: true,
        offset: 78,
        easing: 'easeInOutQuad',
    });

    const offcanvasElems = document.querySelectorAll('.offcanvas');
    offcanvasElems.forEach((elem) => {
        elem.addEventListener('hide.bs.offcanvas', () => {
            document.body.classList.add('offcanvas-closing');
        });
        elem.addEventListener('hidden.bs.offcanvas', () => {
            document.body.classList.remove('offcanvas-closing');
            document.body.classList.remove('offcanvas-primary');
            searchFormToggle.classList.remove('active');
        });
    });
    const searchFormToggle = document.querySelector(
        '[data-bs-target="#searchForm"]'
    );
    searchFormToggle.addEventListener('click', () => {
        searchFormToggle.classList.add('active');
        document.body.classList.add('offcanvas-primary');
    });

    const dropdownMenu = document.querySelectorAll(
        '.menu-item-has-children > a'
    );
    dropdownMenu.forEach((menu) => {
        let subMenuHeight = menu.nextElementSibling.offsetHeight;
        let siblingElem = menu.nextElementSibling;
        siblingElem.style.height = '0px';

        menu.addEventListener('click', (e) => {
            e.preventDefault();
            let parentElem = e.target.parentNode;
            parentElem.classList.toggle('open');
            if (parentElem.classList.contains('open')) {
                siblingElem.style.height = subMenuHeight + 'px';
            } else {
                siblingElem.style.height = '0px';
            }
        });
    });

    const brandBar = document.querySelector('.brand-bar');
    const brandBarToggle = document.querySelectorAll('[data-toggle="brandbar"]');
    brandBarToggle.forEach((toggle) => {
        let brandBarLabel = toggle.getElementsByTagName('span')[0];
        toggle.addEventListener('click', () => {
            brandBar.classList.toggle('open');
            toggle.classList.toggle('open');
            if (brandBarLabel.innerHTML === toggle.dataset.labelHide) {
                brandBarLabel.innerHTML = toggle.dataset.labelShow;
            } else {
                brandBarLabel.innerHTML = toggle.dataset.labelHide;
            }
        });
    });

    var splideSliders = document.getElementsByClassName( 'splide' );
    if(splideSliders.length != 0) {
        for ( let splideSlider of splideSliders ) {
            let sliderGap = splideSlider.dataset.gap || '10px';
            new Splide(splideSlider, {
                type: 'slide',
                perPage: 1,
                perMove: 1,
                autoWidth: true,
                gap: sliderGap,
                arrows: true,
                pagination: false
            }).mount();
        }
    }

})(this);
