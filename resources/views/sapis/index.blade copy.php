<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Katalog Sapi</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{session("success")}}
            </div>

        @endif
    </div>
    <div>
        <div>
            <a href="{{route('sapi.create')}}">Tambah Sapi</a>
        </div>
        
        @foreach($sapis as $sapi)
        <tr>
            <td>{{ $sapi->kode_sapi }}</td>
            <td>{{ $sapi->jenis_sapi }}</td>
            <td>{{ $sapi->bobot }}</td>
            <td>Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}</td>
            <td>{{ $sapi->status }}</td>
            <td>
                {{-- Cek apakah foto ada dan tampilkan --}}
                @if($sapi->foto_path)
                    <img src="{{ asset('storage/' . $sapi->foto_path) }}" width="100px" alt="Foto Sapi">
                @else
                    Tidak ada foto
                @endif
            </td>
            <td>
                <a href="{{ route('sapi.edit', $sapi->id) }}">Edit</a>
            </td>
            <td>
    <form method="post" action="{{route('sapi.destroy', ['sapi' => $sapi])}}">
        @csrf
        @method('delete')
        <input type="submit" value="Hapus" />
    </form>
</td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</body>
</html>