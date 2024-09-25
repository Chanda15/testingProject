<?php include('../../header.php'); ?>
<h2>TA DA Status List</h2><p class="text-right"><a href="<?php echo $url.'loan/dipti/view/ta_da_status/status_data.php'; ?>">Add Data</a></p>
<table class="table" id="tadastatuslist">
  <thead>
    <tr>
        <td>#</td>
        <td>Status</td>
        <td>Description</td>
        <td>Action</td>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<script>
  function deleteTaDaStatus(status){
    //alert(status);
    $.ajax({
          url:"<?php echo $url.'loan/dipti/controller/ta_da_status_crud_operation.php?action=delete&status='; ?>"+status,
          type:'GET',
          data:{'ta_da_status':status},
          success:function(response)
          {
              var res = $.parseJSON(response);
              if(res.status==1){
                  alert(res.message);
                  window.location="<?php echo $url.'loan/dipti/view/ta_da_status/list.php'; ?>";
              }      
          }
      });

  }
  $(document).ready(function(){
    $("#tadastatuslist").DataTable({
    "bDestroy": true,
    "processing": true,
     "serverSide": true,
    "ordering": true,
     "dom": 'Bfrtip',
    "lengthMenu": [10, 25, 50, 100,200,300, -1],
     "pageLength": 10,
     "ajax": {
    'type': 'POST',
     "url": "<?php echo $url.'loan/dipti/controller/ta_da_status_crud_operation.php?action=list'; ?>",
    error: function (xhr, error, code)
     {
     console.log(xhr);
     console.log(code);
     console.log(error);
     },
     },
     "columns": [
            { "data": null  },
            { "data": "status" },
            { "data": "status_description" },
            { "data": null },
     ],
     "columnDefs": [
            {
                "targets": 0, // First column
                "orderable": false, // Disable sorting
                "searchable": false, // Disable searching
                "render": function (data, type, row, meta) {
                    return meta.row + 1; // Row number
                    
                }
            },
            {
                "targets": -1, // -1 for last column
                "orderable": false, // Disable sorting
                "searchable": false, // Disable searching
                "render": function (data, type, row, meta) {
                  console.log(row.status);
                    var action  = `<a href="status_data.php?action=edit&status=${row.status}" title="Edit Status">Edit</a> - <a href="javascript:void(0);" onClick="return deleteTaDaStatus('${row.status}')" title="Delete Status">Delete</a>`;
                    return action;
                }
            }
      ],
    "fnCreatedRow": function( nRow, aData, iDataIndex ) {
      //$(nRow).attr('id', 'tr_'+aData['id']);
    },
        buttons: [
            {
                extend: 'pdfFlash',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            {
                extend: 'excelHtml5',
                filename: function() {
                    let date = new Date();
                    let day = String(date.getDate()).padStart(2, '0');
                    let month = String(date.getMonth() + 1).padStart(2, '0');
                    let year = date.getFullYear();
                    return 'Employee_List_' + year + '-' + month + '-' + day;
                },
                exportOptions: {
                    columns: ':1, //not(:last-child)', // Exclude the last column (Action column)
                    modifier: {
                        page: 'all' // Export all data, not just the current page
                    }
                },
                
            },
       'copy', 'print','pageLength','colvis'
       ]
  });
  });
</script>
<?php include('../../footer.php'); ?>