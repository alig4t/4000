<!DOCTYPE html>
   
    <title>4000 واژه ضروری انگلیسی</title>
    @include('layout.meta')

  </head>

  <body>

    @include('layout.menu')


    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">لیست لغات</h1>
      <p class="lead">
        لیست 4000 واژه ضروری انگلیسی در اینجا محیا شده است. این کتاب دارای 6 جلد می باشد
         که هر واژه شامل معنی ، تعریف و مثال به هر دو زبان فارسی و انگلیسی می باشد. برای دسترسی به واژگان یک جلد خاص از فیلترها استفاده نمایید.
        </p>
    </div>

    <div class="container border rounded bg-info p-4 mb-5">

      <form method="GET" action="/">
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="inputCity">انتخاب جلد</label>
            {{-- <input type="text" class="form-control" id="inputCity"> --}}
            <select id="inputCity" name="chapter" class="form-control">
              <option value="all" {{($params['chapter'] == 'all') ? 'selected' : ''}}>همه جلدها</option>
              <option value="1" {{($params['chapter'] == "1") ? 'selected' : ''}}>جلد یک</option>
              <option value="2" {{($params['chapter'] == "2") ? 'selected' : ''}}>جلد دوم</option>
              <option value="3" {{($params['chapter'] == "3") ? 'selected' : ''}}>جلد سوم</option>
              <option value="4" {{($params['chapter'] == "4") ? 'selected' : ''}}>جلد چهارم</option>
              <option value="5" {{($params['chapter'] == "5") ? 'selected' : ''}}>جلد پنجم</option>
              <option value="6" {{($params['chapter'] == "6") ? 'selected' : ''}}>جلد ششم</option>

            </select>
          </div>
          {{-- {{dd($params['test_tik'])}} --}}
          <div class="form-group col-md-3">
            <label for="inputState">واژگانی که:</label>
            <select id="inputState" name="test_tik" class="form-control">
              <option value="all" {{($params['test_tik'] == 'all') ? 'selected' : ''}}>همه حالت</option>
              <option value="0"   {{($params['test_tik'] == '0') ? 'selected' : ''}}>بلدم</option>
              <option value="1"   {{($params['test_tik'] == '1') ? 'selected' : ''}}>بلد نبودم</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="inputZip">جهت خواندن:</label>
            <select id="inputZip" name="direction" class="form-control">
              <option value="0" {{($params['direction'] == '0') ? 'selected' : ''}}>انگلیسی به فارسی</option>
              <option value="1" {{($params['direction'] == '1') ? 'selected' : ''}}>فارسی به انگلیسی</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="inputZip">ترتیب:</label>
            <select id="inputZip" name="orderby" class="form-control">
              <option value="id" {{($params['orderby'] == 'id') ? 'selected' : ''}}>شماره کم به زیاد </option>
              <option value="idr" {{($params['orderby'] == 'idr') ? 'selected' : ''}}>شماره زیاد به کم</option>
              <option value="eng" {{($params['orderby'] == 'eng') ? 'selected' : ''}}>الفبای انگلیسی</option>
              <option value="per" {{($params['orderby'] == 'per') ? 'selected' : ''}}>الفبای فارسی</option>
              <option value="rand" {{($params['orderby'] == 'rand') ? 'selected' : ''}}>رندوم</option>
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="inputZip">
              {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
              </svg>  --}}
            </label>
            <button type="submit" class="btn btn-danger w-100">اعمال</button>

          </div>
        </div>
        
      </form>

    </div>

    <div class="container">
      <div class="card-deck mb-3 text-center">
        <table class="table table-hover">
            <thead>
              <tr>
                <td colspan="10" class="text-left text-success border-0">

                  تعداد نتایج : {{$words->total()}}
                </td>

              </tr>
              <tr>
                <th scope="col">#</th>
                <th scope="col">English</th>
                <th scope="col">Persion</th>
                <th scope="col">Description</th>
                {{-- <th scope="col" colspan="3">Example + Trs</th> --}}
                {{-- <th scope="col">Translate</th> --}}
                <th scope="col">Chapter</th>
                <th scope="col">unit</th>
                <th scope="col">Status</th>
                <th scope="col">operate</th>


              </tr>
            </thead>
            <tbody>
                @foreach($words as $index=>$word)
                <tr>
                    <th class="align-middle text-center" scope="row">{{$index+1}}</th>
                    <td class="align-middle text-center">{{$word->eng}}</td>
                    <td class="align-middle text-center hideword" onclick="show(this)">{{$word->per}}</td>
                    <td class="align-middle text-center">{{$word->description}}</td>
                    {{-- <td class="align-middle text-center" colspan="3">{{$word->example}} <br> {{$word->example_trs}}</td> --}}
                    {{-- <td class="align-middle text-center">{{$word->example_trs}}</td> --}}
                    <td class="align-middle text-center">{{$word->chapter}}</td>
                    <td class="align-middle text-center">{{$word->unit}}</td>
                    <td class="align-middle text-center can">
                    
                      @if($params['direction'] == 0)
                          @if($word->eng_check == 1)
                            <span class="badge badge-danger" onclick="changeStatus(this,{{$word->id}},1,'en')">بلد نیستم</span>
                          @else
                          <span class="badge badge-success" onclick="changeStatus(this,{{$word->id}},0,'en')">بلدم</span>
                          @endif

                      @else

                      @if($word->per_check == 1)
                      <span class="badge badge-danger" onclick="changeStatus(this,{{$word->id}},1,'fa')">بلد نیستم</span>
                      @else
                      <span class="badge badge-success" onclick="changeStatus(this,{{$word->id}},0,'fa')">بلدم</span>
                      @endif

                      @endif

                    </td>

                    <td class="align-middle text-center">
                      <a href="/words/{{$word->id}}/edit" class="operate">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                          <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                          <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                        </svg>
                      </a>
                    </td>

                    {{-- <td> --}}
                      {{-- <tr> --}}
                        
                      {{-- </tr> --}}
                    {{-- </td> --}}


                  </tr>

                  <tr class="bg-info text-light hiderow">
                    <td colspan="3">
                      <p class="text-right">{{$word->example_trs}}</p>
                   </td>
                   <td colspan="5">
                      <p class="text-left">{{$word->example}}</p>
                   </td>
                  </tr>
                  
                 
                @endforeach
            </tbody>
          </table>

          {{-- <nav aria-label="Page navigation example">
            <ul class="pagination">
                {!! $words->links() !!}
            </ul>
          </nav> --}}

         

          {{-- {!! $words->links() !!} --}}

      </div>

      <div class="d-flex justify-content-center">
        {{-- {!! $words->links() !!} --}}

        {{ $words->appends($_GET)->links() }}

      </div>



      @include('layout.footer')

    </div>
    <script src="js/app.js"></script>



    <script>
      // alert('ss');
      function changeStatus(tag,id,tik,dir){
        console.log(tag);
        axios.post('/words/'+ id +'/tik/'+ dir).then( resp =>{

           console.log(resp.data);
           if(resp.data['status'] == 0){
                      
             tag.outerHTML = '<span class="badge badge-success" onclick="changeStatus(this,'+ id +',0)">بلدم</span>';
           }else{
            tag.outerHTML = '<span class="badge badge-danger" onclick="changeStatus(this,'+ id +',1)">بلد نیستم</span>';
           }

           
        });
        // $.post('/words/{'+ id +'}/tik', {category:'client', type:'premium'});
      }


      
      function show(tag){

        // console.log(tag.parentElement.nextSibling.nextSibling);
        let nextTr = tag.parentElement.nextSibling.nextSibling;
        tag.className = 'showword';
        nextTr.classList.remove('hiderow');
        nextTr.classList.add('showword');
      }


    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
  

</body>
</html>