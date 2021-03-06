<?php

require_once "inc/session.php";
require_once "inc/conn.php";

$total_energy_consumed = energy_format(($db->query("SELECT SUM(last_power) FROM device_power_graph"))->fetchArray(SQLITE3_ASSOC)['SUM(last_power)'], 2);

$meter_power = energy_format(($db->query("SELECT SUM(total_power) FROM meter_summary WHERE meter_type='G'"))->fetchArray(SQLITE3_ASSOC)['SUM(total_power)'], 2);

$meter_power_2 = energy_format(($db->query("SELECT SUM(total_power) FROM meter_summary WHERE meter_type='C'"))->fetchArray(SQLITE3_ASSOC)['SUM(total_power)'], 2);

?>


<center>
	<div  style="margin-top: -40px;margin-bottom: 60px;">
	<a href="dongle_view.php"><img src="assets/logo/adeus_logo.png" width="200"/></a>
	</div>
</center>

		<div class="row" style="display:none">

			<div class="col-lg-6">

                <div class="time-card">
                    <div style="overflow: hidden;">
                        <div style="display: inline;">
							<img src="assets/images/weather-rain.png" style="width: 30%;" class="mt-1"/>
                        </div>
						<div style="display: inline; font-size: 35px; font-weight: bold;">
							22&deg;C
                        </div>
                        <div style="display: inline; float: right;">
                            <p style="font-size: 35px; font-weight: bold;" id="dashboardTime"><?php echo date("h:i") ?> <small><?php echo date("A") ?></small></p>
                            <p style="font-size: 20px;" id="dashboardDate"><?php echo date("l d M, Y"); ?></p>
                            <p style="font-size: 15px">Ibadan, Nigeria</p>
                        </div>
                    </div>
                </div>

			</div>

			<div class="col-lg-6 m-0 p-0" style="display: flex; align-items: center;">

			    <div class="row w-100 m-0 p-0">

			        <div class="col">

    		            <div class="bg-white p-3 br-20">

    		                <small style="display: flex; align-items: center; margin-bottom: 8px">

    		                    <div style="display: inline-flex; align-items: center; justify-content-center; width: 35px; height: 35px; padding: 5px;" class="rounded-circle bg-white shadow-sm">
    		                        <img src="assets/svgs/tg1.svg" style="width: 30px; height: 30px;"/>
    		                    </div>
    		                    <span style="margin-left: 5px; color: #FFAF47;">
    		                        +--%
    		                    </span>

    		                </small>

    		                <h6 style="font-weight: 900" id="dashboardTEC" class="mb-0"><img src="assets/svgs/energy1.svg" style="width: 20px; height: 20px;"/> -- </h6>

    		                <small style="font-size: 10px">Sockets Consumed</small>

    		            </div>

    		        </div>

    		        <div class="col">

    		            <div class="bg-white p-3 br-20">

    		                <small style="display: flex; align-items: center; margin-bottom: 8px">

    		                    <div style="display: inline-flex; align-items: center; justify-content-center; width: 35px; height: 35px; padding: 5px;" class="rounded-circle bg-white shadow-sm">
    		                        <img src="assets/svgs/we1.svg" style="width: 30px; height: 30px;"/>
    		                    </div>
    		                    <span style="margin-left: 5px; color: #02BC47;">
    		                        +--%
    		                    </span>

    		                </small>

        		            <h6 style="font-weight: 900" id="dashboardTEG" class="mb-0"><img src="assets/svgs/energy1.svg" style="width: 20px; height: 20px;"/> -- </h6>

        		            <small style="font-size: 10px">Total Energy Generated</small>

    		            </div>

    		        </div>

    		        <div class="col">

    		            <div class="bg-white p-3 br-20">

    		                <small style="display: flex; align-items: center; margin-bottom: 8px">

    		                    <div style="display: inline-flex; align-items: center; justify-content-center; width: 35px; height: 35px; padding: 5px;" class="rounded-circle bg-white shadow-sm">
    		                        <img src="assets/svgs/GF1.svg" style="width: 30px; height: 30px;"/>
    		                    </div>
    		                    <span style="margin-left: 5px; color: #2D62ED;">
    		                        +--%
    		                    </span>

    		                </small>

        		            <h6 style="font-weight: 900" class="mb-0">&#8358; -- k</h6>

        		            <small style="font-size: 10px">Total Revenue</small>

    		            </div>

    		        </div>

			    </div>

			</div>

		</div>

		<div class="row mt-4">

		    <div class="col-lg-8">

		        <div class="bg-white p-4 br-20">

		            <div style="display: flex; justify-content: center;">
		                <div style="width: 95%;">
		                    <div class="row" style="display: flex; justify-content: center; margin-bottom: 10px; margin-left: 25px;">
        					    <div class="col-8">

        					        <span style="margin-right: 25px">

        					            <div style="width: 15px; height: 15px; background-color: #2d62ed; display: inline-block; border-radius: 5px"></div>

        					            CONSUMPTION BALANCE

        					        </span>

        					        <span>

        					            <div style="width: 15px; height: 15px; background-color: #02bc47; display: inline-block; border-radius: 5px"></div>

        					            PRODUCTION SALE

        					        </span>

        					    </div>
        					    <div class="col-4" style="text-align: right;">

        					         <select class="br-20 d-inline" style="width: 150px; height: 45px; padding: 10px;" id="energyTimeSelect">
			    		                <option value="all">All Time</option>
			                            <option value="yesterday">Yesterday</option>
			                            <option value="3_days">3 days ago</option>
			                            <option value="last_week">Last Week</option>
			                            <option value="last_month">Last Month</option>
			                            <option value="custom">Custom</option>
                		            </select>

        					    </div>
        					</div>
		                    <h6 style="margin-left: 20px; margin-bottom: 20px;"><b>&nbsp;</b></h6>
		                    <div class="glass" id="chartContainer" style="height: 200px"></div>
		                </div>
		            </div>

				</div>




		<div class="row mt-4">

		    <div class="col-lg-6">

		        <div class="bg-white br-20 p-3">

		            <div class="row m-0 p-0">

                        <?php
                            $devices_sql = $db->query("SELECT * FROM device_summary");
                            $devices_list = array();

                            while ($ds_x = $devices_sql->fetchArray(SQLITE3_ASSOC)) {
                                $devices_list[] = $ds_x;
                            }

                            foreach ($devices_list as $d) {
                                if ($d['device_name']=='unknown') {
								$x_id = $d['device_id'];
								$off_time = $db->query("SELECT off_time FROM device_active WHERE device_id='$x_id' ORDER BY id DESC LIMIT 0,1")->fetchArray(SQLITE3_ASSOC)['off_time'];
								if (($off_time+60) > $time_buffer) {
									?>

                                <div class="col-6 p-0" onclick="pager('devices.php', 'notifyNav')">

                                    <div class="p-3 br-20 m-2" style="background-color: #f5f5f5; color: #333; overflow: hidden;">

                                        <div style="display: inline;">
                                        </div>

                                        <div style="display: inline; margin-left: 5px;">

                                            <span class="font-weight-bold">NEW DEVICE - <?php echo $d['device_id']; ?></span>

                                        </div>


                                    </div>

                                </div>
                                <?php
		                            }
                                }else{
									$d_id= $d['device_id'];
									$last_active=$db->query("SELECT off_time FROM device_active WHERE device_id='$d_id'")->fetchArray()['off_time'];
									$active=false;
									if( time()-$last_active < 60){
										$active=true;
									}
									$active=true;
									?>

                                <div class="col-6 p-0">

                                    <div class="p-3 br-20 m-2" style="<?php echo $active ? @$styles[$d['device_name']]['bg'] : $styles['disabled']['bg']; ?> overflow: hidden; cursor: pointer;">

                                        <div style="display: inline;" onclick="showDeviceInfo('<?php echo $d['device_id'];?>')">

                                            <img src="assets/svgs/<?php echo @$styles[$d['device_name']]['icon']; ?>" style="width: 40px; height: 40px;"/>

                                        </div>

                                        <div style="display: inline; margin-left: 5px;" onclick="showDeviceInfo('<?php echo $d['device_id'];?>')">

                                            <span class="font-weight-bold" style="font-size: 12px; <?php echo $active ? @$styles[$d['device_name']]['color'] : $styles['disabled']['color']; ?>"><?php echo $d['device_name']; ?></span>

                                        </div>

                                        <div style="display: inline; float: right; margin-top: 3px">

                                            <label class="switch" style="transform: rotate(90deg)">
                                                <input <?php echo $active ? '': 'disabled';?> onclick="toggleDevice('<?php echo $d['device_id']; ?>')" type="checkbox" <?php echo $d['state'] ? "":"checked"; ?> id="<?php echo $d['device_id'];?>_input">
                                                <span class="slider" <?php echo $active ? '': "style='background:grey'";?>></span>
                                            </label>

                                        </div>

                                    </div>

                                </div>
                    			<?php } } ?>


		            </div>

		        </div>

		    </div>

		    <div class="col-lg-6">

		        <div class="bg-white br-20 p-4" style="display: none">

		            <div class="table-responsive p-0" style="font-size: 12px !important">

		            	<table class="table table-lg table-hover">

	            		  	<thead>
						 		<tr>
						    		<th scope="col">Tracking ID</th>
						      		<th scope="col">Receiver's ID</th>
						      		<th scope="col">Status</th>
						      		<th scope="col">Price</th>
							    </tr>
							</thead>

						  	<tbody>

						    	<tr class='clickable-row' data-href='#'>
						      		<td><b>#23444</b></td>
						      		<td><b>johnman@gmail.com</b></td>
						      		<td><b class="text-success">Confirmed</b></td>
						      		<td><b>&#8358; 35,000</b></td>
						    	</tr>

						    	<tr class='clickable-row' data-href='#' style="background-color: #CFF1E4;">
						      		<td>#23444</td>
						      		<td>johnman@gmail.com</td>
						      		<td><span class="text-danger">Pending</span></td>
						      		<td><b>&#8358; 35,000</b></td>
						    	</tr>

						  	</tbody>
		            	</table>
		            </div>
				</div>

		    </div>

		</div>



		    </div>

		    <div class="col-lg-4">

		        <div class="row">

		            <div class="col">

		                <div class="bg-2 text-white br-20 energy-card" style="position: relative;">

		                    <div class="pos-top w-100">
		                        <img src="assets/svgs/tg2.svg" style="width: 85px; height: 85px; margin: -10px 0px 0px -10px; fill: white;"/>
		                    </div>

		                    <div class="pos-left-center p-3">
		                        <h3 id="dashboardSM" style="font-weight: 900;"><?php echo $meter_power_2;?></h3>

		                        <p>CONSUMPTION<br/>BALANCE</p>
		                    </div>

		                    <div style="border: 1px solid #fff ;display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;" class="rounded-circle p-3 pos-br">
		                        <span class="bx bx-right-arrow-alt" style="font-size: 20px;"></span>
		                    </div>

		                </div>

		            </div>
		            <div class="col">

		                <div class="text-white br-20 energy-card gradient-back" style="position: relative;">

		                    <div class="pos-top w-100">
		                        <img src="assets/svgs/we2.svg" style="width: 70px; height: 70px; fill: white;"/>
		                    </div>

		                    <div class="pos-left-center p-3">
		                        <h3 style="font-weight: 900;"><?php echo $meter_power;?></h3>

		                        <p>PRODUCTION<br/>SALE</p>
		                    </div>

		                    <div style="background-color: #dadee6; display: flex; align-items: center; justify-content: center; width: 40px; height: 40px;" class="rounded-circle p-3 pos-br">
		                        <span class="bx bx-right-arrow-alt" style="font-size: 20px; transform: rotate(45deg);"></span>
		                    </div>

		                </div>

		            </div>

		        </div>

		        <div class="row mt-4">

		            <div class="col-12">

		                <!-- <select id="energyTimeSelect" style="border-radius: 24px; height: 60px; width: 100%; border: none; padding: 10px;">
    		                <option value="all">All Time</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="3_days">3 days ago</option>
                            <option value="last_week">Last Week</option>
                            <option value="last_month">Last Month</option>
                            <option value="custom">Custom</option>

    		            </select> -->

		            <div class="br-20 gradient-back" style="margin-top: 10px; left: 10px; width: 200px; font-size: 16px;color: #fff;text-align: center;padding: 20px;">

		                <p>Hi! I'm Viviene. The Market looks nice today !!</p>

		                <br>

		                <p>See More <i class="bx bx-right-arrow-alt" style="font-size: inherit; line-height: inherit;"></i></p>

		            </div>



		            </div>

		        </div>


		    </div>

		</div>


