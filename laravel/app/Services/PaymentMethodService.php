<?php

namespace App\Services;

use App\Modules\PaymentMethod;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PaymentMethodService
{
    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $model = $this->model->create($data);
            
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return $model;
    }

    public function update(array $data, $id)
    {
        try {
            DB::beginTransaction();

            $model = $this->model->findOrFail($id);

            // $data['slug'] = Str::slug($data['title'], '-');

            $model->update($data);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return $model;
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->model->findOrFail($id)->delete();
            
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return true;
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $this->model->onlyTrashed()->findOrFail($id)->restore();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return true;
    }
}
