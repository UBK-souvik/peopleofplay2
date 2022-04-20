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
        return view('admin.meme.index');
    }

    public function getList()
    {
        $data = Meme::all();
        return \DataTables::of($data)
            ->editColumn('featured_image', function ($query) {
                return @imageBasePath($query->featured_image);
            })
            ->editColumn('status', function ($query) {
                return config('cms.action_status')[$query->status];
            })
            ->make();
    }

    public function getCreate()
    {
        return view('admin.meme.create');
    }

    public function postCreate(Request $request)
    {
       // pr($request->all()); die;
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
                    'status' => 'required|in:0,1',
                    'schedule_date' => 'unique:memes,schedule_date,' . $request->id,
            ],$message);
        } else {
             // echo "ys1"; die;
             $request->validate([
                'featured_image' => 'required|mimes:jpeg,png,jpg,gif',
                'status' => 'required|in:0,1',
                'schedule_date' => 'unique:memes,schedule_date',
             ],$message);
        }

        try {

            DB::beginTransaction();
            $data = $request->only(Meme::$fillable_shadow);
             if ($request->hasFile('featured_image')) {
                $file = $request->featured_image;
                $extension = $file->getClientOriginalExtension();
                $timestamp = generateFilename();
                $filename = $timestamp . '_meme_'.'.' . $extension;
                $file_path = imagePath();
                $upload_status = $file->move(public_path('/uploads/images/meme'), $filename);
                if ($upload_status) {
                     $data['featured_image'] = $filename;
                } else {
                    throw new \Exception(errorMessage('file_uploading_failed'));
                }
            }
            Meme::where('schedule_date','<',date('Y-m-d'))->where('is_schedule',1)->delete();
             $totalMeme = Meme::count();
             if($totalMeme>0) {
                 if($request->schedule_date !='') {
                    $data['date'] = $request->schedule_date;
                    $this->dateCheckScheduleRecursive($request->schedule_date);
                    $data['schedule_date'] = $request->schedule_date;
                    $data['is_schedule'] = 1;
                 } else {
                   $data['date'] = trim($this->dateCheckRecursive(date('Y-m-d')));
                    $data['schedule_date'] ='';
                 }

             } else {
                if($request->schedule_date !='') {
                    $data['date'] = $request->schedule_date;
                    $data['schedule_date'] = $request->schedule_date; 
                    $data['is_schedule'] = 1; 
                } else {
                    $data['date'] = date('Y-m-d');
                    $data['schedule_date'] = ''; 
                }
             }
            $data['is_seen'] = 0;
            Meme::updateOrCreate(['id' => $request->id], $data);

            DB::commit();
            return response()->json([
                'status' => 1,
                'msg' => adminTransLang('request_processed_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }


    public function dateCheckRecursive($date,$i=0)
    {
        $check = Meme::where('date',$date)->first();
        if(empty($check)) {
            return " $date"; die; 
        }  else {
            $i++;
             $current_date =date('Y-m-d');
             $checkDate =  date('Y-m-d', strtotime($current_date. " + $i day"));
            return $this->dateCheckRecursive($checkDate, $i);
        }
    }

  public function dateCheckRecursive2($date,$i=0)
    {
        $check = Meme::where('date',$date)->where('is_schedule',1)->first();
        if(empty($check)) {
            return false;
        }  else {
           return true;
        }
    }

    public function dateCheckScheduleRecursive($date,$i=0)
    {
        $check = Meme::where('date','>=',$date)->get();
        if(empty($check)) {
            return " $date"; die; 
        }  else { 
             $i++;
             $current_date =date('Y-m-d');
             $checkDate =  date('Y-m-d', strtotime($current_date. " + $i day"));
             $totalMeme =  count($check);
             $k=1;
             foreach ($check as $key => $rowcheck) {
                $newMemeSchedule = Meme::where(['id'=>$rowcheck->id,'is_schedule'=>1])->first();
                if(!empty($newMemeSchedule)) {
                    continue;
                }
                $checkSchedule =  $this->dateCheckRecursive2($date);
                if($checkSchedule == true) {
                    $k++;
                    continue;
                }
                $newDate =  date('Y-m-d', strtotime($date. " + $k day"));

                Meme::where('id',$rowcheck->id)->update(['date'=>$newDate]);
                $k++;
             }
             return $date; 
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
