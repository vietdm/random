const Customer = {
    async all() {
        return (await $.get('/customer')).data;
    },
    render(target, data = [], hasAction = false) {
        this.renderWithCustomerInput(target, data, hasAction);
    },
    renderWithCustomerInput(target, customers, hasAction = false) {
        if (!(target instanceof jQuery)) {
            target = $(target);
        }
        target.empty();
        const colspan = hasAction ? 5 : 4;
        if (customers.length === 0) {
            target.append(`<tr><td colspan="${colspan}" class="text-center">Không có khách hàng nào</td></tr>`);
            return;
        }
        for (const index in customers) {
            const customer = customers[index];
            const c_code = hasAction ? customer.c_code : customer.c_code.substr(0, customer.c_code.length - 3) + '***';
            const c_phone = hasAction ? customer.c_phone : customer.c_phone.substr(0, customer.c_phone.length - 3) + '***';
            let giai_thuong = '';
            switch (index) {
                case '0':
                    giai_thuong = 'Giải đặc biệt';
                    break;
                case '1':
                    giai_thuong = 'Giải nhất';
                    break;
                case '2':
                    giai_thuong = 'Giải nhì';
                    break;
                case '3':
                    giai_thuong = 'Giải ba';
                    break;
                default:
                    giai_thuong = 'Giải ' + index;
            }
            target.append(`
                <tr data-id="${customer.id}">
                    <td class="text-center">${window.is_admin ? (parseInt(index) + 1) : giai_thuong}</td>
                    <td class="text-center">${c_code}</td>
                    <td class="text-center">${customer.c_name}</td>
                    <td class="text-center">${c_phone}</td>
                    ${hasAction ? `
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-secondary btn-edit-customer" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-customer" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    ` : null}
                </tr>
            `);
        }
    }
}
