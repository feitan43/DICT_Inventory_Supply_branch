@extends('admin.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body style="background: #11101d;" onLoad="renderTime();">
<div class="container-fluid dashboard-section " >
    <!-- Breadcrumb navigation -->
    
    
    <br>
    <h2 style="color:black; font-size:25px">  <i class='bx bx-grid-alt' ></i> Dashboard</h2>
    <br>
    <ol class="breadcrumb" style="font-size: 15px">
        <li class="breadcrumb-item"><a href="{{ route('adminHome') }}" style="color:black">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"  style="color:black">Dashboard</li>
    </ol>

   


    <!-- Card container -->
    <div class="card-container">
        <!-- Card: Total Members -->
        <a class="card" href="{{ route('users.index') }}" style="text-decoration:none">
        
            
            <i class="bi bi-people" style="font-size: 2rem;"></i>
            <h3 class="text-center">Total Members</h3><br>
            <h2>{{ $admins->count() }}</h2>
            
         </a>
        

        <!-- Card: Total Product Category -->
        <a class="card"  href="{{ route('category.index') }}" style="text-decoration:none">
            <i class="bi bi-folder" style="font-size: 2rem;"></i>
            <h3 class="text-center">Total Category</h3>
            <h2>{{ $categories->count() }}</h2>
</a>

        <!-- Card: Total Products -->
        <a class="card"  href="{{ route('products.index') }}" style="text-decoration:none" >
            <i class="bi bi-bag" style=" font-size: 2rem;"></i>
            <h3 class="text-center">Total Products</h3><br>
            <h2>{{ $products->count() }}</h2>
</a>

        <!-- Card: Total Stock -->
        <a class="card"  href="{{ route('products.index') }}" style="text-decoration:none"  >
            <i class="bi bi-graph-up" style="font-size: 2rem;"></i>
            <h3 class="text-center">Total Stock</h3><br>
            <h2>{{ $productQuantity }}</h2>
</a>
    </div>
    
</div>
</body>
<style>
    
    .dashboard-section {
        background-color:#eae9f3;
        
 /*   background-color: #272543; */
    height: 90vh;
    color:black;
    width: 97%;
}

.dashboard-section {
position: relative;
    z-index: 1; 
    border-radius: 15px
}


/* Custom styling for the card layout */
.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 50px;
}

.card {
    font-family: 'Poppins', sans-serif;
    flex-basis: calc(25% - 20px);
    height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
    background-color: #fff;
    margin-bottom: 50px;
    background-color: #d2d0e5;
}

.card:hover {
    transform: translateY(-10px);
}
#clockDisplay {
  font-size: 20px;
  color: #272543;
}
</style>

<script> 

function renderTime() {
  // Date
  var mydate = new Date();
  var year = mydate.getYear();
  if (year < 1000) {
    year += 1900;
  }
  var day = mydate.getDay();
  var month = mydate.getMonth();
  var daym = mydate.getDate();
  var dayarray = new Array(
    "Sunday,",
    "Monday,",
    "Tuesday,",
    "Wednesday,",
    "Thursday,",
    "Friday,",
    "Saturday,"
  );
  var montharray = new Array(
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
  );
  //Date End

  //Time
  var currentTime = new Date();
  var h = currentTime.getHours();
  var m = currentTime.getMinutes();
  var s = currentTime.getSeconds();
  if (h == 24) {
    h = 0;
  } else if (h > 12) {
    h = h - 0;
  }

  if (h < 10) {
    h = "0" + h;
  }

  if (m < 10) {
    m = "0" + m;
  }

  if (s < 10) {
    s = "0" + s;
  }

  var myClock = document.getElementById("clockDisplay");
  myClock.textContent =
    "" +
    dayarray[day] +
    " " +
    daym +
    " " +
    montharray[month] +
    " " +
    year +
    " | " +
    h +
    ":" +
    m +
    ":" +
    s;
  myClock.innerText =
    "" +
    dayarray[day] +
    " " +
    daym +
    " " +
    montharray[month] +
    " " +
    year +
    " | " +
    h +
    ":" +
    m +
    ":" +
    s;

    myClock.style.fontSize = "15px"; // Set the font size to 20 pixels


  setTimeout("renderTime()", 1000);
}
renderTime();


</script>

@endsection
