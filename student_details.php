<?php include './config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT INFORMATION</title>
    <?php include 'common/header.php'; ?>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="header-div d-flex justify-content-between align-items-center">
                <h3 class="text-left text-danger">tailwebs</h3>
                <div>
                    <a href="#">Home</a>
                    <a href="index.php">Logout</a>
                </div>
            </div>
            <table id="studentTable" class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Mark</th>
                        <th>Action</th>
                    </tr>
                </thead>
               <tbody></tbody>
            </table>
            <button button type="button" class="btn btn-dark float-left" data-toggle="modal" data-target="#exampleModal">Add</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
         <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
     <form action="" method="post" id="student_form" autocomplete="off">
                <input type="hidden" name="student_data_id" id="student_data_id" value="-1">
                <div class="form-group">
                    <label class="font-weight-bold">Name</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="student_name" id="student_name" class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode
					< 123) || (event.charCode == 32)">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="font-weight-bold">Subject</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-book"></i></span>
                        </div>
                         <input type="text" name="subject_name" id="subject_name" class="form-control" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode
					< 123) || (event.charCode == 32)">
                    </div>
                </div>

                 <div class="form-group">
                    <label class="font-weight-bold">Mark</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-line-chart"></i></span>
                        </div>
                        <input type="text" name="marks" id="marks" minlength="2" maxlength="3" class="form-control">
                    </div>
                </div>

                <div class="form-group align-center">
                    <button type="button" class="btn btn-lg btn-dark font-weight-bold" id="saveRecords" onclick="saveStudent()">Add</button>
                </div>
            </form>
            </div>
    </div>
  </div>
</div>


<?php include 'common/footer.php'; ?> 

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>