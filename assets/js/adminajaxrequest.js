//Ajax Call untuk Verifikasi login admin
function checkAdminLogin(){
    var adminLogemail = $("#adminLogemail").val();
    var adminLogpass = $("#adminLogpass").val();
    $.ajax({
      url: "Admin/admin.php",
        method:"POST",
        data:{
          checkLogemail: "checklogmail",
          adminLogemail:adminLogemail,
          adminLogpass:adminLogpass,
  
        },
        success:function(data){
          if(data == 0){
            $("#statusAdminLogMsg").html(
            "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Email atau Password salah!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
            );
          } else if(data == 1){
            $("#statusAdminLogMsg").html(
              "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Sukses Loading...</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
            );
            setTimeout(() => {
              window.location.href = "Admin/adminDashboard.php";
            }, 1000);
          }
        },
    });
  
  }