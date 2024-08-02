<main>
    <div class="container-fluid">
        <h4 class="mt-4">Denomination</h4><br/>
        <div class="col-xl-6">
        <form method="post" id="edit_cashier_denom">
            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" placeholder="id" value="<?php echo $result->denom_id; ?>">
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-1000" id="qty-1000" value="<?php echo $result->qty_1000; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate1000()">
                </div>
                <div class="form-group col-md-4">
                    <label for="amount-1000">Amount</label>
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-1000" id="hamount-1000" placeholder="0.00" value="<?php echo $result->amt_1000; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="<?php echo number_format($result->amt_1000,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-500" id="qty-500" value="<?php echo $result->qty_500; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate500()">
                </div>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-500" id="hamount-500" placeholder="0.00" value="<?php echo $result->amt_500; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="<?php echo number_format($result->amt_500,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-200" id="qty-200" value="<?php echo $result->qty_200; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate200()">
                </div>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-200" id="hamount-200" placeholder="0.00" value="<?php echo $result->amt_200; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="<?php echo number_format($result->amt_200,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-100" id="qty-100" value="<?php echo $result->qty_100; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate100()">
                </div>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-100" id="hamount-100" placeholder="0.00" value="<?php echo $result->amt_100; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="<?php echo number_format($result->amt_100,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-50" id="qty-50" value="<?php echo $result->qty_50; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate50()">
                </div>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-50" id="hamount-50" placeholder="0.00" value="<?php echo $result->amt_50; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="<?php echo number_format($result->amt_50,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" min="1" step="1" type="number" class="form-control" style="text-align: center" name="qty-20" id="qty-20" value="<?php echo $result->qty_20; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="calculate20()">
                </div>
                <div class="form-group col-md-4">
                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hamount-20" id="hamount-20" placeholder="0.00" value="<?php echo $result->amt_20; ?>" readonly>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="<?php echo number_format($result->amt_20,2); ?>" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4">
                    <label for="coins">Total Coins</label>
                    <input autocomplete="off" min="0.1" step="any" type="number" class="form-control" style="text-align: center;background-color: white" name="coins" id="coins" value="<?php echo $result->total_coins; ?>" oninput="calculatecoins()">
                </div>
                <div class="form-group col-md-8">
                    <label for="totalcash">Total Cash</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="<?php echo number_format($result->total_cash,2); ?>" readonly>
                </div>
            </div>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="date" id="date" autocomplete="off">
            <a href="<?= base_url('/cashier_ledger'); ?>"><input type="button" style="float: right" class="btn btn-secondary" value="Cancel"></a>
            <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Update Denomination</button>
        </form>
      </div>
  </div>
</main>