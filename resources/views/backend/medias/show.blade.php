@extends('backend.layouts.master')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            {{-- @include("layouts.sidebar") --}}
        </div>
        <div class="col-md-9">
            <div class="card p-3">
                <h3 class="card-title">Show gallery image for  </h3>
                <div class="card-body">
                        @csrf                     
                        <div class="form-group">
                           @foreach ($medias as $media)
                            <tr class="d-flex flex-row justify-content-center align-items-center">
                            <td ><img src="{{ asset($media->image_link)  }}"
                                width="200"
                                height="200"
                                class="img-fluid rounded"
                           ></td>
                            <td  >
                                <form id="{{ $media->id }}" action="{{route("medias.destroy",$media->id)}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    
                                        <button
                                        onclick="event.preventDefault();
                                       if(confirm('Do you really want to delete {{ $media->image  }} ?'))
                                        document.getElementById({{ $media->id }}).submit();
                                    "
                                     class="btn btn-sm btn-danger">
                                     <i class="fa fa-trash"></i>
                                 </button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection