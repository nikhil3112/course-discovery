<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Retrieve all courses
    public function index()
    {
        return response()->json(Course::all(), 200);
    }

    // Retrieve a specific course by ID
    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json($course, 200);
    }

    // Add a new course
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'instructor' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'difficulty' => 'required|in:Beginner,Intermediate,Advanced',
            'duration' => 'required|integer|min:1',
            'rating' => 'nullable|integer|between:1,5',
            'format' => 'required|in:Video,Text-based,Interactive/Live',
            'certification' => 'required|boolean',
            'release_date' => 'nullable|date',
            'popularity' => 'nullable|integer|min:0',
        ]);

        $course = Course::create($validated);

        return response()->json($course, 201);
    }

    // Update a course
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'instructor' => 'string|max:255',
            'category' => 'string|max:255',
            'difficulty' => 'in:Beginner,Intermediate,Advanced',
            'duration' => 'integer|min:1',
            'rating' => 'integer|between:1,5',
            'format' => 'in:Video,Text-based,Interactive/Live',
            'certification' => 'boolean',
            'release_date' => 'date',
            'popularity' => 'integer|min:0',
        ]);

        $course->update($validated);

        return response()->json($course, 200);
    }

    // Delete a course
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully'], 204);
    }
}
