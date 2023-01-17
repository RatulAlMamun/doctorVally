<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $doctor = auth()->user()->userDetails;
        // $allExperiences = Experience::where('doctor_id', $doctor->id)->get();
        return response()->json([
            'error' => false,
            'message' => 'All Experience show',
            'data' => $doctor->experiences
        ]);
    }

    public function store(StoreExperienceRequest $request)
    {
        $data = [
            'organization' => $request->input('organization'),
            'designation' => $request->input('designation'),
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date'),
            'current_working' => $request->input('current_working'),
            'location' => $request->input('location'),
            'doctor_id' => $request->input('doctor_id'),
            'created_by' => auth()->id()
        ];
        $experience = Experience::create($data);
        return response()->json([
            'error' => 'false',
            'message' => 'Experience added successfully!!',
            'data' => $experience
        ], 201);
    }

    public function update(UpdateExperienceRequest $request, $id)
    {
        $experience = Experience::find($id);
        if($experience)
        {
            if(auth()->user()->hasRole('doctor') || auth()->id() == $experience->created_by)
            {
                $data = [
                    'organization' => $request->input('organization'),
                    'designation' => $request->input('designation'),
                    'from_date' => $request->input('from_date'),
                    'to_date' => $request->input('to_date'),
                    'current_working' => $request->input('current_working'),
                    'location' => $request->input('location')
                ];
                if($data)
                {
                    $experience->update($data);
                    return response()->json([
                        'error' => false,
                        'message' => 'Experience updated successfully!!',
                        'data' => $experience
                    ]);
                }
                else
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'There is no data to update!!'
                    ], 400);
                }
            }
            else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'Unauthorize access!!'
                ], 401);
            }
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Experience not found'
            ], 404);
        }

    }

    public function delete($id)
    {
        $experience = Experience::find($id);
        if($experience)
        {
            if(auth()->user()->hasRole('doctor') || auth()->id() == $experience->created_by)
            {
                $experience->delete();
                return response()->json([
                    'error' => false,
                    'message' => 'Experience deleted successfully!!',
                    'data' => $experience
                ]);
            }
            else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'Unauthorize access!!'
                ], 401);
            }
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Experience not found'
            ], 404);
        }
    }
}
