        <section
            class="relative h-72 bg-blue-500 flex flex-col justify-center align-center text-center space-y-4 mb-4"
        >
            <div
                class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
                style="background-image: url('images/laravel-logo.png')"
            ></div>

            <div class="z-10">
                <h1 class="text-6xl font-bold uppercase text-white">
                    Mero<span class="text-black">Job</span>
                </h1>
                <p class="text-2xl text-black-200 font-bold my-4">
                    Find or post JOBS
                </p>
                <div>
                    @guest
                    <a
                        href="/register"
                        class="inline-block border-2 border-white text-black py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
                        >Sign Up to List a JOBS</a>
                        @endguest
                </div>
            </div>
        </section>