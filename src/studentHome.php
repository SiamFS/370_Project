<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- design plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              yellowPrimary: 'rgb(253 224 71)',
              redSecondary: 'rgb(220 38 38)',
              greenSecondary: 'rgb(34 197 94)',
            }
          }
        }
      }
    </script>
</head>
<body>
<nav class="h-24 px-60 flex justify-between items-center">
    <div class="flex items-center">
        <img class="h-16 w-16" src="../ICON/logo.png" alt="">
        <h1 class="text-3xl font-bold ml-3">UNIDining</h1>
    </div>  
    <div class="flex items-center space-x-5">
        <div class="flex items-center hover:text-redSecondary">
            <i class="fa-solid fa-house fa-rotate-by mr-2"></i>
            <a href="studentHome.php" class="text-xl font-semibold uppercase">Home</a>
        </div>
        <div class="flex items-center ml-5 hover:text-redSecondary">
            <i class="fa-solid fa-list mr-2"></i>
            <a href="menu.php" class="text-xl font-semibold uppercase">Menu</a>
        </div>
        <div class="flex items-center ml-5 hover:text-redSecondary">
            <i class="fa-solid fa-list-check mr-2"></i>
            <a href="student_feedback.php" class="text-xl font-semibold uppercase">FeedBack</a>
        </div>
        <div class="flex items-center ml-5 hover:text-redSecondary">
            <i class="fa-solid fa-shopping-cart mr-2"></i>
            <a href="Buytoken.php" class="text-xl font-semibold uppercase">Buy Token</a>
        </div>
        <?php
            if(isset($_COOKIE['role'])) {
            $role = $_COOKIE['role'];
            if($role == 'student') {
                echo 
                    "<div class='flex items-center ml-5 hover:text-redSecondary'>
                        <i class='fa-solid fa-shopping-cart mr-2'></i>
                        <a href='Cart.php' class='text-xl font-semibold uppercase'>Cart</a>
                    </div>";
        
            } else {
                header("Location: login.php");
             }
        }
        ?>
        <div class="flex items-center ml-5">
            <form action="search.php" method="post" class="flex items-center">
                <input type="text" name="search" placeholder="Search for food" class="px-3 py-1 border border-gray-300 rounded-md">
                <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Search</button>
            </form>
        </div>
        <div class="flex items-center space-x-5">
            <?php
            if(isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
                echo 
                "<div class='flex items-center'>
                    <i class='fa-solid fa-user mr-2 text-2xl'></i>
                    <h1 class='text-xl font-semibold uppercase'>$username</h1>
                </div>";
            } else {
                header("location: login.php");
            }
            ?>
            <div class="flex items-center ml-2"> 
                <div class="flex items-center ml-2 hover:text-redSecondary"> 
                    <a href="login.php" class="text-xl font-semibold uppercase bg-red-500 text-white rounded-md px-4 py-2 hover:bg-red-600 transition-colors duration-300">Logout</a> <!-- Line 20 -->
                </div>
            </div>
        </div>
    </div>
</nav>

<main>
    <section class="h-80">
        <div class="bg-cover bg-center h-[30rem]" style="background-image: linear-gradient(to bottom right,rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2)),url(../ICON/banner.jpg);">
            <h1 class="text-7xl font-bold text-center py-10 text-white">Welcome to TarcDining</h1>
            <p class="text-center text-white text-lg">all-in-one solution for planning, organizing, and enjoying delicious meals effortlessly</p>
        </div>
    </section>
    <section>
        <!-- Trending Items Section -->
    </section>
</main>

</body>
</html>
