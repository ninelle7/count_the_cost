<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Cost";


$dsn = 'mysql:dbname='.$dbname.';host='.$servername.';port=3306';
$aOptions = array ( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
try {
    $db = new PDO($dsn, $username, $password, $aOptions); 
 } catch(PDOException $e) {
    die('Could not connect to the database:<br/>' . $e);
  }


$message_sent=FALSE;
$product='';
$price='';
$date='';
$shop='';
$comment='';
$category_id='';
$order_by='id';
$order_by2='';
$count='';
$offset='0';
$limit='25';

$where='';
$where2='';
if(!empty($_REQUEST['product'])){ 
    $product=$_REQUEST['product'];           
}

if(!empty($_REQUEST['price'])){ 
    $price=$_REQUEST['price'];           
}

if(!empty($_REQUEST['shop'])){ 
    $shop=$_REQUEST['shop'];   
    $where2="WHERE `shop`='".$shop."' ";
}

if(!empty($_REQUEST['date'])){ 
    $date=$_REQUEST['date'];           
}

if(!empty($_REQUEST['comment'])){ 
    $comment=$_REQUEST['comment'];           
}

if (!empty($_REQUEST['order_by'])) {
    $order_by=$_REQUEST['order_by'];
}

if (!empty($_REQUEST['order_by2'])){
    $order_by2=$_REQUEST['order_by2'];
}

if(!empty($_REQUEST['category_id'])){
    $category_id=$_REQUEST['category_id'];
    $where="WHERE `category_id`= '".$category_id."' ";
}

if(!empty($_REQUEST['count'])){
    $count=$_REQUEST['count'];
}
if(!empty($_REQUEST['offset'])){
    $offset=$_REQUEST['offset'];
}
if ($offset<0) {
    $offset=0;
}
if(!empty($_REQUEST['limit'])){
    $limit=$_REQUEST['limit'];
}




if ($product!="" && $price!="" && $shop!="" && $date!="" && $category_id!="" && $count!="") {
    
    $product = $db->quote($product, PDO::PARAM_INT);
    $price = $db->quote($price, PDO::PARAM_INT);
    $shop = $db->quote($shop, PDO::PARAM_INT);
    $date = $db->quote($date, PDO::PARAM_INT);
    $comment = $db->quote($comment, PDO::PARAM_INT);
    
    $statement = "INSERT INTO `Cost`.`purchases_log` (`product`, `price`, `shop`, `date`, `category_id`, `comment`, `count`) VALUES (".$product.", ".$price.", ".$shop.", ".$date." , ".$category_id.", ".$comment.", ".$count.");";
    try {
    $costs = $db->query($statement);
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }

    header('location:http://localhost/Count_the_cost/main.php');   
}


  $statement = "SELECT * FROM `purchases_log` ".$where." ".$where2." ORDER BY `".$order_by."` ".$order_by2." LIMIT ".$offset.", ".$limit." ";
  try {
  $costs = $db->query($statement);
  if($costs->rowCount()){
        $purchases = $costs->FetchAll();    
    }
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  
  $statement = "SELECT SUM(`price`) as total24, COUNT(*) as c FROM `purchases_log` ".$where." ".$where2." ";
  try {
  $costs = $db->query($statement);
  if($costs->rowCount()){
        $total = $costs->FetchAll();    
    }
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  
  $statement = "SELECT * FROM `categories` ";
try {
  $costs = $db->query($statement);
  $categories=array();
  if($costs->rowCount()){
      while ($category = $costs->Fetch()){
          $categories[$category['id']]=$category['title'];
      }    
    }
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }

  
  
$page="";
$available_pages=array();
$available_pages ['main']['title']='Main Page';
$available_pages ['main']['show_header']=TRUE;
$available_pages ['main']['show_table']=TRUE;

$available_pages ['exchange_rates']['title']='Exchange Rates';
$available_pages ['exchange_rates']['show_header']=TRUE;
$available_pages ['exchange_rates']['show_table']=FALSE;

$available_pages ['converter']['tiile']='Converter';
$available_pages ['converter']['show_header']=TRUE;
$available_pages ['converter']['show_table']=FALSE;

$available_pages ['analytcs']['tiile']='Converter';
$available_pages ['analytics']['show_header']=TRUE;
$available_pages ['analytics']['show_table']=FALSE;


if (!empty($_REQUEST['page'])) { 
    $page=$_REQUEST['page'];
 }
 if (empty($available_pages[$page])) {
    $page='main';
}  
$url_parameters="&order_by=".$order_by."&order_by2=".$order_by2."&shop=".$shop."&category_id=".$category_id." ";

$time=strtotime("2016-01-20");
$days=round((time()-$time)/(3600*24));

           
?>

<html>
    <head>
        <style>
            body{
                margin: 0px;
                background-image:url(http://localhost/Count_the_cost/img/background.jpg);
                background-size: cover;
                background-attachment: fixed 
            }
            
            .text{
               color: white;         
               width:450px;
               margin:50px auto;
               font-family: sans-serif;
               font-weight: lighter;
               padding: 20px;
               text-align: center;
               
            }
            .input{
                width: 100px;
                padding: 10px;
            }
            .button{
                color:black;
                background-color: antiquewhite;
                padding: 5px 30px;
                margin: 20px;
                font-size: 15px;
                font-family: sans-serif;
                border:2px solid antiquewhite ;
                font-style:italic;
            }
            
            table{
                width:100%;
                border:1px solid white;
                border-radius: 10px;
                font-size: 20px;       
                
            }
            th{
                color:rgb(78,120,182);
                min-width: 80px;
                
            }
             td{
                color:white;
                background-color: rgba(37,99,171,0.7);
            }
        </style>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/fav.ico" type="image/x-icon"> 
         <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <div>

            
         <?php if ($available_pages[$page]['show_header']) { ?>  
         <header style="background: linear-gradient(to right, rgba(0, 140, 140, 0.4), rgba(135, 206, 250, 0.6));padding-bottom: 10px;">
                
  
             <div style="text-align: center">
            <a style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;font-weight:lighter ;font-size: 35px;text-align: center;color:white;text-decoration: none">  Enter your costs today  </a>
            <button style="margin-left:40px;width: 100px" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Go</button>   
             <div class="dropdown" style="display:inline-block; margin: 16px 0px 0px 20px;">
                      <button style="width:90px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Menu
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="http://localhost/Count_the_cost/main.php?page=exchange_rates">Exchange Rates</a></li>
                        <li><a href="http://localhost/Count_the_cost/main.php?page=converter">Converter</a></li>
                        <li><a href="http://localhost/Count_the_cost/main.php?page=analytics">Analytics</a></li>
                      </ul>
               </div>  
            </div>        
         </header>
             <?php } ?>  
           
           
        <blockquote style="color: silver;float: right; width: 400px;font-family: sans-serif;font-style: italic;border-left:0px;font-size: 16px;text-align: justify">
               Everyday is a bank account, and time is our currency. No one is rich, no one is poor, we’ve got 24 hours each.
                 <p>Christopher Rice</p>
        </blockquote>
              <?php 
            
            if ($page!=""&&$page!='main') {
            include $page.'.php';
                           }       
            ?>
            

             
 <form id="main_form" action="http://localhost/Count_the_cost/main.php">    
           
           <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="text-align:center;">
      
            <input style="width:160px;padding: 5px;margin-top: 40px" name="product" type="text"  placeholder="Product" aria-describedby="sizing-addon2">
            <input style="width:80px;padding: 5px;" name="count" type="text"  placeholder="Count" aria-describedby="sizing-addon2" value="1">
             <select class="form-control" name="category_id" style="width:160px;margin-top: 40px;display: inline-block;">  
               <?php foreach ($categories  as $key => $val){  ?>
                <option value="<?php echo $key ?>"><?php  echo $val?></option>
                 <?php } ?>
           </select>       
           
           <br>
           <input style="width:150px;padding: 5px;margin: 25px 10px" name="price" type="text"  placeholder="Price" aria-describedby="sizing-addon2"> 
           <input style="width:150px;padding: 5px;margin: 25px 10px" name="shop" type="text"  placeholder="Shop" aria-describedby="sizing-addon2">
           <input style="width:150px;padding: 5px;margin: 25px 10px" name="date" type="text"  placeholder="Date" aria-describedby="sizing-addon2">

        
           <textarea name="comment" style="width:500px;margin:20px auto;padding: 10px 0px 40px 10px" class="form-control" placeholder="Comment"></textarea>
           <button style="width: 100px;margin-bottom: 40px" type="submit" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Go</button> 
           
           
          </div>
         </div>
        </div>
          
  </form>
       <?php $next_order=($order_by2=='asc') ? 'desc': 'asc'; ?>
       <?php $icon=($next_order=='desc') ? 'glyphicon glyphicon-sort-by-attributes-alt' : 'glyphicon glyphicon-sort-by-attributes';?> 
      
            
     <?php if ($available_pages[$page]['show_table']) { ?>
            <div style="color:white;font-size: 30px; width: 80%;margin:100px auto;font-weight: lighter;">
                 <?php if(!empty($purchases)) {  ?>
                <table class="table-hover table-condensed  ">
                    
                    <tr bgcolor="#FFFFFF">
                        <th> <?php if ($order_by=='id') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=id&order_by2=<?php echo $next_order;?>">#</a></th>
                        <th> <?php if ($order_by=='product') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=product&order_by2=<?php echo $next_order;?>">Product</a></th>
                        <th> <?php if ($order_by=='price') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=price&order_by2=<?php echo $next_order;?>">Price</a></th>
                        <th> <?php if ($order_by=='shop') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=shop&order_by2=<?php echo $next_order;?>">Shop</a></th>
                        <th> <?php if ($order_by=='date') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=date&order_by2=<?php echo $next_order;?>">Date</a></th>
                        <th> <?php if ($order_by=='category_id') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=category_id&order_by2=<?php echo $next_order;?>">Category</a></th>
                        <th> Count</th>
                        <th> &nbsp<?php if ($order_by=='comment') {?><span class="<?php echo $icon;?>"aria-hidden="true"></span><?php } ?><a href="http://localhost/Count_the_cost/main.php?order_by=comment&order_by2=<?php echo $next_order;?>">Comment</a></th>
                    </tr>
                    
                    <?php foreach ($purchases as $key => $val){  ?>
                    <tr>
                        <td> <?php echo $val['id'];  ?>  </td>
                        <td> <?php echo $val['product'];  ?>   </td> 
                        <td> <?php echo $val['price'];  ?>   </td>
                        <td> <a style="color:white" href="http://localhost/Count_the_cost/main.php?shop=<?php echo $val['shop'];?>"><?php echo $val['shop'];?></a> </td>
                        <td> <?php echo $val['date'];  ?>  </td> 
                        <td>  <a style="color:white;" href="http://localhost/Count_the_cost/main.php?category_id=<?php echo $val['category_id'];?>"> <?php echo $categories [$val['category_id']]; ?> </a></td>
                        <td> <?php echo $val['count'];  ?></td>
                        <td> <?php echo $val['comment'];  ?>  </td>
                    </tr>
                    
                    <?php } ?> 
                    <tr bgcolor="#FFFFFF">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><a href="http://localhost/Count_the_cost/main.php?offset=<?php echo $offset-$limit;?><?php echo $url_parameters?>"><span class="glyphicon glyphicon-chevron-left"aria-hidden="true"></span></a></th>
                        <th><a href="http://localhost/Count_the_cost/main.php?offset=<?php echo $offset+$limit;?>&order_by=<?php echo $order_by?>&order_by2<?php echo $order_by2 ?>"><span class="glyphicon glyphicon-chevron-right"aria-hidden="true"></a></span></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                    
                 </table>    
                <?php } else {  ?>
                <img style="width:200px" src="http://localhost/Count_the_cost/img/basket.png" alt="basket"> Nothing to display
                <?php   } ?>
                <div style="background-color: white;width:100%">
                    <div style="margin-left:10px">
                     <p style="color:black;font-weight: 300;font-size: 30px"> Итого: <?php echo $total[0]['total24'] ; ?> UAH</p>
                     <p style="color:black;font-weight: 300;font-size: 30px">Общее количество покупок: <?php echo $total[0]['c'] ; ?> за <?php echo $days; ?> дней</p>
                     
                </div>
            </div>
               <?php } ?> 
         
                
                
      
            
        </div>
    </body>
</html>