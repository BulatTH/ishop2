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