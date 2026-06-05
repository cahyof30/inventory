{{-- <x-filament::section>

    <div class="flex flex-col gap-4">

        <a href="{{ route('items.scan-camera') }}"
            class="group overflow-hidden rounded-2xl bg-[#0d6efd] text-white shadow-md transition-transform active:scale-[0.98]">

            <div class="flex items-center gap-4 px-5 py-5">

                <div
                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/20">

                    <x-heroicon-o-qr-code class="h-9 w-9 text-white" />

                </div>

                <div class="min-w-0 flex-1">

                    <h3 class="text-xl font-extrabold tracking-tight text-white">
                        Scan QR Asset
                    </h3>

                    <p class="mt-0.5 text-sm font-medium text-white/75">
                        Scan kode QR untuk melihat detail asset
                    </p>

                </div>

                <x-heroicon-o-chevron-right
                    class="h-6 w-6 shrink-0 text-white/80 transition-transform group-hover:translate-x-1" />

            </div>

        </a>

        <a href="{{ route('filament.admin.resources.items.create') }}"
            class="group overflow-hidden rounded-2xl bg-[#22c55e] text-white shadow-md transition-transform active:scale-[0.98]">

            <div class="flex items-center gap-4 px-5 py-5">

                <div
                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/20">

                    <x-heroicon-o-plus class="h-9 w-9 text-white" />

                </div>

                <div class="min-w-0 flex-1">

                    <h3 class="text-xl font-extrabold tracking-tight text-white">
                        Tambah Asset
                    </h3>

                    <p class="mt-0.5 text-sm font-medium text-white/75">
                        Tambah asset baru ke sistem
                    </p>

                </div>

                <x-heroicon-o-chevron-right
                    class="h-6 w-6 shrink-0 text-white/80 transition-transform group-hover:translate-x-1" />

            </div>

        </a>

        <a href="{{ route('filament.admin.resources.items.index') }}"
            class="group overflow-hidden rounded-2xl bg-[#7c3aed] text-white shadow-md transition-transform active:scale-[0.98]">

            <div class="flex items-center gap-4 px-5 py-5">

                <div
                    class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white/20">

                    <x-heroicon-o-cube class="h-9 w-9 text-white" />

                </div>

                <div class="min-w-0 flex-1">

                    <h3 class="text-xl font-extrabold tracking-tight text-white">
                        Daftar Asset
                    </h3>

                    <p class="mt-0.5 text-sm font-medium text-white/75">
                        Lihat dan kelola semua asset
                    </p>

                </div>

                <x-heroicon-o-chevron-right
                    class="h-6 w-6 shrink-0 text-white/80 transition-transform group-hover:translate-x-1" />

            </div>

        </a>

    </div>

</x-filament::section> --}}
<x-filament::section>
        <div class="button-box container">
          <button class="button">
            <p class="title">Scan QR</p>
            <img
              src="{{ asset('assets/qr.png') }}"
              alt="Handshake"
              class="img-widget"
            />
            <p class="description">Scan untuk lihat detail<br />Asset</p>
          </button>

          <!-- Button 2 -->
          <button class="button2">
            <p class="title">Tambah Asset</p>

            <img
             src="{{ asset('assets/add.png') }}"
              alt="Man"
              class="img-widget"
            />
            <p class="description">Tambah asset baru <br>ke sistem</p>
          </button>

          <!-- Button 3 -->
          <button class="button3">
            <p class="title">Daftar Asset</p>
            <img
              src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Objects/Locked.png"
              alt="Locked"
                class="img-widget"
            />
            <p class="description">Lihat dan kelola <br> semua asset</p>
          </button>
        </div>

    <style>
        .main-box {
  height: 100vh;
  display: flex;
  margin: auto;
}

.button-box {
  height: 500px;
  max-width: 500px;
  align-items: center;
  justify-content: center;
  margin: auto;
  display: grid;
}

