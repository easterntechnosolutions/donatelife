"use strict";
(function ($) {
    if($('#modal-popup').length > 0) {
		$('#modal-popup').modal('show');
		$('#modal-popup').on('hidden.bs.modal', function () {
			$('#modal-popup .modal-body').html('');
		});


		var windowWidth = $(window).width();
		if(windowWidth > 768){
		if($('#popup-image').length > 0){
			
			var img = $("#popup-image"); // Get my img elem
			var pic_real_width, pic_real_height;
			$("<img style = 'display:none;'>") // Make in memory copy of image to avoid css issues
				.attr("src", $(img).attr("src"))
				.load(function() {
					pic_real_width = this.width;   // Note: $(this).width() will not
					pic_real_height = this.height; // work for in memory images.
					var new_width = (550 * pic_real_width) / pic_real_height;
					$(img).css('width',new_width);

				});
			}
		}
	}

    function CounterNumberChanger() {
        var e = $(".sF-counter");
        e.length &&
            e.appear(function () {
                e.countTo();
            });
    }
    function teamCarosule() {
        $(".teamcarosule").length &&
            $(".teamcarosule").owlCarousel({
                loop: !0,
                margin: 30,
                nav: !0,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                dots: !1,
                items: 1,
                autoplay: !0,
                autoplayTimeout: 3e3,
                autoplayHoverPause: !0,
                responsive: { 0: { items: 1 }, 480: { items: 1 }, 600: { items: 2 }, 1e3: { items: 4 } },
            });
    }
    function clientCarosule() {
        $(".clientcarosule").length &&
            $(".clientcarosule").owlCarousel({
                loop: !0,
                margin: 0,
                nav: !0,
                navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                dots: !1,
                items: 3,
                autoplay: !0,
                autoplayTimeout: 3e3,
                autoplayHoverPause: !0,
                responsive: { 0: { items: 1 }, 480: { items: 1 }, 600: { items: 2 }, 1e3: { items: 3 }, 1200: { items: 3 } },
            });
    }
    function footercarosule() {
        $(".footercarosule").length &&
            $(".footercarosule").owlCarousel({
                loop: !0,
                margin: 0,
                nav: !1,
                dots: !0,
                items: 1,
                autoplay: !0,
                autoplayTimeout: 3e3,
                autoplayHoverPause: !0,
                responsive: { 0: { items: 1 }, 480: { items: 1 }, 600: { items: 1 }, 1e3: { items: 1 } },
            });
    }
    function enableMasonry() {
        if ($(".sortable-masonry").length) {
            var e = $(window),
                a = $(".sortable-masonry .items-container"),
                n = $(".filter-btns");
            a.isotope({ filter: "*", masonry: { columnWidth: 0 }, animationOptions: { duration: 500, easing: "linear" } }),
                n.find("li").on("click", function () {
                    var e = $(this).attr("data-filter");
                    try {
                        a.isotope({ filter: e, animationOptions: { duration: 500, easing: "linear", queue: !1 } });
                    } catch (e) { }
                    return !1;
                }),
                e.bind("resize", function () {
                    var e = n.find("li.active").attr("data-filter");
                    a.isotope({ filter: e, animationOptions: { duration: 500, easing: "linear", queue: !1 } });
                });
            var t = $(".filter-btns li");
            t.on("click", function () {
                var e = $(this);
                e.hasClass("active") || (t.removeClass("active"), e.addClass("active"));
            });
        }
    }
    function progressBarConfig() {
        var e = $(".progress");
        e.length &&
            e.each(function () {
                var e = $(this);
                e.appear(function () {
                    var a = e.data("value");
                    e.find(".progress-bar").animate({ width: a + "%" }, 100), e.find(".value").countTo({ from: 0, to: a, speed: 100 });
                });
            });
    }
    function mainmenu() {
        $(".main-menu .navigation li").hover(function () {
            $(this).children("ul").stop(!0, !1, !0).slideToggle(300);
        }),
            $(".main-menu .mobile-menu li.menu-item-has-children ul").length &&
            ($(".main-menu .mobile-menu li.menu-item-has-children").append('<div class="dropdown-btn"></div>'),
                $(".main-menu .mobile-menu li.menu-item-has-children .dropdown-btn").click(function () {
                    $(this).prev("ul").slideToggle(500);
                }));
    }
    function handlePreloader() {
        $(".preloader").length && $(".preloader").delay(200).fadeOut(500);
    }
    function headerStyle() {
        if ($(".main-header").length) {
            var e = $(".main-header").height();
            $(window).scrollTop() >= e ? ($(".bounce-in-header").addClass("now-visible"), $(".scroll-to-top").fadeIn(300)) : ($(".bounce-in-header").removeClass("now-visible"), $(".scroll-to-top").fadeOut(300));
        }
    }
    if (
        ($(".main-slider").length &&
            jQuery(".tp-banner")
                .show()
                .revolution({
                    delay: 7500,
                    startwidth: 1200,
                    startheight: 733,
                    hideThumbs: 600,
                    thumbWidth: 80,
                    thumbHeight: 50,
                    thumbAmount: 5,
                    navigationType: "bullet",
                    navigationArrows: "0",
                    navigationStyle: "preview1",
                    touchenabled: "on",
                    onHoverStop: "off",
                    swipe_velocity: 0.7,
                    swipe_min_touches: 1,
                    swipe_max_touches: 1,
                    drag_block_vertical: !1,
                    parallax: "mouse",
                    parallaxBgFreeze: "on",
                    parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
                    keyboardNavigation: "on",
                    navigationHAlign: "center",
                    navigationVAlign: "bottom",
                    navigationHOffset: 0,
                    navigationVOffset: 20,
                    soloArrowLeftHalign: "left",
                    soloArrowLeftValign: "center",
                    soloArrowLeftHOffset: 20,
                    soloArrowLeftVOffset: 0,
                    soloArrowRightHalign: "right",
                    soloArrowRightValign: "center",
                    soloArrowRightHOffset: 20,
                    soloArrowRightVOffset: 0,
                    shadow: 0,
                    fullWidth: "on",
                    fullScreen: "off",
                    spinner: "spinner4",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    forceFullWidth: "on",
                    hideThumbsOnMobile: "on",
                    hideNavDelayOnMobile: 1500,
                    hideBulletsOnMobile: "on",
                    hideArrowsOnMobile: "on",
                    hideThumbsUnderResolution: 0,
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    startWithSlide: 0,
                    videoJsPath: "",
                    fullScreenOffsetContainer: ".main-slider",
                }),
            $(".dial").length &&
            $(".dial").appear(
                function () {
                    var e = $(this),
                        a = e.attr("data-fgColor"),
                        n = e.attr("value");
                    e.knob({ value: 0, min: 0, max: 100, skin: "tron", readOnly: !0, thickness: 0.15, dynamicDraw: !0, displayInput: !1 }),
                        $({ value: 0 }).animate(
                            { value: n },
                            {
                                duration: 1e3,
                                easing: "swing",
                                progress: function () {
                                    e.val(Math.ceil(this.value)).trigger("change");
                                },
                            }
                        ),
                        $(this).append(function () {
                            e.parent().parent().find(".circular-bar-content").css("color", a),
                                e
                                    .parent()
                                    .parent()
                                    .find(".circular-bar-content label")
                                    .text(n + "%");
                        });
                },
                { accY: 20 }
            ),
            enableMasonry(),
            $("#countdown-timer").length &&
            $("#countdown-timer").countdown("2018/2/13", function (e) {
                $(this).html(
                    e.strftime(
                        '<div class="counter-column">Days<br><span class="count">%D</span></div> <div class="counter-column">Hour<br><span class="count">%H</span><span class="colon"></span></div>  <div class="counter-column">Mins<br><span class="count">%M</span><span class="colon"></span></div>  <div class="counter-column">Sec<br><span class="count">%S</span><span class="colon"></span></div>'
                    )
                );
            }),
            $(".scroll-to-target").length &&
            $(".scroll-to-target").on("click", function () {
                var e = $(this).attr("data-target");
                $("html, body").animate({ scrollTop: $(e).offset().top }, 1e3);
            }),
            headerStyle(),
            $(".contact-form").length &&
            $(".contact-form").validate({
                rules: {
                    username: { required: !0 },
                    lastname: { required: !0 },
                    email: { required: !0, email: !0 },
                    phone: { required: !0 },
                    message: { required: !0 },
                    date: { required: !0 },
                    category: { required: !0 },
                    website: { required: !0 },
                },
            }),
            $(".wow").length)
    ) {
        var wow = new WOW({ boxClass: "wow", animateClass: "animated", offset: 0, mobile: !1, live: !0 });
        wow.init();
    }
    $(".dial").length &&
        $(".dial").appear(
            function () {
                var e = $(this),
                    a = e.attr("data-fgColor"),
                    n = e.attr("value");
                e.knob({ value: 0, min: 0, max: 100, skin: "tron", readOnly: !0, thickness: 0.15, dynamicDraw: !0, displayInput: !1 }),
                    $({ value: 0 }).animate(
                        { value: n },
                        {
                            duration: 1e3,
                            easing: "swing",
                            progress: function () {
                                e.val(Math.ceil(this.value)).trigger("change");
                            },
                        }
                    ),
                    $(this).append(function () {
                        e.parent().parent().find(".circular-bar-content").css("color", a),
                            e
                                .parent()
                                .parent()
                                .find(".circular-bar-content label")
                                .text(n + "%");
                    });
            },
            { accY: 20 }
        ),
        jQuery(document).on("ready", function () {
            jQuery, CounterNumberChanger(), teamCarosule(), footercarosule(), enableMasonry(), clientCarosule(), progressBarConfig(), mainmenu(), handlePreloader();
        }),
        jQuery(window).on("load", function () {
            jQuery;
        }),
        (0, window.jQuery)(window).on("scroll", function () {
            headerStyle();
        });

        $('.politics .owl-carousel').owlCarousel({
            margin: 10,
            nav: true,
            navText: [
                "<i class='fa fa-chevron-left'></i>",
                "<i class='fa fa-chevron-right'></i>"
            ],
            loop: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });

        if($('.video-gallery').length > 0) {

            $('.video-gallery').lightGallery();
        }

        if($('#award_table').length > 0) {
            $('#award_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": ajax_obj.ajax_url,
                    "type": "POST",
                    "data": function(d) {
                        d.action = "fetch_awards_data"; // Set action for the WordPress AJAX call
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "award_name" },
                    { "data": "year" },
                    { "data": "authority" },
                    { "data": "pdf" },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "aoColumnDefs": [
                    { "sWidth": "10%", "aTargets": [ 4 ] },
                ]
            });
        }

        if( $('#donor_table').length > 0 ) {
            $('#donor_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": ajax_obj.ajax_url,
                    "type": "POST",
                    "data": function(d) {
                        d.action = "fetch_donor_data";
                        d.taxonomy_term = $('#donor_table').attr('data-term');
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "date" },
                    { "data": "receiver" },
                    { "data": "city" },
                    { "data": "transplant" },
                    { "data": "donor_name" },
                    { "data": "pdf" },
                    { "data": "other_links" },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "order":[1,'desc'],
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 6,7 ] },
                    { "sWidth": "30%", "aTargets": [ 4 ] },
                    { "sWidth": "10%", "aTargets": [ 6,7 ] },
                ]
            });
        }

        if($('#electronic_table').length > 0) {
            var table = $('#electronic_table').DataTable( {
                // "order": [[ 1, "desc" ]],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": ajax_obj.ajax_url,
                    "type": "POST",
                    "data": function(d) {
                        d.action = "fetch_electronic_data";
                        d.year = $('#year').val();  // Year filter
                        d.month = $('#month').val(); // Month filter
                        d.type = $('#type').val();   // Day filter
                        d.taxonomy_term = $('#electronic_table').attr('data-term');
                        
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "em_date" },
                    { "data": "description" },
                    { "data": "channel" },
                    { "data": "ytlink" },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "order":[1,'desc'],
                "columnDefs": [
                    { type: 'date-uk', targets: 0 }
                ]
            } );

            $('#filter_btn').on('click', function() {
                table.ajax.reload();  // Reload DataTables with new filters
            });

        }

        if($('#digital_table').length > 0) {
            $('#digital_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": ajax_obj.ajax_url,
                    "type": "POST",
                    "data": function(d) {
                        d.action = "fetch_digitalmedia_data";
                        d.taxonomy_term = $('#digital_table').attr('data-term');
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "date" },
                    { "data": "dm_name" },
                    { "data": "media" },
                    { "data": "link" },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "order":[1,'desc'],
                
            });
        }

        /**Press release datatable */
        if($('#pressrelease').length > 0) {
            $('#pressrelease').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": ajax_obj.ajax_url,
                    "type": "POST",
                    "data": function(d) {
                        d.action = "fetch_pressrelease_data";
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "date" },
                    { "data": "title" },
                ],
                "paging": true,
                "searching": true,
                "ordering": true,
                "order": [1,'desc'],
                "aoColumnDefs": [
                    { "sWidth": "10%", "aTargets": [ 0,1 ] },
                ]
            });
        }

        /**Video gallery tab */
       /*  $("#video-gallery").hip({
            itemsPerPage: 15,
            itemsPerRow: 3,
            filter:true,
            filterPos:"right",
            filterText:"Search",
            pagination:'',


        }); */

        $(document).on('click', '#video-gallery .load-more', function() {
            var button = $('.load-more');
            var offset = button.data('offset');
            var type = button.data('type');

            $.ajax({
                url: ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_videos',
                    offset: offset,
                    type: type,
                    search: $('#vg_srch').val(),
                },
                beforeSend: function() {
                    button.text('Loading...'); // Change button text while loading
                },
                success: function(response) {
                    if (response) {
                        button.remove();
                        $('#video-gallery').append(response);
                        
                    } else {
                        button.remove(); // Remove button if no more posts
                    }
                }
            });
        });

        //founder page video load more
        $(document).on('click', '#abt-video-gallery .load-more', function() {
            var button = $('.load-more');
            var offset = button.data('offset');
            var type = button.data('type');

            $.ajax({
                url: ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'abt_load_more_videos',
                    offset: offset,
                    type: type,
                    search: $('#vg_srch').val(),
                },
                beforeSend: function() {
                    button.text('Loading...'); // Change button text while loading
                },
                success: function(response) {
                    if (response) {
                        button.remove();
                        $('#abt-video-gallery').append(response);
                        // var newOffset = offset + 18; 
                        // button.data('offset', newOffset); // Update the button's offset
        
                        
                    } else {
                        button.remove(); // Remove button if no more posts
                    }
                }
            });
        });

        $(document).on('keypress', '#vg_srch', function() {
            // var button = $('.load-more');
            // var offset = button.data('offset');
            // var type = button.data('type');
            
            $.ajax({
                url: ajax_obj.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_more_videos',
                    offset: 0,
                    type: $('#vg_srch').attr('data-term'),
                    search: $('#vg_srch').val(),
                },
                beforeSend: function() {
                    //button.text('Loading...'); // Change button text while loading
                },
                success: function(response) {
                    console.log('success ',response);
                    $('.load-more').remove();
                    $('#video-gallery').html('');
                    $('#video-gallery').append(response);
                    
                    
                }
            });
        });
        
})(jQuery);