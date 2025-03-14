<x-layout>

    <section>
        <div>

            <main
                class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
            >
                <div class="max-w-xl lg:max-w-3xl">

                    <h1 class="text-center mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl dark:text-white">
                        Login
                    </h1>

                    <form action="/login" method="POST" class="mt-8 grid grid-cols-6 gap-6">
                        @csrf

                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Email
                            </label>

                            <input
                                type="email"
                                id="Email"
                                name="email"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-xs dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200"
                            />
                        </div>

                        <div class="col-span-6">
                            <label
                                for="Password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                id="Password"
                                name="password"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-xs dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200"
                            />
                        </div>

                        <div class="col-span-6">
                            <x-btn type="submit">Login</x-btn>
                            <x-error></x-error>
                        </div>


                        <div class="col-span-6">
                            <p class="mt-4 text-sm text-gray-500 sm:mt-0 dark:text-gray-400">
                                You dont have an account?
                                <a href="/register" class="text-gray-700 underline dark:text-gray-200">Register now</a>.
                            </p>
                        </div>

                    </form>
                </div>
            </main>
        </div>
    </section>

</x-layout>

