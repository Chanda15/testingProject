<?php
include('db/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TA DA Status Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <link rel="stylesheet" href="<?php echo $url.'Assets/css/custom.css'; ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
</head>
<body>
<div class="container">
  <!-- Toast Containers -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
        <!-- Success Toast -->
        <div id="successToast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" style="display:none;">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body success-message">
            </div>
        </div>

        <!-- Error Toast -->
        <div id="errorToast" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true" style="display:none;">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body error-message">
            </div>
        </div>
    </div>
    <!-- End Toast Containers -->