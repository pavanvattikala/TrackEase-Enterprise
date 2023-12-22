var manageOrderTable;

var productsNames = [];

var products = [];

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
                productsNames.push(item.product_name);
                products.push({
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
        source: productsNames,
        autoFocus: true,
        select: function (event, ui) {
            item = ui.item.value;

            insertProduct(item);
        },
    });
});

function insertProduct(item) {
    setTimeout(function () {
        $("#search_by").val("");
    }, 300);

    $("#noproducts").remove();

    var selectedProduct = products.find(
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

$(document).on("click", ".saleItem", function () {
    var id = this.id.replace("item", ""); // Fix typo in 'replace'
    $(this).toggleClass("active");
    $("#close").toggleClass("bg-danger");
    $("#close").attr("onclick", "deleteItem(" + id + ")"); // Assign 'deleteItem' as an event handler

    $("#quantity").attr("onclick", "showQuantityModal(" + id + ")");
});

// Corrected deleteItem function
function deleteItem(id) {
    // Implement your delete logic here using the 'id'
    console.log("Deleting item with ID:", id);
    $("#item" + id).remove();
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

function setQuantity(id) {
    var newQuantity = $("#quantityInput").val();

    var prevQuantity = $("#item" + id + " > #item_quantity").text(newQuantity);

    $("#quantityModal").modal("hide");
}

function getSaleItemInfo(id) {
    var selectedProduct = products.find((product) => product.product_id === id);

    return selectedProduct;
}

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

document
    .getElementById("quantityInput")
    .addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            // Trigger the button click event
            document.getElementById("changeQuantityBtn").click();
        }
    });

function addRow() {
    $(".nav-btn").click(function () {
        $(".nav-btn").removeClass("active bg-primary");
        $(this).addClass("active bg-primary");

        var buttonType = $(this).data("search-type");

        var searchMessage = "";

        if (buttonType === "all") {
            searchMessage = "search By Name, Sku, Barcode";
        } else if (buttonType === "sku") {
            searchMessage = "search By Sku";
        } else if (buttonType === "name") {
            searchMessage = "search By Name";
        } else if (buttonType === "barcode") {
            searchMessage = "search By Barcode";
        }

        $("#search_by").attr("placeholder", searchMessage);

        // Trigger the input event to update the search results immediately
        $("#search_by").trigger("input");
    });
    $("#addRowBtn").button("loading");

    var tableLength = $("#productTable tbody tr").length;

    var tableRow;
    var arrayNumber;
    var count;

    if (tableLength > 0) {
        tableRow = $("#productTable tbody tr:last").attr("id");
        arrayNumber = $("#productTable tbody tr:last").attr("class");
        count = tableRow.substring(3);
        count = Number(count) + 1;
        arrayNumber = Number(arrayNumber) + 1;
    } else {
        // no table row
        count = 1;
        arrayNumber = 0;
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/product/fetchProductData",
        type: "post",
        dataType: "json",
        success: function (response) {
            $("#addRowBtn").button("reset");

            var tr =
                '<tr id="row' +
                count +
                '" class="' +
                arrayNumber +
                '">' +
                "<td>" +
                '<div class="form-group">' +
                '<select data-live-search="true" class="form-control" name="productName[]" id="productName' +
                count +
                '" onchange="getProductData(' +
                count +
                ')" >' +
                '<option value="">~~SELECT~~</option>';
            // console.log(response);
            $.each(response, function (index, value) {
                tr +=
                    '<option value="' +
                    value.product_id +
                    '">' +
                    value.product_name +
                    "</option>";
            });

            tr +=
                "</select>" +
                "</div>" +
                "</td>" +
                '<td style="padding-left:20px;"">' +
                '<input type="text" name="rate[]" id="rate' +
                count +
                '" autocomplete="off" disabled="true" class="form-control" />' +
                '<input type="hidden" name="rateValue[]" id="rateValue' +
                count +
                '" autocomplete="off" class="form-control" />' +
                '</td style="padding-left:20px;">' +
                '<td style="padding-left:20px;">' +
                '<div class="form-group">' +
                '<input type="number" name="quantity[]" id="quantity' +
                count +
                '" onkeyup="subAmount()" autocomplete="off" class="form-control" min="1" step="0.01" />' +
                "</div>" +
                "</td>" +
                '<td style="padding-left:20px;">' +
                '<input type="text" name="total[]" id="total' +
                count +
                '" autocomplete="off" class="form-control" disabled="true" />' +
                '<input type="hidden" name="totalValue[]" id="totalValue' +
                count +
                '" autocomplete="off" class="form-control" />' +
                "</td>" +
                "<td>" +
                '<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(' +
                count +
                ')"><i class="glyphicon glyphicon-trash"></i></button>' +
                "</td>" +
                "</tr>";
            if (tableLength > 0) {
                $("#productTable tbody tr:last").after(tr);
            } else {
                $("#productTable tbody").append(tr);
            }

            $("select").selectpicker("refresh");
        }, // /success
    }); // get the product data
} // /add row

