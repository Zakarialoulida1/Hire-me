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
    <link rel="stylesheet" href="<?php echo asset('css/app.css'); ?>" type="text/css">

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

        
        <a href="{{ route('cv') }}">view PDF</a>
        <div id="cursusList" class="m-4 w-full"></div>
        <!-- Page Content -->
        <main>
            <form id="cvForm"
                class="m-4 p-6 border rounded-md bg-gray-300 transition duration-300 ease-in-out border-gray-300 hover:border-blue-500">
                @csrf
                <h1 class="text-black   font-bold rounded-lg text-center m-4">+ ADD CURSUS </h1>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="degree"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                        <input type="text" id="degree" name="degree"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Bachelor's Degree" required>
                    </div>
                    <div>
                        <label for="institution"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Institution</label>
                        <input type="text" id="institution" name="institution"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="University of Example" required>
                    </div>
                    <div>
                        <label for="start_year"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Year</label>
                        <input type="number" id="start_year" name="start_year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="2020" required>
                    </div>
                    <div>
                        <label for="end_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                            Year</label>
                        <input type="number" id="end_year" name="end_year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="2024">
                    </div>
                </div>
                <button type="button" id="submitBtn"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </main>
    </div>


    <div id="experienceList" class="m-4 w-full"></div>
    <form id="experienceForm"
        class="m-4 p-6 border bg-gray-300 rounded-md transition duration-300 ease-in-out border-gray-300 hover:border-blue-500">
        @csrf

        <h1 class="text-black   font-bold rounded-lg text-center m-4">+ ADD Experience </h1>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="position"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                <input type="text" id="position" name="position"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Software Engineer" required>
            </div>
            <div>
                <label for="company"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                <input type="text" id="company" name="company"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="ABC Inc." required>
            </div>
            <div>
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                    Date</label>
                <input type="date" id="start_date" name="start_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
            </div>
            <div>
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                    Date</label>
                <input type="date" id="end_date" name="end_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </div>
        <button type="button" id="submitExperienceBtn"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>


    <div id="languageList" class=" m-4 w-full"></div>

    <form id="languageForm"
        class="m-4 p-6 border bg-gray-300 rounded-md transition duration-300 ease-in-out border-gray-300 hover:border-blue-500">
        @csrf

        <h1 class="text-black   font-bold rounded-lg text-center m-4">+ ADD Language </h1>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="language"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language</label>
                <input type="text" id="language" name="language"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="English" required>
            </div>
            <div>
                <label for="proficiency"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Proficiency</label>
                <select id="proficiency" name="proficiency"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                    <option value="Fluent">Fluent</option>
                </select>
            </div>
        </div>
        <button type="button" id="submitLanguageBtn"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
