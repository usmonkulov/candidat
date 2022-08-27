$('#modal_button').on('click', function (event) {
    event.preventDefault();
    let url = $(this).attr('href');
    $('#myModal').modal('show');
    send(url);
});

function send(_url, formData = null) {
    $.ajax({
        url:_url,
        type: "POST",
        dataType: "json",
        data: formData,
        success: function (data) {
            $('#myModal').modal('show').find('#modalContent').html(data);
            $('#save-button').on('click', function (e) {
                e.preventDefault();
                let form = $('#prl-form').serialize();
                send(_url, form);
                return false;
            });
        }
    });
}