<!-- end #page div -->
	</div>
<!-- end .page-content div -->
</div>


<div class="clearfix"></div>

<div id="scriptLoader"></div>

<script src="assets/js/canvasjs.min.js"></script>

<script>
    var postLink = "inc/post.php";


    function toggleDevice(e){
    	var state = $("#"+e+"_input").prop('checked');
    	new_state = "0";
    	if(state){var new_state = '1';}
        $.post(postLink, {toggle_id: e, toggle_state: new_state}, function(res){
            console.log(res);
        });
    }

</script>



<script>


$(document).ready(function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	axisX:{
		title: "Days",
		// maximum: 30
	},
	axisY:{
		title: "units",
		// maximum: 60
	},
	data: [{
		type: "line",
		indexLabelFontSize: 16,
		dataPoints: [
		<?php 
		$day_30 = date("Y-m-d", strtotime("30 days ago"));
		$all_energy=$db->query("SELECT * FROM device_power_graph WHERE day>'$day_30'");
		while($x2 = $all_energy->fetchArray(SQLITE3_ASSOC)){
			@$all_energies[$x2['day']]+=$x2['last_power'];
		}


			if(1){
				for($i=29;$i>-1;$i--){ 
				$day_index = date("Y-m-d", strtotime("$i days ago"));
			?>
			{ x: <?php echo $i;?>, y: <?php echo isset($all_energies[$day_index]) ? $all_energies[$day_index]: 0; ?> },
		<?php } } ?>
		],
		color: "#2d62ed"
	},{
		type: "line",
		indexLabelFontSize: 16,
		dataPoints: [
		<?php 
			if(1){
		$day_30 = date("Y-m-d", strtotime("30 days ago"));
		$all_energy2=$db->query("SELECT * FROM meter_power_graph WHERE meter_type='G' AND day>'$day_30'");
		while($x3 = $all_energy2->fetchArray(SQLITE3_ASSOC)){
			@$all_energies2[$x3['day']]+=$x3['last_power'];
		}


				for($i=29;$i>-1;$i--){ 
				$day_index = date("Y-m-d", strtotime("$i days ago"));
			?>
			{ x: <?php echo $i;?>, y: <?php echo isset($all_energies2[$day_index]) ? $all_energies2[$day_index]: 0; ?> },
		<?php } } ?>
		],
		color: "#02bc47"
	}]
});
chart.render();



	
	function updatePage(){
		$.post(postLink, {update_page:  'dashboard', energy_period: $("#energyTimeSelect").val()}, function(res){
			console.log(res);
            if (nlp = JSON.parse(res)){
				document.getElementById('dashboardTime').innerHTML = nlp.dashboardTime;
				document.getElementById('dashboardDate').innerHTML = nlp.dashboardDate;
				document.getElementById('dashboardTEG').innerHTML = nlp.dashboardTEG;
				document.getElementById('dashboardSM').innerHTML = nlp.dashboardTEC;
				document.getElementById('dashboardTEC').innerHTML = nlp.dashboardSM;
				// document.getElementById('device_energy').innerHTML = nlp.device_energy;
				// document.getElementById('meter').innerHTML = nlp.meter;
				// document.getElementById('time').innerHTML = nlp.time;

				var devices = nlp.devices;

				for (var i = devices.length - 1; i >= 0; i--) {
					if (devices[i].state==1) {
						$("#" + devices[i].device_id + "_input").prop("checked", true);
					}else{
						$("#" + devices[i].device_id + "_input").prop("checked", false);
					}

					if (devices[i].active=='true') {
						$("#" + devices[i].device_id + "_input").parent().show();
					}else{
						$("#" + devices[i].device_id + "_input").parent().hide();
					}
				}

				console.log(nlp);
				setTimeout(function(){
					updatePage();
				}, 5000);
			}
  
        });
	}

	updatePage();




});
</script>


<?php 
$db->close();
unset($db);
 ?>
