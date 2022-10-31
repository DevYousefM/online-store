<div name="header">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 shadow lg:px-8 flex justify-between ">
        <div class="flex">
            <h2 class="font-semibold text-xl mr-2 text-gray-800 leading-tight">
                <a href="{{ route('profile.show') }}" style="border-bottom:2px solid black;">
                    {{ __('Profile') }}
                </a>
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="{{ route('home.orders') }}" style="border-bottom:2px solid black;">
                    {{ __('Orders') }}
                </a>
            </h2>
        </div>
        <x-app-layout>

        </x-app-layout>
    </div>
</div>
