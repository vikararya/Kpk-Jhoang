@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

<!-- end header -->
<section class="relative px-4 py-16 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 lg:py-32">
  <div class="relative bg-black/30 rounded-3xl p-8 z-10">
    <div class="flex flex-col lg:flex-row lg:-mx-8">
      <div class="w-full lg:w-1/2 lg:px-8">
        <h2 class="text-3xl leading-tight font-bold text-white mt-4"
            style="text-shadow: 2px 2px 4px #000000;">
          Welcome to Kpk Jhoang Caffe and Eatery
        </h2>

        <p class="mt-8 leading-relaxed font-bold text-2xl text-gray-400">
  Website resmi kpk jhoang tambakboyo
</p>
      </div>
    </div>

    <!-- Gambar bunga matahari di pojok kanan bawah -->
    <img src="{{ asset('images/kpk2.png') }}"
         alt="Bunga Matahari"
         class="absolute -bottom-24 -right-16 w-32 h-48 object-contain z-20" />
  </div>
</section>
    <!-- start testimonials -->
      <!-- start testimonials -->
    <section class="relative bg-gray-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-16 lg:py-32">
      <div class="flex flex-col lg:flex-row lg:-mx-8">
        <div class="w-full lg:w-1/2 lg:px-8">
          <h2 class="text-3xl leading-tight font-bold mt-4">Tentang Kpk Jhoang</h2>
          <p class="mt-8 leading-relaxed font-bold text-gray-400">
          {{ $logo->deskripsi }}
        </p>
        </div>

        <div class="w-full md:max-w-md md:mx-auto lg:w-1/2 lg:px-8 mt-12 md:mt-0">
  @if($logo)
    <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo KPK Jhoang" class="w-full h-full object-cover rounded-lg">
  @else
    <div class="bg-gray-400 w-full h-72 rounded-lg"></div>
  @endif
</div>
      </div>
    </section>
    <!-- end testimonials -->
     <!-- start featured menus -->
<section class="bg-gray-100 py-20 -mt-20">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8"
        style="text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Menu Terbaru KPK Jhoang</h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 px-2 md:px-4 justify-center">
        @foreach($menus as $menu)
            <div class="bg-white rounded-xl overflow-hidden border  w-72 group mx-auto">
                <div class="overflow-hidden rounded-t-xl">
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                         class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-110">
                </div>
                <div class="p-3 text-center">
                    <h3 class="text-sm font-semibold text-gray-800">{{ $menu->name }}</h3>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Tombol Lihat Semua Menu -->
    <div class="mt-10 text-center">
        <a href="{{ url('/menu') }}"
           class="inline-block bg-white shadow-md  text-black font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">
            Lihat Semua Menu
        </a>
    </div>
</section>
   
    <!-- start blog -->
    <section class="relative  px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-20">
      <div class="">
        <h2 class="text-3xl text-white leading-tight font-bold">Lokasi Kpk Jhoang</h2>
        <p class="text-white mt-2 md:max-w-lg">Dusun Tawang rejo Desa Tambakboyo, Kecamatan tambakboyo</p>

        <a title="" class="inline-block text-teal-500 font-semibold mt-6 mt:md-0">Bisa diklik dibawah ini untuk detailnya</a>
      </div>                   <div class="w-full lg:w-1/2">
                <a href="https://maps.app.goo.gl/8GxdYCP74HK9s2QC6" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/maps.png') }}" alt="Lokasi KPK Jhoang"
                         class="w-80 rounded-xl h-72  transition duration-300">
                </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end blog -->
   <section class="bg-white py-16">
  <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-8">
    
    <!-- Gambar di kiri -->
    <div class="md:w-1/2">
      <img src="{{ asset('images/del.png') }}" alt="Delivery" class="w-full max-w-sm mx-auto">
    </div>

    <!-- Teks di kanan -->
    <div class="md:w-1/2 text-center md:text-left">
      <h2 class="text-2xl md:text-3xl font-bold mb-4">
        Ongkir murah <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full inline-block">start from 4000</span><br>
        Bisa diantar sampai rumah!
      </h2>
    </div>

  </div>
