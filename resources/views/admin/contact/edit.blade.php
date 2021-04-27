
 @extends('admin.admin_master')

 @section('admin')


 <div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact</h2>
        </div>
        <div class="card-body">

            <form action="{{ url('contact/update/'.$edit_contact->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Conatact Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Conatact Email" value="{{ $edit_contact->email }}" >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Conatact Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Conatact Phone" value="{{ $edit_contact->phone }}" >
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Conatact Address</label>
                    <textarea class="form-control" name="address" rows="3" placeholder="Conatact Phone" value="{{ $edit_contact->address }}">

                    </textarea>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>


                </div>
            </form>
        </div>
    </div>


@endsection
