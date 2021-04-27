
 @extends('admin.admin_master')

 @section('admin')


 <div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Contact</h2>
        </div>
        <div class="card-body">

            <form action="{{ route('store.contact') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Conatact Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Conatact Email"  >


                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Conatact Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Conatact Phone" >


                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Conatact Address</label>
                    <textarea class="form-control  @error('address') is-invalid @enderror" name="address" rows="3" placeholder="Conatact Phone">

                    </textarea>

                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>


                </div>
            </form>
        </div>
    </div>


@endsection
