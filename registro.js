
  
  $(document).ready(function () {
      console.log("jquery funcionando correctamente");
    
      $("#registerForm").submit(function (event) {
        event.preventDefault();
        let username = $("#username").val();
        let password = $("#password").val();
    
        const newRegister = { username, password };
        console.log(newRegister)
    
    
        $.ajax({
          type: "POST",
          url: "registroController.php",
          data: JSON.stringify(newRegister),
          contentType: "application/json",
          dataType:'json',
          success: function (response) {
            console.log(newRegister)
            console.log(response)
            alert(response)
           
              $("#registerForm").trigger('reset');
           
          },
        });
      });
    });
    