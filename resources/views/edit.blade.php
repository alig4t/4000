<!DOCTYPE html>
   
    <title>ویرایش واژه {{$word->eng}}</title>
    @include('layout.meta')

  </head>

  <body>

    @include('layout.menu')


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{$word->eng}}</h1>
      <p class="lead">ویرایش واژه</p>
    </div>

    <div class="container">
      


        <form action="{{route('word.update',$word->id)}}" method="POST">
            @csrf
            {{method_field('PATCH')}}
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">معنی فارسی</label>
              <div class="col-sm-10">
                <input type="text" value="{{$word->per}}" name="per" class="form-control" id="inputEmail3">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">توضیحات انگلیسی</label>
                <div class="col-sm-10">
                  <input type="text" value="{{$word->description}}" name="description" class="form-control" dir="ltr">
                </div>
              </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">مثال انگلیسی</label>
              <div class="col-sm-10">
                <input type="text" value="{{$word->example}}" name="example" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی</label>
                <div class="col-sm-10">
                  <input type="text" value="{{$word->example_trs}}" name="example_trs" class="form-control">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">ویرایش</button>
          </form>


      @include('layout.footer')

    </div>


   
  

</body>
</html>