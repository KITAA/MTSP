<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Berita') }}
        </h2>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

        <style type="text/css">

            .ck-editor__editable_inline {
                min-height: 300px;
            }

        </style>
            
    </x-slot>

    <div class="py-12">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <div class="max-w-xl">

                        <div class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="image" :value="__('Gambar')" />
                                <input type="file" name="image" 
                                    class="block mt-1 w-full border border-solid border-black border-opacity-80">
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Tajuk Berita')" />
                                <input type="text" name="name" class="block mt-1 w-full" value="{{ old('name') }}" required="true">
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Penerangan')" />
                                <textarea id="editor" rows="4" class="block mt-1 w-full ck-editor__editable_inline" name="description" style="min-height: 300px;">{{ old('description') }}</textarea>
                              </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'),
                
                {
                    ckfinder:
                    {
                        uploadUrl:"{{route('berita.store', ['_token' => csrf_token() ])}}",
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script>

    </div>
</x-app-layout>
