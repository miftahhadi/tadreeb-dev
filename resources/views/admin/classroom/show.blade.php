@extends('admin.main')

@section('content')

    @include('admin._item-header')

    <div class="mt-4">
        <ul class="nav nav-tabs">
            
            <li class="nav-item">
                <a href="{{ $kelasUrl }}" 
                    class="nav-link @if (!$page) active @endif"
                >Ikhtisar</a>
            </li>
            
            @foreach ($service->navMenu as $nav)
                <li class="nav-item">
                    <a href="{{ $kelasUrl . '?page=' . strtolower($nav) }}" 
                        class="nav-link @if ($page == strtolower($nav)) active @endif"
                    >{{ $nav }}</a>
                </li>
            @endforeach
            
        </ul>

        <div class="content-tab mt-4" id="app">
            <div class="tab-pane">
                
                @if (!$page)
                    <span>Ikhtisar</span>                
                @elseif ($page == 'pengaturan')
                    Pengaturan
                @elseif ($page == 'hasil_ujian')
                    @include('admin.exam._user-filter')
                    @include('admin.exam._result-table')
                @else 
                    <kelas-item
                        :kelas="{{ json_encode($kelas) }}"
                        :item-data="{{ json_encode($service->itemData) }}"
                    ></kelas-item>
                @endif

            </div>
        </div>
    </div>
    
@endsection

@push('js')
    <script type="text/javascript" src="/dist/js/app.js"></script>    
@endpush