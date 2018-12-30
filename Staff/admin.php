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
        <link href="../tabulator/dist/css/tabulator.min.css" rel="stylesheet">
    
    </head>
    <body>
        <h1 align=center>Admin Control Page</h1>

        <table class="table  table-bordered table-dark" >
            <thead align=center>
                <tr>
                <th scope="col">Administrator Options</th>
                <th scope="col">Teller Options</th>
                <th scope="col">Clients Options</th>
                </tr>
            </thead>
            <tbody align=center>
                <tr>
                <td><button type="submit" class="btn btn-primary" id=b1>Create Adminstrator</button></td>
                <td><button type="submit" class="btn btn-primary" id=b2>Create Teller</button></td>
                <td><button type="submit" class="btn btn-primary" id=b3>View Transactions</button></td>
                </tr>
                <tr>
                <td><button type="submit" class="btn btn-primary" id=b4>Delete Adminstrator</button></td>
                <td><button type="submit" class="btn btn-primary" id=b5>Delete Teller</button></td>
                <td><button type="submit" class="btn btn-primary" id=b6>Pending Online App</button></td>
                </tr>
                <tr>
                <td><button type="submit" class="btn btn-primary" id=b7>Change Adminstrator Password</button></td>
                <td><button type="submit" class="btn btn-primary" id=b8>Change Teller Password</button></td>
                <td><button type="submit" class="btn btn-primary" id=b9>View Specific Online App</button></td>
                </tr>
            </tbody>
            </table>
        <!-- Create Adminstrator -->

        <div style="display:none;" id=f1>
            <form method=POST action=functionalities/create_admin.php>
                <div class="form-group">
                    <label for="admin_username">Username</label>
                    <input  class="form-control" id="admin_username" name=admin_username>
                </div>
                <div class="form-group">
                    <label for="admin_staffid">Staff ID</label>
                    <input  class="form-control" id="admin_staffid" name=admin_staffid>
                </div>
                <div class="form-group">
                    <label for="admin_password">Password</label>
                    <input type=password class="form-control" id="admin_password" name=admin_password>
                </div>
                <div align=center>
                    <button align=center type="submit" class="btn btn-primary" name=create_admin id=create_admin>Create Admin</button>
                </div>
            </form>
        </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
            <script>
            //     $(document).ready(function(){
            //     $('#create_admin').click(function(){
                    
            //         var username = $('#admin_username').val();
            //         var password = $('#admin_password').val();
            //         var staffid = $('#admin_staffid').val();
            //         window.alert(staffid);
            //         $.ajax({
            //             type: "POST",
            //             url: "functionalities/create_admin.php",
            //             data:{'action': 'username','username': username,'password': password,'staffid':staffid },
            //             success: function(data){
            //                window.alert(data);
            //             }
            //         });
            //     });
            // });
            </script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
            <script>
            $(document).ready(function(){
                $("#b1").click(function(){
                    $("#f1").toggle();
                })(JQuery);
            });
            </script>
        <div style="display:none;" id=f2>
            <form action="functionalities/create_teller.php" method=POST>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input  class="form-control" id="teller_username" name=teller_username>
                </div>
                <div class="form-group">
                    <label for="staffid">Staff ID</label>
                    <input  class="form-control" id="staffid" name=staffid>
                </div>
                <div class="form-group">
                    <label for="teller_password">Password</label>
                    <input type=password class="form-control" id="teller_password" name=teller_password>
                </div>
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=create_teller id=create_teller>Create Teller</button>
                </div>
            </form>
        </div>    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
            <script>
            $(document).ready(function(){
                $("#b2").click(function(){
                    $("#f2").toggle();
                });
            });
            </script>
        <div style="display:none;" id=f3>
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

            <tbody id="data">
            </tbody>
            </table>
            <script>
        
                var ajax = new XMLHttpRequest();
                var method = "GET";
                var url = "functionalities/get_transactions.php";
                var asynchronous = true;
                ajax.open(method, url, asynchronous);

                ajax.send();

                ajax.onreadystatechange = function(){

                    if (this.readyState == 4 && this.status == 200)
                    {
                    var data = JSON.parse(this.responseText);
                    var html = "";
                    var transactions = data["Transactions"];
                
                    
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

                    }
                    
                    document.getElementById("data").innerHTML = html;
                    }
            </script>

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
            <form action="functionalities/delete_staff.php" method=POST>
                <div class="form-group">
                    <label for="delete_username">Username</label>
                    <input  class="form-control" id="delete_username" name=delete_username>
                </div>
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=delete id=delete>Delete Admin</button>
                </div>
            </form>
        </div> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $("#b4").click(function(){
                $("#f4").toggle();
            })(JQuery);
        });
        </script>
        <div style="display:none;" id=f5>
            <form action="functionalities/delete_staff.php" method=POST>
                <div class="form-group">
                    <label for="delete_username">Username</label>
                    <input  class="form-control" id="delete_username" name=delete_username>
                </div>
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=delete id=delete>Delete Teller</button>
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
       
            <table class="table  table-striped table-dark" id="pending_applications" >
                <thead align=center>
                    <tr>
                    <th scope="col">  Name  </th>
                    <th scope="col">National ID</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Supposed Account Number</th>
                    </tr>
                </thead>

                <tbody id="data_pending">
                </tbody>
            </table>
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
            <form action="functionalities/change_password.php" method=POST>
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
            <form action="functionalities/change_password.php" method=POST>
                <div class="form-group">
                    <label for="change_pass_username">Teller Username</label>
                    <input  class="form-control" id="change_pass_username" name=change_pass_username>
                </div>
                <div class="form-group">
                    <label for="new_password">Password</label>
                    <input type=password class="form-control" id="new_password" name=new_password>
                </div>
                <div align=center>
                    <button align=cetnertype="submit" class="btn btn-primary" name=change_password id=change_password>Change Teller Password</button>
                </div>
            </form>
        </div>    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>   
        <script>
        $(document).ready(function(){
            $("#b8").click(function(){
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