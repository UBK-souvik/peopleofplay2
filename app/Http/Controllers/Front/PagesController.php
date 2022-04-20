<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Meme;
use App\Models\OfficeHour;
use App\Models\HomePageAward;
use App\Models\HomePageAwardType;
use App\Models\Poll;
use App\Models\Pub;
use App\Models\News;
use App\Models\HomePage;
use App\Models\SideBar;
use App\Models\Dictionary;
use App\Models\PollAnswer;
use App\Models\Advertisement;
use App\Models\Collection;
use App\Models\Blog;
use App\Models\Wiki;
use App\Models\Entertainment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\UtilitiesFour;
use App\Helpers\Utilities;
use App\Models\HomePageWhateverDay;
use App\Models\HomePageDetail;
use App\Models\PubHeading;
use App\Models\PubMeetingRooms;
use App\Models\Feed;
use App\Models\UserSubscription;
use DB;
use Response;
use DateTime;

use App\Models\CouponCode;
use App\Models\Plan;
use App\Models\UserSubscriptionServer;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Helpers\UtilitiesTwo;
use Carbon\Carbon;

class PagesController extends Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->config = \App\Models\SiteSetting::get_keys(1);
  }

  public function getHomePage()
  {  

    $str_current_date = date('Y-m-d');
     // ******* || Meme || ******* //
    $this->memeScheduleData();
    $home_product_data = HomePageWhateverDay::get_happy_whatever_day(); 

    $home_advertisement_data = Advertisement::select('home_caption_one','home_caption_two','title','sponsor_name','advertisement_image','destination_link','id')
    ->where('advertisement_position', 4)
    ->where('advertisement_category', 1)
    ->where('status', 1)
    ->first();		

    $dictionary_detail = Dictionary::get_dictionary_word_of_day();

    $available_type = config('cms.sidebar_type');
    $sidebar_list = SideBar::where('status', 1)
    ->orderBy('display_order', 'asc')
    ->get();

    $home_page = HomePage::where('status', 1)
    ->orderBy('display_order', 'asc')
    ->get();
		/*	
		$query = HomePage::select('home_pages.status','home_pages.type', 'home_pages.title','home_pages.display_order')
		    ->with([
                'VideoLinks',
                'RightVideoLinks',
                'products',
                'events',
				'users',
				'brand_lists'
            ]);
			
           $query->where('home_pages.status', 1);
		   $query->orderBy('home_pages.display_order', 'asc');
           
		   $home_page = $query->get(); echo '<pre>';		
		print_r($home_page);
    echo '</pre>';exit;*/

    $ip = request()->ip();
    $user_id = null;
    $today = date('Y-m-d');

    $poll_answers = Poll::select('polls.*')
    ->join('poll_answers', 'poll_answers.poll_id', '=', 'polls.id');

    if (\Auth::guard('users')->user()) {
      $user = get_current_user_info();
      $user_id = $user->id;
      $poll_answers = $poll_answers->where('poll_answers.user_id', $user_id);
    } else {
      $poll_answers = $poll_answers->where('poll_answers.ip', $ip);
    }
    $poll_answers  = $poll_answers->pluck('id')->toArray();

    $poll = Poll::whereNotIn('id', $poll_answers)
    ->first();

		 //$news = News::where('user_id', $user_id)
    $news = News::where('status', 1)
    ->where('user_id', 0)
    ->where('added_by', 2)
    ->first();

		// pr($news->toArray(),1);

    $popular_news = News::where('status', 1) 
    ->where('user_id', 0)
    ->where('added_by', 2)
    ->orderBy('id','desc')
    ->take(4)
    ->get();				

    $default_advertisement_data = Advertisement::where('advertisement_position', 1) 
    ->where('is_default', 1)
    ->where('status', 1)
    ->orderBy('id','desc')
    ->first();

    $between_advertisement_data  = Advertisement::where('advertisement_position', 1) 		
    ->whereDate('from_date','<=', $today)
    ->whereDate('to_date','>=', $today)
    ->where('status', 1)
    ->orderBy('id','desc')
    ->first();

    $collection_data  = Collection::where('status', 1) 		
    ->orderBy('id','desc')
    ->get();  

    if(empty($between_advertisement_data->id))
    {
     $between_advertisement_data = $default_advertisement_data; 
   }	

   $home_page_award_types = DB::table('home_page_award_type')
   ->join('home_page_award_list','home_page_award_list.type','=','home_page_award_type.id')
   ->select('home_page_award_type.*')
   ->where('home_page_award_type.status',1)
   ->groupBy('id')
   ->get();
   $new_Arr = array();
   foreach ($home_page_award_types as $key => $row_award) {
     $home_page_award_types[$key]->home_page_award = HomePageAward::where(['status'=>1,'type'=>$row_award->id])->get();
              // foreach ($newstr as $value) {
              //      $new_Arr[$value->featured_image] = $value;
              // }
              // shuffle($new_Arr);
              // $home_page_award_types[$key]->home_page_award = $new_Arr;
   }
            //echo "<pre>"; print_r($home_page_award_types); die;
   $arr_dictionary_data = UtilitiesFour::getDictionaryFieldsData($dictionary_detail);


   return view('front.pages.home', compact('home_product_data', 'home_advertisement_data', 'arr_dictionary_data','dictionary_detail', 'home_page', 'poll', 'news', 'between_advertisement_data', 'popular_news','sidebar_list', 'collection_data','home_page_award_types'));


 }

  /************************ || Shubham Stripe Test Code Start ||  ************************/
    
    public function getUserSubscriptionCron(){

      $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
      $st_customers = $stripe->customers->all(['limit' => 100]);
      // echo '<pre>Live st_customers - '; print_r($st_customers); die;
      $customer_details = [];
      foreach($st_customers as $customer) {
        $customer_details[$customer->id]['id'] = $customer->id;
        $customer_details[$customer->id]['email'] = $customer->email;
      }
      $i_cnt = 0;
      while($st_customers->has_more) {
        // if($i_cnt == 500){
        //     break;
        // }
        $st_customers = $stripe->customers->all([
        'limit' => 100,'starting_after' => $st_customers->data[count ($st_customers->data) - 1]->id
        ]);
        foreach ($st_customers as $customer) {
          $customer_details[$customer->id]['id'] = $customer->id;
          $customer_details[$customer->id]['email'] = $customer->email;
          $i_cnt++;
        }
      }
      // echo '<pre>Live customer_details - '; print_r($customer_details); die;
      
      $customer_details = DB::table('user_subscriptions')->where('user_subscriptions.plan_id','!=',1)->get();

      $update_data = 0;
      foreach($customer_details as $customers){        
        // echo '<pre>Live customers - '; print_r($customers); die;
        try{
          $user = DB::table('users')->where('email',$customers['email'])->first();
          $st_subscriptions = $stripe->subscriptions->all(['customer'=>$customers['id'],'limit' => 100]);
          // echo "<pre>Live user $customers[email] - "; print_r($user); die;
          if($user){
            foreach($st_subscriptions as $st_customer){
              // echo '<pre>Live st_customer - '; print_r($st_customer); die;
              if($st_customer->livemode == 1){
                $plans = DB::table('plans')->where('stripe_plan_id_live',$st_customer->plan->id)->first();        
              }else{
                $plans = DB::table('plans')->where('stripe_plan_id',$st_customer->plan->id)->first();        
              }
              $st_paymentIntents = $stripe->paymentIntents->all(['customer'=>$st_customer->customer,'limit' => 10]);            
              foreach($st_paymentIntents as $st_paymentIntent){
                if(isset($st_paymentIntent->id) && !empty($st_paymentIntent->id)){
                  $EndDate    = date('Y-m-d H:i:s',$st_paymentIntent->created);
                  $NewEndDate = date('Y-m-d H:i:s', strtotime($EndDate . " +1 year"));
                  // echo '<pre>Live st_paymentIntent - '; print_r($st_paymentIntent); //die;
                  $data['user_id'] = $user->id;
                  $data['plan_id'] = @$plans->id;
                  $data['stripe_payment_id'] = @$st_paymentIntent->id;
                  $data['stripe_id'] = $st_customer->customer;
                  $data['stripe_plan_id'] = $st_customer->plan->id;
                  $data['price'] = @$plans->price;
                  $data['validity'] = @$plans->validity;
                  $data['stripe_subscription_id'] = $st_customer->id;        
                  $data['ends_at'] = $NewEndDate;
                  if(@$st_paymentIntent->charges->data[0]->status == 'succeeded'){
                    $data['payment_status'] = 2;
                  }elseif(@$st_paymentIntent->status == 'failed'){
                    $data['payment_status'] = 1;
                  }else{
                    $data['payment_status'] = 3;
                  }              
                  
                  pr($data);
                  
                  // $user_subscriptions_update = DB::table('user_subscriptions')->where(['user_id'=>$user->id,'stripe_id'=>$st_customer->customer,'stripe_plan_id'=>$st_customer->plan->id,'stripe_subscription_id'=>$st_customer->id])->update(['stripe_payment_id'=>$st_paymentIntent->id]);                
                  // if($user_subscriptions_update == 1){
                  //   $update_data = $update_data + $user_subscriptions_update;
                  //   echo $update_data;
                  // }
                  // // elseif($user_subscriptions_update == 0){
                  // //   $user_subscriptions_update = DB::table('user_subscriptions')->where(['stripe_id'=>$st_customer->customer,'stripe_plan_id'=>$st_customer->plan->id,'stripe_subscription_id'=>$st_customer->id])->insert($data);
                  // // }
                }else{
                  echo $st_customer->customer.'<br><br>';
                }
              }
              // echo $user_subscriptions_update; die;
            }
          }
        }catch(\Exception $e) {
          continue;
        }
      }
      die;
    }

    public function saveMissingSubscriptions()
    {
      $str_user_id = '';
      $int_user_id = 0;
      
      // $this->setApiKeys();
      Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
      
      try {
        
        DB::beginTransaction();
      
        $sessions_list = \Stripe\Checkout\Session::all(['limit' => 2]);
        
        $int_stripe_subscription_status = 0;
            $int_stripe_payment_status = 0;	
        
        echo '<pre>'; print_r(@$sessions_list); die;

        foreach(@$sessions_list['data'] as $sessions_list_row)
        {
          //echo @$sessions_list_row->id;
            if(!empty(@$sessions_list_row->id))
            {	  
          
              $int_user_id = 0;
              
              $str_session_id = @$sessions_list_row->id;
              
              if(!empty(@$sessions_list_row->metadata[0]))
              {
                $str_user_id = @$sessions_list_row->metadata[0];
            
                $int_user_id = base64_decode($str_user_id);
              }
              
                    
              $str_subscription_id_new = @$sessions_list_row->subscription;		  
              $str_user_stripe_id = @$sessions_list_row->customer;
              echo $str_subscription_id_new;
              if(!empty($str_subscription_id_new) && strpos($str_subscription_id_new, 'ub_')>0)
              {
                    echo ' - '.$str_subscription_id_new;
                  // echo "<pre>sessions_list_row $str_subscription_id_new - "; print_r(@$sessions_list_row); die;
                  $stripe_subscription = Subscription::retrieve($str_subscription_id_new);
                  
                  $str_stripe_subscription_id = @$stripe_subscription->id;
                  $str_stripe_customer_id = @$stripe_subscription->customer;
                  $str_stripe_created_date = date('Y-m-d H:i:s', @$stripe_subscription->created);
                  $str_stripe_plan_id = @$stripe_subscription->items['data'][0]->plan->id;
                  $str_discount_code = @$stripe_subscription->discount['coupon']->id;
                  $stripe_subscription_current_period_end = date('Y-m-d H:i:s', @$stripe_subscription->current_period_end);
                  $stripe_subscription_current_period_start = date('Y-m-d H:i:s', @$stripe_subscription->current_period_start);
                  $str_stripe_subscription_status = @$stripe_subscription->status;
                  
                  if($str_stripe_subscription_status == 'active')
                  {
                    $int_stripe_subscription_status = 1;
                    $int_stripe_payment_status = 2;
                  }
                  
                    $coupon_data = CouponCode::where([
                  'stripe_coupon_id' => @$str_discount_code
                  ])
                  ->orderBy('id', 'desc')
                  ->first();
                  
                  if(empty($coupon_data->id))
                  {
                    $coupon_data = CouponCode::where([
                    'stripe_coupon_id_live' => @$str_discount_code
                    ])
                    ->orderBy('id', 'desc')
                    ->first();
                  }
                  
                  if(!empty(@$coupon_data->id))
                  {
                  $int_coupon_code_id = @$coupon_data->id;
                  }
                  else
                  {
                  $int_coupon_code_id = 0;	
                  }					
                  
                  $plan_data = Plan::where([
                  'stripe_plan_id' => @$str_stripe_plan_id
                  ])
                  ->orderBy('id', 'desc')
                  ->first();
                  
                  if(empty($plan_data->id))
                  {
                      $plan_data = Plan::where([
                    'stripe_plan_id_live' => @$str_stripe_plan_id
                    ])
                    ->orderBy('id', 'desc')
                    ->first();
                    
                  }				
                
                  $obj_subscription_data = UserSubscription::where([
                  'stripe_subscription_id' => @$str_stripe_subscription_id
                  ])
                  ->orderBy('id', 'desc')
                  ->first();
                
                  if(empty($obj_subscription_data->id))
                  {
                      if(!empty($str_stripe_customer_id))
                      {						
                        $str_payment_method_obj =	 PaymentMethod::all([
                          'customer' => $str_stripe_customer_id,
                          'type' =>'card',
                          'limit' => 1
                        ]);

                        // attach a payment method to customer	
                        if(!empty($str_payment_method_obj->data[0]->id))
                        {
                          $str_payment_method_obj_data_id = @$str_payment_method_obj->data[0]->id;
                          
                          $obj_customers_update = Customer::update(
                            $str_stripe_customer_id,				   
                            ['invoice_settings' => ['default_payment_method' => $str_payment_method_obj_data_id]]
                            );
                        }
                      
                      }
                      
                                  
                          $subscription_obj = new UserSubscription();
                        
                        if(!empty(@$int_user_id))
                        {
                          $subscription_obj->user_id = @$int_user_id;
                        }
                        
                        $subscription_obj->plan_id	 = @$plan_data->id;
                        $subscription_obj->stripe_id	= @$str_stripe_customer_id;
                        $subscription_obj->stripe_plan_id = @$str_stripe_plan_id;
                        $subscription_obj->price	 = @$plan_data->price;
                        $subscription_obj->coupon_code_id = @$int_coupon_code_id;
                        $subscription_obj->validity = @$plan_data->validity;						 
                        $subscription_obj->ends_at = @$stripe_subscription_current_period_end;
                        $subscription_obj->stripe_subscription_id = @$str_stripe_subscription_id;
                        $subscription_obj->payment_status = @$int_stripe_payment_status;
                        $subscription_obj->status = @$int_stripe_subscription_status;
                        $subscription_obj->created_at = @$stripe_subscription_current_period_start;
                        //  $subscription_obj->save();

                        echo "<pre>subscription_obj - ".@$int_user_id; print_r($subscription_obj);
                      
                        if(!empty(@$int_user_id))
                        {							 
                          $user_obj = User::find(@$int_user_id);
                          $user_obj->stripe_id = $str_stripe_customer_id;
                          //  $user_obj->save();
                        }
                        
                        echo 'Data Saved1';
                
                  }/**/
                  else{
                    echo 'esle - ';
                  }				  
                
                }
              else
              {
                //continue;
              }
          
            }	
          
          
          }		
        
        DB::commit();
        
          
      } catch (\Exception $e) {
              DB::rollback();
              return errorMessage($e->getMessage(), true);
              
      }
      
    }

    public function getstripeCustomersTest()
    {

      
      DB::enableQueryLog();
      $cron = new UserSubscriptionCronController();
      // $cron->checkInvoice(); die;
      // $cron->changeInvoicesStatus(); die;
      // $cron->sendRemainderSameDay(); die;
      // $cron->sendRemainderBeforeThreeDay(); die;
      // $cron->sendRemainderBeforeSevenDay(); die;
      // $cron->sendRemainderAfterThreeDay(); die;
      // $cron->sendRemainderAfterSevenDay(); die;
      $cron->saveMissingSubscriptions(); die;
      // $cron->deleteStripeCustomer(); die;
      
      //     $st_customers = $stripe->customers->all(['limit' => 100]);
      //     // echo '<pre>st_customers - '; print_r($st_customers->toArray()); die;
      //     // foreach($st_customers as $st_customer){
      //     //     $st_cust_delete = $stripe->customers->delete($st_customer->id,[]);
      //     // }
      //     // die;
          
      //   $i_cnt = 1;
      //   while($st_customers->has_more) {
      //       if($i_cnt == 9){
      //           break;
      //       }
      //     $st_customers = $stripe->customers->all([
      //     'limit' => 100,'starting_after' => $st_customers->data[count ($st_customers->data) - 1]->id
      //     ]);
      //     foreach ($st_customers as $customer) {
      //       $customer_details[][$customer->id] = $customer->email;
      //     }
      //       $i_cnt++;
      //       echo $i_cnt.'<br>';
      //     // echo '<pre>stripe - '; print_r($st_customers);
      //   }
      // //   $unique_cst_arr = array_unique($customer_details);
      //   echo $i_cnt.'<br>';
      //   echo "<br># of customer_details: " .count($customer_details); //die;
      //   echo '<pre>$customer_details - '; print_r($customer_details); die;
      // //   $i = 0;
      // //   foreach($customer_details as $k => $customer_eml){
      // //     $st_cust_delete = $stripe->customers->delete($k,[]);
      // //     $i++;
      // //   }
      //   echo $i;
      //   die;
      
      $user_arr = array(        
        '2591','2570','2569','2568','2567','2566','2559','2549','2546','2543','2540','2539','2536','2534','2532','2531','2527','2526','2517','2516','2515','2514','2505','2500','2491','2479','2476','2475','2470','2461','2456','2455','2451','2445','2437','2436','2432','2428','2424','2420','2419','2412','2411','2403','2391','2373','2363','2360','2344','2338','2337','2336','2335','2334','2332','2331','2329','2319','2318','2317','2312','2311','2306','2304','2296','2290','2281','2274','2271','2270','2269','2265','2264','2262','2261','2258','2250','2242','2239','2238','2223','2220','2215','2213','2212','2211','2209','2208','2197','2187','2180','2172','2165','2161','2159','2155','2148','2139','2138','2137','2133','2132','2123','2113','2095','2094','2089','2088','2057','2045','2043','2042','2041','2040','2039','2038','2037','2036','2028','2023','2022','2018','2015','2006','1993','1985','1945','1943','1942','1939','1935','1933','1929','1923','1914','1912','1907','1905','1897','1884','1878','1859','1851','1847','1843','1842','1839','1835','1824','1819','1814','1807','1806','1805','1804','1783','1770','1769','1768','1767','1766','1765','1764','1762','1761','1751','1748','1747','1746','1743','1741','1740','1739','1737','1736','1735','1734','1732','1730','1729','1726','1725','1724','1723','1720','1719','1718','1715','1713','1712','1711','1708','1707','1706','1705','1704','1703','1702','1701','1700','1698','1697','1696','1695','1694','1693','1692','1689','1688','1687','1685','1680','1676','1675','1673','1672','1637','1632','1621','1618','1617','1610','1605','1594','1592','1591','1590','1589','1588','1587','1586','1585','1584','1583','1582','1581','1580','1579','1577','1576','1575','1573','1572','1569','1568','1567','1566','1565','1564','1563','1562','1560','1559','1558','1557','1556','1555','1554','1553','1552','1551','1550','1549','1548','1545','1543','1542','1540','1539','1538','1537','1536','1534','1533','1532','1531','1530','1529','1528','1527','1525','1524','1523','1522','1521','1520','1519','1518','1516','1515','1514','1512','1511','1510','1509','1508','1506','1505','1504','1503','1501','1500','1499','1498','1497','1496','1495','1494','1493','1492','1490','1489','1488','1487','1486','1484','1483','1482','1480','1479','1477','1473','1472','1471','1469','1468','1467','1466','1465','1464','1463','1462','1460','1459','1458','1457','1456','1455','1453','1452','1451','1450','1449','1448','1447','1446','1445','1444','1441','1440','1439','1438','1437','1436','1435','1434','1433','1430','1429','1427','1426','1425','1424','1419','1418','1417','1416','1415','1412','1411','1410','1409','1408','1404','1403','1402','1401','1399','1398','1397','1396','1395','1394','1389','1388','1386','1385','1384','1382','1380','1377','1376','1375','1374','1373','1372','1371','1370','1369','1368','1367','1366','1365','1364','1363','1362','1361','1357','1356','1354','1352','1351','1350','1349','1348','1347','1346','1345','1344','1343','1342','1341','1340','1339','1338','1336','1335','1334','1333','1332','1331','1330','1329','1328','1327','1326','1325','1324','1323','1322','1321','1320','1319','1318','1317','1316','1315','1314','1313','1312','1308','1307','1306','1305','1304','1303','1302','1301','1300','1299','1298','1297','1295','1294','1293','1292','1291','1290','1289','1288','1287','1286','1285','1284','1283','1282','1281','1280','1279','1278','1276','1275','1274','1273','1272','1271','1270','1269','1268','1267','1265','1264','1263','1262','1261','1260','1259','1258','1257','1256','1253','1252','1251','1250','1249','1248','1229','1228','1227','1226','1225','1224','1223','1217','1216','1215','1213','1210','1209','1208','1207','1206','1204','1202','1201','1199','1198','1189','1185','1177','921','920','919','918','917','916','915','914','913','912','911','910','909','908','907','906','905','904','903','902','900','899','898','897','896','895','892','891','890','889','888','887','886','885','884','883','882','881','880','879','878','877','876','875','874','873','871','869','867','866','865','864','863','862','860','859','858','857','856','855','854','853','852','851','850','849','848','846','845','844','843','842','841','840','839','838','837','836','820','819','818','817','816','811','808','788','786','785','784','783','782','781','780','779','778','776','774','773','772','771','770','768','767','766','765','764','763','762','761','760','759','758','757','756','755','754','753','752','750','749','748','747','746','745','744','743','742','741','740','738','737','736','735','733','732','730','729','728','727','726','725','724','723','722','721','720','719','718','717','716','715','714','713','712','711','710','709','708','707','706','704','703','702','701','700','699','698','697','696','694','693','692','691','690','689','688','687','686','685','684','683','682','680','679','678','677','676','675','674','673','672','671','670','669','668','667','666','665','664','663','662','661','660','659','658','657','656','654','653','652','651','650','649','648','647','646','645','644','643','642','641','640','639','638','637','635','634','633','632','631','630','629','628','627','626','625','624','623','622','621','620','619','618','617','616','615','614','613','612','611','609','608','607','605','604','603','602','601','600','599','598','597','596','595','594','593','592','591','590','589','588','587','586','585','178','176','174','162','157','156','155','152','151','142','141','136','135','134','129','120','69','65','64','63','61','41','39','33','31','30','27','26','22','19','18','16'
      );

      // echo '<pre>user_arr - '; print_r($user_arr); //die;

      // $subscription_list_datas = UserSubscription::select('user_subscriptions.*','users.first_name','users.last_name','users.email as userEmail','users.role as userRole')->leftJoin('users','users.id','=','user_subscriptions.user_id')->whereNotNull('user_subscriptions.user_id')->where('user_subscriptions.plan_id','!=','1')->whereNotNull('user_subscriptions.plan_id')->whereNotNull('users.email')->whereNotNull('user_subscriptions.stripe_id')->whereNotNull('user_subscriptions.stripe_subscription_id')->where('user_subscriptions.payment_status','4')->whereDate('user_subscriptions.created_at','!=',date('Y-m-d'))->get();

      $subscription_list_datas = DB::table('user_subscriptions_live')->select('user_subscriptions_live.id','user_subscriptions_live.user_id','user_subscriptions_live.created_at','user_subscriptions_live.ends_at','user_subscriptions_live.plan_id','user_subscriptions_live.stripe_id','user_subscriptions_live.stripe_subscription_id','user_subscriptions_live.email','user_subscriptions_live.stripe_payment_id','user_subscriptions_live.name','user_subscriptions_live.stripe_payment_id')->leftJoin('users','users.id','=','user_subscriptions_live.user_id')->whereIn('user_subscriptions_live.user_id',$user_arr)->orderBy('user_subscriptions_live.user_id','DESC')->get();
      echo dd(DB::getQueryLog()); die;
      
      echo count($subscription_list_datas).'<br>';
      echo '<pre>subscription_list_datas - '; print_r($subscription_list_datas->toArray()); die;
      $i = 0;
      $user_arr = $same_user_arr = array();
      
      foreach($subscription_list_datas as $subscription_list_data){
        if(!in_array($subscription_list_data->user_id,$user_arr)){
          $user_arr[] = $subscription_list_data->user_id;
        }else{
          $same_user_arr[$subscription_list_data->user_id] = $subscription_list_data->user_id;
        }
        $i++;
      }
      echo '<pre>'; print_r($same_user_arr);
      echo "i - $i - user_arr - ".count($user_arr).'same_user_arr - '.count($same_user_arr); 
      
      die;

      foreach($subscription_list_datas as $subscription_list_data){
        
        $subscription_list_data_email = explode(' ',$subscription_list_data->email);
        $subscription_list_data_email = $subscription_list_data->email;
        $is_live_url_mode =  UtilitiesTwo::chkLiveCurrentUrl();
          
          
          
          if(!empty($is_live_url_mode)){
            $planId = Plan::where('id',$subscription_list_data->plan_id)->first();
            $stripe_plan_id = $planId->stripe_plan_id_live;
          }else{
            $planId = Plan::where('id',$subscription_list_data->plan_id)->first();
            $stripe_plan_id = $planId->stripe_plan_id;
          }

        
        if(!empty($planId->id)){

          if(!empty($subscription_list_data->coupon_code_id)){
            $coupon = CouponCode::where('id',$subscription_list_data->coupon_code_id)->first();
          }else{
            $coupon = CouponCode::where('coupon_code','POPMARY')->first();
          }

          $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));

          // if(!empty($coupon->id)){
          //   if(!empty($is_live_url_mode)){
          //     $coupon_code =	$coupon->stripe_coupon_id_live;
          //   }else{
          //     $coupon_code =	$coupon->stripe_coupon_id;
          //   }
    
          //   
          //   $st_coupon_code = $stripe->coupons->retrieve($coupon_code, []);

          //   $st_coupon_code_id = $st_coupon_code->id;
          //   $coupon_id = $coupon->id;
          // }else{
          //   $st_coupon_code_id = '';
          //   $coupon_id = '';
          // }
          
          if(date('Y-m-d',strtotime($subscription_list_data->ends_at)) > date('Y-m-d')){
            // $billingDate = Carbon::parse(date('Y-m-d h:i:s'))->addDay($planId->validity);
            // $billing_date = strtotime('now');
            
            $billingDate = $subscription_list_data->ends_at;
            $billing_date = strtotime($subscription_list_data->ends_at);
          }else{
            $billingDate = Carbon::parse($subscription_list_data->ends_at)->addDay($planId->validity);
            $billing_date = strtotime($billingDate);
          }
          
          echo "<br>$subscription_list_data->ends_at -> $billing_date => $billingDate"; //die;

        //   $st_cus_create = $stripe->customers->create(['email'=>$subscription_list_data_email,'name'=>$subscription_list_data->first_name.' '.$subscription_list_data->last_name,'metadata' => ['coupon_applied'=>'yes','coupon_code'=>'34K4Ha0E']]);
        //   $st_cus_create_id = $st_cus_create->id;
        // //   $st_cus_create_id = 'cus_L6hMENkQ6zEqvz';
          $st_cus_create_id = $subscription_list_data->stripe_id;
  
          $st_get_subscriptions = $stripe->subscriptions->create([
            'customer' => $st_cus_create_id,
            'items' => [
              // ['price' => $stripe_plan_id],
              ['price' => $subscription_list_data->stripe_plan_id],
            ],
            'coupon' => '34K4Ha0E',
            'collection_method' => 'send_invoice',
            'days_until_due' => '0',
            'billing_cycle_anchor' => $billing_date,
          ]);
          $subs_id = $st_get_subscriptions->id; 
          // echo "<br>$subs_id";die;
            //  $subs_id = 'sub_1KQZkQBgD4GNlNtNguacs4jw';

        $st_cancel_subs = $stripe->subscriptions->cancel($subscription_list_data->stripe_subscription_id,[]);
        // $st_void_invoice = $stripe->invoices->voidInvoice($st_cancel_subs->latest_invoice,[]);
          
        //   $up_data = array();
        //   $up_data = UserSubscription::Create([
        //     'user_id' => $subscription_list_data->user_id,
        //     'update_status' => 3,
        //     'plan_id' => $subscription_list_data->plan_id,
        //     'stripe_payment_id' => $subscription_list_data->stripe_payment_id,
        //     'stripe_id' => $st_cus_create_id,
        //     'stripe_plan_id' => $stripe_plan_id,
        //     'price' => $subscription_list_data->price,
        //     'coupon_code_id' => $coupon_id,
        //     'validity' => $subscription_list_data->validity,
        //     'ends_at' => $billingDate,
        //     'stripe_subscription_id' => $subs_id,
        //     'payment_status' => 4, // 2,
        //     'created_at' => date('Y-m-d h:i:s'),
        //     'updated_at' => date('Y-m-d h:i:s'),
        //   ]);
          
        // //   $up_data = array(
        // //     'user_id' => $subscription_list_data->user_id,
        //     // 'update_status' => 3,
        // //     'plan_id' => $subscription_list_data->plan_id,
        // //     'stripe_payment_id' => $subscription_list_data->stripe_payment_id,
        // //     'stripe_id' => $st_cus_create_id,
        // //     'stripe_plan_id' => $stripe_plan_id,
        // //     'price' => $subscription_list_data->price,
        // //     'coupon_code_id' => $coupon_id,
        // //     'validity' => $subscription_list_data->validity,
        // //     'ends_at' => $billingDate,
        // //     'stripe_subscription_id' => $subs_id,
        // //     'payment_status' => 4, // 2,
        // //     'created_at' => date('Y-m-d h:i:s'),
        // //     'updated_at' => date('Y-m-d h:i:s'),
        // //   );

          
        //   UserSubscription::where('id',$subscription_list_data->id)->update(['stripe_id'=> $st_cus_create_id,'plan_id' => $subscription_list_data->plan_id,'price' => $subscription_list_data->price,'stripe_subscription_id'=>$subs_id,'stripe_plan_id'=>$stripe_plan_id,'update_status'=>'3']);

          UserSubscription::where(['update_status' => '3','stripe_id'=> $st_cus_create_id,'stripe_subscription_id' => $subscription_list_data->stripe_subscription_id])->update(['stripe_subscription_id'=>$subs_id,'ends_at'=>$billingDate]);
          
        //   User::where('id',$subscription_list_data->user_id)->update(['stripe_id'=> $st_cus_create_id]);
          
        //  echo '<pre>up_data - '; print_r($up_data->toArray());  die;
          die;
          $i++;
          //sleep(1);
        }else{
          echo '<pre>subscription_list_datas - '; print_r($subscription_list_data->toArray()); //die;
          $i++;
        }
      }
      echo $i;
      die;
      
      // $this->saveMissingSubscriptions(); die;

      $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
      // $st_customers = $stripe->subscriptions->all(['customer'=>'cus_L2cE4YO39Ux3SU','limit' => 10]);
      // $st_customers = $stripe->invoices->all(['customer'=>'cus_L2chvnSf0xmdQ8','limit' => 5]);
      // $st_customers = $stripe->coupons->retrieve("THlbucTv", []);
      echo '<pre>Live st_customers - '; print_r($st_customers); die;
      
      $ends_at = date('Y-m-d',strtotime('-1 day'));  
      $subscription_list_data = UserSubscription::select('user_subscriptions.*','users.first_name','users.last_name','users.email','users.role as userRole','plans.name as plan_name')->join('users','users.id','=','user_subscriptions.user_id')->join('plans','plans.id','=','user_subscriptions.plan_id')->whereDate('ends_at',$ends_at)->where('reminder_mail',0)->get()->toArray();
      $moduleController = new ModuleController();
      $data= array();
      if(isset($subscription_list_data) && !empty($subscription_list_data)) {
          foreach($subscription_list_data as $row) {
            $data= array();
              $data['name'] = $row['first_name'] .' '. $row['last_name'];
              $data['plan_name'] = $row['plan_name'];
              $data['end_date'] = $row['ends_at'];
              $data['price'] = $row['price'];
              $data['role_id'] = $row['userRole'];

              if(!empty($row['stripe_subscription_id'])){
                $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
                $st_get_subscriptions = $stripe->subscriptions->retrieve($row['stripe_subscription_id'],[]);
                // $st_finalize_invoice = $stripe->invoices->sendInvoice($st_get_subscriptions->latest_invoice,[]);
                $st_finalize_invoice = $stripe->invoices->retrieve($st_get_subscriptions->latest_invoice,[]);
                // $data['invoice_url'] = $st_finalize_invoice->invoice_pdf;
                $data['invoice_url'] = $st_finalize_invoice->hosted_invoice_url;
  
                $view = $moduleController->send_mail_by_phpmailer($row['email'], 'Your POP Account Expired'. $data['name']  .' PeopleofPlay.com', 'mail.invoice.manual_payment', $data);
                // $view = $moduleController->send_mail_by_phpmailer($row['email'], 'Your POP Account Auto Renewal Warning '. $data['name']  .' PeopleofPlay.com', 'mail.invoice.reminder_mail_three_day', $data);
                // UserSubscription::where('id',$row['id'])->update(['reminder_mail'=>1]);
                echo $view.'<br><br>';
                // echo '<pre>st_finalize_invoice - '; print_r($st_finalize_invoice);
              }
          }
      }
      
      die;
      // $stripe = new \Stripe\StripeClient('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');
      // $st_customers = $stripe->paymentIntents->all(['customer'=>'cus_IaXrYv3LYeqKmM','limit' => 1]);
      // $st_customers = $stripe->subscriptions->all(['customer'=>'cus_IaXrYv3LYeqKmM','limit' => 10]);
      $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
      // $st_customers = $stripe->subscriptions->all(['customer'=>'cus_L1lQ1rrN2WoHx6','limit' => 10]);
      // $st_customers = $stripe->subscriptions->retrieve('sub_1KLjB4BgD4GNlNtNdqvDb9SS',[]);
      // $st_customers = $stripe->paymentIntents->all(['customer'=>'cus_L0n2wJuLSzloBI','limit' => 10]);
      // $st_customers = $stripe->customers->retrieve('cus_L1lQ1rrN2WoHx6',[]);
      // $st_customers = $stripe->coupons->all(['limit' => 20]);
      // $st_customers = $stripe->promotionCodes->all(['limit' => 3]);
      // $st_customers = $stripe->promotionCodes->retrieve('promo_1KLReFBgD4GNlNtNi5ypjrCG',[]);
      // $st_customers = $stripe->coupons->retrieve('P0QHdbz2', []);
      // $st_customers = $stripe->invoices->all(['customer'=>'cus_L1lQ1rrN2WoHx6','limit' => 3]);
      $st_customers = $stripe->invoices->retrieve('in_1KMW8bBgD4GNlNtN0YcHfGPc',[]);
      // $stripe->invoices->finalizeInvoice($st_customers->data[0]->id,[]);
      // $st_customers = $stripe->invoices->sendInvoice($st_customers->data[0]->id, []);
      
      // foreach($st_customers as $st_customer){
      //   echo '<pre>Live st_customers - '; print_r($st_customer);
      // }
      // die;
      echo '<pre>Live st_customers - '; print_r($st_customers); die;
        $this->getUserSubscriptionCron(); die;

      // \Stripe\Stripe::setApiKey(\App\Models\SiteSetting::get_keys(1));
      // $st_customers = \Stripe\PaymentIntent::all(['customer'=>'cus_Kzy5FfT8ec9ZS1','limit' => 10]);
      $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
      $st_customers = $stripe->subscriptions->all(['customer'=>'cus_Kzy5FfT8ec9ZS1','limit' => 10]);
      // $st_customers = $stripe->checkout->sessions->retrieve(
      //   'cs_test_a143138Eni4zChVPimBlT7JZH36lvd1nUI70PceIazlpAek5SskPb8UGQD',[]
      // );
      // $st_customers = $stripe->checkout->sessions->all(['payment_intent'=>'pi_3KJyK8BgD4GNlNtN1WHKUB5q','subscription'=>'sub_1KJy9kBgD4GNlNtNsm0vWQFF','limit' => 10]);
      // echo '<pre>st_customers - '; print_r($st_customers); die;

      // $stripe = new \Stripe\StripeClient('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');
      // // $st_customers = $stripe->customers->all(['limit' => 100]);
      // // $st_customers = $stripe->paymentIntents->all(['limit' => 10]);
      // // $st_customers = $stripe->customers->retrieve('cus_IaXrYv3LYeqKmM',[]);
      // $st_customers = $stripe->subscriptions->all(['customer'=>'cus_IaXrYv3LYeqKmM','limit' => 10]);
      // // $st_customers = $stripe->paymentIntents->all(['customer'=>'cus_IaXrYv3LYeqKmM','limit' => 10]);
      // // $st_customers = $stripe->paymentIntents->retrieve('pi_3K7hgDBgD4GNlNtN1qaF2HqP',[]);
      // // $st_customers = $stripe->customers->allBalanceTransactions('cus_IaXrYv3LYeqKmM',['limit' => 10]);
      
      // echo '<pre>Live st_customers - '; print_r($st_customers); die;

      foreach($st_customers as $st_customer){
        // echo '<pre>Live st_customer - '; print_r($st_customer); die;
        if($st_customer->livemode == 1){
          $plans = DB::table('plans')->where('stripe_plan_id_live',$st_customer->plan->id)->first();        
        }else{
          $plans = DB::table('plans')->where('stripe_plan_id',$st_customer->plan->id)->first();        
        }
        $st_paymentIntents = $stripe->paymentIntents->all(['customer'=>$st_customer->customer,'limit' => 10]);
        

        // echo '<pre>Live st_paymentIntents - '; print_r($st_paymentIntents); die;
        foreach($st_paymentIntents as $st_paymentIntent){
          // echo '<pre>Live st_paymentIntent - '; print_r($st_paymentIntent);
          $EndDate    = date('Y-m-d H:i:s',$st_paymentIntent->created);
          $NewEndDate = date('Y-m-d H:i:s', strtotime($EndDate . " +1 year"));

          $data['user_id'] = '';
          $data['plan_id'] = $plans->id;
          $data['stripe_payment_id'] = $st_paymentIntent->id;
          $data['stripe_id'] = $st_customer->customer;
          $data['stripe_plan_id'] = $st_customer->plan->id;
          $data['price'] = $plans->price;
          $data['validity'] = $plans->validity;
          $data['stripe_subscription_id'] = $st_customer->id;        
          $data['ends_at'] = $NewEndDate;
          if($st_paymentIntent->charges->data[0]->status == 'succeeded'){
            $data['payment_status'] = 2;
          }elseif($st_paymentIntent->status == 'failed'){
            $data['payment_status'] = 1;
          }else{
            $data['payment_status'] = 3;
          }

          $user_subscriptions_update = DB::table('user_subscriptions')->where(['stripe_id'=>$st_customer->customer,'stripe_plan_id'=>$st_customer->plan->id,'stripe_subscription_id'=>$st_customer->id])->update(['stripe_payment_id'=>$st_paymentIntent->id]);

          // if($user_subscriptions_update == 0){
          //   $user_subscriptions_update = DB::table('user_subscriptions')->where(['stripe_id'=>$st_customer->customer,'stripe_plan_id'=>$st_customer->plan->id,'stripe_subscription_id'=>$st_customer->id])->insert($data);
          // }
          echo $user_subscriptions_update; die;
        }

      }
      die;

      // --------------------------------------------------------------------- //
      $pop_user = DB::table('users')->get(['id','first_name','last_name','email']);

      $no_user = $yes_user = array();
      foreach($pop_user as $k => $pop_users){
        if(!DB::table('pop_to_stripe')->where(['user_id'=>$pop_users->id])->first()){
          $no_user[$k]['id'] = $pop_users->id;
          $no_user[$k]['email'] = $pop_users->email;
        }else{
          $yes_user[$k]['id'] = $pop_users->id;
          $yes_user[$k]['email'] = $pop_users->email;
        }
      }
      echo '<pre>no_user - '; print_r($no_user); //die;
      echo '<pre>yes_user - '; print_r($yes_user); die;
      echo '<pre>pop_users - '; print_r($pop_user->toArray()); die;
      // --------------------------------------------------------------------- //

      $cnt = 1;
      for($i=0; $i<5000; $i++){
        $stripe_test_datas = DB::table('stripe_data')->where('cus_id','!=','')->where('status',0)->first();
       
        echo '<pre>stripe_test_datas - '; print_r($stripe_test_datas); die;
        if(!empty($stripe_test_datas->cus_id)){
          $stripe = new \Stripe\StripeClient('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');
          $st_cust_delete = $stripe->customers->delete(
            $stripe_test_datas->cus_id,
            []
          );

          DB::table('stripe_data')->where(['id'=>$stripe_test_datas->id,'cus_id'=>$stripe_test_datas->cus_id])->update(['status'=>1]);
          
          $cnt++;
        }
        
      }
      echo "finish $cnt - ";die;
      
      // --------------------------------------------------------------------- //



      $customer_ids = []; 
      $customer_emails = [];
      $customer_details = [];

      $pop_users = DB::table('users')->get(['id','email']);
      // $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
      $cnt = 1;
      for($i=0; $i<300; $i++){
        $stripe_test_datas = DB::table('stripe_test_data')->orderBy('id','DESC')->first();
        $stripe = new \Stripe\StripeClient('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');
        if(!empty($stripe_test_datas->cus_id)){
          $st_customers = $stripe->customers->all(['limit' => 100,'starting_after' =>$stripe_test_datas->cus_id]);
        }else{
          $st_customers = $stripe->customers->all(['limit' => 100]);
        }

        // echo '<pre>stripe_test_datas - '; print_r($stripe_test_datas); die;
        
        foreach($st_customers as $customer) {
          if(!DB::table('stripe_test_data')->where(['cus_id'=>$customer->id])->first()){
            DB::table('stripe_test_data')->insert(['cus_id'=>$customer->id,'email'=>$customer->email]);
          }
        }
        $cnt++;
      }
      echo "<pre>stripe - $cnt - "; print_r($st_customers); die;
      // --------------------------------------------------------------------- //


      $i_cnt = 1;
      while($st_customers->has_more) {
          if($i_cnt == 500){
              break;
          }
        $st_customers = $stripe->customers->all([
        'limit' => 100,'starting_after' => $st_customers->data[count ($st_customers->data) - 1]->id
        ]);
        foreach ($st_customers as $customer) {
          array_push($customer_ids, $customer->id);
          array_push($customer_emails, $customer->email);
          // $data_2 = [$customer->id => $customer->email];
          $customer_details[$customer->id] = $customer->email;
        }
          $i_cnt++;
        // echo '<pre>stripe - '; print_r($st_customers);
      }

      echo "POP customers: $i_cnt - " .count($pop_users); //die;
      echo "<br># of customers: " .count($customer_emails); //die;
      echo "<br># of customer_details: " .count($customer_details); die;
      // echo '<pre>customer_details - '.count(array_unique($customer_details)); print_r(array_unique($customer_details)); die;

      // $unique_cst_arr = array_unique($customer_emails);
      $unique_cst_arr = array_unique($customer_details);

      $i = 1;
      foreach($unique_cst_arr as $k => $customer_eml){
        // $cst_eml[] = $customer_eml;
        $is_users = DB::table('users')->where('email',$customer_eml)->first(['first_name','last_name','email']);

        if(!empty($is_users->email)){
          $is_usr['yes_'.$k.'_'.$i] = $is_users->email;
          $i++;
        }else{
          $no_user[$k.'_'.$i] = $customer_eml;
          $i++;
          // unset($unique_cst_arr[$k]);
          // $stripe = new \Stripe\StripeClient(\App\Models\SiteSetting::get_keys(1));
          // $st_cust_delete = $stripe->customers->delete(
          //   $k,
          //   []
          // );
        }
      }
      echo "<pre>unique_cst_arr ".count($unique_cst_arr).' - '; print_r($unique_cst_arr); //die;
      echo '<pre>is_usr '.count($is_usr).' - '; print_r($is_usr); //die;
      echo '<pre>no_user '.count($no_user).' - '; print_r($no_user); die;
    } 
   
    /************************ || Shubham Stripe Test Code End ||  ************************/


    public function memeScheduleData()
    {
      $current_date = date('Y-m-d');
     Meme::where('schedule_date','<',$current_date)->where('is_schedule',1)->delete();
     Meme::where('date','<',$current_date)->update(['is_current'=>0,'status'=>0]);

     $mem_id=0;
      $current_memeData = Meme::where('date',$current_date)->where('is_current',1)->where('status',1)->first();
      if($current_memeData) {
        $mem_id =$current_memeData->id;
        Meme::where('id',$mem_id)->update(['date'=>$current_date,'is_current'=>1,'status'=>1,'is_seen'=>1]);
      }else{

        $schedule_memeData = Meme::where('schedule_date',$current_date)->where('is_schedule',1)->first();
      if($schedule_memeData) {
          $mem_id =$schedule_memeData->id;
         
          Meme::where('id',$mem_id)->update(['date'=>$current_date,'is_current'=>1,'status'=>1,'is_seen'=>1]);
      }else{
             $memeData = Meme::where('status',0)->where('is_current',0)->where('is_schedule',0)->where('is_seen',0)->orderBy('id','asc')->first();
             if($memeData) {
                 $mem_id =$memeData->id;
                 Meme::where('id',$mem_id)->update(['date'=>$current_date,'is_current'=>1,'status'=>1,'is_seen'=>1]);
             } else {
               $resetMemeData = Meme::orderBy('id','asc')->first();

               $mem_id =@$resetMemeData->id;
               Meme::where('date','<',$current_date)->where('is_schedule',0)->update(['date'=>'','is_current'=>0,'status'=>0,'is_seen'=>0]);
               Meme::where('id',@$mem_id)->update(['date'=>$current_date,'is_current'=>1,'status'=>1,'is_seen'=>1]);
             }
      }
    }
    }

