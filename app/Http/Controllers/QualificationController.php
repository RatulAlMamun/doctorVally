<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualificationRequest;
use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function store(StoreQualificationRequest $request)
    {
        $qualification = Qualification::create([
            'degree_id' => $request->input('degree_id'),
            'institution_id' => $request->input('institution_id'),
            'major' => $request->input('major'),
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date'),
            'doctor_id' => auth()->user()->userDetails->id
        ]);
        return response()->json([
            'error' => 'false',
            'message' => 'Qualification added successfully!!',
            'data' => $qualification
        ], 201);
    }
}
