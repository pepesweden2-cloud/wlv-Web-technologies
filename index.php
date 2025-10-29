<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                var products_count = 0;
                //LOAD ALL TYPES PRODUCTS
                $.ajax({
                    type: 'POST',
                    url: "getAllProducts.php",
                    data: '{"data":0}',
                    success: function (data) {
                        console.log(data);
                        $.each(data, function (text, value) {
                            $('#products').append($('<option>').text(value.description).attr('value', value.code));
                            products_count++;
                        });
                        document.getElementById("numberofproducts").innerHTML= products_count;
                    },
                    contentType: "application/json",
                    dataType: 'json'
                });


                //LOAD ALL TYPES PRODUCTS
                var categories_count = 0;
                $.ajax({
                    type: 'POST',
                    url: "getAllCategories.php",
                    data: '{"data":0}',
                    success: function (data) {
                        console.log(data);
                        $.each(data, function (text, value) {
                            $('#categories').append($('<option>').text(value.description).attr('value', value.code));
                            categories_count++;
                        });
                        
                        document.getElementById("numberofcategories").innerHTML= categories_count;
                    },
                    contentType: "application/json",
                    dataType: 'json'
                });

                $.ajax({
                    type: 'POST',
                    url: "gsrenew.php",
                    data: '{"data":0}',
                    success: function (data) {
                        $("#numberofsuppliers").empty().append(data.count);
                    },
                    contentType: "application/json",
                    dataType: 'json'
                });
            });

               
        </script>
        
    </head>
    <body>
        <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Products Web Application</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#myModal">Register</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#pricesModal">Price Update</a></li>
                        <li>
                            <select style="display:inline-block" name="categories" id="categories" >
                                
                            </select>
                            <a id="searchbtn" href="#">Search Product By Category</a></li>
                        </li>
                    </ul>
                </div>
            </nav>
        
        <div class="container">
            <h2>Number of suppliers:<span id="numberofsuppliers"></span></h2>
            <h2>Number of product categories:<span id="numberofcategories"></span></h2>
            <h2>Number of products:<span id="numberofproducts"></span></h2>
            <!--- NUMBER OF SUPPLIERS END -->
        </div>

        
        <div class="modal fade" id="productModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header  bg-info">
                        <h4 class="modal-title">Products</h4>
                    </div>
                    <div class="modal-body">

                        <form id="orderform" method="POST">
                            <div class="form-group">
                                <label for="orderfuelcategory">Product Category</label>
                                <select class="form-control" name="orderfuelcategory" id="orderfuelcategory">
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="orderquantity">Quantity</label>
                                <input class="form-control" type="number" name="orderquantity" id="orderquantity">
                            </div>

                            <button type="submit" class="btn btn-primary" >Order</button>
                        </form>
                    </div>
                    <div class="modal-footer   bg-info">
                        <div id="orderresult"></div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">&xotime;</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Attach a submit handler to the form
            $("#orderform").submit(function (event) {
                var jwt = localStorage.getItem('jwt');
                var code = localStorage.getItem('id');
                if (!jwt) {
                    alert('ΠΡΕΠΕΙ ΠΕΡΑΣΕΤΕ ΠΡΩΤΑ ΑΠΌ ΤΗ ΔΙΑΔΙΚΑΣΙΑ ΕΙΣΟΔΟΥ');
                    return;
                }
                // Stop form from submitting normally
                event.preventDefault();

                var $form = $(this),
                        url = "placeorder.php";

                // Send the data using post
                var posting = $.post(url, {username: localStorage.getItem('username'), quantity: $("#orderquantity").val(), product: $("#orderfuelcategory").val()});

                // Put the results in a div
                posting.done(function (data) {

                    $("#orderresult").empty().append(data);
                });
            });
        </script>

        


        <!-- REGISTER -->
        <div class="container">
           
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Register</h4>
                        </div>
                        <div class="modal-body">

                            <form id="registerform">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="password">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="email">

                                </div>

                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                        <div class="modal-footer bg-info">
                            <div id="register_result"></div>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">&xotime;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Attach a submit handler to the form
            $("#registerform").submit(function (event) {

                // Stop form from submitting normally
                event.preventDefault();

                var $form = $(this),
                        username = $form.find("input[name='username']").val(),
                        password = $form.find("input[name='password']").val(),
                        email = $form.find("input[name='email']").val(),
                        url = "register.php";

                // Send the data using post
                var posting = $.post(url, {username: $("#username").val(), password: $("#password").val(), email: $("#email").val()});

                // Put the results in a div
                posting.done(function (data) {

                    $("#register_result").empty().append(data);
                });
            });
        </script>

        <div class="container">
            
            <div class="modal fade" id="loginModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-info">

                            <h4 class="modal-title">Login</h4>
                        </div>
                        <div class="modal-body">

                            <form id="loginForm">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="loginusername" placeholder="loginusername">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="loginpassword" placeholder="loginpassword">
                                </div>

                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                        <div class="modal-footer bg-info">
                            <div class="card" id="login_result"></div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">&xotime;</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('loginForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    var username = document.getElementById('loginusername').value;
                    var password = document.getElementById('loginpassword').value;

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'login.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                
                                localStorage.setItem('jwt', response.token);
                                localStorage.setItem('id', response.code);
                                localStorage.setItem('username', username);
                                alert('Login Success');
                                

                            } else {
                                alert('ΑΠΟΤΥΧΙΑ:');
                            }
                        } else {
                            alert('ΣΦΑΛΜΑ ΔΙΑΔΙΚΑΣΙΑΣ.');
                        }
                    };
                    var data = JSON.stringify({username: username, password: password});
                    xhr.send(data);
                });
            </script>

            <!-- LOGIN -->
            <!--- NUMBER OF GAS STATION  -->
        </div>
        <!-- MIN MAX PRICE -->


        <div class="container">
            
            <div class="container" id="productslist"></div>

            


            <!--- MIN MAX VALUE  -->
        </div>

        <div class="container">
            
           
            <div class="modal fade" id="pricesModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-info">

                            <h4 class="modal-title">Price Update</h4>
                        </div>
                        <div class="modal-body">

                            <form id="changepriceform">
                                <div class="form-group">
                                    <label for="products">Product</label>
                                    <select class="form-control" name="products" id="products">

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="newprice">New Price</label>
                                    <input type="text" class="form-control" id="newprice" placeholder="0.0">
                                </div>

                                <button type="submit" class="btn btn-primary" id="updateprice">Update</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">&xotime;</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="chart-div"></div>
            <script>
                // Attach a submit handler to the form
                $("#changepriceform").submit(function (event) {
                    var jwt = localStorage.getItem('jwt');
                    var code = localStorage.getItem('id');
                    if (!jwt) {
                        alert('You need to be logged in');
                        return;
                    }
                    // Stop form from submitting normally
                    event.preventDefault();

                    var $form = $(this),
                            category = $form.find("input[name='products']").val(),
                            newprice = $form.find("input[name='newprice']").val(),
                            url = "changePrice.php";

                    // Send the data using post
                    var posting = $.post("changePrice.php", {code: $("#products").val(), price: $("#newprice").val()});

                    // Put the results in a div
                    posting.done(function (data) {
                        console.log(data);
                    });
                });
            </script>
<script>
                // Attach a submit handler to the form
                $("#searchbtn").click(function (event) {

                    
                    var code = document.getElementById('categories').value;
                    
                    var xhr = new XMLHttpRequest();
 
                    
                    

                    xhr.open('GET', 'getProductsByCategory.php?code=' + code, true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            //var response = JSON.parse(xhr.responseText);
                            
                            if (1) {
                                var orderslistdiv = document.getElementById("productslist");
                                var jstr = JSON.parse(xhr.responseText);
                                var str = "";
                                for (var j = 0; j < jstr.length; j++) {
                                    var clr = 'bg-success';
                                    if (j % 2 == 1) {
                                        clr = 'bg-info';
                                    }
                                    str += "<div class='container " + clr + "'>";
                                    str += "<div><strong>" + jstr[j].description + "</strong><div class='bg-danger'>" + jstr[j].price + " €</div></div>";
                                    str += "<div class='bg-info'><hr></div>";
                                    
                                    str += "</div>";
                                }
                                orderslistdiv.innerHTML = str;
                            } else {
                                alert('Access denied: ' + response.message);
                            }
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    };

                    xhr.send();

                });
            </script>





            <!-- UPDATE PRICES -->

    </body>
</html>
