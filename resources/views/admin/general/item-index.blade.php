@extends('admin.main')

@section('content')
    <div id="app">

        <item-index 
            :user-id="{{ auth()->user()->id }}" 
            item="{{ $item }}" 
            fetch-url="{{ $fetchUrl }}" 
            :table-heading="{{ $tableHeading }}" 
            :item-properties="{{ $itemProperties }}" 
            :search="true" 
            item-identifier="{{ $identifier ?? null }}" 
            name-shown-as="{{ $nameShownAs ?? null }}"
            store-url="{{ $storeUrl ?? null }}"
        >
            <template v-slot:header>
                
                <div class="page-header">
                    <div class="row align-items-center mw-100">

                        <div class="col">
                            <div class="mb-1">
                                @include('admin._breadcrumb')
                            </div>
                            <h1>
                                <span class="text-truncate">{{ ucfirst($item) }}</span>
                            </h1>
                        </div>

                        <div class="col-auto">
                            <div class="btn-list">
                                <button 
                                    type="button" 
                                    class="btn" 
                                    data-toggle="modal" 
                                    data-target="#edit"
                                >
            
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                    </span>
                                    <span>Tambah Baru</span>
                                
                                </button>

                                @if ($item == 'user')
                                    <a href="{{ route('admin.user.getCsv') }}" class="btn btn-success">Impor dari .CSV</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </template>
        </item-index>

    </div>
@endsection

@push('js')
    <script type="text/javascript" src="/dist/js/app.js"></script>    
@endpush
