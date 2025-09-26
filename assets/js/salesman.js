function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }
// var base_url = "<?php echo base_url(); ?>";

function calculatetotal() {
    var myValue1   = document.getElementById('hamount-1000').value;
    var myValue2   = document.getElementById('hamount-500').value;
    var myValue3   = document.getElementById('hamount-200').value;
    var myValue4   = document.getElementById('hamount-100').value;
    var myValue5   = document.getElementById('hamount-50').value;
    var myValue6   = document.getElementById('hamount-20').value;
    var myValue71  = document.getElementById('coins').value;
    var myValue7   = myValue71.replace(/,/g,'')
    var final      = document.getElementById('totalcash');
    var final_cash = document.getElementById('totalcash_ldi');
    var myValue81  = document.getElementById('dc').value;
    var myValue8   = myValue81.replace(/,/g,'');
    var myValue91  = document.getElementById('pdc').value;
    var myValue9   = myValue91.replace(/,/g,'');
    var final2     = document.getElementById('totalcollection');
    var final2_rem = document.getElementById('totalremittance');
    var final2_ldi = document.getElementById('totalcollection2');
    
    var location  = $("[name='location']").val();
    var bu  = $("[name='bu']").val();
    //console.log(bu);
    
    final.value = 0;

    var myFinal = Number(myValue1) + Number(myValue2) + Number(myValue3) + Number(myValue4) + Number(myValue5) + Number(myValue6) + Number(myValue7);
    final.value = formatNumber(parseFloat(myFinal).toFixed(2));

    if(bu === 'XTRUCK' || bu === 'XTRUCK-NETMAN' || bu === 'OPLAN' ||  bu === 'MAS-LDI' || bu === 'MAS-NETMAN' || bu === 'MAS-MPDI' || bu === 'XTRUCK-MPDI' || bu === 'XTRUCK-NETMAN-BPI'){
        final2_ldi.value = 0;
        var myFinal2 = myFinal + Number(myValue8) + Number(myValue9);
        final2_ldi.value = formatNumber(parseFloat(myFinal2).toFixed(2));
        
    }else{
        var myFinal2 = myFinal + Number(myValue8) + Number(myValue9);
        final2.value = formatNumber(parseFloat(myFinal2).toFixed(2));
        console.log(final2.value);
    }
    //console.log(final2_ldi.value);
    

    // if(bu == 'XTRUCK'){
    //     var inc = document.getElementById('totalinc').value;
    //     var inc2 = inc.replace(/,/g,'');
    //     var finalCashValue = parseFloat(final_cash.value.replace(/,/g, '')) || 0;

    //     finalCashValue -= inc2;
    //     final_cash.value = finalCashValue.toFixed(2);
    //     //final2.value = formatNumber(parseFloat(finalCashValue).toFixed(2));
    // }


    // if (final2 !== null && (location == 'LDI' || location == 'LDI-CDC' || location == 'LDI-UDC')) {
    //    // final2_ldi.value = 0;
    //     var myFinal2 = myFinal + Number(myValue8) + Number(myValue9);
    //     final2.value = formatNumber(parseFloat(myFinal2).toFixed(2));
    //     console.log(final2.value);
    // }
    
    // if(location == 'LDI'){
    //     // console.log('test');
    //     var myFinal21 = myFinal + Number(myValue8) + Number(myValue9) + Number(myValueret1) - deduct;
    //     final2_rem.value = formatNumber(parseFloat(myFinal21).toFixed(2));
    //     console.log(myValueret1);

    // }
    // var myFinal2_ldi = Number(myValue8) + Number(myValue9)
    // final2_ldi.value = formatNumber(parseFloat(myFinal2_ldi).toFixed(2));
    // alert(final2_ldi.value);
}

function updateIncentiveDisplay() {
                            
    var totalIncentivesInput = document.getElementById('totalincentives');
    var totalIncInput = document.getElementById('totalinc');
    var incentiveDisplay = document.getElementById('available_incentives');
    var avail_inc = totalIncentivesInput.value;
    console.log(avail_inc);                   
    var avail_inc2 = parseFloat(avail_inc.replace(/,/g, '')) || 0; // Convert to number
    incentiveDisplay.textContent = '(Available: ' + avail_inc2.toFixed(2) + ')';

    if (avail_inc2 === 0) {
        totalIncInput.disabled = true;
    } else {
        totalIncInput.disabled = false;
    }
}

function calculate1000() {
    var myBox1 = document.getElementById('note-1000').value;	
    var myBox2 = document.getElementById('qty-1000').value;
    var result = document.getElementById('amount-1000');
    var result2 = document.getElementById('hamount-1000');
    var myResult = myBox1 * myBox2;
    result2.value = parseFloat(myResult).toFixed(2);
    calculatetotal();
    result.value = formatNumber(parseFloat(myResult).toFixed(2));
}

function calculate500() {
    var myBox1 = document.getElementById('note-500').value;	
    var myBox2 = document.getElementById('qty-500').value;
    var result = document.getElementById('amount-500');
    var result2 = document.getElementById('hamount-500');
    var myResult = myBox1 * myBox2;
    result2.value = parseFloat(myResult).toFixed(2);
    calculatetotal();
    result.value = formatNumber(parseFloat(myResult).toFixed(2));
}

function calculate200() {
    var myBox1 = document.getElementById('note-200').value;	
    var myBox2 = document.getElementById('qty-200').value;
    var result = document.getElementById('amount-200');
    var result2 = document.getElementById('hamount-200');
    var myResult = myBox1 * myBox2;
    result2.value = parseFloat(myResult).toFixed(2);
    calculatetotal();
    result.value = formatNumber(parseFloat(myResult).toFixed(2));
}

function calculate100() {
    var myBox1 = document.getElementById('note-100').value;	
    var myBox2 = document.getElementById('qty-100').value;
    var result = document.getElementById('amount-100');
    var result2 = document.getElementById('hamount-100');
    var myResult = myBox1 * myBox2;
    result2.value = parseFloat(myResult).toFixed(2);
    calculatetotal();
    result.value = formatNumber(parseFloat(myResult).toFixed(2));
}

function calculate50() {
    var myBox1 = document.getElementById('note-50').value;	
    var myBox2 = document.getElementById('qty-50').value;
    var result = document.getElementById('amount-50');
    var result2 = document.getElementById('hamount-50');
    var myResult = myBox1 * myBox2;
    result2.value = parseFloat(myResult).toFixed(2);
    calculatetotal();
    result.value = formatNumber(parseFloat(myResult).toFixed(2));
}

function calculate20() {
    var myBox1 = document.getElementById('note-20').value;	
    var myBox2 = document.getElementById('qty-20').value;
    var result = document.getElementById('amount-20');
    var result2 = document.getElementById('hamount-20');
    var myResult = myBox1 * myBox2;
    result2.value = parseFloat(myResult).toFixed(2);
    calculatetotal();
    result.value = formatNumber(parseFloat(myResult).toFixed(2));
}

function calculatecoins(val) {
    calculatetotal();
}

function calculatedc() {
    calculatetotal();
}

function calculatepdc() {
    calculatetotal();
}

function calculatecash() {
    calculatetotal();
}

function calculatetax() {
    calculatetotal();
}

