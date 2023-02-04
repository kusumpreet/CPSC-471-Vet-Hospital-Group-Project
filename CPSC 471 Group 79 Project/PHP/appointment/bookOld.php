<?Php
$client_ID = $_GET['client_ID'];



?>

<form method=post name=selectDate action='setAppt.php?id=<?php echo $client_ID;?>'>

<table border="0" cellspacing="0" >

<tr><td  align=left  >  
Month:
<div id = "months"> </div>

</td><td  align=left  >   

Day:
<div id = "days"> </div>

</td><td  align=left  >   
Year:
<div id = "years"> 
<select id ="year" name="year">
<option value='2021'>2021</option>
<option value='2022'>2022</option>
</select>
</div>

</td><td align=left><br>
<input type=hidden value="999"  id="month" name="month">
<input type=hidden value="999"  id="day" name="day">
<input type=hidden value="999"  id="times" name="time">
<input type=button value=Submit onclick="mySubmit()">
</td></tr>
</table>
</form>


<script> 
var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var days   = [31,28,31,30,31,30,31,31,30,31,30,31];
var month_value = 1;
var day_value = 1;

function monthSelected(object) 
    {
    var value = object.value;
    //console.log('month selected is: ' + value);
    month_value = value;
    createDays(value);
    }

function daySelected(object) 
    {
    var value = object.value;
    //console.log('day selected is: ' + value);
    day_value = value;
    }
    
function createMonths() 
    {
    var options = '<select id="months" onchange="monthSelected(this)">Select Month';
    var end = 12;
    for (i = 1; i <= end; i++)
        {
        options += "<option value='" + i + "'>" + months[i-1] + "</option>";
        }
    options += '</select>';
    document.getElementById('months').innerHTML = options;
    }
    
function createDays(month) 
    {
    var options = '<select id="days" onchange="daySelected(this)">Select Day';
    var end = days[month-1];
    for (i = 1; i <= end; i++)
        {
        options += "<option value='" + i + "'>" + i + "</option>";
        }
    options += '</select>';        
    document.getElementById('days').innerHTML = options;
    }
    
function mySubmit()
    {
    //console.log ('month value ' + month_value);
    //console.log ('day value '   + day_value);
    document.getElementById('month').value = month_value;
    document.getElementById('day'  ).value = day_value;
    document.selectDate.submit();
    //showValues();
    }

function showValues()
    {
    console.log('month is: ' + document.getElementById('month').value);
    console.log('day is: ' + document.getElementById('day').value);
    console.log('year is: ' + document.getElementById('year').value);
    }

createMonths();
createDays(1);

</script>