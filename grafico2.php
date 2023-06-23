<?php // content="text/plain; charset=utf-8"

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');

try
{
    $pdo = new PDO("mysql:dbname=agenda;host=localhost","root","123456");
}
catch(PDOException $e)
{
    echo "Erro com banco de dados: ".$e->getMessage();
}
catch (Exception $e)
{
    echo "Erro generico: ".$e->gerMessage();
}

$data1y=array(1205,1834,4059,3897,5950,6308);
$data2y=array(670,405,0,243,58,0);

// Create the graph. These two calls are always required
$graph = new Graph(500,400);
$graph->cleartheme();
$graph->SetScale("textlin");

$graph->SetShadow();
$graph->img->SetMargin(60,40,30,50);

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("green");
$b1plot->value->Show();
$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("red");
$b2plot->value->Show();

// Create the grouped bar plot
$gbplot = new AccBarPlot(array($b1plot,$b2plot));

// ...and add it to the graPH
$graph->Add($gbplot);

$graph->title->Set("Arrecadacao de doacoes 2023:
 Vermelho: falta | Verde: arrecadado");
$graph->xaxis->title->Set("meses");
$graph->yaxis->title->Set(" 
valor R$");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();
?>
