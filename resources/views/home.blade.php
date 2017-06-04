@extends('layouts.app')

@section('js_addon')
    <script>       
        $(document).ready(function() {
            $('#table-penduduk-sortable').DataTable({
                "searching": false
            });
        } );
        $('.btn-upload').on('click', function(){
            var penduduk_id = $(this).attr('penduduk');
            $('input[id="penduduk_id"]').val(penduduk_id);
        });
        $('.btn-edit').on('click', function(){
            var penduduk_id = $(this).attr('penduduk');
            var noKtp = $(this).attr('noKtp');
            var nama = $(this).attr('nama');
            var tglLahir = $(this).attr('tglLahir');
			var tmptLahir = $(this).attr('tmptLahir');
            var selectTipe = $(this).attr('jk');
            var agama = $(this).attr('agama');
            var alamat = $(this).attr('alamat');
			var noTelp = $(this).attr('noTelp');

            $('input[id="penduduk_id"]').val(penduduk_id);
            $('input[id="noKtp"]').val(noKtp);
            $('input[id="nama"]').val(nama);
			$('input[id="tmptLahir"]').val(tmptLahir);
            $('input[id="tglLahir"]').val(tglLahir);
            $('select[id="selectTipe"]').val(selectTipe);
            $('input[id="agama"]').val(agama);
            $('textarea[id="alamat"]').val(alamat);
			$('input[id="noTelp"]').val(noTelp);

        });
        $('.btn-delete').on('click', function () {
            var url = $(this).attr('url');

            swal({
                title: "Anda Yakin?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus saja",
                closeOnConfirm: false
            },function(){
                window.location.href = url;
            });
        });
    </script>
@endsection

