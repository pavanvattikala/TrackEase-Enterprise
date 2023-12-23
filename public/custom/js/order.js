var autoCompleteNames = [];

var items = [];

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
                if (item.product_id != null) {
                    autoCompleteNames.push(item.product_name);
                    items.push({
                        id: "p" + item.product_id,
                        name: item.product_name,
                    });
                } else {
                    autoCompleteNames.push(item.service_name);
                    items.push({
                        id: "s" + item.service_id,
                        name: item.service_name,
                    });
                }
            });
        },
        error: function (error) {
            console.log(error);
        },
    });

    // autocomplete ui
    $("#search_by").autocomplete({
        source: autoCompleteNames,
        autoFocus: true,
        select: function (event, ui) {
            item = ui.item.value;

            insertProduct(item);
        },
    });
});

// to insert product in products table
function insertProduct(itemName) {
    setTimeout(function () {
        $("#search_by").val("");
    }, 300);

    $("#noproducts").remove();

    var selectedItem = getItemUsingName(itemName);

    if (selectedItem.id.startsWith("s")) {
        showServicePriceModal(selectedItem);

        return;
    }

    if ($("#item" + selectedItem.id).length > 0) {
        var oldItem = $("#item" + selectedItem.id);

        var prevQuantity = oldItem.find("#item_quantity").text();

        var price = oldItem.find("#item_selling_price").text();

        var newQuantity = Number(prevQuantity) + 1;
        var newAmount = newQuantity * price;

        oldItem.find("#item_quantity").text(newQuantity);

        oldItem.find("#item_selling_price").text();
        oldItem.find("#item_amount").text(newAmount);

        updateTotalAmounts();
        focusSearchBy();

        return;
    }

    $.ajax({
        url: getSaleItemData,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            itemId: selectedItem.id.replace("p", ""),
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
    focusSearchBy();
}

// toggle active class on sale Item and close & quantity functions
$(document).on("click", ".saleItem", function () {
    var id = this.id.replace("item", ""); // Fix typo in 'replace'

    if (!$(this).hasClass("active")) {
        $(".saleItem").removeClass("active");
        $(this).addClass("active");
        $("#deleteItem").addClass("bg-danger");
        $("#deleteItem").attr("onclick", "deleteItem('" + id + "')");
        $("#quantity").attr("onclick", "showQuantityModal('" + id + "')");
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
    var selectedProduct = getItemUsingId(id);
    console.log(selectedProduct);
    $("#quantityModalLabel").text("Change Quantity of " + selectedProduct.name);

    var prevQuantity = $("#item" + id + " > #item_quantity").text();

    $("#ChangeQuantityitemName").text(selectedProduct.name);

    $("#quantityModalInput").val(prevQuantity);

    $("#quantityModalSubmitBtn").attr("onclick", "setQuantity('" + id + "')");

    $("#quantityModal").modal("show");

    setTimeout(function () {
        var inputField = document.getElementById("quantityModalInput");

        inputField.focus();

        inputField.select();
    }, 500);
}

//set quantity for product id
function setQuantity(id) {
    var newQuantity = $("#quantityModalInput").val();

    var prevQuantity = $("#item" + id + " > #item_quantity").text(newQuantity);

    $("#quantityModal").modal("hide");

    updateTotalAmounts();
}

// get item data using id
function getItemUsingId(id) {
    console.log(id);
    var item = items.find((item) => item.id === id);

    return item;
}

function getItemUsingName(name) {
    var selectedItem = items.find((item) => item.name === name);

    return selectedItem;
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
    .getElementById("quantityModalInput")
    .addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            // Trigger the button click event
            document.getElementById("quantityModalSubmitBtn").click();
        }
    });

document
    .getElementById("serviceModalInput")
    .addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            // Trigger the button click event
            var service_name = $("#service_name").text();
            var service_id = $("#service_id").text().replace("s", "");
            var service_price = $("#serviceModalInput").val();
            insertService(service_id, service_price);
            $("#serviceModal").modal("hide");
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

function showServicePriceModal(service) {
    var selectedItem = getItemUsingId(service.id);
    console.log(selectedItem);

    $("#serviceModalInput").val("");
    $("#ServiceModalLabel").text("Set Price of " + selectedItem.name);

    $("#service_name").text(service.name);
    $("#service_id").text(service.id);

    $("#serviceModal").modal("show");

    setTimeout(function () {
        var inputField = document.getElementById("serviceModalInput");

        inputField.focus();
    }, 500);
}

function insertService(service_id, service_price) {
    $.ajax({
        url: getSaleItemData,
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            itemId: service_id,
            service_price: service_price,
            itemType: "service",
        },
        success: function (response) {
            $("#products").append(response);
            updateTotalAmounts();
            focusSearchBy();
        },
        error: function (error) {
            console.error("Error inserting product:", error);
        },
    });
}

function focusSearchBy() {
    var inputField = document.getElementById("search_by");

    inputField.focus();
}
