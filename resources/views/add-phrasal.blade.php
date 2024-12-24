<!DOCTYPE html>
   
    <title>افزودن عبارت جدید</title>
    @include('layout.meta')

  </head>

  <body>

    @include('layout.header')


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">افزودن عبارت جدید</h1>
      <p class="lead">افزودن عبارت</p>
    </div>

    <div class="container">
      


        <form action="{{route('phrasal.store')}}" method="POST">
            @csrf
            {{method_field('POST')}}
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">عبارت انگلیسی</label>
              <div class="col-sm-10">
                <input type="text"  name="eng" class="form-control" id="input1">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">معنی فارسی</label>
              <div class="col-sm-10">
                <input type="text"  name="per" class="form-control" id="input2">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">درس</label>
              <div class="col-sm-10">
                <input type="number"  name="chapter" class="form-control" id="input3">
              </div>
            </div>
         
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">مثال انگلیسی</label>
              <div class="col-sm-10">
                <input type="text"  name="example" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی</label>
                <div class="col-sm-10">
                  <input type="text"  name="example_trs" class="form-control">
                </div>
            </div>



            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"> مثال انگلیسی دوم</label>
              <div class="col-sm-10">
                <input type="text"  name="example2" class="form-control" dir="ltr">
              </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">مثال فارسی دوم</label>
                <div class="col-sm-10">
                  <input type="text"  name="example_trs2" class="form-control">
                </div>
            </div>


            
            <button type="submit" class="btn btn-primary">افزودن</button>
          </form>


      @include('layout.footer')

    </div>


   
  

</body>
</html>