@section('content')
<div class="container">
    @include('flash::message')
    @include('sweet::alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form method="get">
                        <div class="row">
                            <div class="col-md-9">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Tambah Penduduk</button>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12 float-md-right float-sm-none">
                                <div class="form-group">
                                    <input type="text"
                                           class="search form-control"
                                           placeholder="Search by No.KTP/Nama"
                                           name="search" value="{{ $search or "" }}" >
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table id="table-penduduk-sortable" class="table table-hover table-sm">
                            <thead>
                                <tr>    
                                    <th class="text-xs-center">#</th>
                                    <th>No. KTP</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
									<th>Tempat Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Alamat</th>
									<th>No. Telpon</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $skipped = ($penduduks->currentPage() * $penduduks->perPage())
                            - $penduduks->perPage();?>
                            @foreach($penduduks as $penduduk)
                                <tr>
                                    <td class="text-xs-center">{{ $skipped + $loop->iteration }}</td>
                                    {{--@if ($penduduk->noKtp != $penduduk->noKtp)--}}
                                        {{--<td>{{ $penduduk->noKtp }}</td>--}}
                                    {{--@else--}}
                                        {{--<td>Nomor KTP sudah terdaftar</td>--}}
                                    {{--@endif--}}
                                    <td>{{ $penduduk->noKtp }}
                                    <td>{{ $penduduk->nama }}</td>
                                    <td>{{ $penduduk->tglLahir }}</td>
									<td>{{ $penduduk->tmptLahir }}</td>
                                    <td>{{ $penduduk->getJK() }}</td>
                                    <td>{{ $penduduk->agama }}</td>
                                    <td>{{ $penduduk->alamat }}</td>
									<td>{{ $penduduk->noTelp }}</td>

                                    <td th style="text-align: center">
                                        <button type="button" class="btn btn-info btn-sm btn-edit"
                                                data-toggle="modal" penduduk="{{ $penduduk->id }}"
                                                noKtp="{{ $penduduk->noKtp }}"
                                                nama="{{ $penduduk->nama }}"
                                                tglLahir="{{ $penduduk->tglLahir }}"
												tmptLahir="{{ $penduduk->tmptLahir }}"
                                                agama="{{ $penduduk->agama }}"
                                                jk="{{ $penduduk->jk }}"
                                                alamat="{{ $penduduk->alamat }}"
												noTelp="{{ $penduduk->noTelp }}"
                                                data-target="#modalEdit">Edit
                                        </button>
                                        <a href="{{ url('/admin/home/delete') }}/{{ $penduduk->id }}" url="{{ url('/admin/home/delete') }}/{{ $penduduk->id }}"
                                           class="btn btn-danger btn-sm btn-delete">Delete
                                        </a>
                                        <a href="{{ url('/admin/home/upload') }}/{{ $penduduk->id }}" type="file" class="btn btn-primary btn-sm">Upload</button>
                                        </a>
                                        <button type="button" class="btn btn-default btn-sm btn-edit"
                                                data-toggle="modal" penduduk="{{ $penduduk->id }}"
                                                noKtp="{{ $penduduk->noKtp }}"
                                                nama="{{ $penduduk->nama }}"
                                                tglLahir="{{ $penduduk->tglLahir }}"
                                                agama="{{ $penduduk->agama }}"
                                                jk="{{ $penduduk->jk }}"
                                                alamat="{{ $penduduk->alamat }}"
                                                data-target="#modalView">View
                                        <button type="button" class="btn btn-primary btn-sm btn-upload"
                                                penduduk="{{ $penduduk->id }}" data-toggle="modal" data-target="#modalUpload">Upload
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    {{ $penduduks->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Agenda-->
    <div class="modal fade" id="modalAdd" tabindex="-1">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalAddLabel">Tambah Penduduk</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="{{ url('/admin/home/create') }}" method="post">
                        {{ csrf_field() }}

                        <label>No. KTP</label>
                        <input class="form-group form-control" type="text" name="noKtp" required>

                        <label>Nama</label>
                        <input class="form-group form-control" type="text" name="nama" required>

                        <label>Tanggal Lahir</label>
                        <input class="form-group form-control" type="text" name="tglLahir" required>
						<label>Tempat Lahir</label>
                        <input class="form-group form-control" type="text" name="tmptLahir" required>

                        <label>Jenis Kelamin</label>
                        <div class="form-group">
                            <select class="form-control" id="selectTipe" name="jk">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>

                        <label>Agama</label>
                        <input class="form-group form-control" type="text" name="agama" required>

                        <label>Alamat</label>
                        <textarea class="form-group form-control" rows="5" name="alamat" required></textarea>
						<label>No. Telpon</label>
                        <input class="form-group form-control" type="text" name="noTelp" required>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Agenda-->
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edit Penduduk</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="{{ url('/admin/home/edit') }}" method="post">
                        {{ csrf_field() }}
                        <input id="penduduk_id" style="display: none" name="penduduk_id">

                        <label>No. KTP</label>
                        <input class="form-group form-control" id="noKtp" type="text" name="noKtp" readonly>

                        <label>Nama</label>
                        <input class="form-group form-control" id="nama" type="text" name="nama" required>

                        <label>Tanggal Lahir</label>
                        <input class="form-group form-control" id="tglLahir" type="text" name="tglLahir" required>

						<label>Tempat Lahir</label>
                        <input class="form-group form-control" id="tmptLahir" type="text" name="tmptLahir" required>

                        <label>Jenis Kelamin</label>
                        <div class="form-group">
                            <select class="form-control" id="selectTipe" name="jk">
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>

                        <label>Agama</label>
                        <input class="form-group form-control" id="agama" type="text" name="agama" required>

                        <label>Alamat</label>
                        <textarea class="form-group form-control" id="alamat" rows="5" name="alamat" required></textarea>

						<label>No. Telpon</label>
                        <input class="form-group form-control" id="noTelp" type="text" name="noTelp" required>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload File-->
    <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form" action="{{ url('/admin/home/upload') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Upload</h4>
                    </div>
                    <input id="penduduk_id" style="display: none" name="penduduk_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Upload File</label>
                            <input type="file" accept=".pdf,.ppt,.pptx,.doc,.docx" class="form-control-file" name="file_url">
                            <small class="form-text text-muted">Upload File (types : *.pdf | *.ppt |*.pptx | *.doc | *.docx)</small>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" accept=".jpg,.png,.bmp,.gif" class="form-control-file" name="image_url">
                            <small class="form-text text-muted">Image (types : *.jpg | *.png |*.bmp | *.gif)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="cancel" class="btn btn-danger Close" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal View Agenda-->
<div class="modal fade" id="modalView" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Penduduk</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="{{ url('/home/edit') }}" method="post">
                    {{ csrf_field() }}
                    <input id="penduduk_id" style="display: none" name="penduduk_id">

                    <label>No. KTP</label>
                    <input class="form-group form-control" id="noKtp" type="text" name="noKtp" readonly>

                    <label>Nama</label>
                    <input class="form-group form-control" id="nama" type="text" name="nama" readonly>

                    <label>Tanggal Lahir</label>
                    <input class="form-group form-control" id="tglLahir" type="text" name="tglLahir" readonly>

                    <label>Jenis Kelamin</label>
                    <input class="form-group form-control" id="selectTipe" name="jk" readonly>

                    <label>Agama</label>
                    <input class="form-group form-control" id="agama" type="text" name="agama" readonly>

                    <label>Alamat</label>
                    <textarea class="form-group form-control" id="alamat" rows="5" name="alamat" readonly></textarea>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
