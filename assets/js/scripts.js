//reset button
$("#resetRecords").on("click", function () {
  $("#user_login_form").trigger("reset");
});

function getStudent() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      try {
        var response = JSON.parse(xhr.responseText);
        populateTable(response.meta);
      } catch (e) {
        console.error("Failed to parse response as JSON:", xhr.responseText);
      }
    }
  };
  xhr.send("action=getStudent");
}

var id = "";
function populateTable(data) {
  var tbody = document.querySelector("#studentTable tbody");
  tbody.innerHTML = "";

  data.forEach(function (student) {
    var row = document.createElement("tr");

    row.dataset.studentId = student.student_data_id;
    row.dataset.studentName = student.student_name;
    row.dataset.subjectName = student.subject_name;
    row.dataset.marks = student.marks;

    var nameCell = document.createElement("td");
    nameCell.textContent = student.student_name;
    row.appendChild(nameCell);

    var subjectCell = document.createElement("td");
    subjectCell.textContent = student.subject_name;
    row.appendChild(subjectCell);

    var markCell = document.createElement("td");
    markCell.textContent = student.marks;
    row.appendChild(markCell);

    var actionCell = document.createElement("td");
    var actionIcon = document.createElement("i");
    actionIcon.classList.add("fas", "fa-chevron-circle-down", "action-icon");
    actionCell.appendChild(actionIcon);

    var actionButtons = document.createElement("div");
    actionButtons.classList.add("action-buttons");

    var editButton = document.createElement("button");
    editButton.textContent = "Edit";
    editButton.classList.add("btn", "btn-primary", "btn-sm", "mr-2");
    editButton.classList.add("btn", "btn-primary");
    editButton.onclick = function () {
      editStudent(row);
    };

    var deleteButton = document.createElement("button");
    deleteButton.textContent = "Delete";
    deleteButton.classList.add("btn", "btn-danger", "btn-sm");
    deleteButton.classList.add("btn", "btn-danger");
    deleteButton.onclick = function () {
      deleteStudent(student.student_data_id);
    };
    actionButtons.appendChild(editButton);
    actionButtons.appendChild(deleteButton);
    actionCell.appendChild(actionButtons);

    actionIcon.onclick = function () {
      actionButtons.style.display =
        actionButtons.style.display === "none" ? "block" : "none";
    };

    row.appendChild(actionCell);
    tbody.appendChild(row);
  });
}

function editStudent(row) {
  console.log(row);
  Swal.fire({
    title: "Confirmation",
    text: "Are you sure you want to edit this student?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, edit it!",
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById("student_data_id").value = row.dataset.studentId;
      document.getElementById("student_name").value = row.dataset.studentName;
      document.getElementById("subject_name").value = row.dataset.subjectName;
      document.getElementById("marks").value = row.dataset.marks;
      $("#exampleModal").modal("show");
      id = row.dataset.studentId;
    }
  });
}

function deleteStudent(studentId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      try {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          getStudent();
          Swal.fire({
            title: "Success",
            text: response.meta.msg,
            icon: "success",
          }).then(() => {
            window.location.href = "student_details.php";
          });
        } else {
          Swal.fire({
            title: "Error",
            text: response.meta.msg,
            icon: "error",
          });
        }
      } catch (e) {
        console.error("Failed to parse response as JSON:", xhr.responseText);
      }
    }
  };
  xhr.send(
    "action=deleteStudent&student_data_id=" + encodeURIComponent(studentId)
  );
}

getStudent();

function studentLogin() {
  const userName = document.getElementById("user_name").value;
  const password = document.getElementById("pass_word").value;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.success) {
        Swal.fire({
          title: "Success",
          text: response.meta.msg,
          icon: "success",
        }).then(() => {
          window.location.href = "student_details.php";
        });
      } else {
        Swal.fire("Error", response.meta.msg, "error");
      }
    }
  };
  xhr.send(
    "action=studentLogin&user_name=" +
      encodeURIComponent(userName) +
      "&pass_word=" +
      encodeURIComponent(password)
  );
}

function saveStudent() {
  const student_name = document.getElementById("student_name").value;
  const subject_name = document.getElementById("subject_name").value;
  const marks = document.getElementById("marks").value;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          Swal.fire({
            title: "Success",
            text: response.meta.msg,
            icon: "success",
          }).then(() => {
            window.location.href = "student_details.php";
          });
        } else {
          Swal.fire({
            title: "Error",
            text: response.meta.msg,
            icon: "error",
          });
        }
      } catch (error) {
        Swal.fire({
          title: "Error",
          text: "An error occurred.",
          icon: "error",
        });
      }
    }
  };
  xhr.send(
    "action=saveStudent&student_data_id=" +
      encodeURIComponent(id) +
      "&student_name=" +
      encodeURIComponent(student_name) +
      "&subject_name=" +
      encodeURIComponent(subject_name) +
      "&marks=" +
      encodeURIComponent(marks)
  );
}

document.getElementById("marks").addEventListener("keypress", function (event) {
  if (!/\d/.test(event.key)) {
    event.preventDefault();
  }
});

 $("#togglePassword").on("click", function () {
   const passwordField = $("#pass_word");
   const type = passwordField.attr("type") === "password" ? "text" : "password";
   passwordField.attr("type", type);
   $(this).toggleClass("fa-eye fa-eye-slash");
 });
