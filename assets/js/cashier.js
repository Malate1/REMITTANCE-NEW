$('.customer-cashier').DataTable( {
    "ajax": baseurl + "get_customer",
    "bDestroy": true,
    "columns": [
            { "data": "code" },
            { "data": "name" },
            { "data": "address1" },
            { "data": "action" }
        ],
    "scrollX": true
});

$('#submit_cashier_payment').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    swal({
        title: "Proceed saving payment?",
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
                url: baseurl + 'save_cashier_payment',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data=='exist')
                    {
                        swal({
                            title: "Check no. is already used by another Salesman or Cashier!",
                            type: "error",
                            showCancelbutton: false,
                            closeModal: false
                        });
                    }
                    else
                    {
                        swal({
                            title: "Payment successfully saved!",
                            type: "success",
                            showCancelbutton: false,
                            closeModal: false,
                            timer: 1000
                        },
                        function() {
                                window.location.reload();
                        }
                        );
                        // swal({
                        //     title: 'Payment successfully saved!',
                        //     type: "success",
                        //     showCancelbutton: false,
                        //     timer: 1000,
                        // })
                        // .then(() => {
                        //     window.location.reload();
                        // })
                    }
                }
            });
            }
        }
        );
});

$('#edit_salesman').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    swal({
        title: "Proceed changing salesman?",
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
                url: baseurl + 'save_salesman',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    swal({
                        title: "Record successfully updated!",
                        type: "success",
                        showCancelbutton: false,
                        closeModal: false,
                        timer: 1000
                    },
                    function() {
                            window.location.reload();
                    }
                    );
                }
            });
            }
        }
        );
});

function cashier_form_date()
{
    var ddate = $("[name='datenow']").val();
    window.location = 'cashpaydata/'+ddate;
}


$(document).ready(function() {
    $('#cashier_denom_ledger').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );

$(document).ready(function() {
    $('#cashier_sm_ledger').DataTable( {
        "scrollX": true,
        "fixedColumns":   {
            "leftColumns": 1,
            "rightColumns": 1
        },
        "columnDefs": [
            {
                "orderable": false,  // Set orderable to false for the first column (index 0)
                "targets": 0
            }
        ]

    } );
} );

$(document).ready(function() {
    $('#check_clear_ledger').DataTable( {
        "scrollX": true
    } );
} );

$('#edit_cashier_payment').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    swal({
        title: "Proceed updating payment?",
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
                url: baseurl + 'edit_cashier_payment',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {  
                    if(data=='exist')
                    {
                        swal({
                            title: "Check no. is already used by another Salesman or Cashier!",
                            type: "error",
                            showCancelbutton: false,
                            closeModal: false
                        });
                    }
                    else
                    {
                        swal({
                            title: "Payment successfully updated!",
                            type: "success",
                            showCancelbutton: false,
                            closeModal: false
                        },
                        function(isok) {
                            if(isok){
                                window.history.back();
                            }
                        }
                        );
                    }
                }
            });
            }
        }
        );
});

function approve_sm_denom(ids)
{
    swal({
        title: "Are you sure to approve this salesman denomination?",
        text: "",
        type: "warning",
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
                url: baseurl + 'approve_sm_denom',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data=='none')
                    {
                        swal({
                            title: "Can't approve denomination. Total Collection is still empty!",
                            type: "error",
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
                    else
                    {
                        swal({
                            title: "Salesman denomination successfully approved!",
                            type: "success",
                            showCancelbutton: false,
                            closeModal: false
                        },
                        function(isok) {
                            if(isok){
                                window.open(baseurl + 'printdenom/'+ids, '_blank');
                                window.location.reload();

                            }
                        }
                        );
                    }
                }
            });
          }
      }
      );
}

function approve_sm_denomldi(ids)
{
    swal({
        title: "Are you sure to approve this salesman denomination?",
        text: "",
        type: "warning",
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
                url: baseurl + 'approve_sm_denom',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data=='none')
                    {
                        swal({
                            title: "Can't approve denomination. Total Collection is still empty!",
                            type: "error",
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
                    else
                    {
                        swal({
                            title: "Salesman denomination successfully approved!",
                            type: "success",
                            showCancelbutton: false,
                            closeModal: false
                        },
                        function(isok) {
                            if(isok){
                                window.open(baseurl + 'printdenomldi/'+ids, '_blank');
                                window.location.reload();

                            }
                        }
                        );
                    }
                }
            });
          }
      }
      );
}

