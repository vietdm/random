@extends('layout')
@section('head')
    <title>Trang chủ</title>
@endsection
@section('menu-head')
    <a href="/quan-ly-khach-hang">Quản lý khách hàng</a>
@endsection
@section('contents')
    <div class="area-random">
        <div class="random">
            <div class="random-text justify-content-center align-item-center" style="display: flex;">
                Ai may mắn
            </div>
            <div class="random-show justify-content-center align-item-center" style="display: none;"></div>
            <div class="triangle"></div>
        </div>
        <div class="mt-4">
            <button id="start-random" class="btn btn-success">Bắt đầu</button>
        </div>
    </div>
    <div class="container mt-4">
        <hr>
        <div class="d-flex justify-content-end mb-1">
            <button class="btn btn-info btn-reset-winner">Bắt đầu lại</button>
        </div>
        <table class="table table-center" id="table-list-customer">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Mã KH</th>
                    <th>Tên KH</th>
                    <th>SDT</th>
                </tr>
            </thead>
            <tbody>
                <td colspan="4">Không có khách hàng nào</td>
            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/random-control.js') }}"></script>
    <script src="{{ asset('js/winner.js') }}"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
