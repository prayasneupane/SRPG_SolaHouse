
(function ($) {
    $(document).ready(function () {
        // Add class active  for main-menu 
        jQuery('.menu-item-469').find('a').html('<img src = "https://www.srpropertygroup.com.au/wp-content/uploads/2023/09/sola-one-logo-1.png">')
        $('.left-nav li a').each(function() {   
            if ($(this).attr('aria-current') || window.location.pathname.includes($(this)[0].pathname.slice(0, -1))){
                $(this).addClass('active');
            }
            if((window.location.pathname.includes('upcoming') && $(this)[0].pathname.includes('all-project')) || 
            (window.location.pathname.includes('our-projects') && $(this)[0].pathname.includes('all-project') 
            && !window.location.pathname.includes('for-sale'))){
                $(this).addClass('active');
            }
        });
        
        // Add class active  for sub-menu
        $('.right-nav li a').each(function() {   
            if ($(this).attr('aria-current') || ($(this)[0].pathname.includes(window.location.pathname)) ){
                $(this).addClass('active');
                return false; // If there is an element with class active, then exit the loop
            }
        });

        // Event onclick open sidebar 
        $( ".handle-sidebar" ).click(function() {
            $('.sidebar-left').addClass("active-sidebar-left");
            $('.toggle-menu-open').addClass('d-none')
            $('.footer-sidebar').addClass('d-none'); 
            $('.icon-social-extent').removeClass('d-none');
            $('.title-sidebar').addClass('d-none') 
            $('.logo').addClass('d-none')
            $('.logo-extent').removeClass( "d-none" ).addClass( "d-block" );  
            $('.form-sidebar').removeClass( "d-none" ).addClass( "d-block" );
            $('.btn-hide-sidebar-left-mobile').addClass('d-none');    
            if($(window).width() < 768){
                $('.handle-sidebar').unbind();
             } 
        });
        // Event onclick close sidebar
        $( "#sidebar-close" ).click(function() {
                $('.handle-sidebar').addClass('body-sidebar'); 
                $('.sidebar-left').removeClass("active-sidebar-left");
                $('.title-sidebar').removeClass('d-none').addClass( "d-block" ); 
                $('.logo').removeClass('d-none').addClass( "d-block" );
                $('.logo-extent').removeClass( "d-block" ).addClass( "d-none" );  
                $('.form-sidebar-success').removeClass( "d-block" ).addClass( "d-none" );  
                $('.form-sidebar').removeClass( "d-block" ).addClass( "d-none" );
                $('.btn-hide-sidebar-left-mobile').removeClass('d-none');
                $('.menu-mobile').addClass('d-none')   
                $('.toggle-menu-open ').removeClass('d-none')
                $('.icon-social-extent').addClass('d-none');
                $('.footer-sidebar').removeClass('d-none')     
                if($(window).width() < 768){
                    $( ".handle-sidebar" ).click(function() {
                        $('.sidebar-left').addClass("active-sidebar-left");
                        $('.toggle-menu-open').addClass('d-none')
                        $('.footer-sidebar-left').addClass('d-none');
                        $('.header-sidebar').removeClass('h-25'); 
                        $('.body-sidebar').removeClass('h-50');  
                        $('.icon-social-extent').removeClass('d-none');
                        $('.title-sidebar').addClass('d-none') 
                        $('.logo').addClass('d-none')
                        $('.logo-extent').removeClass( "d-none" ).addClass( "d-block" );  
                        $('.form-sidebar').removeClass( "d-none" ).addClass( "d-block" );
                        $('.btn-hide-sidebar-left-mobile').addClass('d-none');    
                        if($(window).width() < 768){
                            $('.handle-sidebar').unbind();
                        } 
                    });
                    $('.icon-social').addClass('d-none');
                }  
        });  
        
        // Add event for successfully mail.
        var wpcf7Elm = document.querySelector( '.wpcf7' );
        wpcf7Elm.addEventListener ( 'wpcf7mailsent', function( event ) {
            $('.form-sidebar').removeClass( "d-block" ).addClass( "d-none" );
            $('.form-sidebar-success').removeClass( "d-none" ).addClass( "d-block" );  
        }, true);
 

        // Event open menu-nav for mobile 
        $( "#menu-open-mobile" ).click(function() {
            $('.toggle-menu-open').addClass('d-none')
            $('.sidebar-left').addClass("active-sidebar-left");
            $('.icon-social').addClass('icon-social-extent');
            $('.title-sidebar').addClass('d-none');
            $('.logo').addClass('d-none');
            $('.logo-extent').removeClass( "d-none" ).addClass( "d-block" );
            $('.menu-mobile').removeClass('d-none')
            $('.btn-hide-sidebar-left-mobile').addClass('d-none'); 
            $('.footer-sidebar').addClass('d-none');   
            $('.icon-social-extent').removeClass('d-none'); 
            if($(window).width() < 768){
                $('.handle-sidebar').unbind();
                $('.icon-social').removeClass('d-none');
            } 
        });

        // Event open form contact us 
        $("#open-form-contact-us").click(function(){
            $('.handle-sidebar').addClass('body-sidebar'); 
            $('.menu-mobile').addClass('d-none')   
            $('.form-sidebar').removeClass( "d-none" ).addClass( "d-block" );
            $('.header-sidebar').removeClass('h-25'); 
            $('.body-sidebar').removeClass('h-50');  
        })

        // Variable check is scroll
        var onScroll = false
        // Scroll for page our projects 
        if($(window).width() > 768){
            if($("html").scrollLeft() == 0){
                $("#page-control-next").removeClass("d-none");
                $("#page-control-prev").addClass("d-none");
            }else{
                $("#page-control-prev").removeClass("d-none");
                $("#page-control-next").addClass("d-none");
            }
            $( "#page-control-next" ).click(function() {
                $('body,html').scrollLeft($(document).outerWidth()); 
                $("#page-control-next").addClass("d-none");
                $("#page-control-prev").removeClass("d-none");
            })
            $( "#page-control-prev" ).click(function() {
                $('body,html').scrollLeft(0); 
                $("#page-control-prev").addClass("d-none");
                $("#page-control-next").removeClass("d-none");
            })
        }else {
            $("#page-control-prev").removeClass("d-none");
            $( "#page-control-next" ).click(function() {
                index = checkClassActiveProjects('.project');
                if(index != sum_projects-1){ 
                    onScroll = true
                    $(".project").eq(index).removeClass("active");
                    $(".project").eq(index + 1).addClass("active");
                    $('body,html').scrollLeft($(".project").eq(index+1).position().left -50 ); 
                    // Add number for number project
                    $( ".current-project" ).empty();
                    myNumber = index + 2;
                    $(".current-project").append(("0" + myNumber).slice(-2)) 
                    // Add class active for scrollbar 
                    $(".scollbar-project .col").eq(index).removeClass("active");
                    $(".scollbar-project .col").eq(index+ 1).addClass("active");
                    setTimeout(function() { 
                        onScroll = false
                    }, 2000);
                }  
            })
            $( "#page-control-prev" ).click(function() {
                index = checkClassActiveProjects('.project');
                if(index != 0 && index != -1){
                    onScroll = true
                    $(".project").eq(index).removeClass("active");
                    $(".project").eq(index - 1).addClass("active");
                    $('body,html').scrollLeft($(".project").eq(index - 1 ).position().left - 50 );
                    // Subtract  number for number project
                    $( ".current-project" ).empty();
                    if(!index) index++;
                    $(".current-project").append(("0" + index).slice(-2));
                    // Subtract class active for scrollbar 
                    $(".scollbar-project .col").eq(index).removeClass("active");
                    $(".scollbar-project .col").eq(index - 1).addClass("active");
                    setTimeout(function() { 
                        onScroll = false
                    }, 2000);
                }
            })
        }


        // Add scrollbar for project 
        $('.project').each(function(){
            $(".scollbar-project").append('<div class="col"></div>')
        });


        // Number projects in our_projects page
        var sum_projects = 0;
        $('.project').each(function() {   
            sum_projects++;
        });
        $(".sum-project").append(" "+sum_projects);
        
        if (checkClassActiveProjects('.project') == -1){
            $(".scollbar-project .col").eq(0).addClass("active");
            $(".current-project").append('01')
            if($( window ).width() <= 768){
                $(".project").eq(checkClassActiveProjects('.project') + 1).addClass("active");
            }
        }else{
            $(".current-project").append(checkClassActiveProjects('.project')  )
        }


        // control buton page projects
        $('.projects-next').click(function(){
            index = checkClassActiveProjects('.project');
            if(index != sum_projects-1){ 
                onScroll = true
                $(".project").eq(index).removeClass("active");
                $(".project").eq(index + 1).addClass("active");
                $('body,html').scrollLeft($(".project").eq(index+1).position().left -50 ); 
                // Add number for number project
                $( ".current-project" ).empty();
                myNumber = index + 2;
                $(".current-project").append(("0" + myNumber).slice(-2)) 
                // Add class active for scrollbar 
                $(".scollbar-project .col").eq(index).removeClass("active");
                $(".scollbar-project .col").eq(index+ 1).addClass("active");
                setTimeout(function() { 
					onScroll = false
				}, 2000);
            }          
        })
        $('.projects-prev').click(function(){
            index = checkClassActiveProjects('.project');
            if(index != 0 && index != -1){
                onScroll = true
                $(".project").eq(index).removeClass("active");
                $(".project").eq(index - 1).addClass("active");
                $('body,html').scrollLeft($(".project").eq(index - 1 ).position().left - 50 );
                // Subtract  number for number project
                $( ".current-project" ).empty();
                if(!index) index++;
                $(".current-project").append(("0" + index).slice(-2));
                // Subtract class active for scrollbar 
                $(".scollbar-project .col").eq(index).removeClass("active");
                $(".scollbar-project .col").eq(index - 1).addClass("active");
                setTimeout(function() { 
					onScroll = false
				}, 2000);
            }
        })
        

        // Add label for input 
        $("#name, #email, #phone, #message").focus(function(){
            var label = $("label[for='" + $(this).attr('id') + "']");
            if($(this).attr('id') == 'message'){
                label.empty();
                label.append('Message')
            }
                $(this).addClass('active');
                label.addClass('active');

        })

        $("#name, #email, #phone, #message").focusout(function(){
            var label = $("label[for='" + $(this).attr('id') + "']");
            if($(this).attr('id') == 'message'){
                label.empty();
                label.append('Type your message...');
            }
            if($(this).val() == '')
            {
                $(this).removeClass('active');
                label.removeClass('active');
            }
        })

        // Event back to top individual project 
        $(window).scroll(function() {
            if ($(this).scrollTop()) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        
        $("#back-to-top").click(function() {
            $("html, body").animate({scrollTop: 0}, 1);
        });

        // Get position mouse
        $(document).mousemove(function(event) {
            x = event.pageX;
            y = event.clientY;
            if(y <= 80){
                $('.page-template-default-template .main-body .header').addClass('active')
            }else{
                $('.page-template-default-template .main-body .header').removeClass('active')
            }
        });

        // Center div for page 
        jQuery.fn.center = function(parent ,animate) {
            if(parent) {
              parent = this.parent();
            } else {
              parent = window;
            }
            if(!animate){
                this.css({
                    "position": "absolute",
                    "width": "inherit",
                    "top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
                  //   "left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
                  });
            }else{
                this.css({
                    "position": "absolute",
                    "width": "inherit",
                    "top": 0,
                  //   "left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
                  });
                this.animate({
                    "top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + 30 + "px"),
                },800);
            }
           
            return this;
          }
          if($( window ).width() > 768){
            $("div.home-page").center(true);
            $("div.project-page").center(true,true);
          }
       
          $(window).on('resize', function() {
                if ($( window ).width() > 600) {
                    $("div.home-page").center(true);
                    $("div.project-page").center(true,true);
                }
          });

          // menu-right func 
            var sum_post_type_story = 0;
            $('.handle-menu-right').each(function(i , obj) {   
                sum_post_type_story++;
                if(sum_post_type_story == 1){
                    $(".menu-right-body").append('<p class="number active"> 0'+sum_post_type_story+'</p>');
                }else {
                    $(".menu-right-body").append('<p class="number"> 0'+sum_post_type_story+'</p>');
                }
            });

            if (checkClassActiveProjects('.handle-menu-right') == -1){
                $(".handle-menu-right").eq(0).addClass("active");
            }

            $('p.number').click(function() {
                $(".handle-menu-right.active").removeClass('active')
                $("p.number.active").removeClass("active");
                $(".handle-menu-right").eq($(this).index()).addClass("active");
                $("p.number").eq($(this).index()).addClass("active");
                var positionPost = $(".handle-menu-right.active").offset().top;
                $("html, body").animate({scrollTop: positionPost - 50}, 1);
            })

            $('#scroll-up').click(function() {
                var index = checkClassActiveProjects('.handle-menu-right');
                if(index != 0){
                    $(".handle-menu-right.active").removeClass('active')
                    $("p.number.active").removeClass("active");
                    $(".handle-menu-right").eq(index -1 ).addClass("active");
                    $("p.number").eq(index -1).addClass("active");
                    var positionPost = $(".handle-menu-right.active").offset().top;
                    $("html, body").animate({scrollTop: positionPost - 50}, 1);
                }
            })

            $('#scroll-down').click(function() {
                var index = checkClassActiveProjects('.handle-menu-right');
                if(index + 1 != sum_post_type_story){
                    $(".handle-menu-right.active").removeClass('active')
                    $("p.number.active").removeClass("active");
                    $(".handle-menu-right").eq(index + 1 ).addClass("active");
                    $("p.number").eq(index + 1).addClass("active");
                    var positionPost = $(".handle-menu-right.active").offset().top;
                    $("html, body").animate({scrollTop: positionPost - 50}, 1);
                }
            })

            $(window).scroll(function() {
                var windscroll = $(window).scrollTop();
                var windscrollLeft = $(window).scrollLeft();
                if($('.handle-menu-right').length){
                    if(windscroll + screen.height/2 >= $('.handle-menu-right').last().position().top){
                        $('p.number.active').removeClass('active');
                        $('p.number:last').addClass('active');
                        $(".handle-menu-right.active").removeClass("active");
                        $(".handle-menu-right:last").addClass("active");
                    }
                    else if(windscroll >= 100) {
                        $('.handle-menu-right').each(function(i) {
                            // The number at the end of the next line is how pany pixels you from the top you want it to activate.
                            if ($(this).position().top <= windscroll - 0) {
                                $('p.number.active').removeClass('active');
                                $('p.number').eq(i).addClass('active');
                                $('.handle-menu-right.active').removeClass('active');
                                $('.handle-menu-right').eq(i).addClass('active');
                            }
                        });
                    }
                    else {
                        $('p.number.active').removeClass('active');
                        $('p.number:first').addClass('active');
                        $(".handle-menu-right.active").removeClass("active");
                        $(".handle-menu-right:first").addClass("active");
                    }
                }
                if(($('.project ').length) && $( window ).width() < 768 &&    onScroll == false){
                    if(windscrollLeft >= 100) {
                        $('.project').each(function(i) {
                            // The number at the end of the next line is how pany pixels you from the top you want it to activate.
                            if ($(this).position().left <= windscrollLeft + 82 ) {
                                $('.project.active').removeClass('active');
                                $('.project').eq(i).addClass('active');
                            }
                        });
                    }
                    else {
                        $('.project.active').removeClass('active');
                        $('.project:first').addClass('active');
                    }
                }
            }).scroll();

            // button share fb 
            const facebookShare =  $("#facebook-share");
            let postUrl = encodeURI(document.location.href)
            let postTiltle = "Hi everyone, please check this out";
            // let postImg = 
            facebookShare.attr("href" , `https://www.facebook.com/sharer.php?u=${postUrl}`
            );
           
            
});  


function checkClassActiveProjects(className) {
    var player  = $(className),
    current = player.filter('.active');
    return current.index(className);
}
function getPosition( element ) {
    var rect = element.getBoundingClientRect();
    var win = element.ownerDocument.defaultView;
    return {
        top: rect.top + win.pageYOffset,
        left: rect.left + win.pageXOffset
    };
} 
})(jQuery);