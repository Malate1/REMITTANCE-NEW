function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }

// function calculatetotal() {
//     var myValue1 = document.getElementById('hamount-1000').value;
//     var myValue2 = document.getElementById('hamount-500').value;
//     var myValue3 = document.getElementById('hamount-200').value;
//     var myValue4 = document.getElementById('hamount-100').value;
//     var myValue5 = document.getElementById('hamount-50').value;
//     var myValue6 = document.getElementById('hamount-20').value;
//     var myValue71 = document.getElementById('coins').value;
//     var myValue7 = myValue71.replace(/,/g,'')
    
//     var myValue81 = document.getElementById('dc').value;
//     var myValue8 = myValue81.replace(/,/g,'');
//     var myValue91 = document.getElementById('pdc').value;
//     var myValue9 = myValue91.replace(/,/g,'');
//     var final2 = document.getElementById('totalcollection');

//     var final = document.getElementById('totalcash');
//     var final_cash = document.getElementById('totalcash_ldi');
//     //alert(final_cash.value);

//     //var finalCashValue = parseFloat(final_cash.value) || 0;
//     final.value = 0;
//     var myFinal = Number(myValue1) + Number(myValue2) + Number(myValue3) + Number(myValue4) + Number(myValue5) + Number(myValue6) + Number(myValue7);
    
//     var cleanedFinalCashValue = cleanAndParseFloat(final_cash.value) || 0;

//     final.value = formatNumber((parseFloat(myFinal) + cleanedFinalCashValue).toFixed(2));

//     // Function to clean and parse float
//     function cleanAndParseFloat(value) {
//         // Remove non-numeric characters
//         var cleanedValue = value.replace(/[^\d.]/g, '');
        
//         // Parse float
//         return parseFloat(cleanedValue);
//     }