public function getAdsNoOfClicks($advertisement_id)
{
  $is_updated = Advertisement::find($advertisement_id)->increment('no_of_clicks');

  if(!empty($is_updated))
  {
    $advertisement_data =  Advertisement::find($advertisement_id);
    $advertisement_destination_link = $advertisement_data->destination_link;

    if(empty($advertisement_destination_link))
    {
     $advertisement_destination_link = "#";
   }			  

   return redirect($advertisement_destination_link);   
 }	
}

public function getPubPage()
{
  $pub = Pub::find(1);
  $pub_heading = PubHeading::find(1);
  $pub_meeting_rooms = PubMeetingRooms::where(['type'=>0,'status'=>1])->get();
  $pub_featured_rooms = PubMeetingRooms::where(['type'=>1,'status'=>1])->first();

  return view('front.pages.pub', compact('pub','pub_heading','pub_meeting_rooms','pub_featured_rooms'));
}

public function getHomePageAwardModal(Request $request)
{
 $data = HomePageAward::where('id',$request->id)->first();
 $view = View('front.pages.home_page_award_modal',compact('data'))->render();
 $res = array('success'=>1,'view'=>$view);
 echo json_encode($res);
}

public function toyGameInnovationAwards()
{
  $home_page_award_types = DB::table('home_page_award_type')
  ->join('home_page_award_list','home_page_award_list.type','=','home_page_award_type.id')
  ->select('home_page_award_type.*')
  ->where('home_page_award_type.status',1)
  ->groupBy('id')
  ->get();
  $new_Arr = array();
  foreach ($home_page_award_types as $key => $row_award) {
   $home_page_award_types[$key]->home_page_award = HomePageAward::where(['status'=>1,'type'=>$row_award->id])->get();
 }

 return view('front.pages.innovation_awards',compact('home_page_award_types')) ;     
}


