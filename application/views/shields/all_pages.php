
<div class="modal fade" id="delete_dv" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h4 class="modal-title" id="Heading">Delete this entry</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove ti-close" aria-hidden="true"></span></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger" style=""><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this <font class="capt1"></font>?</div>
            </div>

            <input type="hidden" id="txtall_id">
            <input type="hidden" id="txt_dbase_table" value="<?=$page_name?>">

            <div class="modal-footer ">
                <button type="button" class="btn btn-success cmd_remove_adm" ><span class="ti-trash"></span>&nbsp;Yes</button>
                <button type="button" class="btn btn-success cmd_remove_adm1" style="opacity:0.4; display:none;"><span class="ti-trash"></span>&nbsp;Yes</button>
                <button type="button" class="btn btn-default cmd_close_del" data-dismiss="modal"><span class="ti-close"></span>&nbsp;No</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="add_locs" tabindex="-1" role="dialog" aria-labelledby="editor-title">
	<div class="modal-dialog" role="document">
		<form action="javascript:;" class="modal-content form-horizontal frm_add_locs" id="editor_">
			<input type="hidden" id="txtmem_type" name="txtmem_type">

			<div class="modal-header">
				<h5 class="modal-title headers_title_" id="editor-title"><b>ADD LOCATION</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">

				<div class="form-group row">
					<label for="lastName" class="col-sm-3 control-label">FROM</label>
					<div class="col-sm-9">
						<input type="text" placeholder="Enter FROM Location" name="txtf_loc" id="txtf_loc" class="form-control" />
					</div>
				</div>

				<div class="form-group row">
					<label for="phone" class="col-sm-3 control-label">TO</label>
					<div class="col-sm-9">
						<input type="text" placeholder="Enter TO Location" name="txtt_loc" id="txtt_loc" class="form-control" />
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-3 control-label">Price</label>
					<div class="col-sm-9">
						<input type="number" placeholder="Enter Price" value="Enter Price" name="txtp" id="txtp" class="form-control" />
					</div>
				</div>
			</div>

			<div style="clear: both;"></div>
			<div class="alert alert-danger alert_msgs alert_msg1"></div>

			<div class="modal-footer">
				<button type="button" class="btn btn-light cmd_add_locs">Add Location</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>

			
		</form>
	</div>
</div>


