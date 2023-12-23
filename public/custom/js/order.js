var saleItemsNames = [];

var saleItems = [];

// to load the data table
$(document).ready(function () {
    // get all sale items
    $.ajax({
        url: getSaleItems,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (data) {
            var dataArray = JSON.parse(data);

            dataArray.forEach(function (item) {
                saleItemsNames.push(item.product_name);
                saleItems.push({
                    product_id: item.product_id,
                    product_name: item.product_name,
                });
            });
        },
        error: function (error) {
            console.log(error);
        },
    });

    // autocomplete ui
    $("#search_by").autocomplete({
        source: saleItemsNames,
        autoFocus: true,
        select: function (event, ui) {
            item = ui.item.value;

            insertProduct(item);
        },
    });
});

// to insert product in products table
function insertProduct(item) {
    setTimeout(function () {
        $("#search_by").val("");
    }, 300);

    $("#noproducts").remove();

    var selectedProduct = saleItems.find(
        (product) => product.product_name === item
    );

    if ($("#item" + selectedProduct.product_id).length > 0) {
        var oldItem = $("#item" + selectedProduct.product_id);

        var prevQuantity = oldItem.find("#item_quantity").text();

        var price = oldItem.find("#item_selling_price").text();

        var newQuantity = Number(prevQuantity) + 1;
        var newAmount = newQuantity * price;

        oldItem.find("#item_quantity").text(newQuantity);

        oldItem.find("#item_selling_price").text();
        oldItem.find("#item_amount").text(newAmount);

        updateTotalAmounts();

        return;
    }

    $.ajax({
        url: getSaleItemData,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            itemId: selectedProduct.product_id,
            itemType: "product",
        },
        success: function (response) {
            $("#products").append(response);
            updateTotalAmounts();
        },
        error: function (error) {
            console.error("Error inserting product:", error);
        },
    });
}

// toggle active class on sale Item and close & quantity functions
$(document).on("click", ".saleItem", function () {
    var id = this.id.replace("item", ""); // Fix typo in 'replace'

    if (!$(this).hasClass("active")) {
        $(".saleItem").removeClass("active");
        $(this).addClass("active");
        $("#deleteItem").addClass("bg-danger");
        $("#deleteItem").attr("onclick", "deleteItem(" + id + ")");
        $("#quantity").attr("onclick", "showQuantityModal(" + id + ")");
    } else {
        // If the clicked item is already active, remove the active state
        $(this).removeClass("active");
        $("#deleteItem").removeClass("bg-danger");
        $("#deleteItem").removeAttr("onclick");
        $("#quantity").removeAttr("onclick");
    }
});

// delete Item
function deleteItem(id) {
    // Implement your delete logic here using the 'id'
    console.log("Deleting item with ID:", id);
    $("#item" + id).remove();
    $("#deleteItem").removeClass("bg-danger");
    $("#quantity").removeAttr("onclick");
    updateTotalAmounts();
}

// Open the modal
function showQuantityModal(id) {
    var selectedProduct = getSaleItemInfo(id);
    console.log(selectedProduct);
    $("#quantityModalLabel").text(
        "Change Quantity of " + selectedProduct.product_name
    );

    var prevQuantity = $("#item" + id + " > #item_quantity").text();

    $("#ChangeQuantityitemName").text(selectedProduct.product_name);

    $("#quantityInput").val(prevQuantity);

    $("#changeQuantityBtn").attr("onclick", "setQuantity(" + id + ")");

    $("#quantityModal").modal("show");

    setTimeout(function () {
        var inputField = document.getElementById("quantityInput");

        inputField.focus();

        inputField.select();
    }, 500);
}

//set quantity for product id
function setQuantity(id) {
    var newQuantity = $("#quantityInput").val();

    var prevQuantity = $("#item" + id + " > #item_quantity").text(newQuantity);

    $("#quantityModal").modal("hide");

    updateTotalAmounts();
}

// get sale item data using id
function getSaleItemInfo(id) {
    var selectedProduct = saleItems.find(
        (product) => product.product_id === id
    );

    return selectedProduct;
}

// update total amounts
function updateTotalAmounts() {
    var subTotal = 0;

    // Iterate over each sale item
    $(".saleItem").each(function () {
        var quantity = parseInt($(this).find("#item_quantity").text());
        var sellingPrice = parseFloat(
            $(this).find("#item_selling_price").text()
        );
        var itemTotal = quantity * sellingPrice;

        // Update the subtotal
        subTotal += itemTotal;
    });

    // Calculate discount, tax, and grand total (you need to implement your logic here)
    var discount = 0;
    var tax = 0;
    var grandTotal = subTotal - discount + tax;

    // Update the values in the HTML
    $("#subTotalAmt").text("Sub Total: " + subTotal.toFixed(2));
    $("#discountAmt").text("Discount: " + discount.toFixed(2));
    $("#taxAmt").text("Tax: " + tax.toFixed(2));
    $("#grandTotalAmt").text("Total: " + grandTotal.toFixed(2));
}

// accept enter key as input in set quantity
document
    .getElementById("quantityInput")
    .addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            // Trigger the button click event
            document.getElementById("changeQuantityBtn").click();
        }
    });

// reset products table form
$(document).on("click", "#discardOrder", function () {
    var noData =
        '<tr><td colspan="4" id="noproducts" class="text-center">No Products Added</td></tr>';
    $("#products").empty();
    updateTotalAmounts();
    $("#products").append(noData);
});
