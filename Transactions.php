<!Doctype html>
<html>
   <head>
      <meta  charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>TSF BANK</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
      <link rel="stylesheet" href="Transactions.css">
      <style>
          ul{
             list-style-type: none;
             margin:0;
             padding: 0;}
          li {
             float: right;  
             margin-right:50px;        
          }
          li a {
             display: block;
             padding: 8px;
             background-color: black;
             font-size:25px;
             text-decoration: none;
            }
          .v{
            background-color:black;
            height:54px;
           }     
          h1{
            text-align:center;
            font-size:50px;
            color:Red;
           }
      </style>
    </head>
    <body>  
        <div class="v">
           <ul >
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php">Back</a></li>
           </ul>
         </div>
        <div>  
            <h1 style="margin-top:30px">Transaction History</h1>
            <table class="table" style="background-color:white; margin-top:30px; margin-left:auto; margin-right:auto; border: 3px solid black; width:900px" > 
                <thead class="thead-dark" >
                   <tr>
                      <td scope="col">Sender</td>
                      <td scope="col">Receiver</td>
                      <td scope="col">Amount</td>
                   </tr>
                 </thead>
            <?php
             $db=mysqli_connect("localhost:3307","root","","b");
             if(!$db){
                  die("Connection failed!!".mysqli_connect_error());
             }
            $ql = "SELECT * FROM transfers";
             $records=mysqli_query($db,$ql)or die( mysqli_error($db));;
            while($data=mysqli_fetch_array($records)){?>
            <tr class="t">
                <td ><?php echo $data['Sender']; ?></td>
                <td ><?php echo $data['Receiver']; ?></td>
                <td><?php echo $data['Amount']; ?></td>
            </tr>
            <?php
            }
            ?>         
          </table>
           <?php mysqli_close($db)?>
        </div>   
        <footer  class="text-center mt-5 py-2">
            <p style="margin-top:240px">&copy 2021. Made by <b>Ghanathe Rakesh</b><br>The Sparks Foundation GRIP</p>
         </footer> 
    </body>
</html>