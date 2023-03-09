const BtnResetWinner = $('.btn-reset-winner');
const customersAsync = async () => (await Customer.all()).map(customer => customer.c_code);

BtnResetWinner.on('click', () => {
    const resetWinnerAction = async () => {
        Winner.reset();
        Fire.success('Xóa hết khách hàng chiến thắng thành công!', 'Thành công!');
        Winner.render();
        triggerDisableStartRandom();
        $('.random-show').hide(100);
        $('.random-text').show(100);
        await new Promise(resolve => setTimeout(resolve, 200));
        $('.random-text').css('display', 'flex');
    };
    Fire.confirm('Chắc chắn xóa hết khách hàng chiến thắng?', resetWinnerAction);
});

const triggerDisableStartRandom = async () => {
    const customers = await customersAsync();
    const winner = await Winner.all();
    if (customers.length === 0 || customers.length === winner.length) {
        $('#start-random').prop('disabled', true);
    } else {
        $('#start-random').prop('disabled', false);
    }
}

$(document).ready(async () => {
    const customers = await customersAsync();

    const random = new RandomControl(
        customers,
        '.random-show',
        'Chúc mừng khách hàng có mã <b>%winner%</b> đã chiến thắng!!!'
    );

    $('#start-random').on('click', () => {
        random.run(1.5);
    });

    Winner.render();
    triggerDisableStartRandom();
});
