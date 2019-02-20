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

function showCard(cart) {
    console.log( cart );
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