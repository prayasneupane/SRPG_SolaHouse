jQuery(document).ready(function ($) {
    var mobileScreen = false;
    var multiplier = 6;
    if (jQuery('#screen-detector').is(':visible')) {
        mobileScreen = true;
        multiplier = 5;
    }

    // Function to check if an element is in the viewport
    var visible = false;
    var visibleHouse = false;
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    var elementToCheck1 = document.getElementById('counter-trigger-top');
    var elementToCheck2 = document.getElementById('counter-trigger-bottom');
    var elementToCheck3 = document.getElementById('overlay-img-container');
    // Check if the element is in the viewport when the page loads
    if (isElementInViewport(elementToCheck1) || isElementInViewport(elementToCheck2)) {
        visible = true;
        triggerCounter();
    } 

    function triggerCounter(){
        for(i=1; i < 6; i++){
            var target = $('#counter-number-hidden' + i).html();
            startCounter(target, i)
        }
    }
    function startCounter(target, i){
        $({ countNum: 0 }).animate({ countNum: target }, {
            duration: 1000,
            easing: 'linear',
            step: function () {
            if(i == 1 || i == 2){
                $('#counter-number' + i).html(Math.floor(this.countNum) + '<span> m<sup>2</sup></span>' );
            }
            else{
                $('#counter-number' + i).html(Math.floor(this.countNum) );
            }
            },
            complete: function () {
                if(i == 1 || i == 2 ){
                    $('#counter-number' + i).html(this.countNum +  '<span> m<sup>2</sup></span>');
                }
                else{
                    $('#counter-number' + i).html(this.countNum);
                }
            }
        });
    }

    var scroll = 0;
    var component = document.querySelector('.image-container');
    var windowHeight = window.innerHeight;
    var topPos = component.getBoundingClientRect().top;
    // Check if the element is in the viewport when the window is scrolled
    $(window).on('scroll', function() {
        if (isElementInViewport(elementToCheck1) || isElementInViewport(elementToCheck2)) {
            if(!visible){
                visible = true;
                triggerCounter();
            }
        }
        else{
            visible= false;
        }
        scroll = window.scrollY;
        if(scroll >= topPos && scroll < (topPos + windowHeight)){
            //to remove all classes sauf .container
            if(!component.classList.contains('slide1')){
                component.setAttribute('class','image-container slide1');
            }
        }
        else if(scroll >= (topPos + windowHeight) && scroll < (topPos + 2*windowHeight)){
            //to remove all classes sauf .container
            if(!component.classList.contains('slide2')){
                component.setAttribute('class','image-container slide2');
            }
        }
        else if(scroll >= (topPos + 2*windowHeight) && scroll < (topPos + 3*windowHeight)){
            //to remove all classes sauf .container
            if(!component.classList.contains('slide3')){
                component.setAttribute('class','image-container slide3');
            }
        }
        else if(scroll >= (topPos + 3*windowHeight) && scroll < (topPos + 4*windowHeight)){
            //to remove all classes sauf .container
            if(!component.classList.contains('slide4')){
                component.setAttribute('class','image-container slide4');
            }
        }
        else if(scroll >= (topPos + 4*windowHeight) && scroll < (topPos + multiplier*windowHeight)){
            //to remove all classes sauf .container
            if(!component.classList.contains('slide5')){
                component.setAttribute('class','image-container slide5');
            }
        }

    });    
});
