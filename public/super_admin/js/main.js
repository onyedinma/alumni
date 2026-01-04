(function ($) {
    "use strict";
    /*-------------------------------------------
  preloader active
  --------------------------------------------- */
    // jQuery(window).on("load", function () {
    //   jQuery(".preloader").fadeOut("slow");
    // });

    /*-------------------------------------------
  Sticky Header
  --------------------------------------------- */
    var lastScroll = 0;
    var isScrolled = false;
    window.dt = new DataTransfer();

    window.addEventListener("scroll", function () {
        var header = document.querySelector(".header-area");
        if (header) {
            var currentScroll =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop ||
                0;
            var scrollDirection = currentScroll < lastScroll;
            var shouldToggle = isScrolled && scrollDirection;

            if (currentScroll === 0) {
                header.classList.remove("stick");
            } else {
                isScrolled = true;
                header.classList.toggle("stick", shouldToggle);
            }

            lastScroll = currentScroll;
        }
    });

    jQuery(document).ready(function () {
        /*-------------------------------------------
    js scrollup
    --------------------------------------------- */
        // $.scrollUp({
        //     scrollText: '<i class="fa fa-angle-up"></i>',
        //     easingType: "linear",
        //     scrollSpeed: 900,
        //     animation: "fade",
        // });
        /*-------------------------------------------
      price-slider active
    --------------------------------------------- */
        // var otp_inputs = document.querySelectorAll(".otp__digit");
        // var mykey = "0123456789".split("");
        // otp_inputs.forEach((_) => {
        //   _.addEventListener("keyup", handle_next_input);
        // });
        // function handle_next_input(event) {
        //   let current = event.target;
        //   let index = parseInt(current.classList[1].split("__")[2]);
        //   current.value = event.key;
        //   if (event.keyCode == 8 && index > 1) {
        //     current.previousElementSibling.focus();
        //   }
        //   if (index < 6 && mykey.indexOf("" + event.key + "") != -1) {
        //     var next = current.nextElementSibling;
        //     next.focus();
        //   }
        //   var _finalKey = "";
        //   for (let { value } of otp_inputs) {
        //     _finalKey += value;
        //   }
        // }
    });
})(jQuery);

