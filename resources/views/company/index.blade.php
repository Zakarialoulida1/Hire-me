<x-app-layout>
    <h1 class="text-center text-3xl">Companies</h1>
    <div id="companies">


        <div class=" flex items-center flex-wrap justify-center">

            @foreach ($entreprises as $entreprise)
                <div class="border m-4 p-3 rounded w-[45vw] bg-white relative">

                    <div class="relative">
                        <img src="{{ asset('storage/' . $entreprise->logo) }}" alt="Logo">



                        <img class="absolute -bottom-8 left-4 w-12 h-12 md:w-24 md:h-24 rounded-full "
                            src="{{ asset('storage/' . $entreprise->user->image) }}" alt="Logo">

                    </div>
                    <div class="flex items-center justify-center   ">
                        <i class="fas fa-user"></i>

                        <h1 class="text-center ml-2 font-medium">: {{ $entreprise->user->name }}</h1>
                    </div>
                    <div class="mt-8">

                        <h1 class="text-center font-bold">{{ $entreprise->nom }}</h1>
                        <p>({{ $entreprise->slogan }})</p>
                        <p>{{ $entreprise->description }}</p>
                    </div>
                    <div class=""><span class="font-semibold text-bold">Contact: </span>


                        <div class="flex items-center mb-4">
                            <span class="mr-2 flex-shrink-0">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <div>

                                <p class="text-gray-700 ml-2">{{ $entreprise->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-12">


                    <form action="{{ route('subscribe') }}" method="post">
                        @csrf
                        <button type="submit">Subscribe</button>
                        <input type="hidden" id="email" name="email" value="{{ Auth()->user()->email ?? '' }}"><br>
                    </form>
                   


                    <a id="readmore" class="underline" role="button">
                        Read more
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div id="search-results-container-company">

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#searchCompanies').on('input', function() {
                const query = $(this).val().trim();

                if (query.length > 0) {
                    $('#companies').hide();
                    $('#search-results-container-company').show();
                    $.ajax({
                        url: '{{ route('search.companies') }}',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            console.log(data);
                            displaySearchResults(data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                } else {
                    // If the search query is empty, clear the search results container
                    $('#search-results-container-company').empty();
                    $('#companies').show();
                    $('#search-results-container-company').hide();
                }
            });

            function displaySearchResults(data) {
                const searchResultsContainer = $('#search-results-container-company');
                searchResultsContainer.empty(); // Clear previous search results

                // Iterate through the search results and append cards to the container
                $.each(data, function(index, company) {
                    const companyCard = `
                        <div class="border m-4 p-3 rounded w-[45vw] bg-white relative">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $entreprise->logo) }}" alt="Logo">
                                <img class="absolute -bottom-8 left-4 w-12 h-12 md:w-24 md:h-24 rounded-full "
                                    src="{{ asset('storage/' . $entreprise->user->image) }}" alt="Logo">
                            </div>
                            <div class="flex items-center justify-center">
                                <i class="fas fa-user"></i>
                                <h1 class="text-center ml-2 font-medium">: ${company.user.name}</h1>
                            </div>
                            <div class="mt-8">
                                <h1 class="text-center font-bold">${company.nom}</h1>
                                <p>(${company.slogan})</p>
                                <p>${company.description}</p>
                            </div>
                            <div class="">
                                <span class="font-semibold text-bold">Contact: </span>
                                <div class="flex items-center mb-4">
                                    <span class="mr-2 flex-shrink-0">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <div>
                                        <p class="text-gray-700 ml-2">${company.user.email}</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-12">
                            <div class="m-4 absolute bottom-0 right-0">
                                <button class="border rounded bg-blue-400 p-2 postuler-btn" data-offre-id="">Subscribe</button>
                            </div>
                            <a id="readmore" class="underline" role="button">Read more</a>
                        </div>
                    `;

                    searchResultsContainer.append(companyCard);
                });
            }
        });
    </script>


</x-app-layout>
