<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hubungi Kami') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class=" flex w-full  ">
                        <div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3322737658095!2d103.61486207477795!3d1.5638343984215708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da7763fa335ce9%3A0x573ab0dbfb48b092!2sMasjid%20Taman%20Sri%20Pulai!5e0!3m2!1sen!2smy!4v1705414458592!5m2!1sen!2smy"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>


                        <div class="m-6 space-y-6  w-full">
                            <form action="{{ route('contact.submit') }}" method="get">
                                @csrf
                                @method('get') {{-- Method Spoofing for POST request --}}
                                
                                <div>
                                    <x-input-label for="name" :value="__('Nama')" />
                                    <x-text-input id="name" class="block mt-2 mb-2 w-full" type="text" name="name" :required="true" />
                                </div>
                                
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-2 mb-2 w-full" type="email" name="email" :value="optional(Auth::user())->email" />
                                </div>
                                
                                <div>
                                    <x-input-label for="message" :value="__('Mesej')" />
                                    <textarea id="message" name="message" rows="4" class="mt-2 mb-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tulis mesej di sini..." style="min-height: 150px;"></textarea>
                                </div>
                                
                                <div class="mt-4">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 disabled:opacity-25 transition w-full">
                                        {{ __('Hantar') }}
                                    </button>
                                </div>
                            </form>
                            
                        </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

    </x-slot>
</x-app-layout>

{{-- @component('mail::message')
# Contact Form Submission

You've received a new contact form submission:

**Name:** {{ $data['fullname'] }}
**Email:** {{ $data['email'] }}
**Message:**
{{ $data['message'] }}

Thank you,
Your Website
@endcomponent --}}
