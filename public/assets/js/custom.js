
$(function(){
    $('#add-task-button').on('click',function(e){
        $('#add-new-task').toggle();

    });

    $('#taskModal').on('shown.bs.modal', function (e) {

       var self = $(this);
       var data = $('#task-form').serialize();

       $.ajax({
           type: 'POST',
           url: '/task/preview',
           data: data,
           dataType:'html',
           success: function(html){
            self.find('div.modal-body').html(html);
           }
       });
    })

});