<?php
include('functionalities/get_specific_application.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
    
    <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/grayscale.min.css" rel="stylesheet">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
    
    </head>
    <body>
        <h1 align=center>Teller Control Page</h1>

        <table class="table  table-bordered table-dark" >
            <thead align=center>
                <tr>
                <th scope="col">Client Accounts</th>
                <th scope="col">Transactions</th>
                <th scope="col">Accounts Management</th>

                </tr>
            </thead>
            <tbody align=center>
                <tr>
                <td><button type="submit" class="btn btn-primary" id=b1>View Clients Accounts</button></td>
                <td><button type="submit" class="btn btn-primary" id=b2>View Transactions</button></td>
                <td><button type="submit" class="btn btn-primary" id=b3>Create Account</button></td>
                </tr>
                <tr>
                <td><button type="submit" class="btn btn-primary" id=b4>Access Client Account</button></td>
                <td><button type="submit" class="btn btn-primary" id=b5>Deposit/Withdrawal</button></td>
                <td><button type="submit" class="btn btn-primary" id=b6>Add New Client</button></td>
                </tr>
                <tr>
                
                <td colspan=100%><button type="submit" class="btn btn-primary btn-block" id=b8>Personal Bank Account</button></td>
          
                </tr>
            </tbody>
            </table>
        <!-- View Clients Account -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
        <div style="display:none;" id=f1>
            <form>
                <div class="form-group">
                    <label for="client_id">Client ID</label>
                    <input  class="form-control" id=client_id name=client_id>
                </div>
                <div align=center>
                    <button align=center type="submit" class="btn btn-primary" name=view_client_accounts id=view_client_accounts>View Client Accounts</button>
                </div>
            </form>
            <table class="table  table-striped table-dark" id="client_accounts_table" >
                    <thead align=center>
                        <tr><td align=center colspan=100%>Application</td></tr>
                        <tr>
                        <th scope="col">  Account Number  </th>
                        <th scope="col">Balance</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody id="data_client_accounts">
                    </tbody>
            </table>
                
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $('#view_client_accounts').click(function(e){
                e.preventDefault();
                e.stopPropagation();
                var client_id = $('#client_id').val();
                $.ajax({
                    type: "POST",
                    url: "functionalities/get_client_accounts.php",
                    data: {'action': 'specific_client_id','specific_client_id': client_id},
                    success: function(data){
                        data = JSON.parse(data);
                        var html = "";
                        var account = data["Accounts"];
                        console.log(data["Accounts"][0]);
                        for(var b=0; b<account.length; b++){
                                var AccountNumber = account[b].AccountNumber;
                                var Balance = account[b].Balance
                                var Currency = account[b].Currency;
                                var Type = account[b].Type;
                                
                                html += "<tr>";
                                html += "<td align=center>" + AccountNumber + "</td>";
                                html += "<td align=center>" + Balance + "</td>";
                                html += "<td align=center>" + Currency + "</td>";
                                html += "<td align=center>" + Type + "</td>";
                                html += "</tr>";
                        }
                        $('#data_client_accounts').append(html);  
                        }
                    });
                });
            });        
        
            $(document).ready(function(){
                $("#b1").click(function(){
                    $("#f1").toggle();
                })(JQuery);
            });
                
        </script> 

        <div style="display:none;" id=f2>
            <form>
                <div class="form-group">
                    <label for="account_transactions">Account Number</label>
                    <input  class="form-control" id="account_transactions" name=account_transactions>
                </div>
                
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=view_transactions id=view_transactions>View Transactions</button>
                </div>
                <table class="table  table-bordered table-light" id="transactions_table" >
                    <thead align=center>
                        <tr>
                        <th scope="col">AccountNumber</th>
                        <th scope="col">Amount</th>
                        <th scope="col">DateTime</th>
                        <th scope="col">Type</th>
                        <th scope="col">Teller</th>
                        </tr>
                    </thead>

                    <tbody id="data_account_transactions">
                    </tbody>
                </table>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>      
        <script>
            $(document).ready(function(){
                $("#b2").click(function(){
                    $("#f2").toggle();
                });
            });
            $(document).ready(function(){
                $('#view_transactions').click(function(e){
                    
                    e.preventDefault();
                    e.stopPropagation();
                    var account_number = $('#account_transactions').val();
                    $.ajax({
                        type: "POST",
                        url: "functionalities/get_account_transactions.php",
                        data: {'action': 'specific_client_id','specific_client_id': account_number},
                        success: function(data){
                        
                        data = JSON.parse(data);
                        var html = "";
                        var transactions = data["Transactions"];
                        window.alert(data);
                    
                        for(var b=0; b<transactions.length; b++){
                                var AccountNumber = transactions[b].AccountNumber;
                                var Amount = transactions[b].Amount;
                                var DateTime = transactions[b].DateTime;
                                var Type = transactions[b].Type;
                                var Teller = transactions[b].Teller;
                                html += "<tr>";
                                html += "<td>" + AccountNumber + "</td>";
                                html += "<td>" + Amount + "</td>";
                                html += "<td>" + DateTime + "</td>";
                                html += "<td>" + Type + "</td>";
                                html += "<td>" + Teller + "</td>";
                                html += "</tr>";
                                }
                        document.getElementById("data_account_transactions").innerHTML = html; 
                    }
                    });
                });
            });
        </script>

        <div style="display:none;" id=f3>
            <form action="functionalities/create_client_account.php" method=post>
                <?php include('functionalities/registration_errors.php') ?>
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input  class="form-control" id=fname name=fname>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input  class="form-control" id=lname name=lname>
                </div>
                <div class="form-group">
                    <label for="accountnumber">Account Number</label>
                    <input  class="form-control" id=accountnumber name=accountnumber>
                </div>
                <div class="form-group">
                    <label for="nationalid">National Id</label>
                    <input  class="form-control" id=nationalid name=nationalid>
                </div>
                <div class="form-group">
                    <label for="bdate">Birth Date</label>
                    <input  class="form-control" id=bdate name=bdate>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input  class="form-control" id=username name=username>
                </div>
                <div class="form-group">
                    <label for="confirm">Password</label>
                    <input  class="form-control" id=confirm name=confirm>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input  class="form-control" id=password name=password>
                </div>
                <div align=center>
                    <button align=center type="submit" class="btn btn-primary" name=create_account id=create_account>Create Account</button>
                </div>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $("#b3").click(function(){
                $("#f3").toggle();
            })(JQuery);
        });
        </script>
        <div style="display:none;" id=f4>
            <form>
                <div class="form-group">
                    <label for="account_number">Account Number</label>
                    <input  class="form-control" id=account_number name=account_number>
                </div>
                <div align=center>
                    <button align=center type="submit" class="btn btn-primary" name=view_client_account id=view_client_account>View Client Account</button>
                </div>
            </form>
            <table class="table  table-striped table-dark" id="client_account_table" >
                    <thead align=center>
                        <tr><td align=center colspan=100%>Application</td></tr>
                        <tr>
                        <th scope="col">  Account Number  </th>
                        <th scope="col">Balance</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody id="data_client_account">
                    </tbody>
            </table>
        </div> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $('#view_client_account').click(function(e){
                e.preventDefault();
                e.stopPropagation();
                var account_number = $('#account_number').val();
                
                $.ajax({
                    type: "POST",
                    url: "functionalities/access_client_account.php",
                    data: {'action': 'specific_account_number','specific_account_number': account_number},
                    success: function(data){
                        data = JSON.parse(data);
                        var html = "";
                        var account = data["Accounts"];
                        console.log(data["Accounts"][0]);
                        for(var b=0; b<account.length; b++){
                                var AccountNumber = account[b].AccountNumber;
                                var Balance = account[b].Balance
                                var Currency = account[b].Currency;
                                var Type = account[b].Type;
                                
                                html += "<tr>";
                                html += "<td align=center>" + AccountNumber + "</td>";
                                html += "<td align=center>" + Balance + "</td>";
                                html += "<td align=center>" + Currency + "</td>";
                                html += "<td align=center>" + Type + "</td>";
                                html += "</tr>";
                        }
                        $('#data_client_account').append(html);  
                        }
                    });
                });
            });
        $(document).ready(function(){
            $("#b4").click(function(){
                $("#f4").toggle();
            })(JQuery);
        });

        </script>
        <div style="display:none;" id=f5>
            <form action="functionalities/create_transaction.php" method=POST>
                <div class="form-group">
                    <label class="p-3 mb-2 bg-light text-dark">Account Number</label>
                    <input  class="form-control" id="accountnumber" name="accountnumber" aria-describedby="emailHelp" placeholder="Account Number">
                </div>
                <div class="form-group">
                    <label class="p-3 mb-2 bg-light text-dark">Amount</label>
                    <input  class="form-control" id="amount" name="amount" placeholder="Amount To Be Deposited/Withdrawn">
                </div>
                <div align=center>
                    <button type="submit" name="confirm_deposit" id="confirm_deposit" class="btn btn-primary">Confirm Deposit</button>
                    <button type="submit" name="confirm_withdraw" id="confirm_withdraw" class="btn btn-primary">Confirm Withdraw</button>
                </div>

            </form>
        </div> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $("#b5").click(function(){
                $("#f5").toggle();
            })(JQuery);
        });
        </script>
        
        <div style="display:none;" id=f6>
        <form action="functionalities/create_client.php" method=post>
        <?php include('functionalities/registration_errors.php') ?>
        <div class="form-group">
            <label for="client_fname">First Name</label>
            <input  class="form-control" id=client_fname name=client_fname>
        </div>
        <div class="form-group">
            <label for="client_lname">Last Name</label>
            <input  class="form-control" id=client_lname name=client_lname>
        </div>
        <div class="form-group">
            <label for="client_nationalid">National Id</label>
            <input  class="form-control" id=client_nationalid name=client_nationalid>
        </div>
        <div class="form-group">
            <label for="client_id">Client ID</label>
            <input  class="form-control" id=client_id name=client_id>
        </div>
        <div class="form-group">
            <label for="client_bdate">Birth Date</label>
            <input  class="form-control" id=client_bdate name=client_bdate>
        </div>
        <div class="form-group">
            <label for="client_phone">Phone Number</label>
            <input  class="form-control" id=client_phone name=client_phone>
        </div>
        <div class="form-group">
            <label for="client_email">Email</label>
            <input  class="form-control" id=client_email name=client_email>
        </div>
        <div align=center>
            <button align=center type="submit" class="btn btn-primary" name=create_client id=create_client>Create Client</button>
        </div>
    </form>
            <script>
            
                var ajax = new XMLHttpRequest();
                var method = "GET";
                var url = "functionalities/get_pending_applications.php";
                var asynchronous = true;
                ajax.open(method, url, asynchronous);

                ajax.send();

                ajax.onreadystatechange = function(){

                if (this.readyState == 4 && this.status == 200)
                {
                var data_pending = JSON.parse(this.responseText);
                
                console.log(data_pending);
                var html = "";
                var onlinebankingapp = data_pending["OnlineBankingApp"];
                var actual_data = data_pending["Client"];
                
                
                for(var b=0; b<onlinebankingapp.length; b++){
                        var AccountNumber = onlinebankingapp[b].SupposedAccountNumber;
                        var Name = onlinebankingapp[b].Fname + "  " + onlinebankingapp[b].Lname;
                        var NationalId = onlinebankingapp[b].NationalId;
                        var Bdate = onlinebankingapp[b].Bdate;
                        
                        var Actual_AccountNumber = onlinebankingapp[b].SupposedAccountNumber;
                        var Actual_Name = actual_data[b].FNAME + "  " + actual_data[b].LNAME;
                        var Actual_NationalId = actual_data[b].NATIONALID;
                        var Actual_Bdate = actual_data[b].BDATE;
                        html += "<tr>";
                        html += "<td align=center>" + Name + "</td>";
                        html += "<td align=center>" + NationalId + "</td>";
                        html += "<td align=center>" + Bdate + "</td>";
                        html += "<td align=center>" + AccountNumber + "</td>";
                        html += "</tr>";
                        html += "<tr><td colspan=100% align=center>Actual Client Data</td></tr>";
                        html += "<tr>";
                        html += "<td align=center>" + Actual_Name + "</td>";
                        html += "<td align=center>" + Actual_NationalId + "</td>";
                        html += "<td align=center>" + Actual_Bdate + "</td>";
                        html += "<td align=center>" + Actual_AccountNumber + "</td>";
                        html += "</tr>";
                        }

                    }
                        
                        document.getElementById("data_pending").innerHTML = html;
                        }
                </script>

        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $("#b6").click(function(){
                $("#f6").toggle();
            })(JQuery);
        });
        </script>
        <div style="display:none;" id=f7>
            <form action="functionalities/create_transaction.php" method=POST>
                <div class="form-group">
                    <label for="change_pass_username">Admin Username</label>
                    <input  class="form-control" id="change_pass_username" name=change_pass_username>
                </div>
                <div class="form-group">
                    <label for="new_password">Password</label>
                    <input type=password class="form-control" id="new_password" name=new_password>
                </div>
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=change_password id=change_password>Change Admin Password</button>
                </div>
            </form>
        </div>    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
            <script>
            $(document).ready(function(){
                $("#b7").click(function(){
                    $("#f7").toggle();
                })(JQuery);
            });
            </script>
        <div style="display:none;" id=f8>
        <form action="../Clients/server_login.php" method=POST>
               
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=login_from_teller id=login_from_teller>Redirect To client Page</button>
                </div>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $("#b8").click(function(){
                location.href = "../Clients/homepage/homepage.php";
                $("#f8").toggle();
            })(JQuery);
        });
        </script>
        <div style="display:none;" id=f9>
                <form>
                <div class="form-group">
                    <label for="specific_online_app_clientid">Client ID to Fetch</label>
                    <input  class="form-control" id="specific_online_app_clientid"  name=specific_online_app_clientid>
                    <div>
                        <button align=center type="button" class="btn btn-primary btn-small" name=submit_specific_application id=submit_specific_application>Submit Client Id</button>
                    </div>
                <table class="table  table-striped table-dark" id="specific_pending_applications" >
                    <thead align=center>
                        <tr><td align=center colspan=100%>Application</td></tr>
                        <tr>
                        <th scope="col">  Name  </th>
                        <th scope="col">National ID</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Supposed Account Number</th>
                        </tr>
                    </thead>

                    <tbody id="data_specific">
                    </tbody>
                </table>
                
                <div align=center>
                    <button align=cetner type="submit" class="btn btn-primary" name=confirm_pending_application id=confirm_pending_application>Confirm Application</button>
                </div>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
            $(document).ready(function(){
                $('#submit_specific_application').click(function(){
                    var client_id = $('#specific_online_app_clientid').val();
                    
                    $.ajax({
                        type: "POST",
                        url: "functionalities/get_specific_application.php",
                        data: {'action': 'specific_client_id','specific_client_id': client_id},
                        success: function(data){
                            data = JSON.parse(data);
                            var html = "";
                            var onlinebankingapp = data["SpecificApplication"];

                            for(var b=0; b<onlinebankingapp.length; b++){
                                    var AccountNumber = onlinebankingapp[b].SupposedAccountNumber;
                                    var Name = onlinebankingapp[b].Fname + "  " + onlinebankingapp[b].Lname;
                                    var NationalId = onlinebankingapp[b].NationalId;
                                    var Bdate = onlinebankingapp[b].Bdate;
                                    
                                    html += "<tr>";
                                    html += "<td align=center>" + Name + "</td>";
                                    html += "<td align=center>" + NationalId + "</td>";
                                    html += "<td align=center>" + Bdate + "</td>";
                                    html += "<td align=center>" + AccountNumber + "</td>";
                                    html += "</tr>";
                            }
                            $('#data_specific').append(html);  
                        }
                    })(JQuery);
                });
            });
            $(document).ready(function(){
                $('#confirm_pending_application').click(function(){
                    var client_id = $('#specific_online_app_clientid').val();
                    
                    $.ajax({
                        type: "POST",
                        url: "functionalities/confirm_pending_application.php",
                        data:{'action_confirm': 'specific_client_id_2','specific_client_id_2': client_id},
                        success: function(data){
                           window.alert(data); 
                        }
                    })(JQuery);
                });
            });
        
        
            $(document).ready(function(){
                $("#b9").click(function(){
                    $("#f9").toggle();
                })(JQuery);
            });
            
                
        </script>        

    </body> 
</html>