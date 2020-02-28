<?php namespace App\Http\Controllers\Admin\Media;


use App\Http\Controllers\Controller;
use App\Models\Media\Folders;
use App\Models\Media\Items;
use Illuminate\Http\Request;

class MediaApiController extends Controller
{
    public function getFolderChilds(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
//            'folder_id' => 'required_without_all:slug|integer|exists:drive_folders,id',
//            'slug' => 'required_without_all:folder_id|alpha_dash'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }

        if (isset($data['folder_id'])) {
            $folder = Folders::with('children', 'items')->find($data['folder_id']);
        } elseif (isset($data['slug'])) {
            $folder = Folders::where('name', $data['slug'])->with('children', 'items')->first();
        }

        if (!$folder) {
            return \Response::json(['error' => true, 'message' => [0 => 'undefined folder!!!']]);
        }
        return \Response::json(['error' => false, 'data' => $folder->toArray(), 'settings' => $folder->settings]);
    }

    public function getFolderChildrenJsTree(Request $request)
    {

        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id' => 'required_without_all:slug|integer|exists:drive_folders,id',
            'slug' => 'required_without_all:folder_id|alpha_dash'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }

        if (isset($data['folder_id'])) {
            $folder = Folders::find($data['folder_id']);
        } elseif (isset($data['slug'])) {
            $folder = Folders::where('name', $data['slug'])->first();
        }

        if (!$folder) {
            return \Response::json(['error' => true, 'message' => [0 => 'undefined folder!!!']]);
        }
        return \Response::json($folder->getChildren(true));
    }

    public function getCreateFolderChild(Request $request)
    {

        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id' => 'exists:drive_folders,id',
            'slug' => 'required_without_all:folder_id|alpha_dash',
            'folder_name' => 'required',
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }

        if (isset($data['folder_id'])) {
            $folder = Folders::find($data['folder_id']);
        } elseif (isset($data['slug'])) {
            $folder = Folders::where('path', '/' . $data['slug'])->first();
        }
        if (!$folder) {
            return \Response::json(['error' => true, 'message' => [0 => 'undefined folder!!!']]);
        }
        return $folder->createChild($data);

    }

    public function getEditFolder(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id' => 'required_without_all:slug|integer|exists:drive_folders,id',
            'folder_name' => 'required|alpha_num|not_in:drive,site-media',
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        if (isset($data['folder_id'])) {
            $folder = Folders::find($data['folder_id']);
        } elseif (isset($data['slug'])) {
            $folder = Folders::where('path', '/' . $data['slug'])->first();
        }
        if (!$folder) {
            return \Response::json(['error' => true, 'message' => [0 => 'undefined folder!!!']]);
        }
        return \Response::json(['error' => false, 'data' => $folder->editFolder($data)]);

    }

    public function getFolderInfo(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id' => 'required_without_all:slug|integer|exists:drive_folders,id'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        if (isset($data['folder_id'])) {
            $folder = Folders::find($data['folder_id']);
        }
        if (!$folder) {
            return \Response::json(['error' => true, 'message' => [0 => 'undefined folder!!!']]);
        }
        return \Response::json(['error' => false, 'data' => $folder->info()]);
    }

    public function getSortFolder(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id.*' => 'required|integer|exists:drive_folders,id',
            'parent_id' => 'required|integer|exists:drive_folders,id'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        return Folders::sort($data);
    }

    public function getRemoveFolder(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id.*' => 'required|integer|exists:drive_folders,id',
            'trash' => 'required|boolean'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }

        return \Response::json(['error' => false, 'data' => ['removed' => Folders::removeFolder($data), 'id' => $data['folder_id']]]);
    }

    public function getUploaderSettings(Request $request)
    {
        $slug = $request->get('slug');
        $html = Units::find($slug)->renderSettings();
        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getFolderUploader(Request $request)
    {
        $html = \View::make('media._partials.uploader')->render();
        return \Response::json(['error' => false, 'html' => $html]);
    }

    public function getEditFolderSettings(Request $request)
    {
        $data = $request->except('_token');
        $folder = Folders::find($data['folder_id']);
        $folder->uploader_slug = $data['folder_settings']['uploader_slug'];
        $folder->settings->uploader_data = $data['uploader_data'];
        $folder->settings->save();
        $folder->save();
        return \Response::json(['error' => false]);

    }

    public function getDownload(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'folder_id' => 'required|integer|exists:drive_folders,id'
        ]);
        if ($validator->fails()) {
            return \Response::json(['error' => true, 'message' => $validator->messages()]);
        }
        $folder = Folders::find($request->folder_id);
        $files = glob($folder->path() . '/*');
        $zipper = new Zipper();
        $zipFile = $zipper->make(public_path($folder->name . '.zip'))->add($files);
        $path = $zipFile->getFilePath();
        $zipFile->close();
        if (\File::exists($path)) {
            return response()->json(['url' => '/public/' . $folder->name . '.zip']);
//            return response()->download($path)->deleteFileAfterSend(true);
        }
    }

    public function emptuTrash()
    {
        $folders = Folders::emptyTrash();
        $items = Items::emptyTrash();
        return \Response::json(['error' => false, 'folders' => $folders, 'items' => $items]);
    }
}
