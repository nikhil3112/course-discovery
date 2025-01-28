<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Discovery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Course Discovery</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('courses.index') }}" class="bg-white p-4 rounded shadow mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                <div>
                    <label class="block text-sm font-bold mb-2">Title</label>
                    <input
                        type="text"
                        name="keyword"
                        placeholder="Search courses..."
                        class="w-full border-gray-300 rounded p-2"
                        value="{{ request('keyword') }}"
                    />
                </div>
                
                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Category</label>
                    <select name="category" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Category --</option>
                        <option value="Programming" {{ request('category') == 'Programming' ? 'selected' : '' }}>Programming</option>
                        <option value="Design" {{ request('category') == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Business" {{ request('category') == 'Business' ? 'selected' : '' }}>Business</option>
                        <option value="Marketing" {{ request('category') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                    </select>
                </div>

                <!-- Price Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Price</label>
                    <select name="price" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Price --</option>
                        <option value="Free" {{ request('price') == 'Free' ? 'selected' : '' }}>Free</option>
                        <option value="Paid" {{ request('price') == 'Paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Price Range (£)</label>
                    <input
                        type="text"
                        name="price_range"
                        value="{{ request('price_range') }}"
                        placeholder="e.g., 10-100"
                        class="w-full border-gray-300 rounded p-2"
                        value="{{ request('price_range') }}"
                    />
                </div>

                <!-- Difficulty Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Difficulty Level</label>
                    <select name="difficulty" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Difficulty --</option>
                        <option value="Beginner" {{ request('difficulty') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                        <option value="Intermediate" {{ request('difficulty') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                        <option value="Advanced" {{ request('difficulty') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                    </select>
                </div>

                <!-- Duration Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Duration</label>
                    <select name="duration" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Duration --</option>
                        <option value="< 2 hours" {{ request('duration') == '< 2 hours' ? 'selected' : '' }}>&lt; 2 hours</option>
                        <option value="2–5 hours" {{ request('duration') == '2–5 hours' ? 'selected' : '' }}>2–5 hours</option>
                        <option value="5–10 hours" {{ request('duration') == '5–10 hours' ? 'selected' : '' }}>5–10 hours</option>
                        <option value="> 10 hours" {{ request('duration') == '> 10 hours' ? 'selected' : '' }}>&gt; 10 hours</option>
                    </select>
                </div>

                <!-- Ratings Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Ratings</label>
                    <select name="ratings" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Ratings --</option>
                        <option value="4+ stars" {{ request('ratings') == '4+ stars' ? 'selected' : '' }}>4+ stars</option>
                        <option value="3+ stars" {{ request('ratings') == '3+ stars' ? 'selected' : '' }}>3+ stars</option>
                        <option value="2 stars and below" {{ request('ratings') == '2 stars and below' ? 'selected' : '' }}>2 stars and below</option>
                    </select>
                </div>

                <!-- Format Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Format</label>
                    <select name="format" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Format --</option>
                        <option value="Video" {{ request('format') == 'Video' ? 'selected' : '' }}>Video</option>
                        <option value="Text-based" {{ request('format') == 'Text-based' ? 'selected' : '' }}>Text-based</option>
                        <option value="Interactive/Live" {{ request('format') == 'Interactive/Live' ? 'selected' : '' }}>Interactive/Live</option>
                    </select>
                </div>

                <!-- Certification Filter -->
                <div>
                    <label class="block text-sm font-bold mb-2">Certification</label>
                    <select name="certification" class="w-full border-gray-300 rounded">
                        <option value="">-- Select Certification --</option>
                        <option value="1" {{ request('certification') == '1' ? 'selected' : '' }}>Certification Available</option>
                        <option value="0" {{ request('certification') == '0' ? 'selected' : '' }}>No Certification</option>
                    </select>
                </div>
                
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Apply Filters
                </button>
                <a href="{{ route('courses.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">
                    Clear Filters
                </a>
            </div>
        </form>

        <!-- Course List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($courses as $course)
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="font-bold text-lg">{{ $course->title }}</h2>
                    <p>{{ $course->description }}</p>
                    <p class="text-green-600 font-semibold">£{{ $course->price }}</p>
                    <p><strong>Category:</strong> {{ $course->category }}</p>
                    <p><strong>Rate:</strong> {{ $course->rating }}</p>
                    <p><strong>Difficulty Level:</strong> {{ $course->difficulty }}</p>
                    <p><strong>Duration:</strong> {{ $course->duration }}</p>
                    <p><strong>Certification:</strong> {{ $course->certification }}</p>
                    <p><strong>Popularity:</strong> {{ $course->popularity }}</p>
                    <p><strong>Instructor:</strong> {{ $course->instructor }}</p>
                </div>
            @empty
                <div class="bg-white rounded h-64 col-span-full text-center">
                    <p class="mt-20 text-center p-5">No courses found for the selected filters.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
