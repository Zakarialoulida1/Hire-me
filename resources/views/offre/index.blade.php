<x-app-layout>
    <h1 class="text-center text-3xl">Offres</h1>
    <div id="job-offers">
        <div class="flex items-center justify-center flex-wrap">
            @foreach ($offresNotPostulated as $offre)
                <div class="border m-4 p-3 rounded w-[600px] bg-white relative">
                    <h1 class="font-bold text-xl mb-2">{{ $offre->titre }}</h1>
                    <p class="text-gray-700 mb-4">{{ Str::limit($offre->description, 100) }}</p>
                    <div class="m-1"><span class="font-semibold text-bold">Skills : </span>
                        <p>{{ $offre->compétences_requises }}</p>
                    </div>
                    <div class="flex items-center mb-4">
                        <span class="mr-2 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-4 h-4 text-gray-600">
                                <path
                                    d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-gray-700 ml-2">{{ $offre->emplacement }}</p>
                        </div>
                    </div>
                    <div class="m-1"><span class="font-semibold text-bold">Contract type : </span>
                        <p>{{ $offre->type_contrat }}</p>
                    </div>

                    <hr class="mb-12">
                    <div class="m-4 absolute bottom-0 right-0">
                        <div class="flex gap-4">
                            <button class="border rounded bg-green-400 p-2 postuler-btn"
                                data-offre-id="{{ $offre->id }}">Postuler</button>
                            <form action="{{ route('offers.delete', $offre->id) }}" method="post">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="border rounded bg-red-400 p-2 ">Supprimer</button>
                            </form>
                        </div>
                    </div>
                    <a id="readmore" class="underline" role="button">Read more</a>
                </div>
            @endforeach

            @foreach ($offresPostulated as $offre)
                <div class="border m-4 p-3 rounded w-[600px] bg-white relative">
                    <h1 class="font-bold text-xl mb-2">{{ $offre->titre }}</h1>
                    <p class="text-gray-700 mb-4">{{ Str::limit($offre->description, 100) }}</p>
                    <div class="m-1"><span class="font-semibold text-bold">Skills : </span>
                        <p>{{ $offre->compétences_requises }}</p>
                    </div>
                    <div class="flex items-center mb-4">
                        <span class="mr-2 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-4 h-4 text-gray-600">
                                <path
                                    d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-gray-700 ml-2">{{ $offre->emplacement }}</p>
                        </div>
                    </div>
                    <div class="m-1"><span class="font-semibold text-bold">Contract type : </span>
                        <p>{{ $offre->type_contrat }}</p>
                    </div>
                    <hr class="mb-12">
                    <div class="m-4 absolute bottom-0 right-0">
                        <button class="border rounded bg-gray-400 p-2" disabled>Déjà postulée</button>
                    </div>
                    <a id="readmore" class="underline" role="button">Read more</a>
                </div>
            @endforeach
        </div>


    </div>

    <div id="search-results-container" class="flex items-center justify-center flex-wrap" style="display: none;">
        <!-- Search results will be displayed here -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Écoute les clics sur les boutons "Postuler"
        document.querySelectorAll('.postuler-btn').forEach(button => {
            button.addEventListener('click', function() {
                const offreId = this.getAttribute('data-offre-id');
                postuler(offreId);
            });
        });

        function postuler(offreId) {
            // You can use either route parameter or query parameter depending on your route definition
            const url = "{{ route('postuler', ':offreId') }}".replace(':offreId', offreId);

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Postulée!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error) {
                    // Gérer les erreurs de la demande Ajax si nécessaire
                    console.error(error);
                }
            });
        }




        $(document).ready(function() {
            $('#searchOffers').on('input', function() {
                const query = $(this).val().trim();

                if (query.length > 0) {
                    $('#job-offers').hide();
                    $('#search-results-container').show();
                    $.ajax({
                        url: '{{ route('offers.search') }}',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {
                            displaySearchResults(data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                } else {
                    // If the search query is empty, clear the search results container
                    $('#search-results-container').empty();
                    $('#job-offers').show();
                    $('#search-results-container').hide();
                }
            });

            function displaySearchResults(data) {
                const searchResultsContainer = $('#search-results-container');
                searchResultsContainer.empty(); // Clear previous search results

                // Iterate through the search results and append cards to the container
                $.each(data, function(index, offer) {
                    const offerCard = `
                        <div class="border m-4 p-3 rounded w-[600px] bg-white relative">
                            <h1 class="font-bold text-xl mb-2">${offer.titre}</h1>
                            <p class="text-gray-700 mb-4">${offer.description}</p>
                            <div class="m-1"><span class="font-semibold text-bold">Skills : </span>
                                <p>${offer.compétences_requises}</p>
                            </div>
                            <div class="flex items-center mb-4">
                                <span class="mr-2 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-4 h-4 text-gray-600">
                                        <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-gray-700 ml-2">${offer.emplacement}</p>
                                </div>
                            </div>
                            <div class="m-1"><span class="font-semibold text-bold">Contract type : </span>
                                <p>${offer.type_contrat}</p>
                            </div>
                            <hr class="mb-12">
                            <div class="m-4 absolute bottom-0 right-0">
                                <div class="flex gap-4" >
                                <button class="border rounded bg-green-400 p-2 postuler-btn" data-offre-id="${offer.id}">Postuler</button>
                                <form action="/offers/${offer.id}" method="post">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="border rounded bg-red-400 p-2 ">Supprimer</button>
                            </form>
                            </div> 
                            </div>
                            <a id="readmore" class="underline" role="button">Read more</a>
                        </div>
                    `;

                    searchResultsContainer.append(offerCard);
                });
            }
        });
    </script>

</x-app-layout>
