@extends('backend.layouts.master')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            {{-- @include("layouts.sidebar") --}}
        </div>
        <div class="col-md-9">
            <div class="card p-3">
                <h3 class="card-title">Add new gallery image  {{$product_id}}</h3>
                <div class="card-body">
                    <form method="post" action="{{ route("medias.store") }}" enctype="multipart/form-data">
                        @csrf                     
                        <div class="form-group">
                            <input type="file" name="image_link"  class="form-control">
                            <input type="hidden" name="product_id" value="{{ $product_id }}"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection