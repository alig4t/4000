<!DOCTYPE html>

    <title>4000 واژه ضروری انگلیسی | جستجو</title>

    @include('layout.meta')

    <style>            
        .results tr[visible='false'],
        .no-result{
          display:none;
        }
        .results tr[visible='true']{
          display:table-row;
        }
        .counter{
          padding:8px; 
          color:#ccc;
        }
        .search{
          /* color: #fff; */
        }
        .search::placeholder{
          color: rgb(120, 116, 116);
          text-align: center;
        }
    </style>

  </head>


  <body>

    @include('layout.header')

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">جستجو</h1>
      <p class="lead">
        شما میتوانید به راحتی واژه مورد نظر را جستجو نمایید و معنی یا مترادف های آن را متوجه شوید.
      </p>
    
      <div class="form-outline">
        <input type="text" id="searchword" class="search form-control mt-4 mb-4" placeholder=" دنبال کدوم واژه میگردی؟ تایپش کن.." dir="rtl">
        <span class="counter pull-right mt-2 mb-2"></span>
      </div>

      <a href="{{ route('phrasal.add') }}" class="d-none d-md-flex align-items-left text-decoration-none">
      <button type="submit" class="btn w-25 btn-success">افزودن</button>
      </a>


    </div>


    <div class="container">
      
      <table class="table table-hover table-responsive results">
        <thead>
          <tr>
            
            <th scope="col" class="font11">English</th>
            <th scope="col" class="font11">Persion</th>
        
            <th scope="col" class="font9">Example</th>
            <th scope="col" class="font9">translate</th>
            <th scope="col" class="hiddenable-cell">Chapter</th>
            <th scope="col" class="hiddenable-cell">unit</th>
            <th scope="col" class="hiddenable-cell">operate</th>

          </tr>
          <tr class="warning no-result">
            <td colspan="7"><i class="fa fa-warning"></i> No result</td>
          </tr>
        </thead>
        <tbody>
          @foreach($phrasalVerbs as $word)
          <tr>
              
              <td class="font11">{{$word->eng}}</td>
              <td class="font11">{{$word->per}}</td>
          
              <td class="font9">{{$word->example}}</td>
              <td class="font9">{{$word->example_trs}}</td>
              <td class="hiddenable-cell">{{$word->chapter}}</td>
              <td class="hiddenable-cell">{{$word->unit}}</td>
              <td class="hiddenable-cell">
                <a href="/phrasal/{{$word->id}}/edit" class="operate">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                    <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                    <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                  </svg>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

   
      @include('layout.footer')


    </div>


  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
      
      
<script>
      function searchword(tag){
        console.log(tag);
      }

              $(document).ready(function() {
          $(".search").keyup(function () {
            console.log("ss");
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
            
          $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
          });
            
          $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
          });

          $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
          });

          var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

          if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
              });
        });
    </script>
  

</body>
</html>