@foreach ($berita as $key)

    <div class=" overflow-hidden break-words bg-white shadow border border-solid border-blue-500 border-opacity-80 ">


        <h2 class="text-xl font-bold text-blue-900">
            {{ $key->name }}
        </h2>
        <p><img src="{{ asset('/images/' . $key->image) }}"
                class="custom-image" alt="">
        </p>        
        <p class="p-2 sm:p-8 text-gray-600">
            {{ $key->description }}
        </p>


    </div>
@endforeach