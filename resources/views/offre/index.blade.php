
    <x-app-layout>
        <h1 class="text-center text-3xl">Offres</h1>

        <div class="ml-80 grid grid-cols-1">
            @foreach ($offres as $offre)

                <div class="border m-4 p-3 rounded w-[600px] bg-white relative">
                    <h1 class="font-bold text-xl mb-2">{{ $offre->titre }}</h1>

                    <p class="text-gray-700 mb-4">
                        {{ Str::limit($offre->description, 100) }}
                    </p>

                    <div class="m-1"><span class=" font-semibold text-bold">Skills : </span>
                        <p>{{ $offre->compétences_requises }}</p>
                    </div>

                    <div class="flex items-center mb-4">
                        <span class="mr-2 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                class="w-4 h-4 text-gray-600">
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
                @if (!(Auth()->user()->entreprise))


                    <div class="m-4 absolute bottom-0 right-0">
                        <button class="border rounded bg-green-400 p-2 postuler-btn" data-offre-id="{{ $offre->id }}">Postuler</button>
                    </div>
                   @endif

                    <a id="readmore" class="underline" role="button">
                     Read more
                    </a>
                </div>
            @endforeach

        </div>
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
        </script>
    </x-app-layout>


