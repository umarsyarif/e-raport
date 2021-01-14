<?php
$title = 'Data Kelas';
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
                            <span>Halaman data kelas pada wali kelas digunakan untuk input nilai raport </span>
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
                            {{-- // --}}
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIP</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama_lengkap }}</td>
                                            <td>{{ $row->tahun_ajaran->nama }}</td>
                                            <td>
                                                <label class="badge badge-{{ $row->tahun_ajaran->is_aktif ? 'success' : 'danger'}}">
                                                    {{ $row->tahun_ajaran->is_aktif ? 'Aktif' : 'Non-Aktif' }}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{ route('kelas.show', $row) }}" class="btn btn-sm btn-inverse px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info">
                                                    <i class="feather icon-info mx-auto"></i>
                                                </a>
                                                @if ($row->tahun_ajaran->is_aktif)
                                                <button class="btn btn-sm btn-primary px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Isi Raport">
                                                    <i class="feather icon-edit mx-auto"></i>
                                                </button>
                                                @endif
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
    </div>
@endsection

@push('script')
    <!-- data-table js -->
    <script src="{{ asset('adminty\files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminty\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#simpletable').DataTable();
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
