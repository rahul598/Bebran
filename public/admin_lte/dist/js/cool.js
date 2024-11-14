

$(function(){
  //Initialize Select2 Elements
  $('.select2').select2();
  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });

  // Summernote
  $('.summernote').summernote();

  // Validate
  jQuery(".customValidate").validate();
  jQuery(".customValidate2").validate();

  $('body').on('click', 'a[data-confirm]', function(e){
    e.preventDefault();
    var confirm = $(this).attr('data-confirm');
    if (confirm == null || !confirm) {
      confirm = "You won't be able to revert this!"
    }

    Swal.fire({
        title: 'Are you sure?',
        text: confirm,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var _action_url = jQuery(this).attr('href');
            window.location.href = _action_url;
            //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        }
    });
  });
});



function delete_confirm(id,type) {
    jQuery("#section_delete_id").val(id);
    jQuery("#section_delete_type").val(type);
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete section then under all lecture also deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var _action_url = jQuery('form#section_delete').attr('action');
                var formData = new FormData(jQuery('form#section_delete')[0]);
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            }
        });
}
function filter_array(test_array) {
  var index = -1,
  arr_length = test_array ? test_array.length : 0,
  resIndex = -1,
  result = [];

  while (++index < arr_length) {
    var value = test_array[index];

    if (value) {
      result[++resIndex] = value;
    }
  }

  return result;
}
if($(".module_name").length>0)
{
  $(".module_name").blur(function(){
    if($(".module_slug").val().trim()=="")
    {
      var slug_array = $(".module_name").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
      slug_array = filter_array(slug_array);

      $(".module_slug").val(slug_array.join("-"));
    }
  });
}
if($(".module_slug").length>0)
{
  $(".module_slug").blur(function(){
    if($(".module_slug").val().trim()==""){
      var slug_array = $(".module_name").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
      slug_array = filter_array(slug_array);
      $(".module_slug").val(slug_array.join("-"));
    }else{
      var slug_array = $(".module_slug").val().trim().replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ').toLowerCase().split(" ");
      slug_array = filter_array(slug_array);
      $(".module_slug").val(slug_array.join("-"));

    }
  });
}

tinymce.init({
  selector: '.tinytextarea',
  plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
  toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
  toolbar_mode: 'floating',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
});
