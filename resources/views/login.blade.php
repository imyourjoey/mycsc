<x-layout>
    <x-navbar/>
    <div class="container offset-3 mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="h1">Login to Your Account</p>
                <p>Please login with your email and password</p>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row align-items-center">
                <div class="form-group col-md-1">
                    <label for="email">Email</label>

                </div>

                <div class="form-group col-md-5">
                    <input type="text" class="form-control" id="email" placeholder="Please enter your email address"
                        name="email" value="{{ old('email') }}">
                </div>

            </div>
            <div class="row align-items-center">
                <div class="col-md-1 form-group">
                    <label for="password">Password</label>
                </div>


                <div class="col-md-5 form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" id="password"
                            placeholder="Please enter your password" name="password">
                        <div class="input-group-append">
                            <span class="input-group-text eye-icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row mt-3">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary btn-block">Login <i class="fa fa-arrow-right"
                            aria-hidden="true"></i></button>

                </div>
            </div>


        </form>


    </div>
</x-layout>
