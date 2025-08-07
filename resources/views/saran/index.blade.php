@extends('layouts.admin')

@section('title', 'Daftar Saran & Masukan')

@section('content')
<main class="w-full flex-grow p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">📬 Daftar Saran & Masukan</h2>

        @if($sarans->isEmpty())
            <div class="text-gray-500 italic">Belum ada saran yang masuk.</div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 border">Nama</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 border">Isi</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 border">Tanggal</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-600 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($sarans as $saran)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-4 py-3 border text-gray-800">{{ $saran->nama }}</td>
                            <td class="px-4 py-3 border text-gray-800">{{ $saran->isi }}</td>
                            <td class="px-4 py-3 border text-gray-500 text-sm">
                                {{ $saran->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3 border text-center">
                                <form action="{{ route('saran.destroy', $saran->id) }}" method="POST" onsubmit="return confirm('Yakin hapus saran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</main>
@endsection
