function adduser_content()
{   
    $.ajax({
        url: 'adduser_content',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#adduser_content").html(data);                
        }                
    });
}

function edituser_content(ids)
{
    $.ajax({
        url: 'edituser_content',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#edituser_content").html(data);
        }
    });
}

function deleteuser_content(ids)
{
    swal({
        title: "Are you sure to delete this user?",
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
                url: 'cruddelete',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "User successfully deleted!",
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

function user_password(ids)
{
    $.ajax({
        url: 'user_password',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#user_content").html(data);
        }
    });
}

function user_location(ids)
{
    $.ajax({
        url: 'user_location',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#user_content3").html(data);
        }
    });
}

function user_bu(ids)
{
    $.ajax({
        url: 'user_bu',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#user_content4").html(data);
        }
    });
}

function user_username(ids)
{
    $.ajax({
        url: 'user_username',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {            
            $("#user_content2").html(data);
        }
    });
}

function resetuser_content(ids)
{
    swal({
        title: "Are you sure to reset the password of this user?",
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
                url: 'crudreset',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Password successfully reset!",
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

$('#user_location').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'changeLocation',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $("#msg").hide();
            $("#userLocation").modal("hide");
            swal({
                title: "Location successfully changed!",
                type: "success",
                showCancelbutton: false
            },
            function(isok) {
                if(isok){
                    window.location.reload();
                }
            }
            );
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#user_bu').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'changeBu',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) { 
            $("#msg").hide();
            $("#userBu").modal("hide");
            swal({
                title: "BU successfully changed!",
                type: "success",
                showCancelbutton: false
            },
            function(isok) {
                if(isok){
                    window.location.reload();
                }
            }
            );
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#user_username').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'checkUsername',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data=="wrong")
            {
                $("#msg").show();
                $("#msg").html("Username already exist!");
            }
            else
            {
                $("#msg").hide();
                $("#userUsername").modal("hide");
                swal({
                    title: "Username successfully changed!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#user_password').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var newpass = $("[name='new_password']").val();
    var confirmpass = $("[name='confirm_password']").val();
    var flag = 0;
    $.ajax({
        url: 'checkCurrentPassword',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend : function() {
            if(newpass!=confirmpass)
            {
                flag = 1;
                $("#msg").show();
                $("#msg").html("New Password and Confirm Password does not match!");
            }
            else
            {
                flag = 0;
            }
        },
        success: function(data) { 
            if(flag==0)
            {
                if(data == 'wrong')
                {
                    $("#msg").show();
                    $("#msg").html("Current password is incorrect!");
                }
                else
                {
                    $("#msg").hide();
                    $("#userPassword").modal("hide");
                    swal({
                        title: "Password successfully changed!",
                        type: "success",
                        showCancelbutton: false
                    },
                    function(isok) {
                        if(isok){
                            window.location.reload();
                        }
                    }
                    );
                }
            }  
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#user_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'crudcreate',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data)
            {
                $("#msg").show();
            }
            else
            {
                $("#addUserModal").modal("hide");
                swal({
                    title: "User successfully added!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#user_edit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'crudupdate',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {   
            if(data)
            {
                $("#msg").show();
            }
            else
            {
                $("#editUserModal").modal("hide");
                swal({
                    title: "User successfully updated!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});


$('#login_form').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'login_validation',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data == 'try')
            {
                $("#msg").show();
                $("#inputUsername").val('');
                $("#inputPassword").val('');
                $("#inputUsername").focus();
            }
            else
            {
               window.location.replace('main');
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

var _validFileExtensions = [".txt"];    
function checkFile(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                var filename = sFileName.replace(/^.*[\\\/]/, '')
                swal({
                    title: "Sorry, " + filename + " is invalid!\n\nAllowed extension is " + _validFileExtensions.join(", "),
                    type: "warning",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
                // alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}

$('#file_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'upload_file',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#uploadTextfile").text('Uploading Textfile. Please Wait...');
            $("#customFile").prop('disabled',true);
            $("#uploadTextfile").prop('disabled',true);
            $("#loading").show();
        },
        success: function(data) {
            if(data=="no-data")
            {
                swal({
                    title: "This textfile is empty!",
                    type: "warning",
                    showCancelbutton: false
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
                    title: "Textfile successfully uploaded!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
                $("#uploadTextfile").text('Upload Textfile');
                $("#customFile").prop('disabled',false);
                $("#uploadTextfile").prop('disabled',false);
                $("#loading").hide();
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#submit_customer').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'save_customer',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#uploadTextfile").text('Saving Customer. Please Wait...');
            $("#customFile").prop('disabled',true);
            $("#uploadTextfile").prop('disabled',true);
            $("#loading").show();
        },
        success: function(data) {
            if(data=="already")
            {
                swal({
                    title: "Customer already exist!",
                    type: "warning",
                    showCancelbutton: false
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
                    title: "Customer successfully added!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
                $("#uploadTextfile").text('Upload Textfile');
                $("#customFile").prop('disabled',false);
                $("#uploadTextfile").prop('disabled',false);
                $("#loading").hide();
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#import_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'import_file',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#uploadTextfile").text('Uploading Textfile. Please Wait...');
            $("#customFile").prop('disabled',true);
            $("#uploadTextfile").prop('disabled',true);
            $("#loading").show();
        },
        success: function(data) {
            if(data=="no-data")
            {
                swal({
                    title: "This textfile is empty!",
                    type: "warning",
                    showCancelbutton: false
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
                    title: "Textfile successfully uploaded!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
                $("#uploadTextfile").text('Upload Textfile');
                $("#customFile").prop('disabled',false);
                $("#uploadTextfile").prop('disabled',false);
                $("#loading").hide();
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#importldi_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'importldi_file',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#importTextfile").text('Uploading Textfile. Please Wait...');
            $("#customFile").prop('disabled',true);
            $("#importTextfile").prop('disabled',true);
            $("#loading").show();
        },
        success: function(data) {
            if(data=="no-data")
            {
                // swal({
                //     title: "Payments textfile is empty!",
                //     type: "warning",
                //     showCancelbutton: false
                // }
                // ,
                // function(isok) {
                //     if(isok){
                //         window.location.reload();
                //     }
                // }
                // );
            }
            else if(data=="nocode")
            {
                // swal({
                //     title: "There is a Jefe de Viaje Code in the textfile that is not yet setup in Users! Please check the textfile first and try again!",
                //     type: "warning",
                //     showCancelbutton: false
                // },
                // function(isok) {
                //     if(isok){
                //         window.location.reload();
                //     }
                // }
                // );
            }
            else
            {
                // swal({
                //     title: "Payments textfile successfully uploaded!",
                //     type: "success",
                //     showCancelbutton: false
                // },
                // function(isok) {
                //     if(isok){
                //         window.location.reload();
                //     }
                // }
                // );
                $("#importTextfile").text('Upload Textfile');
                $("#customFile").prop('disabled',false);
                $("#importTextfile").prop('disabled',false);
                $("#loading").hide();
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#importldireturn_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'importldireturn_file',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#importTextfileReturn").text('Uploading Textfile. Please Wait...');
            // $("#customFile").prop('disabled',true);
            $("#importTextfileReturn").prop('disabled',true);
            $("#loading2").show();
        },
        success: function(data) {
            if(data=="no-data")
            {
                swal({
                    title: "Textfile is empty!",
                    type: "warning",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
            }
            else if(data=="nocode")
            {
                swal({
                    title: "There is a Jefe de Viaje Code in the textfile that is not yet setup in Users! Please check the textfile first and try again!",
                    type: "warning",
                    showCancelbutton: false
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
                    title: "Textfile successfully uploaded!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
                $("#importTextfile").text('Upload Textfile');
                $("#customFile").prop('disabled',false);
                $("#importTextfile").prop('disabled',false);
                $("#loading").hide();
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

$('#export_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    $.ajax({
        url: 'export_file',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#exportTextfile").text('Exporting Textfile. Please Wait...');
            $("#datenow").prop('disabled',true);
            $("#exportTextfile").prop('disabled',true);
            $("#loading").show();
        },
        success: function(data) {
            if(data=="nodata")
            {
                swal({
                    title: "This date has no transaction!",
                    type: "warning",
                    showCancelbutton: false
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
                    title: "Textfile successfully exported!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
                $("#exportTextfile").text('Upload Textfile');
                $("#datenow").prop('disabled',false);
                $("#exportTextfile").prop('disabled',false);
                $("#loading").hide();
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function addbank_content()
{   
    $.ajax({
        url: 'addbank_content',
        type: 'POST',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#addbank_content").html(data);                
        }                
    });
}

$('#bank_submit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    $.ajax({
        url: 'insertBank',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data=="exist-code")
            {
                flag = 1;
                $("#msg").show();
                $("#msg").html("Bank Code already Exist!");
            }
            if(data=="exist-name")
            {
                flag = 1;
                $("#msg").show();
                $("#msg").html("Bank Name already Exist!");
            }
            if(flag==0)
            {
                $("#addBankModal").modal("hide");
                swal({
                    title: "Bank successfully added!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function editbank_content(ids)
{
    $.ajax({
        url: 'editbank_content',
        type: 'POST',
        data: {ids:ids},
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {                 
            $("#editbank_content").html(data);
        }
    });
}

$('#bank_edit').on("submit", function(e){
    var formData = new FormData($(this)[0]);
    e.preventDefault();
    var flag = 0;
    $.ajax({
        url: 'updateBank',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data=="exist-code")
            {
                flag = 1;
                $("#msg").show();
                $("#msg").html("Bank Code already Exist!");
            }
            if(data=="exist-name")
            {
                flag = 1;
                $("#msg").show();
                $("#msg").html("Bank Name already Exist!");
            }
            if(flag==0)
            {
                $("#editBankModal").modal("hide");
                swal({
                    title: "Bank successfully added!",
                    type: "success",
                    showCancelbutton: false
                },
                function(isok) {
                    if(isok){
                        window.location.reload();
                    }
                }
                );
            }
        },
        error: function() {
            alert('Something is wrong');
        }
    });
});

function deletebank_content(ids)
{
    swal({
        title: "Are you sure to delete this bank?",
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
                url: 'deleteBank',
                type: 'POST',
                data: {ids:ids},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {            
                    swal({
                        title: "Bank successfully deleted!",
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