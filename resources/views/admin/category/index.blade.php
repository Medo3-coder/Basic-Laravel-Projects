<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- to know which user already loged in --}}
        All Category

        </h2>
    </x-slot>

    <div class="py-12">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}

            <div class="container">
               <div class="row">
                   <div class="col-md-8">
                       <div class="card">
                        @if (session('success'))


                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          @endif
                           <div class="card-header">
                           All Category
                           </div>


                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created_At</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

           {{-- @php ($i = 1) --}}
                     @foreach ( $category as $categories )
                     <tr>
                        <th scope="row">{{ $category->firstItem()+$loop->index }}</th>
                        <td>{{ $categories->category_name  }}</td>
                        <td> {{ $categories->user->name}} </td>
                        <td>
                            @if ($categories->created_at == null)

                            <span class="text-danger"> No Data Set</span>
                            @else
                            {{$categories->created_at->diffForHumans()   }}
                            @endif





                        </td>

                        <td>

                            <a href="{{ url('category/edit/'.$categories->id )}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('softdelete/category/'.$categories->id ) }}" class="btn btn-danger">Delete</a>

                        </td>
                    </tr>

                     @endforeach




                    </tbody>
                  </table>

                  {{ $category->links() }}
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">


                    <div class="card-header">
                    Add Category
                    </div>
                    <div class="card-body">

                        <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Category Name</label>
                              <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              @error('category_name')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Name</button>
                          </form>

                    </div>




                </div>
            </div>


                </div>
            </div>







{{-- Trash Part --}}


            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">


                            <div class="card-header">
                            Trash List
                            </div>


                 <table class="table">
                     <thead>
                       <tr>
                         <th scope="col">SL No</th>
                         <th scope="col">Category Name</th>
                         <th scope="col">User</th>
                         <th scope="col">Created_At</th>
                         <th scope="col">Action</th>
                       </tr>
                     </thead>
                     <tbody>

            {{-- @php ($i = 1) --}}
                      @foreach ( $trashCat as $categories )
                      <tr>
                         <th scope="row">{{  $trashCat->firstItem()+$loop->index }}</th>
                         <td>{{ $categories->category_name  }}</td>
                         <td> {{ $categories->user->name}} </td>
                         <td>
                             @if ($categories->created_at == null)

                             <span class="text-danger"> No Data Set</span>
                             @else
                             {{$categories->created_at->diffForHumans()   }}
                             @endif





                         </td>

                         <td>

                             <a href="{{ url('category/restore/'.$categories->id )}}" class="btn btn-info">Restore</a>
                             <a href="{{ url('pdelete/category/'.$categories->id )}}" class="btn btn-danger">P Delete</a>

                         </td>
                     </tr>

                      @endforeach




                     </tbody>
                   </table>

                   {{ $trashCat->links() }}
                 </div>
             </div>


             <div class="col-md-4">

             </div>


                 </div>
             </div>

             {{-- End Trash --}}

    </div>






</x-app-layout>
