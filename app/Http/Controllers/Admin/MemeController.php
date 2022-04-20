<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use File;

class MemeController extends Controller
{
    public function getIndex()
    {
        // $datas = Meme::where('is_seen','0')->orderBy('date','asc')->get();
        // echo '<pre>'; print_r($datas->toArray()); die;
        // // $date = date('Y-m-d');
        // foreach($datas as $data){
        //     // $date = date('Y-m-d',strtotime($date.'+1day'));
        //     // Meme::where('id',$data->id)->update(['schedule_date'=>$date,'date'=>$date]);
        // }
        // die;
        return view('admin.meme.index');
    }

    public function getList()
    {
        $data = Meme::orderBy('date','DESC')->get();
        return \DataTables::of($data)
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->editColumn('date', function ($query) {
                if($query->date == '0000-00-00'){
                    $date = '';
                }else{
                    $date = $query->date;
                }
                return $date;
            })
            ->editColumn('schedule_date', function ($query) {
                if($query->schedule_date == '0000-00-00'){
                    $schedule_date = '';
                }else{
                    $schedule_date = $query->schedule_date;
                }
                return $schedule_date;
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.meme.create');
    }

    public function postCreate(Request $request)
    {
        //echo $request->schedule_date; die;
    //    pr($request->all()); die;
        $message = [
            'featured_image.dimensions' => 'Please Upload Image dimensions : Min Width  400px and Min Height 500px.',
             'featured_image.mimes' => 'Invalid image type: allow Only (jpeg,png,jpg,gif).',
             'featured_image.min' => 'Image upload  minimum size 2MB.',
             'category_id.required' => 'The category field is required.',
            ];

        if($request->image == 1) {
            // echo "ys"; die;
            $request->validate([
                    'featured_image' => 'mimes:jpeg,png,jpg,gif',
                   
            ],$message);
            if($request->schedule_date != '0000-00-00') {
                $request->validate([
                    'file_name' => 'required',
                    'schedule_date' => 'required',
                    // 'schedule_date' => 'unique:memes,schedule_date,' . $request->id,
            ],$message);
            }
        } else {
             // echo "ys1"; die;
             $request->validate([
                'featured_image' => 'required|mimes:jpeg,png,jpg,gif',
              
             ],$message);
              if($request->schedule_date != '0000-00-00') {
                $request->validate([
                    'file_name' => 'required',
                    'schedule_date' => 'unique:memes,schedule_date',
            ],$message);
            }
        }

        try {

            $data = $request->only(Meme::$fillable_shadow);
             if ($request->hasFile('featured_image')) {
                // Shubham Code For Image Compression Start //
                    $file_comp = $request->featured_image;
                    $extension = $file_comp->getClientOriginalExtension();
                    $timestamp = generateFilename();
                    $filename = $timestamp . '_meme_'.'.' . $extension;
                    $file_path = '/uploads/images/meme';
                    $image_comp_size = getimagesize($file_comp);
                    $img = \Image::make($file_comp->getRealPath());
                    $destinationPath = public_path($file_path);
                    if($img->resize($image_comp_size[0], $image_comp_size[1], function ($constraint) {
                        $constraint->aspectRatio();
                        })->save($destinationPath.'/'.$filename,50,'jpg')){

                            $data['featured_image'] = $filename;
                    }else{
                        throw new \Exception(errorMessage('file_uploading_failed'));	
                    }
                // Shubham Code For Image Compression End //
            }
             // echo "dff"; die;
            Meme::where('schedule_date','<',date('Y-m-d'))->where('is_schedule',1)->delete();

             $totalMeme = Meme::count();
             if($request->schedule_date !='') {
                $data['schedule_date'] = trim($request->schedule_date);
                $data['date'] =  trim($request->schedule_date);
                $data['is_schedule'] = 1;
            } else {
                 $data['schedule_date'] = '';
                  $data['date'] ='';
            }
             
            //   $data['date'] ='';
             
            $data['is_seen'] = 0;
            $data['file_name'] = $request->file_name;
            
            // Shubham Code //
                
            $meme_data = Meme::where('id',$request->id)->first();
            $update_meme = Meme::updateOrCreate(['id' => $request->id], $data);
            if(empty($request->id)){
                $meme_data = $update_meme;
            }
            if($meme_data->schedule_date == $request->schedule_date){
                // Meme::updateOrCreate(['id' => $request->id], $data);
                // echo 'here'; 
            }else{
                $schedule_memes = Meme::whereBetween('schedule_date', [$request->schedule_date, $meme_data->schedule_date])->where('id','!=',$request->id)->get();
                $i = 0;
                foreach($schedule_memes as $schedule_meme){
                    $date = date('Y-m-d',strtotime($schedule_meme->schedule_date.'+1day'));
                    $update_data[$i]['date'] = trim($date);
                    $update_data[$i]['schedule_date'] = trim($date);
                    Meme::where('id',$schedule_meme->id)->update($update_data[$i]);
                    $i++;
                }
            }

                
            // Shubham Code //

            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }


    public function getUpdate($id)
    {
        $data  = Meme::findOrFail($id);
        return view('admin.meme.create', compact('data'));
    }

    public function getDelete($id)
    {
         $meme = Meme::findOrFail($id);

         $schedule_memes = Meme::where('schedule_date','>',$meme->schedule_date)->get();
        $i = 0;
        foreach($schedule_memes as $schedule_meme){
            $date = date('Y-m-d',strtotime($schedule_meme->schedule_date.'-1day'));
            $update_data[$i]['date'] = trim($date);
            $update_data[$i]['schedule_date'] = trim($date);
            Meme::where('id',$schedule_meme->id)->update($update_data[$i]);
            $i++;
        }
        
          $file_path = public_path().'/uploads/images/meme/'.$meme->featured_image;
         if (file_exists($file_path)) {
            unlink($file_path);
        }
        $meme->delete();
        return response()->json([
            'status' => 1,
            'msg' => adminTransLang('request_processed_successfully'),
        ], 200);
    }


}