$('#submit_sm_denom').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();

    var submitButton = $(this).find("button[type='submit']");
    submitButton.prop("disabled", true).text("Submitting...");

    var flag = 0;
    var qty1000     = $("[name='qty-1000']").val();
    var qty500      = $("[name='qty-500']").val();
    var qty200      = $("[name='qty-200']").val();
    var qty100      = $("[name='qty-100']").val();
    var qty50       = $("[name='qty-50']").val();
    var qty20       = $("[name='qty-20']").val();
    var coins       = $("[name='coins']").val();
    var dc          = $("[name='dc']").val();
    var pdc         = $("[name='pdc']").val();
    var dc_pcs      = $("[name='dc_pcs']").val();
    var pdc_pcs     = $("[name='pdc_pcs']").val();
    var remit       = $("[name='totalremittance']").val();
    var cash        = $("[name='totalcash']").val();
    var cash_ldi    = $("[name='totalcash_ldi']").val();
    var returns     = $("[name='totalreturns']").val();
    var expense     = $("[name='expenses_amt']").val();
    var return_no   = $("[name='totalreturns_no']").val();
    var pay_id      = $("[name='totalpay_id']").val();
    var pay_sat_id  = $("[name='totalpaysat_id']").val();
    var bo_id       = $("[name='totalbo_id']").val();
    var location    = $("[name='location']").val();
    var bu          = $("[name='bu']").val();
    var user_id     = $("[name='userid']").val();
    var coins2      = coins.replace(/,/g,'');
    var dc2         = dc.replace(/,/g,'');
    var pdc2        = pdc.replace(/,/g,'');
    var remit2      = remit.replace(/,/g,'');
    var expense2    = expense.replace(/,/g,'');
    var tax         = $("[name='totaltax']").val();
    var bo          = $("[name='totalbo']").val();
    var bo2         = bo.replace(/,/g,'');

    
    
    

    if(bu ==="XTRUCK" || bu ==="XTRUCK-NETMAN" || bu ==="XTRUCK-NETMAN-BPI"){
        var inc = $("[name='totalinc']").val();
        var inc2 = inc.replace(/,/g,'');
        var avail_incentives = $("[name='totalincentives']").val();
        let incentives = parseFloat(inc.replace(',', ''));
        let avail_incentives2 = parseFloat(avail_incentives.replace(',', ''));

        console.log(avail_incentives);
        console.log(incentives);
        console.log('Incentives:', incentives);
        console.log(cash_ldi);
        //|| incentives > cash_ldi
        if (incentives > avail_incentives )
        {

            swal({
                title: "Salesman incentive amount must be within the total available incentives " + avail_incentives + " or total cash from MyNetgosyo!",
                type: "error",
                showCancelButton: false
            });
            return 0;
        }
    }
    

    var exp = document.getElementById("expenses").value;
    if(isNaN(coins2)==true)
    {
        swal({
            title: "Coins amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(dc2)==true)
    {
        swal({
            title: "DC amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(pdc2)==true)
    {
        swal({
            title: "PDC amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(remit2)==true)
    {
        swal({
            title: "Total Collection amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(expense2)==true)
    {
        swal({
            title: "Expenses amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(remit2=="")
    {
        swal({
            title: "Total Collection Amount is empty!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(expense2!="" && exp=="")
    {
        swal({
            title: "Expenses Details is empty!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }

    // if(cash_ldi!="0.00" && cash=="0.00 ")
    // {
    //     swal({
    //         title: "Total Cash Details is empty!",
    //         type: "error",
    //         showCancelbutton: false
    //     });
    //     return 0;
    // }

    

   

    const epsilon = 5.00;
    const tolerance = 0.01; 
    let cash1 = parseFloat(cash.replace(',', ''));
   

    if ((location === "LDI" && bu ==="OPLAN") || 
        (location === "LDI-CDC" && bu ==="OPLAN") || 
        (location === "LDI-UDC" && bu ==="OPLAN") || 
        (location === "LDI" && bu ==="MAS-LDI") || 
        (location === "LDI-CDC" && bu ==="MAS-LDI") || 
        (location === "LDI-UDC" && bu ==="MAS-LDI") ||
        (location === "LDI" && bu ==="MAS-NETMAN") || 
        (location === "LDI-CDC" && bu ==="MAS-NETMAN") || 
        (location === "LDI-UDC" && bu ==="MAS-NETMAN") ||
        (location === "LDI" && bu ==="MAS-MPDI") || 
        (location === "LDI-CDC" && bu ==="MAS-MPDI") || 
        (location === "LDI-UDC" && bu ==="MAS-MPDI") ||
        (location === "LDI" && bu ==="XTRUCK") || 
        (location === "LDI-CDC" && bu ==="XTRUCK") || 
        (location === "LDI-UDC" && bu ==="XTRUCK") ||
        (location === "LDI" && bu ==="XTRUCK-MPDI") || 
        (location === "LDI-CDC" && bu ==="XTRUCK-MPDI") || 
        (location === "LDI-UDC" && bu ==="XTRUCK-MPDI") ||
        (location === "LDI" && bu ==="XTRUCK-NETMAN-BPI") || 
        (location === "LDI-CDC" && bu ==="XTRUCK-NETMAN-BPI") || 
        (location === "LDI-UDC" && bu ==="XTRUCK-NETMAN-BPI") ||
        (location === "LDI" && bu ==="XTRUCK-NETMAN") || 
        (location === "LDI-CDC" && bu ==="XTRUCK-NETMAN") || 
        (location === "LDI-UDC" && bu ==="XTRUCK-NETMAN")) {

            if(bu ==="XTRUCK" || bu ==="XTRUCK-MPDI" || bu ==="XTRUCK-NETMAN-BPI" || bu ==="XTRUCK-NETMAN"){
                var pal = $("[name='totalpalawan']").val();
                var pal2 = pal.replace(/,/g,'');
            }
            
        cash2_bo = 0;
        let bo2 = parseFloat(bo.replace(',', '')); // Ensure bo2 is a float
        if (isNaN(bo2) || bo2 === 0) {
            bo2 = 0;
        }
        let cash2 = parseFloat(cash_ldi.replace(',', '')); // Ensure cash2 is a float
        if(bu != 'OPLAN' && bu != 'MAS-LDI' && bu != 'MAS-NETMAN' && bu != 'MAS-MPDI'){
            cash2_bo = cash2 + bo2;
        }else{
            cash2_bo = cash2;
        }

        // Calculate the result
        //let result = Math.abs(cash1 - cash2_bo);
        let result = cash1 - cash2;
        // let result = Math.abs(cash1 - cash2);
        
        let result1 = result.toFixed(2);

        // Log the values for debugging
        console.log('Cash1:', cash1);
        console.log('Cash2:', cash2_bo);
        console.log('Result:', result);
        console.log('Result1:', result1);
        console.log('BO:', bo2);

        console.log('Cash LDI:', cash2);
        //const epsilon = 5.00;
        // if (result1 !== '0' && (result < -100 || result > 100)) {

        //     swal({
        //         title: "Cash remitted amount must be within plus/minus 5.00 to total cash from MyNetgosyo!",
        //         type: "error",
        //         showCancelButton: false
        //     });
        //     return 0;
        // }

        var manualsrrValue = $('#manualsrr').val().trim();

        if (manualsrrValue === "") {
            swal({
                title: "Missing Input",
                text: "Manual SRR is required.",
                type: "warning",
                showCancelButton: false
            }).then(function() {
                // Reload the page after the user clicks "OK"
                location.reload();
            });
            return 0; // Stop execution
        }

        if (result >= -5 && result < 0) {
            swal({
                title: "You are short in remittance, you need to pay " + Math.abs(result1),
                type: "error",
                showCancelButton: false
            });
            return 0;
        }
        

        if (result1 !== '0' && (result <= -5 || result > 5)) {
            // Show modal instead of SweetAlert
            $('#managerKeyModal').on('show.bs.modal', function () {
                if (result <= -5){
                    $('#message').text('You are short by ' + result1);
                }else{
                    $('#message').text('You are over by ' + result1);
                }
                
            });
            $('#managerKeyModal').modal('show');
            // Return control to handle the action after modal confirmation
            document.getElementById('confirmKey').onclick = function() {
                const managerKey = document.getElementById('managerKeyInput').value;
                const validCashiers = ["Cande", "Mark", "Meriam", "Mirasol", "Jonamhin"];
                const cashierInput = document.getElementById("cashierInput").value.trim();

                // if (validCashiers.includes(cashierInput)) {
                //     // Proceed with manager's key verification or any other action
                //     alert("Cashier name is valid. Proceeding...");
                // } else {
                //     alert("Invalid cashier name. Please enter a valid name.");
                // }

                if (managerKey === 'aris2020' && validCashiers.includes(cashierInput)) { 
                    $('#managerKeyModal').modal('hide');
                    console.log("Manager's key validated, proceeding with action.");
                    proceedWithAction();
                } else {
                    //document.getElementById('keyError').classList.remove('d-none');
                    console.log("Invalid manager's key and cashier name.");
                    // Hide modal temporarily
                    $('#managerKeyModal').modal('hide');
                    $('#managerKeyInput').val('');
                    $('#cashierInput').val('');

                    // Show SweetAlert error
                    swal({
                        title: "Invalid manager's key and cashier name.",
                        type: "error",
                        showCancelButton: false
                    }, function() {
                        // Reopen modal after SweetAlert is closed
                        $('#managerKeyModal').modal('show');
                    });
                    return 0; // Halt the action
                }
            };

            return 0; // Initial return to halt until manager key validation
        }else{
            proceedWithAction();
        }

        
    }
    proceedWithAction();

    function proceedWithAction() {

        const cashierInput = document.getElementById("cashierInput").value.trim();
        if((expense2=="" || expense2=="0") && exp!="")
        {
            swal({
                title: "Expenses Amount is empty!",
                type: "error",
                showCancelbutton: false
            });
            return 0;
        }
        
        if((dc!="" && dc_pcs=="") || (pdc!="" && pdc_pcs==""))
        {
            swal({
                title: "DC Pcs. or PDC Pcs. is empty!",
                text: "You entered a DC or PDC amount but you didn't entered the pcs.",
                type: "error",
                showCancelbutton: false
            });
        }
        else if((dc_pcs!="" && dc=="") || (pdc_pcs!="" && pdc==""))
        {
            swal({
                title: "DC Amount or PDC Amount is empty!",
                text: "You entered a DC pcs or PDC pcs but you didn't entered the amount.",
                type: "error",
                showCancelbutton: false
            });
        }
        else
        {
            if(qty1000=="" && qty500=="" && qty200=="" && qty100=="" && qty50=="" && qty20=="" && dc=="" && pdc=="" && coins2=="" && pal2 =="")  
            {
                swal({
                    title: "No data to save!",
                    type: "error",
                    showCancelbutton: false
                });
            }
            else
            {
                if(qty1000==0 && qty500==0 && qty200==0 && qty100==0 && qty50==0 && qty20==0 && dc==0 && pdc==0 && coins2==0 && pal2 ==0)
                {
                    swal({
                        title: "No data to save!",
                        type: "error",
                        showCancelbutton: false
                    });
                }
                else
                {
                    if (
                        ((bu !="OPLAN" && dc != "") || (bu !="OPLAN" && pdc != "")) && 
                        ((bu !="MAS-LDI" && dc != "") || (bu !="MAS-LDI" && pdc != "")) && 
                        ((bu !="MAS-NETMAN" && dc != "") || (bu !="MAS-NETMAN" && pdc != "")) && 
                        ((bu !="MAS-LDI" && dc != "") || (bu !="MAS-LDI" && pdc != "")) && 
                        ((bu !="XTRUCK" && dc != "") || (bu !="XTRUCK" && pdc != "")) && 
                        ((bu !="XTRUCK-NETMAN" && dc != "") || (bu !="XTRUCK-NETMAN" && pdc != "")) &&
                        ((bu !="XTRUCK-NETMAN-BPI" && dc != "") || (bu !="XTRUCK-NETMAN-BPI" && pdc != "")) &&
                        ((bu !="XTRUCK-MPDI" && dc != "") || (bu !="XTRUCK-MPDI" && pdc != ""))
                    ) {
                        var titles = "Proceed check entry?";
                    }else{
                        var titles = "Proceed saving denomination?";
                    }
                    swal({
                        title: titles,
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            formData.append('cashierInput', cashierInput);
                            $.ajax({
                                url: 'save_denom',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                // error: function() {
                                //     alert('Something is wrong');
                                // },
                                success: function(data) {      
                                    // if(data=='exist')
                                    // {
                                        // swal({
                                        //     title: "You already submitted a denomination today!",
                                        //     type: "error",
                                        //     showCancelbutton: false
                                        // });
                                    // }
                                    // else
                                    // {
    
                                    var response = JSON.parse(data);

                                    if (response.status === 'error') {
                                        swal({
                                            title: "Error",
                                            text: response.message,
                                            type: "error"
                                        });
                                        return;
                                    }

                                    var denom_id = response.denom_id;
                                    const currentDate = new Date();
    
                                    const year = currentDate.getFullYear();
                                    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
                                    const day = String(currentDate.getDate()).padStart(2, '0');
    
                                    const formattedDate = `${year}-${month}-${day}`;
                                        swal({
                                            title: "Denomination successfully saved!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                //window.location.replace(baseurl + 'sm_ledger');
                                                
                                                if(
                                                    ((bu !="OPLAN" && dc != "") || (bu !="OPLAN" && pdc != "")) && 
                                                    ((bu !="MAS-LDI" && dc != "") || (bu !="MAS-LDI" && pdc != "")) && 
                                                    ((bu !="MAS-NETMAN" && dc != "") || (bu !="MAS-NETMAN" && pdc != "")) && 
                                                    ((bu !="MAS-LDI" && dc != "") || (bu !="MAS-LDI" && pdc != "")) && 
                                                    ((bu !="XTRUCK" && dc != "") || (bu !="XTRUCK" && pdc != "")) && 
                                                    ((bu !="XTRUCK-NETMAN" && dc != "") || (bu !="XTRUCK-NETMAN" && pdc != "")) &&
                                                    ((bu !="XTRUCK-NETMAN-BPI" && dc != "") || (bu !="XTRUCK-NETMAN-BPI" && pdc != "")) &&
                                                    ((bu !="XTRUCK-MPDI" && dc != "") || (bu !="XTRUCK-MPDI" && pdc != ""))
                                                ) {
                                                        
                                                    window.location.replace(baseurl + 'checkentry/' + denom_id + '/' + formattedDate + '/' + user_id);
                                                } 
                                                else {
                                                    window.location.replace(baseurl + 'sm_ledger');
                                                }
                                            }
                                        }
                                        );
                                    // }   
                                }
                            });
                        }
                    }
                    );
                }
            }
        }

    }
});

$('#edit_sm_denom').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    var qty1000 = $("[name='qty-1000']").val();
    var qty500 = $("[name='qty-500']").val();
    var qty200 = $("[name='qty-200']").val();
    var qty100 = $("[name='qty-100']").val();
    var qty50 = $("[name='qty-50']").val();
    var qty20 = $("[name='qty-20']").val();
    var coins = $("[name='coins']").val();
    var dc = $("[name='dc']").val();
    var pdc = $("[name='pdc']").val();
    var dc_pcs = $("[name='dc_pcs']").val();
    var pdc_pcs = $("[name='pdc_pcs']").val();
    var remit = $("[name='totalremittance']").val();
    var location  = $("[name='location']").val();
    var bu  = $("[name='bu']").val();
    var user_id  = $("[name='userid']").val();
    var expense = $("[name='expenses_amt']").val();
    var coins2 = coins.replace(/,/g,'');
    var dc2 = dc.replace(/,/g,'');
    var pdc2 = pdc.replace(/,/g,'');
    var remit2 = remit.replace(/,/g,'');

    console.log(remit2);

    if(bu == "XTRUCK" || bu == "XTRUCK-NETMAN" || bu == "OPLAN" || bu === 'MAS-LDI' || bu === 'MAS-NETMAN' || bu === 'MAS-MPDI' || bu == "XTRUCK-MPDI" || bu == "XTRUCK-NETMAN-BPI"){
        var remit_ldi = $("[name='totalcollection2']").val();
        var remit2_ldi = remit_ldi.replace(/,/g,'');
    }
    
    // var expense2 = expense.replace(/,/g,'');
    // var exp = document.getElementById("expenses").value;
    if(isNaN(coins2)==true)
    {
        swal({
            title: "Coins amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(dc2)==true)
    {
        swal({
            title: "DC amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(pdc2)==true)
    {
        swal({
            title: "PDC amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    if(isNaN(remit2)==true )
    {
        swal({
            title: "Total Collection amount has invalid number!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }
    // if(isNaN(expense2)==true)
    // {
    //     swal({
    //         title: "Expenses amount has invalid number!",
    //         type: "error",
    //         showCancelbutton: false
    //     });
    //     return 0;
    // }
    // if(expense2!="" && exp=="")
    // {
    //     swal({
    //         title: "Expenses Details is empty!",
    //         type: "error",
    //         showCancelbutton: false
    //     });
    //     return 0;
    // }
    // if((expense2=="" || expense2=="0") && exp!="")
    // {
    //     swal({
    //         title: "Expenses Amount is empty!",
    //         type: "error",
    //         showCancelbutton: false
    //     });
    //     return 0;
    // }
    if((dc!="" && dc_pcs=="") || (pdc!="" && pdc_pcs==""))
    {
        swal({
            title: "DC Pcs. or PDC Pcs. is empty!",
            text: "You entered a DC or PDC amount but you didn't entered the pcs.",
            type: "error",
            showCancelbutton: false
        });
    }
    else
    {
        if(qty1000=="" && qty500=="" && qty200=="" && qty100=="" && qty50=="" && qty20=="" && dc=="" && pdc=="")
        {
            swal({
                title: "No data to save!",
                type: "error",
                showCancelbutton: false
            });
        }
        else
        {
            if(qty1000==0 && qty500==0 && qty200==0 && qty100==0 && qty50==0 && qty20==0 && dc==0 && pdc==0)
            {
                swal({
                    title: "No data to save!",
                    type: "error",
                    showCancelbutton: false
                });
            }
            else
            {
                swal({
                    title: "Proceed saving denomination?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                },
                
                function(isConfirm) {
                    if(isConfirm)
                    {
                        $.ajax({
                            url: baseurl + 'update_denom',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {            
                                swal({
                                    title: "Denomination successfully saved!",
                                    type: "success",
                                    showCancelbutton: false,
                                    closeModal: false
                                },
                                function(isok) {
                                    if(isok){
                                        window.location.replace(baseurl + 'sm_ledger');
                                    }
                                }
                                );
                            }
                        });
                    }
                }
                );
            }
        }
    }
});

function deletedenom_content(ids)
{
    swal({
        title: "Are you sure to delete this denomination?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText: "No",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: 'delete_denom',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Denomination successfully deleted!",
                        type: "success",
                        showCancelbutton: false,
                        closeModal: false
                    },
                    function(isok) {
                        if(isok){
                            window.location.reload();
                        }
                    }
                    );
                }
            });
          }
      }
      );
}

function deletecashier_content(ids)
{
    swal({
        title: "Are you sure to delete this payment?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText: "No",
        confirmButtonText: "Yes",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_payment',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Payment successfully deleted!",
                        type: "success",
                        showCancelbutton: false,
                        closeModal: false
                    },
                    function(isok) {
                        if(isok){
                            window.location.reload();
                        }
                    }
                    );
                }
            });
          }
      }
      );
}

$('#submit_cashier_denom').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    var qty1000 = $("[name='qty-1000']").val();
    var qty500 = $("[name='qty-500']").val();
    var qty200 = $("[name='qty-200']").val();
    var qty100 = $("[name='qty-100']").val();
    var qty50 = $("[name='qty-50']").val();
    var qty20 = $("[name='qty-20']").val();
    var coins = $("[name='coints']").val();
    if(qty1000=="" && qty500=="" && qty200=="" && qty100=="" && qty50=="" && qty20=="")
    {
        swal({
            title: "No data to save!",
            type: "error",
            showCancelbutton: false
        });
    }
    else
    {
        if(qty1000==0 && qty500==0 && qty200==0 && qty100==0 && qty50==0 && qty20==0)
        {
            swal({
                title: "No data to save!",
                type: "error",
                showCancelbutton: false
            });
        }
        else
        {
            swal({
                title: "Proceed saving denomination?",
                text: "",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonText: "No",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true
              },
              
              function(isConfirm) {
                  if(isConfirm)
                  {
                     $.ajax({
                        url: 'save_denom_cashier',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {   
                            // if(data=='exist')
                            // {
                                // swal({
                                //     title: "You already submitted a denomination today!",
                                //     type: "error",
                                //     showCancelbutton: false
                                // });
                            // }
                            // else
                            // {
                                swal({
                                    title: "Denomination successfully saved!",
                                    type: "success",
                                    showCancelbutton: false,
                                    closeModal: false
                                },
                                function(isok) {
                                    if(isok){
                                        window.location.replace(baseurl + 'cashier_ledger');
                                    }
                                }
                                );
                            // }         
                        }
                    });
                  }
              }
              );
        }
    }
});

$('#edit_cashier_denom').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    var qty1000 = $("[name='qty-1000']").val();
    var qty500 = $("[name='qty-500']").val();
    var qty200 = $("[name='qty-200']").val();
    var qty100 = $("[name='qty-100']").val();
    var qty50 = $("[name='qty-50']").val();
    var qty20 = $("[name='qty-20']").val();
    var coins = $("[name='coints']").val();
    if(qty1000=="" && qty500=="" && qty200=="" && qty100=="" && qty50=="" && qty20=="")
    {
        swal({
            title: "No data to save!",
            type: "error",
            showCancelbutton: false
        });
    }
    else
    {
        if(qty1000==0 && qty500==0 && qty200==0 && qty100==0 && qty50==0 && qty20==0)
        {
            swal({
                title: "No data to save!",
                type: "error",
                showCancelbutton: false
            });
        }
        else
        {
            swal({
                title: "Proceed saving denomination?",
                text: "",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                cancelButtonText: "No",
                confirmButtonText: "Yes",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true
              },
              
              function(isConfirm) {
                  if(isConfirm)
                  {
                     $.ajax({
                        url: baseurl + 'update_denom_cashier',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {            
                            swal({
                                title: "Denomination successfully saved!",
                                type: "success",
                                showCancelbutton: false,
                                closeModal: false
                            },
                            function(isok) {
                                if(isok){
                                    window.location.replace(baseurl + 'cashier_ledger');
                                }
                            }
                            );
                        }
                    });
                  }
              }
              );
        }
    }
});

function viewsmdenom_content(ids)
{
    $.ajax({
        url: baseurl + 'view_sm_denom',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewsmdenom_content").html(data);
        }
    });
}

function viewsmdenom_content_ldi(ids)
{
    $.ajax({
        url: baseurl + 'view_sm_denom_ldi',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewsmdenom_content_ldi").html(data);
        }
    });
}

function viewsmchecks_content_ldi(ids)
{
    $.ajax({
        url: baseurl + 'view_sm_checks_ldi',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewsmchecks_content_ldi").html(data);
        }
    });
}

function viewsminc_content_ldi(ids)
{
    $.ajax({
        url: baseurl + 'view_sm_inc_ldi',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Oops!');
        },
        success: function(data) {                 
            $("#viewsminc_content_ldi").html(data);
        }
    });
}

function viewsminc_used_content_ldi(ids)
{
    $.ajax({
        url: baseurl + 'view_sm_inc_used_ldi',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewsminc_used_content_ldi").html(data);
        }
    });
}

function viewsmpal_content_ldi(ids)
{
    $.ajax({
        url: baseurl + 'view_sm_pal_ldi',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewsmpal_content_ldi").html(data);
        }
    });
}

function viewallsmdenom_content(dates)
{
    $.ajax({
        url: baseurl + 'view_allsm_denom',
        type: 'POST',
        data: {dates:dates},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewallsmdenom_content").html(data);
        }
    });
}

function viewcashierdenom_content(ids)
{
    $.ajax({
        url: 'view_cashier_denom',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewcashierdenom_content").html(data);
        }
    });
}
//BATCHING
// function getcollection(id_no, ndate) {

//     swal({
//         title: "Enter Batch Number",
//         text: "Please provide the batch number:",
//         type: "input",
//         showCancelButton: true,
//         closeOnConfirm: false,
//         inputPlaceholder: "e.g. 1"
//     },
//     function(batch_no) {
//         if (batch_no === false) return; // Cancelled
//         if (batch_no === "" || batch_no.trim() === "") {
//             swal.showInputError("Batch number is required!");
//             return;
//         }

//         // Optional: You can show loader or confirmation here
//         swal({
//             title: "Proceed to get collection?",
//             text: "Batch Number: " + batch_no,
//             type: "info",
//             showCancelButton: true,
//             confirmButtonClass: "btn-success",
//             cancelButtonText: "No",
//             confirmButtonText: "Yes",
//             closeOnConfirm: false,
//             closeOnCancel: true,
//             showLoaderOnConfirm: true
//         }, function(isConfirm) {
//             if (isConfirm) {
//                 //const batch_no = result.value;
//                 var final2          = document.getElementById('totalremittance');
//                 var final2_collect  = document.getElementById('totalcollection2');
//                 var dc_amt          = document.getElementById('dc');
//                 var cash            = document.getElementById('totalcash_ldi');
//                 var dc_pcs          = document.getElementById('dc_pcs');
//                 var pdc_amt         = document.getElementById('pdc');
//                 var pdc_pcs         = document.getElementById('pdc_pcs');
//                 var returns         = document.getElementById('totalreturns');
//                 var return_no       = document.getElementById('totalreturns_no');
//                 var pay_id          = document.getElementById('totalpay_id');
//                 var tax             = document.getElementById('totaltax');
//                 var bo              = document.getElementById('totalbo');
//                 var bo_id           = document.getElementById('totalbo_id');
//                 var bo_si           = document.getElementById('totalbo_si');
//                 var palawan         = document.getElementById('totalpalawan');
//                 var paypal_id       = document.getElementById('totalpaypal_id');

//                 //var bo_disc = document.getElementById('totalbo_disc').textContent;
//                 var bo_disc = $('#totalbo_disc').text();
                
//                 $.ajax({
//                     url: baseurl + 'get_collection',
//                     type: 'POST',
//                     data: { id_no: id_no, ndate: ndate, batch_no: batch_no },
//                     dataType: 'JSON',
//                     error: function () {
//                         swal.close();
//                         // $('body').removeClass('modal-open'); 
//                         // $('.sweet-overlay').remove();
//                         swal("Error", "Something went wrong while fetching the collection.", "error");
//                     },
//                     success: function (data) {
//                         swal.close();

//                         // setTimeout(function () {
//                         //     $('body').removeClass('modal-open').css('overflow', 'auto');
//                         //     $('.sweet-overlay').remove();
//                         // }, 500); // adjust time if needed
//                         //console.log($('body').attr('class'), $('body').css('overflow'));


//                         final2.value            = formatNumber(parseFloat(data.total).toFixed(2));
//                         final2_collect.value    = formatNumber(parseFloat(data.total).toFixed(2));
//                         returns.value           = formatNumber(parseFloat(data.total_return).toFixed(2));
//                         dc_amt.value            = formatNumber(parseFloat(data.dc_amt).toFixed(2));
//                         dc_pcs.value            = data.dc_pcs;
//                         pdc_amt.value           = formatNumber(parseFloat(data.pdc_amt).toFixed(2));
//                         cash.value              = formatNumber(parseFloat(data.cash).toFixed(2));
//                         tax.value               = formatNumber(parseFloat(data.total_tax).toFixed(2));
//                         bo.value                = formatNumber(parseFloat(data.total_bo).toFixed(2));
//                         palawan.value           = formatNumber(parseFloat(data.palawan).toFixed(2));
//                         document.getElementById('totalbo_disc').textContent = formatNumber(parseFloat(data.total_bo_disc).toFixed(2));
//                         document.getElementById('bo_cm').textContent        = formatNumber(parseFloat(data.total_bo_cm).toFixed(2));
//                         pdc_pcs.value           = data.pdc_pcs;
//                         return_no.value         = data.return_no;
//                         pay_id.value            = data.pay_id;
//                         bo_id.value             = data.bo_id;
//                         bo_si.value             = data.bo_si;
//                         paypal_id.value         = data.pay_id_pal;

//                         // Check if BO (Bad Order) is not null or zero
//                         if (parseFloat(data.total_bo_admin) > 0) {
                            
//                             showBOPaymentModal();
                            
//                         }

//                         function showBOPaymentModal() {
//                             let totalBO = parseFloat(data.total_bo_admin);
//                             let cashVal = parseFloat(data.cash);
//                             let dcVal = parseFloat(data.dc_amt);
//                             let pdcVal = parseFloat(data.pdc_amt);

//                             let cashDisabled = (cashVal === 0 || totalBO > cashVal) ? 'disabled' : '';
//                             let dcDisabled = (dcVal === 0 || totalBO > dcVal) ? 'disabled' : '';
//                             let pdcDisabled = (pdcVal === 0 || totalBO > pdcVal) ? 'disabled' : '';
//                             let cashDcDisabled = (cashVal === 0 || dcVal === 0 || totalBO > (cashVal + dcVal)) ? 'disabled' : '';
//                             let cashPdcDisabled = (cashVal === 0 || pdcVal === 0 || totalBO > (cashVal + pdcVal)) ? 'disabled' : '';
//                             let cashPdcDcDisabled = (cashVal === 0 || dcVal === 0 || pdcVal === 0 || totalBO > (cashVal + dcVal + pdcVal)) ? 'disabled' : '';
                        
//                             swal({
//                                 title: "Select BO Payment Type",
//                                 text: `
//                                     <div style="margin-top: 10px;">
//                                         <strong>BO Admin Amount: <p style="color: red"> ₱${parseFloat(data.total_bo_admin).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p></strong>
                                        
//                                     </div>
//                                     <div style="text-align: left; margin-top: 10px;">
//                                         <label><input type="radio" name="boPaymentType" value="cash" ${cashDisabled}> Cash</label><br>
//                                         <label><input type="radio" name="boPaymentType" value="dated_check" ${dcDisabled}> Dated Check</label><br>
//                                         <label><input type="radio" name="boPaymentType" value="pdc" ${pdcDisabled}> Post-Dated Check</label><br>
//                                         <label><input type="radio" name="boPaymentType" value="cash_dc" ${cashDcDisabled}> Cash & DC</label><br>
//                                         <label><input type="radio" name="boPaymentType" value="cash_pdc" ${cashPdcDisabled}> Cash & PDC</label><br> 
//                                         <label><input type="radio" name="boPaymentType" value="cash_pdc_dc" ${cashPdcDcDisabled}> Cash & (PDC, DC)</label>
//                                     </div>
//                                     <div id="amountInputs" style="display: none; margin-top: 10px;">
//                                         <label>Cash Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" id="cashAmount" min="0.0" step="any" style="width: 100px;"></label><br>
//                                         <label id="secondLabel" style="display: none;">
//                                             PDC Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" id="otherAmount" min="0.0" step="any" style="width: 100px;">
//                                         </label>
//                                         <label id="thirdLabel" style="display: none;">
//                                             PDC/DC Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" id="otherAmount2" min="0.0" step="any" style="width: 100px;">
//                                         </label>

//                                     </div>
//                                 `,
//                                 html: true,
//                                 //showCancelButton: true,
//                                 confirmButtonText: "Proceed",
//                                 closeOnConfirm: false,
//                             }, function () {
//                                 let selectedType = document.querySelector('input[name="boPaymentType"]:checked');
//                                 if (!selectedType) {
//                                     swal({
//                                         title: "Error",
//                                         text: "Please select a BO Payment Type.",
//                                         type: "error"
//                                     }, function () {
//                                         // Reopen modal on OK
//                                         setTimeout(() => {
//                                             showBOPaymentModal();
//                                         }, 100); // delay just enough to avoid overlap
//                                     });
//                                     return false;
//                                 }
                        
//                                 let paymentType = selectedType.value;
//                                 let boValue = parseFloat(data.total_bo_admin);
                        
//                                 if (paymentType === "cash") {
//                                     cash.value = formatNumber((parseFloat(cash.value.replace(/,/g, '')) - boValue).toFixed(2));
//                                 } else if (paymentType === "dated_check") {
//                                     dc_amt.value = formatNumber((parseFloat(dc_amt.value.replace(/,/g, '')) - boValue).toFixed(2));
//                                 } else if (paymentType === "pdc") {
//                                     pdc_amt.value = formatNumber((parseFloat(pdc_amt.value.replace(/,/g, '')) - boValue).toFixed(2));
//                                 } else if (paymentType === "cash_dc" || paymentType === "cash_pdc") {
//                                     let cashAmount = parseFloat(document.getElementById("cashAmount").value) || 0;
//                                     let otherAmount = parseFloat(document.getElementById("otherAmount").value) || 0;
                        
//                                     if ((cashAmount + otherAmount) != boValue) {
//                                     // swal.showInputError("The total entered must be equal to the BO amount.");
//                                     swal({
//                                         title: "Error",
//                                         text: "The total entered must be equal to the BO amount.",
//                                         type: "error"
//                                         }, function () {
//                                             // Reopen modal on OK
//                                             setTimeout(() => {
//                                                 showBOPaymentModal();
//                                             }, 100); // delay just enough to avoid overlap
//                                         });
//                                         return false;
//                                     }
                                    
//                                     if(paymentType === "cash_dc" && otherAmount >  dcVal){
//                                         swal({
//                                             title: "Error",
//                                             text: "The entered BO amount for DC must not exceed the available DC amount.",
//                                             type: "error"
//                                             }, function () {
//                                                 // Reopen modal on OK
//                                                 setTimeout(() => {
//                                                     showBOPaymentModal();
//                                                 }, 100); // delay just enough to avoid overlap
//                                             });
//                                         return false;
//                                     }

//                                     if(paymentType === "cash_pdc" && otherAmount >  pdcVal){
//                                         swal({
//                                             title: "Error",
//                                             text: "The entered BO amount for PDC must not exceed the available PDC amount.",
//                                             type: "error"
//                                             }, function () {
//                                                 // Reopen modal on OK
//                                                 setTimeout(() => {
//                                                     showBOPaymentModal();
//                                                 }, 100); // delay just enough to avoid overlap
//                                             });
//                                         return false;
//                                     }
                        
//                                     cash.value = formatNumber((parseFloat(cash.value.replace(/,/g, '')) - cashAmount).toFixed(2));
                        
//                                     if (paymentType === "cash_dc") {
//                                         dc_amt.value = formatNumber((parseFloat(dc_amt.value.replace(/,/g, '')) - otherAmount).toFixed(2));
//                                     } else {
//                                         pdc_amt.value = formatNumber((parseFloat(pdc_amt.value.replace(/,/g, '')) - otherAmount).toFixed(2));
//                                     }
//                                 } else if (paymentType === "cash_pdc_dc") {
//                                     let cashAmount = parseFloat(document.getElementById("cashAmount").value) || 0;
//                                     let otherAmount = parseFloat(document.getElementById("otherAmount").value) || 0;
//                                     let otherAmount2 = parseFloat(document.getElementById("otherAmount2").value) || 0;
                                
//                                     if ((cashAmount + otherAmount + otherAmount2) != boValue) {
//                                         swal({
//                                             title: "Error",
//                                             text: "The total entered must be equal to the BO amount.",
//                                             type: "error"
//                                         }, function () {
//                                             // Reopen modal on OK
//                                             setTimeout(() => {
//                                                 showBOPaymentModal();
//                                             }, 100); // delay just enough to avoid overlap
//                                         });
//                                         return false;
//                                     }

//                                     if(paymentType === "cash_pdc_dc" && otherAmount2 >  pdcVal){
//                                         swal({
//                                             title: "Error",
//                                             text: "The entered BO amount for PDC must not exceed the available PDC amount.",
//                                             type: "error"
//                                             }, function () {
//                                                 // Reopen modal on OK
//                                                 setTimeout(() => {
//                                                     showBOPaymentModal();
//                                                 }, 100); // delay just enough to avoid overlap
//                                             });
//                                         return false;
//                                     }

//                                     if(paymentType === "cash_pdc_dc" && otherAmount >  dcVal){
//                                         swal({
//                                             title: "Error",
//                                             text: "The entered BO amount for DC must not exceed the available DC amount.",
//                                             type: "error"
//                                             }, function () {
//                                                 // Reopen modal on OK
//                                                 setTimeout(() => {
//                                                     showBOPaymentModal();
//                                                 }, 100); // delay just enough to avoid overlap
//                                             });
//                                         return false;
//                                     }
                                
//                                     cash.value = formatNumber((parseFloat(cash.value.replace(/,/g, '')) - cashAmount).toFixed(2));
//                                     dc_amt.value = formatNumber((parseFloat(dc_amt.value.replace(/,/g, '')) - otherAmount).toFixed(2));
//                                     pdc_amt.value = formatNumber((parseFloat(pdc_amt.value.replace(/,/g, '')) - otherAmount2).toFixed(2));
//                                 }
                        
//                                 swal({
//                                     title: "Success",
//                                     text: "BO payment has been successfully applied.",
//                                     type: "success"
//                                 });
//                             });
                        
//                             setTimeout(() => {
//                                 document.querySelectorAll('input[name="boPaymentType"]').forEach((radio) => {
//                                     radio.addEventListener("change", function (e) {
//                                         let amountInputs = document.getElementById("amountInputs");
//                                         let secondLabel = document.getElementById("secondLabel");
//                                         let thirdLabel = document.getElementById("thirdLabel");
                                
//                                         amountInputs.style.display = "none";
//                                         secondLabel.style.display = "none";
//                                         thirdLabel.style.display = "none";
                                
//                                         if (e.target.value === "cash_dc" || e.target.value === "cash_pdc" || e.target.value === "cash_pdc_dc") {
//                                             amountInputs.style.display = "block";
                                
//                                             if (e.target.value === "cash_dc") {
//                                                 secondLabel.style.display = "block";
//                                                 secondLabel.innerHTML = 'DC Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"  id="otherAmount" min="0.0" step="any" style="width: 100px;">';
//                                             } else if (e.target.value === "cash_pdc") {
//                                                 secondLabel.style.display = "block";
//                                                 secondLabel.innerHTML = 'PDC Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" id="otherAmount" min="0.0" step="any" style="width: 100px;">';
//                                             } else if (e.target.value === "cash_pdc_dc") {
//                                                 secondLabel.style.display = "block";
//                                                 secondLabel.innerHTML = 'DC Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" id="otherAmount" min="0.0" step="any" style="width: 100px;">';
                                
//                                                 thirdLabel.style.display = "block";
//                                                 thirdLabel.innerHTML = 'PDC Amount: <input type="text" class="formattedAmount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" id="otherAmount2" min="0.0" step="any" style="width: 100px;">';
//                                             }

                                            
//                                         }
//                                     });
//                                 });

//                                 const cashInput = document.getElementById("cashAmount");
//                                 const otherInput = document.getElementById("otherAmount");
//                                 const otherInput2 = document.getElementById("otherAmount2");

//                                 [cashInput, otherInput, otherInput2].forEach(input => {
//                                     if (input) {
//                                         input.addEventListener("input", function () {
//                                             let cursorPos = input.selectionStart;
//                                             let formatted = formatWithCommasAndDecimals(this.value);
//                                             this.value = formatted;
//                                             input.setSelectionRange(cursorPos, cursorPos); 
//                                         });
//                                     }
//                                 });
//                             }, 150);

                            
//                         }

//                         function formatWithCommasAndDecimals(value) {
//                             let num = parseFloat(value.replace(/,/g, ''));
//                             if (isNaN(num)) return '';
//                             return num.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
//                         }
                        
                        
//                         calculatetotal();
//                     }
//                 });
//             }
//         });
//     });

// }

function getcollection(id_no, ndate) {

    swal({
        title: "Enter Batch Number",
        text: "Please provide the batch number:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "e.g. 1"
    },
    function(batch_no) {
        if (batch_no === false) return; // Cancelled
        if (batch_no === "" || batch_no.trim() === "" || isNaN(batch_no) || parseInt(batch_no) < 0) {
            swal.showInputError("Batch number is required!");
            return;
        }

        // Optional: You can show loader or confirmation here
        swal({
            title: "Proceed to get collection?",
            text: "Batch Number: " + batch_no,
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            cancelButtonText: "No",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
            closeOnCancel: true,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                var final2          = document.getElementById('totalremittance');
                var final2_collect  = document.getElementById('totalcollection2');
                var dc_amt          = document.getElementById('dc');
                var cash            = document.getElementById('totalcash_ldi');
                var dc_pcs          = document.getElementById('dc_pcs');
                var pdc_amt         = document.getElementById('pdc');
                var pdc_pcs         = document.getElementById('pdc_pcs');
                var returns         = document.getElementById('totalreturns');
                var return_no       = document.getElementById('totalreturns_no');
                var pay_id          = document.getElementById('totalpay_id');
                var tax             = document.getElementById('totaltax');
                var bo              = document.getElementById('totalbo');
                var bo_id           = document.getElementById('totalbo_id');
                var bo_si           = document.getElementById('totalbo_si');
                var palawan         = document.getElementById('totalpalawan');
                var paypal_id       = document.getElementById('totalpaypal_id');

                //var bo_disc = document.getElementById('totalbo_disc').textContent;
                var bo_disc = $('#totalbo_disc').text();
                
                $.ajax({
                    url: baseurl + 'get_collection',
                    type: 'POST',
                   // data: { id_no: id_no, ndate: ndate },
                    data: { id_no: id_no, ndate: ndate, batch_no: batch_no },
                    dataType: 'JSON',
                    error: function () {
                        swal.close();
                        alert('Something is wrong');
                        
                    },
                    success: function (data) {

                        
                        final2.value            = formatNumber(parseFloat(data.total).toFixed(2));
                        final2_collect.value    = formatNumber(parseFloat(data.total).toFixed(2));
                        returns.value           = formatNumber(parseFloat(data.total_return).toFixed(2));
                        dc_amt.value            = formatNumber(parseFloat(data.dc_amt).toFixed(2));
                        dc_pcs.value            = data.dc_pcs;
                        pdc_amt.value           = formatNumber(parseFloat(data.pdc_amt).toFixed(2));
                        cash.value              = formatNumber(parseFloat(data.cash).toFixed(2));
                        tax.value               = formatNumber(parseFloat(data.total_tax).toFixed(2));
                        bo.value                = formatNumber(parseFloat(data.total_bo).toFixed(2));
                        palawan.value           = formatNumber(parseFloat(data.palawan).toFixed(2));
                        document.getElementById('totalbo_disc').textContent = formatNumber(parseFloat(data.total_bo_disc).toFixed(2));
                        document.getElementById('bo_cm').textContent        = formatNumber(parseFloat(data.total_bo_cm).toFixed(2));
                        pdc_pcs.value           = data.pdc_pcs;
                        return_no.value         = data.return_no;
                        pay_id.value            = data.pay_id;
                        bo_id.value             = data.bo_id;
                        bo_si.value             = data.bo_si;
                        paypal_id.value         = data.pay_id_pal;

                        console.log(data.total_bo_admin);

                        // // Check if BO (Bad Order) is not null or zero
                        // if (parseFloat(data.total_bo_admin) > 0) {
                        //     showBOPaymentModal();
                        // }else{
                        //     
                        // }

                        // function showBOPaymentModal() {
                        //     let totalBO = parseFloat(data.total_bo_admin);
                        //     let cashVal = parseFloat(data.cash);
                        //     let dcVal = parseFloat(data.dc_amt);
                        //     let pdcVal = parseFloat(data.pdc_amt);

                        //     let cashDisabled = (cashVal === 0 || totalBO > cashVal) ? 'disabled' : '';
                        //     let dcDisabled = (dcVal === 0 || totalBO > dcVal) ? 'disabled' : '';
                        //     let pdcDisabled = (pdcVal === 0 || totalBO > pdcVal) ? 'disabled' : '';
                        //     let cashDcDisabled = (cashVal === 0 || dcVal === 0 || totalBO > (cashVal + dcVal)) ? 'disabled' : '';
                        //     let cashPdcDisabled = (cashVal === 0 || pdcVal === 0 || totalBO > (cashVal + pdcVal)) ? 'disabled' : '';
                        //     let cashPdcDcDisabled = (cashVal === 0 || dcVal === 0 || pdcVal === 0 || totalBO > (cashVal + dcVal + pdcVal)) ? 'disabled' : '';
                        
                        //     swal({
                        //         title: "Select BO Payment Type",
                        //         text: `
                        //             <div style="margin-top: 10px;">
                        //                 <strong>BO Admin Amount: <p style="color: red"> ₱${parseFloat(data.total_bo_admin).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</p></strong>
                                        
                        //             </div>
                        //             <div style="text-align: left; margin-top: 10px;">
                        //                 <label><input type="radio" name="boPaymentType" value="cash" ${cashDisabled}> Cash</label><br>
                        //                 <label><input type="radio" name="boPaymentType" value="dated_check" ${dcDisabled}> Dated Check</label><br>
                        //                 <label><input type="radio" name="boPaymentType" value="pdc" ${pdcDisabled}> Post-Dated Check</label><br>
                        //                 <label><input type="radio" name="boPaymentType" value="cash_dc" ${cashDcDisabled}> Cash & DC</label><br>
                        //                 <label><input type="radio" name="boPaymentType" value="cash_pdc" ${cashPdcDisabled}> Cash & PDC</label><br> 
                        //                 <label><input type="radio" name="boPaymentType" value="cash_pdc_dc" ${cashPdcDcDisabled}> Cash & (PDC, DC)</label>
                        //             </div>
                        //             <div id="amountInputs" style="display: none; margin-top: 10px;">
                        //                 <label>Cash Amount: <input type="number" id="cashAmount" min="0" step="0.01" style="width: 100px;"></label><br>
                        //                 <label id="secondLabel" style="display: none;">
                        //                     PDC Amount: <input type="number" id="otherAmount" min="0" step="0.01" style="width: 100px;">
                        //                 </label>
                        //                 <label id="thirdLabel" style="display: none;">
                        //                     PDC/DC Amount: <input type="number" id="otherAmount2" min="0" step="0.01" style="width: 100px;">
                        //                 </label>

                        //             </div>
                        //         `,
                        //         html: true,
                        //         //showCancelButton: true,
                        //         confirmButtonText: "Proceed",
                        //         closeOnConfirm: false,
                        //     }, function () {
                        //         let selectedType = document.querySelector('input[name="boPaymentType"]:checked');
                        //         if (!selectedType) {
                        //             swal({
                        //                 title: "Error",
                        //                 text: "Please select a BO Payment Type.",
                        //                 type: "error"
                        //             }, function () {
                        //                 // Reopen modal on OK
                        //                 setTimeout(() => {
                        //                     showBOPaymentModal();
                        //                 }, 100); // delay just enough to avoid overlap
                        //             });
                        //             return false;
                        //         }
                        
                        //         let paymentType = selectedType.value;
                        //         let boValue = parseFloat(data.total_bo_admin);
                        
                        //         if (paymentType === "cash") {
                        //             cash.value = formatNumber((parseFloat(cash.value.replace(/,/g, '')) - boValue).toFixed(2));
                        //         } else if (paymentType === "dated_check") {
                        //             dc_amt.value = formatNumber((parseFloat(dc_amt.value.replace(/,/g, '')) - boValue).toFixed(2));
                        //         } else if (paymentType === "pdc") {
                        //             pdc_amt.value = formatNumber((parseFloat(pdc_amt.value.replace(/,/g, '')) - boValue).toFixed(2));
                        //             //final2.value = formatNumber((parseFloat(final2.value.replace(/,/g, '')) - boValue).toFixed(2));
                        //         } else if (paymentType === "cash_dc" || paymentType === "cash_pdc") {
                        //             let cashAmount = parseFloat(document.getElementById("cashAmount").value) || 0;
                        //             let otherAmount = parseFloat(document.getElementById("otherAmount").value) || 0;
                        //             let sum = parseFloat((cashAmount + otherAmount).toFixed(2)); // Round to 2 decimals

                        //             if (sum !== boValue) {
                                    
                        //             // swal.showInputError("The total entered must be equal to the BO amount.");

                        //             console.log("cashAmount:", cashAmount);
                        //             console.log("otherAmount:", otherAmount);
                        //             console.log("boValue:", boValue);

                        //             console.log(`cashAmount: ${cashAmount}, otherAmount: ${otherAmount}, sum: ${cashAmount + otherAmount}`);

                        //             swal({
                        //                 title: "Error",
                        //                 text: "The total entered must be equal to the BO amount.",
                        //                 type: "error"
                        //                 }, function () {
                        //                     // Reopen modal on OK
                        //                     setTimeout(() => {
                        //                         showBOPaymentModal();
                        //                     }, 100); // delay just enough to avoid overlap
                        //                 });
                        //                 return false;
                        //             }
                                    
                        //             if(paymentType === "cash_dc" && otherAmount >  dcVal){
                        //                 swal({
                        //                     title: "Error",
                        //                     text: "The entered BO amount for DC must not exceed the available DC amount.",
                        //                     type: "error"
                        //                     }, function () {
                        //                         // Reopen modal on OK
                        //                         setTimeout(() => {
                        //                             showBOPaymentModal();
                        //                         }, 100); // delay just enough to avoid overlap
                        //                     });
                        //                 return false;
                        //             }

                        //             if(paymentType === "cash_pdc" && otherAmount >  pdcVal){
                        //                 swal({
                        //                     title: "Error",
                        //                     text: "The entered BO amount for PDC must not exceed the available PDC amount.",
                        //                     type: "error"
                        //                     }, function () {
                        //                         // Reopen modal on OK
                        //                         setTimeout(() => {
                        //                             showBOPaymentModal();
                        //                         }, 100); // delay just enough to avoid overlap
                        //                     });
                        //                 return false;
                        //             }
                        
                        //             cash.value = formatNumber((parseFloat(cash.value.replace(/,/g, '')) - cashAmount).toFixed(2));
                        
                        //             if (paymentType === "cash_dc") {
                        //                 dc_amt.value = formatNumber((parseFloat(dc_amt.value.replace(/,/g, '')) - otherAmount).toFixed(2));
                        //             } else {
                        //                 pdc_amt.value = formatNumber((parseFloat(pdc_amt.value.replace(/,/g, '')) - otherAmount).toFixed(2));
                        //             }
                        //         } else if (paymentType === "cash_pdc_dc") {
                        //             let cashAmount = parseFloat(document.getElementById("cashAmount").value) || 0;
                        //             let otherAmount = parseFloat(document.getElementById("otherAmount").value) || 0;
                        //             let otherAmount2 = parseFloat(document.getElementById("otherAmount2").value) || 0;
                                
                        //             if ((cashAmount + otherAmount + otherAmount2) != boValue) {
                        //                 swal({
                        //                     title: "Error",
                        //                     text: "The total entered must be equal to the BO amount.",
                        //                     type: "error"
                        //                 }, function () {
                        //                     // Reopen modal on OK
                        //                     setTimeout(() => {
                        //                         showBOPaymentModal();
                        //                     }, 100); // delay just enough to avoid overlap
                        //                 });
                        //                 return false;
                        //             }

                        //             if(paymentType === "cash_pdc_dc" && otherAmount2 >  pdcVal){
                        //                 swal({
                        //                     title: "Error",
                        //                     text: "The entered BO amount for PDC must not exceed the available PDC amount.",
                        //                     type: "error"
                        //                     }, function () {
                        //                         // Reopen modal on OK
                        //                         setTimeout(() => {
                        //                             showBOPaymentModal();
                        //                         }, 100); // delay just enough to avoid overlap
                        //                     });
                        //                 return false;
                        //             }

                        //             if(paymentType === "cash_pdc_dc" && otherAmount >  dcVal){
                        //                 swal({
                        //                     title: "Error",
                        //                     text: "The entered BO amount for DC must not exceed the available DC amount.",
                        //                     type: "error"
                        //                     }, function () {
                        //                         // Reopen modal on OK
                        //                         setTimeout(() => {
                        //                             showBOPaymentModal();
                        //                         }, 100); // delay just enough to avoid overlap
                        //                     });
                        //                 return false;
                        //             }
                                
                        //             cash.value = formatNumber((parseFloat(cash.value.replace(/,/g, '')) - cashAmount).toFixed(2));
                        //             dc_amt.value = formatNumber((parseFloat(dc_amt.value.replace(/,/g, '')) - otherAmount).toFixed(2));
                        //             pdc_amt.value = formatNumber((parseFloat(pdc_amt.value.replace(/,/g, '')) - otherAmount2).toFixed(2));
                        //         }
                        
                        //         swal({
                        //             title: "Success",
                        //             text: "BO payment has been successfully applied.",
                        //             type: "success"
                        //         });
                        //     });
                        
                        //     setTimeout(() => {
                        //         document.querySelectorAll('input[name="boPaymentType"]').forEach((radio) => {
                        //             radio.addEventListener("change", function (e) {
                        //                 let amountInputs = document.getElementById("amountInputs");
                        //                 let secondLabel = document.getElementById("secondLabel");
                        //                 let thirdLabel = document.getElementById("thirdLabel");
                                
                        //                 amountInputs.style.display = "none";
                        //                 secondLabel.style.display = "none";
                        //                 thirdLabel.style.display = "none";
                                
                        //                 if (e.target.value === "cash_dc" || e.target.value === "cash_pdc" || e.target.value === "cash_pdc_dc") {
                        //                     amountInputs.style.display = "block";
                                
                        //                     if (e.target.value === "cash_dc") {
                        //                         secondLabel.style.display = "block";
                        //                         secondLabel.innerHTML = 'DC Amount: <input type="number" id="otherAmount" min="0" step="0.01" style="width: 100px;">';
                        //                     } else if (e.target.value === "cash_pdc") {
                        //                         secondLabel.style.display = "block";
                        //                         secondLabel.innerHTML = 'PDC Amount: <input type="number" id="otherAmount" min="0" step="0.01" style="width: 100px;">';
                        //                     } else if (e.target.value === "cash_pdc_dc") {
                        //                         secondLabel.style.display = "block";
                        //                         secondLabel.innerHTML = 'DC Amount: <input type="number" id="otherAmount" min="0" step="0.01" style="width: 100px;">';
                                
                        //                         thirdLabel.style.display = "block";
                        //                         thirdLabel.innerHTML = 'PDC Amount: <input type="number" id="otherAmount2" min="0" step="0.01" style="width: 100px;">';
                        //                     }
                        //                 }
                        //             });
                        //         });
                        //     }, 100);
                        // }
                        swal.close();
                        calculatetotal();
                    }
                });
            }
        });
    });
}

function getcollectionldi(id_no,ndate)
{
    var final2          = document.getElementById('totalremittance');
    var final2_collect  = document.getElementById('totalcollection2');
    var dc_amt          = document.getElementById('dc');
    var cash            = document.getElementById('totalcash_ldi');
    var dc_pcs          = document.getElementById('dc_pcs');
    var pdc_amt         = document.getElementById('pdc');
    var pdc_pcs         = document.getElementById('pdc_pcs');
    var returns         = document.getElementById('totalreturns');
    var bo              = document.getElementById('totalbo');
    var inc             = document.getElementById('totalincentives');
    var return_no       = document.getElementById('totalreturns_no');
    var pay_id          = document.getElementById('totalpay_id');
    var paysat_id       = document.getElementById('totalpaysat_id');
    var bo_id           = document.getElementById('totalbo_id');
    // For Monday
    var palawan         = document.getElementById('totalpalawan');
    var paypal_id       = document.getElementById('totalpaypal_id');
    var payutc_id = document.getElementById('totalpayutc_id');
    
    $.ajax({
        url: baseurl + 'get_collection_xtruck',
        type: 'POST',
        data: {id_no:id_no,ndate:ndate},
        dataType: 'JSON',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            
            final2.value            = formatNumber(parseFloat(data.total).toFixed(2));
            final2_collect.value    = formatNumber(parseFloat(data.total).toFixed(2));
            returns.value           = formatNumber(parseFloat(data.total_return).toFixed(2));
            dc_amt.value            = formatNumber(parseFloat(data.dc_amt).toFixed(2));
            dc_pcs.value            = data.dc_pcs;
            pdc_amt.value           = formatNumber(parseFloat(data.pdc_amt).toFixed(2));
            cash.value              = formatNumber(parseFloat(data.cash).toFixed(2));
            bo.value                = formatNumber(parseFloat(data.bo).toFixed(2));
            inc.value               = formatNumber(parseFloat(data.inc).toFixed(2));
            pdc_pcs.value           = data.pdc_pcs;
            return_no.value         = data.return_no;
            pay_id.value            = data.pay_id;
            paysat_id.value         = data.pay_id_sat;
            bo_id.value             = data.bo_id;
            // For Monday
            palawan.value         = formatNumber(parseFloat(data.palawan).toFixed(2));
            paypal_id.value       = data.pay_id_pal;
            payutc_id.value       = data.pay_id_utc;
            //alert(final2.value);
            calculatetotal();
            updateIncentiveDisplay();
            document.getElementById('saveButton').disabled = false;
        }
    });
}

function getcollectionldiaudit(id_no,start,end)
{
    var final2          = document.getElementById('totalremittance');
    var final2_collect  = document.getElementById('totalcollection2');
    var dc_amt          = document.getElementById('dc');
    var cash            = document.getElementById('totalcash_ldi');
    var dc_pcs          = document.getElementById('dc_pcs');
    var pdc_amt         = document.getElementById('pdc');
    var pdc_pcs         = document.getElementById('pdc_pcs');
    var returns         = document.getElementById('totalreturns');
    var bo              = document.getElementById('totalbo');
    var inc             = document.getElementById('totalincentives');
    var return_no       = document.getElementById('totalreturns_no');
    var pay_id          = document.getElementById('totalpay_id');
    var paysat_id       = document.getElementById('totalpaysat_id');
    var bo_id           = document.getElementById('totalbo_id');
    // For Monday
    var palawan         = document.getElementById('totalpalawan');
    var paypal_id       = document.getElementById('totalpaypal_id');
    var payutc_id = document.getElementById('totalpayutc_id');
    
    $.ajax({
        url: baseurl + 'get_collection_xtruck',
        type: 'POST',
        data: {id_no:id_no,start :start, end: end },
        dataType: 'JSON',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            
            final2.value            = formatNumber(parseFloat(data.total).toFixed(2));
            final2_collect.value    = formatNumber(parseFloat(data.total).toFixed(2));
            returns.value           = formatNumber(parseFloat(data.total_return).toFixed(2));
            dc_amt.value            = formatNumber(parseFloat(data.dc_amt).toFixed(2));
            dc_pcs.value            = data.dc_pcs;
            pdc_amt.value           = formatNumber(parseFloat(data.pdc_amt).toFixed(2));
            cash.value              = formatNumber(parseFloat(data.cash).toFixed(2));
            bo.value                = formatNumber(parseFloat(data.bo).toFixed(2));
            inc.value               = formatNumber(parseFloat(data.inc).toFixed(2));
            pdc_pcs.value           = data.pdc_pcs;
            return_no.value         = data.return_no;
            pay_id.value            = data.pay_id;
            paysat_id.value         = data.pay_id_sat;
            bo_id.value             = data.bo_id;
            // For Monday
            palawan.value         = formatNumber(parseFloat(data.palawan).toFixed(2));
            paypal_id.value       = data.pay_id_pal;
            payutc_id.value       = data.pay_id_utc;
            //alert(final2.value);
            calculatetotal();
            updateIncentiveDisplay();
            document.getElementById('saveButton').disabled = false;
        }
    });
}

// $(document).ready(function() {
//     $('#sm_denom_ledger').DataTable( {
//         "order": [[ 0, "desc" ]]
//     } );
// } );