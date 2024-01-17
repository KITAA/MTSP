<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendaftaran Ahli E-Khairat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (Route::currentRouteName() === 'membership.edit')
            <form action="{{ route('membership.update', $membership) }}" method="post">
                @csrf
                @method('put')
            @else
                <form action="{{ route('membership.confirmation') }}" method="post">
                    @csrf
                    @method('post')
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Maklumat Ahli') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Sila masukkan maklumat peribadi anda') }}
                    </p>

                    <div class="mt-6 space-y-6">

                        <div>
                            <x-input-label for="fullname" :value="__('Nama Penuh')" />
                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname"
                                :value="old('fullname') ?? ($membership['fullname'] ?? '')" :required="true" />
                            <x-input-error class="mt-2" :messages="$errors->get('fullname')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="Auth::user()->email" :readonly="true" />
                        </div>
                        <div>
                            <x-input-label for="ic" :value="__('NRIC')" />
                            <x-text-input id="ic" class="block mt-1 w-full" type="text" name="ic"
                                :value="old('ic') ?? ($membership['ic'] ?? '')" :required="true" placeholder="XXXXXX-XX-XXXX" />
                            <x-input-error class="mt-2" :messages="$errors->get('ic')" />
                        </div>
                        <div>
                            <x-input-label for="address" :value="__('Alamat')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                :value="old('address') ?? ($membership['address'] ?? '')" :required="true" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('No H/P')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone"
                                :value="old('phone') ?? ($membership['phone'] ?? '')" :required="true" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="emergency_no" :value="__('No Kecemasan')" />
                            <x-text-input id="emergency_no" class="block mt-1 w-full" type="tel" name="emergency_no"
                                :value="old('emergency_no') ?? ($membership['emergency_no'] ?? '')" :required="true" />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_no')" />
                        </div>
                    </div>
                </div>
            </div>

            <div id="tanggungan-container">
                <!-- Tanggungan will be  added here -->
            </div>

            <x-secondary-button id="add-tanggungan-btn" class="mt-4">
                {{ __('Tambah Tanggungan') }}
            </x-secondary-button>

            <x-primary-button class="mt-4" type="submit">
                @if (Route::currentRouteName() === 'membership.edit')
                    {{ __('Kemaskini') }}
                @else
                    {{ __('Hantar') }}
                @endif
            </x-primary-button>
        </div>

        </form>
    </div>


    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                let tanggunganIndex = 0;
                let existingTanggungans = <?= json_encode(old('tanggungans', []), JSON_HEX_TAG) ?>;
                let membershipTanggungans =
                    <?= json_encode($membership['tanggungan'] ?? ($tanggungans ?? []), JSON_HEX_TAG) ?>;


                function addTanggunganForm(tanggunganData) {
                    const tanggunganForm = `
                        <div class="tanggungan-form" id="tanggungan-${tanggunganIndex}">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-6 space-y-6">
                                <div class="max-w-xl">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        Tanggungan ${tanggunganIndex + 1}:
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Sila masukkan maklumat peribadi tanggungan anda') }}
                                    </p>
                                    
                                    <div class="mt-6 space-y-6">
                                        <div>
                                            <x-input-label for="tanggungans[${tanggunganIndex}][fullname]" :value="__('Nama Penuh')" />
                                            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="tanggungans[${tanggunganIndex}][fullname]"  :required="true" />
                                            <x-input-error class="mt-2" :messages="$errors->get('Nama Penuh')" />
                                        </div>

                                        <div>
                                            <x-input-label for="tanggungans[${tanggunganIndex}][ic]" :value="__('NRIC')" />
                                            <x-text-input id="ic" class="block mt-1 w-full" type="text" name="tanggungans[${tanggunganIndex}][ic]"  :required="true" placeholder="XXXXXX-XX-XXXX"/>
                                            <x-input-error class="mt-2" :messages="$errors->get('tanggungans.*.ic')" />
                                        </div>

                                        <div>
                                            <x-input-label for="tanggungans[${tanggunganIndex}][relationship]" :value="__('Relationship')" />
                                            <x-text-input id="relationship" class="block mt-1 w-full" type="text" name="tanggungans[${tanggunganIndex}][relationship]" :required="true" />
                                            <x-input-error class="mt-2" :messages="$errors->get('Relationship')" />
                                        </div>

                                        
                                        <x-danger-button class="mt-2 remove-tanggungan-btn" data-tanggungan-id="${tanggunganIndex}">
                                            {{ __('Remove') }}
                                        </x-secondary-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#tanggungan-container').append(tanggunganForm);

                    if (tanggunganData) {
                        $(`#tanggungan-${tanggunganIndex} [name="tanggungans[${tanggunganIndex}][fullname]"]`).val(
                            tanggunganData.fullname);
                        $(`#tanggungan-${tanggunganIndex} [name="tanggungans[${tanggunganIndex}][ic]"]`).val(
                            tanggunganData.ic);
                        $(`#tanggungan-${tanggunganIndex} [name="tanggungans[${tanggunganIndex}][relationship]"]`).val(
                            tanggunganData.relationship);
                    }

                    tanggunganIndex++;
                };

                existingTanggungans.forEach(function(tanggunganData) {
                    addTanggunganForm(tanggunganData);
                });


                membershipTanggungans.forEach(function(tanggunganData) {
                    addTanggunganForm(tanggunganData);
                });


                $(document).on('click', '#add-tanggungan-btn', function() {
                    addTanggunganForm();
                });

                $('#tanggungan-container').on('click', '.remove-tanggungan-btn', function() {
                    const tanggunganId = $(this).data('tanggungan-id');
                    $(`#tanggungan-${tanggunganId}`).remove();

                    $('.tanggungan-form').each(function(index) {
                        const newIndex = index;
                        $(this).attr('id', `tanggungan-${newIndex}`);
                        $(this).find('h2').text(`Tanggungan ${newIndex + 1}:`);
                        $(this).find('label').each(function() {
                            const oldName = $(this).attr('for');
                            const newName = oldName.replace(/\[(\d+)\]/, `[${newIndex}]`);
                            $(this).attr('for', newName);
                        });
                        $(this).find('input').each(function() {
                            const oldName = $(this).attr('name');
                            const newName = oldName.replace(/\[(\d+)\]/, `[${newIndex}]`);
                            $(this).attr('name', newName);
                        });
                        $(this).find('.remove-tanggungan-btn').data('tanggungan-id', newIndex);
                    });

                    tanggunganIndex--;
                });
            });
        </script>
    @endpush

</x-app-layout>
