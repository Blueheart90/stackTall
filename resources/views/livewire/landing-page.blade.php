<div>
    <div
        class="flex flex-col h-screen bg-indigo-900"
        x-data="{
            showSubscribe: @entangle('showSubscribe'),
            showSuccess: @entangle('showSuccess'),
        }"
        >
        <nav class="container flex justify-between pt-5 mx-auto text-indigo-200">
            <a href="/" class="text-4xl font-bold">
                <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
            </a>
            <div class="flex justify-end ">
                @auth
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                @endauth
            </div>
        </nav>
        <div class="container flex items-center h-full mx-auto ">
            <div class="flex flex-col items-start w-1/3 ">
                <h1 class="mb-4 text-5xl font-bold text-white list-decimal ">Simple generic landing page to subscribe</h1>
                <p class="mb-10 text-xl text-indigo-200 ">Lorem, ipsum dolor sit amet consectetur adipisicing elit. <span class="font-bold underline ">Dolorem</span>, quaerat?</p>
                <x-button @click="showSubscribe = true" class="px-8 py-3 bg-red-500 hover:bg-red-600">Subscribe</x-button>

            </div>
        </div>
        <x-modal trigger="showSubscribe" color="pink">
            <p class="text-5xl font-extrabold text-center text-white ">Let's do it!</p>
            <form
                class="flex flex-col items-center p-24"
                wire:submit.prevent="subscribe"
                novalidate
                >
                <x-input
                    class="px-5 py-3 border border-blue-400 w-80"
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    wire:model.defer='email'
                    >
                </x-input>
                <span class="pt-1 text-xs text-gray-100 ">
                    {{
                        $errors->has('email')
                        ? $errors->first('email')
                        : 'We will send you a confirmation email.'
                    }}
                </span>
                <x-button class="justify-center px-5 py-3 mt-5 bg-blue-500 w-80 hover:bg-blue-600">
                    <span
                        class="animate-spin"
                        wire:loading
                        wire:target="subscribe"
                        >
                        &#9696;
                    </span>
                    <span wire:loading.remove wire:target="subscribe">Get In</span>
                </x-button>
            </form>
        </x-modal>

        {{-- Modal Success --}}
        <x-modal trigger="showSuccess" color="green">
            <p class="font-extrabold text-center text-white text-9xl animate-pulse">
                &check;
            </p>
            <p class="mt-16 text-5xl font-extrabold text-center text-white">
                Great!
            </p>
            @if (request()->has('verified') && request()->verified == 1)
                <p class="text-3xl text-white">
                    Thanks for confirm your email address.
                </p>
            @else
                <p class="text-3xl text-white">
                    See you in your inbox
                </p>
            @endif
        </x-modal>
    </div>
</div>
