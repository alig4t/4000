
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 font-weight-normal mynav">
      <a href="/" class="brandlink">
      <span>4000</span> 
      واژه ضروری انگلیسی  
    </a>
    </h5>
    <!-- <nav class="my-2 my-md-0 mr-md-3">

       <a class="p-2 text-dark" href="/search">جستجو واژه</a> 

    </nav> -->
    <a class="btn btn-outline-danger" href="/search">جستجو واژه</a>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    خروج
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
  </div>


