<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Retrieve all courses
    public function index(Request $request)
    {
        $query = Course::query();

        // Filter by Category
        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        // Filter by Price (Free or Paid)
        if ($request->has('price')) {
            if ($request->input('price') === 'Free') {
                $query->where('price', 0);
            } elseif ($request->input('price') === 'Paid') {
                $query->where('price', '>', 0);
            } elseif ($request->has('price_range')) {
                $range = explode('-', $request->input('price_range'));
                $query->whereBetween('price', [(float)$range[0], (float)$range[1]]);
            }
        }

        // Filter by Difficulty Level
        if ($request->has('difficulty')) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        // Filter by Duration
        if ($request->has('duration')) {
            switch ($request->input('duration')) {
                case '< 2 hours':
                    $query->where('duration', '<', 2);
                    break;
                case '2–5 hours':
                    $query->whereBetween('duration', [2, 5]);
                    break;
                case '5–10 hours':
                    $query->whereBetween('duration', [5, 10]);
                    break;
                case '> 10 hours':
                    $query->where('duration', '>', 10);
                    break;
            }
        }

        // Filter by Ratings
        if ($request->has('ratings')) {
            switch ($request->input('ratings')) {
                case '4+ stars':
                    $query->where('rating', '>=', 4);
                    break;
                case '3+ stars':
                    $query->where('rating', '>=', 3);
                    break;
                case '2 stars and below':
                    $query->where('rating', '<=', 2);
                    break;
            }
        }

        // Filter by Course Format
        if ($request->has('format')) {
            $query->where('format', $request->input('format'));
        }

        // Filter by Certification
        if ($request->has('certification')) {
            $query->where('certification', $request->input('certification'));
        }

        // Filter by Release Date
        if ($request->has('release_date')) {
            $date = now();
            switch ($request->input('release_date')) {
                case 'Last 30 days':
                    $query->where('release_date', '>=', $date->subDays(30));
                    break;
                case 'Last 6 months':
                    $query->where('release_date', '>=', $date->subMonths(6));
                    break;
                case 'Last 1 year':
                    $query->where('release_date', '>=', $date->subYear());
                    break;
            }
        }

        $courses = $query->get();

        return response()->json($courses);
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
