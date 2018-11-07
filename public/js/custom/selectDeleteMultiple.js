 $(document).ready(function () {
  
  $('#check_all').on('click', function(e) {
   if($(this).is(':checked',true))  
   {
    $(".checkbox").prop('checked', true);  
  } else {  
    $(".checkbox").prop('checked',false);
  }  
});
  $('.checkbox').on('click',function(){
    if($('.checkbox:checked').length == $('.checkbox').length){
      $('#check_all').prop('checked',true);
    }else{
      $('#check_all').prop('checked',false);
    }
  });

  $('#multiple_select').change(function() {
    if($('#multiple_select option:selected').val() == 1) {
      var idsArr = [];  
      $(".checkbox:checked").each(function() { 
        idsArr.push($(this).attr('data-id'));
      });  
      if(idsArr.length <=0)
      {  
        // alert("Please select atleast one record to delete.");
        swal("Information","Please select atleast one record to delete.","info");
      } 
      else{
        swal({
          title: "Are you sure ??",
          text: 'This will be deleted permanently.', 
          icon: "warning",
          buttons: true,
          showCancelButton: true,
          confirmButtonColor: '#d33',
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var strIds = idsArr.join(","); 
            $.ajax({
              url: url,
              type: 'DELETE',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: 'ids='+strIds,
              success: function (data) {
                if (data['status']==true) {
                  $(".checkbox:checked").each(function() {  
                    $(this).parents("tr").remove();
                  });
                  swal("Success!", data['message'], "success");
                  // alert(data['message']);
                } else {
                  swal("Error!", 'Whoops Something went wrong!', "error");
                }
              },
              error: function (data) {
                // alert(data.responseText);
                swal(data.responseText);
                // swal("Error!", 'Whoops Something went wrong!', "error");
              }
            });
          }
        }); 
      }  
    }
  });
});