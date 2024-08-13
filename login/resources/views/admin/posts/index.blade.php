<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('admin/posts/create') }}" class="btn btn-primary">Add Data Mahasiswa</a>
                        <br>
                    </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"><center>FOTO</th>
                                    <th scope="col"><center>NIM</th>
                                    <th scope="col"><center>NAMA MAHASISWA</th>
                                    <th scope="col"><center>ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                    <img src="{{ Storage::url('public/admin/posts/').$post->foto_mahasiswa }}" class="rounded-circle" style="width: 80px; height: 90px"></td>
                                        <td>{{ $post->nim }}</td>
                                        <td>{{ $post->nama_mahasiswa }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin?');"action="{{ route('admin/posts/destroy', $post->id) }}" method="GET"><a href="{{ route('admin/posts/edit', $post->id) }}" class="btn btn-sm btn-warning">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Mahasiswa belum Tersedia. </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script
        src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>  
    </body>
</html>