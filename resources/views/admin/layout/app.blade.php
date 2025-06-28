<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Al Mairaaj</title>
    <link rel="icon" type="image/png" href="{{ asset('build/assets/book_logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 75px;
            min-width: 75px;
            z-index: 1000;
            transition: all 0.62s ease-in-out;
            background-color: #000000;
            display: flex;
            flex-direction: column;  
            max-height: 100vh;      
            overflow-y: auto;
            overflow-x: hidden;
        }


        #sidebar.expand  {
            width: 300px;
            min-width: 300px;
        }

        #sidebar.expand ~ .main {
            margin-left: 260px;
        }

        .main {
            flex: 1;
            background-color: #fafbfe;
            padding: 20px;
            margin-left: 5px;
            transition: all 0.35s ease-in-out;
            min-height: calc(100vh - 60px);
        }

        #sidebar.expand ~ .main {
            margin-left: 260px;
        }

        .toggle-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-btn i {
            font-size: 1.5rem;
            color: #FFF;
        }

        .sidebar-logo {
            margin: auto 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFF;
        }

        #sidebar-heading{
            margin-top: 13px;
            font-size: 25px;
        }

        .sidebar-logo a {
            color: #FFF;
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }

        .sidebar-nav {
            padding: 2rem 0;
            flex: 1;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #FFF;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
            text-decoration: none;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            margin-right: .75rem;
        }

        a.sidebar-link:hover {
            background-color: rgba(255, 255, 255, .075);
            border-left: 3px solid #008080;
        }

        .sidebar-item {
            position: relative; 
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
            position: absolute;
            top: 0;
            left: 70px;
            background-color: #00000;
            padding: 0;
            min-width: 15rem;
            display: none;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 .075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }
        .sidebar-footer form {
            display: block;
            width: 100%;
        }

        .sidebar-footer button.sidebar-link {
            padding: .625rem 1.625rem;
            color: #FFF;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
            cursor: pointer;
        }
        #sidebar:not(.expand) .sidebar-footer span {
            display: none;
        }

        .sidebar-footer button.sidebar-link:hover {
            padding: .625rem 1.625rem;
            color: #FFF;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
            cursor: pointer;
            width: 100%;
            text-align: left;
            background: transparent;
            border: 0;
        } 
        .sidebar-dropdown .sidebar-item {
            padding-left: 20px; 
        }

        .sidebar-dropdown .sidebar-dropdown .sidebar-item {
            padding-left: 30px; 
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .main{
                margin-left: 45px;
            }
            #sidebar {
                width: 0;
            }

            #sidebar.expand {
                width: 200px;
            }
        }
        .form-control:focus,
        .form-control:hover {
            border-color: black !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 128, 128, 0.52) !important;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <img src="{{ asset('build/assets/book_logo.png') }}" alt="Icon" style="width: 36px; height: 36px;" class="ms-2">
                </button>
                <div class="sidebar-logo">
                    <a id="sidebar-heading">
                        <img src="{{ asset('build/assets/AlMairaaj_logo.png') }}" alt="Al Mairaaj Logo" style="width: 210px; height: 56px;" class="mt-2">
                    </a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="bi bi-clipboard-data fs-4"></i>
                        <span class="fs-6">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.student') }}" class="sidebar-link">
                        <i class="bi bi-person fs-4"></i>
                        <span class="fs-6">Student</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.teacher') }}" class="sidebar-link">
                        <i class="bi bi-person-vcard fs-4"></i>
                        <span class="fs-6">Teacher</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#studyMaterial" aria-expanded="false" aria-controls="studyMaterial">
                        <i class="bi bi-backpack fs-4"></i>
                        <span class="fs-6">Study Material</span>
                    </a>

                    <ul id="studyMaterial" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        
                        <!-- Pearson Dropdown -->
                        <li class="sidebar-item">
                            <a class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                                data-bs-target="#pearsonDropdown" aria-expanded="false" aria-controls="pearsonDropdown">
                                Pearson
                            </a>
                            <ul id="pearsonDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#studyMaterial">
                                <li class="sidebar-item">
                                    <a class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                                        data-bs-target="#pearsonPastPapers" aria-expanded="false" aria-controls="pearsonPastPapers">
                                        Past Papers
                                    </a>
                                    <ul id="pearsonPastPapers" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#pearsonDropdown">
                                        <li class="sidebar-item">
                                            <a href="#" class="sidebar-link">Yearly Past Papers</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="#" class="sidebar-link">Topical Past Papers</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.pearson_books') }}" class="sidebar-link">Books</a>
                                </li>
                            </ul>
                        </li>

                        <!-- AKUEB Dropdown -->
                        <li class="sidebar-item">
                            <a class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                                data-bs-target="#akuebDropdown" aria-expanded="false" aria-controls="akuebDropdown">
                                AKU-EB
                            </a>
                            <ul id="akuebDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#studyMaterial">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Past Papers</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Books</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                    data-bs-target="#courses" aria-expanded="false" aria-controls="courses">
                        <i class="bi bi-camera-video fs-4"></i>
                        <span class="fs-6">Courses</span>
                    </a>
                    
                    <ul id="courses" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#courses">
                        <li class="sidebar-item">
                            <a class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pearsonGrades" aria-expanded="false" aria-controls="pearsonGrades">
                                Pearson
                            </a>
                            <ul id="pearsonGrades" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                    <a href="{{ route('admin.pearson_igcse_courses') }}" class="sidebar-link">IGCSE</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">International A Level (AS)</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">International A Level (A2)</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#caieGrades" aria-expanded="false" aria-controls="caieGrades">
                                CAIE
                            </a>
                            <ul id="caieGrades" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.caie_olevel_courses') }}" class="sidebar-link">O Level</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">IGCSE</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">A Level (AS)</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">A Level (A2)</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#akuEbGrades" aria-expanded="false" aria-controls="akuEbGrades">
                                AKU EB
                            </a>
                            <ul id="akuEbGrades" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">SSC I</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">SSC II</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">HSSC I</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">HSSC II</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-chat-square-text fs-4"></i>
                        <span class="fs-6">Announcements</span>
                    </a>
                </li>

            </ul>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form" class="w-100">
                    @csrf
                    <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent text-white">
                        <i class="lni lni-exit"></i>
                        <span class="fs-6">Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <main class="main">
            @yield('content')
        </main>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Collapse all siblings when a dropdown is opened
            const allToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

            allToggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-bs-target');
                    const parentUl = this.closest('ul');

                    if (parentUl) {
                        const allDropdowns = parentUl.querySelectorAll('.collapse');

                        allDropdowns.forEach(dropdown => {
                            if (dropdown.id !== targetId.replace('#', '')) {
                                new bootstrap.Collapse(dropdown, {
                                    toggle: false
                                }).hide();
                            }
                        });
                    }
                });
            });
        });

        $('#sidebar').on('transitionend', function () {
            if (!$(this).hasClass('expand')) {
                $('#sidebar .collapse.show').each(function () {
                    const collapseInstance = bootstrap.Collapse.getOrCreateInstance(this);
                    collapseInstance.hide();
                });
            }
        });

        document.addEventListener("DOMContentLoaded", function() {

        const sidebarLinks = document.querySelectorAll('.sidebar-link.collapsed.has-dropdown');

        sidebarLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    const sidebar = document.getElementById('sidebar');
                    
                    if (!sidebar.classList.contains('expand')) {
                        sidebar.classList.add('expand');
                    }
                });
            });
        });

    </script>

</body>

</html>