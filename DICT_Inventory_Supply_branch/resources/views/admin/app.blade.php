
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>DICT Supply Management System</title>
  <link rel="icon" type="images/x-icon" href="{{asset('images/DICT-Logo.png')}}" />

  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DICT Supply Management System</title>
    <link rel="icon" type="images/x-icon" href="{{asset('images/DICT-Logo.png')}}" />
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css">
  
    <!-- Select2 CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css">
  
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
  
    <!-- Poppins Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
  
    <!-- Core Theme CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
  
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.0/js/buttons.print.min.js"></script>
  
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
  
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
  
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/741560515d.js" crossorigin="anonymous"></script>
  
    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.4/axios.min.js" integrity="sha512-lTLt+W7MrmDfKam+r3D2LURu0F47a3QaW5nF0c6Hl0JDZ57ruei+ovbg7BrZ+0bjVJ5YgzsAWE+RreERbpPE1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
    <!-- Core Theme JS -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
  </head>
  


<body onLoad="renderTime();">

    <nav class="navbar navbar-expand-lg navbar-light w-100" style="background: #11101d; ">
        <div class="container-fluid">
        <div id="clockDisplay" style="margin-left: 20.5%; color:white;"></div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          
                <ul class="navbar-nav">
                
                    <li class="nav-item ">
                        <a class="nav-link dash-section red-link" href="{{ route('adminHome') }}" style="color:white" >
                            {{ __('adminHome.home') }}
                           
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('products.index') }}" style="color:white">{{ __('Items') }}</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('category.index') }}" style="color:white">{{ __('Category') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    </nav>
    
    <script>
        function toggleFullscreen() {
            if (document.fullscreenElement) {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            } else {
                const element = document.documentElement;
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                }
            }
        }
    </script>
    
  <div class="sidebar open">
    
    <div class="logo-details">
      <a href="#" id="btn"><i class="bx bx-menu"></i></a>
      <span class="logo_name">DICT Supply</span>
      
    </div>
    <ul class="nav-links">
      <li class="{{ Request::is('admin*') ? 'active' : '' }}">
        <a href="{{ route('adminHome') }}">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span> 
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ route('adminHome') }}">Dashboard</a></li>
        </ul>
      </li>
  
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Supply Management</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">

          <li style="margin-top:5%"><a href="{{ route('products.index') }}">Items</a></li>
          <li><a href="{{ route('category.index') }}">Categories</a></li>
         <!-- <li><a href="{{ route('log_transactions.index') }}">Product Adjustments</a></li> -->
         <li><a href="{{ route('unit_of_measures.index') }}">Unit of Measure</a></li>
          </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="bi bi-people"></i> 
            <span class="link_name">Suppliers</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li style="margin-top:5%"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
         
          </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="bi bi-cash"></i>
            <span class="link_name">Withdrawal</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Withdrawal</a></li>
          <li><a href="{{ route('withdrawals.index') }}">Withdrawal</a></li>
          <li><a href="{{ route('withdrawals.create') }}">Create Withdrawal</a></li>
          </ul>
      </li>


<!----
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="bi bi-bar-chart"></i>
            <span class="link_name">Reports</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Reports</a></li>
          <li><a href="{{ route('reports.index') }}">Reports</a></li>
          </ul>
      </li>


    -->
  <!--    <li>
      
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Inventory</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Inventory Monitoring</a></li>
          <li><a href="#">Stocks</a></li>
          <li><a href="#">Stocks Report</a></li>
        </ul>
      </li> -->
      <li class="{{ Request::is('activity-log*') ? 'active' : '' }}">
        @can('recent_login-list')
        <a href="{{ route('activity-log.index') }}">
          <i class='bx bx-history'></i>
          <span class="link_name">Login History</span>
        </a>
       @endcan
      </li>
      <li >
        <div class="iocn-link">
          <a href="#">
          <i class='bx bx-cog' ></i></i>
            <span class="link_name">Settings</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          @can('user-list')
          <li><a href="{{ route('users.index') }}">  User Management</a></li>
          @endcan
          @can('role-management')
          <li><a href="{{ route('roles.index') }}">Role Management</a></li>
          @endcan
          <li><a href="{{ route('change-password.form') }}">Change Password</a></li>
        </ul>
      </li>
      <li>
        
    <div class="profile-details">
    <!--  <div class="profile-content">
        <img src="image/profile.jpg" alt="profileImg">
      </div> --> &nbsp
      <div class="name-job">
        <div class="profile_name"> {{ auth()->user()->name }} </div>
        <div class="job"> @if(isset($role))
    <p>Role: {{ $role->name }}</p>
