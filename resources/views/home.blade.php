<x-layout>
    <section class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
        <div class="mx-auto max-w-screen-xl flex justify-center">
            <div class="mx-auto max-w-3xl text-center">
                @guest
                    <h1 class="bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-4xl font-extrabold text-transparent sm:text-6xl">
                        Laravel 2FA Application
                    </h1>
                    <p class="mx-auto mt-4 max-w-xl text-lg sm:text-xl">
                        Secure your account with two-factor authentication.
                    </p>
                @endguest

                @auth
                    @if(!\App\Http\Controllers\TelegramController::isTwoFactorEnabled(Auth::user()->email))
                            <div class="border-2 rounded-md border-sky-500 p-6 text-center">
                                <div class="h-32 w-full flex justify-center">
                                    <img
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/512px-Telegram_logo.svg.png"
                                        alt="Telegram Logo"
                                        class="h-32 w-32 object-contain"
                                    />
                                </div>
                                <p class="mt-2 text-pretty text-white">
                                    To add more security please configure two-factor authentication!
                                </p>
                                <a href="/telegram" type="submit"
                                   class="mt-4 w-full text-center block rounded-md border border-sky-500 bg-sky-500 px-5 py-3 text-sm font-medium uppercase tracking-widest text-white transition-colors hover:bg-sky-400 hover:text-white">
                                    Enable 2FA
                                </a>
                            </div>
                    @else
                        <div class="flex justify-center">
                            <video class="rounded-lg shadow-lg" autoplay loop muted playsinline width="80%" height="auto">
                                <source src="https://www.unime.it/sites/default/files/2022-09/video%20sito%20nuovo%20%281%29.mp4" type="video/mp4">
                            </video>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </section>
</x-layout>
