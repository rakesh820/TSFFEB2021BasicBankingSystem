<!Doctype html>
<html>
   <head>
      <meta  charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>TSF BANK</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
      <link rel="stylesheet" href="Customers.css">
      <style>
         ul{
              list-style-type: none;
              margin:0;
              padding: 0;
          }
         li{
              float: right;  
              margin-right:50px;
         }        
         li a{
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
            <h1 style="margin-top:30px">Customers Information</h1>
            <table class="table" style="background-color:white; margin-top:30px; margin-left:auto; margin-right:auto; border: 3px solid black; width:900px" > 
               <thead class="thead-dark" >
                   <tr>
                       <td scope="col">Id</td>
                       <td scope="col">Name</td>
                       <td scope="col">Email</td>
                       <td scope="col">Current Balance</td>
                       <td scope="col">Operation</td>
                   </tr>
                </thead>
                <?php
                    $db=mysqli_connect("localhost:3307","root","","b");
                    if(!$db){
                         die("Connection failed!!".mysqli_connect_error());
                    }
                    $ql = "SELECT * FROM customers";
                    $records=mysqli_query($db,$ql)or die( mysqli_error($db));;
                    while($data=mysqli_fetch_array($records)){?>
                       <tr class="t">
                           <td ><?php echo $data['Id']; ?></td>
                           <td ><?php echo $data['Name']; ?></td>
                           <td ><?php echo $data['Email']; ?></td>
                           <td><?php echo $data['Current_Balance']; ?></td>
                           <td><a href="Transfer.php?Id= <?php echo $data['Id']; ?>"><button type="button" style="height:32px; padding-top:3px" id="button2" class="btn btn-primary">Transfer Money</button></a></td>
                        </tr>
                        <?php
                     }
                       ?>         
            </table>
            <?php mysqli_close($db)?>
         </div>
         <footer class="text-center mt-5 py-2">
              <p>&copy 2021. Made by <b>Ghanathe Rakesh</b><br>The Sparks Foundation GRIP</p>
         </footer>
    </body>
</html>