// to delete the row
function removeProductRow(row = null) {
    if (row) {
        $("#row" + row).remove();

        subAmount();
    } else {
        alert("error! Refresh the page again");
    }
}

// select on product data
function getProductData(row = null) {
    if (row) {
        var productId = $("#productName" + row).val();

        if (productId == "") {
            $("#rate" + row).val("");

            $("#quantity" + row).val("");
            $("#total" + row).val("");
        } else {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                url: "/product/fetchSelectedProduct",
                type: "post",
                data: { productId: productId },
                dataType: "json",
                success: function (response) {
                    // setting the rate value into the rate input field
                    //console.log(response);

                    $("#rate" + row).val(response.selling_price);
                    $("#rateValue" + row).val(response.selling_price);

                    $("#quantity" + row).val(1);

                    subAmount();
                }, // /success
            }); // /ajax function to fetch the product data
        }
    } else {
        alert("no row! please refresh the page");
    }
}
// /sub total amount
function subAmount() {
    var tableProductLength = $("#productTable tbody tr").length;
    //console.log(tableProductLength);
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#productTable tbody tr")[x];
        //console.log(tr);
        rate = $(tr).find("td:eq(1) input").val();
        quantity = $(tr).find("td:eq(2) input").val();
        // adding to total value
        $("#total" + Number(x + 1)).val(Number(rate * quantity));
        $("#totalValue" + Number(x + 1)).val(Number(rate * quantity));
        var count = $(tr).attr("id");
        //console.log(count);
        count = count.substring(3);
        totalSubAmount =
            Number(totalSubAmount) + Number($("#total" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    //alert(totalSubAmount);

    $("#subTotal").val(totalSubAmount);
    $("#subTotalValue").val(totalSubAmount);

    calculateAllAmount();
}
// function to calculate the values down the sub amount
function calculateAllAmount() {
    subTotal = $("#subTotal").val();

    totalAmount = Number(subTotal);

    $("#totalAmount").val(totalAmount);
    $("#totalAmountValue").val(totalAmount);

    //calculate discount

    discount = Number($("#discount").val());

    var afterDiscount = totalAmount - discount;

    $("#grandTotal").val(afterDiscount.toFixed(2));
    $("#grandTotalValue").val(afterDiscount.toFixed(2));

    paidAmount = $("#paid").val();

    dueAmount = (afterDiscount - paidAmount).toFixed(2);

    $("#due").val(dueAmount);
    $("#dueValue").val(dueAmount);
}
// reset order form
function resetOrderForm() {
    // reset the input field
    $("#createOrderForm")[0].reset();
    // remove remove text danger
    $(".text-danger").remove();
    // remove form group error
    $(".form-group").removeClass("has-success").removeClass("has-error");
}
//order delte
function removeOrder(orderId) {
    if (orderId) {
        $("#removeOrderForm").append(
            '<input type="hidden" name="orderId" id="formRemoveOrderId"value="' +
                orderId +
                '">'
        );
    } else {
        alert("error!! Refresh the page again");
    }
}
