@extends('admin.admin_master')

@section('admin')


    @if (session('success'))


    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      @endif

    <div class="py-12">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}

            <div class="container">
               <div class="row">



            <div class="col-md-8">
                <div class="card">


                    <div class="card-header">
                    Edit Slider
                    </div>
                    <div class="card-body">

                        <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- this hidden input to replace the specific image --}}
                            {{-- old_image : means which images was already exist in our DB --}}
                            <input type="hidden" name="old_image" value="{{ $slider->image }}">

                            <div class="form-group">
                              <label for="exampleInputEmail1">Update slider title</label>
                              <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $slider->title }}">
                              @error('category_name')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Update slider description</label>
                                <input type="text" name="description" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $slider->description }}">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>



                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Brand Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $slider->image }}">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>

                              <div class="form-group">
                                  {{-- to make my image visiable --}}
                                  <img src="{{ asset($slider->image) }}" style="width:400px; height:200px">
                              </div>
                            <button type="submit" class="btn btn-primary">Update slider</button>
                          </form>

                    </div>




                </div>
            </div>


                </div>
            </div>

    </div>






@endsection