function approve_sm_denoms(ids)
{
    swal({
        title: "Are you sure to approve this salesman denominations?",
        text: "",
        type: "warning",
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
                url: baseurl + 'approve_sm_denoms',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {

                   console.log('Data received:', data);
                    if(data.success)
                    {
                        

                        swal({
                            title: data.message,
                            type: "success",
                            showCancelbutton: false,
                            closeModal: false
                        },
                            function(isok) {
                                if(isok){
                                    // Assuming ids is an array of multiple ids
                                    const uniqueIds = new Set(ids);

                                    uniqueIds.forEach(function(id) {
                                        window.open(baseurl + 'printdenom/' + id, '_blank');
                                    });
                                    window.location.reload();

                                    // var table_denom = $('#cashier_sm_ledger').DataTable();
                                    // table_denom.destroy();
                                    // //var currentPage = table_denom.page();

                                    // table_denom.ajax.reload();
                                }
                            }
                        );
                    }
                    else
                    {
                        swal({
                            title: "Can't approve denomination. Total Collection is still empty!",
                            type: "error",
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
                }
            });
          }
      }
      );
}

function approve_sm_denomsldi(ids)
{
    swal({
        title: "Are you sure to approve this salesman denominations?",
        text: "",
        type: "warning",
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
                url: baseurl + 'approve_sm_denoms',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {

                   console.log('Data received:', data);
                    if(data.success)
                    {
                        

                        swal({
                            title: data.message,
                            type: "success",
                            showCancelbutton: false,
                            closeModal: false
                        },
                            function(isok) {
                                if(isok){
                                    // Assuming ids is an array of multiple ids
                                    const uniqueIds = new Set(ids);

                                    uniqueIds.forEach(function(id) {
                                        window.open(baseurl + 'printdenomldi/' + id, '_blank');
                                    });
                                    window.location.reload();

                                    // var table_denom = $('#cashier_sm_ledger').DataTable();
                                    // table_denom.destroy();
                                    // //var currentPage = table_denom.page();

                                    // table_denom.ajax.reload();
                                }
                            }
                        );
                    }
                    else
                    {
                        swal({
                            title: "Can't approve denomination. Total Collection is still empty!",
                            type: "error",
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
                }
            });
          }
      }
      );
}

function checkstatus(ids,status)
{
    $.ajax({
        url: baseurl + 'update_status',
        type: 'POST',
        data: {ids:ids,status:status},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
           
        }
    });
}

function check_remarks(ids)
{
    $.ajax({
        url: baseurl + 'check_remarks',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#check_remarks").html(data);
        }
    });
}

function cashier_remarks(ids)
{
    $.ajax({
        url: baseurl + 'cashier_remarks',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#remarks_content").html(data);
        }
    });
}

function cashier_backdate(ids)
{
    $.ajax({
        url: baseurl + 'cashier_backdate',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#backdate_content").html(data);
        }
    });
}

function cashier_remarks2(ids)
{
    $.ajax({
        url: baseurl + 'cashier_remarks2',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#remarks_content").html(data);
        }
    });
}

function cashier_remittance(ids)
{
    $.ajax({
        url: baseurl + 'cashier_remittance',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#remittance_content").html(data);
        }
    });
}

function disapprove_sm_denom(ids)
{
    swal({
        title: "Are you sure to disapprove this salesman denomination?",
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
                url: baseurl + 'disapprove_sm_denom',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {           
                    swal({
                        title: "Salesman denomination successfully disapproved!",
                        type: "success",
                        showCancelbutton: false,
                        closeModal: false
                    },
                    function(isok) {
                        if(isok){
                            window.location.reload();
                            // var table_denom = $('#cashier_sm_ledger').DataTable();
                            // table_denom.destroy();
                            // //var currentPage = table_denom.page();

                            // table_denom.ajax.reload();
                        }
                    }
                    );
                }
            });
          }
      }
      );
}

function viewcashierpayment_content(ids)
{
    $.ajax({
        url: baseurl + 'view_cashier_payment',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewcashierpayment_content").html(data);
        }
    });
}

function cashiersm_form_date()
{
    var ddate = $("[name='datenow']").val();
    window.location = 'smdenomdata/'+ddate;
    // window.open('smdenomdata/'+ddate, '_blank');
}

