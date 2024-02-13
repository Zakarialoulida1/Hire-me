<x-app-layout>
    <h1 class="text-center text-3xl">Companies</h1>

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



                <div class="m-4 absolute bottom-0 right-0">
                    <button class="border rounded bg-blue-400 p-2 postuler-btn" data-offre-id="">Subscribe</button>
                </div>


                <a id="readmore" class="underline" role="button">
                    Read more
                </a>
            </div>
        @endforeach
    </div>
    {{-- <script>
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
    </script> --}}


</x-app-layout>
