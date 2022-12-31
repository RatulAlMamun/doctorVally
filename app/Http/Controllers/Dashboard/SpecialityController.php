<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchSpecialityRequest;
use App\Http\Requests\StoreSpecialityRequest;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function store(StoreSpecialityRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'created_by' => auth()->id(),
            'status' => false
        ];
        $speciality = Speciality::create($data);
        return response()->json([
            'error' => false,
            'message' => 'Specility added successfully!!',
            'data' => $speciality
        ], 201);
    }
    public function search(SearchSpecialityRequest $request)
    {
        $speciality = Speciality::where('name', 'LIKE', "%$request->search%")->get();
        return response()->json([
            'error' => false,
            'message' => 'Specility search result!!',
            'data' => $speciality
        ]);
    }
}
