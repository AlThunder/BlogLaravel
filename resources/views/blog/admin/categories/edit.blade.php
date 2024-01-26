@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\BlogCategory $item */ @endphp
    @if($item->exists)
        <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}">
        @method('PATCH')
    @else
        <form method="POST" action="{{ route('blog.admin.categories.store') }}">
    @endif
        @csrf

        <div class="container">
            @php
            /** @var \Illuminate\Support\ViewErrorBag $errors */
            @endphp
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.categories.includes.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.categories.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
