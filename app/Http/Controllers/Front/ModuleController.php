<?php
namespace App\Http\Controllers\Front;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\User;
use App\Models\News;
use App\Models\Blog;
use App\Models\Country;
use App\Models\EventAwardNominee;
use App\Models\Gallery;
use App\Models\GalleryProductTag;
use App\Models\GalleryPersonTag;
use App\Models\GalleryAwardTag;
use App\Models\GalleryCompanyTag;
use App\Models\GalleryPeopleTag;
use App\Models\GalleryOtherTag;
use App\Models\Category;
use App\Models\Product;
use App\Models\Event;
use App\Models\Award;
use App\Models\NewsCategoryPivot;
use App\Models\Role;
use App\Models\ProductCollaborator;
use App\Models\UserSubscription;
use App\Models\BrandList;
use App\Models\AwardUser;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Invoice;

use Illuminate\Support\Facades\View;
use Config;

require (app_path() . '/Libraries/PHPMailer-master/vendor/autoload.php');

class ModuleController extends Controller
{
    public $chk_device;
    public $_galleryPhotosFolder;
    public $_blogs_link;
    public $_arr_role_at_list;
    public $_galleryImageDeskLimit;
    public $_galleryImageMobLimit;
    public $_galleryVideoDeskLimit;
    public $_galleryVideoMobLimit;
    public $_galleryKnownForDeskLimit;
    public $_galleryKnownForMobLimit;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->chk_device = Utilities::checkDevice();
        $this->_galleryPhotosFolder = Utilities::get_gallery_upload_folder_path();
        $this->_blogs_link = Utilities::get_blog_link();
        $this->_arr_role_at_list = Utilities::get_roles_at_list();
        $this->_collaboratorPhotosFolder = Utilities::get_collaborator_upload_folder_path();
        $this->_arr_destinations_list = Utilities::get_destination_types_list();
        $this->_usersPhotosFolder = Utilities::get_users_upload_folder_path();

