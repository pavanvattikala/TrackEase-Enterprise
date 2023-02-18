} else if($_GET['o'] == 'manord') { 
    // manage order
    ?>

    <div id="success-messages"></div>
    
    <table class="table" id="manageOrderTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Date</th>
                <th>Client Name</th>
                <th>Contact</th>
                <th>Total Order Item</th>
                <th>Payment Status</th>
                <th>Option</th>
            </tr>
        </thead>
    </table>

<?php 
// /else manage order
} else if($_GET['o'] == 'editOrd') {
    // get order
    ?>
    
    <div class="success-messages"></div> <!--/success-messages-->

  <form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

      <?php $orderId = $_GET['i'];

      $sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.sub_total, orders.vat, orders.total_amount, orders.discount, orders.grand_total, orders.paid, orders.due, orders.payment_type, orders.payment_status FROM orders 	
            WHERE orders.order_id = {$orderId}";

        $result = $connect->query($sql);
        $data = $result->fetch_row();				
      ?>

      <div class="form-group">
        <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
        </div>
      </div> <!--/form-group-->
      <div class="form-group">
        <label for="clientName" class="col-sm-2 control-label">Client Name</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
        </div>
      </div> <!--/form-group-->
      <div class="form-group">
        <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
        </div>
      </div> <!--/form-group-->			  

      <table class="table" id="productTable">
          <thead>
              <tr>			  			
                  <th style="width:40%;">Product</th>
                  <th style="width:20%;">Rate</th>
                  <th style="width:15%;">Quantity</th>			  			
                  <th style="width:15%;">Total</th>			  			
                  <th style="width:10%;"></th>
              </tr>
          </thead>
          <tbody>
              <?php

              $orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
                $orderItemResult = $connect->query($orderItemSql);
                // $orderItemData = $orderItemResult->fetch_all();						
                
                // print_r($orderItemData);
              $arrayNumber = 0;
              // for($x = 1; $x <= count($orderItemData); $x++) {
              $x = 1;
              while($orderItemData = $orderItemResult->fetch_array()) { 
                  // print_r($orderItemData); ?>
                  
                  <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                      <td style="margin-left:20px;">
                          <div class="form-group">

                          <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                              <option value="">~~SELECT~~</option>
                              <?php
                                  $productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
                                  $productData = $connect->query($productSql);

                                  while($row = $productData->fetch_array()) {									 		
                                      $selected = "";
                                      if($row['product_id'] == $orderItemData['product_id']) {
                                          $selected = "selected";
                                      } else {
                                          $selected = "";
                                      }

                                      echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
                                     } // /while 

                              ?>
                          </select>
                          </div>
                      </td>
                      <td style="padding-left:20px;">			  					
                          <input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
                          <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
                      </td>
                      <td style="padding-left:20px;">
                          <div class="form-group">
                          <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
                          </div>
                      </td>
                      <td style="padding-left:20px;">			  					
                          <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
                          <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
                      </td>
                      <td>

                          <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                      </td>
                  </tr>
              <?php
              $arrayNumber++;
              $x++;
              } // /for
              ?>
          </tbody>			  	
      </table>

      <div class="col-md-6">
          <div class="form-group">
            <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[4] ?>" />
              <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[4] ?>" />
            </div>
          </div> <!--/form-group-->			  
          <div class="form-group">
            <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php echo $data[5] ?>"  />
              <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $data[5] ?>"  />
            </div>
          </div> <!--/form-group-->			  
          <div class="form-group">
            <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[6] ?>" />
              <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[6] ?>"  />
            </div>
          </div> <!--/form-group-->			  
          <div class="form-group">
            <label for="discount" class="col-sm-3 control-label">Discount</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $data[7] ?>" />
            </div>
          </div> <!--/form-group-->	
          <div class="form-group">
            <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[8] ?>"  />
              <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[8] ?>"  />
            </div>
          </div> <!--/form-group-->			  		  
      </div> <!--/col-md-6-->

      <div class="col-md-6">
          <div class="form-group">
            <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[9] ?>"  />
            </div>
          </div> <!--/form-group-->			  
          <div class="form-group">
            <label for="due" class="col-sm-3 control-label">Due Amount</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[10] ?>"  />
              <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[10] ?>"  />
            </div>
          </div> <!--/form-group-->		
          <div class="form-group">
            <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
            <div class="col-sm-9">
              <select class="form-control" name="paymentType" id="paymentType" >
                  <option value="">~~SELECT~~</option>
                  <option value="1" <?php if($data[11] == 1) {
                      echo "selected";
                  } ?> >Cheque</option>
                  <option value="2" <?php if($data[11] == 2) {
                      echo "selected";
                  } ?>  >Cash</option>
                  <option value="3" <?php if($data[11] == 3) {
                      echo "selected";
                  } ?> >Credit Card</option>
              </select>
            </div>
          </div> <!--/form-group-->							  
          <div class="form-group">
            <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
            <div class="col-sm-9">
              <select class="form-control" name="paymentStatus" id="paymentStatus">
                  <option value="">~~SELECT~~</option>
                  <option value="1" <?php if($data[12] == 1) {
                      echo "selected";
                  } ?>  >Full Payment</option>
                  <option value="2" <?php if($data[12] == 2) {
                      echo "selected";
                  } ?> >Advance Payment</option>
                  <option value="3" <?php if($data[10] == 3) {
                      echo "selected";
                  } ?> >No Payment</option>
              </select>
            </div>
          </div> <!--/form-group-->							  
      </div> <!--/col-md-6-->


      <div class="form-group editButtonFooter">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

        <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

        <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
          
        </div>
      </div>
    </form>

    <?php
} // /get order else  ?>