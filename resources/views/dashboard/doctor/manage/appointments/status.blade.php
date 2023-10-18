<x-doctor.layout>
    <x-doctor.content>
        <div class="wrapper">
            <x-splade-toggle>
                <div class="title">
                    Info
                </div>
                <div class="toggle">
                    <ul>
                        <li  @click.prevent="setToggle(false)">Patient</li>
                        <li  @click.prevent="setToggle(true)">Diagnosis</li>
                    </ul>
                </div>
                <x-splade-transition show="!toggled">
                </x-splade-transition>
                <x-splade-transition show="toggled">
                </x-splade-transition>

            </x-splade-toggle>

        </div>
    </x-doctor.content>

</x-doctor.layout>
