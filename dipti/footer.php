</div>

</body>
<script>
  function showToast(toastId, message, message_class) {
      var toastElement = document.getElementById(toastId);
      var toast = new bootstrap.Toast(toastElement);
      toast.show();
  }
  function validationErrorMessage(result)
  { 
    $("input, select, textarea").removeClass("is-invalid");  
    $("input, select").closest('div').find('.inputErrorMsg').remove();
    $('.toast').hide();  
     $.each(result.message, function(key, value) { //-------- for all error messages
        console.log(key + ' ' + value);
        
        // Remove existing error messages and classes
        $("input[name='" + key + "'], select[name='" + key + "'], textarea[name='" + key + "']").closest('div').find('.inputErrorMsg').remove();
        $("input[name='" + key + "'], select[name='" + key + "'], textarea[name='" + key + "']").removeClass("is-invalid");

        // Add the invalid class to inputs and textareas
        $("input[name='" + key + "'], textarea[name='" + key + "']").addClass("is-invalid");

        $("select[name='" + key + "']").addClass("is-invalid");

        // Insert error message after inputs and textareas
        $("<div class='inputErrorMsg'>" + value + "</div>").insertAfter("input[name='" + key + "'], textarea[name='" + key + "']");
        
        // Insert error message after select2 elements
        $("<div class='inputErrorMsg'>" + value + "</div>").insertAfter("select[name='" + key + "']");
      });   
   
  }
  
</script>
</html>
