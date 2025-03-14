<x-layout>
    <div class="flex flex-col items-center mt-8">

        <div class="border-2 rounded-md border-sky-500 p-6">

            <div class="h-32 w-full flex justify-center">
                <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Telegram_logo.svg/512px-Telegram_logo.svg.png"
                    alt=""
                    class="h-32 w-32 object-contain"
                />
            </div>

                <p class="mt-2 text-pretty text-white">
                    To add more security please configure two factor authentication!
                </p>

                <a href="{{ $telegramLink }}" type="submit"
                    class="mt-4 w-full  text-center block rounded-md border border-sky-500 bg-sky-500 px-5 py-3 text-sm font-medium uppercase tracking-widest text-white transition-colors hover:bg-sky-400 hover:text-white"
                >
                    Connect
                </a>
            </div>
    </div>


</x-layout>

