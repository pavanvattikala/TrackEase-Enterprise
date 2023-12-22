<x-sales>
  <style>
      .active{
          --bs-table-bg:#fdd0d0;
          font-weight: 600;
      }
  </style>
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <button class="btn nav-btn" data-search-type="all"><h3><i class="bi bi-asterisk"></i></h3></button>
              </li>
              <li class="nav-item">
                <button class="btn nav-btn" data-search-type="barcode"><h3><i class="bi bi-upc-scan"></i></h3></button>
              </li>
              <li class="nav-item">
                <button class="btn nav-btn" data-search-type="sku"><h3><i class="bi bi-hash"></i></h3></button>
              </li>
              <li class="nav-item">
                <button class="btn nav-btn" data-search-type="name"><h3><i class="bi bi-tag-fill"></i></h3></button>
              </li>
            </ul>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" id="search_by" class="form-control" placeholder="Search products by name, code, or barcode"/>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <br />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>
            <tbody id="products">
              <tr>
                <td colspan="4" id="noproducts" class="text-center">No Products Added</td>
              </tr>
            </tbody>

            <tfoot>
              <tr>
                <td colspan="4" id="subTotalAmt" class="text-end">Sub Total</td>
              </tr>
              <tr>
                <td colspan="4" id="discountAmt" class="text-end">Disocunt</td>
              </tr>
              <tr>
                <td colspan="4" id="taxAmt" class="text-end">Tax</td>
              </tr>
              <tr>
                <td colspan="4" id="grandTotalAmt" class="text-end">Total</td>
              </tr>
            </tfoot>

          </table>
        </div>
        <div class="col-md-6 options">
            <div class="row d-flex justify-content-between cart-options-1">
                <x-cart-options shortcut="F1" id="close" icon="bi bi-x-lg" name="Close" />
                <x-cart-options shortcut="F2" id="search" icon="bi bi-search" name="Search" />
                <x-cart-options shortcut="F3" id="quantity" icon="bi bi-basket-fill" name="Quantity" />
                <x-cart-options shortcut="F4" id="newSale" icon="bi bi-plus-lg" name="New Sale" />
            </div>
            <br />
            <div class="row text-center d-flex justify-content-between payment-options">
                <div class="col-md-6 border border-success p-3">
                  <p>Cash</p>
                </div>
                <div class="col-md-6 border border-success p-3">
                  <p>UPI</p>
                </div>
            </div>
            <div></div>
            <div class="cart-options-2">
                <div class="row d-flex justify-content-between">
                    <x-cart-options shortcut="F1" id="close1" icon="bi bi-percent" name="Discount" />
                    <x-cart-options shortcut="F2" id="close2" id="close" icon="bi bi-chat-left-dots" name="Comment" />
                    <x-cart-options shortcut="F3" id="close3" icon="bi bi-person-raised-hand" name="A1" />
                    <x-cart-options shortcut="F4" id="close4" icon="bi bi-inbox-fill" name="Cash Drawer" />
                </div>
                <div class="row d-flex justify-content-between">
                    <x-cart-options shortcut="F1" id="close5" icon="bi bi-floppy" name="Discount" />
                    <x-cart-options shortcut="F2" id="close6" icon="bi bi-eraser-fill" name="Comment" />
                    <x-cart-options class="bg-success" id="close7" shortcut="F3" icon="bi bi-person-raised-hand" name="F10 Payment" />
                </div>
                <div class="row d-flex justify-content-between">
                    <x-cart-options shortcut="F1" id="close8" icon="bi bi-floppy" name="Lock" />
                    <x-cart-options shortcut="F2" id="close9" icon="bi bi-eraser-fill" name="Transfer" />
                    <x-cart-options class="bg-danger" id="close10" shortcut="F3" icon="bi bi-person-raised-hand" name="Void Order" />
                    <x-cart-options shortcut="F4" id="close11" icon="bi bi-inbox-fill" name="..." />
                </div>
            </div>
        
      </div>
    </div>

    {{-- modal window for settign quantity --}}

    <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="quantityModalLabel">Change Quantity</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <!-- Display item name -->
                  <p>Item Name: <span id="ChangeQuantityitemName"></span></p>
  
                  <!-- Input for entering quantity -->
                  <label for="quantityInput" class="form-label">Enter Quantity:</label>
                  <input type="number" class="form-control" id="quantityInput" placeholder="Enter quantity" min="1" required>
              </div>
              <div class="modal-footer">
                  <!-- Button to set quantity -->
                  <button type="button" id="changeQuantityBtn" class="btn btn-primary">Set Quantity</button>
              </div>
          </div>
      </div>
  </div>




    <script>
      var getSaleItems = "{{ route('sale.get.items',[],false) }}";
      var getSaleItemData = "{{ route('sale.get.item.component',[],false) }}";
  </script>

<script src="{{ asset('custom/js/order.js') }}"></script>
</x-sales>
