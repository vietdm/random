const TableListCustomer = $('#table-list-customer');
const TableListCustomerBody = TableListCustomer.find('tbody');
const customers = Customer.all().map(customer => customer.c_code);

const random = new RandomControl(
    customers,
    '.random-show',
    'Chúc mừng khách hàng có mã <b>%winner%</b> đã chiến thắng!!!'
);

$('#start-random').on('click', () => {
    random.run(1.5);
});

$(document).ready(() => {
    Customer.render(TableListCustomerBody);
    if (customers.length === 0) {
        $('#start-random').prop('disabled', true);
    }
});
