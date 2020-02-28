<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ReviewStatusTypes;
use App\Http\Controllers\Controller;
use App\Models\ActivityLogs;
use App\Models\App\AppItems;
use App\Models\Attributes;
use App\Models\Barcodes;
use App\Models\Brands;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Competitions;
use App\Models\ContactUs;
use App\Models\Coupons;
use App\Models\Faq;
use App\Models\GeoZones;
use App\Models\Items;
use App\Models\ItemsTransfers;
use App\Models\Landing;
use App\Models\LogActivities;
use App\Models\MailTemplates;
use App\Models\MarketType;
use App\Models\Matches;
use App\Models\Newsletter;
use App\Models\Notifications\CustomEmails;
use App\Models\OrderInvoice;
use App\Models\Orders;
use App\Models\Others;
use App\Models\Posts;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\Regions;
use App\Models\Review;
use App\Models\Roles;
use App\Models\SelectionType;
use App\Models\Settings;
use App\Models\Sports;
use App\Models\Statuses;
use App\Models\Stock;
use App\Models\StockSales;
use App\Models\Suppliers;
use App\Models\Teams;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\TranslationsEntry;
use App\Models\Warehouse;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class DatatableController extends Controller
{
    public function getAllUsers()
    {

        return Datatables::of(User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->whereNull('role_id')
            ->orWhere('roles.type', 'frontend')->select('users.*', 'roles.title'))
            ->addColumn('actions', function ($user) {
                return '<div class="users-table--td-btn datatable-td__action">'
                    . (userCan('admin_users_edit') ? '<a href="' . route('admin_users_edit', $user->id) . '" class="btn btn-warning events-modal" data-object="competitions">Edit</a>' : null)
                    . (userCan('admin_users_activity') ? '<a href="' . route('admin_users_activity', $user->id) . '" class="btn btn-info">Activity</a>' : null)
                    . (userCan('admin_users_delete') ? '<a href="javascript:void(0)" data-href="' . route("admin_users_delete") . '"class="delete-button btn btn-danger" data-key="' . $user->id . '">x</a>' : null)
                    . '</div>';
            })->addColumn('membership', function ($user) {
                return ($user->role) ? $user->role->title : 'No Membership';
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllStaff()
    {

        return Datatables::of(User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.type', 'backend')
            ->select('users.*', 'roles.title', 'roles.slug'))
            ->addColumn('actions', function ($user) {
                return '<div class="datatable-td__action">' . ((userCan('admin_users_activity')) ? '<a href="' . route('admin_users_activity', $user->id) . '" class="btn btn-info">Activity</a>' : null) . (($user->slug != 'superadmin') ? (userCan('admin_staff_edit')) ? ' <a href="' . route('admin_staff_edit', $user->id) . '" class="btn btn-warning events-modal" data-object="competitions">Edit</a>' : null .
                        ((!$user->hasVerifiedEmail()) ? '<a href="' . route('admin_users_verify', $user->id) . '" class="btn btn-warning">Verify</a>' : null) . (($user->slug != 'admin' || \Auth::user()->role->slug == 'superadmin') ? ((($user->role->slug != 'superadmin') ? ((userCan('admin_staff_delete')) ? '<a href="javascript:void(0)" data-href="' . route("admin_staff_delete") . '"class="delete-button btn btn-danger" data-key="' . $user->id . '">x</a>' : null) : null) . '</div>') : null) : null);
            })->addColumn('role', function ($user) {
                return $user->role->title;
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllCategories()
    {
        return Datatables::of(Category::query())
            ->editColumn('image', function () {
                return '';
            })
            ->editColumn('icon', function () {
                return '';
            })
            ->editColumn('created_at', function () {
                return '';
            })
            ->addColumn('actions', function ($category) {
                return '<div class="datatable-td__action">
                    <a href="javascript:void(0)" class="btn btn-warning events-modal" data-object="competitions"  data-id="' . $category->id . '">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-danger" data-id="' . $category->id . '">x</a>
                    </div>';
            })->rawColumns(['actions', 'image', 'icon', 'created_at'])
            ->make(true);
    }

    public function getAllRoles()
    {
        $query = Roles::query();

        return Datatables::of($query)->addColumn('actions', function ($role) {
            if ($role->slug != 'superadmin' && $role->slug != 'admin' && $role->slug != 'customer')
                return '<div class="datatable-td__action"><a href="' . route('admin_edit_role', $role->id) . '" class="btn btn-warning events-modal" >Edit</a></div>';
        })->addColumn('access', function ($role) {
            return ($role->type == 'backend') ? 'Admin Panel' : 'Frontend Pages';
        })
            ->rawColumns(['actions', 'access'])->make(true);
    }

    public function getAllAttributes()
    {
        return Datatables::of(
            Attributes::leftJoin('attributes_translations', 'attributes.id', '=', 'attributes_translations.attributes_id')
                ->leftJoin("attribute_categories", 'attributes.id', '=', 'attribute_categories.attribute_id')
                ->leftJoin("categories", 'attribute_categories.categories_id', '=', 'categories.id')
                ->leftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
                ->select('attributes.*', 'attributes_translations.name', 'categories_translations.name as category')
                ->where('attributes_translations.locale', \Lang::getLocale())
//                    ->whereNull('attributes.parent_id')
                ->groupBy('attributes.id')
        )
            ->editColumn('name', function ($attr) {
                return $attr->name;
            })
            ->editColumn('category', function ($attr) {
                $html = '';
                if (count($attr->categories)) {
                    foreach ($attr->categories as $category) {
                        $html .= '<p>' . $category->name . '</p>';
                    }
                }
                return $html;
            })
            ->editColumn('image', function ($attr) {
                return ($attr->image) ? "<img src='$attr->image' width='50px'/>" : "No image";
            })
            ->editColumn('icon', function ($attr) {
                return ($attr->icon) ? "<i class='$attr->icon'></i>" : "No Icon";
            })
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })
            ->addColumn('actions', function ($attr) {

                return '<div class="datatable-td__action">'
                    . (userCan('admin_store_attributes_edit') ? '
                    <a href="' . route("admin_store_attributes_edit", $attr->id) . '" class="btn btn-warning">Edit</a>' : null)
                    . (userCan('admin_store_attributes_delete') ? '
                    <a href="javascript:void(0)" class="btn btn-danger delete-button" data-href="' . route("admin_store_attributes_delete") . '" data-key="' . $attr->id . '">x</a>' : null)
                    . '</div>';
            })->rawColumns(['actions', 'image', 'icon', 'created_at', 'category'])
            ->make(true);
    }

    public function getAllProducts()
    {
        return Datatables::of(Products::query())
            ->editColumn('created_at', function ($product) {
                return BBgetDateFormat($product->created_at);
            })->editColumn('image', function ($product) {
                return ($product->image) ? "<img src='$product->image' width='100px'/>" : "No image";
            })
            ->editColumn('user_id', function ($product) {
                return $product->author->name;
            })
            ->addColumn('actions', function ($product) {
                return '<div class="datatable-td__action">
                    <a href="' . route("admin_store_products_edit", $product->id) . '" class="btn btn-warning">Edit</a>
                    <a href="javascript:void(0)" class="btn btn-danger" data-id="' . $product->id . '">x</a>
                    </div>';
            })->rawColumns(['actions', 'image', 'created_at'])
            ->make(true);
    }

    public function getAllEmails()
    {
        return Datatables::of(MailTemplates::where('is_for_admin', 0))
            ->addColumn('actions', function ($email) {
                return userCan('admin_mail_create_templates') ? '<a href="' . route('admin_mail_create_templates', $email->id) . '" class="btn btn-warning events-modal" data-object="competitions">Edit</a>' : null;
            })
            ->editColumn('is_active', function ($email) {
                return ($email->is_active) ? 'Yes' : 'No';
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllPosts()
    {
        return Datatables::of(Posts::query())
            ->editColumn('title', function ($post) {
                return $post->title;
            })->editColumn('short_description', function ($post) {
                return $post->short_description;
            })
            ->editColumn('url', function ($post) {
                return "<a href='/news/" . $post->url . "' target='_blank'>news/" . $post->url . "</a>";
            })
            ->editColumn('user_id', function ($post) {
                return $post->author->name;
            })->editColumn('status', function ($post) {
                return ($post->status) ? '<span class="badge btn-success">published</span>' : '<span class="badge btn-danger">draft</span>';
            })
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })
            ->addColumn('actions', function ($post) {
                return '<div class="datatable-td__action">'
                    . (userCan('admin_post_edit') ? "<a class='btn btn-warning' href='" . route("admin_post_edit", $post->id) . "'>Edit</a>" : null)
                    . ((userCan('admin_post_delete')) ? "
                    <a class='delete-button btn btn-danger' data-key='" . $post->id . "' data-href='" . route("admin_post_delete") . "'>x</a>" : null) . '</div>';
            })->rawColumns(['actions', 'url', 'short_description', 'created_at', 'status'])
            ->make(true);
    }

    public function getAllBrands()
    {
        return Datatables::of(
            Brands::join('brands_translations', 'brands_translations.brands_id', 'brands.id')
                ->where('brands_translations.locale', app()->getLocale())
                ->select('brands.*', 'brands_translations.name', 'brands_translations.description')
        )->editColumn('image', function ($brand) {
            return '<img src="' . media_image_tmb($brand->image) . '" width="25px">';
        })->editColumn('icon', function ($brand) {
            return '<i class="' . $brand->icon . '"></i>';
        })
            ->addColumn('actions', function ($brand) {
                return "<div class='datatable-td__action'>" . (userCan('admin_blog_brands_edit') ? "<a class='btn btn-warning' href='" . route('admin_blog_brands_edit', $brand->id) . "'><i class='fa fa-edit'></i></a>" : null) . "<a class='btn btn-danger' href='#'>x</a></div>";
            })->rawColumns(['actions', 'image', 'icon'])
            ->make(true);

    }

    public function getAllContactUs()
    {
        return Datatables::of(ContactUs::whereNull('parent_id')->orderBy('updated_at', 'DESC'))
            ->editColumn('is_readed', function ($message) {
                return (!$message->is_readed || $message->children()->where('is_readed', 0)->exists());
            })->addColumn('options', function ($message) {
                return '<input type="checkbox" data-id="' . $message->id . '">';
            })->addColumn('action', function ($message) {
                return "<div class='datatable-td__action'>" . (userCan('admin_blog_contact_us_view') ? "<a class='btn btn-info' href='" . route('admin_blog_contact_us_view', $message->id) . "'><i class='fa fa-eye'></i></a>" : null) . "</div>";
            })->rawColumns(['action', 'options'])
            ->make(true);
    }

    public function getAllPostComments()
    {
        return Datatables::of(Comment::query())
            ->editColumn('status', function ($comment) {
                return ($comment->status) ? '<span class="badge btn-success">Approved</span>' : '<span class="badge btn-danger">Unapproved</span>';
            })->editColumn('author', function ($comment) {
                $user = $comment->author;
                return '<strong>
                            <img alt="" src="/public/admin_theme/dist/img/user2-160x160.jpg" class="img" height="32" width="32"> ' . $user->name . '</strong>
                            <br>
                            <a href="mailto:' . $user->email . '">' . $user->email . '</a><br>';
            })
            ->editColumn('comment', function ($comment) {
                $str = 'Submitted on ' . BBgetDateFormat($comment->created_at) . ' at ' . BBgetTimeFormat($comment->created_at);
                if ($comment->parent) {
                    $str .= ' | In reply to ' . $comment->parent->author->name;
                }
                $str .= '<br>';
                $str .= '<div><strong>' . $comment->comment . '</strong></div>';
                return $str;
            })
            ->editColumn('replies', function ($comment) {
                return '<span class="badge comment-count">' . count($comment->childrenAll) . '</span>';
            })
            ->addColumn('actions', function ($comment) {
                $actions = '';
                if (userCan('edit_comment')) {
                    $actions = ($comment->status) ?
                        '<div class="datatable-td__action"><a href="' . route('unapprove_comments', $comment->id) . '" class="btn btn-info"> Block</a>'
                        : '<div class="datatable-td__action"><a href="' . route('approve_comments', $comment->id) . '" class="btn btn-success">Approve</a>';
                    $actions .= '<a class="btn btn-primary" href="' . route('reply_comment', $comment->id) . '">Reply</a>';
                    $actions .= '<a class="btn btn-warning" href="' . route('edit_comment', $comment->id) . '">Edit</a>';
                }

                userCan('delete_comments') ?
                    $actions .= '<a class="btn btn-danger delete-button" data-key="' . $comment->id . '" data-href="' . route('delete_comments') . '">x</a></div>' : null;
                return $actions;
            })->rawColumns(['actions', 'author', 'comment', 'replies', 'status'])
            ->make(true);
    }

    public function getAllCoupons($isArchive)
    {
        $now = strtotime(today()->toDateString());
//        dd($isArchive);
        if ($isArchive == 'archive') {
            $query = Coupons::where(function ($q) use ($now) {
                $q->where('status', false)->orWhere('end_date', '<', $now);
            });
        } else {
            $query = Coupons::where(function ($q) use ($now) {
                $q->where('start_date', '<=', $now)->where('end_date', '>=', $now)->where('status', true);
            })->orWhere(function ($q) use ($now) {
                $q->where('start_date', '>', $now)->where('status', true);
            });
        }

        return Datatables::of($query)
            ->editColumn('type', function ($coupons) {
                return ($coupons->type == 'p') ? "Percentage" : "Fixed Amount";
            })->editColumn('discount', function ($coupons) {
                return ($coupons->type == 'p') ? "-" . $coupons->discount . "%" : "-" . $coupons->discount;
            })
            ->editColumn('start_date', function ($coupons) {
                return BBgetDateFormat($coupons->start_date);
            })
            ->editColumn('end_date', function ($coupons) {
                return BBgetDateFormat($coupons->end_date);
            })->editColumn('status', function ($coupons) {
                return $coupons->availability;
            })
            ->addColumn('actions', function ($coupons) {
                return (userCan('admin_store_coupons_edit')) ? "<div class='datatable-td__action'>
<a class='btn btn-warning' href='" . route("admin_store_coupons_edit", $coupons->id) . "'>Edit</a></div>" : null;
            })->rawColumns(['actions', 'name', 'end_date', 'start_date'])
            ->make(true);
    }

    public function getAllStocks()
    {
        return Datatables::of(Stock::leftJoin('stock_translations', 'stocks.id', '=', 'stock_translations.stock_id')
            ->leftJoin('stock_categories', 'stock_categories.stock_id', '=', 'stocks.id')
            ->leftJoin('categories', 'stock_categories.categories_id', '=', 'categories.id')
            ->leftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
            ->select('stocks.*', 'stock_translations.name')
            ->where('stocks.is_offer', false)
            ->where('stock_translations.locale', \Lang::getLocale())->groupBy('stocks.id'))
            ->editColumn('image', function ($stock) {
                return ($stock->image) ? "<img src='$stock->image' width='50px'/>" : "No image";
            })->addColumn('brand', function ($stock) {
                return ($stock->brand) ? $stock->brand->name : null;
            })->addColumn('categories', function ($stock) {
                return implode(',', $stock->categories->pluck('name')->toArray());
            })
            ->editColumn('created_at', function ($stock) {
                return BBgetDateFormat($stock->created_at) . ' ' . BBgetTimeFormat($stock->created_at);
            })
            ->addColumn('actions', function ($stock) {
                return '<div class="datatable-td__action">'
                    . ((userCan('admin_stock_edit')) ? "<a class='btn edit-row' style='background-color: #86caff;color:black' data-id='" . $stock->id . "'><i class='fa fa-road'></i></a><a class='btn btn-warning mr-1' href='" . route("admin_stock_edit", $stock->id) . "'>Edit</a>" : '')
                    . ((userCan('admin_stock_edit')) ? "<a class='btn  copy-stock' href='javascript:void(0)' style='background-color: #5cff29;color:black' data-id='" . $stock->id . "'><i class='fa fa-copy'></i></a>" : '')
                    . ((userCan('admin_stock_delete')) ? '<a href="javascript:void(0)" data-href="' . route("admin_stock_delete") . '"
                class="delete-button btn btn-danger" data-key="' . $stock->id . '">x</a>' : null) . '</div>';
            })->rawColumns(['actions', 'name', 'image'])
            ->make(true);
    }

    public function getAllStockOffers()
    {
        return Datatables::of(Stock::leftJoin('stock_translations', 'stocks.id', '=', 'stock_translations.stock_id')
            ->select('stocks.*', 'stock_translations.name')
            ->where('stocks.is_offer', true)
            ->where('stock_translations.locale', \Lang::getLocale()))
            ->editColumn('image', function ($stock) {
                return ($stock->image) ? "<img src='$stock->image' width='50px'/>" : "No image";
            })
            ->editColumn('created_at', function ($stock) {
                return BBgetDateFormat($stock->created_at) . ' ' . BBgetTimeFormat($stock->created_at);
            })
            ->addColumn('actions', function ($stock) {
                return '<div class="datatable-td__action">' .
                    (userCan('admin_stock_edit_offer') ? '<a class="btn btn-warning mr-1" href="' . route("admin_stock_edit_offer", $stock->id) . '">Edit</a>' : null) .
                    '</div>';
            })->rawColumns(['actions', 'name', 'image'])
            ->make(true);
    }

    public function getAllGeoZones()
    {
        return Datatables::of(GeoZones::query())
            ->editColumn('created_at', function ($geo_zone) {
                return BBgetDateFormat($geo_zone->created_at) . ' ' . BBgetTimeFormat($geo_zone->created_at);
            })
            ->addColumn('actions', function ($geo_zone) {
                return "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='" . route('admin_settings_geo_zones_new', $geo_zone->id) . "'>Edit</a>
                    <a class='btn btn-info' href='#'><i class='fa fa-copy'></i></a>
                    <a class='btn btn-danger' href='#'>x</a>
                    </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getUserActivity(int $id)
    {
        return Datatables::of(ActivityLogs::where('user_id', $id)->get())
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at, 'd M Y H:i:s');
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='#'>Edit</a>
                    <a class='btn btn-danger' href=''>x</a>
                    </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getUserPostActivity($id)
    {
        return Datatables::of(LogActivities::where('user_id', $id)->where('method', 'post'))
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='#'>Edit</a>
                    <a class='btn btn-danger' href=''>x</a>
                    </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getFrontendActivity()
    {

        return Datatables::of(LogActivities::leftJoin('users', 'users.id', '=', 'log_activities.user_id')->whereNull('users.role_id')
            ->select('log_activities.*', 'users.name', 'users.last_name'))
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('user', function ($attr) {
                if (!$attr->name) return 'GUEST';
                return $attr->name . ' ' . $attr->last_name;
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='#'>Edit</a>
                    <a class='btn btn-danger' href=''>x</a>
                    </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getBackendActivity()
    {

        return Datatables::of(ActivityLogs::all())
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at, 'd M Y H:i:s');
            })->editColumn('user_name', function ($attr) {

                return $attr->user()->name;
            })->editColumn('user_last_name', function ($attr) {
                return $attr->user()->last_name;
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='#'>Edit</a>
                    <a class='btn btn-danger' href=''>x</a>
                    </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllOrders()
    {
        return Datatables::of(
            Orders::leftJoin('orders_addresses', 'orders.id', '=', 'orders_addresses.order_id')
                ->select('orders.*', 'orders_addresses.country', 'orders_addresses.region', 'orders_addresses.city')
        )
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('status', function ($attr) {
                $status = $attr->history()->whereNotNull('status_id')->latest()->first();
                return ($status && $status->status) ?
                    '<span class="badge badge-secondary" style="background-color: ' . $status->status->color . '">' . $status->status->name . '</span>' : null;
            })->editColumn('updated_at', function ($attr) {
                return BBgetDateFormat($attr->updated_at);
            })->editColumn('user', function ($attr) {
                return $attr->user->name . ' ' . $attr->user->last_name;
            })
            ->editColumn('type', function ($attr) {
                return ($attr->type) ? "Wholesaler" : "User";
            })
            ->addColumn('actions', function ($post) {
                return (userCan('admin_orders_manage')) ?
                    "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='" . route('admin_orders_edit', $post->id) . "'>Edit</a>
                    <a class='btn btn-info' href='" . route('admin_orders_manage', $post->id) . "'>Activity</a>
                    </div>" : '';
            })->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function getAllOrdersInvoice()
    {
        return Datatables::of(
            OrderInvoice::leftJoin('order_invoice_addresses', 'order_invoices.id', '=', 'order_invoice_addresses.order_id')
                ->select('order_invoices.*', 'order_invoice_addresses.country', 'order_invoice_addresses.region', 'order_invoice_addresses.city')
        )
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('status', function ($attr) {
                $status = $attr->history()->whereNotNull('status_id')->latest()->first();
                return ($status && $status->status) ?
                    '<span class="badge badge-secondary" style="background-color: ' . $status->status->color . '">' . $status->status->name . '</span>' : null;
            })->editColumn('updated_at', function ($attr) {
                return BBgetDateFormat($attr->updated_at);
            })->editColumn('user', function ($attr) {
                return $attr->user->name . ' ' . $attr->user->last_name;
            })
            ->editColumn('type', function ($attr) {
                return ($attr->type) ? "Wholesaler" : "User";
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>" . (userCan('admin_orders_invoice_edit') ? "<a class='btn btn-warning' href='" . route('admin_orders_invoice_edit', $post->id) . "'>Edit</a>" : null) . "</div>";
            })->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function getAllStatuses()
    {
        return Datatables::of(Statuses::query())
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('name', function ($attr) {
                return $attr->name;
            })->editColumn('description', function ($attr) {
                return $attr->description;
            })
            ->addColumn('actions', function ($attr) {
                return "<div class='datatable-td__action'>
                    <a class='btn btn-warning' href='" . route('admin_stock_statuses_manage', $attr->id) . "'>Edit</a>
                    <a class='btn btn-danger' href=''>x</a>
                    </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getBulkPosts(Settings $settings)
    {
        $general = $settings->getEditableData('seo_posts')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_posts')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_posts')->toArray();
        $robot = $settings->getEditableData('seo_robot_posts');
        return Datatables::of(Posts::query())
            ->addColumn('post_title', function ($post) use ($general) {
                return $post->title;
            })
            ->editColumn('title', function ($post) use ($general) {

                return ($post->getSeoField('title')) ? $post->getSeoField('title') : getSeo($general, 'og:title', $post);
            })
            ->addColumn('image', function ($post) use ($general) {
                return ($post->getSeoField('image')) ? "<img src='" . $post->getSeoField('image') . "' width='50px'/>" : "<img src='" . getSeo($general, 'og:image', $post) . "' width='50px'/>";
            })
            ->addColumn('description', function ($post) use ($general) {
                return ($post->getSeoField('description')) ? $post->getSeoField('description') : getSeo($general, 'og:description', $post);
            })
            ->addColumn('keywords', function ($post) use ($general) {
                return ($post->getSeoField('keywords')) ? $post->getSeoField('keywords') : getSeo($general, 'og:keywords', $post);
            })
            ->addColumn('fb_title', function ($post) use ($fbSeo) {
                return ($post->getSeoField('fb_title', 'fb')) ? $post->getSeoField('fb_title', 'fb') : getSeo($fbSeo, 'og:title', $post);
            })
            ->addColumn('fb_description', function ($post) use ($fbSeo) {
                return ($post->getSeoField('fb_description', 'fb')) ? $post->getSeoField('fb_description', 'fb') : getSeo($fbSeo, 'og:description', $post);
            })
            ->addColumn('fb_image', function ($post) use ($fbSeo) {
                return ($post->getSeoField('fb_image', 'fb')) ? $post->getSeoField('fb_image', 'fb') : "<img src='" . getSeo($fbSeo, 'og:image', $post) . "' width='50px'/>";
            })
            ->addColumn('twitter_title', function ($post) use ($twitterSeo) {
                return ($post->getSeoField('twitter_title', 'twitter')) ? $post->getSeoField('twitter_title', 'twitter') : getSeo($twitterSeo, 'og:title', $post);
            })
            ->addColumn('twitter_description', function ($post) use ($twitterSeo) {
                return ($post->getSeoField('twitter_description', 'twitter')) ? $post->getSeoField('twitter_description', 'twitter') : getSeo($twitterSeo, 'og:description', $post);
            })
            ->addColumn('twitter_image', function ($post) use ($twitterSeo) {
                return ($post->getSeoField('twitter_image', 'twitter')) ? $post->getSeoField('twitter_image', 'twitter') : "<img src='" . getSeo($twitterSeo, 'og:image', $post) . "' width='50px'/>";;
            })->addColumn('robots', function ($post) {
                return "";
            })->addColumn('actions', function ($post) {
                return userCan('admin_seo_bulk_edit_post') ? "<div class='datatable-td__action'><a class='btn btn-info' href='" . route('post_admin_seo_post_edit_row_many', $post->id) . "'>Edit Fast</a><a class='btn btn-warning' href='" . route('admin_seo_bulk_edit_post', $post->id) . "'>Edit</a></div>" : null;
            })
            ->rawColumns(['actions', 'name', 'image', 'fb_image', 'twitter_image'])
            ->make(true);
    }

    public function getBulkBrands(Settings $settings)
    {
        $general = $settings->getEditableData('seo_brand')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_brand')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_brand')->toArray();
        $robot = $settings->getEditableData('seo_robot_brand');
        return Datatables::of(Category::where('type', 'brands'))
            ->addColumn('brand_name', function ($brand) use ($general) {
                return $brand->name;
            })
            ->editColumn('title', function ($brand) use ($general) {

                return ($brand->getSeoField('title')) ? $brand->getSeoField('title') : getSeo($general, 'og:title', $brand);
            })
            ->addColumn('image', function ($brand) use ($general) {
                return ($brand->getSeoField('image')) ? "<img src='" . $brand->getSeoField('image') . "' width='50px'/>" : "<img src='" . getSeo($general, 'og:image', $brand) . "' width='50px'/>";
            })
            ->addColumn('description', function ($brand) use ($general) {
                return ($brand->getSeoField('description')) ? $brand->getSeoField('description') : getSeo($general, 'og:description', $brand);
            })
            ->addColumn('keywords', function ($brand) use ($general) {
                return ($brand->getSeoField('keywords')) ? $brand->getSeoField('keywords') : getSeo($general, 'og:keywords', $brand);
            })
            ->addColumn('fb_title', function ($brand) use ($fbSeo) {
                return ($brand->getSeoField('fb_title', 'fb')) ? $brand->getSeoField('fb_title', 'fb') : getSeo($fbSeo, 'og:title', $brand);
            })
            ->addColumn('fb_description', function ($brand) use ($fbSeo) {
                return ($brand->getSeoField('fb_description', 'fb')) ? $brand->getSeoField('fb_description', 'fb') : getSeo($fbSeo, 'og:description', $brand);
            })
            ->addColumn('fb_image', function ($brand) use ($fbSeo) {
                return ($brand->getSeoField('fb_image', 'fb')) ? $brand->getSeoField('fb_image', 'fb') : "<img src='" . getSeo($fbSeo, 'og:image', $brand) . "' width='50px'/>";
            })
            ->addColumn('twitter_title', function ($brand) use ($twitterSeo) {
                return ($brand->getSeoField('twitter_title', 'twitter')) ? $brand->getSeoField('twitter_title', 'twitter') : getSeo($twitterSeo, 'og:title', $brand);
            })
            ->addColumn('twitter_description', function ($brand) use ($twitterSeo) {
                return ($brand->getSeoField('twitter_description', 'twitter')) ? $brand->getSeoField('twitter_description', 'twitter') : getSeo($twitterSeo, 'og:description', $brand);
            })
            ->addColumn('twitter_image', function ($brand) use ($twitterSeo) {
                return ($brand->getSeoField('twitter_image', 'twitter')) ? $brand->getSeoField('twitter_image', 'twitter') : "<img src='" . getSeo($twitterSeo, 'og:image', $brand) . "' width='50px'/>";;
            })->addColumn('robots', function ($brand) {
                return "";
            })->addColumn('actions', function ($brand) {
                return userCan('admin_seo_bulk_edit_post') ? "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_seo_bulk_edit_post', $brand->id) . "'>Edit</a></div>" : null;
            })
            ->rawColumns(['actions', 'name', 'image', 'fb_image', 'twitter_image'])
            ->make(true);
    }

    public function getBulkStock(Settings $settings)
    {
        $general = $settings->getEditableData('seo_stocks')->toArray();
        $twitterSeo = $settings->getEditableData('seo_twitter_stocks')->toArray();
        $fbSeo = $settings->getEditableData('seo_fb_stocks')->toArray();
        $robot = $settings->getEditableData('seo_robot_stocks');

        return Datatables::of(
            Stock::join('stock_translations', 'stock_translations.stock_id', 'stocks.id')->where('locale', app()->getLocale())->select('stocks.*', 'stock_translations.name')
        )
            ->editColumn('title', function ($stock) use ($general) {
                return ($stock->getSeoField('title')) ? $stock->getSeoField('title') : getSeo($general, 'og:title', $stock);
            })
            ->addColumn('image', function ($stock) use ($general) {
                return ($stock->getSeoField('image')) ? "<img src='" . $stock->getSeoField('image') . "' width='50px'/>" : "<img src='" . getSeo($general, 'og:image', $stock) . "' width='50px'/>";
            })
            ->addColumn('description', function ($stock) use ($general) {
                return ($stock->getSeoField('description')) ? $stock->getSeoField('description') : getSeo($general, 'og:description', $stock);
            })
            ->addColumn('keywords', function ($stock) use ($general) {
                return ($stock->getSeoField('keywords')) ? $stock->getSeoField('keywords') : getSeo($general, 'og:keywords', $stock);
            })
            ->addColumn('fb_title', function ($stock) use ($fbSeo) {
                return ($stock->getSeoField('fb_title', 'fb')) ? $stock->getSeoField('fb_title', 'fb') : getSeo($fbSeo, 'og:title', $stock);
            })
            ->addColumn('fb_description', function ($stock) use ($fbSeo) {
                return ($stock->getSeoField('fb_description', 'fb')) ? $stock->getSeoField('fb_description', 'fb') : getSeo($fbSeo, 'og:description', $stock);
            })
            ->addColumn('fb_image', function ($stock) use ($fbSeo) {
                return ($stock->getSeoField('fb_image', 'fb')) ? $stock->getSeoField('fb_image', 'fb') : "<img src='" . getSeo($fbSeo, 'og:image', $stock) . "' width='50px'/>";
            })
            ->addColumn('twitter_title', function ($stock) use ($twitterSeo) {
                return ($stock->getSeoField('twitter_title', 'twitter')) ? $stock->getSeoField('twitter_title', 'twitter') : getSeo($twitterSeo, 'og:title', $stock);
            })
            ->addColumn('twitter_description', function ($stock) use ($twitterSeo) {
                return ($stock->getSeoField('twitter_description', 'twitter')) ? $stock->getSeoField('twitter_description', 'twitter') : getSeo($twitterSeo, 'og:description', $stock);
            })
            ->addColumn('twitter_image', function ($stock) use ($twitterSeo) {
                return ($stock->getSeoField('twitter_image', 'twitter')) ? $stock->getSeoField('twitter_image', 'twitter') : "<img src='" . getSeo($twitterSeo, 'og:image', $stock) . "' width='50px'/>";;
            })->addColumn('robots', function ($stock) {
                return "";
            })->addColumn('actions', function ($stock) {
                return (userCan('admin_seo_bulk_edit_stock')) ? "<div class='datatable-td__action'><a class='btn btn-info' href='" . route('post_admin_seo_stock_edit_row_many', $stock->id) . "'>Edit Fast</a><a class='btn btn-warning' href='" . route('admin_seo_bulk_edit_stock', $stock->id) . "'>Edit</a></div>" : null;
            })
            ->rawColumns(['actions', 'name', 'image', 'fb_image', 'twitter_image'])
            ->make(true);
    }

    public function getTickets()
    {
        return Datatables::of(Ticket::query())
            ->editColumn('user_id', function ($ticket) {
                return $ticket->author->name;
            })->editColumn('status_id', function ($ticket) {
                return "<span style='background: " . @$ticket->status->color . "' class='badge'>" . @$ticket->status->name . "</span>";
            })->editColumn('priority_id', function ($ticket) {
                return "<span style='background: " . @$ticket->priority->color . "' class='badge'>" . @$ticket->priority->name . "</span>";
            })->editColumn('category_id', function ($ticket) {
                return $ticket->category->name;
            })->editColumn('tags', function ($ticket) {
                return '';
            })
            ->editColumn('created_at', function ($ticket) {
                return BBgetDateFormat($ticket->created_at) . ' ' . BBgetTimeFormat($ticket->created_at);
            })->editColumn('attachments', function ($ticket) {
                return "<span class='badge'>" . count($ticket->attachments) . "</span>";
            })
            ->addColumn('actions', function ($ticket) {
                $settings = new Settings();
                $status = $settings->getData('tickets', 'completed');
                $actions = userCan('admin_tickets_edit') ? "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_tickets_edit', $ticket->id) . "'>Edit</a>" : null;
                if ($status && $status->val != $ticket->status_id) {
                    $actions .= userCan('admin_tickets_close') ? "<a class='btn btn-danger' href='" . route('admin_tickets_close', $ticket->id) . "'>Close</a></div>" : null;
                }
                return $actions;
            })->rawColumns(['actions', 'priority_id', 'status_id', 'attachments'])
            ->make(true);
    }

    public function getFaq()
    {
        return Datatables::of(Faq::query())
            ->editColumn('question', function ($faq) {
                return $faq->question;
            })->editColumn('answer', function ($faq) {
                return '<div class="faq-ansver">' . $faq->answer . '</div>';
            })
            ->editColumn('user_id', function ($faq) {
                return $faq->author->name;
            })->editColumn('status', function ($faq) {
                return ($faq->status) ? '<span class="badge btn-success">published</span>' : '<span class="badge btn-danger">draft</span>';
            })
            ->editColumn('created_at', function ($faq) {
                return BBgetDateFormat($faq->created_at);
            })
            ->addColumn('actions', function ($faq) {
                return "<div class='datatable-td__action'>"
                    . (userCan('admin_faq_edit') ? "<a class='btn btn-warning' href='" . route("admin_faq_edit", $faq->id) . "'>Edit</a>" : null)
                    . (userCan('admin_faq_delete') ? "
                        <a class='btn btn-danger delete-button' data-key='" . $faq->id . "' data-href='" . route("admin_faq_delete") . "'>x</a>" : null)
                    . '</div>';
            })->rawColumns(['actions', 'question', 'answer', 'created_at', 'status'])
            ->make(true);
    }


    public function getPurchases()
    {
        return Datatables::of(Purchase::query())
            ->editColumn('user_id', function ($faq) {
                return $faq->user->name;
            })->addColumn('name', function ($attr) {
                return ($attr->item) ? $attr->item->name : null;
            })->addColumn('sku', function ($attr) {
                return ($attr->item) ? $attr->item->sku : null;
            })->editColumn('created_at', function ($faq) {
                return BBgetDateFormat($faq->created_at);
            })->editColumn('purchase_date', function ($faq) {
                return BBgetDateFormat($faq->purchase_date);
            })
            ->addColumn('actions', function ($faq) {
                $html = "<div class='datatable-td__action'>";
                if (userCan('admin_inventory_purchase_edit')) {
                    $html .= "<a class='btn btn-warning' href='" . route("admin_inventory_purchase_edit", $faq->id) . "'>Edit</a>";
                }
                $html .= "</div>";
                return $html;
            })->rawColumns(['actions', 'question', 'answer', 'created_at', 'status'])
            ->make(true);
    }

    public function getItemPurchases($item_id)
    {

        return Datatables::of(Purchase::where('item_id', $item_id))
            ->editColumn('user_id', function ($faq) {
                return $faq->user->name;
            })->editColumn('sku', function ($attr) {
                return $attr->item->sku;
            })->editColumn('created_at', function ($faq) {
                return BBgetDateFormat($faq->created_at);
            })->editColumn('purchase_date', function ($faq) {
                return BBgetDateFormat($faq->purchase_date);
            })
            ->addColumn('actions', function ($faq) {
                return "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route("admin_inventory_purchase_edit", $faq->id) . "'>Edit</a></div>";
            })->rawColumns(['actions', 'question', 'answer', 'created_at', 'status'])
            ->make(true);
    }

    public function getItemOthers($item_id)
    {
        return Datatables::of(Others::where('item_id', $item_id)->where('reason', '!=', 'sold'))
            ->editColumn('user_id', function ($faq) {
                return $faq->user->name;
            })->editColumn('sku', function ($attr) {
                return $attr->item->sku;
            })->editColumn('created_at', function ($faq) {
                return BBgetDateFormat($faq->created_at);
            })->editColumn('purchase_date', function ($faq) {
                return BBgetDateFormat($faq->purchase_date);
            })
            ->addColumn('actions', function ($faq) {
                return "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route("admin_inventory_purchase_edit", $faq->id) . "'>Edit</a></div>";
            })->rawColumns(['actions', 'question', 'answer', 'created_at', 'status'])
            ->make(true);
    }

    public function getItemSales($item_id)
    {
        return Datatables::of(Others::where('item_id', $item_id)->where('reason', '=', 'sold'))
            ->editColumn('user_id', function ($faq) {
                return $faq->user->name;
            })->editColumn('sku', function ($attr) {
                return $attr->item->sku;
            })->editColumn('created_at', function ($faq) {
                return BBgetDateFormat($faq->created_at);
            })->editColumn('purchase_date', function ($faq) {
                return BBgetDateFormat($faq->purchase_date);
            })
            ->addColumn('actions', function ($faq) {
                return "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route("admin_inventory_purchase_edit", $faq->id) . "'>Edit</a></div>";
            })->rawColumns(['actions', 'question', 'answer', 'created_at', 'status'])
            ->make(true);
    }

    public function getUserOrders($user_id)
    {
        return Datatables::of(
            Orders::leftJoin('orders_addresses', 'orders.id', '=', 'orders_addresses.order_id')
                ->select('orders.*', 'orders_addresses.country', 'orders_addresses.region', 'orders_addresses.city')->where('user_id', $user_id)
        )
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('status', function ($attr) {
                $history = $attr->history()->whereNotNull('status_id')->latest()->first();
                return ($history && $history->status) ?
                    '<span class="badge" style="background-color: ' . $history->status->color . '">' . $history->status->name . '</span>' : null;
            })->editColumn('updated_at', function ($attr) {
                return BBgetDateFormat($attr->updated_at);
            })->editColumn('user', function ($attr) {
                return $attr->user->name . ' ' . $attr->user->last_name;
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_orders_manage', $post->id) . "'>Edit</a></div>";
            })->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function getAllItems()
    {
        return Datatables::of(Items::leftJoin('item_translations', 'items.id', '=', 'item_translations.items_id')
            ->leftJoin('barcodes', 'items.barcode_id', '=', 'barcodes.id')
            ->leftJoin('categories', 'items.brand_id', '=', 'categories.id')
            ->leftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
            ->select('items.*', 'item_translations.name', 'item_translations.short_description', 'barcodes.code',
                'categories_translations.name as category')
            ->groupBy('items.id')
            ->where('items.is_archive', false)
            ->where('item_translations.locale', \Lang::getLocale()))
            ->editColumn('category', function ($attr) {
                $str = '';
                if ($attr->categories && count($attr->categories)) {
                    foreach ($attr->categories as $category) {
                        $str .= "<span class='badge badge-dark'>" . $category->name . "</span>";
                    }
                }
                return $str;
            })->addColumn('quantity', function ($attr) {
                return ($attr->type == 'simple') ? $attr->purchase()->sum('qty') - $attr->others()->sum('qty') : 'N/A';
            })
            ->addColumn('barcode_id', function ($attr) {
                return ($attr->barcode) ? $attr->barcode->code : 'no barcode';
            })
            ->editColumn('brand_id', function ($attr) {
                $brand = Category::find($attr->brand_id);
                return ($brand) ? $brand->name : 'no brand';
            })->editColumn('status', function ($attr) {
                return ($attr->status) ? "Active" : 'Draft';
            })->editColumn('long_description', function ($attr) {
                return $attr->long_description;
            })->addColumn('actions', function ($attr) {
                return "<div class='datatable-td__action'>"
                    . (userCan('admin_items_edit') ? "<a class='btn edit-row' style='background-color: #86caff;color:black' data-id='" . $attr->id . "'><i class='fa fa-road'></i></a>" : null)
                    . (userCan('admin_items_edit') ? "<a class='btn btn-warning' href='" . route('admin_items_edit', $attr->id) . "'>Edit</a>" : null)
                    . (userCan('admin_items_purchase') ? "<a class='btn btn-info' href='" . route('admin_items_purchase', $attr->id) . "'>Activity</a>" : null)
                    . (userCan('admin_items_archive') ? "<a class='btn btn-danger' href='" . route('admin_items_archive', $attr->id) . "'>x</a>" : null)
                    . "</div>";
            })->rawColumns(['actions', 'category'])->make(true);
    }

    public function getAllAppItems($id)
    {
        return Datatables::of(AppItems::join('items', 'app_items.item_id', '=', 'items.id')
            ->leftJoin('item_translations', 'items.id', '=', 'item_translations.items_id')
            ->leftJoin('barcodes', 'items.barcode_id', '=', 'barcodes.id')
            ->leftJoin('categories', 'items.brand_id', '=', 'categories.id')
            ->leftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
            ->select(
                'items.barcode_id',
                'app_items.id',
                'items.brand_id',
                'app_items.status',
                'app_items.price',
                'app_items.created_at',
                'app_items.item_id',
                'item_translations.name',
                'item_translations.short_description',
                'barcodes.code',
                'categories_translations.name as category')
            ->groupBy('items.id')
            ->where('app_items.warehouse_id', $id)
            ->where('items.is_archive', false)->with('item')
            ->where('item_translations.locale', \Lang::getLocale()))
            ->editColumn('category', function ($attr) {
                $str = '';
                $item = $attr->item;
                if ($item->categories && count($item->categories)) {
                    foreach ($item->categories as $category) {
                        $str .= "<span class='badge badge-dark'>" . $category->name . "</span>";
                    }
                }
                return $str;
            })->addColumn('quantity', function ($attr) use ($id) {
                $item = $attr->item;
                return ($item->type == 'simple') ? $item->locations()->where('warehouse_id', $id)->sum('qty') : 'N/A';
            })
            ->addColumn('barcode_id', function ($attr) {
                return ($attr->barcode) ? $attr->barcode->code : 'no barcode';
            })
            ->editColumn('brand_id', function ($attr) {
                $brand = Category::find($attr->brand_id);
                return ($brand) ? $brand->name : 'no brand';
            })->editColumn('status', function ($attr) {
                return ($attr->status) ? "Active" : 'Draft';
            })->editColumn('long_description', function ($attr) {
                return $attr->long_description;
            })->addColumn('actions', function ($attr) {
                return "<div class='datatable-td__action'>"
                    . (userCan('admin_items_edit') ? "<a class='btn btn-warning edit_price_js' data-id='".$attr->id."' data-name='".$attr->name."' data-price='".$attr->price."' href='#'>Edit Price</a>" : null) .
                      (userCan('admin_items_edit') ? ($attr->status)?"<button class='btn btn-danger app-product-status' data-href='".route('admin_app_draft_product',$attr->id)."'>Draft</button>":"<button class='btn btn-info app-product-status' data-href='".route('admin_app_activate_product',$attr->id)."'>Activate</button>" : null) .
                    "</div>";
            })->rawColumns(['actions', 'category'])->make(true);
    }

    public function getAllItemsInModal()
    {
        return Datatables::of(Items::leftJoin('item_translations', 'items.id', '=', 'item_translations.items_id')
            ->leftJoin('barcodes', 'items.barcode_id', '=', 'barcodes.id')
            ->leftJoin('categories', 'items.brand_id', '=', 'categories.id')
            ->leftJoin('categories_translations', 'categories.id', '=', 'categories_translations.category_id')
            ->select('items.*', 'item_translations.name', 'item_translations.short_description', 'barcodes.code', 'categories_translations.name')
            ->where('items.is_archive', false)
            ->where('item_translations.locale', \Lang::getLocale()))
            ->editColumn('brand_id', function ($attr) {
                $brand = Category::find($attr->brand_id);
                return ($brand) ? $brand->name : 'no brand';
            })->rawColumns(['category'])->make(true);
    }

    public function getAllItemsArchived()
    {
        return Datatables::of(Items::archive())
            ->editColumn('name', function ($attr) {
                return $attr->name;
            })->editColumn('short_description', function ($attr) {
                return $attr->short_description;
            })->addColumn('quantity', function ($attr) {
                return ($attr->type == 'simple') ? $attr->purchase()->sum('qty') - $attr->others()->sum('qty') : 'N/A';
            })->editColumn('barcode_id', function ($attr) {
                return ($attr->barcode) ? $attr->barcode->code : 'no barcode';
            })->editColumn('long_description', function ($attr) {
                return $attr->long_description;
            })->addColumn('actions', function ($attr) {
                return "<div class='datatable-td__action'>
            <a class='btn btn-warning' href='" . route('admin_items_edit', $attr->id) . "'>Edit</a>
            <a class='btn btn-info' href='" . route('admin_items_purchase', $attr->id) . "'>Activity</a>
            <a class='btn btn-success' href='" . route('admin_items_activate', $attr->id) . "'><i class='fa fa-arrow-circle-left'></i></a>
            </div>";
            })->rawColumns(['actions'])->make(true);
    }

    public function getAllSuppliers()
    {
        return Datatables::of(Suppliers::query())
            ->editColumn('created_at', function ($faq) {
                return BBgetDateFormat($faq->created_at);
            })
            ->addColumn('actions', function ($attr) {
                return (userCan('admin_suppliers_edit')) ? "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_suppliers_edit', $attr->id) . "'>Edit</a></div>" : '';
            })->rawColumns(['actions'])->make(true);
    }

    public function getAllOthers($id = null)
    {
        if (!$id) {
            $array = collect(json_decode(json_encode(\DB::select('SELECT MAX(id) as id FROM others GROUP BY `grouped`'), true), true))->pluck('id');
            return Datatables::of(
                Others::whereIn('id', $array)
            )
                ->editColumn('item_id', function ($other) {
                    return $other->item->name;
                })->editColumn('user_id', function ($other) {
                    return $other->user->name . ' ' . $other->user->last_name;
                })->editColumn('created_at', function ($faq) {
                    return BBgetDateFormat($faq->created_at);
                })->editColumn('updated_at', function ($faq) {
                    return BBgetDateFormat($faq->created_at);
                })
                ->addColumn('actions', function ($attr) {
                    return userCan('admin_inventory_others_edit') ? "<div class='datatable-td__action'>
                        <a class='btn btn-warning' href='" . route('admin_inventory_others_edit', $attr->id) . "'>Edit</a>
</div>" : null;
                })->rawColumns(['actions'])->make(true);
        } else {
            $other = Others::find($id);
            return Datatables::of(
                Others::where('grouped', $other->grouped)
            )
                ->editColumn('item_id', function ($other) {
                    return $other->item->name;
                })->editColumn('user_id', function ($other) {
                    return $other->user->name . ' ' . $other->user->last_name;
                })->editColumn('created_at', function ($faq) {
                    return BBgetDateFormat($faq->created_at);
                })->editColumn('updated_at', function ($faq) {
                    return BBgetDateFormat($faq->created_at);
                })->make(true);
        }

    }

    public function getAllCustomEmails()
    {

        return DataTables::of(CustomEmails::query()->where("is_for_admin", "=", "0"))
            ->editColumn('status', function ($message) {
                return $message->status ? 'sent out' : 'in progress';
            })->editColumn('category_id', function ($message) {
                return ($message->category) ? $message->category->name : '';
            })
            ->editColumn('created_at', function ($message) {

                return BBgetDateFormat($message->created_at);
            })->addColumn('actions', function ($message) {
                return (!$message->status ? '<button class="btn btn-success send-now" data-id="' . $message->id . '">Send Now</button>
<a href="' . route('edit_admin_emails_notifications_send_email', $message->id) . '" class="btn btn-danger">Edit</a>' : '<button class="btn btn-info copy-message" data-id="' . $message->id . '">Copy</button><a href="' . route('view_admin_emails_notifications_send_email', $message->id) . '" class="btn btn-warning"><i class="fa fa-eye"></i></a>');
            })->rawColumns(['actions'])->make(true);
    }

    public function getAllTransactions()
    {
        return Datatables::of(
            Transaction::query()
        )
            ->editColumn('date', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('time', function ($attr) {
                return BBgetTimeFormat($attr->created_at);
            })->editColumn('user', function ($attr) {
                return $attr->user->name . ' ' . $attr->user->last_name;
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>
<a class='btn btn-info' href='" . route('admin_store_transactions_view', $post->id) . "'><i class='fa fa-eye'></i></a>
</div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllNewsletters()
    {
        return Datatables::of(
            Newsletter::query()
        )
            ->editColumn('created_at', function ($attr) {
                return BBgetDateFormat($attr->created_at);
            })->editColumn('user_id', function ($attr) {
                return ($attr->user) ? $attr->user->name . ' ' . $attr->user->last_name : 'Not member';
            })->editColumn('category_id', function ($attr) {
                return ($attr->category) ? $attr->category->name : '';
            })
            ->addColumn('actions', function ($post) {
                return "<div class='datatable-td__action'>
                        <a class='btn btn-danger delete-button' data-key='$post->id' data-href='" . route('admin_emails_newsletter_delete') . "'>x</a>
                        </div>";
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllBarcodes()
    {
        return Datatables::of(
            Barcodes::leftJoin('items', 'items.barcode_id', '=', 'barcodes.id')
                ->leftJoin('item_translations', 'items.id', '=', 'item_translations.items_id')
                ->where('item_translations.locale', app()->getLocale())->select('barcodes.*', 'item_translations.name as item_name')
        )
            ->editColumn('barcode', function ($barcode) {
                return '<svg id="code_' . $barcode->code . '" data-name="' . $barcode->item_name . '" class="barcodes" data-barcode="' . $barcode->code . '" width="200px"></svg>';
            })
            ->addColumn('actions', function ($code) {
                return "<div class='datatable-td__action'>
                <a class='btn btn-info' href='" . route('admin_inventory_barcode_view', $code->id) . "'>Activity</a>
                <a class='btn btn-primary printB' href='javascript:void(0)' data-id='" . $code->id . "' >Print</a>" . (userCan('admin_inventory_barcode_delete') ? "
                <a class='btn btn-danger delete-button' data-key='$code->id' data-href='" . route('admin_inventory_barcode_delete') . "'>x</a>" : null) . "</div>";
            })->rawColumns(['actions', 'item', 'barcode'])
            ->make(true);
    }

    public function getCampaigns()
    {
        return Datatables::of(
            Campaign::query()
        )->editColumn('created_at', function ($faq) {
            return BBgetDateFormat($faq->created_at);
        })->addColumn('actions', function ($attr) {
            $html = userCan('admin_campaign_edit') ? "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_campaign_edit', $attr->id) . "'>Edit</a>" : '';
            return $html .= userCan('admin_campaign_delete') ? '<a href="javascript:void(0)" data-href="' . route("admin_campaign_delete") . '"
                class="delete-button btn btn-danger" data-key="' . $attr->id . '">x</a></div>' : null;
        })->rawColumns(['actions'])->make(true);
    }

    public function getAllChannelCustomers($id = null)
    {
        return Datatables::of(
            User::query()
        )->make(true);
    }

    public function getAllFilters()
    {
        return Datatables::of(
            Category::where('type', 'filter')
        )->editColumn('created_at', function ($faq) {
            return BBgetDateFormat($faq->created_at);
        })->addColumn('actions', function ($attr) {
            $html = "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_tools_filters_manage', $attr->id) . "'>Edit</a>";
            return $html .= '<a href="javascript:void(0)" data-href="#" class="delete-button btn btn-danger" data-key="' . $attr->id . '">x</a></div>';
        })->rawColumns(['actions'])->make(true);
    }

    public function getAllWarehouses()
    {
        return Datatables::of(
            Warehouse::query()
        )->editColumn('created_at', function ($faq) {
            return BBgetDateFormat($faq->created_at);
        })
            ->editColumn('image', function ($attr) {
                return ($attr->image) ? "<img src='$attr->image' class='img img-responsive' width='100px'/>" : "No image";
            })
            ->addColumn('actions', function ($attr) {
                $html = "<div class='datatable-td__action'>";
                $html .= userCan('admin_warehouses_edit') ? "<a class='btn btn-warning' href='" . route('admin_warehouses_edit', $attr->id) . "'>Edit</a>" : '';
                $html .= userCan('admin_warehouses_manage') ? '<a href="' . route("admin_warehouses_manage", $attr->id) . '" class="btn btn-info" >Activity</a>' : null;
                $html .= userCan('admin_warehouses_delete') ? '<a href="javascript:void(0)" data-href="' . route("admin_warehouses_delete") . '" class="delete-button btn btn-danger" data-key="' . $attr->id . '">x</a>' : null;
                $html .= "</div>";
                return $html;

            })->rawColumns(['actions', 'image'])->make(true);
    }

    public function getAllPromotions()
    {
        return Datatables::of(
            StockSales::query()
        )->editColumn('id', function ($item) {
            return "id";
        })->editColumn('start_date', function ($item) {
            return BBgetDateFormat($item->start_date);
        })->editColumn('end_date', function ($item) {
            return BBgetDateFormat($item->end_date);
        })
            ->editColumn('stock_id', function ($item) {
                return $item->stock->name;
            })
            ->editColumn('canceled', function ($attr) {
                return ($attr->canceled) ? "YES" : "No";
            })
            ->addColumn('actions', function ($attr) {
                return '';
//                $html = '<a href="'.route("admin_warehouses_manage",$attr->id).'"
//                class="badge btn-info" ><i class="fa fa-eye"></i></a>';
//                $html .= '<a href="javascript:void(0)" data-href="'.route("admin_warehouses_delete").'"
//                class="delete-button badge btn-danger" data-key="' . $attr->id . '"><i class="fa fa-trash"></i></a>';
//                return $html .= "<a class='badge btn-warning' href='" . route('admin_warehouses_edit', $attr->id) . "'><i class='fa fa-edit'></i></a>";
            })->rawColumns(['actions', 'canceled'])->make(true);
    }

    public function getAllLandings()
    {
        return Datatables::of(
            Landing::query()
        )->editColumn('url', function ($item) {
            return "<a href='/landings/$item->url' target='_blank'>/landings/" . $item->url . "</a>";
        })->editColumn('created_at', function ($item) {
            return BBgetDateFormat($item->created_at);
        })
            ->addColumn('actions', function ($attr) {
                $html = "<div class='datatable-td__action'><a class='btn btn-warning' href='" . route('admin_landings_edit', $attr->id) . "'>Edit</a>";
                return $html .= '<a href="javascript:void(0)" data-href="' . route("admin_landings_delete") . '"
                class="delete-button btn btn-danger" data-key="' . $attr->id . '">x</a></div>';
            })->rawColumns(['actions', 'url'])->make(true);
    }

    public function getAllTransfers()
    {
        return Datatables::of(
            ItemsTransfers::query()
        )->editColumn('user_id', function ($item) {
            return $item->user->name . " " . $item->user->last_name;
        })->editColumn('item_id', function ($item) {
            return $item->item->name;
        })->editColumn('from_id', function ($item) {
            return $item->from->transfer_location;
        })->editColumn('to_id', function ($item) {
            return $item->to->transfer_location;
        })->editColumn('created_at', function ($item) {
            return BBgetDateFormat($item->created_at);
        })
            ->rawColumns([])->make(true);
    }

    public function getAllReviews()
    {
        return Datatables::of(
            Review::query()
        )->editColumn('user_id', function ($item) {
            return $item->user->name . " " . $item->user->last_name;
        })->editColumn('item_id', function ($item) {
            return $item->item->name;
        })->editColumn('order_id', function ($item) {
            return $item->order->order_number;
        })->editColumn('status', function ($item) {
            $status = "";
            switch ($item->status) {
                case ReviewStatusTypes::BLOCKED:
                    $status = "<span class='alert alert-danger'>BLOCKED</span>";
                    break;
                case ReviewStatusTypes::PUBLISHED:
                    $status = "<span class='alert alert-success'>PUBLISHED</span>";
                    break;
                case ReviewStatusTypes::SUBMITTED:
                    $status = "<span class='alert alert-primary'>SUBMITTED</span>";

                    break;
                case ReviewStatusTypes::ALLOW_EDIT:
                    $status = "<span class='alert alert-warning'>ALLOWED EDIT</span>";
                    break;
                case ReviewStatusTypes::RESUBMITTED:
                    $status = "<span class='alert alert-primary'>RESUBMITTED</span>";
                    break;
            }

            return $status;
        })->editColumn('created_at', function ($item) {
            return BBgetDateFormat($item->created_at);
        })->editColumn('actions', function ($item) {
            $status = "";
            if (userCan('admin_users_allow_edit_review')) {
                switch ($item->status) {
                    case ReviewStatusTypes::BLOCKED:
                        $status = "<a href='" . route('admin_users_approve_review', $item->id) . "' class='btn btn-success'>Publish</a>" .
                            "<a href='" . route('admin_users_allow_edit_review', $item->id) . "' class='btn btn-warning'>Allow Edit</a>";
                        break;
                    case ReviewStatusTypes::PUBLISHED:
                        $status = "<a href='" . route('admin_users_disable_review', $item->id) . "' class='btn btn-danger'>Block</a>" .
                            "<a href='" . route('admin_users_allow_edit_review', $item->id) . "' class='btn btn-warning'>Allow Edit</a>";
                        break;
                    case ReviewStatusTypes::SUBMITTED:
                        $status = "<a href='" . route('admin_users_approve_review', $item->id) . "' class='btn btn-success'>Publish</a>" .
                            "<a href='" . route('admin_users_disable_review', $item->id) . "' class='btn btn-danger'>Block</a>" .
                            "<a href='" . route('admin_users_allow_edit_review', $item->id) . "' class='btn btn-warning'>Allow Edit</a>";
                        break;
                    case ReviewStatusTypes::ALLOW_EDIT:
                        $status = "<a href='" . route('admin_users_disable_review', $item->id) . "' class='btn btn-danger'>Block</a>";
                        break;
                    case ReviewStatusTypes::RESUBMITTED:
                        $status = "<a href='" . route('admin_users_approve_review', $item->id) . "' class='btn btn-success'>Publish</a>" .
                            "<a href='" . route('admin_users_disable_review', $item->id) . "' class='btn btn-danger'>Block</a>" .
                            "<a href='" . route('admin_users_allow_edit_review', $item->id) . "' class='btn btn-warning'>Allow Edit</a>";
                        break;
                }
            }
            return $status;
        })->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function getAllAppStaff(Request $request)
    {
        return Datatables::of(User::leftJoin('app_staff', 'app_staff.users_id', 'users.id')
            ->where('app_staff.warehouses_id', $request->get('warehouse_id'))->select('users.*'))
            ->addColumn('actions', function ($attr) use ($request) {
                $html = "<a class='btn btn-warning' href='" . route('app_staff_add_permission', [$attr->id, $request->get('warehouse_id')]) . "'>Permission</a>";
                $html .= "<a class='btn btn-warning' href='" . route('app_staff_badge', [$attr->id, $request->get('warehouse_id')]) . "'>Badge</a>";
                return $html;
            })->rawColumns(['actions'])
            ->make(true);
    }

    public function getAllAppOrders(Request $request)
    {

        return Datatables::of(\App\Models\App\Orders::where('shop_id', $request->get('warehouse_id')))
            ->editColumn('status', function ($order) {
                return '<span class="badge badge-' . $order->statusClass() . '">' . $order->status() . '</span>';
            })->addColumn('amount', function ($order) {
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    return 'This is a server using Windows!';
                } else {
                    return money_format('%(#10n', $order->items()->sum('price')) . '$';
                }

            })
            ->addColumn('actions', function ($attr) {
                $html = "<a class='btn btn-info' href='" . route('admin_app_order_view', $attr->id) . "'>View</a>";
                return $html;
            })->rawColumns(['actions', 'status'])
            ->make(true);
    }
}