//     // alert(final.value);
//     var myFinal2 = myFinal + Number(myValue8) + Number(myValue9)
//     final2.value = formatNumber(parseFloat(myFinal2).toFixed(2));
// }

  function calculatetotal() {
    var myValue1 = document.getElementById('hamount-1000').value;
    var myValue2 = document.getElementById('hamount-500').value;
    var myValue3 = document.getElementById('hamount-200').value;
    var myValue4 = document.getElementById('hamount-100').value;
    var myValue5 = document.getElementById('hamount-50').value;
    var myValue6 = document.getElementById('hamount-20').value;
    var myValue71 = document.getElementById('coins').value;
    var myValue7 = myValue71.replace(/,/g,'')
    var final = document.getElementById('totalcash');
    var final_cash = document.getElementById('totalcash_ldi');
    var myValue81 = document.getElementById('dc').value;
    var myValue8 = myValue81.replace(/,/g,'');
    var myValue91 = document.getElementById('pdc').value;
    var myValue9 = myValue91.replace(/,/g,'');
    var final2 = document.getElementById('totalcollection');
    var final2_rem = document.getElementById('totalremittance');
    var final2_ldi = document.getElementById('totalcollection2');
    // var remit = document.getElementById('totalremittance').value;
    // var remit2 = remit.replace(/,/g,'');
    var location  = $("[name='location']").val();
    // var myValuetax = document.getElementById('totaltax').value;
    // var myValuetax1 = myValuetax.replace(/,/g,'');

    // var myValuebo = document.getElementById('totalbo').value;
    // var myValuebo1 = myValuebo.replace(/,/g,'');

    // var myValueret = document.getElementById('totalreturns').value;
    // var myValueret1 = myValueret.replace(/,/g,'');

    // var deduct = Number(myValuetax1) + Number(myValuebo1);
    
    //alert(myValuetax1);
    final.value = 0;

    var myFinal = Number(myValue1) + Number(myValue2) + Number(myValue3) + Number(myValue4) + Number(myValue5) + Number(myValue6) + Number(myValue7);
    final.value = formatNumber(parseFloat(myFinal).toFixed(2));

    if (final2 !== null) {
        var myFinal2 = myFinal + Number(myValue8) + Number(myValue9);
        final2.value = formatNumber(parseFloat(myFinal2).toFixed(2));
        console.log(final2.value);
    }
    
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
    var cash = $("[name='totalcash']").val();
    var cash_ldi = $("[name='totalcash_ldi']").val();
    var returns = $("[name='totalreturns']").val();
    var expense = $("[name='expenses_amt']").val();
    var return_no = $("[name='totalreturns_no']").val();
    var pay_id  = $("[name='totalpay_id']").val();
    var location  = $("[name='location']").val();
    var bu  = $("[name='bu']").val();
    var coins2 = coins.replace(/,/g,'');
    var dc2 = dc.replace(/,/g,'');
    var pdc2 = pdc.replace(/,/g,'');
    var remit2 = remit.replace(/,/g,'');
    var expense2 = expense.replace(/,/g,'');
    var tax = $("[name='totaltax']").val();
    var bo = $("[name='totalbo']").val();
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

    if(cash_ldi!="" && cash=="0.00" && bu ==="OPLAN")
    {
        swal({
            title: "Total Cash Details is empty!",
            type: "error",
            showCancelbutton: false
        });
        return 0;
    }

    // const epsilon = 1.00;
    // const tolerance = 0.01; 
    // let cash1 = parseFloat(cash.replace(',', ''));
    // if (cash_ldi != "" || cash_ldi =="0.00") {
    //     let cash2 = parseFloat(cash_ldi);
    //     let result = Math.abs(cash1 - cash2); 

    //     console.log('Cash:', cash, 'Cash LDI:', cash_ldi);
    //     console.log('Result:', result);
    //     console.log('Cash LDI:', cash_ldi);


    //     if (cash_ldi != "" && result !== 0 && (result < epsilon || result > epsilon))
    //     {

    //         swal({
    //             title: "Cash remitted amount must be within plus/minus 1 to total cash from MyNetgosyo!",
    //             type: "error",
    //             showCancelButton: false
    //         });
    //         return 0;
    //     }
       
    // }

    const epsilon = 1.00;
    const tolerance = 0.01; 
    let cash1 = parseFloat(cash.replace(',', ''));

    if (location === "LDI" && bu ==="OPLAN") {
        let cash2 = parseFloat(cash_ldi.replace(',', ''));
        let result = Math.abs(cash1 - cash2);
        let result1 = result.toFixed();
        console.log('Cash1:', cash1);
        console.log('Cash2:', cash2);
        console.log('Result:', result);
        console.log('Result1:', result1);

        console.log('Cash LDI:', cash_ldi);

        if (result1 !== '0' && (result1 < epsilon || result1 > epsilon))
        {

            swal({
                title: "Cash remitted amount must be within plus/minus 1 to total cash from MyNetgosyo!",
                type: "error",
                showCancelButton: false
            });
            return 0;
        }
    }

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
    else
    {
        if(qty1000=="" && qty500=="" && qty200=="" && qty100=="" && qty50=="" && qty20=="" && dc=="" && pdc=="" && coins2=="")
        {
            swal({
                title: "No data to save!",
                type: "error",
                showCancelbutton: false
            });
        }
        else
        {
            if(qty1000==0 && qty500==0 && qty200==0 && qty100==0 && qty50==0 && qty20==0 && dc==0 && pdc==0 && coins2==0)
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
                            url: 'save_denom',
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
                                            window.location.replace(baseurl + 'sm_ledger');
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
    var expense = $("[name='expenses_amt']").val();
    var coins2 = coins.replace(/,/g,'');
    var dc2 = dc.replace(/,/g,'');
    var pdc2 = pdc.replace(/,/g,'');
    var remit2 = remit.replace(/,/g,'');
    var expense2 = expense.replace(/,/g,'');
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
    // if(expense2!="" && exp=="")
    // {
    //     swal({
    //         title: "Expenses Details is empty!",
    //         type: "error",
    //         showCancelbutton: false
    //     });
    //     return 0;
    // }
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

function deletecashier_content(ids, denomid)
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
                data: { ids:ids,
                        denomid:denomid
                },
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

function getcollection(id_no,ndate)
{
    var final2 = document.getElementById('totalremittance');
    var final2_collect = document.getElementById('totalcollection2');
    var dc_amt = document.getElementById('dc');
    var cash = document.getElementById('totalcash_ldi');
    var dc_pcs = document.getElementById('dc_pcs');
    var pdc_amt = document.getElementById('pdc');
    var pdc_pcs = document.getElementById('pdc_pcs');
    var returns = document.getElementById('totalreturns');
    var return_no = document.getElementById('totalreturns_no');
    var pay_id = document.getElementById('totalpay_id');
    $.ajax({
        url: baseurl + 'get_collection',
        type: 'POST',
        data: {id_no:id_no,ndate:ndate},
        dataType: 'JSON',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            // $("#viewallsmdenom_content").html(data);
            // final2.value = formatNumber(parseFloat(data.total).toFixed(2));
            final2.value = formatNumber((parseFloat(data.total) + parseFloat(data.total_return)).toFixed(2));
            final2_collect.value = formatNumber(parseFloat(data.total).toFixed(2));
            returns.value = formatNumber(parseFloat(data.total_return).toFixed(2));
            dc_amt.value = formatNumber(parseFloat(data.dc_amt).toFixed(2));
            dc_pcs.value = data.dc_pcs;
            pdc_amt.value = formatNumber(parseFloat(data.pdc_amt).toFixed(2));
            cash.value = formatNumber(parseFloat(data.cash).toFixed(2));
            pdc_pcs.value = data.pdc_pcs;
            return_no.value = data.return_no;
            pay_id.value = data.pay_id;

            //alert(cash.value);
            calculatetotal();
        }
    });
}

$(document).ready(function() {
    $('#sm_denom_ledger').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );