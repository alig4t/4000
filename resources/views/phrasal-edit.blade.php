<!DOCTYPE html>
   
    <title>ویرایش عبارت {{$word->eng}}</title>
    @include('layout.meta')

  </head>

  <body>

    @include('layout.header')


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{$word->eng}}</h1>
      <p class="lead">ویرایش عبارت</p>
    </div>

    <div class="container">
      


        <form action="{{route('phrasal.update',$word->id)}}" method="POST">
            @csrf
            {{method_field('PATCH')}}
           
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">عبارت انگلیسی</label>
              <div class="col-sm-10">
                <input type="text" value="{{$word->eng}}"  name="eng" class="form-control" id="input1">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">معنی فارسی</label>
              <div class="col-sm-10">
                <input type="text" value="{{$word->per}}"  name="per" class="form-control" id="input2">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">درس</label>
              <div class="col-sm-10">
                <input type="number" value="{{$word->chapter}}"  name="chapter" class="form-control" id="input3">
              </div>
            </div>
         
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">مثال انگلیسی</label>
              <div class="col-sm-10">
                <input type="text"  value="{{$word->example}}"  name="example" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی</label>
                <div class="col-sm-10">
                  <input type="text"  value="{{$word->example_trs}}"   name="example_trs" class="form-control">
                </div>
            </div>



            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"> مثال انگلیسی دوم</label>
              <div class="col-sm-10">
                <input type="text"  value="{{$word->example2}}"  name="example2" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی دوم</label>
                <div class="col-sm-10">
                  <input type="text"   value="{{$word->example_trs2}}"  name="example_trs2" class="form-control">
                </div>
            </div>

            
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"> مثال انگلیسی سوم</label>
              <div class="col-sm-10">
                <input type="text"  value="{{$word->example3}}"  name="example3" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی سوم</label>
                <div class="col-sm-10">
                  <input type="text"   value="{{$word->example_trs3}}"  name="example_trs3" class="form-control">
                </div>
            </div>

            
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"> مثال انگلیسی چهارم</label>
              <div class="col-sm-10">
                <input type="text"  value="{{$word->example4}}"  name="example4" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی چهارم</label>
                <div class="col-sm-10">
                  <input type="text"   value="{{$word->example_trs4}}"  name="example_trs4" class="form-control">
                </div>
            </div>

  
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"> مثال انگلیسی پنجم</label>
              <div class="col-sm-10">
                <input type="text"  value="{{$word->example5}}"  name="example5" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی پنجم</label>
                <div class="col-sm-10">
                  <input type="text"   value="{{$word->example_trs5}}"  name="example_trs5" class="form-control">
                </div>
            </div>

            
            <button type="submit" class="btn btn-primary">ویرایش</button>
          </form>


      @include('layout.footer')

    </div>


   
  

</body>
</html>