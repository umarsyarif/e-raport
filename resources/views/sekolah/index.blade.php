<?php
$title = 'Data Sekolah';
$showNav = true;
?>
@extends('layouts.adminty')

@section('title', $title)

@section('content')
    <div class="page-wrapper">
        <!-- Page Header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>{{$title}}</h4>
                            <span>Halaman data sekolah, digunakan untuk melihat, menambah, mengubah, dan menghapus data sekolah. </span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['route.name' => 'Displayed Name']])
            </div>
        </div>
        <!-- Page Header end -->
        <!-- Page Body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <!-- Zero config.table start -->
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-create-edit">
                                <i class="feather icon-plus"></i>Tambah tahun ajaran
                            </button>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <th>Alamat</th>
                                        <th>Kepala Sekolah</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sekolah as $row)
                                        <tr>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->kepala_sekolah }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary btn-edit px-2" data-form="{{ $row }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-edit mx-auto"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ubah Password">
                                                    <i class="feather icon-unlock mx-auto"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-delete px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus">
                                                    <i class="feather icon-trash-2 mx-auto"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Zero config.table end -->
                </div>
            </div>
        </div>
        <!-- Page Body end -->
        <!-- Modal create and edit start -->
        <div class="modal fade" id="modal-create-edit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tahun Ajaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-create-edit" action="{{ route('sekolah.store') }}" method="POST">
                        @csrf
                        <input id="method-form-create-edit" type="hidden" name="_method" value="">
                        <div class="modal-body">
                            @if($errors->any())
                                <div class="alert alert-warning background-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group form-primary">
                                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}" required>
                                <span class="form-bar"></span>
                                <small class="text-muted">Tahun ajaran, cth: 2020/2021</small>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" value="{{ old('alamat') }}" required>
                                <span class="form-bar"></span>
                                <small class="text-muted">Buat Alamat Sekolah Dengan Lengkap</small>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" id="kepala_sekolah" name="kepala_sekolah" class="form-control @error('kepala_sekolah') is-invalid @enderror" placeholder="Tanggal Raport" value="{{ old('kepala_sekolah') }}" required>
                                <span class="form-bar"></span>
                                <small class="text-muted">Buat Nama Beserta Gelarnya</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal create and edit end -->
        <!-- Modal delete start -->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus data sekolah</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('sekolah.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda yakin ingin menghapus data sekolah ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- data-table js -->
    <script src="{{ asset('adminty\files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminty\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <!-- Switch component js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\switchery\js\switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\assets\pages\advance-elements\swithces.js') }}"></script>
    <!-- Max-length js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\bootstrap-maxlength\js\bootstrap-maxlength.js') }}"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\datedropper\js\datedropper.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#simpletable').DataTable();
            $("#tanggal_raport").dateDropper( {
                format: "d F Y",
                dropWidth: 200,
                dropPrimaryColor: "#1abc9c",
                dropBorder: "1px solid #1abc9c"
            });
        });

        $('.btn-edit').click(function() {
            $('#modal-create-edit').modal('show');
            const form = $(this).data('form');

            // change url to specific row
            const url = '{{ route('sekolah.update') }}';
            $('#form-create-edit').attr('action', `${url}/${form.id}`);
            $('#method-form-create-edit').val('PUT');


            // change form to specific row
            $('#nama').val(form.nama);
            $('#alamat').val(form.alamat);
            $('#kepala_sekolah').val(form.kepala_sekolah);

        });

        $('.btn-delete').click(function() {
            $('#modal-delete').modal('show');
            const id = $(this).data('id');

            // change url to specific row
            const url = '{{ route('sekolah.update') }}';
            $('#form-delete').attr('action', `${url}/${id}`);
        });

        // show modal if any errors
        @if ($errors->any())
            $('#modal-create-edit').modal('show');
        @endif

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
