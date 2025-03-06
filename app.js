$(document).ready(function () {
  console.log("ajax funcionando correctamente");

  getUsers();

  function getUsers() {
    $.ajax({
      url: "userController.php",
      type: "GET",
      success: function (response) {
        console.log(response);
        users = JSON.parse(response);
        template = "";
        users.forEach((user) => {
          template += `
                  <tr>
                  <td>${user.id}</td>
                  <td>${user.name}</td>
                  <td>${user.email}</td>

                  <td>
                            <button id="edit-button" class="btn btn-warning btn-sm " data-id="${user.id}" data-name="${user.name}" data-email="${user.email}">Editar</button>
                            <button id="delete-button" class="btn btn-danger btn-sm " data-id="${user.id}">Eliminar</button>
                        </td>



                  </tr>
                  `;
        });
        $("#usuarios").html(template);
      },
    });
  }

  $("#formulario").submit(function (e) {
    e.preventDefault();

    let id = $("#id").val();

    const newUser = {
      id: $("#id").val(),
      name: $("#name").val(),
      email: $("#email").val(),
    };

    let method = id ? "PUT" : "POST";

    console.log(method);

    $.ajax({
      url: "userController.php",
      type: method,
      data: JSON.stringify(newUser),
      contentType: "application/json",
      success: function (response) {
        console.log(response);
        $("#formulario").trigger("reset");
        getUsers();
      },
      error: function (xhr) {
        console.log(xhr.responseText);
        alert("Error: " + xhr.responseText);
      },
    });
  });

  //button edit
  $(document).on("click", "#edit-button", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");
    let email = $(this).data("email");

    $("#id").val(id);
    $("#name").val(name);
    $("#email").val(email);
  });

  //button delete
  $(document).on("click", "#delete-button", function () {
    let id = $(this).data("id");
    console.log(id);
    if (confirm("quieres eliminar este usuario?")) {
      $.ajax({
        url: "userController.php",
        type: "DELETE",
        data: JSON.stringify({ id }),
        contentType: "application/json",
        success: function (response) {
          console.log(response);
          getUsers();
          alert(response);
          $("#formulario").trigger("reset");
        },
      });
    }
  });
}); //fin del jquery
