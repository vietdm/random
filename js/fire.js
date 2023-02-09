const Fire = {
    error(content, title = 'Oops...') {
        Swal.fire({
            icon: 'error',
            title,
            html: content,
        })
    },
    success(content, title = 'Congratulations!!') {
        Swal.fire({
            icon: 'success',
            title,
            html: content,
        })
    },
    confirm(content, confirmCallback, cancelCallback) {
        Swal.fire({
            title: '',
            text: content,
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: 'Xác nhận',
            denyButtonText: 'Không',
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof confirmCallback === 'function') {
                    confirmCallback();
                }
            }
            if (result.isDenied) {
                if (typeof cancelCallback === 'function') {
                    cancelCallback();
                }
            }
        })
    }
}
