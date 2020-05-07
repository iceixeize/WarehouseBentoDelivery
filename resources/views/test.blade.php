<!DOCTYPE html>
<html>
    <head></head>
    <body>
        @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<form action="{{route('test.test')}}" method="post">
    {{csrf_field()}}
        <input class="form-control" type="text" name="test[]"><br>
        <input class="form-control" type="text" name="test[]"><br>
        <input class="form-control" type="text" name="test[]"><br>
        <input class="form-control" type="text" name="test[]"><br>
        <input class="form-control" type="text" name="test[]"><br>
        <input class="form-control" type="text" name="test[]"><br>
        <button type="submit">submit</button>
</form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script> 
    {!! JsValidator::formRequest('App\Http\Requests\TestRequest') !!}

    </body>
</html>