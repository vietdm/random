const Customer = {
    key: 'customers',
    all() {
        return store(this.key) || [];
    },
    add(c_code, c_name, c_phone) {
        if (this.findPhone(c_phone) !== null) {
            Fire.error('Số điện thoại này đã tồn tại!');
            return false;
        }
        if (this.findCode(c_code) !== null) {
            Fire.error('Mã khách hàng đã tồn tại!');
            return false;
        }
        this.push(c_code, c_name, c_phone);
        return true;
    },
    update(c_code, param) {
        const customers = this.all();
        let indexUpdate = null;
        for (const index in customers) {
            const customer = customers[index];
            if (customer.c_code !== c_code) continue;
            indexUpdate = index;
            break;
        }
        if (indexUpdate === null) return false;
        const customer = customers[indexUpdate];
        if (param.c_phone && param.c_phone !== customer.c_phone) {
            if (this.findPhone(param.c_phone) !== null) {
                Fire.error('Số điện thoại này đã tồn tại!');
                return false;
            }
        }
        if (param.c_code && param.c_code !== customer.c_code) {
            if (this.findCode(param.c_code) !== null) {
                Fire.error('Mã khách hàng đã tồn tại!');
                return false;
            }
        }
        customers[indexUpdate] = param;
        store(this.key, customers);
        return true;
    },
    delete(c_code) {
        const customers = this.all().filter(customer => customer.c_code !== c_code);
        store(this.key, customers);
    },
    reset() {
        store(this.key, []);
    },
    findPhone(c_phone) {
        let customers = this.all();
        customers = customers.filter(customer => customer.c_phone === c_phone);
        return customers.length > 0 ? customers[0] : null;
    },
    findCode(c_code) {
        let customers = this.all();
        customers = customers.filter(customer => customer.c_code === c_code);
        return customers.length > 0 ? customers[0] : null;
    },
    push(c_code, c_name, c_phone) {
        const customers = this.all();
        customers.push({
            c_code,
            c_name,
            c_phone
        });
        store(this.key, customers);
    },
    render(target, hasAction = false) {
        this.renderWithCustomerInput(target, this.all(), hasAction);
    },
    renderWithCustomerInput(target, customers, hasAction = false) {
        if (!(target instanceof jQuery)) {
            target = $(target);
        }
        target.empty();
        const colspan = hasAction ? 5 : 4;
        if (customers.length === 0) {
            target.append(`<tr><td colspan="${colspan}">Không có khách hàng nào</td></tr>`);
            return;
        }
        for (const index in customers) {
            const customer = customers[index];
            const c_code = hasAction ? customer.c_code : customer.c_code.substr(0, customer.c_code.length - 3) + '***';
            const c_phone = hasAction ? customer.c_phone : customer.c_phone.substr(0, customer.c_phone.length - 3) + '***';
            target.append(`
                <tr data-c-code="${customer.c_code}">
                    <td>${parseInt(index) + 1}</td>
                    <td>${c_code}</td>
                    <td>${customer.c_name}</td>
                    <td>${c_phone}</td>
                    ${hasAction ? `
                        <td>
                            <button class="btn btn-info btn-edit-customer">Sửa</button>
                            <button class="btn btn-danger btn-delete-customer">Xóa</button>
                        </td>
                    ` : null}
                </tr>
            `);
        }
    }
}
