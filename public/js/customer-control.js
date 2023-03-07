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

const renderTableData = async () => {
    const result = await $.get('/admin/customer');
    Customer.render(TableListCustomerBody, result.data, true);
};

BtnAddCustomer.on('click', () => {
    AddCustomerModal.modal({
        keyboard: false,
        backdrop: 'static'
    });
});

BtnResetCustomer.on('click', () => {
    const resetCustomerAction = async () => {
        const result = await $.post('/admin/customer/truncate');
        if (result.success) {
            Fire.success('Làm trống danh sách khách hàng thành công!', 'Thành công!');
            renderTableData();
        } else {
            Fire.error(result.message);
        }
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

AddCustomerModal.find('.btn-add-customer').on('click', async function () {
    if (!validateFormCustomer()) return;
    let newCustomer = AddCustomerModal.find('form').serializeArray();
    newCustomer = newCustomer.reduce((res, cus) => {
        res[cus.name] = cus.value;
        return res;
    }, {});
    const result = await $.post('/admin/customer/add', newCustomer);
    if (!result.success) {
        return Fire.error(result.message, 'Oh no!');
    }
    renderTableData();
    if (this.classList.contains('cb-continue')) {
        AddCustomerModal.trigger('hidden.bs.modal');
    } else {
        AddCustomerModal.modal('hide');
    }
});

AddCustomerModal.find('.btn-edit-customer').on('click', async function () {
    const id = AddCustomerModal.attr('data-id');
    if (!validateFormCustomer()) return;
    const customerForm = AddCustomerModal.find('form')
        .serializeArray()
        .reduce((res, cus) => {
            res[cus.name] = cus.value;
            return res;
        }, {});
    const result = await $.post("/admin/customer/edit/" + id, customerForm);
    if (result.success) {
        AddCustomerModal.modal('hide');
        Fire.success('Sửa thông tin khách hàng thành công!', 'Thành công!');
        renderTableData();
    } else {
        Fire.error(result.message);
    }
});

TableListCustomer.on('click', '.btn-edit-customer', async function () {
    const $tr = $(this).closest('tr');
    const id = $tr.attr('data-id');
    const customer = (await $.get('/admin/customer/id/' + id)).data;
    if (customer === null) {
        Fire.error('Khách hàng này không tồn tại!');
        AddCustomerModal.modal('hide');
        return;
    }
    AddCustomerModal.addClass('edit').attr('data-id', customer.id).modal('show');
    AddCustomerModal.find('[name="c_code"]').val(customer.c_code);
    AddCustomerModal.find('[name="c_name"]').val(customer.c_name);
    AddCustomerModal.find('[name="c_phone"]').val(customer.c_phone);
});

TableListCustomer.on('click', '.btn-delete-customer', function () {
    const $tr = $(this).closest('tr');
    const id = $tr.attr('data-id');
    const deleteCustomerAction = async () => {
        const result = await $.post('/admin/customer/delete/' + id);
        if (result.success) {
            Fire.success(result.message, 'Thành công!');
            renderTableData();
        } else {
            Fire.error(result.message, 'Opps!');
        }
    };
    Fire.confirm('Chắc chắn xóa khách hàng này?', deleteCustomerAction)
});

$(document).ready(() => {
    renderTableData();
});
