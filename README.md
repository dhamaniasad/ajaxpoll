ajaxpoll
========

A simple AJAX polling script

Live Demo : [Click Here](http://dhamaniasad.github.io/ajaxpoll/)

###### Live Demo seems to be malfunctioning; however, the production code has been tested and works as expected.

Download : [Click Here](https://github.com/dhamaniasad/ajaxpoll/archive/production.zip)

### Screenshots
***
![Polling Screen](screenshot1.png)t

![Result Screen](screenshot.png)

### Setting up on Linux server
***
Use my script [here](https://github.com/dhamaniasad/lowendscript) to easily set up a LEMP server to host the polling script on a VPS. If you want to host this script on a shared hosting account, it is as easy as uploading all the relevant files to a directory in your web root folder.

These are the files you must place in your web folder(public_html | /var/www/ | /usr/share/nginx/html | etc.)

```
index.html
poll.gif
poll_result.txt
poll_vote.php
style.css
```
To download the production archive containing only the abovementioned files, [click here](https://github.com/dhamaniasad/ajaxpoll/archive/production.zip)

### Adding/Removing Options
***
Adding or removing options is a little bit more complex than using the rest of the script. Hence, I am adding instructions on doing that below. Now obviously, the minimmum amount of options you can have is 2, and the production archive file contains 4 options by default. 

#### Adding Options
First, open up your index.html file in your preferred text editor, and find this code :
```
<div id="poll">
<h3>Place your options here:</h3><br>
<form>
Option 1:
<input type="radio" name="vote" value="0" onclick="getVote(this.value)" />
<br />Option 2:
<input type="radio" name="vote" value="1" onclick="getVote(this.value)" />
<br />Option 3:
<input type="radio" name="vote" value="2" onclick="getVote(this.value)" />
<br />Option 4:
<input type="radio" name="vote" value="3" onclick="getVote(this.value)" />
</form>
</div>
```
Now, to add more options, simply do this : 
```
<div id="poll">
<h3>Place your options here:</h3><br>
<form>
Option 1:
<input type="radio" name="vote" value="0" onclick="getVote(this.value)" />
<br />Option 2:
<input type="radio" name="vote" value="1" onclick="getVote(this.value)" />
<br />Option 3:
<input type="radio" name="vote" value="2" onclick="getVote(this.value)" />
<br />Option 4:
<input type="radio" name="vote" value="3" onclick="getVote(this.value)" />
<br />Option 5:
<input type="radio" name="vote" value="4" onclick="getVote(this.value)" />
<br />Option 6:
<input type="radio" name="vote" value="5" onclick="getVote(this.value)" />
</form>
</div>
```

What you have to do here is pretty obvious. Just keep adding this line : 
```
<br />Option x:
<input type="radio" name="vote" value="x" onclick="getVote(this.value)" />
```
Replace 'Option x' with whatever you want the option to be, and in the 'value="x"' part, just look at the value of the last option, and add 1 to it, in a n+1 fashion.

The next file you need to edit is poll_vote.php.

There are four main parts to the poll_vote.php file that you need to edit. They are as follows : 

```
//put content in array
$array = explode("||", $content[0]);
$ac = $array[0];
$an = $array[1];
$aa = $array[2];
$rk = $array[3];
```

```
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
```

```
//insert votes to txt file
$insertvote = $ac."||".$an."||".$aa."||".$rk;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>
```

```
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
```

Part 1:
```
//put content in array
$array = explode("||", $content[0]);
$ac = $array[0];
$an = $array[1];
$aa = $array[2];
$rk = $array[3];
```
Here, what you do is you basically give each option a name, similar to the $ac, $an, $aa, and $rk. $ab or $bc both are perfectly fine examples of this.
This is how the code looks here;
```
$rk = $array[3];
```
The $rk is the name or identifier, whatever you like to call it, and this is where you are defining how you want to identify a certain option in the rest of the code of the script. The [3] here corresponds to the 'value="3"' we took from the index.html file. Basically what I'm saying is, these two parts of code are linked with one another :
```
<br />Option 4:
<input type="radio" name="vote" value="3" onclick="getVote(this.value)" />
```
```
$rk = $array[3];
```
The 3 remains the same in each of them. If instead of 3, I put 4 in $array[], then it would correspond to the option with value 4, or Option 5, since we are using whole numbers.

So in order to add more functions, after adding them to the index.html file, this is what you're going to have to do :
```
//put content in array
$array = explode("||", $content[0]);
$ac = $array[0];
$an = $array[1];
$aa = $array[2];
$rk = $array[3];
$op = $array[4];
$ab = $array[5];
```
And obviously, you can use $xy instead of $op or anything else you like. I prefer to keep it double digit but you don't have to, just so long as you don't put spaces in between you should be fine.

Part 2:
```
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
```
In this part, you can simply copy paste this section :
```
if ($vote == 3)
  {
  $rk = $rk + 1;
  }
```
And then modify it to match the changes you've made earlier, like this :
```
if ($vote == 4)
  {
  $op = $op + 1;
  }
if ($vote == 5)
  {
  $ab = $ab + 1;
  }
```
And so, your end result should look like this :
```
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
if ($vote == 4)
  {
  $op = $op + 1;
  }
if ($vote == 5)
  {
  $ab = $ab + 1;
  }
```

Part 3:
```
//insert votes to txt file
$insertvote = $ac."||".$an."||".$aa."||".$rk;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>
```
Now this is the part which saves your result to the text file poll_result.txt by default. The name of the file is defined in this part of the code:
```
//get content of textfile
$filename = "poll_result.txt";
$content = file($filename);
```
If you decide to change the name of the text file, be sure to add an empty txt file matching that name to the root directory of the script.
Editing this part isn't difficult either. You only have to edit this part :
```
$insertvote = $ac."||".$an."||".$aa."||".$rk;
```
And make sure it matches the changes we've made up till now. This is how your end result should look :
```
$insertvote = $ac."||".$an."||".$aa."||".$rk."||".$op."||".$ab;
```
The syntax of this part is pretty easy to understand if you just compare the two parts I've pasted here($insertvote). At this point, you cannot change the $op or $ab, or whatever else you called the options, as that would break your code. Just keep that in mind. 

Part 4:
```
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
```
This is the final part. The heading, `<h2>Result:</h2>`, can of course be changed to something else if you like. To change 'Result:' to something else, for instance, 'Outcome :', you'd have to change the code to this :  `<h2>Outcome :</h2>`. 
This is the main component of the code :
```
<tr>
<td>Option 1</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>%
</td>
</tr>
```
Now if you've been calling your options Option 1, 2, 3, 4 and so on, then you can of course keep it that way, or if you've called them something else, then you must rename it here to match. Basically you match it to whatever you called it in the index.html file;
```
Option 1:
<input type="radio" name="vote" value="0" onclick="getVote(this.value)" />
```
```
<tr>
<td>Option 1</td>
```
Naming aside, we move to the math of it all. This is the part of the code that plots the graph for you in the end, after you submit the vote. <br>
**Now remember, this script is meant to be used in local environments, since it is possible to vote as many times as you like just by refreshing the page. There are better scripts out there if you wish to run a polling script in a non-local environment. You can of course use SurveyMonkey, but I personally prefer [LimeSurvey](http://www.limesurvey.org) over all else.**
```
width='<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>%
```
Now editing this part of the code isn't difficult either, just keep the syntax in mind. $ac corresponds to Option 1 here.
To get this part of the code to match the changes we've made so far, here's the changes we've got to make.
```
width='<?php echo(100*round($ac/($ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($ac/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
```
Now as you can notice, we added the two other options that we added earlier to the code, namely $op and $ab, and since that makes for six options, as opposed to four earlier, we changed the ',4));' in the end to ',6));'. After modifying all of the code for the new options, this is what we will end up with :
```
<h2>Result:</h2>
<table>
<tr>
<td>Option 1</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($ac/$ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($ac/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
</td>
</tr>
<tr>
<td>Option 2</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($an/($ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($an/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
</td>
</tr>
<tr>
<td>Option 3</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($aa/($ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($aa/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
</td>
</tr>
<tr>
<td>Option 4</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($rk/($ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($rk/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
</td>
</tr>
<tr>
<td>Option 5</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($op/($ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($op/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
</td>
</tr>
<tr>
<td>Option 6</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($ab/($ac+$an+$aa+$rk+$op+$ab),6)); ?>'
height='60'>
<?php echo(100*round($ab/($ac+$an+$aa+$rk+$op+$ab),6)); ?>%
</td>
</tr>
</table>
```
The changes that have to be made here are pretty self explanatory. Here they are :
* change number from 4 to 6, or whatever the number of options you have added is.
* For example, if you have to add option 5, then after you copy paste this part of the code :
```
<tr>
<td>Option 1</td>
<td>
<img src="poll.gif"
width='<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>'
height='60'>
<?php echo(100*round($ac/($ac+$an+$aa+$rk),4)); ?>%
</td>
</tr>
```
You change 'Option 1' to 'Option 5', and you change $ac in this part '(100*round($ac/' to whatever it is that you named the option, in this case, $op.
* Then, you add '+$op+$ab' to '($ac+$an+$aa+$rk)' so that when it computes the graph, it also takes the newly added options into account.
