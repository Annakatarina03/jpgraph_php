<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');

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

$datay1 = array(137,204,689,656,1700,1786);
$datay2 = array(78,142,545,530,1651,1630);

// Setup the graph
$graph = new Graph(450,350);
$graph->clearTheme();
$graph->SetMarginColor('black');
$graph->SetScale("textlin");
$graph->SetFrame(false);
$graph->SetMargin(60,10,40,20);

$graph->tabtitle->Set(' 2023 ' );
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);


$graph->yaxis->HideZeroLabel();
$graph->ygrid->SetFill(true,'#EFEFEF@0.9','#BBCCFF@0.9');
$graph->xgrid->Show();

$graph->xaxis->SetTickLabels($gDateLocale->GetShortMonth());

// Create the first line
$p1 = new LinePlot($datay1);
$p1->SetColor("navy");
$p1->SetLegend('acessos ao site');
$p1->SetWeight(2); // Define a espessura da linha
$graph->Add($p1);

// Create the second line
$p2 = new LinePlot($datay2);
$p2->SetColor("green");
$p2->SetLegend('doadores');
$p2->SetWeight(2); // Define a espessura da linha
$graph->Add($p2);

$graph->legend->SetShadow('gray@0.0',10);
$graph->legend->SetPos(0.0,0.0,'right','top');
// Output line
$graph->Stroke();

?>