</section>
    <!-- start cta -->
    <section
      class=" px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-12 text-center md:text-left">
      <div class="md:flex md:items-center md:justify-center">
        <h2 class="text-xl font-bold bg-white text-black border border-gray-300 shadow-md px-4 py-2">Mau Lihat Pesananmu? Klik Cek Pesanan</h2>
        <a href="/orderan"
          class="px-8 py-4 bg-white text-blue-600 rounded border-gray-300 border inline-block font-semibold md:ml-8 mt-4 md:mt-0">Cek
          Pesanan</a>
      </div>
    </section>
    <!-- end cta -->

    <!-- start footer -->
    <footer class="relative bg-gray-900 text-white px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-12 lg:py-24">
      <div class="flex flex-col md:flex-row">
        <div class="w-full lg:w-2/6 lg:mx-4 lg:pr-8">
          <h3 class="font-bold text-2xl">Kpk Jhoang</h3>
          <p class="text-gray-400">Kedai Pojok Kampung yang menyediakan berbagai makanan yang khas, enak dan berbahan baku fresh</p>
          <form class="flex items-center mt-6">
            <div class="w-full">
              <div class="relative">
              </div>
            </div>
          </form>
        </div>

        <div class="w-full lg:w-2/6 mt-8 lg:mt-0 lg:mx-4 lg:pr-8">
          <h5 class="uppercase tracking-wider font-semibold text-gray-500">Contact Details</h5>
          <ul class="mt-4">
            <li>
              <a href="#" title="" class="block flex items-center opacity-75 hover:opacity-100">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                      d="M12,2C7.589,2,4,5.589,4,9.995C3.971,16.44,11.696,21.784,12,22c0,0,8.029-5.56,8-12C20,5.589,16.411,2,12,2z M12,14 c-2.21,0-4-1.79-4-4s1.79-4,4-4s4,1.79,4,4S14.21,14,12,14z" />
                  </svg>
                </span>
                <span class="ml-3">
                  Desa Tambakboyo, Kec. Tambakboyo
                </span>
              </a>
            </li>
            <li class="mt-4">
              <a href="#" title="" class="block flex items-center opacity-75 hover:opacity-100">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                      d="M12,2C6.486,2,2,6.486,2,12s4.486,10,10,10c5.514,0,10-4.486,10-10S17.514,2,12,2z M12,20c-4.411,0-8-3.589-8-8 s3.589-8,8-8s8,3.589,8,8S16.411,20,12,20z" />
                    <path d="M13 7L11 7 11 13 17 13 17 11 13 11z" /></svg>
                </span>
                <span class="ml-3">
                  Setiap Hari: 9:00 - 22:00<br>
                </span>
              </a>
            </li>
            <li class="mt-4">
              <a href="#" title="" class="block flex items-center opacity-75 hover:opacity-100">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                      d="M14.594,13.994l-1.66,1.66c-0.577-0.109-1.734-0.471-2.926-1.66c-1.193-1.193-1.553-2.354-1.661-2.926l1.661-1.66 l0.701-0.701L5.295,3.293L4.594,3.994l-1,1C3.42,5.168,3.316,5.398,3.303,5.643c-0.015,0.25-0.302,6.172,4.291,10.766 C11.6,20.414,16.618,20.707,18,20.707c0.202,0,0.326-0.006,0.358-0.008c0.245-0.014,0.476-0.117,0.649-0.291l1-1l0.697-0.697 l-5.414-5.414L14.594,13.994z" />
                  </svg>
                </span>
                <span class="ml-3">
                  085655474444
                </span>
              </a>
            </li>
            <li class="mt-4">
              <a href="#" title="" class="block flex items-center opacity-75 hover:opacity-100">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                      d="M20,4H4C2.896,4,2,4.896,2,6v12c0,1.104,0.896,2,2,2h16c1.104,0,2-0.896,2-2V6C22,4.896,21.104,4,20,4z M20,8.7l-8,5.334 L4,8.7V6.297l8,5.333l8-5.333V8.7z" />
                  </svg>
                </span>
                <span class="ml-3">
                 kpkjhoang@gmail.com
                </span>
              </a>
            </li>
          </ul>
        </div>

        <div class="w-full lg:w-1/6 mt-8 lg:mt-0 lg:mx-4">
          <h5 class="uppercase tracking-wider font-semibold text-gray-500">Sosmed Kami</h5>
          <ul class="mt-4 flex">
            <li>
              <a href="https://www.facebook.com/kpk.jhoang.7?locale=id_ID" target="_blank" title="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                  <path
                    d="M20,3H4C3.447,3,3,3.448,3,4v16c0,0.552,0.447,1,1,1h8.615v-6.96h-2.338v-2.725h2.338v-2c0-2.325,1.42-3.592,3.5-3.592	c0.699-0.002,1.399,0.034,2.095,0.107v2.42h-1.435c-1.128,0-1.348,0.538-1.348,1.325v1.735h2.697l-0.35,2.725h-2.348V21H20	c0.553,0,1-0.448,1-1V4C21,3.448,20.553,3,20,3z" />
                </svg>
              </a>
            </li>

            <li class="ml-6">
              <a href="https://www.instagram.com/kpkjhoang.official/" target="_blank" title="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-current">
                  <path
                    d="M20.947,8.305c-0.011-0.757-0.151-1.508-0.419-2.216c-0.469-1.209-1.424-2.165-2.633-2.633 c-0.699-0.263-1.438-0.404-2.186-0.42C14.747,2.993,14.442,2.981,12,2.981s-2.755,0-3.71,0.055 c-0.747,0.016-1.486,0.157-2.185,0.42C4.896,3.924,3.94,4.88,3.472,6.089C3.209,6.788,3.067,7.527,3.053,8.274 c-0.043,0.963-0.056,1.268-0.056,3.71s0,2.754,0.056,3.71c0.015,0.748,0.156,1.486,0.419,2.187 c0.469,1.208,1.424,2.164,2.634,2.632c0.696,0.272,1.435,0.426,2.185,0.45c0.963,0.043,1.268,0.056,3.71,0.056s2.755,0,3.71-0.056 c0.747-0.015,1.486-0.156,2.186-0.419c1.209-0.469,2.164-1.425,2.633-2.633c0.263-0.7,0.404-1.438,0.419-2.187 c0.043-0.962,0.056-1.267,0.056-3.71C21.003,9.572,21.003,9.262,20.947,8.305z M11.994,16.602c-2.554,0-4.623-2.069-4.623-4.623 s2.069-4.623,4.623-4.623c2.552,0,4.623,2.069,4.623,4.623S14.546,16.602,11.994,16.602z M16.801,8.263 c-0.597,0-1.078-0.482-1.078-1.078s0.481-1.078,1.078-1.078c0.595,0,1.077,0.482,1.077,1.078S17.396,8.263,16.801,8.263z" />
                  <circle cx="11.994" cy="11.979" r="3.003" /></svg>
              </a>
            </li>
          </ul>
    </footer>
    <!-- end footer -->
  </main>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131505823-4"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-131505823-4');
  </script>

</body>
</html>
@endsection