@extends('admin.main')

@section('content')
<div>
    <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pelajaran.index') }}">Pelajaran</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="#">
            {{ $pelajaran->judul }}
        </a></li>
    </ol>
    
    <div class="page-header">
        <h2 class="page-title">Edit Pelajaran</h2>
    </div>
    <form 
        action="{{ route('admin.pelajaran.update', $pelajaran->slug)}}" 
        method="post" 
    >
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col">

                <div class="form-group mb-3">
                    <label class="form-label required">Judul ujian</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="judul" 
                        placeholder="Tuliskan judul" 
                        value="{{ $pelajaran->judul }}"
                    >

                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>                        
                    @enderror

                   
                </div>

                <div class="form-group mb-3">
                    <label class="form-label required">
                        Slug URL
                    </label>
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <span class="input-group-text">{{ $_SERVER['SERVER_NAME'] }}/k/{kelas}/u/</span>
                        </span>
                        <input 
                            type="text" 
                            name="slug" 
                            class="form-control" 
                            value="{{ $pelajaran->slug }}"
                        >
                    </div>
                    <small class="form-hint">Gunakan (-) sebagai pemisah antar kata, bukan spasi.</small>

                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>                    
                    @enderror
                        
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">
                        Deskripsi
                        <!-- <span class="form-label-description">Maks: 600 karakter</span> -->
                    </label>
                    <textarea class="form-control" name="deskripsi" rows="6" placeholder="Deskripsi...">{{ $pelajaran->deskripsi }}</textarea>
                
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>                    
                    @enderror

                </div>
    
            </div>
            
            <div class="btn-list">
                <a href="{{ route('admin.ujian.index') }}" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Batal
                </a>

                <input type="submit" value="Simpan" class="btn btn-success">                     
            </div>

        </div>
    </form>
</div>
@endsection