
	function saveImageFromUrl($arr_column_4_1, $str_column_2, $str_column_3, $str_column_5)
	{
		print_r($arr_column_4_1);
		
		$user_id = 0;
		
		$str_column_2 = trim($str_column_2);
		$str_column_3 = strtolower($str_column_3);
		$str_column_3 = trim($str_column_3);
		$str_column_5 = trim($str_column_5);
					
	    $user_data = User::select('id', 'profile_image')->where('email', $str_column_3)->first();
					/*	
		if(!empty($user_data->id))
		{
		   $user = \App\Models\User::find($user_data->id);
		   $user_id = $user_data->id;
		}
		
		echo 'user_id: '.$user_id;
		
		if(empty($user_id))
		{
			return;
		}
		
		try 
            {
				// Start Transaction
				\DB::beginTransaction();
		 
		           if($str_column_2 == "Profile Picture" && ($user_data->profile_image == NULL || empty($user_data->profile_image)))
					{
					 	
                       echo 'url '. $url = $arr_column_4_1[0];
					   echo 'profile_image: '.$user_data->profile_image;
						
						 if(filter_var($url, FILTER_VALIDATE_URL))
					     {
						     $timestamp = generateFilename();
						
							$filename_from_url = parse_url($url);
							$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
							echo $filename = $timestamp . '_users_' . $user_id . '.' . $ext;
							$file_path = public_path($this->_usersPhotosFolder . $filename);
							$img = $file_path;//codexworld.png	 
							echo 'get: '.file_put_contents($img, file_get_contents($url));						
					        $user->profile_image = $filename;
						    $user->save();
						 }	 
						

					} 
					
					if($str_column_2 == "Media Gallery")
					{
					  
					    $url = $arr_column_4_1[0];
						$timestamp = generateFilename();
						
						$filename_from_url = parse_url($url);
						$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
						
						echo 'file: '.$filename = $timestamp . '_galleries_' . $user_id . '.' . $ext;
						$file_path = public_path($this->_galleryPhotosFolder . $filename);
						echo 'img: '.$img = $file_path;//codexworld.png
						echo 'get: '.file_put_contents($img, file_get_contents($url));
						
						$data_media =  $filename;
					   
					   $data = [
							'title' => $str_column_5,
							'type' => 1,					
							'is_known_for' => 0,
							'destination_id' => 1,
							'assign_product_id' => 0,
							'assign_event_id' => 0,
							'status' => 1,
							'user_id' => $user_id
						];
						
						$data['media'] = $data_media;
						
					  $gallery_data = Gallery::create($data);
								  //$str_column_3
					   
					}*/
					
					/*if($column[2] == "Media Gallery")
					{
					   echo $str_column_2 = $column[2];
                       echo '</br>'; 					   
					}
					
					if($column[3] == "Email")
					{
					   echo $str_column_3 = $column[3];
                       echo '</br>'; 					   
					}
		
							
			// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				//Session::flash('user_csv_data_saved_flag', 1);
				//return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				echo errorMessage($e->errorInfo[2], true);
			}			
							
    }						
	
	
	public function showCompanyImportCsv(Request $request)
    {
		
		$str_password_data = '123456';
		$is_user_add_mode = 0;
		$m = 0;
		$int_time_stamp = time();
		
		
		/*$get_all_user_data = User::select('id', 'name')->where('is_csv_upload', 1)->where('role', 3)->get();
		
		foreach($get_all_user_data as $get_all_user_data_row)
		{
			$str_first_name = '';   
				    $str_last_name = '';
			
			echo $str_csv_company_name = $get_all_user_data_row->name;
			echo '</br>';
			
			$user = \App\Models\User::find($get_all_user_data_row->id);
			
			   
				   if(strpos($str_csv_company_name, ' ')>0)
				   {
					 $arr_csv_company_name =  explode(' ', $str_csv_company_name);
                     $str_first_name = $arr_csv_company_name[0];
					 
					 if(!empty($arr_csv_company_name[1]))
                     {
						$str_last_name = $arr_csv_company_name[1]; 
					 }
					 
					 if(!empty($arr_csv_company_name[2]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[2]; 
					 }
					 
					 
					 if(!empty($arr_csv_company_name[3]))
                     {
						$str_last_name = $str_last_name .  $arr_csv_company_name[3]; 
					 }
					 
					 if(!empty($arr_csv_company_name[4]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[4]; 
					 }
					 
					 if(!empty($arr_csv_company_name[5]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[5]; 
					 }
					 
				   }
				   else
				   {
					   $str_first_name = $str_csv_company_name;
				   }
				   
				   $user->first_name =  $str_first_name;   
				   $user->last_name =  $str_last_name;
				   
				   $user->save();
		}
		
		exit;
		
		// map the social ids to the csv file
		            
            /*$column_row[0]  // name
					  $column_row[1]  //website
					  $column_row[2] //description
					  $column_row[3] //employees
					  $column_row[4] //company_to_product_to_role
					  $column_row[5] //key
					  $column_row[6] //user_profile_responses
					 
		
		if ($request->isMethod('post')) 
        {
			
			
            // pr($request->all(),1);
			$rules = [
                'import_csv_file' => 'required',
                					
            ];
	
    	    $niceNames = array();
     
            $this->validate($request, $rules, [], $niceNames);
			
			try 
            {
				// Start Transaction
				\DB::beginTransaction();
    			 
			$file = $request->import_csv_file;
			
			
			
			echo '<br>';
			echo 'ext '.$extension = $file->getClientOriginalExtension();
			echo '<br>';
			echo 'pathname'.$pathname = $file->getPathname();
			echo '<br>';
			echo 'size'.$get_size = $file->getSize();
			echo '<br>';
			
			
			if ($get_size > 0) {
        
        $file = fopen($pathname, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			
			$country_id = 0;
			$str_time = time();
			
			
			
			/*if($m == 0)
			{
				$column[0] = trim($column[0]);
				$column[1] = trim($column[1]);
				$column[2] = trim($column[2]);
				$column[3] = trim($column[3]);
				$column[4] = trim($column[4]);
				$column[5] = trim($column[5]);
				$column[6] = trim($column[6]);
				
				print_r($column);
				
				if(($column[0] == 'name') && (!empty($column[1]) && $column[1] =='website')
			    && (!empty($column[2]) && $column[2] =='description') && (!empty($column[3]) && $column[3] =='employees')
				&& (!empty($column[4]) && $column[4] =='company_to_product_to_role') && (!empty($column[5]) && $column[5] =='key')
				&& (!empty($column[6]) && $column[6] =='user_profile_responses'))
				{
					echo 'hello';//
				}
				else
				{
					break;
				}
				
			}			
			
			if($m>0)
            {  
		      //foreach($column as $column_row)
			  //{
				    $str_first_name = '';   
				    $str_last_name = '';
				   
				    $str_time = $str_time . $m;					
					//$str_city = @$this->get_quote_data($column[7]);					
					$str_csv_key = @$column[5];					
					$str_website = @$column[1];
					$str_description = @$column[2];
					$str_csv_company_name = @$column[0];
					$str_user_profile_responses = @$column[6];
					$str_company_to_product_to_role = @$column[4];
					$str_employees_list = @$column[3];
					
					//$str_email = $m . '_' . $int_time_stamp . '@poppro.com';					
					$str_email = preg_replace('/[^a-zA-Z0-9-_\.]/','_', $str_csv_company_name);
					$str_email = $str_email . '@poppro.com';
					$str_email = strtolower($str_email);
					$user_data = User::select('id')->where('email', $str_email)->first();
									
					if(!empty($user_data->id))
					{
					   $user = \App\Models\User::find($user_data->id);
					   $is_user_add_mode = 0;
					}
					else
					{
					   $user = new \App\Models\User();
                       $is_user_add_mode = 1;					   
					}	
					
				   $user = new \App\Models\User();
                   $user->is_csv_upload = 1;				   
				   $user->csv_key = $str_csv_key;
				   $user->name = $str_csv_company_name;
				   
				   if(strpos($str_csv_company_name, ' ')>0)
				   {
					 $arr_csv_company_name =  explode(' ', $str_csv_company_name);
                     $str_first_name = $arr_csv_company_name[0];
					 
					 if(!empty($arr_csv_company_name[1]))
                     {
						$str_last_name = $arr_csv_company_name[1]; 
					 }
					 
					 if(!empty($arr_csv_company_name[2]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[2]; 
					 }
					 
					 
					 if(!empty($arr_csv_company_name[3]))
                     {
						$str_last_name = $str_last_name .  $arr_csv_company_name[3]; 
					 }
					 
					 if(!empty($arr_csv_company_name[4]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[4]; 
					 }
					 
					 if(!empty($arr_csv_company_name[5]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[5]; 
					 }
					 
				   }
				   else
				   {
					   $str_first_name = $str_csv_company_name;
				   }
				   
				   $user->first_name =  $str_first_name;   
				   $user->last_name =  $str_last_name;
				   
				   $user->password = bcrypt($str_password_data);
				   $user->type_of_user = 2;
				   $user->role = 3;
				   $user->created_by = 1;				
				   $user->email =  $str_email;				
				   $user->description = $str_description;
				   $user->website = $str_website;
				   //$user->stripe_id = $str_time;
				   $user->employees_list = $str_employees_list;
				   $user->company_to_product_to_role = $str_company_to_product_to_role;
				   $user->user_profile_responses = $str_user_profile_responses;
				   
				   $user->save();
				   
				   $user_id = $user->id;
				   
				   if(!empty($user_id))
				   {
					   
					   if(!empty($is_user_add_mode))
					   {
						 $plan = Plan::find(4);
						 
						 $user_subscription_data = UserSubscription::select('id')->where('plan_id', $plan->id)->where('user_id', $user_id)->first();
						 
						 if(empty($user_subscription_data->id))
						 {
						     $subscription = new UserSubscription();
							 $subscription->user_id = $user_id;
							 $subscription->plan_id = $plan->id;
							 $subscription->price = $plan->price;
							 $subscription->validity = $plan->validity;
							 $subscription->ends_at = Carbon::now()->addDay($plan->validity);
							 $subscription->payment_status = 2;
							 $subscription->stripe_id = $str_time;
							 $subscription->stripe_plan_id = $plan->stripe_plan_id;
							 $subscription->stripe_subscription_id = 0;
							 $subscription->save();	 
						 }
						 									
					   }
					   
				   }
				        
			  //}
			  
			  
			echo '<pre>';
			print_r($column);
            echo '</pre>';
			echo '</br>';
			
		  }	
			
			echo 'm: '.$m++;
			
			echo '</br>';
			
        }
    }
			
			//print_r($file);
			
			// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('user_csv_data_saved_flag', 1);
				//return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				echo errorMessage($e->errorInfo[2], true);
			}
			
			exit;
			
    	}
    	
	    return view('admin.importcsv.import_company_csv_data');	
    }
	
	
	public function readImportCsv(Request $request)
    {
		/*$timestamp = time();
		
		$str_password_data = '123456';
		$is_user_add_mode = 0;
		$m = 0;
		
		// map the social ids to the csv file
		$arr_social_ids = array( 3 => 19, 5 => 20, 8 => 17 , 12 => 18, 16 => 22, 25 => 16 , 29 => 21);
		
		            /*[16] => twitter  // 25
					[17] => facebook //8
					[18] => instagram //12
					[19] => behance //3
					[20] => coroflot //5
					[21] => youtube //29
					[22] => pinterest //16 

            $column_row[0]  // fulle name
					  $column_row[1]  //csv key
					  $column_row[2] //first name
					  $column_row[3] //last name
					  $column_row[4] //email
					  $column_row[5] //profile_picture
					  $column_row[6] //media_gallery
					  $column_row[7] //city
					  $column_row[8] //website
					  $column_row[9] //state
					  $column_row[10] //gender
					  $column_row[11]//country 
					  $column_row[12] //zip code
					  $column_row[13] //related_urls
					  $column_row[14] //description
					  $column_row[15] //company
					  
                      $column_row[16] //twitter
					  $column_row[17] //facebook
					  $column_row[18] //instagram
					  $column_row[19] //behance
					  $column_row[20] //coroflot
					  $column_row[21] //youtube
					  $column_row[22] //pinterest 
					  $column_row[23] // user_to_product_to_role
                      $column_row[24] // award_to_user_to_product 
		echo 'Read Csv data: ';			  
		
		if ($request->isMethod('post')) 
        {
			
			
            // pr($request->all(),1);
			$rules = [
                'import_csv_file' => 'required',
                					
            ];
	
    	    $niceNames = array();
     
            $this->validate($request, $rules, [], $niceNames);
			
			try 
            {
				// Start Transaction
				\DB::beginTransaction();
    			 
			$file = $request->import_csv_file;
			
			
			
			echo '<br>';
			echo 'ext '.$extension = $file->getClientOriginalExtension();
			echo '<br>';
			echo 'pathname'.$pathname = $file->getPathname();
			echo '<br>';
			echo 'size'.$get_size = $file->getSize();
			echo '<br>';
			
			
			
			if ($get_size > 0) {
        
        $file = fopen($pathname, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			
			$country_id = 0;
			$str_time = time();
			
			if($m == 0)
			{
				echo '<pre>';
				print_r($column);
				echo '</pre></br>';
				/*$column[0] = trim($column[0]);
				$column[1] = trim($column[1]);
				$column[2] = trim($column[2]);
				$column[3] = trim($column[3]);
				$column[4] = trim($column[4]);
				$column[5] = trim($column[5]);
				$column[6] = trim($column[6]);
				$column[7] = trim($column[7]);
				$column[8] = trim($column[8]);
				$column[9] = trim($column[9]);
				$column[10] = trim($column[10]);
				$column[11] = trim($column[11]);
				$column[12] = trim($column[12]);
				$column[13] = trim($column[13]);
				$column[14] = trim($column[14]);
				$column[15] = trim($column[15]);
				$column[16] = trim($column[16]);
                $column[17] = trim($column[17]);				
				$column[18] = trim($column[18]);
				$column[19] = trim($column[19]);
				$column[20] = trim($column[20]);
				$column[21] = trim($column[21]);
				$column[22] = trim($column[22]);
				$column[23] = trim($column[23]);
				echo 'col: '.$column[24] = trim($column[24]); 
				
				
				
				if(($column[0] == 'full_name') && (!empty($column[1]) && $column[1] =='key')
			    && (!empty($column[2]) && $column[2] =='first_name') && (!empty($column[3]) && $column[3] =='last_name')
				&& (!empty($column[4]) && $column[4] =='email') && (!empty($column[5]) && $column[5] =='profile_picture')
				&& (!empty($column[6]) && $column[6] =='media_gallery') && (!empty($column[7]) && $column[7] =='city')
				&& (!empty($column[8]) && $column[8] =='website') && (!empty($column[9]) && $column[9] =='state')
				&& (!empty($column[10]) && $column[10] =='gender') && (!empty($column[11]) && $column[11] =='country')
				&& (!empty($column[12]) && $column[12] =='zip_code') && (!empty($column[13]) && $column[13] =='related_urls')
				&& (!empty($column[14]) && $column[14] =='description') && (!empty($column[15]) && $column[15] =='company')
				&& (!empty($column[16]) && $column[16] =='twitter') && (!empty($column[17]) && $column[17] =='facebook')
				&& (!empty($column[18]) && $column[18] =='instagram') && (!empty($column[19]) && $column[19] =='behance')
				&& (!empty($column[20]) && $column[20] =='coroflot') && (!empty($column[21]) && $column[21] =='youtube')
				&& (!empty($column[22]) && $column[22] =='pinterest') && (!empty($column[23]) && $column[23] =='user_to_product_to_role')
				&& (!empty($column[24]) && $column[24] =='award_to_user_to_product'))
				{
					echo 'hello';//
				}
				else
				{
					break;
				}
				
			} 
			
			
			if($m>0)
            {  
		      /*foreach($column as $column_row)
			  { 
				    
					
					//$str_city = @$this->get_quote_data($column[7]);
					
					//if($column[2] == "Profile Picture")
					//{
					   echo $str_column_2 = $column[2];	
                       echo '</br>';					   
					//}
					
					
					
					//if($column[2] == "Media Gallery")
					//{
					   echo $str_column_2 = $column[2];
                       echo '</br>'; 					   
					//}
					
					//if($column[3] == "Email")
					//{
					   echo $str_column_3 = $column[3];
                       echo '</br>'; 					   
					//}
					
					echo $str_column_5 = $column[5];
                       echo '</br>';
					
						echo '<pre> column data';
					print_r($column);
					echo '</pre>';
					echo '</br>';							
					
					
					$str_column_2 = trim($str_column_2);
					
					if($str_column_2 == "Profile Picture")
                    {
						
	
					
						if(strpos($column[4], ",")>0)
						{
						  $arr_column_4 =	explode(",", $column[4]);
						  
						  foreach($arr_column_4 as $arr_column_4_row)
						  {
						   $arr_column_4_row_1 =	explode("(", $arr_column_4_row);
						   
						   if(isset($arr_column_4_row_1[1]))
						   {
						   $arr_column_4_row_1_2 =	explode(")", $arr_column_4_row_1[1]);
						   
						   echo '<pre> image 1';
						   print_r($arr_column_4_row_1_2);
						   
						   //$this->saveImageFromUrl($arr_column_4_row_1_2, $str_column_2, $str_column_3, $str_column_5);
						   
							//print_r($arr_column_4_1_row);
							echo '</pre>';
							echo '</br>';
						   }
							  
						  }
						  
						}
						else
						{
							
						   $arr_column_4 =	explode("(", $column[4]);
						   
						   if(isset($arr_column_4[1]))
						   {
							   $arr_column_4_1 =	explode(")", $arr_column_4[1]);

							   echo '<pre> image2';
							   //print_r($arr_column_4);
								echo '</br>';
								print_r($arr_column_4_1);
								echo '</pre>';
								echo '</br>';   
								
								//$this->saveImageFromUrl($arr_column_4_1, $str_column_2, $str_column_3, $str_column_5);
								
								//exit;
						   }
												   
						}
					
					
					    //exit;
						
					}
					else
					{
					   continue;	
					}
					
					
			
			/*echo '</br>';	        
			  }
			  
			
		  }	
			
			echo 'm: '.$m++;
			
        }
    }
	
	
			
			//print_r($file);
			
			// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('user_csv_data_saved_flag', 1);
				//return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				echo errorMessage($e->errorInfo[2], true);
			}
			
			exit;
		}	
			
			
    	
    	
	    return view('admin.importcsv.read_csv_data');	
    }
	
	
	 public function get_quote_data($data)
    {
	   return  DB::getPdo()->quote($data);
	}	
	
	 public function delete_user_socila_media_data()
    {
	
	try {
        
            DB::beginTransaction();
		    	
			$user_list_data = User::select('id')->where('is_csv_upload', 1)->get();
		
			foreach($user_list_data as $user_list_data_row)
			{
			   echo $is_deleted = UserSocialMedia::where('user_id', $user_list_data_row->id)->delete();			   
			   echo '</br>'; 
			}
			//
			DB::commit();
			 echo successMessage('Deleted Successfully');
			//return redirect($main_gallery_url);
            //return successMessage('Gallery Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            echo errorMessage($e->getMessage(), true);
        }
		
		
		exit;
		
    }

       	
	
	// for innovator
	public function showUserImportCsv(Request $request)
    {
		$user_id = 0;
		
		$str_password_data = '123456';
		$is_user_add_mode = 0;
		$m = 0;
		$n = 0;
		$filename = '';
		$filename2 = '';
		
		// map the social ids to the csv file
		$arr_social_ids = array( 3 => 19, 5 => 20, 8 => 17 , 12 => 18, 16 => 22, 25 => 16 , 29 => 21);
		
		            /*[16] => twitter  // 25
					[17] => facebook //8
					[18] => instagram //12
					[19] => behance //3
					[20] => coroflot //5
					[21] => youtube //29
					[22] => pinterest //16 */

            /*$column_row[0]  // fulle name
					  $column_row[1]  //csv key
					  $column_row[2] //first name
					  $column_row[3] //last name
					  $column_row[4] //email
					  $column_row[5] //profile_picture
					  $column_row[6] //media_gallery
					  $column_row[7] //city
					  $column_row[8] //website
					  $column_row[9] //state
					  $column_row[10] //gender
					  $column_row[11]//country 
					  $column_row[12] //zip code
					  $column_row[13] //related_urls
					  $column_row[14] //description
					  $column_row[15] //company
					  
                      $column_row[16] //twitter
					  $column_row[17] //facebook
					  $column_row[18] //instagram
					  $column_row[19] //behance
					  $column_row[20] //coroflot
					  $column_row[21] //youtube
					  $column_row[22] //pinterest 
					  $column_row[23] // user_to_product_to_role
                      $column_row[24] // award_to_user_to_product
					  
		
		if ($request->isMethod('post')) 
        {
			
			
            // pr($request->all(),1);
			$rules = [
                'import_csv_file' => 'required',
                					
            ];
	
    	    $niceNames = array();
     
            $this->validate($request, $rules, [], $niceNames);
			
			try 
            {
				// Start Transaction
				\DB::beginTransaction();
				
				echo 'db name: '.DB::connection()->getDatabaseName();
    			 
			$file = $request->import_csv_file;
			
			
			
			echo '<br>';
			echo 'ext '.$extension = $file->getClientOriginalExtension();
			echo '<br>';
			echo 'pathname'.$pathname = $file->getPathname();
			echo '<br>';
			echo 'size'.$get_size = $file->getSize();
			echo '<br>';
			
			
			
			if ($get_size > 0) {
        
        $file = fopen($pathname, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
			
			$country_id = 0;
			$str_time = time();
			
			if($m == 0)
			{
				//$m++;
				//continue;
			}
			
			/*if($m == 0)
			{
				$column[0] = trim($column[0]);
				$column[1] = trim($column[1]);
				$column[2] = trim($column[2]);
				$column[3] = trim($column[3]);
				$column[4] = trim($column[4]);
				$column[5] = trim($column[5]);
				$column[6] = trim($column[6]);
				$column[7] = trim($column[7]);
				$column[8] = trim($column[8]);
				$column[9] = trim($column[9]);
				$column[10] = trim($column[10]);
				$column[11] = trim($column[11]);
				$column[12] = trim($column[12]);
				$column[13] = trim($column[13]);
				$column[14] = trim($column[14]);
				$column[15] = trim($column[15]);
				$column[16] = trim($column[16]);
                $column[17] = trim($column[17]);				
				$column[18] = trim($column[18]);
				$column[19] = trim($column[19]);
				$column[20] = trim($column[20]);
				$column[21] = trim($column[21]);
				$column[22] = trim($column[22]);
				$column[23] = trim($column[23]);
				echo 'col: '.$column[24] = trim($column[24]);
				
				print_r($column);
				
				if(($column[0] == 'full_name') && (!empty($column[1]) && $column[1] =='key')
			    && (!empty($column[2]) && $column[2] =='first_name') && (!empty($column[3]) && $column[3] =='last_name')
				&& (!empty($column[4]) && $column[4] =='email') && (!empty($column[5]) && $column[5] =='profile_picture')
				&& (!empty($column[6]) && $column[6] =='media_gallery') && (!empty($column[7]) && $column[7] =='city')
				&& (!empty($column[8]) && $column[8] =='website') && (!empty($column[9]) && $column[9] =='state')
				&& (!empty($column[10]) && $column[10] =='gender') && (!empty($column[11]) && $column[11] =='country')
				&& (!empty($column[12]) && $column[12] =='zip_code') && (!empty($column[13]) && $column[13] =='related_urls')
				&& (!empty($column[14]) && $column[14] =='description') && (!empty($column[15]) && $column[15] =='company')
				&& (!empty($column[16]) && $column[16] =='twitter') && (!empty($column[17]) && $column[17] =='facebook')
				&& (!empty($column[18]) && $column[18] =='instagram') && (!empty($column[19]) && $column[19] =='behance')
				&& (!empty($column[20]) && $column[20] =='coroflot') && (!empty($column[21]) && $column[21] =='youtube')
				&& (!empty($column[22]) && $column[22] =='pinterest') && (!empty($column[23]) && $column[23] =='user_to_product_to_role')
				&& (!empty($column[24]) && $column[24] =='award_to_user_to_product'))
				{
					echo 'hello';//
				}
				else
				{
					break;
				}
				
			}
			
			
			if($m>=0)
            {  
		      //foreach($column as $column_row)
			  //{
				    
					
					//$str_city = @$this->get_quote_data($column[7]);
					
					
					
					
					/*$str_csv_key = @$column[1];
					$str_first_name = @$column[2];
					$str_last_name = @$column[3];
					//$str_full_name = @$column[0];
					$str_full_name = $str_first_name . ' ' . $str_last_name;
					$str_email = @$column[4];
					$str_city = @$column[7];
					$str_website = @$column[8];
					$str_state = @$column[9];
					$str_gender = @$column[10];
					$str_country_name = @$column[11];	
					$str_zip_code = @$column[12];
					$str_description = @$column[14];
					$str_csv_company_name = @$column[15];*/
					
					//$str_csv_key = @$column[1];
					$str_csv_company_name = @$column[0];
					//$str_last_name = @$column[1];
					//$str_full_name = @$column[0];
					//$str_full_name = $str_first_name . ' ' . $str_last_name;
					$str_email = @$column[1];
					//$str_city = @$column[7];
					//$str_website = @$column[9];
					//$str_state = @$column[9];
					//$str_gender = @$column[10];
					//$str_country_name = @$column[11];	
					//$str_zip_code = @$column[12];
					//$str_description = @$column[4];
					$str_profile_pic = @$column[2];
					$str_gallery_pic = @$column[3];
					//$str_csv_company_name = @$column[15];
					$str_first_name =''; 
					$str_last_name = '';
					
					if(empty($str_email))
					{
					   //$str_email = preg_replace('/[^a-zA-Z0-9-_\.]/','_', $str_csv_company_name);
					//$str_email = $str_email . '@poppro.com';
					//$str_email = strtolower($str_email);	
					}
					
					/*if(strpos($str_csv_company_name, ' ')>0)
				   {
					 $arr_csv_company_name =  explode(' ', $str_csv_company_name);
                     $str_first_name = $arr_csv_company_name[0];
					 
					 if(!empty($arr_csv_company_name[1]))
                     {
						$str_last_name = $arr_csv_company_name[1]; 
					 }
					 
					 if(!empty($arr_csv_company_name[2]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[2]; 
					 }
					 
					 
					 if(!empty($arr_csv_company_name[3]))
                     {
						$str_last_name = $str_last_name .  $arr_csv_company_name[3]; 
					 }
					 
					 if(!empty($arr_csv_company_name[4]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[4]; 
					 }
					 
					 if(!empty($arr_csv_company_name[5]))
                     {
						$str_last_name = $str_last_name . $arr_csv_company_name[5]; 
					 }
					 
				   }
				   else
				   {
					   $str_first_name = $str_csv_company_name;
				   }
					
					
					
					echo '<pre> column data';
					print_r($column);
					echo '</pre>';
					echo '</br>';
					
										
					if($n >= 1)
                    {
						
							  
						
					}
					
					$n++;
                    echo 'n: '.$n;
					DB::enableQueryLog();
					//$country_data = Country::select('id')->where('country_name', $str_country_name)->first();
				    echo '<pre> country: ';
				    //print_r($country_data);  
				    echo '</pre>';
				    
					//exit;
				 
				 
					/*if(!empty($country_data->id))
					{
					   $country_id = $country_data->id;	
					}
					else
					{
						continue;
					}
					
					
					$user_data = User::select('id')->where('email', $str_email)->first();
					
					
					//dd(DB::getQueryLog());

					
					echo '<pre> user data:';
					//print_r($user_data);
					echo '</pre>';		
					
                     						
					if(!empty($user_data->id))
					{
					   $user = \App\Models\User::find($user_data->id);
					   $is_user_add_mode = 0;
					}
					/*else
					{
					   $user = new \App\Models\User();
                       $is_user_add_mode = 1;					   
					}	
					
					
				   $user->is_csv_upload = 1;				   
				   //$user->csv_key = $str_csv_key;
				   //$user->csv_company_name = $str_csv_company_name;
				   $user->password = bcrypt($str_password_data);
				   $user->type_of_user = 2;
				   $user->role = 3;
				   $user->created_by = 1;				
				   $user->first_name =  $str_first_name;   
				   $user->last_name =  $str_last_name;   				
				   $user->email =  $str_email;				
				   $user->username = $str_csv_company_name;				   
				   //$user->gender = $str_gender;
				   $user->description = $str_description;
				   //$user->state = $str_state;
				   //$user->city = $str_city;
				   //$user->zip_code = $str_zip_code;
				   //$user->country_id = $country_id;
				   $user->website = $str_website;
				   $user->stripe_id = $str_time;
				   $user->profile_image = $filename;
				   $user->save();
				   
				   if(!empty($user_data->id))
				   {
					 echo 'user_id: '.$user_id = $user_data->id;   
				   }
				   
			
			
				   if(!empty($user_id))
				   {
					   
					   
					   $filename_from_url = parse_url($str_profile_pic);
							echo 'ext1: '.$ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);
							
							if($ext == 'webp' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png')
							{
								$timestamp = generateFilename();
								echo $filename = $timestamp . '_users_' . $user_id . '.' . $ext;
								$file_path = public_path($this->_usersPhotosFolder . $filename);
								$img = $file_path;//codexworld.png	 
								echo 'get1: '.file_put_contents($img, file_get_contents($str_profile_pic));
						        
								$user->profile_image = $filename;
						        $user->save();
							}
							
							
					   
					   
					   $filename_from_url2 = parse_url($str_gallery_pic);
						echo 'ext2: '.$ext2 = pathinfo($filename_from_url2['path'], PATHINFO_EXTENSION);
						
						/**/if($ext2 == 'webp' || $ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'gif' || $ext2 == 'png')
							{
								$timestamp2 = generateFilename();
								echo 'file: '.$filename2 = $timestamp2 . '_galleries_' . $user_id . '.' . $ext2;
								$file_path2 = public_path($this->_galleryPhotosFolder . $filename2);
								echo 'img: '.$img2 = $file_path2;//codexworld.png
								echo 'get2: '.file_put_contents($img2, file_get_contents($str_gallery_pic));
							      
								  $data = [
							'title' => $str_csv_company_name,
							'type' => 1,					
							'is_known_for' => 0,
							'destination_id' => 1,
							'assign_product_id' => 0,
							'assign_event_id' => 0,
							'status' => 1,
							'user_id' => $user_id
						];
						
						$data['media'] = $filename2;
						
					  $gallery_data = Gallery::create($data);
							
							} 
					   
					   
					   
					   /*if(!empty($is_user_add_mode))
					   {
						 $plan = Plan::find(2);
						 
						 $user_subscription_data = UserSubscription::select('id')->where('plan_id', $plan->id)->where('user_id', $user_id)->first();
						 
						 if(empty($user_subscription_data->id))
						 {
						     $subscription = new UserSubscription();
							 $subscription->user_id = $user_id;
							 $subscription->plan_id = $plan->id;
							 $subscription->price = $plan->price;
							 $subscription->validity = $plan->validity;
							 $subscription->ends_at = Carbon::now()->addDay($plan->validity);
							 $subscription->payment_status = 2;
							 $subscription->stripe_id = $str_time;
							 $subscription->stripe_plan_id = $plan->stripe_plan_id;
							 $subscription->stripe_subscription_id = 0;
							 $subscription->save();	 
						 }
						 									
					   }*/					   
					   
					   if($n == 2)
                       {
						   //exit;
					   }
					   
					  /*foreach($arr_social_ids as $arr_social_ids_key => $arr_social_ids_val)
					  {
						  $socials_val  = @$column[$arr_social_ids_val];
						  
						  $social_media =  UserSocialMedia::where('user_id', $user_id)
								->where('type', $arr_social_ids_key)
								->first();
							
						   if (!empty($social_media->id)) {
								$social_media = \App\Models\UserSocialMedia::find($social_media->id);
							}
							else
							{
															
							   if (empty($socials_val)) {
									continue;
							   }
												
								$social_media = new UserSocialMedia();
							}	
							
							$social_media->user_id = $user_id;
							$social_media->type = $arr_social_ids_key;
							$social_media->value = $socials_val;
							$social_media->save();					  
					  }*/
					   
					   
				   }
					   
				  
				        
			  //}
			  
			  
			echo '<pre>';
			print_r($column);
            echo '</pre>';
			echo '</br>';
			
			
			
		  }	
		  
		  
		  
		}
			
			echo 'm: '.$m++;
			
			echo '</br>';
			
        }
    
			
			//print_r($file);
			
			// Commit Transaction
				\DB::commit();
				$response = ['msg' => adminTransLang('data_saved_successfully')];
				Session::flash('user_csv_data_saved_flag', 1);
				//return response()->json($response, 200);
			} catch (\Illuminate\Database\QueryException $e) {
				// Rollback Transaction
				\DB::rollBack();

				echo errorMessage($e->errorInfo[2], true);
			}
			
			exit;
			
    	}
    	
	    return view('admin.importcsv.import_csv_data');	
		
	    	
    }
