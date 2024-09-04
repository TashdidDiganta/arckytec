(function($) {
    "use strict";
    /* Main Functions */
    var SwiperInit = {
        init: function() {
            this.Basic.init();
        },

        Basic: {
            init: function() {
                this.TestimonialSliderOne();
                this.BannerSliderOne();
                this.ProjectSliderOne();
                this.TestimonialSliderTwo();
                this.TeamSliderOne();
                this.TestimonialSliderThree();
                this.BrandSliderOne();
                this.TestimonialSliderFour();
            },
            TestimonialSliderOne: function(){
              var swiper1 = new Swiper(".testimonial-slider-1", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-one-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-one__swiper-button-next",
                    prevEl: "#testimonial-one__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 2,
                  },
                  1199: {
                    slidesPerView: 2,
                  }
                },
              });
            },
            BannerSliderOne: function(){
              var swiper2 = new Swiper(".h2-banner-slider", {
                slidesPerView: 1,
                effect: 'fade',
                loop: true,
                pagination: {
                    el: "#main-slider-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#main-slider__swiper-button-next",
                    prevEl: "#main-slider__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                  disableOnInteraction: false,
                }
              });

              $(".h2-banner-slider").hover(function() {
                (this).swiper.autoplay.stop();
              }, function() {
                (this).swiper.autoplay.start();
              });
            },
            ProjectSliderOne: function(){
              var swiper3 = new Swiper(".project-slider-1", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#project-two-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#project-two__swiper-button-next",
                    prevEl: "#project-two__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 2,
                  },
                  1199: {
                    slidesPerView: 2,
                  }
                },
              });
            },
            TestimonialSliderTwo: function(){
              var swiper4 = new Swiper(".testimonial-slider-2", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-two-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-two__swiper-button-next",
                    prevEl: "#testimonial-two__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 2,
                  },
                  1199: {
                    slidesPerView: 3,
                  }
                },
              });
            },
            TeamSliderOne: function(){
              var swiper5 = new Swiper(".team-slider-1", {
                spaceBetween: 30,
                slidesPerView: 2,
                effect: 'fade',
                loop: true,
                pagination: {
                    el: "#team-two-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#team-two__swiper-button-next",
                    prevEl: "#team-two__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 1,
                  },
                  1199: {
                    slidesPerView: 1,
                  }
                },
              });
            },
            TestimonialSliderThree: function(){
              var swiper4 = new Swiper(".testimonial-slider-3", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-three-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-three__swiper-button-next",
                    prevEl: "#testimonial-three__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 1,
                  },
                  1199: {
                    slidesPerView: 1,
                  }
                },
              });
            },
            BrandSliderOne: function(){
              var swiper4 = new Swiper(".brand-slider-1", {
                spaceBetween: 100,
                slidesPerView: 5,
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 2,
                  },
                  375: {
                    slidesPerView: 2,
                  },
                  575: {
                    slidesPerView: 3,
                  },
                  767: {
                    slidesPerView: 4,
                  },
                  991: {
                    slidesPerView: 5,
                  },
                  1199: {
                    slidesPerView: 5,
                  }
                },
              });
            },
            TestimonialSliderFour: function(){
              var swiper4 = new Swiper(".testimonial-slider-4", {
                spaceBetween: 30,
                slidesPerView: 2,
                loop: true,
                pagination: {
                    el: "#testimonial-four-pagination",
                    type: "bullets",
                    clickable: true
                },
                navigation: {
                    nextEl: "#testimonial-four__swiper-button-next",
                    prevEl: "#testimonial-four__swiper-button-prev"
                },
                autoplay: {
                  delay: 5000,
                },
                breakpoints: {
                  0: {
                    slidesPerView: 1,
                  },
                  375: {
                    slidesPerView: 1,
                  },
                  575: {
                    slidesPerView: 1,
                  },
                  767: {
                    slidesPerView: 1,
                  },
                  991: {
                    slidesPerView: 2,
                  },
                  1199: {
                    slidesPerView: 2,
                  }
                },
              });
            }
        }
    }

    $( document ).ready( function () {
      SwiperInit.init();
    });

})(jQuery);