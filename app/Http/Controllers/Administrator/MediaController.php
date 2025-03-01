<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MediaController extends Controller
{
    //
    public $_statusOK = 200;
    public $_statusErr = 500;
    private $counter = 1;

    public function index()
    {
        try {
            $media = Media::paginate(50);
            return view('administrator.media.index',compact('media'));

        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
        }
        
    }

    public function view($id){
        try {
            $mediaPath = config('constant.absoluteMediaPath');
            $file = Media::findOrFail($id);
            return view('administrator.media.show',compact('mediaPath','file'));
        } catch(\Illuminate\Database\QueryException $e){
        } 
    }

    public function save(Request $request) {
        try {
            $data = $request->all();
            // Check is file exist        
            if (!$request->hasFile('file')) {
                return false;                
            }

            $request->validate([
                'file' => 'required|mimes:jpeg,jfif,webp,png,jpg,gif,svg,doc,docx,pdf,mp4,m3u8,flv,wmv,avi,mov,3gp',
            ]); 
            
            $fileData = $request->file('file');
            $today = date("Y-m-d");
            $fileDataArray = array(
                'name' => current(explode('.',$request->file->getClientOriginalName())),
                'type' => $request->file->getMimeType(),
                'alternative' => "",
                'caption' => "",
                'description' => "",
                'extension' => $request->file->extension(),
                'size' => number_format((float)($request->file->getSize()/1024), 2, '.', ''),
                'path' => config('constant.relativeMediaPath').'/'.$today,
            );
            
            $fileName = $this->rename(str_replace(" ","-",strtolower($request->file->getClientOriginalName())));
            
            $folder = public_path('upload/'.$today);
            if(!File::exists($folder)) {
                File::makeDirectory($folder, 0777, true); //creates directory
            }

            $imageType = [
                'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp','heic', 'heif', 'svg', 'eps', 'pdf', 'raw', 'nef', 'cr2','arw','dng', 'ico', 'tga', 'exr'
            ];
            if(in_array($fileDataArray['extension'], $imageType)){
                $manager = new ImageManager(new Driver());
                $image = $manager->read($fileData->getRealPath());
                $dimension = $image->width().'x'.$image->height();
                $image->resize(120, 120)->save(public_path('upload/'.date("Y-m-d")).'/'."thumb_".$fileName);
            }

            if(!$request->file('file')->move(public_path('upload/'.date("Y-m-d")),$fileName)){
                return false;
            }
            
            $fileDataArray['filename'] = $fileName;
            $fileDataArray['dimension'] = (isset($dimension))?$dimension:'';
            $media = Media::create($fileDataArray);
            return response()->json($media,$this->_statusOK);
        } catch(\Illuminate\Database\QueryException $e){
            //var_dump($e->getMessage()); 
        }
    }

    public function updateFile(Request $request) {
        try {
            $data = $request->all();
            $file = Media::findOrFail($data['file_id']);
            $file->update($data);
            return redirect()->back()->with('message', 'File updated successfully!');
        } catch(\Illuminate\Database\QueryException $e){
            var_dump($e->getMessage()); 
        }
    }

    public function resizeMobile($profile,$fileName,$request){
        $config = config('constant.imageSize.'.$profile);

        $manager = new ImageManager(new Driver());
        $image = $manager->create($request->file('file')->getRealPath());
        $width = (768 * $image->width()/1920);
        
        Image::resize($width, $width, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('upload/'.date("Y-m-d")).'/'."mobile_".$fileName);
    }

    public function rename($filename){
        
        if(!file_exists(public_path('upload/'.date("Y-m-d")).'/'.$filename)){
            return $filename;
        } else {
            if($this->counter > 1){
                $filenameArr = explode("-",$filename);
                $filenameArr['0'] = $this->counter;
                $filename = implode("-",$filenameArr);
            } else {
                $filename = $this->counter.'-'.$filename;
            }
            $this->counter++;
            return $this->rename($filename);
        }
    }

    public function search(Request $request){
        try {
            $data = $request->all();
            $media = Media::select("id","alternative")->where('name', 'like', '%' . $data['keyword'] . '%')
                    ->orWhere('filename', 'like', '%' . $data['keyword'] . '%')
                    ->get();
            $a = '';
            foreach($media as $value){
                $a .= '<div class="image-thumbnail" data-id="'.$value->id.'">';
                $a .= '<img src="'.getSizedImage($value->id,'thumb').'" alt="'.$value->alternative.'" style="width:100%">';
                $a .= '</div>';
            } 
            return $a;
        } catch(\Illuminate\Database\QueryException $e){
            //throw $th;
            return response()->json(['error' => $e->errorInfo[2]], 401);
        }
        
    }

    public function delete($id) {
        $course = Media::findOrFail($id);
        $course->delete();
        return redirect('/administrator/media');
    }

}
