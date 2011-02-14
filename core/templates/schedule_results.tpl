<?php
if(!$allroutes)
{
	echo '<p align="center">No routes have been found!</p>';
	return;
}
?>
<table id="tabledlist" class="tablesorter">
<thead>
<tr>
	<th>Flight Info</th>
	<th>Options</th>
</tr>
</thead>
<tbody>
<?php
foreach($allroutes as $route) {
?>
<tr>
	<td>
		<a href="<?php echo url('/schedules/details/'.$route->id);?>"><?php echo $route->code . $route->flightnum?>
			<?php echo '('.$route->depicao.' - '.$route->arricao.')'?>
		</a>
		<br />
		
		<strong>Departure: </strong><?php echo $route->deptime;?> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Arrival: </strong><?php echo $route->arrtime;?><br />
		<strong>Equipment: </strong><?php echo $route->aircraft; ?> (<?php echo $route->registration;?>)  <strong>Distance: </strong><?php echo $route->distance . Config::Get('UNITS');?>
		<br />
		<strong>Days Flown: </strong><?php echo Util::GetDaysCompact($route->daysofweek); ?><br />
		<?php echo ($route->route=='') ? '' : '<strong>Route: </strong>'.$route->route.'<br />' ?>
		<?php echo ($route->notes=='') ? '' : '<strong>Notes: </strong>'.html_entity_decode($route->notes).'<br />' ?>
		<?php
		# Note: this will only show if the above code to
		#	skip the schedule is commented out
		if($route->bidid != 0)
		{
			echo 'This route has been bid on';
		}
		?>
	</td>
	<td nowrap>
		<a href="<?php echo url('/schedules/details/'.$route->id);?>">View Details</a><br />
		<a href="<?php echo url('/schedules/brief/'.$route->id);?>">Pilot Brief</a><br />
		
		<?php 
		# Don't allow overlapping bids and a bid exists
		if(Config::Get('DISABLE_SCHED_ON_BID') == true && $route->bidid != 0)
		{
		?>
			<a id="<?php echo $route->id; ?>" class="addbid" 
				href="<?php echo actionurl('/schedules/addbid');?>">Add to Bid</a>
		<?php
		}
		else
		{
			if(Auth::LoggedIn())
			{
			 ?>
				<a id="<?php echo $route->id; ?>" class="addbid" 
					href="<?php echo url('/schedules/addbid');?>">Add to Bid</a>
			<?php			 
			}
		}		
		?>
	</td>
</tr>
<?php
 /* END OF ONE TABLE ROW */
}
?>
</tbody>
</table>
<hr>