/* Button 1 */
.button {
  height: 100px;
  width: 500px;
  display: flex;
  border-radius: 2.5rem;
  transition: 0.5s;
  font-family: "Montserrat", sans-serif;
  font-size: 2rem;
  background-color: #5a5aeb;
  color: white;
  animation: blurr 2s;
  animation-iteration-count: infinite;
  outline: none;
  cursor: pointer;
  border: none;
}

.img-widget {
  margin-left: auto;
  margin-top: 0.7rem;
  margin-right: 1.5rem;
  transition: 0.5s;
  width: 5rem;
  height: 5rem;
}

@keyframes blurr {
  0%,
  100% {
    box-shadow: 0 0 10px var(--handshake);
  }

  50% {
    box-shadow: 0 0 36px var(--handshake);
  }
}

@keyframes fade {
  0% {
    opacity: 100%;
  }
  100% {
    opacity: 0%;
  }
}

.title {
  font-weight: bold;
  margin-top: 1.6rem;
  margin-left: 10rem;
  transition: 0.5s;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.button:hover .title {
  transform: translateX(-140px);
  animation: fade 0.5s;
  opacity: 0%;
}

.button:hover img {
  transform: translateX(-370px);
}

.description {
  position: absolute;
  margin-top: 1.4rem;
  font-weight: bold;
  line-height: 2rem;
  font-size: 2rem;
  font-style: italic;
  transition: 0.5s;
  opacity: 0%;
  margin-left:3.5rem;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.button:hover .description {
  transform: translateX(70px);
  opacity: 100%;
}

/* Button 2 */
.button2 {
  height: 100px;
  width: 500px;
  display: flex;
  border-radius: 2.5rem;
  transition: 0.5s;
  font-family: "Montserrat", sans-serif;
  font-size: 2rem;
  background-image: linear-gradient(
    to right top,
    #00e9d8,
    #1eebd2,
    #31eecb,
    #42f0c4,
    #51f2bc,
    #5ff3b5,
    #6cf5af,
    #79f6a8,
    #88f7a0,
    #96f899,
    #a4f992,
    #b2f98b
  );
  color: white;
  animation: blurr2 2s;
  animation-iteration-count: infinite;
  outline: none;
  cursor: pointer;
  border: none;
}

.button2:hover .title {
  transform: translateX(-140px);
  animation: fade 0.5s;
  opacity: 0%;
}

.button2:hover img {
  transform: translateX(-370px);
}

.button2:hover .description {
  transform: translateX(70px);
  opacity: 100%;
}

@keyframes blurr2 {
  0%,
  100% {
    box-shadow: 0 0 10px var(--btn2);
  }

  50% {
    box-shadow: 0 0 36px var(--btn2);
  }
}

/* Button 3 */
.button3 {
  height: 100px;
  width: 500px;
  display: flex;
  border-radius: 2.5rem;
  transition: 0.5s;
  font-family: "Montserrat", sans-serif;
  font-size: 2rem;
  background-image: linear-gradient(
    to right top,
    #ffb4be,
    #ffb5b6,
    #ffb7ad,
    #ffbaa5,
    #ffbd9e,
    #ffc098,
    #ffc492,
    #ffc88d,
    #ffcd87,
    #ffd281,
    #ffd77b,
    #ffdd76
  );
  animation: blurr3 2s;
  animation-iteration-count: infinite;
  outline: none;
  cursor: pointer;
  border: none;
}

.button3:hover .title {
  transform: translateX(-140px);
  animation: fade 0.5s;
  opacity: 0%;
}

.button3:hover img {
  transform: translateX(-370px);
}

.button3:hover .description {
  transform: translateX(70px);
  opacity: 100%;
}

@keyframes blurr3 {
  0%,
  100% {
    box-shadow: 0 0 10px var(--btn3);
  }

  50% {
    box-shadow: 0 0 36px var(--btn3);
  }
}

.watermark {
  text-align: center;
  color: white;
}

.watermark a {
  color: #8081cf;
}
        </style>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</x-filament::section>