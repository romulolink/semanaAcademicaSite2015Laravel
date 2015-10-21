@extends('layouts.main')



@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="{{ $login_url }}" class="btn btn-lg btn-primary btn-block">Facebook</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


       @endsection