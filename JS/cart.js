$(".giohang").click(function (event) {
    event.preventDefault();
    var soluong = $(this).find('input[name^="soluong"]').val();
    var isAvailable = $(this).data("available");
    if (isAvailable == 1 && soluong > 0) {
        $.ajax({
            type: "POST",
            url: "processcart.php?action=add",
            data: $(this).serializeArray(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.message);
                } else {
                    $("#cart-icon span").html(response.total_quantity);
                    alert(response.message);
                }
                $("#cart-icon a img").trigger("click");
            },
        });
    } else {
        alert("Sản phẩm đã hết hàng.");
    }
});

function updateQuantity(quantity) {
    if (quantity != "") {
        $.ajax({
            type: "POST",
            url: "processcart.php?action=update",
            data: $("#cart-form").serializeArray(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.message);
                } else {
                    alert(response.message);
                    $("#cart-icon span").html(response.total_quantity);
                    $.get("cart.php", function (cartContentHTML) {
                        $("#ajax-cart").html(cartContentHTML);
                    });
                }
            },
        });
    } else if (quantity == "") {
        alert("Vui lòng nhập số lượng mua");
        return;
    }
}

function deleteCart(productID) {
    $.ajax({
        type: "POST",
        url: "processcart.php?action=delete",
        data: {
            masp: productID,
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status == 0) {
                alert(response.message);
            } else {
                alert(response.message);
                $("#cart-icon span").html(response.total_quantity);
                $.get("cart.php", function (cartContentHTML) {
                    $("#ajax-cart").html(cartContentHTML);
                });
            }
        },
    });
}

$("#giohangdetail").validate({
    rules: {
        "soluong[<?php echo isset($row['masp']) ? $row['masp'] : 0 ?>]": {
            required: true,
            remote: {
                url: "checkquality.php",
                type: "POST",
            },
        },
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: "processcart.php?action=add",
            data: $(form).serializeArray(),
            success: function (response) {
                response = JSON.parse(response);
                if (response.status == 0) {
                    alert(response.message);
                } else {
                    $("#cart-icon span").html(response.total_quantity);
                    alert(response.message);
                }
                $("#cart-icon a img").trigger("click");
            },
        });
    },
});
