const Winner = {
    key: 'customer_winner',
    add(code) {
        const winner = this.all();
        winner.push(code);
        store(this.key, winner);
    },
    all() {
        return store(this.key) || [];
    },
    reset() {
        store(this.key, []);
    },
    render() {
        const listWinner = this.all();
        const customerWin = Customer.all().filter(cus => listWinner.includes(cus.c_code));
        Customer.renderWithCustomerInput('#table-list-customer tbody', customerWin);
    }
}
