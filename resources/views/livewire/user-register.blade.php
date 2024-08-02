<main class="flex min-h-full mt-10 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register your
            account</h2>
    </div>
    <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
        <form wire:submit="register" class="mt-10 space-y-6">
            <div class="mt-6">
                <label for="name" class="block text-sm/relaxed font-medium leading-6 text-gray-900">Name</label>
                <input type="text" class="border border-gray-400 rounded-lg p-2 w-full" wire:model="name">
                <div>
                    @error('name') <span class="error text-red-500 mt-2 text-xs/relaxed">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="email" class="block text-sm/relaxed font-medium leading-6 text-gray-900">Email</label>
                <input type="email" class="border border-gray-400 rounded-lg p-2 w-full" wire:model="email">
                <div>
                    @error('email') <span class="error text-red-500 mt-2 text-xs/relaxed">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="password" class="block text-sm/relaxed font-medium leading-6 text-gray-900">Password</label>
                <input type="password" class="border border-gray-400 rounded-lg p-2 w-full" wire:model="password">
                <div>
                    @error('password') <span class="error text-red-500 mt-2 text-xs/relaxed">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm
                font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline
                focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign up</button>
            </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
            Already Registered?
            <a href="{{ route('login') }}" class="font-semibold leading-6 text-indigo-600
            hover:text-indigo-500">Sign in</a>
        </p>
    </div>
</main>
