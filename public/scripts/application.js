$(document).ready(function() {
    $('form').submit(function(){
        $.post( $(this).attr('action'), {
                id: $(this).find('input[name="id"]').val(),
                name: $(this).find('input[name="name"]').val(),
                message: $(this).find('textarea').val()
            }, function(data) {
                if (jQuery.trim(data)=='OK') {
                    alert('Success');
                    window.location.reload();
                } else {
                    alert(data);
                }
        });

        return false;
    });
});