        $this->_galleryImageDeskLimit =10;
        $this->_galleryImageMobLimit = 10;
        $this->_galleryVideoDeskLimit = 10;
        $this->_galleryVideoMobLimit = 10;
        $this->_galleryKnownForDeskLimit = 10;
        $this->_galleryKnownForMobLimit = 10;
    }

    // for gallery images
    public function getGalleryImageData($slug, $user_id, $destination_id, $event_id, $product_id, $brand_list_id, $get_count)
    {
        if (!empty($get_count)) $result = $this->getGalleryResult($destination_id, $slug, $user_id, 1, 0, 0);
        else $result = $this->getGalleryResult($destination_id, $slug, $user_id, 1, 0, $this->_galleryImageDeskLimit);

        return $result;
    }

    // for gallery known for
    public function getGalleryKnownForData($slug, $user_id, $destination_id, $event_id, $product_id, $brand_list_id, $get_count)
    {

        if (!empty($get_count)) $result = $this->getGalleryResult($destination_id, $slug, $user_id, 1, 1, 0);
        else $result = $this->getGalleryResult($destination_id, $slug, $user_id, 1, 1, $this->_galleryKnownForDeskLimit);

        return $result;

    }

    // for gallery videos
    public function getGalleryVideoData($slug, $user_id, $destination_id, $event_id, $product_id, $brand_list_id, $get_count)
    {
        if (!empty($get_count)) $result = $this->getGalleryResult($destination_id, $slug, $user_id, 2, 0, 0);
        else $result = $this->getGalleryResult($destination_id, $slug, $user_id, 2, 0, $this->_galleryVideoDeskLimit);

        return $result;
    }

    // for getting the content of a company , innovator, product or event pages
    public function getPageContentData($page_type, $slug, $user_id)
    {


        $arr_view_data = array();
        $search_data = '';

        $str_modal_form_div_id = "ModalGalleryVideoForm";
        //$this->getTest();exit;
        $product_id = 0;
        $event_id = 0;
        $brand_list_id = 0;
        $blogs_list = '';
        $role_type_data_new = '';
        $page_type_new = $page_type;
        $arr_dest_slugs = Utilities::get_slug_prefix_list();
        $company_id = 0;
        $innovator_id = 0;

        if ($page_type_new == 4)
        {
            $page_type = 1;
        }

        if ($page_type_new == 5)
        {
            $page_type = 4;
        }

        if ($page_type_new == 5)
        {
            $slug_prefix = $arr_dest_slugs[$page_type_new]['page_name'];
        }
        else
        {
            $slug_prefix = $arr_dest_slugs[$page_type]['page_name'];

        }

        // for a people or company page page
        if ($page_type == 1) // || $page_type == 4
        
        {


            $query = User::select('users.home_page_slide_show_caption', 'users.badge_1_caption', 'users.badge_2_caption', 'users.badge_3_caption', 'users.badge_4_caption', 'users.badge_5_caption', 'users.first_name', 'users.last_name', 'users.name', 'users.id', 'users.profile_image', 'users.website', 'users.acronym', 'users.pronoun', 'users.description', 'users.hide_email', 'users.hide_telephone', 'users.hide_secondary_email', 'users.email', 'users.mobile', 'users.virtual_show_room', 'users.dial_code', 'users.fun_fact1', 'users.fun_fact2', 'users.fun_fact3', 'users.dobday', 'users.dobmonth', 'users.phone_number', 'users.secondary_phone_number', 'users.secondary_email', 'users.secondary_mobile', 'users.postal_address', 'users.city', 'users.state', 'users.zip_code', 'users.business_address', 'users.city_business', 'users.state_business', 'users.zip_code_business', 'users.country_id_business', 'users.dobyear', 'users.role', 'users.skills', 'users.services', 'users.gender', 'users.badge_1', 'users.badge_2', 'users.badge_3', 'users.badge_4', 'users.badge_5', 'is_verify_profile')->with(['inventorContactInfo', 'galleries', 'socialMedia', 'inventorAwards', 'roles']);

            //$query->leftJoin('user_social_media', 'user_social_media.user_id', '=', 'users.id');
            if ($page_type_new == 4)
            {
                $query->where('users.role', 3);
            }

            if ($page_type_new == 1)
            {
                $query->where(function ($q)
                {
                    $q->where('users.role', 1)
                        ->orWhere('users.role', 2);
                });
            }

            if (!empty($slug))
            {
                $query->where('users.slug', $slug);
            }
            else
            {
                $query->where('users.id', $user_id);
            }

            //$query->groupBy('user_social_media.type');
            $user = $query->firstOrFail();

            $user_id = $user->id;

            $role_type_data_new = UtilitiesTwo::getRoleText($user->role);

            if ($page_type_new == 4)
            {
                $company_id = $user_id;
            }

            if ($page_type_new == 1)
            {
                $innovator_id = $user_id;
            }

            // for a company profile
            $role_people_query = Role::select('roles.product_id', 'roles.people_id', 'roles.company_id', 'roles.id', 'roles.at', 'roles.role', 'roles.name', 'roles.from_day', 'roles.from_month', 'roles.from_year', 'roles.to_day', 'roles.to_month', 'roles.to_year', 'roles.description', 'people_users.profile_image as role_profile_image', DB::raw('CONCAT(people_users.first_name," ",people_users.last_name) as role_at_name'),'people_users.id as user_ID');

            $role_people_query->leftJoin('users as people_users', 'people_users.id', '=', 'roles.people_id');

            $role_people_query->where(function ($q) use ($search_data)
            {
                $q->where('roles.at', 2)
                    ->orWhere('roles.at', 5);
            });

            if (!empty($company_id))
            {
                $role_people_query->where('roles.company_id', $company_id);
            }

            $role_people_query->groupBy('roles.id', 'roles.people_id');
            // end company profile
            

            // for a people profile
            $role_company_query = Role::select('roles.product_id', 'roles.people_id', 'roles.company_id', 'roles.id', 'roles.at', 'roles.role', 'roles.name', 'roles.from_day', 'roles.from_month', 'roles.from_year', 'roles.to_day', 'roles.to_month', 'roles.to_year', 'roles.description', 'company_users.profile_image as role_profile_image',
            // DB::raw('CONCAT(company_users.first_name," ",company_users.last_name) as role_at_name'));
            DB::raw('CONCAT(company_users.first_name) as role_at_name'),'company_users.id as user_ID');

            $role_company_query->leftJoin('users as company_users', 'company_users.id', '=', 'roles.company_id');

            $role_company_query->where(function ($q) use ($search_data)
            {
                $q->where('roles.at', 2)
                    ->orWhere('roles.at', 5);
            });

            if (!empty($innovator_id))
            {
                $role_company_query->where('roles.people_id', $innovator_id);
            }
            //$role_company_query->where('company_users.role', 3);
            $role_company_query->groupBy('roles.id', 'roles.company_id');
            // for product profile
            $role_product_query = Role::select('roles.product_id', 'roles.people_id', 'roles.company_id', 'roles.id', 'roles.at', 'roles.role', 'roles.name', 'roles.from_day', 'roles.from_month', 'roles.from_year', 'roles.to_day', 'roles.to_month', 'roles.to_year', 'roles.description', 'products.main_image as role_profile_image', 'products.name as role_at_name','products.user_id as user_ID');

            $role_product_query->leftJoin('products', 'products.id', '=', 'roles.product_id');

            if (!empty($innovator_id))
            {
                $role_product_query->where('roles.people_id', $innovator_id);
            }

            $role_product_query->where('roles.at', 1);

            $role_product_query->groupBy('roles.id', 'roles.product_id');

            $colloborator_query = ProductCollaborator::select('product_collaborators.product_id', 'product_collaborators.people_id', DB::raw('0 as company_id') , 'product_collaborators.id', DB::raw('1 as at') , 'product_collaborators.role', 'product_collaborators.name', DB::raw('0 as from_day') , DB::raw('0 as from_month') , DB::raw('0 as from_year') , DB::raw('0 as to_day') , DB::raw('0 as to_month') , DB::raw('0 as to_year') , DB::raw('0 as description') , 'products.main_image as role_profile_image', 'products.name as role_at_name','products.user_id as user_ID');

            $colloborator_query->leftJoin('products', 'products.id', '=', 'product_collaborators.product_id');

            if (!empty($innovator_id))
            {
                $colloborator_query->where('product_collaborators.people_id', $innovator_id);
            }

            $colloborator_query->groupBy('product_collaborators.id', 'product_collaborators.product_id');

            // end people profile
            if (empty($company_id))
            {
             
                $colloborator_query->union($role_company_query);
                $colloborator_query->union($role_product_query);
                //$colloborator_query->union($role_people_query);
                $role_data = $colloborator_query->get();
            }
            // for a company profile
            else
            {
               // echo "sda"; die;
                $role_data = $role_people_query->get();
            }

            // echo '<pre>';
            // print_r($role_data);
            // die;
            if (!empty($user->slug))
            {
                $slug = $user->slug;
            }

            $awards = EventAwardNominee::join('event_awards', 'event_awards.id', '=' , 'event_award_nominees.event_award_id')->where(['event_award_nominees.reference_type' => 1, 'event_award_nominees.is_winner' => 1, 'event_award_nominees.type' => 2, 'event_award_nominees.reference_id' => $user_id])->get();

            $news = News::where('user_id', $user_id)->where('is_featured', 1)
                ->first();

            $user_blogs_list = Blog::where('user_id', $user_id)->orderBy('id', 'desc')
                ->get();

            /* code for slide show products */
            $arr_products_objs_new = array();
            $arr_products_objs_role_names_new = array();

            if (!empty($innovator_id))
            {
                $product_collaborator_query_new = ProductCollaborator::select('product_collaborators.product_id', 'users_user_roles.role_name');

                $product_collaborator_query_new->leftJoin('users_user_roles', 'users_user_roles.id', '=', 'product_collaborators.role');
                $product_collaborator_query_new->where('product_collaborators.people_id', $innovator_id);
                $product_collaborator_query_new->groupBy('product_collaborators.product_id');
                $product_collaborators_data_new = $product_collaborator_query_new->get();

                foreach ($product_collaborators_data_new as $product_collaborators_row_new)
                {
                    $arr_products_objs_new[] = Product::whereId(@$product_collaborators_row_new->product_id)
                        ->first();
                    $arr_products_objs_role_names_new[] = @$product_collaborators_row_new->role_name;
                }
            }

            $product_list_query_new = Product::select('products.id');

            if (!empty($company_id))
            {
                $product_list_query_new->where('products.user_id', $company_id);
            }

            if (!empty($innovator_id))
            {
                $product_list_query_new->where('products.user_id', $innovator_id);
            }
            $product_list_query_new->orderBy('sr_no', 'asc');
            $product_list_query_new->groupBy('products.id');
            $product_list_data_new = $product_list_query_new->get();

            foreach ($product_list_data_new as $product_list_row_new)
            {
                $arr_products_objs_new[] = Product::whereId(@$product_list_row_new->id)
                    ->first();
                $arr_products_objs_role_names_new[] = '';
            }

            $arr_products_objs_new = array_unique($arr_products_objs_new);

            $arr_view_data['arr_products_objs_new'] = $arr_products_objs_new;
            $arr_view_data['arr_products_objs_role_names_new'] = $arr_products_objs_role_names_new;

            $arr_view_data['news'] = $news;
            $arr_view_data['user'] = $user;

            //if($page_type == 4)
            //{
            //$view_file_name = 'front.profile.company.index';
            //}
            //else
            //{
            $view_file_name = 'front.profile.index';
            //}
            $arr_view_data['role_data'] = $role_data;

            $arr_view_data['user_blogs_list'] = $user_blogs_list;

            // echo '<pre>';
            //print_r($user->brand_lists);
            //echo '</pre>';
            //exit;
            
        }

        // for a product page
        if ($page_type == 2)
        {


            $product = Product::where('slug', $slug)->firstOrFail();

            // pr($product->socialMedia->toArray(),1);
            // \DB::enableQueryLog();
            // 	pr($product->created_byy);
            //  $query = \DB::getQueryLog();
            //  pr($query);
            // 	pr($product->id);
            // 	pr($product->user_id,1);
            $product_id = $product->id;

            $collaborator_role_array = config('cms.collaborator_role');

            $awards = EventAwardNominee::join('event_awards', 'event_awards.id', '=' , 'event_award_nominees.event_award_id')->where(['event_award_nominees.reference_type' => 1, 'event_award_nominees.type' => 1, 'event_award_nominees.is_winner' => 1, 'event_award_nominees.reference_id' => $product_id])->get();

            $arr_view_data['product'] = $product;

            $peoples_list = DB::table('roles')->select('users.id as u_id', 'users.profile_image as image', 'users.profile_image as profile_image', DB::raw('CONCAT(users.first_name," ",users.last_name) as people_name') , DB::raw('CONCAT(users.first_name," ",users.last_name) as name') , 'roles.role', DB::raw('2 as type'))
                ->leftJoin('users', 'users.id', '=', 'roles.people_id')
                ->where('roles.product_id', $product_id);

            $colloborator_list = DB::table('product_collaborators')->select('product_collaborators.people_id as u_id', 'product_collaborators.image', 'users.profile_image as profile_image', DB::raw('CONCAT(users.first_name," ",users.last_name) as people_name') , 'product_collaborators.name', 'product_collaborators.role', DB::raw('1 as type'))
                ->leftJoin('users', 'users.id', '=', 'product_collaborators.people_id')
                ->where('product_collaborators.product_id', $product_id);

            $colloborator_list->groupBy('product_collaborators.id', 'product_collaborators.people_id', 'product_collaborators.product_id');

            $colloborator_list->union($peoples_list);

            $peoples_list_data = $colloborator_list->get();
            //echo '<pre>';
            //print_r($peoples_list_data);
            //echo '</pre>';
            //exit;
            $arr_view_data['peoples_list_data'] = $peoples_list_data;

            $arr_view_data['collaborator_role_array'] = $collaborator_role_array;

            $view_file_name = 'front.pages.product';
        }

        // for an event page
        if ($page_type == 3)
        {

            $event = Event::where('slug', $slug)->firstOrFail();

            $event_id = $event->id;

            $arr_view_data['event'] = $event;

            $awards = EventAwardNominee::join('event_awards', 'event_awards.id', '=' , 'event_award_nominees.event_award_id')->where(['event_award_nominees.reference_type' => 1, 'event_award_nominees.type' => 1, 'event_award_nominees.reference_id' => $event_id])->get();

            $view_file_name = 'front.pages.event';
        }

        // for a brand page
        if ($page_type == 4)
        {
           
            $brand_list = BrandList::where('slug', $slug)->firstOrFail();

            // pr($product->socialMedia->toArray(),1);
            // \DB::enableQueryLog();
            // 	pr($product->created_byy);
            //  $query = \DB::getQueryLog();
            //  pr($query);
            // 	pr($product->id);
            // 	pr($product->user_id,1);
            $brand_list_id = $brand_list->id;

            $products_brands_list = DB::table('products')->select('products.id', 'products.main_image', 'products.slug', 'products.name')
                ->where('products.brand', $brand_list_id)->take(20)
                ->get();
            //$brand_list_id = $brand_list_id;
            $collaborator_role_array = config('cms.collaborator_role');

            $awards = EventAwardNominee::join('event_awards', 'event_awards.id', '=' , 'event_award_nominees.event_award_id')->where(['event_award_nominees.reference_type' => 1, 'event_award_nominees.type' => 1, 'event_award_nominees.is_winner' => 1, 'event_award_nominees.reference_id' => $brand_list_id])->get();

            $arr_view_data['brand_list'] = $brand_list;

            $peoples_list = DB::table('roles')->select('users.id as u_id', 'users.profile_image as image', 'users.profile_image as profile_image', DB::raw('CONCAT(users.first_name," ",users.last_name) as people_name') , DB::raw('CONCAT(users.first_name," ",users.last_name) as name') , 'roles.role', DB::raw('2 as type'))
                ->leftJoin('users', 'users.id', '=', 'roles.people_id')
                ->where('roles.product_id', $brand_list_id);

            $colloborator_list = DB::table('product_collaborators')->select('product_collaborators.people_id as u_id', 'product_collaborators.image', 'users.profile_image as profile_image', DB::raw('CONCAT(users.first_name," ",users.last_name) as people_name') , 'product_collaborators.name', 'product_collaborators.role', DB::raw('1 as type'))
                ->leftJoin('users', 'users.id', '=', 'product_collaborators.people_id')
                ->where('product_collaborators.product_id', $brand_list_id);

            $colloborator_list->groupBy('product_collaborators.id', 'product_collaborators.people_id', 'product_collaborators.product_id');

            $colloborator_list->union($peoples_list);

            $peoples_list_data = $colloborator_list->get();
            //echo '<pre>';
            //print_r($peoples_list_data);
            //echo '</pre>';
            //exit;
            $arr_view_data['peoples_list_data'] = $peoples_list_data;

            $arr_view_data['collaborator_role_array'] = $collaborator_role_array;

            $arr_view_data['products_brands_list'] = $products_brands_list;

            $view_file_name = 'front.pages.brand';
        }

        $countries = Country::pluck('country_name', 'id');

        if (!empty($user_id))
        {
            $blogs_list = Blog::where('user_id', $user_id)->orderBy('id', 'desc')
                ->get();
        }

        $res_gallery_image_data = $this->getGalleryImageData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 1);
        $res_gallery_video_data = $this->getGalleryVideoData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 1);
        $res_gallery_known_for_data = $this->getGalleryKnownForData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 1);

        $cnt_gallery_image_data = count($res_gallery_image_data);
        $cnt_gallery_video_data = count($res_gallery_video_data);
        $cnt_gallery_known_for_data = count($res_gallery_known_for_data);

        $gallery_image_data = $this->getGalleryImageData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);
        // echo "<pre>"; print_r($gallery_image_data); die;
        $gallery_video_data = $this->getGalleryVideoData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);
        $gallery_known_for_data = $this->getGalleryKnownForData($slug, $user_id, $page_type, $event_id, $product_id, $brand_list_id, 0);
        // echo "<pre>"; print_r($gallery_known_for_data); die;
        $chk_device = Utilities::checkDevice();
        $blogs_link = $this->_blogs_link;
        $gallery_videos_link = Utilities::get_gallery_videos_link($slug_prefix, $slug);
        $gallery_known_for_link = Utilities::get_gallery_known_link($slug_prefix, $slug);
        $gallery_images_link = Utilities::get_gallery_images_link($slug_prefix, $slug);

        $arr_role_at_list = $this->_arr_role_at_list;

        $arr_event_product_data = $this->getEventProductData($user_id);

        $user_product_data = $arr_event_product_data[0];
        $user_event_data = $arr_event_product_data[1];
        $category_list = $arr_event_product_data[2];
        $person_list = $arr_event_product_data[3];
        $product_list = $arr_event_product_data[4];
        $award_list = $arr_event_product_data[5];
        $company_list = $arr_event_product_data[6];
        $people_list = $arr_event_product_data[7];
        $user_brand_data = $arr_event_product_data[8];

        $arr_destinations_list = $this->_arr_destinations_list;
        $arr_destinations_list_keys = array_keys($arr_destinations_list);
        $collaborator_photos_path = $this->_collaboratorPhotosFolder;
        $folder_path = $this->_galleryPhotosFolder;

        $arr_view_data['innovator_id'] = $innovator_id;
        $arr_view_data['company_id'] = $company_id;
        $arr_view_data['people_users_list'] = User::get_people_users_list();
        $arr_view_data['company_users_list'] = User::get_company_users_list();
        $arr_view_data['awards'] = $awards;
        $arr_view_data['blogs_list'] = $blogs_list;
        $arr_view_data['countries'] = $countries;
        $arr_view_data['arr_destinations_list'] = $arr_destinations_list;
        $arr_view_data['arr_destinations_list_keys'] = $arr_destinations_list_keys;
        $arr_view_data['user_product_data'] = $user_product_data;
        $arr_view_data['user_event_data'] = $user_event_data;
        $arr_view_data['user_product_data'] = $user_product_data;
        $arr_view_data['user_brand_data'] = $user_brand_data;
        $arr_view_data['category_list'] = $category_list;
        $arr_view_data['person_list'] = $person_list;
        $arr_view_data['award_list'] = $award_list;
        $arr_view_data['product_list'] = $product_list;
        $arr_view_data['company_list'] = $company_list;
        $arr_view_data['people_list'] = $people_list;
        $arr_view_data['cnt_gallery_image_data'] = $cnt_gallery_image_data;
        $arr_view_data['cnt_gallery_video_data'] = $cnt_gallery_video_data;
        $arr_view_data['cnt_gallery_known_for_data'] = $cnt_gallery_known_for_data;
        $arr_view_data['folder_path'] = $folder_path;
        $arr_view_data['cnt_gallery_known_for_data'] = $cnt_gallery_known_for_data;
        $arr_view_data['gallery_image_data'] = $gallery_image_data;
        $arr_view_data['gallery_video_data'] = $gallery_video_data;
        $arr_view_data['gallery_known_for_data'] = $gallery_known_for_data;
        $arr_view_data['chk_device'] = $chk_device;
        $arr_view_data['blogs_link'] = $blogs_link;
        $arr_view_data['arr_role_at_list'] = $arr_role_at_list;
        $arr_view_data['str_modal_form_div_id'] = $str_modal_form_div_id;
        $arr_view_data['collaborator_photos_path'] = $collaborator_photos_path;

        $arr_view_data['gallery_images_link'] = $gallery_images_link;
        $arr_view_data['gallery_known_for_link'] = $gallery_known_for_link;
        $arr_view_data['gallery_videos_link'] = $gallery_videos_link;

        $arr_view_data['slug'] = $slug;
        $arr_view_data['user_id'] = $user_id;
        $arr_view_data['page_type'] = $page_type;
        $arr_view_data['product_id'] = $product_id;
        $arr_view_data['event_id'] = $event_id;
        $arr_view_data['brand_list_id'] = $brand_list_id;
        $arr_view_data['arr_role_at_list'] = Utilities::get_roles_at_list();
        $arr_view_data['role_type_data_new'] = $role_type_data_new;
        $arr_view_data['user_award_list'] = AwardUser::where('user_id',$user_id)->get();
       // echo "<pre>"; print_r($role_data); die;
       // echo "<pre>"; print_r($arr_view_data); die;

        $view_content = (string)View::make($view_file_name, $arr_view_data)->render();
        /*  */
        return $view_content;

    }

    public function getGalleryResult($gallery_destination_id, $slug, $user_id, $gallery_type, $is_known_for, $limit)
    {

        $arr_prod_data = array(
            $gallery_destination_id,
            $user_id,
            $slug
        );

        $arr_event_data = array(
            $gallery_destination_id,
            $user_id,
            $slug
        );

        $arr_user_data = array(
            $gallery_destination_id,
            $user_id,
            $slug
        );

        $query = Gallery::select('galleries.id', 'galleries.is_known_for', 'galleries.media', 'galleries.user_id', 'galleries.destination_id', 'galleries.assign_product_id', 'galleries.assign_brand_id', 'galleries.assign_event_id', 'galleries.title', 'galleries.caption', 'galleries.url', 'galleries.featured_image')->with(['gallery_product_tags' => function ($gallery_product_tags)
        {

            $gallery_product_tags->where('status', 1);
            $gallery_product_tags->with('productdata');

        }
        , 'gallery_company_tags' => function ($gallery_company_tags)
        {

            $gallery_company_tags->where('status', 1);
            $gallery_company_tags->with('companydata');

        }
        , 'gallery_people_tags' => function ($gallery_people_tags)
        {

            $gallery_people_tags->where('status', 1);
            $gallery_people_tags->with('peopledata');

        }
        , 'gallery_other_tags' => function ($gallery_other_tags)
        {

            $gallery_other_tags->where('status', 1);

        }
        , 'gallery_person_tags' => function ($gallery_person_tags)
        {

            $gallery_person_tags->where('status', 1);
            $gallery_person_tags->with('persondata');

        }
        , 'gallery_award_tags' => function ($gallery_award_tags)
        {

            $gallery_award_tags->where('status', 1);
            $gallery_award_tags->with('awarddata');

        }
        , 'gallery_products' => function ($gallery_products) use ($arr_prod_data)
        {

            if (!empty($arr_prod_data[0]) && $arr_prod_data[0] == 2)
            {
                $gallery_products->where('user_id', $arr_prod_data[1]);

                $gallery_products->where('slug', $arr_prod_data[2]);
            }

        }
        , 'gallery_events' => function ($gallery_events) use ($arr_event_data)
        {

            if (!empty($arr_event_data[0]) && $arr_event_data[0] == 2)
            {
                $gallery_events->where('user_id', $arr_event_data[1]);

                $gallery_events->where('slug', $arr_event_data[2]);
            }

        }
        , 'gallery_users' => function ($gallery_users) use ($arr_user_data)
        {

            if (!empty($arr_user_data[0]) && $arr_user_data[0] == 1)
            {
                $gallery_users->where('id', $arr_user_data[1]);

                $gallery_users->where('slug', $arr_user_data[2]);
            }

        }
        ]);

        $query->leftJoin('users', 'users.id', '=', 'galleries.user_id');
        $query->leftJoin('products', 'products.id', '=', 'galleries.assign_product_id');
        $query->leftJoin('brand_lists', 'brand_lists.id', '=', 'galleries.assign_brand_id');
        $query->leftJoin('events', 'events.id', '=', 'galleries.assign_event_id');

        if ($gallery_destination_id == 2)
        {
            $query->where('products.slug', $slug);
        }

        if ($gallery_destination_id == 3)
        {
            $query->where('events.slug', $slug);
        }

        if ($gallery_destination_id == 4)
        {
            $query->where('brand_lists.slug', $slug);
        }

        if ($gallery_destination_id == 1)
        {
            $query->where('users.slug', $slug);
        }

        if (!empty($gallery_destination_id))
        {
            $query->where('galleries.destination_id', $gallery_destination_id);
        }

        if (!empty($user_id) && empty($slug))
        {
            $query->where('galleries.user_id', $user_id);
        }

        $query->where('galleries.type', $gallery_type);
        $query->where('galleries.is_known_for', $is_known_for);
        $query->whereNotNull('galleries.media');
        $query->orderBy('galleries.sr_no', 'ASC');
        // $query->orderBy('galleries.featured_image','desc');
        $query->orderBy('galleries.id', 'ASC');
        $query->groupBy('galleries.id');
        if (!empty($limit))
        {
            $gallery_data = $query->paginate($limit);
        }
        else
        {
            $gallery_data = $query->get();
        }

        //echo '<pre>';
        //print_r($gallery_data);
        //echo '</pre>';
        //exit;
        return $gallery_data;
    }

    function getEventProductData($user_id)
    {
        $arr_event_product_data = array();

        $arr_event_product_data[0] = $user_product_data = DB::table('products')->where('user_id', $user_id)->get();
        $arr_event_product_data[1] = $user_event_data = DB::table('events')->where('user_id', $user_id)->get();
        $arr_event_product_data[2] = $category = Category::pluck('category_name', 'id');
        $arr_event_product_data[3] = $person = User::pluck('first_name', 'id');
        $arr_event_product_data[4] = $product = Product::pluck('name', 'id');
        $arr_event_product_data[5] = $award = Award::pluck('name', 'id');
        $arr_event_product_data[6] = $company = User::where('role', 3)->pluck('first_name', 'id');
        $arr_event_product_data[7] = $people_list = User::where('role', 2)->pluck('first_name', 'id');
        $arr_event_product_data[8] = $user_brand_data = DB::table('brand_lists')->where('user_id', $user_id)->get();

        return $arr_event_product_data;
    }

    function send_mail_by_phpmailer($str_to_email_id, $str_mail_subject, $str_mail_body, $arr_data)
    {

        //compact("$arr_data['name']")
        $view_content = (string)View::make($str_mail_body, ["name" => @$arr_data['name'], "url" => @$arr_data['url'],

        "contact_name" => @$arr_data['contact_name'], "contact_email" => @$arr_data['contact_email'], "contact_mobile" => @$arr_data['contact_mobile'], "contact_subject" => @$arr_data['contact_subject'], "contact_message" => @$arr_data['contact_message'], "sender_name" => @$arr_data['sender_name'], "plan_name" => @$arr_data['plan_name'], "email" => @$arr_data['email'], "country" => @$arr_data['country'], "message_data" => @$arr_data['message_data'], "mail_title" => @$arr_data['mail_title'], "str_current_user_name" => @$arr_data['str_current_user_name'], "user_name" => @$arr_data['user_name'], "classified_title" => @$arr_data['classified_title'], "profile_user_link_url_new" => @$arr_data['profile_user_link_url_new'], "message_link" => @$arr_data['message_link'], "mobile" => @$arr_data['mobile'], "plan_price" => @$arr_data['plan_price'], "str_user_url" => @$arr_data['str_user_url'], "str_profile_content_mail" => @$arr_data['str_profile_content_mail'], "end_date" => @$arr_data['end_date'], "username" => @$arr_data['username'], "invoice_url" => @$arr_data['invoice_url'], "role_id" => @$arr_data['role_id'], "title" => @$arr_data['title'], "category_name" => @$arr_data['category_name']])->render();

        // return $view_content; die;
        if (empty($view_content))
        {
            $view_content = ' Mail Body....';
        }

        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        //Set the hostname of the mail server
        $mail->Host = config('mail.host');
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = config('mail.port');

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //$mail->SMTPSecure = 'tls';
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = config('mail.username');

        //Password to use for SMTP authentication
        $mail->Password = config('mail.password');

        //Set who the message is to be sent from
        $mail->setFrom(config('mail.from.address') , Config::get('commonconfig.web_site_name_new'));

        //Set an alternative reply-to address
        $mail->addReplyTo(config('mail.from.address') , Config::get('commonconfig.web_site_name_new'));

        //Set who the message is to be sent to
        $mail->addAddress($str_to_email_id, '');

        //Set the subject line
        $mail->Subject = $str_mail_subject;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $mail->msgHTML($view_content, __DIR__);

        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send())
        {
            return $mail->ErrorInfo;
        }
        else
        {
            return 'message_sent';
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
            
        }

    }

    // cancel a user subscription in stripe and update in subscriptions table
    function cancel_user_stripe_subscription($user)
    {
        Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

        $str_date_time = date('Y-m-d H:i:s');

        $subscription_data = UserSubscription::where(['user_id' => $user->id, ])
            ->orderBy('id', 'desc')
            ->get();

        if (!empty($subscription_data) && count($subscription_data) > 0)
        {
            foreach ($subscription_data as $subscription_data_row)
            {
                if (!empty($subscription_data_row) && strpos($subscription_data_row, 'ub_') > 0)
                {
                    //if(!empty($user->subscription))
                    //{
                    //$pre_plan = $subscript = $user->subscription;
                    $subscription_id = $subscription_data_row->stripe_subscription_id;

                    if (!empty($subscription_id))
                    {
                        $subscription_data = Subscription::retrieve($subscription_id,);

                        if ($subscription_data->status != 'canceled')
                        {
                            Subscription::update($subscription_id, ['cancel_at_period_end' => true, ]);

                            // $subscription_data->cancel();
                            DB::table('user_subscriptions')->where('stripe_subscription_id', $subscription_id)->update(['status' => 4, 'cancelled_at' => $str_date_time]);

                        }

                    }
                    //}
                    
                }
            }
        }
    }

    // delete a user in stripe
    function delete_user_stripe($user)
    {
        Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));

        if (!empty($user->stripe_id) && strpos($user->stripe_id, 'us_') > 0)
        {

            if (!empty($user->stripe_id))
            {
                $customer_data = Customer::retrieve($user->stripe_id,);

                if (!empty($customer_data->id))
                {
                    $customer_data->delete(); //[$customer_data->id], []
                    
                }

            }
        }

    }

    // save funfacts
    function save_fun_facts_data($obj, $arr_product, $request)
    {
        if (!empty($arr_product))
        {
            $arr_product['fun_fact1'] = @$request->product['fun_fact1'];
            $arr_product['fun_fact2'] = @$request->product['fun_fact2'];
            $arr_product['fun_fact3'] = @$request->product['fun_fact3'];

            return $arr_product;
        }

        if (!empty($obj))
        {
            $obj->fun_fact1 = @$request->fun_fact1;
            $obj->fun_fact2 = @$request->fun_fact2;
            $obj->fun_fact3 = @$request->fun_fact3;

            return $obj;
        }
    }
}