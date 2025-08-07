<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'KPK JHOANG')</title>
  <link rel="stylesheet" href="{{ asset('build/tailwind.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-cover bg-center bg-no-repeat bg-fixed font-sans text-gray-900"
      style="background-image: url('{{ asset('storage/' . $logo->gambar) }}');">

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full shadow-md z-50 backdrop-blur-md bg-white/40 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64">
    <div class="hidden md:flex justify-between items-center py-2 border-b border-gray-300 pb-4 text-sm"
         style="border-color: rgba(237, 0, 0, 0.25)">
      <div class="">
        <ul class="flex text-gray-700">
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 fill-current text-gray-700" viewBox="0 0 24 24">
                <path d="M12,2C7.589,2,4,5.589,4,9.995C3.971,16.44,11.696,21.784,12,22c0,0,8.029-5.56,8-12C20,5.589,16.411,2,12,2z M12,14 c-2.21,0-4-1.79-4-4s1.79-4,4-4s4,1.79,4,4S14.21,14,12,14z" />
              </svg>
              <span class="ml-2 text-gray-700">Tambakboyo, Tuban</span>
            </div>
          </li>
          <li class="ml-6">
            <div class="flex items-center">
              <svg class="w-6 h-6 fill-current text-gray-700" viewBox="0 0 24 24">
                <path d="M14.594,13.994l-1.66,1.66c-0.577-0.109-1.734-0.471-2.926-1.66c-1.193-1.193-1.553-2.354-1.661-2.926l1.661-1.66 l0.701-0.701L5.295,3.293L4.594,3.994l-1,1C3.42,5.168,3.316,5.398,3.303,5.643c-0.015,0.25-0.302,6.172,4.291,10.766 C11.6,20.414,16.618,20.707,18,20.707c0.202,0,0.326-0.006,0.358-0.008c0.245-0.014,0.476-0.117,0.649-0.291l1-1l0.697-0.697 l-5.414-5.414L14.594,13.994z" />
              </svg>
              <span class="ml-2 text-gray-700">085655474444</span>
            </div>
          </li>
        </ul>
      </div>

      <div class="">
        <ul class="flex justify-end text-gray-700">
          <li>
            <a href="https://www.facebook.com/kpk.jhoang.7?locale=id_ID" target="_blank">
              <!-- Facebook Icon -->
              <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                <path d="M20,3H4C3.447,3,3,3.448,3,4v16c0,0.552,0.447,1,1,1h8.615v-6.96h-2.338v-2.725h2.338v-2c0-2.325,1.42-3.592,3.5-3.592	c0.699-0.002,1.399,0.034,2.095,0.107v2.42h-1.435c-1.128,0-1.348,0.538-1.348,1.325v1.735h2.697l-0.35,2.725h-2.348V21H20	c0.553,0,1-0.448,1-1V4C21,3.448,20.553,3,20,3z"></path>
              </svg>
            </a>
          </li>
          <li class="ml-6">
            <a href="https://www.instagram.com/kpkjhoang.official/" target="_blank">
              <!-- Instagram Icon -->
              <svg width="24" height="24" viewBox="0 0 24 24" class="text-gray-700">
                <path d="M20.947,8.305c-0.011-0.757-0.151-1.508-0.419-2.216c-0.469-1.209-1.424-2.165-2.633-2.633 c-0.699-0.263-1.438-0.404-2.186-0.42C14.747,2.993,14.442,2.981,12,2.981s-2.755,0-3.71,0.055 c-0.747,0.016-1.486,0.157-2.185,0.42C4.896,3.924,3.94,4.88,3.472,6.089C3.209,6.788,3.067,7.527,3.053,8.274 c-0.043,0.963-0.056,1.268-0.056,3.71s0,2.754,0.056,3.71c0.015,0.748,0.156,1.486,0.419,2.187 c0.469,1.208,1.424,2.164,2.634,2.632c0.696,0.272,1.435,0.426,2.185,0.45c0.963,0.043,1.268,0.056,3.71,0.056s2.755,0,3.71-0.056 c0.747-0.015,1.486-0.156,2.186-0.419c1.209-0.469,2.164-1.425,2.633-2.633c0.263-0.7,0.404-1.438,0.419-2.187 c0.043-0.962,0.056-1.267,0.056-3.71C21.003,9.572,21.003,9.262,20.947,8.305z M11.994,16.602c-2.554,0-4.623-2.069-4.623-4.623 s2.069-4.623,4.623-4.623c2.552,0,4.623,2.069,4.623,4.623S14.546,16.602,11.994,16.602z M16.801,8.263 c-0.597,0-1.078-0.482-1.078-1.078s0.481-1.078,1.078-1.078c0.595,0,1.077,0.482,1.077,1.078S17.396,8.263,16.801,8.263z"/>
                <circle cx="11.994" cy="11.979" r="3.003"></circle>
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="flex items-center justify-center py-2">
      <nav class="flex space-x-6">
      <a class="py-2 text-gray-700 font-semibold" href="http://localhost:8000/">Home</a>
      <a class="py-2 text-gray-700 font-semibold" href="http://localhost:8000/menu">Menu</a>
      </nav>

      <div class="flex items-center mx-6">
        @if($logo)
          <img src="{{ asset('storage/'.$logo->logo) }}" alt="Logo" class="w-10 h-10 object-cover rounded-full">
        @endif
        <a href="/" class="font-bold text-gray-700 text-xl ml-2">KPK JHOANG</a>
      </div>

      <nav class="flex space-x-6">
        <a class="py-2 text-gray-700 font-semibold" href="http://localhost:8000/orderan">Orderan Saya</a>
        <a class="py-2 text-gray-700 font-semibold" href="http://localhost:8000/saran">Saran & Masukkan</a>
      </nav>

      <label for="menu-toggle" class="pointer-cursor md:hidden block">
        <svg class="fill-current text-gray-700" width="20" height="20" viewBox="0 0 20 20">
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
      </label>
      <input class="hidden" type="checkbox" id="menu-toggle">
    </div>

    <div class="hidden md:hidden w-full bg-white shadow-lg px-6 py-4 text-center" id="menu">
      <nav>
        <ul class="space-y-2">
          <li><a class="py-2 block text-gray-700 font-semibold" href="#">Home</a></li>
          <li><a class="py-2 block text-gray-700 font-semibold" href="#">Menu</a></li>
          <li><a class="py-2 block text-gray-700 font-semibold" href="#">Orderan Saya</a></li>
          <li><a class="py-2 block text-gray-700 font-semibold" href="#">Saran & Masukkan</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="w-full pt-20">
    @yield('content')
  </main>

</body>
</html>
