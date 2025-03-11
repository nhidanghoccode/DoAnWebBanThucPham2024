(function ($) {
    "use strict";
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);

    $(window).scroll(function () {
        if ($(window).width() < 992) {
            if ($(this).scrollTop() > 55) {
                $('.fixed-top').addClass('shadow');
            } else {
                $('.fixed-top').removeClass('shadow');
            }
        }// else {
        //     if ($(this).scrollTop() > 55) {
        //         $('.fixed-top').addClass('shadow').css('top', -55);
        //     } else {
        //         $('.fixed-top').removeClass('shadow').css('top', 0);
        //     }
        // } 
    });
    
    
   // Nút quay lại đầu trang
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // // Băng chuyền qua lại giữ các sản phẩm
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:2
            },
            1200:{
                items:2
            }
        }
    });


    // Băng chuyền của Rau
    $(".vegetable-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

})(jQuery);

// PHẦN SILE SHOW
const imgPo=document.querySelectorAll(".aspect-ratio-169 img")
const imgCo=document.querySelector(".aspect-ratio-169")
let imgNum=imgPo.length
let index = 0

imgPo.forEach(function(img,index){
    img.style.left=index*100 + "%"
});

function imgSile(){
    index++
    if(index>=imgNum){
        index=0
    }
    imgCo.style.left = "-" +index*100+"%"
    sileder(index)
}
function sileder(index){
    imgCo.style.left = "-" +index*100+"%"

}
setInterval(imgSile,3000)//setInterval: lặp lại 1 khối code sau một khoản tg nhất định