<div id="competenceList" class="m-4 w-full"></div>

    <form id="competenceForm"

    class="m-4 p-6 border bg-gray-300 rounded-md transition duration-300 ease-in-out border-gray-300 hover:border-blue-500">
      
        @csrf
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Competence
                Name</label>
            <input type="text" id="name" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Competence Name" required>
        </div>
        <button type="button" id="submitCompetenceBtn"
            class="text-white m-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function(e) {
                e.preventDefault();

                var formData = $('#cvForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('cv.store') }}',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        $('#cvForm')[0].reset();
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
                    url: '{{ route('getUserCursus') }}', // Update with your route
                    success: function(response) {
                        // Handle success response

                        // Render cursus data in the HTML
                        renderCursusList(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }


            // Initial load of cursus data
            getCursusData();



            function renderCursusList(cursusData) {
                var cursusListHTML =
                    '<h2 class="text-xl font-bold mb-4">Cursus List</h2><div class="border-t border-gray-300 dark:border-gray-600">';
                cursusData.forEach(function(cursus) {
                    cursusListHTML +=
                        '<div class="py-2 relative border-b border-gray-300 dark:border-gray-600">';
                    cursusListHTML += '<p><span class="font-semibold">Degree:</span> ' + cursus.degree +
                        '</p>';
                    cursusListHTML += '<p><span class="font-semibold">Institution:</span> ' + cursus
                        .institution + '</p>';
                    cursusListHTML += '<p><span class="font-semibold">Start Year:</span> ' + cursus
                        .start_year + '</p>';
                    cursusListHTML += '<p><span class="font-semibold">End Year:</span> ' + (cursus
                        .end_year ? cursus.end_year : 'Present') + '</p>';
                    cursusListHTML +=
                        '<button class="deleteCursusBtn bg-red-500 w-fit absolute bottom-0 right-0 m-4 text-white px-2 py-1 rounded  " data-id="' +
                        cursus.id + '">Delete</button>'; // Add delete button
                    cursusListHTML += '</div>';
                });
                cursusListHTML += '</div>';
                $('#cursusList').html(cursusListHTML);

                // Attach event listener to delete buttons
                $('.deleteCursusBtn').click(function() {

                    var cursusId = $(this).data('id'); // Get the cursus ID from the data attribute

                    console.log(cursusId);
                    deleteCursus(cursusId); // Call function to delete cursus
                });
            }

            // Function to delete cursus via AJAX
            function deleteCursus(cursusId) {
                $.ajax({
                    type: 'DELETE',

                    url: "{{ route('cursus.destroy', ['id' => ':cursusId']) }}".replace(':cursusId',
                        cursusId),

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);


                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Refresh cursus list after successful deletion
                        getCursusData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }



            $('#submitExperienceBtn').click(function(e) {
                e.preventDefault();

                var formData = $('#experienceForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('experience.store') }}',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Refresh experience list after successful submission
                        getExperienceData();
                        // Clear the form fields after submission
                        $('#experienceForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to fetch experience data via AJAX
            function getExperienceData() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('getUserExperience') }}',
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Render experience data in the HTML
                        renderExperienceList(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to render experience list in HTML
            function renderExperienceList(experienceData) {
                var experienceListHTML =
                    '<h2 class="text-xl font-bold mb-4">Experience List</h2><div class="border-t  border-gray-300 dark:border-gray-600">';
                experienceData.forEach(function(experience) {
                    experienceListHTML +=
                        '<div class="py-2 relative border-b border-gray-300 dark:border-gray-600">';
                    experienceListHTML += '<p><span class="font-semibold">Position:</span> ' + experience
                        .position + '</p>';
                    experienceListHTML += '<p><span class="font-semibold">Company:</span> ' + experience
                        .company + '</p>';
                    experienceListHTML += '<p><span class="font-semibold">Start Date:</span> ' + experience
                        .start_year + '</p>';
                    experienceListHTML += '<p><span class="font-semibold">End Date:</span> ' + (experience
                        .end_year ? experience.end_year : 'Present') + '</p>';
                    experienceListHTML +=
                        '<button class="deleteExperienceBtn bg-red-500 w-fit absolute bottom-0 right-0 m-4 text-white px-2 py-1 rounded" data-id="' +
                        experience.id + '">Delete</button>'; // Add delete button
                    experienceListHTML += '</div>';
                });
                experienceListHTML += '</div>';
                $('#experienceList').html(experienceListHTML);

                $('.deleteExperienceBtn').click(function() {
                    var experienceId = $(this).data('id'); // Get the experience ID from the data attribute
                    deleteExperience(experienceId); // Call function to delete experience
                });
            }
            // Function to delete experience via AJAX
            function deleteExperience(experienceId) {
                $.ajax({
                    type: 'DELETE',

                    url: '{{ route('experience.destroy', ':id') }}'.replace(':id', experienceId),

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Show SweetAlert for successful deletion
                        Swal.fire({
                            icon: 'success',
                            title: 'Experience deleted successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Refresh experience list after successful deletion
                        getExperienceData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        // Show SweetAlert for error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete experience. Please try again.',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            }


            // Initial load of experience data
            getExperienceData();

            $('#submitLanguageBtn').click(function(e) {
                e.preventDefault();

                var formData = $('#languageForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('language.store') }}',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Refresh language list after successful submission
                        getLanguageData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to fetch language data via AJAX
            function getLanguageData() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('getUserLanguage') }}',
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Render language data in the HTML
                        renderLanguageList(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to fetch language data via AJAX
            function getLanguageData() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('getUserLanguage') }}',
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Render language data in the HTML
                        renderLanguageList(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to render language list in HTML
            function renderLanguageList(languageData) {
                var languageListHTML =
                    '<h2 class="text-xl font-bold mb-4">Language List</h2><div class="border-t  border-gray-300 dark:border-gray-600">';
                languageData.forEach(function(language) {
                    languageListHTML +=
                        '<div class="py-2 relative border-b border-gray-300 dark:border-gray-600">';
                    languageListHTML += '<p><span class="font-semibold">Language:</span> ' + language
                        .language + '</p>';
                    languageListHTML += '<p><span class="font-semibold">Proficiency:</span> ' + language
                        .proficiency + '</p>';
                    languageListHTML +=
                        '<button class="deleteLanguageBtn bg-red-500 w-fit absolute bottom-0 right-0 m-4 text-white px-2 py-1 rounded" data-id="' +
                        language.id + '">Delete</button>'; // Add delete button

                    languageListHTML += '</div>';
                });
                languageListHTML += '</div>';
                $('#languageList').html(languageListHTML);


                $('.deleteLanguageBtn').click(function() {
                    console.log('fedsc');
                    var languageId = $(this).data('id'); // Get the language ID from the data attribute
                    deleteLanguage(languageId); // Call function to delete language
                });
            }

            getLanguageData();




            // Function to delete language via AJAX
            function deleteLanguage(languageId) {
                console.log(languageId);
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('language.destroy', ':languageId') }}".replace(
                        ':languageId', languageId),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Show SweetAlert for success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Refresh language list after successful deletion
                        getLanguageData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        // Show SweetAlert for error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText
                        });
                    }
                });
            }

            $('#submitCompetenceBtn').click(function(e) {
                e.preventDefault();

                var formData = $('#competenceForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('competence.store') }}',
                    data: formData,
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Refresh competence list after successful submission
                        getCompetenceData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to fetch competence data via AJAX
            function getCompetenceData() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('getUserCompetence') }}', // Update with your route
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Render competence data in the HTML
                        renderCompetenceList(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }
            getCompetenceData();

            // Function to delete competence via AJAX
            function deleteCompetence(competenceId) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route('competence.destroy', ':id') }}'.replace(':id', competenceId),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // Refresh competence list after successful deletion
                        getCompetenceData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            }

            // Function to render competence list in HTML
            function renderCompetenceList(competenceData) {
                var competenceListHTML =
                    '<h2 class="text-xl font-bold mb-4">Competence List</h2><div class="border-t border-gray-300 dark:border-gray-600">';
                competenceData.forEach(function(competence) {
                    competenceListHTML +=
                    '<div class="p-4 border-b relative border-gray-300 dark:border-gray-600">';
                    competenceListHTML += '<p><span class="font-semibold">Competence Name:</span> ' +
                        competence.name + '</p>';
                    competenceListHTML +=
                        '<button class="deleteCompetenceBtn absolute bottom-0 right-0 w-fit bg-red-500 text-white m-1 px-2 py-1 rounded" data-id="' +
                        competence.id + '">Delete</button>'; // Add delete button
                    competenceListHTML += '</div>';
                });
                competenceListHTML += '</div>';
                $('#competenceList').html(competenceListHTML);
            $('.deleteCompetenceBtn').click(function() {
    var competenceId = $(this).data('id'); // Get the competence ID from the data attribute
    deleteCompetence(competenceId); // Call function to delete competence
});
            
            }


// Function to delete competence via AJAX
function deleteCompetence(competenceId) {
    $.ajax({
        type: 'DELETE',
        url: '{{ route('competence.destroy', ':id') }}'.replace(':id', competenceId),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Handle success response
            console.log(response);
            // Refresh competence list after successful deletion
            getCompetenceData();
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error(xhr.responseText);
        }
    });
}




        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