function checkclearing_form_date()
{
    var ddate = $("[name='datenow']").val();
    var type = $('input[name="reportradio"]:checked').val();
    window.location = 'checkclearing/'+ddate+'/'+type;
    // window.open('smdenomdata/'+ddate, '_blank');
}

function account_form_date()
{
    var ddate = $("[name='datenow']").val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('accountreport/'+ddate, '_blank');
}

function colsum_date()
{
    var ddate = $("[name='datenow']").val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('colsumreport/'+ddate, '_blank');
}

function pdcdc_form_date()
{
    var ddate = $("[name='datenow']").val();
    var ddate1 = $("[name='datenow1']").val();
    var type = $('input[name="reportradio"]:checked').val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('pdcdcreport/'+ddate+'/'+type+'/'+ddate1, '_blank');
}

function pdcdc_excel_date()
{
    var ddate = $("[name='datenow']").val();
    var ddate1 = $("[name='datenow1']").val();
    var type = $('input[name="reportradio"]:checked').val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('pdcdcreport2/'+ddate+'/'+type+'/'+ddate1);
}

function pdcdc_form_date2()
{
    var ddate = $("[name='datenow']").val();
    var ddate1 = $("[name='datenow1']").val();
    var type = $('input[name="reportradio"]:checked').val();
    var type2 = $('input[name="reportradiotype"]:checked').val();
    var bank = $("[name='bank']").val();
    var utype = $("[name='utype']").val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('pdcdcreport_uwdg/'+ddate+'/'+type+'/'+ddate1+'/'+type2+'/'+bank+'/'+utype, '_blank');
}

function pdcdc_excel_date2()
{
    var ddate = $("[name='datenow']").val();
    var ddate1 = $("[name='datenow1']").val();
    var type = $('input[name="reportradio"]:checked').val();
    var type2 = $('input[name="reportradiotype"]:checked').val();
    var bank = $("[name='bank']").val();
    var utype = $("[name='utype']").val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('pdcdcreport2_uwdg/'+ddate+'/'+type+'/'+ddate1+'/'+type2+'/'+bank+'/'+utype);
}

function accountrecord_form_date()
{
    var ddate = $("[name='datenow']").val();
    window.location = 'accountrecord/'+ddate;
    // window.open('accountrecord/'+ddate);
}

function print_denom(ids)
{
    // window.location = 'smdenomdata/'+ddate;
    window.open(baseurl + 'printdenom/'+ids, '_blank');
}

function print_denomldi(ids)
{
    // window.location = 'smdenomdata/'+ddate;
    window.open(baseurl + 'printdenomldi/'+ids, '_blank');
}

function upload_payments(ids)
{
    swal({
        title: "Are you sure to upload the data to ARIS?",
        text: "",
        type: "warning",
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
                url: baseurl + 'upload_payments',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // alert(data);    
                    swal({
                        title: "Data successfully uploaded!",
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

function customer_check(ids)
{
    $.ajax({
        url: baseurl + 'custagging',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            // $("#sm_content").html(data);
            // alert(data);
        }
    });
}

function print_alldenom(dates)
{
    // window.location = 'smdenomdata/'+ddate;
    window.open(baseurl + 'printalldenom/'+dates, '_blank');
}

function print_alldenom_LDI(dates)
{
    // window.location = 'smdenomdata/'+ddate;
    var loc = $("[name='loc']").val();
    //console.log(loc);
    window.open(baseurl + 'printalldenom_LDI/'+dates+'/'+loc, '_blank');
}

function print_alldenom_LDI_cashier(dates)
{
    // window.location = 'smdenomdata/'+ddate;
    window.open(baseurl + 'printalldenom_LDI_cashier/'+dates, '_blank');
}

function print_alldenom_uwdg(dates)
{
    // window.location = 'smdenomdata/'+ddate;
    var utype = $("[name='utype']").val();
    window.open(baseurl + 'printalldenom_uwdg/'+dates+'/'+utype, '_blank');
}

function sm_edit(ids)
{
    $.ajax({
        url: baseurl + 'edit_salesman',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#sm_content").html(data);
        }
    });
}

function cus_tagging(dates,ids)
{
    $.ajax({
        url: baseurl + 'cus_tag',
        type: 'POST',
        data: {ids:ids,dates:dates},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#cus_content").html(data);
        }
    });
}

$("#code").keydown(function(e){
    e.preventDefault();
});

$("#name").keydown(function(e){
    e.preventDefault();
});

function customer_masterfile()
{
    $(".customermasterfile").html(
        'Loading, Please wait...'
    )
    setTimeout(function(){
        $(".customermasterfile").html(
            '<table class="table table-bordered customer-cashier-sm compact" width="100%" cellspacing="0">'+
            '<thead>'+
                '<tr>'+
                    '<th>Code</th>'+
                    '<th>Name</th>'+
                    '<th>Address</th>'+
                    '<th>Action</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody></tbody>'+
        '</table>'
        );

        $('.customer-cashier-sm').DataTable( {
            "ajax": baseurl + "get_customer1",
            "bDestroy": true,
            "columns": [
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "address1" },
                    { "data": "action" }
                ],
            "scrollX": true
        });
    }, 1000);
}

function customer_masterfile2()
{
    $("#customer2").html(
        'Loading, Please wait...'
    )
    setTimeout(function(){
        $("#customer2").html(
            '<table class="table table-bordered customer-cashier-sm1 compact" width="100%" cellspacing="0">'+
            '<thead>'+
                '<tr>'+
                    '<th>Code</th>'+
                    '<th>Name</th>'+
                    '<th>Address</th>'+
                    '<th>Action</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody></tbody>'+
        '</table>'
        );

        $('.customer-cashier-sm1').DataTable( {
            "ajax": baseurl + "get_customer2",
            "bDestroy": true,
            "columns": [
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "address1" },
                    { "data": "action" }
                ],
            "scrollX": true
        });
    }, 1000);
}

