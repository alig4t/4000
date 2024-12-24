@include('layout.meta')

<head>
    <title>4000 واژه ضروری انگلیسی</title>
  </head>

  @include('layout.header')

  <body>



    <div class="pricing-header px-3 py-3 pt-5 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">لیست افعال دو کلمه ای</h1>
      <p class="lead">
        لیست  افعال دو کلمه ای از کتاب معروف Phrasal Verbs in use  در اینجا گردآوری شده است. این کتاب دارای 21 جلد می باشد
         که هر واژه شامل معنی ، تعریف و مثال به هر دو زبان فارسی و انگلیسی می باشد. برای دسترسی به واژگان یک جلد خاص از فیلترها استفاده نمایید.
        </p>
    </div>

    <div class="p-3">
    <div class="container border rounded p-4 mb-5 box-shadow shadow-sm" style="background-color: rgba(74, 161, 150, 0.732);border-color:#e5d8b3; border-bottom:3px solid #cfaf3a !important">

      <form method="GET" action="/phrasal-verbs">
        <div class="form row">
          <div class="form-group col-md-3 text-right mb-2">
            <label for="inputCity" class="">انتخاب جلد</label>
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
          <div class="form-group col-md-3 text-right mb-2">
            <label for="inputState">واژگانی که:</label>
            <select id="inputState" name="test_tik" class="form-control">
              <option value="all" {{($params['test_tik'] == 'all') ? 'selected' : ''}}>همه حالت</option>
              <option value="0"   {{($params['test_tik'] == '0') ? 'selected' : ''}}>بلدم</option>
              <option value="1"   {{($params['test_tik'] == '1') ? 'selected' : ''}}>بلد نبودم</option>
            </select>
          </div>
          <div class="form-group col-md-3 text-right mb-2">
            <label for="inputZip">جهت خواندن:</label>
            <select id="inputZip" name="direction" class="form-control">
              <option value="0" {{($params['direction'] == '0') ? 'selected' : ''}}>انگلیسی به فارسی</option>
              <option value="1" {{($params['direction'] == '1') ? 'selected' : ''}}>فارسی به انگلیسی</option>
            </select>
          </div>
          <div class="form-group col-md-3 text-right mb-2">
            <label for="inputZip">ترتیب:</label>
            <select id="inputZip" name="orderby" class="form-control">
              <option value="id" {{($params['orderby'] == 'id') ? 'selected' : ''}}>شماره کم به زیاد </option>
              <option value="idr" {{($params['orderby'] == 'idr') ? 'selected' : ''}}>شماره زیاد به کم</option>
              <option value="eng" {{($params['orderby'] == 'eng') ? 'selected' : ''}}>الفبای انگلیسی</option>
              <option value="per" {{($params['orderby'] == 'per') ? 'selected' : ''}}>الفبای فارسی</option>
              <!-- <option value="rand" {{($params['orderby'] == 'rand') ? 'selected' : ''}}>رندوم</option> -->
            </select>
          </div>
          <div class="form-group col-md-12 mt-4  d-md-flex">
            <label for="inputZip">
              {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
              </svg>  --}}
            </label>
              <a href="{{ route('phrasal.add') }}" class="d-none d-md-flex justify-content-end text-decoration-none">
             <button type="button" class="btn w-100 ms-5 btn-warning">افزودن عبارت جدید</button>
            </a>
            <button type="submit" class="btn btn-light change-params-btn flex-fill">اعمال</button>

          </div>
        </div>
        
      </form>

    

    </div>
  </div>
 




    <div class="container">
      <div class="w-100 text-start my-3 text-success">
        تعداد نتایج : {{$words->total()}}
      </div>
      <table class="table table-responsive">
        <thead>
          <tr>
            <th scope="col">#</th>
            
            @if($params['direction'] == '0')
            <th scope="col">English</th>
            <th scope="col"></th>
            <th scope="col">Persion</th>
            @else
            <th scope="col">Persion</th>
            <th scope="col">English</th>
            @endif
        
   
            <th scope="col" class="hiddenable-cell">chapter</th>
            <th scope="col">Status</th>
            <th scope="col" class="hiddenable-cell">operate</th>
          </tr>
        </thead>
        <tbody>
          @foreach($words as $index=>$word)
          <tr>
            <th scope="row">{{$index+1}}</th>

            @if($params['direction'] == '0')
            <td>
             
              {{$word->eng}}
            
             
            </td>
            <td>
              <img src="img/icons8-speaker-64.png" width="18px" class="ms-2"  onclick="spoken.say('{{$word->eng}}')" />
              
            </td>
            <td class="hideword">
              <a class="w-100 btn" type="button" data-bs-toggle="collapse" href="#collapseWord{{$index}}" aria-expanded="false" aria-controls="collapseWord{{$index}}"
              onclick="showTag(this)"
              >
                {{$word->per}}
            </a>
              </td>
            @else
            <td>{{$word->per}}</td>
            <td class="hideword">
            <a class="w-100 btn" type="button" data-bs-toggle="collapse" href="#collapseWord{{$index}}" aria-expanded="false" aria-controls="collapseWord{{$index}}"
              onclick="showTag(this)"
              >  
            {{$word->eng}}
              </a>
          </td>
            @endif

        

            <td class="hiddenable-cell">{{$word->chapter}}</td>
            <td class="can">
              
              @if($params['direction'] == 0)
              @if($word->eng_check == 1)
                <span class="badge text-bg-danger" onclick="changeStatus(this,{{$word->id}},1,'en')">بلد نیستم</span>
              @else
              <span class="badge text-bg-success" onclick="changeStatus(this,{{$word->id}},0,'en')">بلدم</span>
              @endif

          @else

          @if($word->per_check == 1)
          <span class="badge text-bg-danger" onclick="changeStatus(this,{{$word->id}},1,'fa')">بلد نیستم</span>
          @else
          <span class="badge text-bg-success" onclick="changeStatus(this,{{$word->id}},0,'fa')">بلدم</span>
          @endif

          @endif
            </td>
            <td class="hiddenable-cell">
              
              <a href="/words/{{$word->id}}/edit" class="operate">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                  <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                  <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                </svg>
              </a>
            </td>

          </tr>


          <tr>
            <td colspan="15" style="padding: 0 !important;">
              <div class="collapse" id="collapseWord{{$index}}">

                <div class="w-100 word-info">


                  <div class="mb-3 d-lg-none">
                  <div class="w-100 infobox">
                    <span class="badge text-bg-warning">توضیح واژه :</span>
                    <div class="wo-edit-btn">
                    
                      <a href="/words/{{$word->id}}/edit" class="operate wo-edit-btn">
                        <p> ویرایش واژه</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                          <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                          <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                        </svg>
                      </a>
                    </div>
                    
                  </div>
                  <div class="section-box">
                      <p class="col-12 text-start" dir="ltr"> {{$word->description}}</p>
                  </div>
                  </div>

                  <div class="my-1">
                    <div class="w-100 infobox">
                      <span class="badge text-bg-warning">مثال :</span>
                    </div>
                    <div class="section-box">
                      <div class="row m-0" dir="ltr">
                        <p class="col-12 col-md-6 text-start" > {{$word->example}}</p>
                        <p class="col-12 col-md-6" dir="rtl"> {{$word->example_trs}}</p>
                      </div>
                  </div>
                </div>
                
                <div class="my-1">
                    <div class="w-100 infobox">
                      <span class="badge text-bg-warning">مثال دوم :</span>
                    </div>
                    <div class="section-box">
                      <div class="row m-0" dir="ltr">
                        <p class="col-12 col-md-6 text-start" > {{$word->example2}}</p>
                        <p class="col-12 col-md-6" dir="rtl"> {{$word->example_trs2}}</p>
                      </div>
                  </div>
                </div>


                </div>
                
              </div> 
            </td>
          </tr>


          @endforeach          
        </tbody>
      </table>
    </div>


    <div class="container">
      

      <div class="wo-pagination">
    
        {{ $words->onEachSide(1)->appends($_GET)->links() }}
       
      </div>

      @include('layout.footer')


    </div>




    <script>
    
      // alert('ss');
      function changeStatus(tag,id,tik,dir){
        console.log(tag);
        axios.post('/phrasal/'+ id +'/tik/'+ dir).then( resp =>{

           console.log(resp.data);
           if(resp.data['status'] == 0){
                      
             tag.outerHTML = '<span class="badge text-bg-success" onclick="changeStatus(this,'+ id +',0)">بلدم</span>';
           }else{
            tag.outerHTML = '<span class="badge text-bg-danger" onclick="changeStatus(this,'+ id +',1)">بلد نیستم</span>';
           }

           
        });
        // $.post('/words/{'+ id +'}/tik', {category:'client', type:'premium'});
      }


      
      function showTag(tag){
        tag.parentElement.classList.toggle("showword");
      
        // console.log(tag.parentElement.nextSibling.nextSibling);
        // let nextTr = tag.parentElement.nextSibling.nextSibling;
        // tag.className = 'showword';
        // nextTr.classList.remove('hiderow');
        // nextTr.classList.add('showword');
  
      }

    </script>

    


    

</body>
</html>