<div class="page-content">
	<div class="container-fluid">
		
		<div class="row">

			<?php if($page_name == "add_customer" || $page_name == "add_riders"){
				if($page_name == "add_customer"){
					$cpation = "Customers";
				}else{
					$cpation = "Riders";
				}
				?>
				<div class="col-md-8 p-xs-0">
					<div class="card pt-10 pb-20">
						<div class="card-body p-xs-15">
							<h4 class="mt-0 header-title header-title1"><?=$header_names?></h4>
							<p class="text-soft mb-4 font-14">Please fill in all the fields</p>
							<form action="javascript:;" method="POST" id="frm_members">
								<input type="hidden" name="txtpgname" value="<?=$page_name?>">

								<div class="form-group">
									<label>Names</label>
									<input type="text" name="txtnames" class="form-control" style="text-transform: capitalize;" required data-parsley-minlength="3" placeholder="Enter <?=$cpation?> name">
								</div>

								<div class="form-group">
									<label>Phone</label>
									<input type="number" name="txtphone" class="form-control" required placeholder="Enter <?=$cpation?> Phone">
								</div>

								<div class="form-group">
									<label>Email Address</label>
									<input type="email" name="txtemail" class="form-control" required placeholder="Enter <?=$cpation?> Email">
								</div>

								<?php if($page_name=="add_riders"){ ?>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="txtpass" class="form-control" required placeholder="Enter <?=$cpation?> Default Password">
								</div>
								<?php } ?>

								<?php if($page_name=="add_customer"){ ?>
								<div class="form-group mb-30">
									<label>Address/House Address</label>
									<input type="text" name="txtaddr" class="form-control" required placeholder="Enter <?=$cpation?> Address" id="pac-input">
								</div>
								<?php } ?>
								
								<div class="form-group mb-0 mt-30_mb-20">
									<button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Submit</button>
								</div>

								<div style="clear: both;"></div>
								<div class="alert alert-danger alert_msgs alert_msg1 mt-20"></div>
							</form>
						</div>
					</div>
				</div>

				<script>
				    function initAutocomplete() {
				        var map = new google.maps.Map(document.getElementById('map'), {
				          center: {lat: -33.8688, lng: 151.2195},
				          zoom: 13,
				          mapTypeId: 'roadmap'
				        });

				      // Create the search box and link it to the UI element.
				      var input = document.getElementById('pac-input');
				      var searchBox = new google.maps.places.SearchBox(input);
				      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

				      // Bias the SearchBox results towards current map's viewport.
				      map.addListener('bounds_changed', function() {
				        searchBox.setBounds(map.getBounds());
				      });

				      var markers = [];
				      // Listen for the event fired when the user selects a prediction and retrieve
				      // more details for that place.
				      searchBox.addListener('places_changed', function() {
				        var places = searchBox.getPlaces();

				        if (places.length == 0) {
				          return;
				        }
				        // console.log(places);
				        console.log(places[0].address_components);
				      });
				    }
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHRSSN3VdktXCDOpohx6btlXAAkka6aos&libraries=places&callback=initAutocomplete"
				  async defer></script>
			<?php } ?>




			<?php if($page_name == "customers"){ ?>
				<div class="col-md-12 p-xs-0">
					<div class="card pt-10 pb-20">
			            <div class="card-body p-xs-15">
                            <div class="table-responsive project-table">
                                <table class="table table-bordered dt-responsive nowrap tbl_members" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="none">Photo</th>
                                        <th class="none">Address</th>
                                        <th>Date Registered</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>			                        
			            </div>
			        </div>
			    </div>
	        <?php } ?>



	        <?php if($page_name == "riders"){ ?>
				<div class="col-md-12 p-xs-0">
					<div class="card pt-10 pb-20">
			            <div class="card-body p-xs-15">
                            <div class="table-responsive project-table">
                                <table class="table table-bordered dt-responsive nowrap tbl_members" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Names</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="none">Photo</th>
                                        <th>Date Registered</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
             
                                    </tbody>

                                </table>
                            </div>			                        
			            </div>
			        </div>
			    </div>
	        <?php } ?>



	        <?php if($page_name == "add_mission" || $page_name == "edit_mission"){
				if($page_name == "add_customer"){
					$cpation = "Customers";
				}else{
					$cpation = "Riders";
				}

				$all_locs = $this->sql_models->getLocs();
				//$getRiders = $this->sql_models->getDetails();
				$getRiders = $this->sql_models->getDetails("members", "rid", "", "result_array");
				?>


				<div class="col-md-11 p-xs-0">
					<div class="card pt-10 pb-20">
						<div class="card-body p-xs-15">
							<h4 class="mt-0 header-title header-title1"><?=$header_names?></h4>
							<p class="text-soft mb-4 font-14">Please fill in all the fields</p>
							<form action="javascript:;" method="POST" id="frm_add_mission" autocomplete="off">
								<input type="hidden" name="txtpgname" value="<?=$page_name?>">

								<div class="form-group input_container">
									<label>Enter Name of Customer</label>
									<input type="text" name="txtnames" class="form-control txtsearch" style="text-transform: capitalize;" data-parsley-minlength="3" placeholder="Enter name">
									<ul id="country_list_id" class="country_list_id1"></ul>
								</div>

								<div class="form-group display_info">
									<p>CUSTOMER'S INFORMATION</p>
									<div class="row">
										<div class="col-md-5">
											<span><b>Name:</b> <font class="myname">xxxxxx</font></span>
											<span><b>Email:</b> <font class="myemail">xxxxxx</font></span>
										</div>

										<div class="col-md-6">
											<span><b>Phone:</b> <font class="myphone">xxxxxx</font></span>
											<span><b>Address:</b> <font class="myaddr">xxxxxx</font></span>
										</div>
									</div>
								</div>

								<div class="mt-30 font-16"><b>ITEMS TO BE DELIVERED</b></div>
								<hr>



								<div class="all_rows mt-20">
                                    <div class="row for_desktop">
                                        <div class="col-md-4 pl-10 pr-10">
                                            <label class="cap1">ITEMS</label>
                                        </div>

                                        <div class="col-md-3 pl-5 pr-5">
                                            <label class="cap1">PICKUP LOCATION</label>
                                        </div>

                                        <div class="col-md-3 pl-5 pr-5">
                                            <label class="cap1">DELIVERY LOCATION</label>
                                        </div>

                                        <div class="col-md-2 pl-5 pr-5">
                                            <label class="cap1">PRICE (NGN)</label>
                                        </div>
                                    </div>
                                            

                                    <div class="row mt-0">
                                        <?php for($g=1; $g<=5; $g++){ ?>
                                            <div class="col-md-4 pl-5 pr-5">
                                                <div class="form-groups">
                                                    <input type="text" name="txtoitem[]" class="form-control txtoitem<?=$g;?>" style="text-transform:capitalize" id="txtoitem" placeholder="Write the item" />
                                                    <div class="validation"></div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 pl-5 pr-5">
                                                <div class="form-groups">
                                                	<select class="form-control pickups" name="pickups" id="pickups<?=$g?>" ids="<?=$g?>">
                                                		<option value="" selected>-Select Location-</option>
			                                            <?php
			                                                foreach($all_locs->result() as $rows){
			                                                	$loc_part = ucwords($rows->loc_part);
			                                                	$loc_name = ucwords(strtolower($rows->loc_name));
			                                                	$loc_name = str_replace(array("Vgc", "Cms"), strtoupper($loc_name), $loc_name);
			                                                	$myloc = "$loc_name ($loc_part)";
			                                                ?>
			                                                    <option data-value="<?=$myloc;?>" data-value2="<?=$loc_name;?>"><?=$myloc;?></option>
			                                            <?php
			                                            }
			                                            ?>
                                                	</select>                                                	
                                                </div>
                                            </div>

                                            <div class="col-md-3 pl-5 pr-5">
                                                <div class="form-groups">
	                                                <select class="form-control deliverys" name="deliverys" id="deliverys<?=$g?>" ids="<?=$g?>">
                                                		<option value="" selected>-Select Location-</option>
			                                            <?php
			                                                foreach($all_locs->result() as $rows){
			                                                	$loc_part = ucwords($rows->loc_part);
			                                                	$loc_name = ucwords(strtolower($rows->loc_name));
			                                                	$loc_name = str_replace(array("Vgc", "Cms"), strtoupper($loc_name), $loc_name);
			                                                	$myloc = "$loc_name ($loc_part)";
			                                                ?>
			                                                    <option data-value="<?=$myloc;?>" data-value2="<?=$loc_part;?>"><?=$myloc;?></option>
			                                            <?php
			                                            }
			                                            ?>
                                                	</select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 pl-5 pr-5 mb-xs-20">
                                                <div class="form-groups">
                                                <input type="hidden" name="txtoprice[]" id="txtdistance_price<?=$g?>" class="form-control txtdistance_price" />

                                                <label class="form-control lblprice" id="lbldistance_price<?=$g?>">&nbsp;</label>
                                                </div>
                                            </div>
                                            
                                        <?php } ?>
                                    </div>

                                    <hr class="mt-10 mb-10">

                                    <div class="row mt-0">
                                    	<div class="offset-8 col-md-2 pl-5 pr-5">
                                    		<b style="font-size: 16px;">TOTAL</b>
                                    	</div>

                                    	<div class="offset-0 col-md-2 pl-5 pr-5">
                                    		<b style="font-size: 20px;" class="sum_total">&#8358;0.00</b>
                                    	</div>
                                    </div>

                                </div>
                                <div style="clear:both"></div>





								

								<div class="row mt-20 mb-40">
									<div class="col-md-2 mt-10">
										<label style="font-size: 16px;">Select Rider</label>
									</div>

									<div class="col-md-10 pl-5 pr-5">
                                        <div class="form-groups">
                                        	<select class="form-control txtrider" name="txtrider">
                                        		<option value="" selected>-Select Rider-</option>
                                        	</select>
                                        	<p style="color: #666; font-size: 15px">This will reload the nearby riders based on the pickup location selected.</p>
                                        </div>
                                    </div>
								</div>
								
								<div class="form-group mb-0 mt-30_mb-20">
									<button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Submit</button>
								</div>

								<div style="clear: both;"></div>
								<div class="alert alert-danger alert_msgs alert_msg1 mt-20"></div>
							</form>
						</div>
					</div>
				</div>

				<!-- <script>
				    function initAutocomplete() {
				        var map = new google.maps.Map(document.getElementById('map'), {
				          center: {lat: -33.8688, lng: 151.2195},
				          zoom: 13,
				          mapTypeId: 'roadmap'
				        });

				      var input = document.getElementById('pac-input');
				      var searchBox = new google.maps.places.SearchBox(input);
				      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

				      map.addListener('bounds_changed', function() {
				        searchBox.setBounds(map.getBounds());
				      });

				      var markers = [];
				      searchBox.addListener('places_changed', function() {
				        var places = searchBox.getPlaces();

				        if (places.length == 0) {
				          return;
				        }
				        console.log(places[0].address_components);
				      });
				    }
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHRSSN3VdktXCDOpohx6btlXAAkka6aos&libraries=places&callback=initAutocomplete"
				  async defer></script> -->
			<?php } ?>




			<?php if($page_name=="settings"){ ?>
            	<div class="col-md-12 p-xs-0">
            		<div class="row">
	            		<div class="col-md-6">
							<div class="card pt-10 pb-20">
								<div class="card-body p-xs-15">
		                            <p class="mb-20 font-20">Change Your Password</p>
		                            <form action="javascript:;" id="edit_pass" method="post" autocomplete="off">
		                                <div class="form-group">
											<label>Old Password</label>
											<input type="password" name="txtpass1" class="form-control" required placeholder="Enter your old password">
										</div>

										<div class="form-group">
											<label>New Password</label>
											<input type="password" name="txtpass2" id="txtpass2" class="form-control" required placeholder="Enter your new password">
										</div>

										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" name="txtpass3" class="form-control" required placeholder="Confirm password" data-parsley-equalto="#txtpass2">
										</div>

		                                <div class="form-group mb-0 mt-30_mb-20">
											<button type="button" class="btn btn-primary btn-lg waves-effect waves-light cmd_update_pass">UPDATE PASSWORD</button>
										</div>

										<div style="clear: both;"></div>
										<div class="alert alert-danger alert_msgs alert_msg1 mt-20"></div>
		                            </form>
		                        </div>
		                    </div>
		                </div>


		                <div class="col-md-10">
							<div class="card pt-10 pb-20">
								<div class="card-body p-xs-15">
		                            <p class="mb-20 font-20">Update Location & Prices</p>
		                            <form class="input-group" id="edit_settings1" method="post" autocomplete="off">

		                            	<?php
		                            	if($loc_prices = $this->sql_models->bringSettings()){
			                            	foreach ($loc_prices as $rs) {
							             	   $from_loc = $rs['from_loc'];
							                   $to_loc = $rs['to_loc'];
							                   $loc_price = $rs['price'];
							                   ?>
							                   	<div class="form-group_ mb-20 col-md-4 pl-xs-0 pr-xs-0">
				                                    <label for="txt"><b>Location (FROM)</b></label>
				                                    <div class="form-line">
				                                        <input type="text" name="txtloc_from[]" class="form-control" placeholder="Enter Location (From)" value="<?=$from_loc?>">
				                                    </div>
				                                </div>

				                                <div class="form-group_ mb-20 col-md-4 pl-xs-0 pr-xs-0">
				                                    <label for="txt"><b>Location (TO)</b></label>
				                                    <div class="form-line">
				                                        <input type="text" name="txtloc_to[]" class="form-control" placeholder="Enter Locaton (To)" value="<?=$to_loc?>">
				                                    </div>
				                                </div>

				                                <div class="form-group_ mb-20 col-md-4 pl-xs-0 pr-xs-0">
				                                    <label for="txt"><b>Price</b></label>
				                                    <div class="form-line">
				                                        <input type="number" name="txtloc_price[]" class="form-control" placeholder="Enter Location Prices" value="<?=$loc_price?>">
				                                    </div>
				                                </div>
							                   <?php
								            }
								            ?>

								            <div style="clear: both;"></div>
			                                <div class="alert alert_msgs alert_msg2"></div>
			                                <div class="col-md-6 mt-20" style="text-align: right;">
			                                    <button type="button" class="btn btn-lg btn-primary waves-effect waves-light pull-right cmd_update_settings1">UPDATE SETTINGS</button>
			                                </div>

			                                <div class="col-md-6 mt-20" style="text-align: left;">
			                                    <button type="button" class="btn btn-lg btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#add_locs">ADD LOCATION</button>
			                                </div>

								            <?php
								        }
		                            	?>
		                            </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
	            </div>
	        <?php } ?>


		</div>
	</div>
	<div style="clear: both;"></div>