@endif</div>
      </div>
     <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"> <i class='bx bx-log-out' ></i> </a>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section" >
      @yield('content')
    </div>
  </section>
<script>
   let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e)=>{
     let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
     arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    //console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("close");
    });

    document.addEventListener("DOMContentLoaded", function() {
      const sidebar = document.querySelector(".sidebar");
      const closeBtn = document.querySelector("#btn");
      const logo = document.querySelector(".logo");
  
      closeBtn.addEventListener("click", function() {
        sidebar.classList.toggle("open");
        menuBtnChange();
      });
  
      function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
          closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else {
          closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
      }
    });
  </script>
</body>

<style>
/* Google Fonts Import Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  
}

.sidebar{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 279px;
  background: #11101d;
  z-index: 100;
  transition: all 0.5s ease;
}
.sidebar.close{
  width: 78px;
}
.sidebar .logo-details{
  height: 60px;
  width: 100%;
  display: flex;
  align-items: center;
}
.sidebar .logo-details i{
  font-size: 30px;
  color: #fff;
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
}
.sidebar .logo-details .logo_name{
  font-size: 18px;
  color: #fff;
  font-weight: 600;
  transition: 0.3s ease;
  transition-delay: 0.1s;
}
.sidebar.close .logo-details .logo_name{
  transition-delay: 0s;
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links{
  height: 100%;
  padding: 30px 0 150px 0;
  overflow: auto;
}
.sidebar.close .nav-links{
  overflow: visible;
}
.sidebar .nav-links::-webkit-scrollbar{
  display: none;
}
.sidebar .nav-links li{
  position: relative;
  list-style: none;
  transition: all 0.4s ease;
}
.sidebar li:hover{
  background: #11101d;
}

.sidebar li:hover .link_name,
.sidebar li:hover i, .sidebar ul li:hover {
  color: light blue !important; /* Set the text and icon color to black on hover */
  
    font-size-adjust: 8px;
    transition: all 500ms;

}

