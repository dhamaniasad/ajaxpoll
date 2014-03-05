<?php
$vote = $_REQUEST['vote'];

//get content of textfile
$filename = "poll_result.txt";
$content = file($filename);

//put content in array
$array = explode("||", $content[0]);
$ac = $array[0];
$an = $array[1];
$aa = $array[2];
$rk = $array[3];


if ($vote == 0)
  {
  $ac = $ac + 1;
  }
if ($vote == 1)
  {
  $an = $an + 1;
  }
if ($vote == 2)
  {
  $aa = $aa + 1;
  }
if ($vote == 3)
  {
  $rk = $rk + 1;
  }

//insert votes to txt file
$insertvote = $ac."||".$an."||".$aa."||".$rk;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>

<h2>Result:</h2>
<table>
<tr>
<td>Option 1</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>%
</td>
</tr>
<tr>
<td>Option 2</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($an/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($an/($ac+$an+$aa+$rk),4)); ?>%
</td>
</tr>
<tr>
<td>Option 3</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($aa/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($aa/($ac+$an+$aa+$rk),4)); ?>%
</td>
</tr>
<tr>
<td>Option 4</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($rk/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($rk/($ac+$an+$aa+$rk),4)); ?>%
</td>
</tr>
</table>