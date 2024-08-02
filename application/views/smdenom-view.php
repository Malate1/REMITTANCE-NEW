<main>
    <div class="container-fluid">
        <h4 class="mt-4">Denomination</h4><br/>
        <div class="col-xl-6">
            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" placeholder="denom_id" value="<?php echo $result->denom_id; ?>">
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-1000" id="qty-1000" value="<?php echo $result->qty_1000; ?>" oninput="calculate1000()" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="amount-1000">Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="<?php echo $result->amt_1000; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control"style="text-align: center;background-color: white" name="qty-500" id="qty-500" value="<?php echo $result->qty_500; ?>" oninput="calculate500()" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="<?php echo $result->amt_500; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-200" id="qty-200" value="<?php echo $result->qty_200; ?>" oninput="calculate200()" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="<?php echo $result->amt_200; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-100" id="qty-100" value="<?php echo $result->qty_100; ?>" oninput="calculate100()" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="<?php echo $result->amt_100; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-50" id="qty-50" value="<?php echo $result->qty_50; ?>" oninput="calculate50()" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="<?php echo $result->amt_50; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-20" id="qty-20" value="<?php echo $result->qty_20; ?>" oninput="calculate20()" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="<?php echo $result->amt_20; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4">
                    <label for="coins">Total Coins</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="coins" id="coins" value="<?php echo $result->total_coins; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="dc">Total DC</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="dc" id="dc" value="<?php echo $result->total_dc; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="pdc">Total PDC</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="pdc" id="pdc" value="<?php echo $result->total_pdc; ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12">
                <label for="totalcash">Total Cash</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="<?php echo $result->total_cash; ?>" readonly>
                </div>
            </div>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date" id="date" autocomplete="off">
            <a href="<?php echo base_url('/sm_ledger'); ?>"><button type="submit" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Go Back</button></a>
      </div>
  </div>
</main>