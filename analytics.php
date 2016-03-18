
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
  
   $statement = "SELECT CONCAT(YEAR(`date`), '/', WEEK(`date`)) as week_num, COUNT(*) as c, SUM(`price`) as amount, SUM(if(`gift`='0',`price`,0)) as amount_no_gift FROM `purchases_log` GROUP BY CONCAT(YEAR(`date`), '/', WEEK(`date`)) ORDER BY `date` ASC";
 try {
  $costs = $db->query($statement);
  if($costs->rowCount()){
        $dates = $costs->FetchAll();    
    }
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  
  $statement = "SELECT CONCAT(YEAR(`date`), '/', WEEK(`date`)) as week_num, `category_id`, COUNT(*) as c, SUM(`price`) as amount FROM `purchases_log` GROUP BY CONCAT(YEAR(`date`), '/', WEEK(`date`), '/', `category_id`) ORDER BY `date` ASC";
   try {
  $costs = $db->query($statement);
  $categories2=array();
  if($costs->rowCount()){
      while ($category = $costs->Fetch()){
          $categories2[]=$category;
      }    
    }
   } catch(PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  
  $all_categories=array();
  foreach ($categories2 as $key => $value) {
    if(!isset($all_categories[$value['week_num']])){
        $all_categories[$value['week_num']]=array();    
      }
     $all_categories[$value['week_num']][$value['category_id']]=$value['amount'];
}

  
  //print_r($all_categories);
  //exit()
   
  
  
  ?>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
           <?php foreach ($purchases_log as $key => $val){ ?> 
          ['<?php echo $val['title']; ?>',<?php echo $val['total24'] ?>],
           <?php } ?>
        ]);
          
        // Set chart options
        var options = {'title':'Аналитика покупок по категориям',
                       'width':1200,
                       'height':600,
                       'backgroundColor': '#E4E4E4',
                       'is3D': true,
                       chartArea:{
                       width: '70%',
                       
                       left: '20%', 
                       top: '25%'}    
                   };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Amount', 'Without gifts'],
            <?php foreach ($dates as $key => $val){  ?>
          ['<?php echo $val['week_num']?>',  <?php echo $val['amount']?>, <?php echo $val['amount_no_gift']?>],
            <?php } ?>
        ]);

         var options = {'title':'Аналитика покупок по неделям',
                       'width':1200,
                       'height':600,
                       'backgroundColor': '#E4E4E4',
                        curveType: 'function',
                        colors:['#FF0000', '#0000FF'],
                        chartArea:{
                        width: '80%',                      
                        left: '10%', 
                        top: '10%'}    
                       
                       
                   }; 

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        drawChart2();
      }
    </script>
    
 
    <script type="text/javascript">

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Week',  <?php foreach ($purchases_log as $key => $val){ echo  "'".$val['title']."',"; } ?>],
            <?php foreach ($all_categories as $week_num => $day_data){  ?>
          ['<?php echo $week_num;?>', <?php foreach ($purchases_log as $key => $val){ echo  ((isset($day_data[$val['category_id']]))?$day_data[$val['category_id']]:0).","; } ?>],
            <?php } ?>
        ]);

         var options = {'title':'Аналитика покупок по неделям',
                       'width':1200,
                       'height':600,
                       'backgroundColor': '#E4E4E4',
                        legend: { position: 'bottom', alignment: 'start' },
                        chartArea:{
                        width: '80%',                      
                        left: '10%', 
                        top: '10%'}             
                   }; 

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);
      }
    </script>
    
    <div style="width:1200px;margin:100px auto">
    
        <div id="chart_div"></div>
        <div id="curve_chart" style="width: 900px; height: 500px">Test</div>
        <div id="curve_chart2" style="width: 900px; height: 500px;margin-top: 20px">Test</div>
    </div>
    
  