function customer_masterfile3()
{
    $(".customermasterfile2").html(
        'Loading, Please wait...'
    )
    setTimeout(function(){
        $(".customermasterfile2").html(
            '<table class="table table-bordered customer-master2 compact" width="100%" cellspacing="0">'+
            '<thead>'+
                '<tr>'+
                    '<th>Code</th>'+
                    '<th>Name</th>'+
                    '<th>Address</th>'+
                    '<th>Action</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody></tbody>'+
        '</table>'
        );

        $('.customer-master2').DataTable( {
            "ajax": baseurl + "get_customer3",
            "bDestroy": true,
            "columns": [
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "address1" },
                    { "data": "action" }
                ],
            "scrollX": true
        });
    }, 1000);
}

function customer_masterfile4()
{
    $(".customermasterfile3").html(
        'Loading, Please wait...'
    )
    setTimeout(function(){
        $(".customermasterfile3").html(
            '<table class="table table-bordered customer-master3 compact" width="100%" cellspacing="0">'+
            '<thead>'+
                '<tr>'+
                    '<th>Code</th>'+
                    '<th>Name</th>'+
                    '<th>Address</th>'+
                    '<th>Action</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody></tbody>'+
        '</table>'
        );

        $('.customer-master3').DataTable( {
            "ajax": baseurl + "get_customer4",
            "bDestroy": true,
            "columns": [
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "address1" },
                    { "data": "action" }
                ],
            "scrollX": true
        });
    }, 1000);
}

function selected_customer(code,name)
{
    var ccode = document.getElementById('code');
    var cname = document.getElementById('name');
    ccode.value = code;
    cname.value = name;
    $("#customerModal").modal("hide");
}

function selected_customer2(code,name)
{
    var ccode = document.getElementById('code1');
    var cname = document.getElementById('name1');
    ccode.value = code;
    cname.value = name;
    $("#customerModal2").modal("hide");
}

function selected_customer3(code,name)
{
    $.ajax({
        url: baseurl + 'transfer_customer',
        type: 'POST',
        data: {code:code,name:name},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#customerModal3").modal("hide");
            swal({
                title: "Customer successfully transfered!",
                type: "success",
                showCancelbutton: false,
                closeModal: false,
                timer: 1000
            }
            );
        }
    });
}

function selected_customer4(code,name,addr)
{
    $.ajax({
        url: baseurl + 'transfer_customer2',
        type: 'POST',
        data: {code:code,name:name,addr:addr},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#customerModal4").modal("hide");
            swal({
                title: "Customer successfully transfered!",
                type: "success",
                showCancelbutton: false,
                closeModal: false,
                timer: 1000
            }
            );
        }
    });
}

function accountname(acc_code)
{
    var accname = document.getElementById('accname');
    $.ajax({
        url: baseurl + 'get_accname',
        type: 'POST',
        data: {acc_code:acc_code},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            // alert(data);
            if(data!='none')
            {
                accname.value = data;
            }
        }
    });
}

