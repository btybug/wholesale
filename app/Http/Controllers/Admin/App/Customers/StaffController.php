<?php


namespace App\Http\Controllers\Admin\App\Customers;


use App\Http\Controllers\Controller;
use App\Models\App\AppPermissions;
use App\Models\App\AppStaffPermissions;
use App\Models\Warehouse;
use App\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function getStaff(Request $request,$id=null)
    {
        $warehouse=Warehouse::all();
        $q=($id)??$warehouse[0]->id;

        $users=User::join('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('app_staff','app_staff.users_id','users.id')
            ->where('app_staff.warehouses_id','!=',$q)
            ->orWhere('app_staff.warehouses_id',null)
            ->where('roles.type', 'backend')

            ->select('users.*', 'roles.title')
            ->pluck('users.name','id');
        $warehouse=$warehouse->pluck('name','id');
        return view('admin.app.staff.index',compact('warehouse','users','q'));
    }

    public function postCreateStaffMember(Request $request)
    {
        $warehouse=Warehouse::findOrFail($request->get('warehouse_id'));
        $warehouse->staff()->attach($request->get('user_id'));
        $pass=rand(10000000,99999999);
        while (User::where('app_pass',$pass)->exists()){
            $pass=rand(10000000,99999999);
        }
        User::where('id',$request->get('user_id'))->update(['app_pass'=>$pass]);
        return response()->json(['error'=>false]);
    }

    public function getAppBadge($id,$warehouse_id)
    {
        $model=User::findOrfail($id);
        return view('admin.app.staff.view', compact('model'));
    }

    public function getRoles()
    {
        return view('staff.roles.index');
    }

    public function getCreateRole($id = null)
    {
        $model = ($id) ? StaffRoles::findOrFail($id) : null;
        return view('staff.roles.create_edit', compact('model'));
    }

    public function postCreateOrEditRole(StaffRolelRequest $request, $id = null)
    {
        $data = $request->only(['name', 'minimum_rate', 'minimum_salary', 'description']);
        $data['slug'] = str_replace(' ', '_', strtolower($request->get('name')));
        $data['customer_id'] = \Auth::id();
        StaffRoles::updateOrCreate(['id' => $id], $data);
        return redirect()->route('staff_roles');
    }

    public function getStaffPermission($id,$warehouse_id)
    {
        $user= User::find($id);
        $existing=$user->appPermissions()->where('app_staff_permissions.warehouse_id',$warehouse_id)->pluck('app_permissions.slug','app_permissions.id');
        $permissions=AppPermissions::all();
        $permissionGrouped=[];
        foreach($permissions as $permission){
            $permissionGrouped[$permission->type][]=$permission;
        }
        return view('admin.app.staff.permissions.add_staff',compact('permissionGrouped','existing'));
    }

    public function getAppPermissions()
    {
        return view('admin.app.staff.permissions.index');
    }

    public function postStaffPermission($id,$warehouse_id,Request $request)
    {
       $user= User::find($id);
       $data=[];
       foreach ($request->get('permission',[]) as $key=>$permission){
           $data[$key]['user_id'] = $id;
           $data[$key]['warehouse_id'] = $warehouse_id;
           $data[$key]['permission_id'] = $permission;
       }
        AppStaffPermissions::where('user_id', $id)->where('warehouse_id', $warehouse_id)->delete();
       \DB::table('app_staff_permissions')->insert($data);
        return redirect()->back();
    }
}
