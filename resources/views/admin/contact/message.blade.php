


 @extends('admin.admin_master')

 @section('admin')




    <div class="py-12">

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}

            <div class="container">
               <div class="row">




                   <div class="col-md-12">

                       <h3>Admin Message Page</h3>



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
                            All Message Data
                           </div>


                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">SL No</th>
                        <th scope="col" width="15%"> Name</th>
                        <th scope="col" width="25%"> Email</th>
                        <th scope="col" width="15%"> Subject</th>
                        <th scope="col" width="15%"> Message</th>
                        <th scope="col" width="15%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
               @php ($i = 1)
                     @foreach ( $message as $mess )
                     <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $mess->Name  }}</td>
                        <td>{{ $mess->email  }}</td>
                        <td>{{ $mess->subject  }}</td>
                        <td>{{ $mess->message  }}</td>

                        <td>


                            <a href="{{ url('message/delete/'.$mess->id ) }}" onclick="return confirm('are you sure to delete')" class="btn btn-danger">Delete</a>

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
