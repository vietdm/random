<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwardSystem;
use App\Models\Customers;
use App\Response\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AwardSystemController extends Controller
{
    public function list() {
        return Response::success(AwardSystem::all());
    }

    public function getOne($id) {
        return Response::success(AwardSystem::whereId($id)->first());
    }

    public function add(Request $request) {
        if (!empty($request->id)) {
            $awardSystem = AwardSystem::whereId($request->id)->first();
            if ($awardSystem == null) {
                return Response::error('Giải thưởng không tồn tại!');
            }
        } else {
            $awardSystem = new AwardSystem();
        }

        $name = $request->name ?? null;
        $amount = $request->amount ?? null;
        $money = $request->money ?? null;
        $descriptions = $request->descriptions ?? null;

        if (empty($name) || empty($amount) || empty($money) || empty($descriptions)) {
            return Response::error('Vui lòng nhập đầy đủ thông tin!');
        }

        $awardSystem->name = $name;
        $awardSystem->amount = $amount;
        $awardSystem->money = $money;
        $awardSystem->descriptions = $descriptions;

        DB::beginTransaction();
        try {
            $awardSystem->save();
            DB::commit();
            return Response::success([], 'Cập nhật thông tin giải thưởng thành công!');
        } catch (\Exception|\PDOException $exception) {
            DB::rollBack();
            logger($exception);
            return Response::error('Đã có lỗi xảy ra trong quá trình cập nhật thông tin!');
        }
    }

    public function delete($id) {
        $awardSystem = AwardSystem::whereId($id)->first();
        DB::beginTransaction();
        try {
            $awardSystem->delete();
            DB::commit();
            return Response::success([], 'Xóa giải thưởng thành công!');
        } catch (\Exception|\PDOException $exception) {
            DB::rollBack();
            logger($exception);
            return Response::error('Đã có lỗi xảy ra trong quá trình xóa giải thưởng!');
        }
    }
}
