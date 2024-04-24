<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TarcDining - Feedback</title>
    <!-- Include design plugins -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Define Tailwind CSS theme configurations
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
    <header>
        <nav class="h-24 px-60 flex justify-between items-center">
            <div class="flex items-center">
                <img class="h-16 w-16" src="../ICON/logo.png" alt="">
                <h1 class="text-3xl font-bold ml-3">TarcDining</h1>
            </div>
            <div class="flex items-center">
                <div class="flex items-center hover:text-redSecondary">
                    <i class="fa-solid fa-house fa-rotate-by mr-2"></i>
                    <a href="studentHome.php" class="text-xl font-semibold uppercase">Home</a>
                </div>
                <div class="flex items-center ml-5 hover:text-redSecondary">
                    <i class="fa-solid fa-list mr-2"></i>
                    <a href="menu.php" class="text-xl font-semibold uppercase">Menu</a>
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
                        exit();
                    }
                }
                ?>
            </div>
            <div>
                <?php
                // Check if username cookie is set
                if(isset($_COOKIE['username'])) {
                    $username = $_COOKIE['username'];
                    echo 
                    "<div class='flex items-center'>
                        <i class='fa-solid fa-user mr-2 text-2xl'></i>
                        <h1 class='text-xl font-semibold uppercase'>$username</h1>
                    </div>";
                } else {
                    // Redirect to login page if user is not logged in
                    header("Location: Login.php");
                    exit(); // Stop further execution
                }
                ?>
            </div>
        </nav>
    </header>
    <main>
        <section class="px-[15rem]">
            <h1 class="text-center text-5xl font-extrabold my-10">
                Provide Your Feedback
            </h1>
            <p class="text-center text-xl font-semibold my-10">We would love to hear your feedback on the meal you had today. Please provide your feedback below with the food name.</p>
            <div class="my-24">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <?php 
                    // Include necessary PHP code here
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Check if meal rating is provided
                        if (empty($_POST['mealRating'])) {
                            echo "<p style='color: red;'>Please rate the meal.</p>";
                        } else {
                            // Database connection
                            require_once('DBconnect.php');
                            
                            // Retrieve form data
                            $email = $_COOKIE['email'];
                            $text = $_POST['text'];
                            $mealRating = $_POST['mealRating'];
                            
                            // Check if the user exists in the student table
                            $check_user_sql = "SELECT email FROM student WHERE email = ?";
                            $stmt = $conn->prepare($check_user_sql);
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows == 0) {
                                echo "<p style='color: red;'>Error: User does not exist.</p>";
                            } else {
                                // Prepare and execute SQL statement to insert feedback
                                $sql = "INSERT INTO feedback (email, text, mealRating) VALUES (?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sss", $email, $text, $mealRating);
                                if ($stmt->execute()) {
                                    echo "Feedback submitted successfully.";
                                } else {
                                    echo "Error: " . $stmt->error;
                                }
                            }
                            
                            // Close database connection
                            $conn->close();
                        }
                    }
                    ?>
                    <div class="grid grid-cols-2">
                        <div class="flex items-center mr-6">
                            <h1 class="text-2xl font-semibold mr-4 w-72">Your email:</h1>
                            <!-- Replace input with PHP code to fetch user's email -->
                            <input type="text" name="email" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" value="<?php echo $_COOKIE['email']; ?>" readonly>
                        </div>
                        <div>
                            <select class="select w-full my-4 border-2 border-gray-300 px-4 font-semibold text-xl py-2" name="mealRating" required>
                                <option disabled selected>Rate the Meal</option>
                                <option value="Excellent">Excellent</option>
                                <option value="Good">Good</option>
                                <option value="Average">Average</option>
                                <option value="Poor">Poor</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="flex flex-row items-center mr-6 flex-1">
                            <h1 class="text-2xl font-semibold mr-4 w-72">Feedback:</h1>
                            <textarea name="text" class="w-full h-32 border-2 border-gray-300 rounded-lg px-4 py-2 my-4" required></textarea>
                        </div>
                    </div>
                    <input type="submit" value="Submit" class="bg-yellow-300 py-3 w-full rounded-lg my-4">
                </form>
            </div>
        </section>
    </main>
</body>
</html>
