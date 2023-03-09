const Winner = {
    key: 'customer_winner',
    async add(code) {
        const result = await $.post('/winner/' + code);
        if (!result.success) {
            Fire.error(result.message);
        }
    },
    async all() {
        const winner = (await $.get('/winner')).data;
        return winner.map(win => win.c_code);
    },
    async reset() {
        await $.post('/winner/truncate');
    },
    async render() {
        const listWinner = await this.all();
        const customerWin = (await Customer.all()).filter(cus => listWinner.includes(cus.c_code));
        Customer.renderWithCustomerInput('#table-list-customer tbody', customerWin);
    }
}
