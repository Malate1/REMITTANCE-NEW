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
            "leftColumns": 4,
            "rightColumns": 4
        },
        "columnDefs": [
            {
                "orderable": true,  // Set orderable to false for the first column (index 0)
                "targets": 1
            }
        ],
        "order": [[1, 'asc']] // Order by 2nd column (index 1), ascending

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

function delete_sm_payments(ids)
{
    swal({
        title: "Are you sure to delete this salesman payments?",
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
                url: baseurl + 'delete_payments_op',
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

function change_check(ids)
{
    swal({
        title: "Are you sure to convert this CHECK payment to CASH?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
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
                url: baseurl + 'change_check',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Payment type successfully updated!",
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

function change_check_op(ids)
{
    swal({
        title: "Are you sure to convert this CHECK payment to CASH?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
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
                url: baseurl + 'change_check_op',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Payment type successfully updated!",
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

function change_check_xt(ids)
{
    swal({
        title: "Are you sure to convert this XTRUCK CHECK payment to CASH?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
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
                url: baseurl + 'change_check_xt',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Payment type successfully updated!",
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

function update_inc_xt(ids)
{
    swal({
        title: "Are you sure to update salesman's incentives?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
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
                url: baseurl + 'update_inc_xt',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Incentives successfully updated!",
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

// function viewsminc_content_ldi(ids)
// {
//     $.ajax({
//         url: baseurl + 'view_sm_inc_ldi',
//         type: 'POST',
//         data: {ids:ids},
//         error: function() {
//             alert('Something is wrong');
//         },
//         success: function(data) {                 
//             $("#viewsminc_content_ldi").html(data);
//         }
//     });
// }

function delete_check_op(ids)
{
    swal({
        title: "Are you sure to delete this payment?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
        
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_check_op',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Payment type successfully deleted!",
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

function delete_check_xt(ids)
{
    swal({
        title: "Are you sure to delete this EXTRUCK payment?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
        
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_check_xt',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Extruck Payment successfully deleted!",
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

function delete_palawan_xt(ids)
{
    swal({
        title: "Are you sure to delete this Palawan Remittance?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
        
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_palawan_xt',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Palawan remittance successfully deleted!",
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

function delete_palawan_op(ids) {
    swal(
      {
        title: "Are you sure to delete this Palawan Remittance (PREBOOKING)?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
  
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true,
      },
  
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: baseurl + "delete_palawan_op",
            type: "POST",
            data: { ids: ids },
            error: function () {
              alert("Something is wrong");
            },
            success: function (data) {
              swal(
                {
                  title: "Palawan remittance successfully deleted!",
                  type: "success",
                  showCancelbutton: false,
                  closeModal: false,
                },
                function (isok) {
                  if (isok) {
                    window.location.reload();
                  }
                }
              );
            },
          });
        }
      }
    );
}

function delete_bo_op(ids) {
    swal(
      {
        title: "Are you sure to delete this BO Payment (PREBOOKING)?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
  
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true,
      },
  
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: baseurl + "delete_bo_op",
            type: "POST",
            data: { ids: ids },
            error: function () {
              alert("Something is wrong");
            },
            success: function (data) {
              swal(
                {
                  title: "BO payment successfully deleted!",
                  type: "success",
                  showCancelbutton: false,
                  closeModal: false,
                },
                function (isok) {
                  if (isok) {
                    window.location.reload();
                  }
                }
              );
            },
          });
        }
      }
    );
  }

function delete_satellite_xt(ids)
{
    swal({
        title: "Are you sure to delete this Satellite Payment?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
        
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_satellite_xt',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Satellite payment successfully deleted!",
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

function delete_utc_xt(ids) {
    swal(
      {
        title: "Are you sure to delete this Under the Cup Payment?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
  
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true,
      },
  
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: baseurl + "delete_utc_xt",
            type: "POST",
            data: { ids: ids },
            error: function () {
              alert("Something is wrong");
            },
            success: function (data) {
              swal(
                {
                  title: "Under the Cup payment successfully deleted!",
                  type: "success",
                  showCancelbutton: false,
                  closeModal: false,
                },
                function (isok) {
                  if (isok) {
                    window.location.reload();
                  }
                }
              );
            },
          });
        }
      }
    );
  }

function delete_ret_op(ids)
{
    swal({
        title: "Are you sure to delete this Oplan Return?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
        
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_ret_op',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Oplan return successfully deleted!",
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

function delete_ret_xt(ids)
{
    swal({
        title: "Are you sure to delete this XTRUCK Return?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
        
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true
      },
      
      function(isConfirm) {
          if(isConfirm)
          {
             $.ajax({
                url: baseurl + 'delete_ret_xt',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "XTRUCK return successfully deleted!",
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

function untag_denom_xt(srr_no) {
    console.log(srr_no);
    let srr = srr_no.getAttribute('data-srr'); 

    swal(
      {
        title: "Are you sure to untag this denomination?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
  
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true,
      },
  
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: baseurl + "untag_denom_xt",
            type: "POST",
            data: { srr_no: srr },
            error: function () {
              alert("Something is wrong");
            },
            success: function (data) {
              swal(
                {
                  title: "Denomination successfully untagged!",
                  type: "success",
                  showCancelbutton: false,
                  closeModal: false,
                },
                function (isok) {
                  if (isok) {
                    window.location.reload();
                  }
                }
              );
            },
          });
        }
      }
    );
}

function unfile_denom_xt(srr_no) {
    console.log(srr_no);
    let srr = srr_no.getAttribute('data-srr'); 

    swal(
      {
        title: "Are you sure to unfile this EXTRUCK denomination?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
  
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true,
      },
  
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: baseurl + "unfile_denom_xt",
            type: "POST",
            data: { srr_no: srr },
            error: function () {
              alert("Something is wrong");
            },
            success: function (data) {
              swal(
                {
                  title: "Denomination successfully unfiled!",
                  type: "success",
                  showCancelbutton: false,
                  closeModal: false,
                },
                function (isok) {
                  if (isok) {
                    window.location.reload();
                  }
                }
              );
            },
          });
        }
      }
    );
}

function unfile_denom_op(srr_no) {
    console.log(srr_no);
    let srr = srr_no.getAttribute("data-srr");
  
    swal(
      {
        title: "Are you sure to unfile this OPLAN denomination?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-secondary",
  
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        showLoaderOnConfirm: true,
      },
  
      function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            url: baseurl + "unfile_denom_op",
            type: "POST",
            data: { srr_no: srr },
            error: function () {
              alert("Something is wrong");
            },
            success: function (data) {
              swal(
                {
                  title: "Denomination successfully unfiled!",
                  type: "success",
                  showCancelbutton: false,
                  closeModal: false,
                },
                function (isok) {
                  if (isok) {
                    window.location.reload();
                  }
                }
              );
            },
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

function sm_incentives(ids, user_id)
{
    $.ajax({
        url: baseurl + 'sm_incentives',
        type: 'POST',
        data: {
            ids: ids,
            user_id: user_id
        },
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#incentives_content").html(data);
        }
    });
}

function sm_incentives_edit(ids, user_id)
{
    $.ajax({
        url: baseurl + 'sm_incentives_edit',
        type: 'POST',
        data: {
            ids: ids,
            user_id: user_id
        },
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#incentives_edit_content").html(data);
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

function viewcashierpayment_content_ldi(ids)
{
    $.ajax({
        url: baseurl + 'view_cashier_payment_ldi',
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

function viewcashierpayment_content_ldi_ext(ids)
{
    $.ajax({
        url: baseurl + 'view_cashier_payment_ldi_ext',
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

function cashiersm_form_date_oplan()
{
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm']").val();
    //var pay_stat = $("[name='pay_stat']").val();
    //console.log(pay_stat);
    window.location = 'smpaymentdataop/'+ddate+'/'+ddate2+'/'+sm;
    // window.open('smdenomdata/'+ddate, '_blank');
}

function cashiersm_form_date_xt()
{
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm_xt']").val();
    // console.log(ddate2);
    window.location = 'smpaymentdataxt/'+ddate+'/'+ddate2+'/'+sm;
    
}

function cashiersm_form_date_xt_palawan()
{
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm_xt']").val();
    // console.log(ddate2);
    window.location = 'smpaymentdataxtpal/'+ddate+'/'+ddate2+'/'+sm;
    
}

function cashiersm_form_date_xt_palawan_ref()
{
    var ref_no = $("[name='ref_no']").val();
    window.location = 'smpaymentdataxtpalref/'+ref_no;
    
}

function cashiersm_form_date_op_palawan() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm']").val();
    // console.log(ddate2);
    window.location = "smpaymentdataoppal/" + ddate + "/" + ddate2 + "/" + sm;
  }
  
  function cashiersm_form_date_op_palawan_ref() {
    var ref_no = $("[name='ref_no']").val();
    window.location = "smpaymentdataoppalref/" + ref_no;
  }

function cashiersm_form_date_xt_satellite()
{
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm_xt']").val();
    // console.log(ddate2);
    window.location = 'smpaymentdataxtsat/'+ddate+'/'+ddate2+'/'+sm;
    
}

function cashiersm_form_date_xt_satellite_ref()
{
    var ref_no = $("[name='ref_no']").val();
    window.location = 'smpaymentdataxtsatref/'+ref_no;
    
}

function cashiersm_form_date_xt_utc() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm_xt']").val();
    // console.log(ddate2);
    window.location = "smpaymentdataxtutc/" + ddate + "/" + ddate2 + "/" + sm;
}

function cashiersm_form_date_xt_utc_ref() {
    var ref_no = $("[name='ref_no']").val();
    window.location = "smpaymentdataxtutcref/" + ref_no;
}

function cashiersm_form_date_op_bo() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm']").val();
    // console.log(ddate2);
    window.location = "smpaymentdataopbo/" + ddate + "/" + ddate2 + "/" + sm;
}

function cashiersm_form_date_op_bo_ref() {
    var ref_no = $("[name='ref_no']").val();
    window.location = "smpaymentdataopboref/" + ref_no;
}

function cashiersm_form_date_xt_inc() {
    var sm = $("[name='sm']").val();
    window.location = "smpaymentdataxtinc/" + sm;
}

function cashiersm_form_date_xt_denom() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm_xt']").val();
    // console.log(ddate2);
    window.location = "smdenomdataxt/" + ddate + "/" + ddate2 + "/" + sm;
}

function cashiersm_form_date_xt_denom_no() {
    var ref_no = $("[name='ref_no']").val();
    window.location = "smdenomdataxtsrr/" + ref_no;
}

function cashiersm_form_date_op_denom() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm']").val();
    // console.log(ddate2);
    window.location = "smdenomdataop/" + ddate + "/" + ddate2 + "/" + sm;
  }
  
function cashiersm_form_date_op_denom_no() {
    var ref_no = $("[name='ref_no']").val();
    window.location = "smdenomdataopsrr/" + ref_no;
}

function cashiersm_form_date_oplan_ret() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm']").val();
    
    window.location = "smreturndataop/" + ddate + "/" + ddate2 + "/" + sm;
    
}

function cashiersm_form_date_oplan_si_ret()
{
    
    var si = $("[name='si']").val();
    
    window.location = 'smreturndataopsi/'+si;
    
}

function cashiersm_form_date_xt_ret() {
    var ddate = $("[name='datenow']").val();
    var ddate2 = $("[name='datenow2']").val();
    var sm = $("[name='sm_xt']").val();
    
    window.location = "smreturndataxt/" + ddate + "/" + ddate2 + "/" + sm;
    
}

function cashiersm_form_date_xt_si_ret()
{
    
    var si = $("[name='si']").val();
    
    window.location = 'smreturndataxtsi/'+si;
    
}


function dvsrr_date_xt()
{
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    var sm = $("[name='sm_xt']").val();
    // console.log(ddate2);
    window.location = 'dvsrrxt/'+datefrom+'/'+dateto+'/'+sm;
    
}

function checkreturned()
{
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    
    // console.log(ddate2);
    window.location = 'checkreturned/'+datefrom+'/'+dateto;
    
}

function checkreturnedop()
{
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    
    // console.log(ddate2);
    window.location = 'checkreturnedop/'+datefrom+'/'+dateto;
    
}

function dvsrr_date_op()
{
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    var sm = $("[name='sm']").val();
    // console.log(ddate2);
    window.location = 'dvsrrop/'+datefrom+'/'+dateto+'/'+sm;
    
}

function cashiersm_form_date_oplan_si()
{
    //var ddate = $("[name='datenow']").val();
    var si = $("[name='si']").val();
    //var pay_stat = $("[name='pay_stat']").val();
    //console.log(pay_stat);
    window.location = 'smpaymentdataopsi/'+si;
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

function colsum_date() {
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    var sm = $("[name='sm']").val();
    var loc = $("[name='loc']").val();
    
    window.open('colsumreportop/' + datefrom + '/' + dateto + '/' + sm + '/' + loc, '_blank');
}

function colsum_date_excel() {
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    var sm = $("[name='sm']").val();
    var loc = $("[name='loc']").val();
    
    window.open('colsumreportopexcel/' + datefrom + '/' + dateto + '/' + sm + '/' + loc, '_blank');
}

function colsum_date_mpdi() { 
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    var sm = $("[name='sm']").val();
    var loc = $("[name='loc']").val();
  
    window.open(
      "colsumreportmpdi/" + datefrom + "/" + dateto + "/" + sm + "/" + loc,
      "_blank"
    );
  }

function colsum_date_xt()
{
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    var sm = $("[name='sm_xt']").val();
    var loc = $("[name='loc']").val();
    console.log(loc);
    window.open('colsumreportxt/' + datefrom + '/' + dateto + '/' + sm + '/' + loc, '_blank');
    
}

function pdcdc_form_date()
{
    var ddate = $("[name='datenow']").val();
    var ddate1 = $("[name='datenow1']").val();
    var type = $('input[name="reportradio"]:checked').val();
    // window.location = 'smdenomdata/'+ddate;
    window.open('pdcdcreport/'+ddate+'/'+type+'/'+ddate1, '_blank');
}

function ret_pdcdc_form_date()
{
    
    window.open('retpdcdcreport', '_blank');
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
                    if (data == 'done_prebooking') {
						swal({
							title: "Data already uploaded!",
							text: 'Please check the uploaded data in ARIS',
							type: "warning",
							showCancelButton: false,
							closeModal: false
						});
					} else {
						swal({
							title: "Data successfully uploaded!",
							type: "success",
							showCancelButton: false,
							closeModal: false
						},
						function(isok) {
							if (isok) {
								window.location.reload();
							}
						});
					}
                }
            });
          }
      }
      );
}

function upload_payments_inputted(ids)
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
                url: baseurl + 'upload_payments_inputted',
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

function upload_payments_xtruck(ids)
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
                url: baseurl + 'upload_payments_xtruck',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // alert(data);  
					
					
                    if (data == 'done') {
						swal({
							title: "Data already uploaded!",
							text: 'Please check the uploaded data in ARIS',
							type: "warning",
							showCancelButton: false,
							closeModal: false
						});
					} else {
						swal({
							title: "Data successfully uploaded!",
							type: "success",
							showCancelButton: false,
							closeModal: false
						},
						function(isok) {
							if (isok) {
								const selectedDate = $('#ledger-date').val(); // Replace with your real ID
                                loadTable(selectedDate);
							}
						});
					}
                }
            });
          }
      }
      );
}

function upload_payments_xtruck_udc(ids)
{
    swal({
        title: "Are you sure to upload the data to ARIS-UDC?",
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
                url: baseurl + 'upload_payments_xtruck_udc',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // alert(data);  
					
					
                    if (data == 'done') {
						swal({
							title: "Data already uploaded!",
							text: 'Please check the uploaded data in ARIS',
							type: "warning",
							showCancelButton: false,
							closeModal: false
						});
					} else {
						swal({
							title: "Data successfully uploaded!",
							type: "success",
							showCancelButton: false,
							closeModal: false
						},
						function(isok) {
							if (isok) {
								window.location.reload();
							}
						});
					}
                }
            });
          }
      }
      );
}

function upload_payments_xtruck_big(ids)
{
    swal({
        title: "Are you sure to upload the data to ARIS-BIG-E?",
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
                url: baseurl + 'upload_payments_xtruck_big',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {       
                    // alert(data);    
                    if (data == 'done') {
						swal({
							title: "Data already uploaded!",
							text: 'Please check the uploaded data in ARIS',
							type: "warning",
							showCancelButton: false,
							closeModal: false
						});
					} else {
						swal({
							title: "Data successfully uploaded!",
							type: "success",
							showCancelButton: false,
							closeModal: false
						},
						function(isok) {
							if (isok) {
								window.location.reload();
							}
						});
					}
                }
            });
          }
      }
      );
}

function download_payments_xtruck(ids) {
    swal({
        title: "Are you sure to download the APPROVED denomination?",
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
        if (isConfirm) {
            fetch(baseurl + 'api/get_data_denom', {
                method: 'POST', // or 'POST' depending on your API requirement
                // data: {ids:ids},
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ids: ids }) // Convert the data to a JSON string
            })
            .then(response => {
                // Check if the response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                // Extract filename from Content-Disposition header
                const disposition = response.headers.get('Content-Disposition');
                let filename = 'download.txt'; // Default filename
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    const filenameRegex = /filename[^;=\n]*=[\'"]([^\'"]*)[\'"]/;
                    const matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) { 
                        filename = matches[1];
                    }
                }
            
                // Return the response as a blob
                return response.blob().then(blob => ({ blob, filename }));
            })
            .then(({ blob, filename }) => {
                // Create a link element
                const link = document.createElement('a');
                // Create a URL for the blob
                link.href = URL.createObjectURL(blob);
                // Set the filename for the download
                link.download = filename;
                // Append the link to the body
                document.body.appendChild(link);
                // Simulate a click on the link to trigger the download
                link.click();
                // Remove the link from the document
                document.body.removeChild(link);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            })
            .finally(() => {
                swal({
                    title: "Data successfully downloaded!",
                    type: "success",
                    showCancelButton: false,
                    closeOnConfirm: true
                });
            });
        }
    });
}

