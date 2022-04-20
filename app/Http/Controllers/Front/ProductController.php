<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductOther;
use App\Models\ProductVideo;
use Illuminate\Http\Request;
use App\Models\ProductBuyFrom;
use App\Models\ProductGallery;
use App\Models\ProductStatistic;
use App\Models\ProductSocialMedia;
use App\Models\Feed;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCollaborator;
use App\Models\ProductOfficialLink;
use App\Http\Controllers\Controller;
use App\Models\MetaData;
use App\Models\ProductCommunityStat;
use App\Models\ProductClassification;
use App\Models\ProductAdditionalSuggestion;
use App\Models\ProductCategory;
use App\Models\ProductGalleryMetaData;
use App\Models\User;
use App\Models\BrandList;
use App\Models\Role;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use Session;
use File;

class ProductController extends ModuleController
{
	
	protected $_collaboratorPhotosFolder;
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->_collaboratorPhotosFolder = Utilities::get_collaborator_upload_folder_path();		
	}

    public function getIndex()
    {
        $current_user = get_current_user_info();
        // pr($current_user,1);
        $products = Product::where('user_id', $current_user->id)
            ->orderBy('sr_no', 'asc')
            ->get();

        return view('front.user.product.index', compact('products'));
    }

    public function getProductCreate()
    {
        $current_user = get_current_user_info();
        ProductCollaborator::where(['product_id' => '0','user_id' => $current_user->id])->delete();
    	$slug = '';
        $category = Category::pluck('category_name', 'id');
		$user = get_current_user_info();        
        $manufacture_list = User::get_company_search_by_name('');
        $brand_list = BrandList::get_brand_list_search_by_name('');
        $collaborator_list = User::get_people_search_by_name('');
        return view('front.user.product.add', compact('category','slug', 'user','manufacture_list','brand_list','collaborator_list'));
    }


    public function postProductCreate(Request $request)
    {
        // pr($request->all(),1);		
		//$request->validate(Product::validateProduct());	
		
		$rules = [
		    'product_id' => 'nullable|exists:products,id',
            'product' => 'array',
            'socials.*' => 'sometimes|nullable|url',
            'official_links.*' => 'sometimes|nullable|url',
            'product.product_id_number' => 'required',
            // 'product.user_id' => 'required',
            'product.name' => 'required',
            //'product.brand' => 'required',
            //'product.company' => 'required',
            'product.group_id' => 'required',
            // 'product.ratings' => 'required',
            // 'product.buy' => 'required',
            'product.description' => 'required',
            'gallery' => 'array',
            'gallery.*' => 'file',
            // 'classification' => 'required',
            'category1' => 'required',
            // 'sub_category1' => 'required',
            // 'categories' => 'required|array',
            // 'classification.category_id' => 'required|exists:categories,id',
            // 'classification.sub_category' => 'required|exists:categories,id',
            // 'classification.toy_type' => 'required',
            //'classification.inventor' => 'required',
            // 'classification.team' => 'required',
            // 'classification.launched' => 'required',
            //'buy_from.*.type' => 'required',
            // // 'buy_from.*.suggested_retail' => 'required',
            // 'buy_from.*.ebay' => 'required',
            //'buy_from.*.ebay' => 'sometimes|nullable|url',
            //'buy_from.*.amazon' => 'required|nullable|url',
			//'buy_from.*.amazon_caption' => 'required',
            //'buy_from.*.pop' => 'sometimes|nullable|url',
            // 'buy_from.*.pop' => 'required',

            /*'collaborator.image' => 'required_without:product_id|array',
            'collaborator.name' => 'required|array',
            'collaborator.role' => 'required|array',*/
            
            // 'community_stats.own' => 'required',
            // 'community_stats.for_trade' => 'required',
            // 'community_stats.wishlist' => 'required',
            // 'community_stats.want_it_trade' => 'required',
            // 'community_stats.has_part' => 'required',
            // 'community_stats.wants_part' => 'required',
            
            // 'stats.rating' => 'required',
            // 'stats.page_views' => 'required',
            // 'stats.standard_deviation' => 'required',
            // 'stats.number_of_ratings' => 'required',
            // 'stats.overall_rank' => 'required',
            // 'stats.all_time_plays' => 'required',
            // 'stats.party_rank' => 'required',
            // 'stats.this_month' => 'required',
            // 'stats.own' => 'required',
            // 'stats.for_trade' => 'required',
            // 'stats.wishlist' => 'required',
            // 'stats.previously_owned' => 'required',
            // 'stats.want_it_trade' => 'required',
            // 'stats.has_part' => 'required',
            // 'stats.wants_part' => 'required',
            // 'stats.comments' => 'required',            
            'other.in_depth_review',
            // 'other.ratings',
            // 'other.forum',
            // 'other.forum_categories'			
        ];

        if ($request->hasFile('main_image')){
           $rules['main_image'] =  'max:2048'; 
        } 
    	
         
    	$niceNames = [
    		'product_id' => 'Product Id',
                'product' => 'Product',
                'product.product_id_number' => 'Product Id',
                // 'product.user_id' => 'required',
                'product.name' => 'Product Name',
                'product.brand' => 'Brand',
                'product.company' => 'Company',
				'product.launched_date' => 'Launched',				
                'product.group_id' => 'Group',
                // 'product.ratings' => 'required',
                // 'product.buy' => 'required',
                'product.description' => 'Description',
                // 'classification' => 'required',
                'category1' => 'Primary Category',
                // 'sub_category1' => 'Primary Sub Category',
                // 'categories' => 'required|array',
                // 'classification.category_id' => 'required|exists:categories,id',
                // 'classification.sub_category' => 'required|exists:categories,id',
                // 'classification.toy_type' => 'required',
                //'classification.inventor' => 'Inventor',
                // 'classification.team' => 'required',
                // 'classification.launched' => 'required',
                'buy_from.*.type' => 'Buy From Type',
                // // 'buy_from.*.suggested_retail' => 'required',
                // 'buy_from.*.ebay' => 'required',
                'buy_from.*.amazon' => 'Buy From Amazon',
                // 'buy_from.*.pop' => 'required',

                /*'collaborator.image' => 'required_without:product_id|array',
                'collaborator.name' => 'required|array',
                'collaborator.role' => 'required|array',*/
                
                // 'community_stats.own' => 'required',
                // 'community_stats.for_trade' => 'required',
                // 'community_stats.wishlist' => 'required',
                // 'community_stats.want_it_trade' => 'required',
                // 'community_stats.has_part' => 'required',
                // 'community_stats.wants_part' => 'required',
                
                // 'stats.rating' => 'required',
                // 'stats.page_views' => 'required',
                // 'stats.standard_deviation' => 'required',
                // 'stats.number_of_ratings' => 'required',
                // 'stats.overall_rank' => 'required',
                // 'stats.all_time_plays' => 'required',
                // 'stats.party_rank' => 'required',
                // 'stats.this_month' => 'required',
                // 'stats.own' => 'required',
                // 'stats.for_trade' => 'required',
                // 'stats.wishlist' => 'required',
                // 'stats.previously_owned' => 'required',
                // 'stats.want_it_trade' => 'required',
                // 'stats.has_part' => 'required',
                // 'stats.wants_part' => 'required',
                // 'stats.comments' => 'required',            
                'other.in_depth_review',
                // 'other.ratings',
                // 'other.forum',
                // 'other.forum_categories'	
        ];
    	
    	 $name = [
                    'socials.*' => 'Socials URL format is Invalid. Please enter full https:// address',
                    'official_links.*' => 'Official Links URL format is Invalid. Please enter full https:// address',
                    'buy_from.*.amazon.url'   => 'Buy From amazon URL format is Invalid. Please enter full https:// address',
                    'buy_from.*.ebay.url'     => 'Buy From ebay URL format is Invalid. Please enter full https:// address',
                    'buy_from.*.pop.url'      => 'Buy From pop URL format is Invalid. Please enter full https:// address',
                ]; 
       $this->validate($request, $rules, $name, $niceNames);

		
		
            try {
                $current_user = get_current_user_info();

                // DB::beginTransaction();

                // Add Product
                $product = $this->addProduct($request);

                // TODO: Add Gallery
                if ($request->hasFile('gallery')) {
                    $this->addGallery($request, $product->id);
                }

                // Add Classification
                $classification_data = $request->classification;
                $classification_data['user_id'] = $current_user->id;
                $classification_data['product_id'] = $product->id;
                ProductClassification::updateOrCreate(['product_id' => $product->id], $classification_data);

                // Add Additional Suggestion
                // $additional_suggestion = $request->additional_suggestion;
                // $additional_suggestion['user_id'] = $current_user->id;
                // $additional_suggestion['product_id'] = $product->id;
                // ProductAdditionalSuggestion::insert($additional_suggestion);

                // Add BuyFrom
                foreach ($request->buy_from as $buy_from) {
                    $buy_from['user_id'] = $current_user->id;
                    $buy_from['product_id'] = $product->id;
                    ProductBuyFrom::updateOrCreate(['product_id' => $product->id], $buy_from);
                }

                // Add Categories

                // Add Categories
                ProductCategory::where('product_id', $product->id)->delete();
                $category_data = array(
                    'user_id' => @$product->user_id,
                    'product_id' => @$product->id,
                    'category_id' => $request->category1,
                    'sub_category_id' => $request->sub_category1,
                );
                ProductCategory::insert($category_data);

                if(!empty($request->category2) && !empty($request->sub_category2)){
                    $category_data['category_id'] = $request->category2;
                    $category_data['sub_category_id'] = $request->sub_category2;
                    ProductCategory::insert($category_data);
                }

                if(!empty($request->category3) && !empty($request->sub_category3)){
                    $category_data['category_id'] = $request->category3;
                    $category_data['sub_category_id'] = $request->sub_category3;
                    ProductCategory::insert($category_data);
                }
            
                // $categories = array_map(function ($data) use ($current_user, $product) {
                //     return [
                //         'user_id' => $current_user->id,
                //         'category_id' => $data,
                //         'product_id' => $product->id
                //     ];
                // }, $request->categories);

                // ProductCategory::where('product_id', $product->id)->delete();
                // ProductCategory::insert($categories);


                // Add Collaborators
                $update_collaborator = ['product_id' => $product->id,'user_id' => $product->user_id];
                $where_collaborator  = ['product_id' => '0','user_id' => $current_user->id];
                ProductCollaborator::where($where_collaborator)->update($update_collaborator);

            // Add Official Link
            $officials = collect($request->official_links)->map(function ($link) use ($product, $current_user) {

                return [
                    'user_id' => $current_user->id,
                    'product_id' => $product->id,
                    'value' => $link
                ];
            })
                ->filter(function ($data) {
                    return $data['value'] !== null;
                });
            // dd($officials);
            ProductOfficialLink::where('product_id', $product->id)->delete();
            ProductOfficialLink::insert($officials->toArray());

            // Add Video
            $videos = collect($request->official_links)->map(function ($link) use ($product, $current_user) {
                return [
                    'user_id' => $current_user->id,
                    'product_id' => $product->id,
                    'value' => $link
                ];
            });
            ProductVideo::where('product_id', $product->id)->delete();
            ProductVideo::insert($videos->toArray());

            // Add Socials
            /*if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    if (!is_null($socials)) {
                        $social_media =  ProductSocialMedia::where('user_id', $current_user->id)
                            ->where('type', $key)
                            ->first();
                        if (!$social_media) {
                            $social_media = new ProductSocialMedia();
                            $social_media->user_id = $current_user->id;
                            $social_media->product_id = $product->id;
                        }
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();
                    }
                }
            }*/
			
			if ($request->filled('socials')) {
                foreach ($request->socials as $key => $socials) {
                    
					$social_media =  ProductSocialMedia::where('user_id', $current_user->id)
                            ->where('product_id', $product->id)
							->where('type', $key)
                            ->first();
						
					   if (!empty($social_media->id)) {
                         	$social_media = \App\Models\ProductSocialMedia::find($social_media->id);
                        }
                        else
						{
                           if (empty($socials)) {
						        continue;
					       }
                  						  	
							$social_media = new ProductSocialMedia();
						}	
						
						$social_media->user_id = $product->user_id;
                        $social_media->product_id = $product->id;
                        $social_media->type = $key;
                        $social_media->value = $socials;
                        $social_media->save();                    
                }
            }

            // Add Product Stats
            $stats = $request->stats;
            $stats['user_id'] = $current_user->id;
            $stats['product_id'] = $product->id;
            ProductStatistic::updateOrCreate(['product_id' => $product->id], $stats);


            // Add Others
            $other = $request->other;
            $other['user_id'] = $current_user->id;
            $other['product_id'] = $product->id;
            ProductOther::updateOrCreate(['product_id' => $product->id], $other);

            // DB::commit();
            return successMessage('Product Saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return errorMessage($e->getMessage(), true);
        }
    }


    public function getUpdate($slug)
    {
        //$product = Product::where('slug', $slug)->firstOrFail();
		
		$product = Product::where('slug', $slug)
            ->with([
                'buyFrom',
				'collaborators'
            ])
            ->firstOrFail();
		
        $category = Category::pluck('category_name', 'id');
		$collaborator_photos_folder = $this->_collaboratorPhotosFolder;
		
		$user = get_current_user_info();
        $manufacture_list = User::get_company_search_by_name('');
        $brand_list = BrandList::get_brand_list_search_by_name('');
        $collaborator_list = User::get_people_search_by_name('');
        
        // pr($product->toArray()); die;
        return view('front.user.product.add', compact('user', 'product', 'category','slug','collaborator_photos_folder','manufacture_list','brand_list','collaborator_list'));
    }

    public function getDelete($slug)
    {
        //Product::where('slug', $slug)->firstOrFail()->delete();
		
		try {

            DB::beginTransaction();
			
			$product = Product::where('slug', $slug)->firstOrFail();
			
			$file_path = Utilities::get_images_upload_folder_path();
			$image_path = public_path($file_path . $product->main_image);
			
			if(file_exists($image_path)) {
				File::delete($image_path);
			}
			
			ProductSocialMedia::where('product_id', $product->id)->delete();
			ProductClassification::where('product_id', $product->id)->delete();
			ProductCollaborator::where('product_id', $product->id)->delete();
			ProductOfficialLink::where('product_id', $product->id)->delete();
			ProductCategory::where('product_id', $product->id)->delete();
			ProductBuyFrom::where('product_id', $product->id)->delete();
			ProductOther::where('product_id', $product->id)->delete();
			ProductStatistic::where('product_id', $product->id)->delete();
			ProductVideo::where('product_id', $product->id)->delete();
			Role::where('product_id', $product->id)->delete();			
			Product::where('id', $product->id)->delete();
			
			DB::commit();
			
			Session::flash('product_data_deleted_flag', 1);
            
        } catch (\Exception $e) {
            DB::rollback();
            
			Session::flash('product_data_deleted_flag', 0);
        }
		
        return redirect()->route('front.user.product.index');
    }


    // Private Methods

    private function addGallery($request, $product_id)
    {
        $current_user = get_current_user_info();
        foreach ($request->gallery as $gallery) {
            $data = [];
            $file = $gallery;
            $extension = $file->getClientOriginalExtension();
            $timestamp = generateFilename();
            $filename = $timestamp . '.' . $extension;
            $file_path = imagePath();
            $upload_status = $file->move($file_path, $filename);
            if ($upload_status) {
                $data = [
                    'title' => $filename,
                    'user_id' => $current_user->id,
                    'product_id' => $product_id
                ];
            } else {
                // Rollback Transaction
                DB::rollBack();

                $message = ['msg' => errorMessage('file_uploading_failed')];
                return response()->json($message, 422);
            }
            $product_gallery = ProductGallery::create($data);
            if ($request->has('gallery_meta')) {
                $meta_data = $request->gallery_meta;
                $meta_data['gallery_id'] = $product_gallery->id;
                // dd($meta_data);
                MetaData::create($meta_data);
            }
        }

        // return ProductGallery::insert($data);
        return true;
    }

    private function addProduct($request)
    {
        // echo "<pre>request - "; print_r($request->all()); die;
        $current_user = get_current_user_info();
        $product_data = $request->product;
        // echo "<pre>"; print_r($product_data); die;
        $product_data['user_id'] = $current_user->id;
		
		if(!empty($product_data['company_hidden_id']))
		{
		  $product_data['company'] = $product_data['company_hidden_id'];	
		}
        else
		{
		  $product_data['company'] = $product_data['company'];	
		}
		
        if(!empty($product_data['brand_hidden_id']))
		{
		  $product_data['brand'] = $product_data['brand_hidden_id'];	
		}
        else
		{
		  $product_data['brand'] = $product_data['brand'];	
		}

        $product_data = $this->save_fun_facts_data('', $product_data, $request);     		
		
        // pr($product_data,1);        
        if ($request->hasFile('main_image')) {
            $file = $request->main_image;
            $extension = $file->getClientOriginalExtension();
			//$extension = UtilitiesTwo::get_image_ext_name();
            $timestamp = generateFilename();
            $filename = $timestamp . '.' . $extension;
            $file_path = imagePath();
            $upload_status = $file->move($file_path, $filename);
            //$upload_status =  UtilitiesTwo::compress_image($file, public_path($file_path) . $filename);//, 80
			if ($upload_status) {
                $product_data['main_image'] = $filename;
            } else {
                // Rollback Transaction
                DB::rollBack();

                $message = ['msg' => errorMessage('file_uploading_failed')];
                return response()->json($message, 422);
            }
        }
        $product_done = Product::updateOrCreate(['id' => $request->product_id], $product_data);
        // $last_id = $product_done->id;
        
        if(!empty($request->feed_check == 'on')){

            $feed_data = array(
                'user_id'=>$current_user->id,
                'type'=>5,
                'title'=>ucfirst($product_done->name),
                'caption' => ucfirst($product_done->description),
                'tag' => '',
                'tag_peoples' =>'',
                'tag_products' =>'',
                'tag_companies' =>'',
                'category_id' => $product_done->id,
                'product_name' => $product_done->name,
                'url' => url('product/'.$product_done->slug),
                'image' => $product_done->main_image,
                'check_post' =>1,
                'time' =>time(),
            );
            $feedInsert = Feed::updateOrCreate(['id' => $product_done['feed_id']],$feed_data);
            Product::where('id',$product_done->id)->update(['feed_id'=>$feedInsert->id]);
        }
        
        return $product_done;
    }

    public function collaborator_AddEdit(Request $request )
    {
        // pr($request->all()); die;

        $request->validate([        
            'collab_user_name' => 'required',
            'collab_user_role' => 'required',
        ]);   

        $current_user = get_current_user_info();
        $product = Product::where('id', $request->product_id)->first();
        $product_id = (!empty($request->product_id)) ? $request->product_id : '0' ;
        $user_id = (!empty($product->user_id)) ? $product->user_id : $current_user->id ;


    	/*if ($request->hasFile('collab_user_image')) {
            $file = $request->collab_user_image;
			$extension = $file->getClientOriginalExtension();
			$timestamp = generateFilename();
			$filename = $timestamp . '.' . $extension;
			$file_path = $this->_collaboratorPhotosFolder;

			$upload_status = $file->move(public_path($file_path), $filename);
			if ($upload_status) {
				$collaborators['image'] = $filename;
			} else {
				throw new \Exception(errorMessage('file_uploading_failed'));
			}	
		}
		else if(!empty($request->collab_hidden_user_image))
		{
		   $collaborators['image'] = $request->collab_hidden_user_image;	
		}
		else
		{
			$collaborators['image'] = '';
		}*/
		
		$int_people_id = $request->input('collab_user_id_hidden');
		
		if(!empty($int_people_id))
		{
			$collaborators['people_id'] = $int_people_id;
		}
		else
		{
		    $collaborators['name'] = $request->collab_user_name;	
            $collaborators['people_id'] = $request->collab_user_name;
		}

		$collaborators['user_id'] = $user_id;
		$collaborators['product_id'] = $product_id;
		
		$collaborators['role'] = $request->collab_user_role;
		$collaborators['created_at'] =  new \DateTime();
		$collaborators['updated_at'] =  new \DateTime();

        // pr($collaborators); die;

		// ProductCollaborator::where('product_id', $request->product_id)->delete();
		$where = array('product_id' => $product_id,'id' => $request->collaboration_id);
		$role_data = ProductCollaborator::updateOrCreate($where, $collaborators);
		
		$get_people_data =  User::get_people_name_by_id($role_data->people_id);
		
		if(!empty($get_people_data->id))
		{
			$str_people_name = $get_people_data->people_name;
		}
		else
		{
			$str_people_name = $role_data->name;
		}
		
		$str_profile_image = @imageBasePath($role_data->collaboratorData->profile_image);
		
		//print_r($role_data->collaboratorData);exit;

		if($role_data){
            foreach(users_user_roles() as $key => $value){
                if(@$role_data->role == $key){
                    $user_role = $value;
                }
            }
			
			/* <td class="verticalalign text-left pl-0">
                          <img src="'.@$str_profile_image.'" alt="" width="50px" height="50px" class="rounded-circle">
                        </td>
                <td class="verticalalign text-left pl-0">
                          <img src="'.@$str_profile_image.'" alt="" width="50px" height="50px" class="rounded-circle">
                        </td>
                                                

						*/

            $url = "/user/product/collaborator/delete/".$role_data->id;
            if(!empty($request->collaboration_id) && $request->collaboration_id == $role_data->id){
                $html ='<td class="verticalalign text-left pl-0">'.$str_people_name.'</td>
                        <td class="verticalalign text-left pl-0">'.$user_role.'</td>
                        <td class="verticalalign text-left pl-0">
                          <span class="table-edit">
                              <a href="#" class="span-style1 my-0 edit-role-popup-class" data-user_role="'.$role_data->role.'" data-people_name="'.$str_people_name.'" data-people_id="'.$role_data->people_id.'" data-user_name="'.$role_data->name.'" data-user_image="'.$this->_collaboratorPhotosFolder.$role_data->image.'" data-hidden_user_image="'.$role_data->image.'" data-collaboration_id="'.$role_data->id.'" >Edit</a>
                          </span>
                        </td>
                        <td class="verticalalign text-left">
                          <span class="table-delete">
                            <a href="#" class="text-danger my-0" onclick="return deleteCollaboratorModal('.$role_data->id.');">Delete</a>
                          </span>
                        </td>';
                // pre($html,1);
                return json_encode(['status' => true, 'html' => $html]);
            }
            $url = "/user/product/collaborator/delete/".$role_data->id;
            $html ='<tr class="" id="row_'.$role_data->id.'">
                        <td class="verticalalign text-left pl-0">'.$str_people_name.'</td>
                        <td class="verticalalign text-left pl-0">'.$user_role.'</td>
                        <td class="verticalalign text-left pl-0">
                          <span class="table-edit">
                              <a href="#" class="span-style1 my-0 edit-role-popup-class" data-user_role="'.$role_data->role.'" data-people_name="'.$str_people_name.'" data-people_id="'.$role_data->people_id.'" data-user_name="'.$role_data->name.'" data-user_image="'.$this->_collaboratorPhotosFolder.$role_data->image.'" data-hidden_user_image="'.$role_data->image.'" data-collaboration_id="'.$role_data->id.'" >Edit</a>
                          </span>
                        </td>
                        <td class="verticalalign text-left">
                          <span class="table-delete">
                            <a href="#" class="text-danger my-0" onclick="return deleteCollaboratorModal('.$role_data->id.');">Delete</a>
                          </span>
                        </td>
                    </tr>';
            return json_encode(['status' => true, 'html' => $html]);
			return successMessage('collaborator Saved');
		} else {
			return errorMessage('collaborator not saved');
		}
    }

    public function collaborator_delete(Request $request)
    {
        ProductCollaborator::where('id', $request->id)->delete();
        return json_encode(['status' => true, 'data' => $request->id]);
    }

    public function collaborator_edit_modal(Request $request)
    {
        $productCollaborator = ProductCollaborator::where('id', $request->id)->first();

        // pr($productCollaborator->toArray()); die;
        
        $collaborator_list = User::get_people_search_by_name('');
        $view = view('front.user.product.edit_collaborator_popup', compact('productCollaborator','collaborator_list'))->render();

        return json_encode(['status'=>1,'view'=>$view]);
    }

    public function get_sub_category(Request $request)
    {
        $id = $request->id;
        $sub_category  = SubCategory::where('category_id',$id)->get();

        $html = '<option value="">Select Sub Category</option>';
        foreach ($sub_category as $key => $value) {
            $html .= '<option value="'.$value->id.'">'.$value->sub_category.'</option>';
        }
        return $html;
        return json_encode(['status' => true, 'html' => $html]);
    }

    public function update_sequence(Request $request)
    {
        foreach ($request->product_id ?? [] as $key => $value) {
            if($value != 0){
                $product = Product::find($value);
                $product->sr_no = $request->sr_no[$key];
                $product->save();
            }
        }
        // pr($request->all(),1);
        return json_encode(['status' => true, 'data' => $product]);
    }

    public function get_category_BYGroup(Request $request)
    {
        $id = $request->id;
        $category  = Category::where('group_id',$id)->get();

        $html = '<option value="">Select Category</option>';
        foreach ($category as $key => $value) {
            $html .= '<option value="'.$value->id.'">'.$value->category_name.'</option>';
        }
        return $html;
        return json_encode(['status' => true, 'html' => $html]);
    }
}
