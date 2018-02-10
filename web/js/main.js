/*price range*/

$('#sl2').slider();

$('.catalog').accordion({
    heightStyle: 'content',
    animate: 200,
    active: 'none',
    collapsible: true
});

function showCard(card) {
    $('#card .modal-body').html(card);
    $('#card').modal();

}

function clearCard() {
    $.ajax({
        url: '/card/clear-card',
        type: 'GET',
        success: function (res) {
            showCard(res);
        },
        error: function (res) {
            alert('Error');
        }
    })
}

$('#card .modal-body').on('click', '.del-item', function () {
    var id = $(this).data('id');
    $.ajax({
        url: '/card/del-item',
        type: 'GET',
        data: {
            id: id,
        },
        success: function (res) {
            if (!res) alert('Ошибка');
            showCard(res);
        },
        error: function (res) {
            alert('Error');
        }
    })
})

function getCard() {
    $.ajax({
        url: '/card/show',
        type: 'GET',
        success: function (res) {
            showCard(res);
        },
        error: function (res) {
            alert('Error');
        }
    })
}

$('.add-to-cart').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        qty = $('#qty').val();
    $.ajax({
        url: '/card/add',
        data: {
            id: id,
            qty: qty
        },
        type: 'GET',
        success: function (res) {
            showCard(res);
        },
        error: function (res) {
            alert('Error')
        }
    })
})


var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});
