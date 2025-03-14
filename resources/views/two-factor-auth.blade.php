<x-layout>
    <h1>Insert your OTP code here</h1>
    <form action="/login/2fa" method="POST" class="mt-8 grid grid-cols-6 gap-6">
        @csrf

        <div class="col-span-6">
            <label for="Otp" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Otp
            </label>

            <input
                type="number"
                id="otp"
                name="otp"
                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-xs dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200"
            />

        </div>

        <div class="col-span-6">
            <button
                class="inline-block w-full shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:ring-3 focus:outline-hidden dark:hover:bg-blue-700 dark:hover:text-white"
            >
                Confirm
            </button>
            <x-error></x-error>
        </div>

    </form>
</x-layout>
