<?php

$connect_error = 'Sorry, we\'re currently experincing connection problems.';

//Connecting to DB, and ECHO Error if cannot
mysql_connect('localhost','root','') or die($connect_error);
mysql_select_db('Network') or die ($connect_error);

?>