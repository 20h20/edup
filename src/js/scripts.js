/*include /libs/jquery.core.js*/
/*include /libs/slick.js*/
/*include /libs/smoothscroll.js*/
/*include /libs/move.js*/

jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { passive: true });
    }
};

var Master = {
    onready : function(){
        cg_Move.init_wavy();
    },
    onscroll : function(){
        cg_Move.scroll_slides();
    },
};

$(window).on( 'scroll', function(){
    Master.onscroll();
});


(function($) { 
	var Master = {
		onready : function(){

			/////////////////// SMOOTHSCOLL ///////////////////
			CBO_Smoothscroll.init();


			/////////////////// SMARTPHONE NAVIGATION ///////////////////
			$('header .burger-menu').on('click', function(){
				$('.header-nav').toggleClass('nav--open');
				$('.burger-menu').toggleClass('burger-menu-cross');
				$('body').toggleClass('body--menuopen');
				$('html').toggleClass('html--hidden');
			});
			$('header .menu-item-has-children').on('click', function(e){
				$(this).toggleClass('active');
				e.stopPropagation();
			});
			$('header .menu-item-has-children').on('click', function(e){
				$(this).find('.sub-menu').toggleClass('sub-menu_open');
				e.stopPropagation();
			});


			//////////////// STICKY ////////////////
			$(window).scroll(function(){
				if($(window).scrollTop()>80){
					$("header").addClass('header-scroll');
				}else{
					$("header").removeClass('header-scroll');
				}
			})
			.scroll();

			/////////////////// SLIDER CLIENTS ///////////////////
			$('.cbo-clients .clients-list').slick({
				arrows: false,
				dots: false,
				infinite: true,
				centerMode: true,
				speed: 5000,
				autoplay: true,
				autoplaySpeed: 0,
				cssEase: 'linear',
				slidesToShow: 5,
				slidesToScroll: 5,
				prevArrow: '<button type="button" class="slick-prev" aria-label="Précédent"><i class="icon icon--arrow-prev"></i></button>',
				nextArrow: '<button type="button" class="slick-next" aria-label="Suivant"><i class="icon icon--arrow-next"></i></button>',
				responsive: [
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 6,
							slidesToScroll: 5,
							arrows: false,
							dots: false,
							infinite: true,
						}
					},
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 4,
							arrows: false,
							dots: false,
							infinite: true,
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							arrows: false,
							dots: false,
							infinite: true,
						}
					},
				]
			});
			var arrowsContainer = $('<div class="slick-arrows-container"></div>');
			$('.cbo-clients .clients-list').append(arrowsContainer);
			arrowsContainer.append($('.cbo-clients .clients-list').find('.slick-prev, .slick-next'));


			/////////////////// SLIDER PARTNERS ///////////////////
			$('.cbo-partners .partners-list').slick({
				arrows: false,
				dots: false,
				infinite: false,
				speed: 5000,
				autoplay: false,
				autoplaySpeed: 0,
				cssEase: 'linear',
				slidesToShow: 5,
				slidesToScroll: 5,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							slidesToShow: 4,
							slidesToScroll: 4,
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						}
					},
				]
			});


			/////////////////// SLIDER GALLERY ///////////////////
			$('.cbo-gallery .gallery-list').slick({
				arrows : false,
				dots: false,
				speed: 300,
				slidesToShow: 3,
				slidesToScroll: 3,
				infinite: true,
				adaptiveHeight: true,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					},
				]
			});


			/////////////////// CONTACT STEP ///////////////////
			if ($('body .cbo-form.form--step').length > 0){
				var nextStepButton = document.querySelector('.next-step');
				var prevStepButton = document.querySelector('.prev-step');
				var step1 = document.getElementById('step1');
				var step2 = document.getElementById('step2');

				// Activer le bouton "Suivant" si une case à cocher est cochée
				var checkboxes = document.querySelectorAll('input[type="checkbox"]');
				checkboxes.forEach(function(checkbox) {
					checkbox.addEventListener('change', function() {
						if (document.querySelector('input[type="checkbox"]:checked')) {
							nextStepButton.disabled = false;
							nextStepButton.classList.add('button-active');
						} else {
							nextStepButton.disabled = true;
							nextStepButton.classList.remove('button-active');
						}
					});
				});
				
				// Passer à l'étape 2
				nextStepButton.addEventListener('click', function () {
					step1.style.display = 'none';
					step2.style.display = 'block';
				});

				// Revenir à l'étape 1
				prevStepButton.addEventListener('click', function () {
					step2.style.display = 'none';
					step1.style.display = 'block';
				});
			}


			/////////////////// ADD CHECK TO ACCEPTANCE ///////////////////
			var cbo_forms = {
				init: function () {
				  this.bind_checked();
				  this.check_checked();
				},
				bind_checked: function () {
				  $(".cbo-form")
					.find('input[type="radio"], input[type="checkbox"]')
					.on("change", function () {
					  cbo_forms.check_checked();
					});
				},
				check_checked: function () {
				  $(".cbo-form")
					.find('input[type="radio"], input[type="checkbox"]')
					.each(function () {
					  if ($(this).is(":checked")) {
						$(this).closest(".form-field").find(".field-inner").addClass("checked");
					  } else {
						$(this).closest(".form-field").find(".field-inner").removeClass("checked");
					  }
					});
				},
			};
			cbo_forms.init();


			//////////////// ACCORDION ////////////////
			$('.accordion-list .list-el').on('click', function () {
				var $this = $(this);
				$this.siblings().removeClass('el--open');
				$this.toggleClass('el--open');
			});


			/////////////////// FILTER ///////////////////
			$('.filters-menu').on('click', function(event){
				event.stopPropagation();
				$('.filters-list').toggleClass('list--open');
				$('.filters-menu').toggleClass('filters-menu-click');
			});

			$('.filters-inner a').filter(function(){
				return this.href === location.href;
			}).addClass('el--active');

			$(document).on('click', function(event) {
				if (!$(event.target).closest('.filters-inner').length) {
					$('.filters-list').removeClass('list--open');
					$('.filters-menu').removeClass('filters-menu-click');
				}
			});

			$('.filters-inner').on('click', function(event){
				event.stopPropagation();
			});


			//////////////// FILTERS URL ////////////////
			var secteursSelect = document.getElementById('secteurs-select');
			if (secteursSelect) {
				secteursSelect.addEventListener('change', function() {
					var url = this.value;
					if (url) {
						window.location.href = url;
					}
				});
			}
		
			var thematiqueSelect = document.getElementById('thematique-select');
			if (thematiqueSelect) {
				thematiqueSelect.addEventListener('change', function() {
					var url = this.value;
					if (url) {
						window.location.href = url;
					}
				});
			}


			///////////////////// PARALLAXE HERO ///////////////////
			var parallaxeHero = document.querySelector('.cbo-herosimple .herosimple-picture img');
			if (parallaxeHero) {
				function parallaxScrollHero() {
					var scrolled = window.pageYOffset;
					parallaxeHero.style.transform = 'translateY(' + scrolled * 0.5 + 'px)';
				}
				window.addEventListener('scroll', parallaxScrollHero);
			}
			

			/////////////////// SOCIAL SHARE ///////////////////
			var shareButton = document.getElementById('linkedin-share-button');
            if (shareButton) {
                shareButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    var pageUrl = window.location.href;
                    var pageTitle = document.title;
                    var linkedinUrl = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
                    window.open(linkedinUrl, 'linkedin-share-dialog', 'width=800,height=600');
                    return false;
                });
            }


			/////////////////// MODALE ///////////////////
			$('.button-modale').on('click', function(e) {
				e.stopPropagation();
				$('.cbo-modale').toggleClass('modale--open');
			});

			$('.cbo-modale .modale-close, .cbo-modale .modale-overlay').on('click', function() {
				$('.cbo-modale').removeClass('modale--open');
			});


			//////////////// SCROLL ANIMATIONS ////////////////
			var scroll = window.requestAnimationFrame || function(callback){ window.setTimeout(callback, 1000/60)};
			var elementsToShow = document.querySelectorAll('.slide-up, .slide-up, .slide-right, .slide-left, .scale-up, .scale-down'); 

			function loop() {
				Array.prototype.forEach.call(elementsToShow, function(element){
					if (isElementInViewport(element)) {
						element.classList.add('anim-scroll');
					} else {
						element.classList.remove('anim-scroll');
					}
				});
				scroll(loop);
			}	

			loop();
			function isElementInViewport(el) {
				if (typeof jQuery === "function" && el instanceof jQuery) {
					el = el[0];
				}
				var rect = el.getBoundingClientRect();
				return (
					(rect.top <= 0&& rect.bottom >= 0)||(rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) && rect.top <= (window.innerHeight || document.documentElement.clientHeight))||(rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
				);
			}
			
		},
		
		onload : function(){

		},

		onresize : function(){

		},

		onscroll : function(){

		},
	
	};

	$(document).ready( function(){
		Master.onready();
		
	});

	$(window).load( function(){
		Master.onload();
	});

	$(window).resize( function(){
		Master.onresize();
	});

	$(window).on('scroll', function(){
		Master.onscroll();
	});

})(jQuery);