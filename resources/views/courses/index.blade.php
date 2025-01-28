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
        
        <!-- Search Form -->
        <form method="GET" action="/courses" class="mb-6">
            <input
                type="text"
                name="keyword"
                placeholder="Search courses..."
                class="border p-2 w-full"
                value="{{ request('keyword') }}"
            />
            <button type="submit" class="bg-blue-500 text-white p-2 mt-2">Search</button>
        </form>

        <!-- Course List -->
        @if(count($courses)>0)
        <div class="grid grid-cols-3 gap-4">
            @foreach ($courses as $course)
                <div class="bg-white p-4 shadow rounded">
                    <h2 class="font-bold text-lg">{{ $course->title }}</h2>
                    <p>{{ $course->description }}</p>
                    <p class="text-green-600 font-semibold">£{{ $course->price }}</p>
                    <p>Instructor: {{ $course->instructor }}</p>
                    <p>Category: {{ $course->category }}</p>
                    <p>Difficulty: {{ $course->difficulty }}</p>
                </div>
            @endforeach
            
        </div>
        @else
            <div class="bg-white p-4 shadow rounded h-64">
                <h3 align="center" class="items-center mt-20">Oops! Data Not Found!!</h3>
            </div>
        @endif
    </div>
</body>
</html>
