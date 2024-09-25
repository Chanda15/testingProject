<?php include('../../header.php');

$status = '';
if(isset($_REQUEST['status']))
  $status = $_REQUEST['status'];
?>
<h2>TA DA Status Form</h2> <p class="text-right"><a href="<?php echo $url.'loan/dipti/view/ta_da_status/list.php'; ?>">List</a></p>
<form action="<?php echo $url.'/loan/dipti/controller/ta_da_status_crud_operation.php?action=save'; ?>" method="post" id="TADAStatusForm">
    <div class="form-group">
      <label for="Status">Status:</label>
      <input type="text" class="form-control" id="Status" required placeholder="Enter Status" name="Status" value="">
    </div>
    <div class="form-group">
      <label for="Description">Password:</label>
      <textarea class="form-control" id="Description" required placeholder="Enter Description" name="Description"></textarea>
    </div>
    <input type="hidden" id="EditId" name="EditId" value="">
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<script>
  $(document).ready(function(){
      var status = "<?php echo $status; ?>";
      if(status!=''){
        $('#Status').attr('readonly',true);
        edit(status);
        $('#EditId').val(status);
      }
  });
  function edit(status){
     $.ajax({
          url:"<?php echo $url.'loan/dipti/controller/ta_da_status_crud_operation.php?action=edit'; ?>",
          type:'GET',
          data:{'ta_da_status':status},
          success:function(response)
          {
              var res = $.parseJSON(response);
              if(res.status==1){
                  console.log(res.data);
                  $('#Status').val(res.data.status);
                  $('#Description').val(res.data.status_description);
              }      
          }
      });
  }
$("#TADAStatusForm").validate({
            
            messages: {
                group: { required: "The status field is required." },
                role: { required: "The description field is required." },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
               $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                var post_url = $(form).attr("action");
                var request_method = $(form).attr("method");
                var form_data = new FormData(form);
                $.ajax({
                    url : post_url,
                    type: request_method,
                    data : form_data,
                    cache: false, 
                    contentType: false, 
                    processData: false,
                    success:function(result){
                        //console.log('success');
                        console.log(result);
                        var res = $.parseJSON(result);
                        var thisStatus = res.status;
                        if(thisStatus==1)
                        {
                            alert(res.message);
                            window.location="<?php echo $url.'loan/dipti/view/ta_da_status/list.php'; ?>";
                            //showToast('successToast', result.message, 'success-message')
                        }else if(thisStatus==2){
                            validationErrorMessage(res);
                        }else
                        {
                            alert(res.message);
                            //showToast('errorToast', result.message, 'error-message')
                        }
                    },
                    error:function(result){
                        //console.log('error');
                        console.log(result);
                    }   
                });
            }
        });
</script>
<?php include('../../footer.php'); ?>