

<?php include('../server_login.php') ?>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HOMEPAGE</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grayscale.min.css" rel="stylesheet">
    <link href="../tabulator/dist/css/tabulator.min.css" rel="stylesheet">
   
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><?php echo " " . $_SESSION["login_Fname_homepage"] . " "  . $_SESSION["login_Lname_homepage"] . " "  ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#Account and Transactions">Accounts and Transactions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#Transfer Services">Transfer Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact information">Contact Information</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
          <h1 class="mx-auto my-0 text-uppercase">DNB</h1>
          <h2 class="text-white-50 mx-auto mt-2 mb-5">Enjoy Elite Financial Services. With You Anywhere</h2>
          <a href="#about" class="btn btn-primary js-scroll-trigger">Get Started</a>
        </div>
      </div>
    </header>
    <!-- Accounts Section -->
    <section id="Account and Transactions" class="projects-section bg-light">
      <div class="container">
        <table class="table" id="accountsandtransactions" >
          <tbody id="data">
          </tbody>
        </table>
        <script>
      
          var ajax = new XMLHttpRequest();
          var method = "GET";
          var url = "get_table_data.php";
          var asynchronous = true;
          ajax.open(method, url, asynchronous);

          ajax.send();

          ajax.onreadystatechange = function(){

            if (this.readyState == 4 && this.status == 200)
            {
            var data = JSON.parse(this.responseText);
            console.log(data);
            var html = "";
            var accounts = data["Accounts"];
            var transactions = data["Transactions"];
            
            for(var a = 0; a<accounts.length; a++)
            {
              var AccountNumber = accounts[a].AccountNumber;
              var Balance = accounts[a].Balance;
              var Currency = accounts[a].Currency;
              var Type = accounts[a].Type;
              html += "<thead class=thead-light>"
              html += "<tr>"
              html +=  "<th scope='col'> AccountNumber </th>"
              html += "<th scope='col'> Balance </th>"
              html +=  "<th scope='col'> Currency </th>"
              html +=  "<th scope='col'> Type </th>"
              html += "</tr>"
              html += "</thead>"
              html += "<tr>";
                html += "<td>" + AccountNumber + "</td>";
                html += "<td>" + Balance + "</td>";
                html += "<td>" + Currency + "</td>";
                html += "<td>" + Type + "</td>";
                html+= "<td><table><tr><td align=center colspan=100%>Transactions</td></tr>"
                html += "<tr><td>Amount</td><td>DateTime</td><td>Type</td></tr>";
        
                for(var b=0; b<transactions.length; b++)
                  if (AccountNumber == transactions[b][0].AccountNumber){
                    for(var c=0; c<transactions[b].length; c++){
                      var Amount = transactions[b][c].Amount;
                      var DateTime = transactions[b][c].DateTime;
                      var Type = transactions[b][c].Type;
                      html += "<tr>";
                        html += "<td>" + Amount + "</td>";
                        html += "<td>" + DateTime + "</td>";
                        html += "<td>" + Type + "</td>";
                      html += "</tr>";
                      }}
                html += "</table></td></tr>"
            }
              
            document.getElementById("data").innerHTML = html;
            }
        }

    </script>
  
    
       
    </section>
    <!-- Transfer Section -->
    <section id="Transfer Services" class="about-section text-center">
      <div class="container">
      <form method="post" action="../server_login.php">
        <div class="form-group" method="post" action="server_login.php">
          <label class="p-3 mb-2 bg-light text-dark">Sender Account Number</label>
          <input  class="form-control" id="sender_account" name="sender_account" aria-describedby="emailHelp" placeholder="Sender Account">
        </div>
        <div class="form-group">
          <label class="p-3 mb-2 bg-light text-dark">Receiver Account Number</label>
          <input  class="form-control" id="receiver_account" name="receiver_account" placeholder="Receiver Account">
        </div>
        <div class="form-group">
          <label class="p-3 mb-2 bg-light text-dark">Amount</label>
          <input  class="form-control" id="amount" name="amount" placeholder="Amount To Be Transfered">
        </div>
      
        <button type="submit" name="confirm_transaction" id="confirm_transaction" class="btn btn-primary">Confirm</button>
      </form> 
    </section>

    <!-- Signup Section -->
    
    <section id="contact information" class="signup-section">
      <div class="container">
        <div class="row">
        
          <div class="col-md-10 col-lg-8 mx-auto text-center" >
            <div>
            <button type="submit" class="btn btn-primary" id=formButton>Update Contact Information</button>
            </div>
            <div style="display:none;" id=form1>
            <form method="post" action="../server_login.php">
              <div class="form-check" >
                <input class="form-check-input" type="radio" id=update_place name="update_place" value="email">
                <label class="form-check-label" for="update_place">
                  Email
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio"  id=update_place name="update_place" value="phone">
                <label class="form-check-label" for="update_place">
                  Phone Number
                </label>
              </div>
              <div class="form-group">
                <input  class="form-control" name="information_to_update" placeholder="Information to Update">
                <button type="submit" class="btn btn-primary" name=update_contact_information>Confirm</button>
              </div>
              </form>
            </div>


          </div>
        </div>
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
      <script>
      
    $(document).ready(function(){
        $("#formButton").click(function(){
            $("#form1").toggle();
        })(JQuery);
    });
      </script>
    </section>


    <!-- Contact Section -->
    <section class="contact-section bg-black">
      <div class="container">

        <div class="row">

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Address</h4>
                <hr class="my-4">
                <div class="small text-black-50">CP 40, AUC New Cairo</div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-envelope text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Email</h4>
                <hr class="my-4">
                <div class="small text-black-50">
                  <a href="#"><?php echo $_SESSION['client_email']?></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 mb-3 mb-md-0">
            <div class="card py-4 h-100">
              <div class="card-body text-center">
                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                <h4 class="text-uppercase m-0">Phone</h4>
                <hr class="my-4">
                <div class="small text-black-50"><?php echo $_SESSION['client_phone']?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
      <div class="container">
        DNB &copy; www.dnb.com.eg 2018
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.min.js"></script>

    <script src = "tabulator"

  </body>

</html>