public function getOfficeHour()
{
  $data = OfficeHour::where('status',1)->get();
  return view('front.pages.office-hour', compact('data'));
}





public function youtubeGalleryHomePage(Request $request)
{
  $type = $request->type;
  if($type =='right') {

    $data = HomePageDetail::where(['home_page_id'=>6,'type'=>0])->where('right_video_link','!=','NULL')->get();
  } else {
   $data = HomePageDetail::where(['home_page_id'=>6,'type'=>0])->where('video_link','!=','NULL')->get();
 }
 $select_id = $request->id; 

 $view = view('front.pages.youtube-gallery-home-page',compact('data','select_id','type'))->render();
 return Response::json(['view' => $view]);
}

  public function shareWikiToFeed(Request $request){
    // echo '<pre>request - '; print_r($request->all());

    if($request->type == 'wiki'){
      $search_type = Wiki::where(['id'=>$request->id,'status'=>1])
      ->orderBy('wikis.id','desc')
      ->with(['wikiCategory'])
      ->first();
      
      $caption = $search_type->wikiCategory->name;
      $imagePath = '/uploads/images/wiki/';
    }elseif($request->type == 'entertainment'){
      $search_type = Entertainment::where(['id'=>$request->id,'status'=>1,'type'=>'entertainment'])
      ->orderBy('entertainments.id','desc')
      ->with(['entertainmentCategory'])
      ->first();

      $caption = $search_type->entertainmentCategory->name;
      $imagePath = '/uploads/images/entertainment/';
    }elseif($request->type == 'cast'){
      $search_type = Entertainment::where(['id'=>$request->id,'status'=>1,'type'=>'cast'])
      ->orderBy('entertainments.id','desc')
      ->with(['entertainmentCategory'])
      ->first();

      $caption = $search_type->entertainmentCategory->name;
      $imagePath = '/uploads/images/entertainment/';
    }

    $current_user = get_current_user_info();

    if($search_type->featured_image != '') {
      $oldPath = public_path($imagePath.$search_type->featured_image); 
      $fileExtension = \File::extension($oldPath);
      $timestamp = generateFilename();
      $filename = rand().$timestamp . '.' . $fileExtension;
      $newPathWithName = public_path('/uploads/images/feed/'.$filename);
      if (\File::copy($oldPath , $newPathWithName)) {
          // dd("success");
      }
    }

    $feed_data = array(
      'user_id' => $current_user->id,
      'type' => 4,
      'title' => ucfirst($search_type->title),
      'caption' => ucfirst($caption),
      'image' => $filename,
      'url' => trim($search_type->url),
      'check_post' => 1,
      'time' => time(),
    );
    $feedInsert = Feed::insertGetId($feed_data);

    echo json_encode(['success'=>1,'msg'=>'Successfully share.']);
  }

  public function aboutPop(){
    $slider = array();

    $slider['image'][] = asset('front/images/icons/Richard_Derr.jpg');
    $slider['image'][] = asset('front/images/icons/Carly_McGinnis.jpg');
    $slider['image'][] = asset('front/images/icons/Gary_Swisher.jpg');
    $slider['image'][] = asset('front/images/icons/Rich_Mazel.jpg');
    $slider['image'][] = asset('front/images/icons/Hank_Wilson.png');
    $slider['image'][] = asset('front/images/icons/Megan_Hinterman.jpg');
    $slider['image'][] = asset('front/images/icons/John_Bell.jpg');
    $slider['image'][] = asset('front/images/icons/Mary_Jo_Reutter.png');


    $slider['testi_text'][] = '"Have you heard? There is a new place for all things toys and it is POP (People of Play). I strongly urge you, if interested or dealing in the toy, game and gift area, you check out POP."';
    $slider['testi_text'][] = "I love the CHITAG and POP events! Theyre extremely well run with a great amount of thought put into them.";
    $slider['testi_text'][] = '"POP Week is “THE” event in the Toy Industry, it is a who’s who of Toy & Game Inventors and Toy & Game Companies. The Conferences, Gala and Fair are unmatched for Educating, Celebrating and Playing in our industry. It is timed perfectly for seeing the best of the best toys and games right in the heart of our biggest selling season!"' ;
    $slider['testi_text'][] = '"POP Week is a high point of the year to meet and speak with inventors from around the globe in an amazing, innovative and supportive environment. It is the only toy and game fair offering a combination of new and experienced inventors, learning and networking opportunities.”';
    $slider['testi_text'][] = "“Thank you so much, for how welcoming and supportive you've been of this newbie game inventor who hopes to be part of the industry someday.  Via POP and the speed pitch and mentor match, you've really helped me make connections, and the Bloom Report keeps me updated on everything that's going on in this fascinating industry!”"; 
    $slider['testi_text'][] = '"This event makes me fall in love with the Toy & Game Industry each year!"';
    $slider['testi_text'][] = "“It’s an annual rite of passage for our industry. Keep doing a great job bringing the community together and promoting the spirit of play.”";
    $slider['testi_text'][] = 'POP Pub events are such a great way to stay connected to toy industry friends, and also meet new people. The toy industry has some of the friendliest people around, and the POP Pubs attract the best of the best. Be sure to “POP” in!';

    $slider['name'][] = '- Rick Derr, Regional Manager and Owner, Learning Express Toys';
    $slider['name'][] = '- Carly McGinnis, President at Exploding Kittens';
    $slider['name'][] = '- Gary Swisher, Co-Chairperson of CHITAG/POP Advisory Board, Former EVP and SVP at Spin Master and Mattel';
    $slider['name'][] = '- Rich Mazel, VP of Innovation at Spin Master,Spin Master';
    $slider['name'][] = '- Hank Wilson, Rising Game Inventor';
    $slider['name'][] = '- Megan HintermanKanous, Business Development Manager, PSI, Inc.';
    $slider['name'][] = '– John Bell, Director of Product Design & Development,Buffalo Games';
    $slider['name'][] = '- Mary Jo Reutter, Game and Toy Inventor, You-Betcha Interactive';

    $slider['profile_url'][] = url('people/richard-derr');
    $slider['profile_url'][] = 'javascript:void(0)';
    $slider['profile_url'][] = url('people/gary-swisher');
    $slider['profile_url'][] = url('people/rich-mazel');
    $slider['profile_url'][] = url('people/hank-willson');
    $slider['profile_url'][] = url('people/megan-hinterman-kanous');
    $slider['profile_url'][] = url('people/john-bell');
    $slider['profile_url'][] = url('people/mary-jo-reutter');
    // pr($slider); die;
    return view('front.pages.about',compact('slider'));
  }

}
