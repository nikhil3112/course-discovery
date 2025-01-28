<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if (!empty($request->input('keyword'))) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if (!empty($request->input('category'))) {
            $query->where('category', $request->input('category'));
        }

        if (!empty($request->input('price'))) {
            if ($request->input('price') === 'Free') {
                $query->where('price', 0);
            } elseif ($request->input('price') === 'Paid') {
                $query->where('price', '>', 0);
            }
        }

        if ($request->has('price_range') && $request->price_range) {
            $range = explode('-', $request->price_range);
            if (count($range) === 2) {
                $query->whereBetween('price', [(float)$range[0], (float)$range[1]]);
            }
        }

        if (!empty($request->input('difficulty'))) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        if ($request->has('duration') && $request->duration) {
            switch ($request->duration) {
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

        if ($request->has('format') && $request->format) {
            $query->where('format', $request->format);
        }

        if ($request->has('certification') && $request->certification) {
            $query->where('certification', $request->certification);
        }

        $courses = $query->get();

        return view('courses.index', compact('courses'));
    }

}