// function selected_customer3(code,name)
// {
//     var ccode = document.getElementById('code');
//     var cname = document.getElementById('name');
//     ccode.value = code;
//     cname.value = name;
//     document.getElementById("customer_masterfile").style.display = "none";
// }

function remittance_check(data)
{
    if(data==true)
    {
        var remit = document.getElementById('totalremittance');
        remit.value = document.getElementById('totalcollection').value;
    }
    else
    {
        var remit = document.getElementById('totalremittance');
        remit.value = 0.00;
    }
}

function backpage()
{
    window.history.back();
}

function refresh()
{
    location.reload();
}

$('#submit_sm_payment').on("submit", function(e){
    var amt = $("[name='amount']").val();
    var amt2 = amt.replace(/,/g,'');
    // if(isNaN(amt2)==true)
    // {
    //     swal({
    //         title: "Check amount has invalid number!",
    //         type: "error",
    //         showCancelbutton: false
    //     });
    // }
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    swal({
        title: "Proceed saving payment?",
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
                url: baseurl + 'save_sm_payment',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    if(data=='DC' || data=='PDC')
                    {
                        swal({
                            title: data + " amount error!",
                            text: "Cashier's total " + data + " amount is greater than the Salesman entered " + data + " amount!",
                            type: "error",
                            showCancelbutton: false,
                            closeModal: false
                        });
                    }
                    else
                    {
                        if(data=='exist')
                        {
                            swal({
                                title: "Check no. is already used by another Salesman or Cashier!",
                                type: "error",
                                showCancelbutton: false,
                                closeModal: false
                            });
                        }  
                        else
                        {
                            swal({
                                title: "Payment successfully saved!",
                                type: "success",
                                showCancelbutton: false,
                                closeModal: false,
                                timer: 1000
                            },
                            function() {
                                    window.location.reload();
                            }
                            );
                        }
                    }
                }
            });
            }
        }
        );
});

function viewsm_checks(userid,paydate)
{
    $.ajax({
        url: baseurl + 'view_sm_checks',
        type: 'POST',
        data: {userid:userid,paydate:paydate},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#viewsmchecks_content").html(data);
        }
    });
}

function edit_sm_check(ids)
{
    $.ajax({
        url: baseurl + 'edit_sm_check',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

$('#checkremarks_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
        $.ajax({
        url: baseurl + 'save_remarks2',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $("#checkRemarks").modal("hide");
            // swal({
            //     title: "Remarks successfully saved!",
            //     type: "success",
            //     showCancelbutton: false,
            //     closeModal: false
            // },
            // function(isok) {
            //     if(isok){
            //         $("#cashierRemarks").modal("hide");
            //         window.location.reload();
            //     }
            // }
            // );
        }
    });
});

$('#remarks_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
        $.ajax({
        url: baseurl + 'save_remarks',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            swal({
                title: "Remarks successfully saved!",
                type: "success",
                showCancelbutton: false,
                closeModal: false
            },
            function(isok) {
                if(isok){
                    $("#cashierRemarks").modal("hide");
                    window.location.reload();
                }
            }
            );
        }
    });
});

$('#backdate_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
        $.ajax({
        url: baseurl + 'save_backdate',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            swal({
                title: "Backdated successfully!",
                type: "success",
                showCancelbutton: false,
                closeModal: false
            },
            function(isok) {
                if(isok){
                    $("#cashierBackdate").modal("hide");
                    //$("#cashier_sm_ledger").DataTable.draw();

                    window.location.reload();
                }
            }
            );
        }
    });
});

$('#remittance_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
        $.ajax({
        url: baseurl + 'save_remittance',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            // if(data=='over')
            // {
            //     swal({
            //         title: "Total Remittance is greater than Total Collection!",
            //         type: "error",
            //         showCancelbutton: false,
            //         closeModal: false
            //     }
            //     );
            // }
            // else
            // {
                swal({
                    title: "Total Remittance successfully saved!",
                    type: "success",
                    showCancelbutton: false,
                    closeModal: false
                },
                function(isok) {
                    if(isok){
                        $("#totalRemittance").modal("hide");
                        window.location.reload();
                    }
                }
                );
            // }
        }
    });
});

// function showcustomer()
// {
//     var x = document.getElementById("customer_masterfile");
//     if (x.style.display === "none") {
//       x.style.display = "";
//     } else {
//       x.style.display = "none";
//     }
// }