function download_payments_mpdi(ids) {
    swal({
        title: "Are you sure to download the APPROVED MPDI denomination?",
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
        if (isConfirm) {
            fetch(baseurl + 'api/get_data_denom_mpdi', {
                method: 'POST', // or 'POST' depending on your API requirement
                // data: {ids:ids},
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ids: ids }) // Convert the data to a JSON string
            })
            .then(response => {
                // Check if the response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                // Extract filename from Content-Disposition header
                const disposition = response.headers.get('Content-Disposition');
                let filename = 'download.txt'; // Default filename
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    const filenameRegex = /filename[^;=\n]*=[\'"]([^\'"]*)[\'"]/;
                    const matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) { 
                        filename = matches[1];
                    }
                }
            
                // Return the response as a blob
                return response.blob().then(blob => ({ blob, filename }));
            })
            .then(({ blob, filename }) => {
                // Create a link element
                const link = document.createElement('a');
                // Create a URL for the blob
                link.href = URL.createObjectURL(blob);
                // Set the filename for the download
                link.download = filename;
                // Append the link to the body
                document.body.appendChild(link);
                // Simulate a click on the link to trigger the download
                link.click();
                // Remove the link from the document
                document.body.removeChild(link);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            })
            .finally(() => {
                swal({
                    title: "Data successfully downloaded!",
                    type: "success",
                    showCancelButton: false,
                    closeOnConfirm: true
                });
            });
        }
    });
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

