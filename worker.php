<?php
/* 

Author- Rishin S Babu  
Set this worker up using Cron or frequent Cron
queue.txt has all the jobs listed, completed.txt has all the completed jobs. 
Add new jobs to queue.txt and they will be added to completed.txt once the task is executed 





*/

$handle = fopen("queue.txt", "r");
$completed = file("completed.txt", FILE_IGNORE_NEW_LINES);

if ($handle) {
    while (($script = fgets($handle)) !== false) {
	if(!in_array(trim($script),$completed)){
		try{
	    		include_once(trim($script));
	    		file_put_contents("completed.txt", trim($script).PHP_EOL, FILE_APPEND);
	
		}
		catch (Exception $e) {
    		continue;
		} 
	}
    
   }
    fclose($handle);
} else {
    print("No Tasks to run");
} 




?>
