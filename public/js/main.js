/* --- Filter --- */
$("body").on("change", ".w_sidebar input", function () {
    let checked = $('.w_sidebar input:checked'),
        data = '';
    checked.each(function () {
       data += this.value + ",";
    });
    if (data) {
        $.ajax({
            url: location.href,
            type: "get",
            data: {filter: data},
            beforeSend: function (){
                $(".preloader").fadeIn(300, function () {
                   $(".product-one").hide();
                });
            },
            success: function (res) {
                $(".preloader").delay(500).fadeOut("slow", function () {
                    $(".product-one").html(res).fadeIn();

                    var url = location.search.replace(/filter(.+?)(&|$)/g, ''); //$2
                    var newURL = location.pathname + url + (location.search ? "&" : "?") + "filter=" + data;
                    newURL = newURL.replace('&&', '&');
                    newURL = newURL.replace('?&', '?');
                    history.pushState({}, '', newURL);

                });
            },
            error: function () {
                alert("Ошибка! Попробуйте позже.");
            }
        });
    } else {
        window.location = location.pathname;
    }

});

/* --- Typeahead --- */
var products = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        wildcard: '%QUERY',
        url: path + '/search/typeahead?query=%QUERY'
    }
});

products.initialize();

$("#typeahead").typeahead({
    // hint: false,
    highlight: true
},{
    name: 'products',
    display: 'title',
    limit: 10,
    source: products
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
    // console.log(suggestion);
    window.location = path + '/search/?s=' + encodeURIComponent(suggestion.title);
});


/* --- cart ---  */
$("body").on("click", ".add-to-cart-link", function (e) {
    e.preventDefault();
    let id = $(this).data("id"),
        qty = $(".quantity input").val() ? $(".quantity input").val() : 1,
        mod = $(".available select").val();

    $.ajax({
        url: "/cart/add",
        type: "get",
        data: {id: id, qty: qty, mod: mod},
        success: function (res) {
            showCard(res);
        },
        error: function () {
            alert("Ошибка! Попробуйте позже.");
        }
    });
});

$("#cart .modal-body").on("click", ".del-item", function () {
    let id = $(this).data("id");
    $.ajax({
        url: "/cart/delete",
        type: "get",
        data: {id: id},
        success: function (res) {
            showCard(res);
        },
        error: function () {
            alert("Ошибка! Попробуйте позже.");
        }
    });

});

function showCard(cart) {
    if ($.trim(cart) === "<h3> Корзина пуста </h3>") {
        $("#cart .modal-footer a, #cart .modal-footer .btn-danger").css("display", "none");
    } else {
        $("#cart .modal-footer a, #cart .modal-footer .btn-danger").css("display", "inline-block");
    }

    $("#cart .modal-body").html(cart);

    $("#cart").modal();

    if ( $(".cart-sum").text() ) {
        $(".simpleCart_total").html( $("#cart .cart-sum").text() );
    } else {
        $(".simpleCart_total").text("Empty Cart");
    }
}

function getCart(){
    $.ajax({
        url: "/cart/show",
        type: "get",
        success: function (res) {
            showCard(res);
        },
        error: function () {
            alert("Ошибка! Попробуйте позже.");
        }
    });
}

function clearCart() {
    $.ajax({
        url: "/cart/clear",
        type: "get",
        success: function (res) {
            showCard(res);
        },
        error: function () {
            alert("Ошибка! Попробуйте позже.");
        }
    });
}
/* --- cart ---  */

$("#currency").change(function () {
    window.location = "currency/change?curr=" + $(this).val();
});

$(".available select").change(function () {
    let modId = $(this).val(),
        color = $(this).find("option").filter(":selected").data("title"),
        price = $(this).find("option").filter(":selected").data("price"),
        basePrice = $("#base-price").data("base");
    
    if (price) {
        $("#base-price span").html(price);
    } else {
        $("#base-price span").html(basePrice);
    }
    
});