function print_alldenom_LDI_per_Date()
{
    // window.location = 'smdenomdata/'+ddate;
    var loc = $("[name='loc']").val();
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    //console.log(loc);
    window.open(baseurl + 'printalldenom_LDI_per_Date/' + datefrom + '/' + dateto, '_blank');

}

function print_palawan_LDI_per_Date()
{
    // window.location = 'smdenomdata/'+ddate;
    var loc = $("[name='loc']").val();
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    //console.log(loc);
    window.open(baseurl + 'printallpalawan_LDI_per_Date/' + datefrom + '/' + dateto + '/' + loc, '_blank');

}

function print_alldenom_LDI_per_Date_Excel()
{
    // window.location = 'smdenomdata/'+ddate;
    var loc = $("[name='loc']").val();
    var datefrom = $("[name='datefrom']").val();
    var dateto = $("[name='dateto']").val();
    //console.log(loc);
    window.open(baseurl + 'printalldenom_LDI_per_Date_Excel/' + datefrom + '/' + dateto, '_blank');

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

function customer_masterfileccd()
{
    $(".customermasterfileccd").html(
        'Loading, Please wait...'
    )
    setTimeout(function(){
        $(".customermasterfileccd").html(
            '<table class="table table-bordered customer-masterccd compact" width="100%" cellspacing="0">'+
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

        $('.customer-masterccd').DataTable( {
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

function customer_masterfile5()
{
    $(".customermasterfile4").html(
        'Loading, Please wait...'
    )
    setTimeout(function(){
        $(".customermasterfile4").html(
            '<table class="table table-bordered customer-master4 compact" width="100%" cellspacing="0">'+
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

        $('.customer-master4').DataTable( {
            "ajax": baseurl + "get_customer5",
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

function selected_customer_to_ccd(code) {
    $.ajax({
      url: baseurl + "transfer_customer_to_ccd",
      type: "POST",
      data: { code: code },
      dataType: "json", // expecting JSON from controller
      error: function () {
        alert("Something went wrong.");
      },
      success: function (response) {
        $("#customerModal").modal("hide");
  
        swal({
          title: response.message,
          type: response.status === "success" ? "success" : response.status === "info" ? "info" : "error",
          showCancelButton: false,
          closeOnConfirm: true,
          timer: 1500
        });
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

// function edit_sm_check(ids)
// {
//     $.ajax({
//         url: baseurl + 'edit_sm_check',
//         type: 'POST',
//         data: {ids:ids},
//         error: function() {
//             alert('error2');
//         },
//         success: function(data) {                 
//             $("#editsm_payment").html(data);
//         }
//     });
// }

// function edit_sm_check_ext(ids)
// {
//     $.ajax({
//         url: baseurl + 'edit_sm_check_ext',
//         type: 'POST',
//         data: {ids:ids},
//         error: function() {
//             alert('error2');
//         },
//         success: function(data) {                 
//             $("#editsm_payment").html(data);
//         }
//     });
// }

function edit_sm_check(ids,denomid)
{
    $.ajax({
        url: baseurl + 'edit_sm_check',
        type: 'POST',
        data: {ids:ids,denomid:denomid},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_sm_check_ext(ids,denomid)
{
    $.ajax({
        url: baseurl + 'edit_sm_check_ext',
        type: 'POST',
        data: {ids:ids,denomid:denomid},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function cash_to_check_op(ids)
{
    $.ajax({
        url: baseurl + 'cash_to_check_op',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function cash_to_check_xt(ids)
{
    $.ajax({
        url: baseurl + 'cash_to_check_xt',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_sm_check_ldi_op(ids)
{
    $.ajax({
        url: baseurl + 'edit_sm_check_ldi_op',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_sm_check_ldi_xt(ids)
{
    $.ajax({
        url: baseurl + 'edit_sm_check_ldi_xt',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_sm_palawan_ldi_xt(ids,denomid)
{
    $.ajax({
        url: baseurl + 'edit_sm_palawan_ldi_xt',
        type: 'POST',
        data: {ids:ids,denomid:denomid},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_sm_denom_ldi_op(srr_no)
{
    let srr = srr_no.getAttribute("data-srr");
    $.ajax({
        url: baseurl + 'edit_sm_denom_ldi_op',
        type: 'POST',
        data: {srr:srr},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}


function edit_sm_check_ldi_tax_op(ids)
{
    $.ajax({
        url: baseurl + 'edit_sm_check_ldi_tax_op',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_sm_check_ldi_tax_op_minus(ids)
{
    $.ajax({
        url: baseurl + 'edit_sm_check_ldi_tax_op_minus',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function pay_to_ret_op(ids)
{
    $.ajax({
        url: baseurl + 'pay_to_ret_op',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error1');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function ret_to_pay_op(ids) {
    $.ajax({
        url: baseurl + "ret_to_pay_op",
        type: "POST",
        data: { ids: ids },
        error: function () {
        alert("error1");
        },
        success: function (data) {
        $("#editsm_payment").html(data);
        },
    });
}

function edit_sm_check_ldi(ids)
{
    $.ajax({
        url: baseurl + 'edit_sm_check_ldi',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('error');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_ret_check_ext(ids,denomid)
{
    $.ajax({
        url: baseurl + 'edit_ret_check_ext',
        type: 'POST',
        data: {ids:ids,denomid:denomid},
        error: function() {
            alert('error2');
        },
        success: function(data) {                 
            $("#editsm_payment").html(data);
        }
    });
}

function edit_ret_check_op(ids,denomid)
{
    $.ajax({
        url: baseurl + 'edit_ret_check_op',
        type: 'POST',
        data: {ids:ids,denomid:denomid},
        error: function() {
            alert('error2');
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

$('#incentives_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    swal({
        title: "Proceed adding incentives?",
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
                url: baseurl + 'save_incentives',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    swal({
                        title: "Incentives successfully applied!",
                        type: "success",
                        showCancelbutton: false,
                        closeModal: false
                    },
                    function(isok) {
                        if(isok){
                            $("#smIncentives").modal("hide");
                            window.location.reload();
                        }
                    }
                    );
                }
            });
            }
        }
        );
});

$('#incentives_edit_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    swal({
        title: "Proceed updating incentives?",
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
                url: baseurl + 'save_incentives',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    swal({
                        title: "Incentives successfully applied!",
                        type: "success",
                        showCancelbutton: false,
                        closeModal: false
                    },
                    function(isok) {
                        if(isok){
                            $("#smIncentives").modal("hide");
                            window.location.reload();
                        }
                    }
                    );
                }
            });
            }
        }
        );
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