const BtnAddCustomer = $('.add-new-customer');
const BtnResetCustomer = $('.reset-customer');
const AddCustomerModal = $('#modal_add_customer');
const TableListCustomer = $('#table-list-customer');
const TableListCustomerBody = TableListCustomer.find('tbody');

const validateFormCustomer = () => {
    const inputs = AddCustomerModal.find('input');
    let hasError = false;
    inputs.removeClass('error');
    inputs.each((_, input) => {
        if (input.value.trim() === '') {
            input.classList.add('error');
            hasError = true;
        }
    });
    return !hasError;
};

const renderTableData = () => {
    Customer.render(TableListCustomerBody, true);
};

BtnAddCustomer.on('click', () => {
    AddCustomerModal.modal({
        keyboard: false,
        backdrop: 'static'
    });
});

BtnResetCustomer.on('click', () => {
    const resetCustomerAction = () => {
        Customer.reset();
        Fire.success('Làm trống danh sách khách hàng thành công!', 'Thành công!');
        renderTableData();
    };
    Fire.confirm('Chắc chắn xóa hết khách hàng?', resetCustomerAction);
});

AddCustomerModal.on('hidden.bs.modal', () => {
    AddCustomerModal.find('form').trigger('reset');
    AddCustomerModal.removeClass('edit').removeAttr('data-c-code');
});

AddCustomerModal.find('input').on('input', function (e) {
    $(this).removeClass('error');
    if (
        ($(this).hasClass('number-only') || $(this).attr('type') == 'number')
        && (/\D/.test(e.data))
    ) {
        // this.value = parseInt(this.value.replace(/\D/g, ''));
    }
});


AddCustomerModal.find('.btn-add-customer').on('click', function () {
    if (!validateFormCustomer()) return;
    let newCustomer = AddCustomerModal.find('form').serializeArray();
    newCustomer = newCustomer.reduce((res, cus) => {
        res[cus.name] = cus.value;
        return res;
    }, {});
    const statusAddCustomer = Customer.add(
        newCustomer.c_code,
        newCustomer.c_name,
        newCustomer.c_phone
    );
    if (!statusAddCustomer) {
        return false;
    }
    Fire.success('Đã thêm thành công!', 'Success!');
    renderTableData();
    if (this.classList.contains('cb-continue')) {
        AddCustomerModal.trigger('hidden.bs.modal');
    } else {
        AddCustomerModal.modal('hide');
    }
});

AddCustomerModal.find('.btn-edit-customer').on('click', function () {
    const c_code = AddCustomerModal.attr('data-c-code');
    const customer = Customer.findCode(c_code);
    if (customer === null) {
        Fire.error('Khách hàng này không tồn tại!');
        AddCustomerModal.modal('hide');
        return;
    }
    if (!validateFormCustomer()) return;
    const customerForm = AddCustomerModal.find('form')
        .serializeArray()
        .reduce((res, cus) => {
            res[cus.name] = cus.value;
            return res;
        }, {});
    customer.c_code = customerForm.c_code;
    customer.c_name = customerForm.c_name;
    customer.c_phone = customerForm.c_phone;
    if (Customer.update(c_code, customer)) {
        AddCustomerModal.modal('hide');
        Fire.success('Sửa thông tin khách hàng thành công!', 'Thành công!');
        renderTableData();
    }
});

TableListCustomer.on('click', '.btn-edit-customer', function () {
    const $tr = $(this).closest('tr');
    const c_code = $tr.attr('data-c-code');
    const customer = Customer.findCode(c_code);
    if (customer === null) {
        Fire.error('Khách hàng này không tồn tại!');
        return;
    }
    AddCustomerModal.addClass('edit').attr('data-c-code', c_code).modal('show');
    AddCustomerModal.find('[name="c_code"]').val(customer.c_code);
    AddCustomerModal.find('[name="c_name"]').val(customer.c_name);
    AddCustomerModal.find('[name="c_phone"]').val(customer.c_phone);
});

TableListCustomer.on('click', '.btn-delete-customer', function () {
    const $tr = $(this).closest('tr');
    const c_code = $tr.attr('data-c-code');
    const deleteCustomerAction = () => {
        Customer.delete(c_code);
        Fire.success('Xóa khách hàng thành công!', 'Thành công!');
        renderTableData();
    };
    Fire.confirm('Chắc chắn xóa khách hàng này?', deleteCustomerAction)
});

$(document).ready(() => {
    renderTableData();
});