.sidebar .nav-links li .iocn-link{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.sidebar.close .nav-links li .iocn-link{
  display: block
}
.sidebar .nav-links li i{
  height: 50px;
  min-width: 78px;
  text-align: center;
  line-height: 50px;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
}
.sidebar .nav-links li.showMenu i.arrow{
  transform: rotate(-180deg);
}
.sidebar.close .nav-links i.arrow{
  display: none;
}
.sidebar .nav-links li a{
  display: flex;
  align-items: center;
  text-decoration: none;
}
.sidebar .nav-links li a .link_name{
  font-size: 15px;
  font-weight: 500;
  color: #fff;
  transition: all 0.4s ease;
}
.sidebar.close .nav-links li a .link_name{
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links li .sub-menu{
  padding: 6px 6px 14px 80px;
  margin-top: -10px;
  
  display: none;
}
.sidebar .nav-links li.showMenu .sub-menu{
  display: block;
}
.sidebar .nav-links li .sub-menu a{
  color: #fff;
  font-size: 13px;
  padding: 5px 0;
  white-space: nowrap;
  opacity: 0.6;
  transition: all 0.3s ease;
}
.sidebar .nav-links li .sub-menu a:hover{
  opacity: 1;
}
.sidebar.close .nav-links li .sub-menu{
  position: absolute;
  left: 100%;
  top: -10px;
  margin-top: 0;
  padding: 10px 20px;
  border-radius: 0 6px 6px 0;
  opacity: 0;
  display: block;
  pointer-events: none;
  transition: 0s;
}
.sidebar.close .nav-links li:hover .sub-menu{
  top: 0;
  opacity: 1;
  pointer-events: auto;
  transition: all 0.4s ease;
}
.sidebar .nav-links li .sub-menu .link_name{
  display: none;
}
.sidebar.close .nav-links li .sub-menu .link_name{
  font-size: 13px;
  opacity: 1;
  display: block;
}
.sidebar .nav-links li .sub-menu.blank{
  opacity: 1;
  pointer-events: auto;
  padding: 3px 20px 6px 16px;
  opacity: 0;
  pointer-events: none;
}
.sidebar .nav-links li:hover .sub-menu.blank{
  top: 50%;
  transform: translateY(-50%);
}
.sidebar .profile-details{
  position: fixed;
  bottom: 0;
  width: 278px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border: 1px white;
border-style: solid none;
  padding: 12px 0;
  transition: all 0.5s ease;
}
.sidebar.close .profile-details{
  background: none;
}
.sidebar.close .profile-details{
  width: 78px;
}
.sidebar .profile-details .profile-content{
  display: flex;
  align-items: center;
}
.sidebar .profile-details img{
  height: 52px;
  width: 52px;
  object-fit: cover;
  border-radius: 16px;
  margin: 0 14px 0 12px;
  background: #1d1b31;
  transition: all 0.5s ease;
}
.sidebar.close .profile-details img{
  padding: 10px;
}
.sidebar .profile-details .profile_name,
.sidebar .profile-details .job{
  color: #fff;
  font-size: 13px;
  font-weight: 500;
  white-space: nowrap;
}
.sidebar.close .profile-details i,
.sidebar.close .profile-details .profile_name,
.sidebar.close .profile-details .job{
  display: none;
}
.sidebar .profile-details .job{
  font-size: 12px;
}
.home-section{
  position: relative;
  background: #11101d;
  height: 100%;
  left: 260px;
  width: calc(100% - 260px);
  transition: all 0.5s ease;

  
}
.sidebar.close ~ .home-section{
  left: 78px;
  width: calc(100% - 78px);
}
.home-section .home-content{
  height: 60px;
  display: flex;
  align-items: center;
  margin-left: 100px;
}
.home-section .home-content .bx-menu,
.home-section .home-content .text{
  color: #11101d;
  font-size: 35px;
}
.home-section .home-content .bx-menu{
  margin: 0 15px;
  cursor: pointer;
}
.home-section .home-content .text{
  font-size: 26px;
  font-weight: 600;
}
.home-section{
  position: relative;
}
@media (max-width: 400px) {
  .sidebar.close .nav-links li .sub-menu{
    display: none;
  }
  .sidebar{
    width: 78px;
  }
  .sidebar.close{
    width: 0;
  }
  .home-section{
    left: 78px;
    width: calc(100% - 78px);
    z-index: 100;
  }
  .sidebar.close ~ .home-section{
    width: 100%;
    left: 0;
  }
}
/**/
.hide-text {
  text-indent: -9999px;
  overflow: hidden;
  display: block;
}
.fullscreen-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Set the container height to the full viewport height */
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  font-size: 13px;
  position: relative;

}

nav ul li a::after {
  content: "";
  width: 0;
  height: 3px;
  background: #f6f6fa;
  position: absolute;
  left: 0;
  bottom: 2px;
  transition: 0.5s;
}
nav ul li a:hover::after {
  width: 100%;
}

.sidebar li.active {
  background-color: #eae9f3; /* Change this to the desired background color */
}
.sidebar li.active .link_name {
  color: black  !important; /* Set the text color to black */
}

.sidebar li.active i {
  color: black; /* Set the icon color to black */
}
.sidebar li {
  border-top-left-radius: 10px; /* Set the desired border radius value for the top left corner */
  border-bottom-left-radius: 10px; /* Set the desired border radius value for the bottom left corner */
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

</html>
