
<x-sales>
    <header>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#"><h3><i class="bi bi-asterisk"></i></h3></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><h3><i class="bi bi-upc-scan"></i></h3></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><h3><i class="bi bi-hash"></i></h3></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><h3><i class="bi bi-tag-fill"></i></h3></a>
              </li>
            </ul>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" class="form-control" placeholder="Search products by name, code, or barcode"/>
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
          </table>
        </div>
        <div class="col-md-6 options">
            <div class="row d-flex justify-content-between cart-options-1">
                <x-cart-options shortcut="F1" icon="bi bi-x-lg" name="Close" />
                <x-cart-options shortcut="F2" icon="bi bi-search" name="Search" />
                <x-cart-options shortcut="F3" icon="bi bi-basket-fill" name="Quantity" />
                <x-cart-options shortcut="F4" icon="bi bi-plus-lg" name="New Sale" />
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
                    <x-cart-options shortcut="F1" icon="bi bi-percent" name="Discount" />
                    <x-cart-options shortcut="F2" icon="bi bi-chat-left-dots" name="Comment" />
                    <x-cart-options shortcut="F3" icon="bi bi-person-raised-hand" name="A1" />
                    <x-cart-options shortcut="F4" icon="bi bi-inbox-fill" name="Cash Drawer" />
                </div>
                <div class="row d-flex justify-content-between">
                    <x-cart-options shortcut="F1" icon="bi bi-floppy" name="Discount" />
                    <x-cart-options shortcut="F2" icon="bi bi-eraser-fill" name="Comment" />
                    <x-cart-options class="bg-success" shortcut="F3" icon="bi bi-person-raised-hand" name="F10 Payment" />
                </div>
                <div class="row d-flex justify-content-between">
                    <x-cart-options shortcut="F1" icon="bi bi-floppy" name="Lock" />
                    <x-cart-options shortcut="F2" icon="bi bi-eraser-fill" name="Transfer" />
                    <x-cart-options class="bg-danger" shortcut="F3" icon="bi bi-person-raised-hand" name="Void Order" />
                    <x-cart-options shortcut="F4" icon="bi bi-inbox-fill" name="..." />
                </div>
            </div>
        
      </div>
    </div>

<script src="{{ asset('custom/js/order.js') }}"></script>
</x-sales>
