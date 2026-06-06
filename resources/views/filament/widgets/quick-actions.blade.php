
<x-filament::section>

 <div class="desktop-layout">
<button class="button"onclick="window.location.href='{{ route('items.scan-camera') }}'">
            <p class="title">Scan QR</p>
            <img
              src="{{ asset('assets/qr.png') }}"
              alt="Handshake"
              class="img-widget"
            />
            <p class="description">Scan untuk lihat detail<br />Asset</p>
          </button>

          <!-- Button 2 -->
          <button class="button2"onclick="window.location.href='{{ route('filament.admin.resources.items.create') }}'">
            <p class="title">Tambah Asset</p>

            <img
             src="{{ asset('assets/add.png') }}"
              alt="Man"
              class="img-widget"
            />
            <p class="description">Tambah asset baru <br>ke sistem</p>
          </button>

          <!-- Button 3 -->
          <button class="button3"onclick="window.location.href='{{ route('filament.admin.resources.items.index') }}'">
            <p class="title">Daftar Asset</p>
            <img
             src="{{ asset('assets/list.png') }}"
              alt="Locked"
                class="img-widget"
            />
            <p class="description">Lihat dan kelola semua <br>  asset</p>
          </button>

</div>  

<div class="mobile-layout">
          <button class="button"onclick="window.location.href='{{ route('items.scan-camera') }}'">
            <p class="title">Scan QR</p>
            <img
              src="{{ asset('assets/qr.png') }}"
              alt="Handshake"
              class="img-widget"
            />
            <p class="description">Scan untuk lihat detail<br />Asset</p>
          </button>

          <!-- Button 2 -->
          <button class="button2"onclick="window.location.href='{{ route('filament.admin.resources.items.create') }}'">
            <p class="title">Tambah Asset</p>

            <img
             src="{{ asset('assets/add.png') }}"
              alt="Man"
              class="img-widget"
            />
            <p class="description">Tambah asset baru <br>ke sistem</p>
          </button>

          <!-- Button 3 -->
          <button class="button3"onclick="window.location.href='{{ route('filament.admin.resources.items.index') }}'">
            <p class="title">Daftar Asset</p>
            <img
             src="{{ asset('assets/list.png') }}"
              alt="Locked"
                class="img-widget"
            />
            <p class="description">Lihat dan kelola semua <br>  asset</p>
          </button>
        </div>
    <style>

      /* Desktop default */
.desktop-layout {
     display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:16px;
    width:100%;
}


.mobile-layout {
    display: none;
}

/* Mobile */
@media (max-width: 768px) {

    .desktop-layout {
        display: none;
    }

    .mobile-layout {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 100%;
    }

}
        .main-box {
  height: 100vh;
  display: flex;
  margin: auto;
}

.button,
.button2,
.button3 {
    width: 100%;
    min-height: 100px;
}

.button-box {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* Button 1 */
.button {
  height: 100px;
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
  margin-top: 1.6rem;width: 100%; /* Memastikan text-align: center bekerja di seluruh lebar elemen */
  text-align: center;
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