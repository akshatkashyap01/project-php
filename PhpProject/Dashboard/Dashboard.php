<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body style="background-image: url('/TodoProject/background.jpg'); 
    height: 100vh; background-repeat: no-repeat; background-size: cover; 
    background-position: center center;">
    <!-- Header/navbar -->
    <header class="pb-4">
        <nav class="navbar navbar-expand-lg justify-content-between navbar-light bg-secondary">
            <div class="navbar-nav">
                <a href="" class="nav-link px-5" style="font-weight: bold; color: white; font-size: 26px;">Rubico</a>   
                <a href="" class="nav-link px-5" style="font-weight: bold; color: white; font-size: 26px;">DashBoard</a>
                <a href="/TodoProject/ToDoList/ToDo.html" class="nav-link px-4" 
                    style="font-weight: bold; color: white; font-size: 26px;">To Do</a>
            </div>
            <div class="pe-4">
                <button class="btn btn-primary" onclick="logout(event)">Log Out</button>
            </div>
        </nav>
    </header>
    <br><br><br>
    <!-- section for the table -->
    <section>
        <div class="container p-0 bg-light" style="width: 35%;">
            <h2 class="bg-danger text-light p-4">User Information</h2>
            <div class="container p-5 bg-warning text-dark" >
                <!-- table -->
                <table>
                    <tbody>
                        <!-- First name -->
                        <tr class="border-bottom">
                            <th>First Name: </th>
                            <td id="firstNameData" class="p-3"></td>
                        </tr>
                        <!-- Last name -->
                        <tr class="border-bottom">
                            <th>Last Name: </th>
                            <td id="lastNameData"  class="p-3"></td>
                        </tr>
                        <!-- Email -->
                        <tr class="border-bottom">
                            <th>Email: </th>
                            <td id="emailData"  class="p-3"></td>
                        </tr>
                        <!-- Phone number -->
                        <tr class="border-bottom">
                            <th>Phone Number: </th>
                            <td id="phoneData"  class="p-3"></td>
                        </tr>
                        <!-- Address -->
                        <tr class="border-bottom">
                            <th>Address: </th>
                            <td id="addressData" class="p-3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Links for scripts -->
    <script src="/TodoProject/Registration/Validations.js"></script>
    <script src="/TodoProject/Registration/Validations.js"></script>
    <script src="/TodoProject/Dashboard/Dashboard.js"></script>
</body>
</html>