$(document).on('click', '.delete-photo', function() {
    let id = $(this).attr('data-id');
    let wrap = $(this).closest('.photo-wrap');
    let confirmedBy = confirm("Are you sure you want to delete this Photo?");

    if (confirmedBy) {
        $.ajax({
            url: '/photo/' + id,
            type: 'DELETE',
            data: {
                '_token' : $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                if (response.succeed) {
                    wrap.remove();

                    let flashMessage = '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'
                        + response.message +
                        '</strong></div>';
                    $('#flash-message').append(flashMessage);
                } else {
                    let flashMessage = '<div class="alert alert-error alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>'
                        + response.message +
                        '</strong></div>';
                    $('#flash-message').append(flashMessage);
                }
            },
            error: function (response) {
                console.log('Error:', response);
            }
        });
    }
});
