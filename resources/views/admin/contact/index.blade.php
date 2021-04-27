


 @extends('admin.admin_master')

 @section('admin')




    <div class="py-12">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}

            <div class="container">
               <div class="row">




                   <div class="col-md-12">

                       <h3> Contact Page</h3>

                    <a href="{{ route('add.contact') }}"><button class="btn btn-info mb-2">Add Contact</button></a>

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
                            All Contact Data
                           </div>


                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">SL No</th>
                        <th scope="col" width="15%">Contact Address</th>
                        <th scope="col" width="25%">Contact Email</th>
                        <th scope="col" width="15%">Contact Phone</th>
                        <th scope="col" width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
 @php ($i = 1)
                     @foreach ( $contact as $con )
                     <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $con->address  }}</td>
                        <td>{{ $con->email  }}</td>
                        <td>{{ $con->phone  }}</td>



                        <td>

                            <a href="{{ url('contact/edit/'.$con->id )}}" class="btn btn-info">Edit</a>
                            <a href="{{ url('contact/delete/'.$con->id ) }}" onclick="return confirm('are you sure to delete')" class="btn btn-danger">Delete</a>

                        </td>
                    </tr>

                     @endforeach




                    </tbody>
                  </table>


                </div>
            </div>




                </div>
            </div>








    </div>








@endsection
