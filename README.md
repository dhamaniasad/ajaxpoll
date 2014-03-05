ajaxpoll
========

A simple AJAX polling script

Live Demo : [Click Here](http://dhamaniasad.github.io/ajaxpoll/)

###### Live Demo seems to be malfunctioning; however, the production code has been tested and works as expected.

Download : [Click Here](https://github.com/dhamaniasad/ajaxpoll/archive/production.zip)

### Screenshots
***
![Polling Screen](screenshot1.png)

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


