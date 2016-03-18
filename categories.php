
<?php

$dbHost = "localhost";
$dbBase = "Cost";
$dbUser = "root";
$dbPass = "";

$MYSQL_RES = mysql_connect($dbHost,$dbUser,$dbPass) OR DIE("Error of connection");
mysql_query("SET NAMES UTF8");
mysql_select_db($dbBase) or die(mysql_error());


 
  $statement = "SELECT c.title, c.img_url, pl.`category_id`, SUM(pl.`price`) as total24, COUNT(*) as c FROM `purchases_log` as pl left join `categories` c on c.`id`=pl.`category_id` GROUP BY pl.`category_id` ORDER BY total24 desc";
  try {
  $costs = $db->query($statement);
  $purchases_log=array();
  if($costs->rowCount()){
      while ($category = $costs->Fetch()){
          $purchases_log[$category['category_id']]=$category;
      }    
    }
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }


?>


 
        <div style="width:1080px; margin:140px auto;background-color: rgba(255, 255, 255, 0.9);font-size: 20px; border-radius: 10px; border: 2px solid gainsboro;">
        
             
            <div style="font-family: sans-serif;margin:50px;vertical-align: middle">
                <?php foreach ($purchases_log as $key => $val){  ?>
                
                <div style="display:inline-block;padding: 15px 15px 0px 0px">
              <img style="width:100px;border-radius: 40px;margin: 20px" src="http://localhost/Count_the_cost/img/<?php echo $val['img_url']?>"> 
              <p style='text-decoration: none;'><?php echo $val['title']?></p>
              <p>Потрачено: <?php echo $val['total24']?>UAH </p>
              <p>Количество покупок: <?php echo $val['c'] ; ?></p>
                </div>
             
               
               <?php } ?>
            </div>

        </div>