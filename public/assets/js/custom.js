
$(function(){
    $('#add-task-button').on('click',function(e){
        $('#add-new-task').toggle();

    });

    $('a.fancybox').fancybox({});

    $('#taskModal').on('shown.bs.modal', function (e) {

       var self = $(this);
       var data = $('#task-form').serialize();
        var formdata = false;
        if (window.FormData){
           formdata = new FormData($('#task-form')[0]);
        }
     //  formData.append('name',form.find('input[name="User[name]"]').val());



       $.ajax({
           type: 'POST',
           url: '/task/preview',
           data:formdata ? formdata : data,
           dataType:'html',
           cache       : false,
           contentType : false,
           processData: false,
           success: function(html){
           self.find('div.modal-body').html(html);
               $('a.fancybox-new').fancybox({});
           }
       });
    })

});