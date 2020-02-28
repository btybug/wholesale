<?php namespace App\Http\Controllers\Admin\Media;

use App\Http\Controllers\Controller;
use App\Models\Media\Folders;
use App\Models\Media\Items;
use Illuminate\Http\Request;

class MediaItemsApiController extends Controller
{
    // ITEMS Functions
    public function getSortItems(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id' => 'required|integer|exists:drive_folders,id',
            'item_id' => 'required',
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages(), 'uuu' => 'ppp']);
        }
        if (isset($data['item_id']) and is_array($data['item_id'])) {
            $vdata = $data['item_id'];
            foreach ($data['item_id'] as $k => $v) {
                $rule[$k] = 'required|integer|exists:drive_items,id';
            }
        } else {
            $vdata = $data;
            $rule['item_id'] = 'required|integer|exists:drive_items,id';
        }
        $validator = \Validator::make($vdata, $rule);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        $result = Items::sort($data);
        return \Response::json(['error' => !(boolean)$result, 'data' => $result]);
    }

    public function getDeleteItems(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'item_id' => 'required',
            'trash' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        if (isset($data['item_id']) and is_array($data['item_id'])) {
            $vdata = $data['item_id'];
            foreach ($data['item_id'] as $k => $v) {
                $rule[$k] = 'required|integer|exists:drive_items,id';
            }
        } else {
            $vdata = $data;
            $rule['item_id'] = 'required|integer|exists:drive_items,id';
        }
        $validator = \Validator::make($vdata, $rule);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        return \Response::json(['error' => false, 'data' => Items::removeItem($data)]);

    }

    public function uploadFile(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'folder_id' => 'required_without_all:slug|integer|exists:drive_folders,id',
            'item.*' => 'required',
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        if ($validator->fails()) {
            return \Response::json(['error' => 'ERROR', 'message' => 'Could not upload file.']);
        }
            $folder = Folders::find($request->folder_id);
            foreach ($request->item as $item) {
                $uploadPath=$folder->uploadPath();
                $realName = $request->item_name ? $request->item_name : $item->getClientOriginalName();
                $originalName = md5(uniqid()) . '.' . $item->getClientOriginalExtension();
                if ($item->move($uploadPath['path'], $originalName)) {
                    $item = Items::create([
                        'original_name' => $originalName,
                        'real_name' => $realName,
                        'extension' => $item->getClientOriginalExtension(),
                        'size' => \File::size($uploadPath['path'] . DIRECTORY_SEPARATOR . $originalName),
                        'original_folder' => $uploadPath['folder'],
                        'folder_id' => $folder->id
                    ]);

                    if ($this->ifIsImage($originalName)) {
                        $img = \Image::make($uploadPath['path'] . DIRECTORY_SEPARATOR . $originalName)->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
//                        $img->insert('public/watermark.jpg');
                        $img->save(public_path("media/tmp/$originalName"));
                    }
                }
            }
            return \Response::json(['uploaded' => 'OK', 'message' => 'File has been uploaded successfully.']);


    }

    public function replaceFile(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'item_id' => 'required|exists:drive_items,id',
            'item.*' => 'required',
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        $oldItem = Items::find($request->item_id);
        if ($oldItem) {
            if (\File::delete($oldItem->folder->path() . '/' . $oldItem->real_name)) {
                foreach ($request->item as $item) {
                    $realName = $request->item_name ? $request->item_name : $item->getClientOriginalName();
                    if ($item->move($oldItem->folder->path(), $item->getClientOriginalName())) {
                        $oldItem->original_name = $item->getClientOriginalName();
                        $oldItem->real_name = $realName;
                        $oldItem->extension = $item->getClientOriginalExtension();
                        $oldItem->size = $item->getClientSize();
                        $oldItem->save();
                    }

                }
                return \Response::json(['error' => false, 'message' => 'File has been replaced successfully.']);
            }

            return \Response::json(['error' => true, 'message' => 'Could not replace file.']);
        }
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => 'Could not replace file.']);
        }
    }

    public function renameFile(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'item_id' => 'required|exists:drive_items,id',
            'item_name' => 'required'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        $oldItem = Items::find($request->item_id);
        if ($oldItem) {
            $filename = (str_contains($request->item_name, '.' . $oldItem->extention)) ? $request->item_name : $request->item_name . '.' . $oldItem->extension;
            $oldItem->real_name = $filename;
            if ($oldItem->save()) {
                return \Response::json(['error' => false, 'message' => 'File name has been changed successfully.','name'=>$filename]);
            }
            return \Response::json(['error' => true, 'message' => 'Could not change file name.']);
        }
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => 'Could not change file name.']);
        }
    }

    public function getCopyItems(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'item_id' => 'required'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        if (isset($data['item_id']) and is_array($data['item_id'])) {
            $vdata = $data['item_id'];
            foreach ($data['item_id'] as $k => $v) {
                $result = Items::copy($v);
                if ($result == true) {
                    break;
                }
            }
        } else {
            $result = Items::copy($data['item_id']);
        }

        return \Response::json(['error' => $result]);

    }

    public function getTransferItems(Request $request)
    {
        ini_set('allow_url_fopen', "On");
        ini_set('allow_url_include', "On");

        $data = $request->all();
        $validator = \Validator::make($data, [
            'item_id' => 'required',
            'folder_id' => 'required_without_all:slug|integer|exists:drive_folders,id'
        ]);

        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }

        if (isset($data['item_id']) and is_array($data['item_id'])) {
            $vdata = $data['item_id'];
            foreach ($data['item_id'] as $k => $v) {
                $result[] = Items::transfer($v, $data['folder_id']);

            }
        } else {
            $result = Items::transfer($data['item_id'], $data['folder_id']);
        }
        return \Response::json(['error' => false, "data" => $result]);
    }

    public function getItemDetalis(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'item_id' => 'required|exists:drive_items,id'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        $item = Items::with('storage')->find($request->item_id);
        if ($item) {
            return \Response::json(['error' => false, 'data' => $item]);
        }
        return \Response::json(['error' => true, 'message' => 'Could not send data.']);
    }

    public function getSaveSeo(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'item_id' => 'required|exists:drive_items,id'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        $item = Items::find($request->item_id);
        if ($item) {
            $item->update($request->except('item_id'));
            return \Response::json(['error' => false, 'data' => $item]);
        }
        return \Response::json(['error' => true, 'message' => 'Could not send data.']);
    }

    public function ifIsImage($inage_name)
    {
        $allowed = array('.jpg', '.jpeg', '.gif', '.png', '.flv');
        return (in_array(strtolower(strrchr($inage_name, '.')), $allowed));
    }
}
