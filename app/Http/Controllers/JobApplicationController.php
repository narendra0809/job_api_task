<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobApplicationResource;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    // Apply for a job
    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $application = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
        ]);

        return new JobApplicationResource($application);
    }

    // Display all applications for a job
    public function index($jobId)
    {
        $job = Job::findOrFail($jobId);

        return JobApplicationResource::collection($job->applications);
    }
}

