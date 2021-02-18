<?php
     $db=mysqli_connect("localhost:3307","root","","b");
     if(!$db){
         die("Connection failed!!".mysqli_connect_error());
     }
     if (isset($_POST['submit'])) {
          $from = $_GET['Id'];
          $to = $_POST['to'];
          $amount = $_POST['amount'];

          $sql = "SELECT * from customers where Id=$from";
          $query = mysqli_query($db, $sql);
          $sql1 = mysqli_fetch_array($query);

          $sql = "SELECT * from customers where Id=$to";
          $query = mysqli_query($db, $sql);
          $sql2 = mysqli_fetch_array($query);
          if (($amount) < 0) {
                 echo '<script type="text/javascript">';
                 echo ' alert("Oops! Negative values cannot be transferred")'; 
                 echo '</script>';
           }
           else if ($amount > $sql1['Current_Balance']) {
                 echo '<script type="text/javascript">';
                 echo ' alert("Bad Luck! Insufficient Balance")';  
                 echo '</script>';
          }
          else if ($amount == 0) {
                 echo "<script type='text/javascript'>";
                 echo "alert('Oops! Zero value cannot be transferred')";
                 echo "</script>";
          } 
          else {
                $newbalance = $sql1['Current_Balance'] - $amount;
                 $sql = "UPDATE customers set Current_Balance=$newbalance where Id=$from";
                 mysqli_query($db, $sql);
       
                 $newbalance = $sql2['Current_Balance'] + $amount;
                 $sql = "UPDATE customers set Current_Balance=$newbalance where Id=$to";
                 mysqli_query($db, $sql);

                 $sender = $sql1['Name'];
                 $receiver = $sql2['Name'];
                 $sql = "INSERT INTO transfers(`Sender`, `Receiver`, `Amount`) VALUES ('$sender','$receiver','$amount')";
                 $query = mysqli_query($db, $sql);
                 if ($query) {
                      echo "<script> alert('Transaction Successful');</script>";
                 }
           }      
    }
?>
<!Doctype html>
<html>
   <head>
      <meta  charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>TSF BANK</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
      <link rel="stylesheet" href="Transfer.css">
      <style>
         ul{
             list-style-type: none;
             margin:0;
             padding: 0;
          }
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
       </style>  
    </head>
    <body>
        <div class="v">
           <ul >
              <li><a href="index.php">Home</a></li>
              <li><a href="Customers.php">Back</a></li> 
           </ul>
        </div>
        <br>
        <h1>Transfer Amount</h1>
        <table class="table" style="background-color:white; margin-top:40px; margin-left:auto; margin-right:auto; border: 3px solid black; width:700px" > 
           <thead class="thead-dark" >
             <tr>
                <td scope="col">Id</td>      
                <td scope="col">Name</td>
                <td scope="col">Email</td>
                <td scope="col">Current Balance</td>
             </tr>
            </thead>
            <?php
                $db=mysqli_connect("localhost:3307","root","","b");
                if(!$db){
                    die("Connection failed!!".mysqli_connect_error());
                }
                $sid = $_GET['Id'];
                $ql = "SELECT * FROM customers where Id=$sid";
                $records=mysqli_query($db,$ql)or die( mysqli_error($db));;
                while($data=mysqli_fetch_array($records)){
            ?>
                    <tr class="t">
                         <td ><?php echo $data['Id']; ?></td>
                         <td ><?php echo $data['Name']; ?></td>
                         <td ><?php echo $data['Email']; ?></td>
                         <td><?php echo $data['Current_Balance']; ?></td>
                    </tr>
                <?php
                }
                ?>         
        </table>
        <?php mysqli_close($db)?>
        <form method="post" name="tcredit">
           <label class="l">Transfer To:</label><br>
           <select name="to" class="o" required>
               <option value="" disabled selected>Choose</option>
                 <?php
                     $db=mysqli_connect("localhost:3307","root","","b");
                     if(!$db){
                         die("Connection failed!!".mysqli_connect_error());
                      }
                      $sid = $_GET['Id'];
                      $sql = "SELECT * FROM customers where Id!=$sid";
                      $result = mysqli_query($db, $sql);
                      while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                            <option class="table" value="<?php echo $rows['Id']; ?>">
                                <?php echo $rows['Name']; ?> (Balance:<?php echo $rows['Current_Balance']; ?> )
                            </option>
                     <?php
                      }
                     ?>
            </select><br>
             <label class="l" >Amount:</label><br>
            <input class="o" type="text" placeholder="Enter the Amount" name="amount" required><br>
            <button  style="margin-left:700px; margin-top:40px" class="btn btn-primary" type="submit" name="submit">Transfer</button> 
        </form>
        </div>
        <footer  class="text-center mt-5 py-2">
              <p style="margin-top:10px">&copy 2021. Made by <b>Ghanathe Rakesh</b><br>The Sparks Foundation GRIP</p>
      </footer> 
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>