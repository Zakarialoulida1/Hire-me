

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
<div id="cursusList"></div>
    <!-- Page Content -->
    <main>
        <form id="cvForm" class="p-6 border rounded-md transition duration-300 ease-in-out border-gray-300 hover:border-blue-500">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                    <input type="text" id="degree" name="degree" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Bachelor's Degree" required>
                </div>
                <div>
                    <label for="institution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Institution</label>
                    <input type="text" id="institution" name="institution" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="University of Example" required>
                </div>
                <div>
                    <label for="start_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Year</label>
                    <input type="number" id="start_year" name="start_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="2020" required>
                </div>
                <div>
                    <label for="end_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Year</label>
                    <input type="number" id="end_year" name="end_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="2024">
                </div>
            </div>
            <button type="button" id="submitBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </main>
</div>
<!-- Include jQuery -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{asset('js/app.js')}}" ></script>

<script>

    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault();

            var formData = $('#cvForm').serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route("cv.store") }}',
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Refresh cursus list after successful submission
                    getCursusData();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });

        // Function to fetch cursus data via AJAX
        function getCursusData() {
            $.ajax({
                type: 'GET',
                url: '{{ route("getUserCursus") }}', // Update with your route
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Render cursus data in the HTML
                    renderCursusList(response);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }

        // Function to render cursus list in HTML
        function renderCursusList(cursusData) {
            var cursusListHTML = '<h2>Cursus List</h2><ul>';
            cursusData.forEach(function(cursus) {
                cursusListHTML += '<li>Degree: ' + cursus.degree + ', Institution: ' + cursus.institution + ', Start Year: ' + cursus.start_year + ', End Year: ' + cursus.end_year + '</li>';
            });
            cursusListHTML += '</ul>';
            $('#cursusList').html(cursusListHTML);
        }

        // Initial load of cursus data
        getCursusData();
    });
</script>

</body>
</html>


















