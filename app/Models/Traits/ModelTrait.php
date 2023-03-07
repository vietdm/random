<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait ModelTrait {
    public static function insert($param): self|bool
    {
        DB::beginTransaction();
        try {
            $self = new self;
            foreach ($param as $key => $value) {
                $self->{$key} = $value;
            }
            $self->save();
            DB::commit();
            return $self;
        } catch (\Exception|\PDOException $exception) {
            DB::rollBack();
            logger($exception);
            return false;
        }
    }
}
