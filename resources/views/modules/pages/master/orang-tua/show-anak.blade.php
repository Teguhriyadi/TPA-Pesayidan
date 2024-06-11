@extends('modules.layouts.main')

@push('modules-title', 'Data Anak')

@push('modules-content')

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-users"></i> @stack("modules-title")
            </h1>
        </div>
        <div class="row">
            @foreach ($anak as $item)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ $item->nama }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $item->tempatLahir }}, {{ $item->tanggalLahir }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-outline-primary btn-sm btn-block">
                            <i class="fa fa-search"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endpush
