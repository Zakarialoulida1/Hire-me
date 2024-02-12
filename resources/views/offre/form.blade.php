<x-app-layout>

    <!-- Place this at the end of your Blade view -->
    @if (session('success'))
        <script>
            window.onload = function() {
                alert("{{ session('success') }}");
            };
        </script>
    @endif

    <form method="post" class="max-w-md mx-auto" action="{{ route('store.offre') }}">
        @csrf
        <h1 class="text-center text-bold mb-12">Create Your Job Offer</h1>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="titre" id="titre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" placeholder=" " required />
            <label for="titre" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Job Title</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <textarea name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" placeholder=" " required></textarea>
            <label for="description" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Job Description</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <textarea name="compétences_requises" id="compétences_requises" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" placeholder=" " required></textarea>
            <label for="compétences_requises" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Required Skills</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <select name="type_contrat" id="type_contrat" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" required>
                <option value="" disabled selected>Select Contract Type</option>
                <option value="à distance">Remote</option>
                <option value="hybride">Hybrid</option>
                <option value="à temps plein">Full-time</option>
            </select>
            <label for="type_contrat" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Contract Type</label>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="emplacement" id="emplacement" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" placeholder=" " required />
            <label for="emplacement" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0]">Location</label>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-500">Submit</button>
    </form>

</x-app-layout>
