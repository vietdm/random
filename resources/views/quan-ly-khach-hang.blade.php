@extends('layout')
@section('head')
    <link rel="stylesheet" href="css/customer.css">
    <title>Quản lý khách hàng</title>
@endsection
@section('menu-head')
    <a href="/">Trang chủ</a>
@endsection
@section('contents')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center font-weight-bold">Danh sách khách hàng</div>
                <div class="d-flex justify-content-between mb-2">
                    <button class="btn btn-danger reset-customer">Làm trống danh sách</button>
                    <button class="btn btn-primary add-new-customer">Thêm khách hàng mới</button>
                </div>
                <table class="table table-center table-bordered" id="table-list-customer">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã KH</th>
                            <th>Tên KH</th>
                            <th>SDT</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td colspan="5">Không có khách hàng nào</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_add_customer" tabindex="-1" role="dialog" aria-labelledby="modalAddCustomer"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title modal-title-add">Thêm khách hàng mới</h5>
                    <h5 class="modal-title modal-title-edit">Sửa thông tin khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" onsubmit="() => false">
                        <div class="form-group">
                            <label for="c_code">Mã:</label>
                            <input type="number" name="c_code" id="c_code" class="form-control number-only">
                        </div>
                        <div class="form-group">
                            <label for="c_name">Tên:</label>
                            <input type="text" name="c_name" id="c_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="c_phone">Số điện thoại:</label>
                            <input type="number" name="c_phone" id="c_phone" class="form-control number-only">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-info btn-add-customer cb-continue">Thêm và tiếp tục</button>
                    <button type="button" class="btn btn-primary btn-add-customer">Thêm và đóng</button>
                    <button type="button" class="btn btn-primary btn-edit-customer">Sửa</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/customer-control.js') }}"></script>
@endsection