(function ($) {
    "use strict";

    var Medi = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {
                this.Preloader();
                this.StickyHeader();
                this.Tools();
                // this.PopupGallery();
                this.BackgroundImage();
                this.MobileMenu();
                this.EventPayMent();
                this.Select();
                this.Editor();
                // this.PostPhotoCount();
                this.DateRangePicker();
                this.Message();
                this.FilUpLoad();
                this.PriceSlide();
                this.PriceToggle();
            },
            PriceToggle: function () {
                $(document).ready(function () {
                    $("#billingMonthly-tab").click(function () {
                        $(".priceAmount-monthly").removeClass("d-none").addClass("d-block");
                        $(".priceAmount-yearly").removeClass("d-block").addClass("d-none");
                        $(".package-type-yearly-monthly").val(1);
                    });

                    $("#billingYearly-tab").click(function () {
                        $(".priceAmount-monthly").removeClass("d-block").addClass("d-none");
                        $(".priceAmount-yearly").removeClass("d-none").addClass("d-block");
                        $(".package-type-yearly-monthly").val(2);
                    });
                });
            },
            PriceSlide: function () {
                var swiper = new Swiper(".ld-price-plan-wrap", {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 24,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 24,
                        },
                    },
                });
            },
            Preloader: function () {
                $("#preloader-status").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
                $("body").delay(350);
            },
            StickyHeader: function () {
                $(window).on("scroll", function () {
                    var scroll = $(window).scrollTop();
                    if (scroll < 100) {
                        $(".inner-header").removeClass("sticky");
                    } else {
                        $(".inner-header").addClass("sticky");
                    }
                });
            },
            Tools: function () {
                $("input.date-time-picker").each(function () {
                    $(this)
                        .closest(".primary-form-group-wrap")
                        .addClass("calendarIcon"); // Add your custom class here
                });
                $(".ld-testi-wrap").isotope({
                    itemSelector: ".testi-item",
                    masonry: {
                        isFitWidth: true,
                        gutter: 24,
                    },
                });
            },
            PopupGallery: function () {
                $(document)
                    .find(".gallery")
                    .each(function () {
                        $(this).magnificPopup({
                            delegate: "a",
                            type: "image",
                            showCloseBtn: false,
                            preloader: false,
                            gallery: {
                                enabled: true,
                            },
                            callbacks: {
                                elementParse: function (item) {
                                    if (item.el[0].className == "video") {
                                        item.type = "iframe";
                                    } else {
                                        item.type = "image";
                                    }
                                },
                            },
                        });
                    });
            },
            BackgroundImage: function () {
                $("[data-background]").each(function () {
                    $(this).css(
                        "background-image",
                        "url(" + $(this).attr("data-background") + ")"
                    );
                });
            },
            MobileMenu: function () {
                $(".mobileMenu").on("click", function () {
                    $(".zSidebar").addClass("menuClose");
                });
                $(".zSidebar-overlay").on("click", function () {
                    $(".zSidebar").removeClass("menuClose");
                });
                // Menu arrow
                $(".zSidebar-menu li a").each(function () {
                    if (
                        $(this).next("div").find("ul.zSidebar-submenu li")
                            .length > 0
                    ) {
                        $(this).addClass("has-subMenu-arrow");
                    }
                });
            },
            EventPayMent: function () {
                $(document).on("click", ".paymentItem", function () {
                    $(this)
                        .closest("ul")
                        .find(".paymentItem-input")
                        .prop("checked", false);
                    $(this).find(".paymentItem-input").prop("checked", true);
                });
            },
            Select: function () {
                // when need select with search field
                $(".sf-select").select2({
                    dropdownCssClass: "sf-select-dropdown",
                    selectionCssClass: "sf-select-section",
                    // minimumResultsForSearch: -1,
                });
                // when don't need search field but can't use in modal
                $(".sf-select-two").select2({
                    dropdownCssClass: "sf-select-dropdown",
                    selectionCssClass: "sf-select-section",
                    minimumResultsForSearch: -1,
                });
                // when don't need search field and can use in modal
                $(".sf-select-without-search").niceSelect();
                // when need search in modal
                $(".sf-select-modal").select2({
                    dropdownCssClass: "sf-select-dropdown",
                    selectionCssClass: "sf-select-section",
                    dropdownParent: $(".modal"),
                });
            },
            Editor: function () {
                $(".summernoteOne").summernote({
                    placeholder: "Write...",
                    tabsize: 2,
                    minHeight: 183,
                    toolbar: [
                        // ["style", ["style"]],
                        // ["view", ["undo", "redo"]],
                        // ["fontname", ["fontname"]],
                        // ["fontsize", ["fontsize"]],
                        // ["font", ["bold", "italic", "underline"]],
                        // ["para", ["ul", "ol", "paragraph"]],
                        // ["color", ["color"]],
                        ["font", ["bold", "italic", "underline"]],
                        ["para", ["ul", "ol", "paragraph"]],
                    ],
                });
            },
            PostPhotoCount: function () {
                $(document)
                    .find("ul.postPhotoItems")
                    .each(function () {
                        var $ul = $(this);
                        var $li = $ul.find("li");
                        var liCount = $li.length;

                        if (liCount > 3) {
                            $li.eq(2)
                                .find("a")
                                .append(
                                    "<div class='morePhotos'>+" +
                                        (liCount - 1) +
                                        "</div>"
                                );
                        }
                    });

                $(document)
                    .find("ul.postPhotoItems")
                    .each(function () {
                        var liCount = $(this).find("li").length;

                        if (liCount === 1) {
                            $(this).addClass("postPhotoItems-one");
                        } else if (liCount === 2) {
                            $(this).addClass("postPhotoItems-two");
                        } else if (liCount === 3) {
                            $(this).addClass("postPhotoItems-three");
                        } else if (liCount > 3) {
                            $(this).addClass("postPhotoItems-multi");
                        }
                    });
            },
            DateRangePicker: function () {
                $(".date-time-picker").daterangepicker({
                    singleDatePicker: true,
                    timePicker: true,
                    locale: {
                        format: "Y-M-D h:mm",
                    },
                });
            },
            Message: function () {
                // For Message
                const userChats = document.querySelectorAll(".user-chat");
                const chatMessages = document.querySelectorAll(
                    ".content-chat-message-user"
                );

                userChats.forEach((userChat) => {
                    userChat.addEventListener("click", () => {
                        const selectedId = userChat.getAttribute("data-id");

                        chatMessages.forEach((chatMessage) => {
                            const messageId =
                                chatMessage.getAttribute("data-id");

                            if (messageId === selectedId) {
                                chatMessage.classList.add("active");
                            } else {
                                chatMessage.classList.remove("active");
                            }
                        });

                        userChats.forEach((chat) => {
                            chat.classList.remove("active");
                        });
                        userChat.classList.add("active");
                        loadMorePageCount = 0;
                        loadSingleUserChat(
                            $("#single-user-chat-route").val(),
                            loadMorePageCount,
                            0,
                            1
                        );
                    });

                    // Activate the first user-chat element initially
                    userChats[0].classList.add("active");
                    chatMessages[0].classList.add("active");
                });
            },
            FilUpLoad: function () {
                // File attachment

                $("#mAttachment,#mAttachment1").on("change", function (e) {
                    for (var i = 0; i < this.files.length; i++) {
                        let fileBloc = $("<span/>", { class: "file-block" }),
                            fileName = $("<p/>", {
                                class: "name",
                                text: this.files.item(i).name,
                            });
                        fileBloc
                            .append(
                                '<span class="file-icon"><i class="fa-solid fa-file"></i></span>'
                            )
                            .append(fileName)
                            .append(
                                '<span class="file-delete"><i class="fa-solid fa-xmark"></i></span>'
                            );
                        $(document)
                            .find("#filesList > #files-names")
                            .append(fileBloc);
                    }

                    for (let file of this.files) {
                        dt.items.add(file);
                    }

                    this.files = dt.files;

                    $(document).on("click", "span.file-delete", function () {
                        let name = $(this).next("span.name").text();

                        $(this).parent().remove();
                        for (let i = 0; i < dt.items.length; i++) {
                            if (name === dt.items[i].getAsFile().name) {
                                dt.items.remove(i);
                                continue;
                            }
                        }
                    });
                });

                $(document).on("change", "#mAttachment3", function (e) {
                    for (var i = 0; i < this.files.length; i++) {
                        let fileBloc = $("<span/>", { class: "file-block" }),
                            fileName = $("<p/>", {
                                class: "name",
                                text: this.files.item(i).name,
                            });
                        fileBloc
                            .append(
                                '<span class="file-icon"><i class="fa-solid fa-file"></i></span>'
                            )
                            .append(fileName)
                            .append(
                                '<span class="file-delete"><i class="fa-solid fa-xmark"></i></span>'
                            );
                        $(document)
                            .find("#filesList2 > #files-names2")
                            .append(fileBloc);
                    }

                    for (let file of this.files) {
                        dt.items.add(file);
                    }

                    this.files = dt.files;

                    $(document).on("click", "span.file-delete", function () {
                        let name = $(this).next("span.name").text();

                        $(this).parent().remove();
                        for (let i = 0; i < dt.items.length; i++) {
                            if (name === dt.items[i].getAsFile().name) {
                                dt.items.remove(i);
                                continue;
                            }
                        }
                    });
                });
            },
        },
    };
    jQuery(document).ready(function () {
        Medi.init();
    });
})(jQuery);
