@extends('admin.layout')
@section('contents')
    <div class="alert alert-info text-center font-weight-bold">Danh sách khách hàng</div>
    <div class="d-flex justify-content-between mb-2">
        <button class="btn btn-danger reset-customer">Làm trống danh sách</button>
        <button class="btn btn-primary add-new-customer">Thêm khách hàng mới</button>
    </div>
    <hr style="border-width: 2px">
    <table class="table table-vcenter" id="table-list-customer">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Mã KH</th>
            <th class="text-center">Tên KH</th>
            <th class="text-center">SDT</th>
            <th class="text-center">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="5" class="text-center">Không có khách hàng nào</td>
        </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modal_add_customer" tabindex="-1" role="dialog" aria-labelledby="modalAddCustomer"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title modal-title-add">Thêm khách hàng mới</h5>
                    <h5 class="modal-title modal-title-edit">Sửa thông tin khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
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
