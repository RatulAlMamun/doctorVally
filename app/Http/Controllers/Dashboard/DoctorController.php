<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDoctorProfileRequest;
use App\Models\User;

class DoctorController extends Controller
{
    public function update(UpdateDoctorProfileRequest $request)
    {
        $user = auth()->user();
        $userData = [];
        $doctorData = [];
        if($request->email)
        {
            $userData['email'] = $request->input('email');
        }
        if($request->phone)
        {
            $userData['phone'] = $request->input('phone');
        }
        if($request->gender)
        {
            $doctorData['gender'] = $request->input('gender');
        }
        if($request->address)
        {
            $doctorData['address'] = $request->input('address');
        }
        if($request->bio)
        {
            $doctorData['bio'] = $request->input('bio');
        }
        if($request->facebook)
        {
            $doctorData['facebook'] = $request->input('facebook');
        }
        if($request->youtube)
        {
            $doctorData['youtube'] = $request->input('youtube');
        }
        if($request->linkedin)
        {
            $doctorData['linkedin'] = $request->input('linkedin');
        }
        if($request->twitter)
        {
            $doctorData['twitter'] = $request->input('twitter');
        }
        if($userData)
        {
        $user->update($userData);
        }
        if($doctorData)
        {
            $user->userDetails()->update($doctorData);
        }
        return response()->json([
            'error' => false,
            'message' => 'Doctor updated successfully!!',
            'data' => [
                'user' => $user,
                'userDetails' => $user->userDetails
            ]
        ]);

    }
}
