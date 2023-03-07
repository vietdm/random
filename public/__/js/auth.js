$('.form-authen').on('submit', function(e) {
    e.preventDefault();

    const $form = $(this);
    if (!$form.valid()) return false;

    const url = $form.attr('action');
    const username = $form.find('[name="login-username"]').val().trim();
    const password = $form.find('[name="login-password"]').val().trim();

    $.post(url, {username, password}, (result) => {
        if (!result.success) {
            return toast.fire('Oops...', result.message, 'error');
        }
        window.location.href = '/admin';
    });

    return false;
})
