<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait apiResponse
{


    protected function successResponse($data, $code)
    {
        return response()->json(['data' => $data, 'status' => $code], $code);
    }
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse($instance, $code);
    }
    protected static function errorResponse($message, $code)
    {
        return response()->json(['message' => $message, "code" => $code], $code);
    }
    protected function paginate(Collection $collection, $perPage)
    {
        $rules = [
            'perPage' => 'integer|min:2|max:50',
        ];
        Validator::validate(request()->all(), $rules);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        if (request()->has('perPage')) {
            $perPage = request()->perPage;
        }
        $result = $collection->slice(($page - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($result, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginator->appends(request()->all());

        return $paginator;
    }
}
