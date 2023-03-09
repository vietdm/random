<?php

namespace App\Http\Controllers;

use App\Models\Winner;
use App\Response\Response;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    public function list() {
        return Response::success(Winner::all());
    }

    public function add($code) {
        if (Winner::whereCCode($code)->first() !== null) {
            return Response::error('Khách hàng này đã trúng giải trước đó!');
        }
        Winner::insert([
            'c_code' => $code,
            'winner_date' => date('Y-m-d H:i:s')
        ]);
        return Response::success();
    }

    public function truncate() {
        Winner::truncate();
        return Response::success();
    }
}
