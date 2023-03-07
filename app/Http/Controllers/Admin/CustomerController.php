<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function list() {
        return Response::success(Customers::all());
    }

    public function getOne($type, $value) {
        $data = null;
        switch ($type) {
            case 'c_code':
                $data = Customers::whereCCode($value)->first();
                break;
            case 'c_phone':
                $data = Customers::whereCPhone($value)->first();
                break;
            case 'id':
                $data = Customers::whereId($value)->first();
                break;
        }
        return Response::success($data);
    }

    public function add(Request $request) {
        $c_code = $request->c_code ?? null;
        $c_name = $request->c_name ?? null;
        $c_phone = $request->c_phone ?? null;

        if (empty($c_code) || empty($c_name) || empty($c_phone)) {
            return Response::error('Vui lòng nhập đầy đủ thông tin!');
        }

        $customer = Customers::insert([
            'c_code' => $c_code,
            'c_name' => $c_name,
            'c_phone' => $c_phone,
        ]);

        if ($customer === false) {
            return Response::error('Thêm khách hàng không thành công! Vui lòng thông báo với Quản Trị Viên');
        }

        return Response::success($customer, 'Tạo khách hàng thành công!');
    }

    public function edit($id, Request $request) {
        $c_code = $request->c_code ?? null;
        $c_name = $request->c_name ?? null;
        $c_phone = $request->c_phone ?? null;

        if (empty($c_code) || empty($c_name) || empty($c_phone)) {
            return Response::error('Vui lòng nhập đầy đủ thông tin!');
        }

        $customer = Customers::whereId($id)->first();
        if ($customer == null) {
            return Response::error('Khách hàng này không còn tồn tại!');
        }

        if ($c_code != $customer->c_code) {
            //check trùng code
            $customerWithCode = Customers::whereCCode($c_code)->first();
            if ($customerWithCode != null) {
                return Response::error('Code khách hàng này đã tồn tại!');
            }
        }

        if ($c_phone != $customer->c_phone) {
            //check trùng sdt
            $customerWithPhone = Customers::whereCPhone($c_phone)->first();
            if ($customerWithPhone != null) {
                return Response::error('Số điện thoại khách hàng này đã tồn tại!');
            }
        }

        $customer->c_code = $c_code;
        $customer->c_name = $c_name;
        $customer->c_phone = $c_phone;

        DB::beginTransaction();
        try {
            $customer->save();
            DB::commit();
            return Response::success([], 'Cập nhật thông tin thành công!');
        } catch (\Exception|\PDOException $exception) {
            DB::rollBack();
            logger($exception);
            return Response::error('Đã có lỗi xảy ra trong quá trình cập nhật thông tin!');
        }
    }

    public function delete($id) {
        $customer = Customers::whereId($id)->first();
        DB::beginTransaction();
        try {
            $customer->delete();
            DB::commit();
            return Response::success([], 'Xóa khách hàng thành công!');
        } catch (\Exception|\PDOException $exception) {
            DB::rollBack();
            logger($exception);
            return Response::error('Đã có lỗi xảy ra trong quá trình xóa khách hàng!');
        }
    }

    public function truncate() {
        Customers::truncate();
        return Response::success([], 'Xóa toàn bộ khách hàng thành công!');
    }
}
