// function addUs() {
//   var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
//   var usname = $("#usname").val();
//   var usemail = $("#usemail").val();
//   var uspass = $("#uspass").val();

//   //Cek Form Fields
//   if (usname.trim() == "") {
//     $("#statusMsg1").html(
//       '<small style="color:red;">Mohon Masukkan Nama !</small>'
//     );
//     $("#usname").focus();
//     return false;
//   } else if (usemail.trim() == "") {
//     $("#statusMsg2").html(
//       '<small style="color:red;">Mohon Masukkan Email !</small>'
//     );
//     $("#usemail").focus();
//     return false;
//     } else if (usemail.trim() != "" && !reg.test(usemail)) {
//         $("#statusMsg2").html(
//         '<small style="color:red;">Mohon Masukkan Email yang Valid e.g. example@mail.com </small>'
//         );
//         $("#usemail").focus();
//         return false;
//   } else if (uspass.trim() == "") {
//     $("#statusMsg3").html(
//       '<small style="color:red;">Mohon Masukkan Password !</small>'
//     );
//     $("#uspass").focus();
//     return false;
//   } else {
//     $.ajax({
//       url: "User/adduser.php",
//       method: "POST",
//       dataType: "json",
//       data: {
//         ussignup: "ussignup",
//         usname: usname,
//         usemail: usemail,
//         uspass: uspass,
//       },
//       success: function (data) {
//         console.log(data);
//         if (data == "OK") {
//           $("#successMsg").html(
//             "<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Pendaftaran Berhasil!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
//           );
//           clearUsRegFields();
//         } else if (data == "Failed") {
//           $("#successMsg").html(
//             "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Tidak Dapat Mendaftar!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
//           );
//         }
//       },
//     });
//   }
// }

// //kosong fields
// function clearUsRegFields(){
//     $("#usRegForm").trigger("reset");
//     $("#statusMsg1").html(" ");
//     $("#statusMsg2").html(" ");
//     $("#statusMsg3").html(" ");
// }


//Ajax Call untuk Verifikasi login
function checkUsLogin(){
  var usLogemail = $("#usLogemail").val();
  var usLogpass = $("#usLogpass").val();
  $.ajax({
    url: "User/adduser.php",
      method:"POST",
      data:{
        checkLogemail: "checklogmail",
        usLogemail:usLogemail,
        usLogpass:usLogpass,

      },
      success:function(data){
        if(data == 0){
          $("#statusLogMsg").html(
          "<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Email atau Password salah!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
          );
        } else if(data == 1){
          $("#statusLogMsg").html(
            "<div class='spinner-border text-success text-center' role='status'>"
          );
          setTimeout(() => {
            window.location.href = "index.php";
          }, 1000);
        }
      },
  });

}