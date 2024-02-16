(function ($) {
    window.$ = $;

    function floatLabel(inputType) {
        jQuery(inputType).each(function () {
            var $this = jQuery(this);
            // on focus add cladd active to label
            $this.on('focus', function () {
                $this.next().addClass('active');
            });

            //on blur check field and remove class if needed
            $this.on('blur', function () {
                if ($this.val() === '' || $this.val() === 'blank') {
                    $this.next().removeClass();
                }
            });
        });
    }

    floatLabel('.floatLabel');

    // back to top
    {
        var scrollTrigger = 100,
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-to-top').addClass('show');
                } else {
                    $('#back-to-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
    }

    $('#hamburger').on('click', function () {
        $(this).toggleClass('open');
        $('body').toggleClass('menu-open');
        $('.header__menu').toggleClass('active');
    });

    $('.section-title--mobile').on('click', function () {
        $('.section-title--mobile.active').not(this).each(function(i, section) {
            $(section).removeClass('active');
            $(section).next('section').slideUp('slow');
        });

        $(this).toggleClass('active');
        $(this).next('section').slideToggle('slow');
    });

    let stickyHeader = function () {
        if ($(window).scrollTop() > 0) {
            $('.header').addClass('header-scrolled');
        } else {
            $('.header').removeClass('header-scrolled');
        }
    }

    stickyHeader();

    $(window).on('scroll', function () {
        stickyHeader();
    });

    // jQuery('.odometer').each(function (i, el) {
    //     var o = new Odometer({
    //         el: el,
    //         value: el.getAttribute('data-value'),
    //         format: el.getAttribute('data-format')
    //     });
    //     // o.render();
    // });

    // Smooth scroll
    $('a[href^="#"]').on('click', function (event) {
        var selector = this.getAttribute('href').split('$');
        var target = '';

        if (selector[0] == '#') {
            target = $('html');
        } else {
            target = $(selector[0]);
        }

        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - parseInt(selector[1]) || 0
            }, 1000);
        }
    });

    // Expand images
    $('.expand-image').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        fixedContentPos: true,
        mainClass: 'mfp-with-zoom',
    });

    // Contact form interactions
    $('.wpcf7-form').on('submit', function (e) {
        let $this = $(this);
        let hasError = false;

        $this.find('.floatLabel').each(function (i, field) {
            var res = validateField(field);

            if (!hasError) {
                hasError = res;
            }
        })

        if (hasError) {
            e.preventDefault();

            if ($(window).width() < 768) {
                $('html, body').stop().animate({
                    scrollTop: $this.find('.has-error').first().offset().top - 110
                }, 1000);
            }
        }
    })

    $(document).on('blur', '.has-error .floatLabel', function () {
        validateField(this);
    })

    function validateField(field) {
        let $this = $(field);
        let $parent = $this.closest('.col');
        let type = $this.prop('type')
        let value = $this.val();

        $parent.removeClass('has-error');

        if (value == '') {
            // field is empty
            makeError($parent, 'Missing field.');
            return true;
        } else if (type == 'email' && !validateEmail(value)) {
            // invalid email address
            makeError($parent, 'Invalid email address.');
            return true;
        }

        return false;
    }

    function makeError($field, error) {
        $field.addClass('has-error');
        $field.find('.error-label').text(error)
    }

    function validateSubmitButton($form) {
        if ($form.find('has-error').length) {
            $form.find(':input[type=submit]').addClass('disable')
        } else {
            $form.find(':input[type=submit]').removeClass('disable')
        }
    }
})(jQuery);

// This example creates a simple polygon representing the Bermuda Triangle.

function initMap() {
    var mapStyles = [{
        stylers: [{
                hue: "#f4f4f4"
            },
            {
                saturation: "-100"
            },
            {
                lightness: "3"
            },
            {
                gamma: 1.51
            }
        ]
    }];

    // Define the LatLng coordinates for the polygon's path.
    var centrOparcCoords = [{
            lat: 45.719896,
            lng: -73.604289
        },
        {
            lat: 45.720496,
            lng: -73.603098
        },
        {
            lat: 45.718885,
            lng: -73.589687
        },
        {
            lat: 45.718323,
            lng: -73.588507
        },
        {
            lat: 45.717979,
            lng: -73.589226
        },
        {
            lat: 45.717971,
            lng: -73.591436
        },
        {
            lat: 45.717754,
            lng: -73.593646
        },
        {
            lat: 45.718970,
            lng: -73.603622
        },
        {
            lat: 45.719366,
            lng: -73.604389
        },
        {
            lat: 45.719896,
            lng: -73.604289
        }
    ];

    var centroparcMapType = new google.maps.StyledMapType(mapStyles, {
        name: "CentrOparc Map"
    });

    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(45.719285, -73.598147);
    var mapOptions = {
        zoom: 15,
        scrollwheel: false,
        center: latlng,
        zoomControl: true,
        scaleControl: false,
        streetViewControl: false,
        panControl: false,
        mapTypeControl: false,
        mapTypeId: 'centroparc_style'
    };

    $('.map-holder').each(function (i, el) {
        mapOptions.zoom = parseInt(el.getAttribute('data-zoom'));
        map = new google.maps.Map(el, mapOptions);
        map.mapTypes.set('centroparc_style', centroparcMapType);

        var marker = new google.maps.Marker({
            position: map.center,
            map: map,
            icon: '/wp-content/themes/centroparc/assets/images/marker.svg'
        });

        google.maps.event.addListener(marker, 'click', function () {
            window.open('https://goo.gl/maps/yGiWdFLXagk', 'new');
        });

        // Construct the polygon.
        var centrOparc = new google.maps.Polygon({
            paths: centrOparcCoords,
            strokeColor: '#EF7F11',
            strokeOpacity: 0.7,
            strokeWeight: 1,
            fillColor: '#EF7F11',
            fillOpacity: 0.1
        });
        centrOparc.setMap(map);
    })
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

if (document.querySelector('.wpcf7')) {
    document.querySelector('.wpcf7').addEventListener('wpcf7mailsent', function (e) {
        let $form = $(e.target).find('form');
        let $submit = $form.find(':input[type=submit]');
        $submit.val('Submitted').addClass('submitted');

        $form.find('label.active').removeClass('active');

        $submit.on('click', function (e) {
            e.preventDefault();
        })
    }, false);
}