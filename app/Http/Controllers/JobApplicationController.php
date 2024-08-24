<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobApplicationResource;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JobApplicationController extends Controller
{
  
    public function apply(Request $request, $jobId)
    {
    
       

        $job = Job::findOrFail($jobId);

   
        if (!Auth::check()) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        $application = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
        ]);

        return new JobApplicationResource($application);
    }


    public function index($jobId)
    {
        $job = Job::findOrFail($jobId);


        if ($job->applications->isEmpty()) {
            return response()->json([
                'message' => 'No applications found for this job.'
            ], 404);
        }

        return JobApplicationResource::collection($job->applications);
    }
}
