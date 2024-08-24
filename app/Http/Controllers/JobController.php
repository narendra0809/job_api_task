<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    // Fetch all jobs
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    // Show a single job
    public function show($id)
    {
        $job = Job::find($id);

        // Check if job exists
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        return response()->json($job);
    }

    // Store a new job
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Create a new job with authenticated user's ID
        $job = Job::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'company' => $request->input('company'),
            'location' => $request->input('location'),
            'salary' => $request->input('salary'),
            'user_id' => auth()->id() // Automatically assign the authenticated user's ID
        ]);
    
        return response()->json($job, 201);
    }
    

    // Update an existing job
    public function update(Request $request, $id)
    {
        $job = Job::find($id);

        // Check if job exists
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'company' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'salary' => 'nullable|numeric',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Update job with validated data
        $job->update($request->all());

        return response()->json($job);
    }

    // Delete a job
    public function destroy($id)
    {
        $job = Job::find($id);

        // Check if job exists
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        $job->delete();

        return response()->json(['message' => 'Job deleted successfully.']);
    }

    // Search jobs with filters
    public function search($search)
    {
        // Search by either title or location
        $jobs = Job::where('title', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->get();
    
        if ($jobs->isNotEmpty()) {
            return ["result" => $jobs];
        } else {
            return ["result" => "Jobs not found"];
        }
    }
    
        
    }
    

