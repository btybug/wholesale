<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 08.02.2018
 * Time: 10:39
 */


use App\Models\Settings;

$_MEDIA_BUTTON = false;
$_MEDIA_SLUG = null;
$_MEDIA_FOLDER = null;
$_FILTER_BUTTON = false;
$_FILTER_HTML = '';
global $_MODEL_BOOTED;

//include "App\Helpers\barcode.php";

function render_bc($format,$symbology,$data,$options = []){
    $generator = new barcode_generator();

    /* Output directly to standard output. */
    $generator->output_image($format, $symbology, $data, $options);
//
//    /* Create bitmap image. */
//    $image = $generator->render_image($symbology, $data, $options);
//    imagepng($image);
//    imagedestroy($image);
//    return $image;
}

function getAlertIconByClass($class = 'success')
{
    $icon = '';

    switch ($class) {
        case'success':
            $icon = 'fa fa-check';
            break;
        case'warning':
            $icon = 'fa fa-warning';
            break;
        case'info':
            $icon = 'fa fa-info';
            break;
        case'danger':
            $icon = 'fa fa-ban';
            break;
    }
    return $icon;
}

function is_enabled_model_boot()
{
    return Config::get('model_boot', false);

}

function is_enabled_media_modal()
{
    global $_MEDIA_BUTTON;
    return $_MEDIA_BUTTON;

}

function is_enabled_filter_modal()
{
    global $_FILTER_BUTTON;
    return $_FILTER_BUTTON;

}

function enableMedia($slug=null)
{
    global $_MEDIA_BUTTON;
    if($slug){
        global $_MEDIA_SLUG;
        $_MEDIA_SLUG=$slug;
    }
    $_MEDIA_BUTTON = true;
}

function enableFilter()
{
    global $_FILTER_BUTTON;
    global $_FILTER_HTML;
    $_FILTER_HTML = View::make('filters.filter_modal')->render();
    $_FILTER_BUTTON = true;
}

function media_button(string $name, $model = null, bool $multiple = false, $slug = 'drive', $html = null)
{
    $folder = App\Models\Media\Folders::where('name', $slug)->where('parent_id', 0)->first(['id', 'name']);

    enableMedia();
    $id = $folder->id;
    global $_MEDIA_FOLDER;
    $_MEDIA_FOLDER = $folder;
    $uniqId = uniqid('media_');
    return view('media.button', compact(['multiple', 'slug', 'name', 'model', 'uniqId', 'html', 'id']));
}

function media_widget(string $name, $model = null, bool $multiple = false, $slug = 'drive', $html = null,$displayName = "Image")
{
    $folder = App\Models\Media\Folders::where('name', $slug)->where('parent_id', 0)->first(['id', 'name']);

    enableMedia();
    $id = $folder->id;
    global $_MEDIA_FOLDER;
    $_MEDIA_FOLDER = $folder;
    $uniqId = uniqid('media_');
    return view('media.widget', compact(['multiple', 'slug', 'name', 'model', 'uniqId', 'html', 'id','displayName']));
}

function get_media_folder()
{
    global $_MEDIA_FOLDER;
    global $_MEDIA_SLUG;
    if(!$_MEDIA_FOLDER && $_MEDIA_SLUG){
        $_MEDIA_FOLDER = App\Models\Media\Folders::where('name', $_MEDIA_SLUG)->where('parent_id', 0)->first(['id', 'name']);
    }
    return $_MEDIA_FOLDER;
}

function filter_button($category, $group = null, $text = 'Filter', $name = null, $is_multiple = true, $type = 'filter_popup')
{
    global $_FILTER_HTML;
    $uniqId = uniqid('filter_');
    $category = \App\Models\Category::where('type', 'filter')->where('slug', $category)->first();

    switch ($type) {
        case'filter_popup':
            enableFilter();
            $_FILTER_HTML = View::make('filters.filter_modal', compact('category'))->render();
            $view = 'button';
            break;
        case'select_filter':
            $view = 'filter_select';
            break;
    }
    return ($category && isset($view)) ? view('filters.' . $view, compact('category', 'text', 'group', 'name', 'is_multiple', 'uniqId', 'type')) : 'Shnorhavor Amanor Yev Surb &nund';
}

function filter_modal_html()
{
    global $_FILTER_HTML;
    return $_FILTER_HTML;
}

function get_site_logo()
{
    $settings = new \App\Models\Settings();
    $logo = $settings->getData('admin_general_settings', 'siteLogo');
    return ($logo && $logo->val) ? $logo->val : '/public/images/no_image.png';
}

function get_site_name()
{
    $settings = new \App\Models\Settings();
    $name = $settings->getData('admin_general_settings', 'site_name');
    return ($name) ? $name->val : '';
}

function get_site_code()
{
    $settings = new \App\Models\Settings();
    $name = $settings->getData('admin_general_settings', 'site_code');
    return ($name) ? $name->val : '';
}

function BBgetDateFormat($date, $format = null)
{
    if (!$date) null;

    if (!is_numeric($date))
        $date = strtotime($date);

    if ($format) {
        return date($format, $date);
    }

    $model = new \App\Models\Settings();
    $settings = $model->getData('admin_general_settings', 'date_format');

    if ($settings) {
        if (strpos($settings->val, '%') !== false) {
            return (strftime($settings->val, $date)) ? strftime($settings->val, $date) : date('m/d/Y', $date);
        } else {
            return date($settings->val, $date);
        }
    }

    return date('m/d/Y', $date);
}

/**
 * @param $time
 * @return bool|string
 */
function BBgetTimeFormat($time,$format = null)
{
    if (!$time) null;

    if($format){
        return date($format, strtotime($time));
    }

    $model = new \App\Models\Settings();
    $settings = $model->getData('admin_general_settings', 'date_format');

    if ($settings) {
        if ($settings->val == 'seconds') {
            return date("H:i:s", strtotime($time));
        }
        if ($settings->val == '12hrs') {
            // 24-hour time to 12-hour time
            return date("g:i a", strtotime($time));
        }
    }

    return date("H:i:s", strtotime($time));
}

function get_site_social_icons()
{
    $model = new \App\Models\Settings();
    $settings = $model->getData('admin_general_settings', 'social_media');

    if ($settings && $settings->val) {
        return json_decode($settings->val, true);
    }

    return null;
}

function userCan($permission)
{
    if (!Auth::check()) return false;
    $role = Auth::user()->role;
    if($permission=='admin_role_membership'){
        if ($role->slug != 'superadmin'){
            return false;
        }
    };
    if ($role->slug == 'superadmin' || $role->slug == 'admin') return true;
    return $role->can($permission);
}

function hasAccess($permission)
{
    if (!Auth::check()) return false;
    $role = Auth::user()->role;
    if ($role->slug == 'superadmin' || $role->slug=='admin') return true;
    return $role->hasAccess($permission);
}

function getFrontendPages($permissions = [])
{
    $routes = array();
    $routeCollection = \Route::getRoutes();
    foreach ($routeCollection as $value) {
        if (!starts_with($value->uri(), 'admin')) {
            if (isset($permissions[$value->getName()])) {

                $routes[$value->methods()[0]][$value->uri()] = ['url' => $value->uri(), 'text' => $value->getName(), 'state' => ['checked' => true]];
            } else {
                $routes[$value->methods()[0]][$value->uri()] = ['url' => $value->uri(), 'text' => $value->getName()];
            }
        }

    }
    if (isset($routes['GET']))
        return collect($routes['GET']);

}

function getModuleRoutes($method, $sub, $permissions = [])
{
    $routes = array();
    $new_array = [];
    $routeCollection = \Route::getRoutes();
    foreach ($routeCollection as $value) {
        if (isset($permissions[$value->getName()])) {

            $routes[$value->methods()[0]][$value->uri()] = ['url' => $value->uri(), 'text' => $value->getName(), 'state' => ['checked' => true]];
        } else {
            $routes[$value->methods()[0]][$value->uri()] = ['url' => $value->uri(), 'text' => $value->getName()];
        }
    }
    if (!isset($routes[$method]['admin'])) {
        $routes[$method]['admin'] = [];
    }
    ksort($routes[$method]);
    $routes[$method] = (keysort($routes[$method], $sub));

    if (isset($routes[$method][$sub]))
        return collect($routes[$method][$sub]);

}

function keysort($array, $url, $count = 0)
{
    foreach ($array as $key => $value) {
        $count++;
        if (is_child($url, $key)) {
            $array[$url]['nodes'][$key] = $value;
            unset($array[$key]);
        }
    }
    if (isset($array[$url]['nodes']) && count($array[$url]['nodes'])) {
        foreach ($array[$url]['nodes'] as $k => $v) {
            $array[$url]['nodes'] = keysort($array[$url]['nodes'], $k);
        }
    }
    return $array;
}


function is_child($parent, $child)
{
    if ($parent == $child) return false;
    $parent = clean_urls($parent);
    $child = clean_urls($child);
    return (array_sort_with_count($child, count($parent)) == $parent);
}


function clean_urls($url)
{
    if (isset($url[0]) && $url[0] == '/') {
        $url = substr($url, 1);
    }
    return explode('/', $url);
}


function array_sort_with_count(array $array, $count)
{
    $cunk = array_chunk($array, $count);
    if (count($cunk)) {
        return $cunk[0];
    }
    return false;
}

function get_pluck($data, $key, $name)
{
    $result = [];
    if (count($data)) {
        foreach ($data as $datum) {
            $result[$datum->{$key}] = $datum->{$name};
        }
    }

    return $result;
}

function get_translated($model, $locale, $column)
{

    if (is_array($model)) {
        $result = get_translated_by_array($model, $locale, $column);
    } else {
        $result = ($model && $model->getTranslation($locale)) ? $model->getTranslation($locale)->{$column} : null;
    }
    return $result;
}

function get_translated_by_array($model, $locale, $column)
{
    return ($model && isset($model['translatable'][$locale][$column])) ? $model['translatable'][$locale][$column] : null;
}

function post_url($post)
{
    return ($post->url) ? "/news/" . $post->url : "#";
}

function get_languages()
{
    return \App\Models\SiteLanguages::all();
}

function get_languages_pluck()
{
    return \App\Models\SiteLanguages::pluck('name', 'code')->all();
}

function get_default_language()
{
    $lang = \App\Models\SiteLanguages::where('default', 1)->first();
    return $lang;
}

//start short codes
function reset_password_link($token)
{
    return url(config('app.url') . route('password.reset', $token, false));
}

function confirmation_link($notifiable)
{
    return URL::temporarySignedRoute(
        'verification.verify', \Carbon\Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
    );
}

function app_name()
{
    return env('APP_NAME');
}

function app_url($user)
{
    return env('APP_URL');
}

function app_blog_url($user)
{
    return route('blog');
}

function receiver_name($user)
{
    return $user->name;
}
function receiver_last_name($user)
{
    return $user->last_name;
}

function receiver_last_phone($user)
{
    return $user->phone;
}

function shortUniqueID()
{
    return base_convert(microtime(false), 10, 36);
}

function order_code($user, $order)
{
    return $order['code'];
}

function order_amount($user, $order)
{
    return $order['amount'];
}

function order_shipping_method($user, $order)
{
    return $order['shipping_method'];
}

function order_shipping_price($user, $order)
{
    return $order['shipping_price'];
}

function order_number($user, $order)
{
    return $order['order_number'];
}

function order_currency($user, $order)
{
    return $order['currency'];
}

function order_created_at($user, $order)
{
    return BBgetDateFormat($order['created_at']);
}

function order_updated_at($user, $order)
{
    return BBgetDateFormat($order['updated_at']);
}

function order_status($user, $order)
{
    $order = \App\Models\Orders::find($order['id']);
    return ($order) ? $order->history()->first()->status->name : null;
}

function sc($content, $user, $job)
{
    $ShortCodes = new \App\Services\ShortCodes();
    $content = $ShortCodes->MailShortcoder($content, $user);
    if ($job instanceof \App\Models\MailJob) {
        $content = $ShortCodes->relatedShortcoder($content, $user, $job);
    }
    return $content;
}

function sc2($content, $user, $job)
{
    $ShortCodes = new \App\Services\ShortCodes();
    $content = $ShortCodes->MailShortcoder($content, $user);
    return $content;
}

//end short codes
function cartCount()
{
    $cartService = new \App\Services\CartService();

    return $cartService->getCount();
}


function cartCountItems()
{
    $cart = \Cart::session('wholesaler')->getContent();
    return count($cart);
}

function getRegions($country, $all = false)
{
    $countries = new \PragmaRX\Countries\Package\Countries();
    if (!$country) return [];
    return ($all) ? $countries->whereNameCommon($country)->first()->hydrateStates()->states->pluck('name', 'name')->toArray() :
        $countries->whereNameCommon($country)->first()->hydrateStates()->states->pluck('name', 'name')->toArray();
}

function getCities($country)
{
    $countries = new \PragmaRX\Countries\Package\Countries();
    $country = $countries->where('name.common', $country)->first();
    return ($country) ? $country->hydrate('cities')->cities->pluck('name', 'name') : [];
}

function getRegionByZone($country)
{
    if (!$country) return [];
    $country = \App\Models\ZoneCountries::find($country);
    return ($country) ? $country->regions->pluck('name', 'id') : [];
}

function getCountryByZone($country)
{
    if (!$country) return null;
    $country = \App\Models\ZoneCountries::find($country);
    return ($country) ? $country : null;
}

function getRegion($region, $attr = null)
{
    if (!$region) return null;
    $region = \App\Models\ZoneCountryRegions::find($region);
    return ($attr && $region) ? $region->$attr : null;
}

function stripe_key()
{
    $settings = new \App\Models\Settings();
    $model = $settings->getEditableData('payments_gateways');
    return isset($model->stripe_key) ? $model->stripe_key : null;
}

function stripe_secret()
{
    $settings = new \App\Models\Settings();
    $model = $settings->getEditableData('payments_gateways');
    return isset($model->stripe_secret) ? $model->stripe_secret : null;
}

function generate_random_letters($length, $prefix = '', $suffix = '')
{
    $random = '';
    for ($i = 0; $i < $length; $i++) {
        $random .= chr(rand(ord('a'), ord('z')));
    }
    return strtoupper($prefix . $random . $suffix);
}

function BBcodeDate($then)
{
    return (date('Y') - $then) . date('md');
}

function getUniqueCode($table, $column, $prefix = '')
{
    do {
        $code = $prefix . BBcodeDate(2000) . generate_random_letters(4);
    } while (DB::table($table)->where($column, $code)->exists());
    return $code;
}


function commentRender($comments, $i = 0, $parent = false)
{
    $settingService = new Settings();
    $settings = $settingService->getEditableData('admin_comments_setting');
    if (count($comments)) {
        $comment = $comments[$i];
        //render main content
        if ($parent) {
            echo '<div class="row user-comment-img sub pl-4 w-100 m-0">';
        } else {
            echo '<div class="row user-comment-img">';
        }
        echo '<div class="d-flex wrap-wall w-100">';
        echo '<div class="left-photo hidden-xsd-none d-sm-block">';
        echo '<figure class="thumbnail">';
        echo '<img class="img-fluid" src="' . user_avatar($comment->author->id) . '" alt="'.$comment->author->name.'" title="'.$comment->author->name.'">';
        echo '</figure>';
        echo '</div>';


        echo '<div class="right-comments">';
        echo '<div class="card arrow left mb-4">';
        echo '<div class="card-body">';
        echo '<header class="text-left">';
        echo '<div class="comment-user">';
        if ($comment->author) {
            echo '<span class="text-center">' . $comment->author->name .' '. $comment->author->last_name . '</span>';
        } else {
            echo '<span class="text-center">' . $comment->guest_name . '</span>';
        }
        echo '</div>';
        echo '</header>';
        echo '<div class="comment-post">';
        echo '<p>' . $comment->comment . '</p>';
        echo '</div>';
        echo '</div>';
        if (Auth::check()) {
            echo '<div class="text-right reply-wrapper">';
            echo   '<a href="javascript:void(0)" data-id="' . $comment->id . '" class="btn btn-secondary btn-sm reply">Reply</a>';
            if($settings){
                if($settings->user_delete == 1 && $comment->author_id == Auth::id()){
                    echo  '<a href="javascript:void(0)" data-id="' . $comment->id . '" class="btn btn-danger btn-sm delete-comment">Delete</a>';
                }
                if($settings->user_edit == 1 && $comment->author_id == Auth::id()) {
                    echo '<a href="javascript:void(0)" data-id="' . $comment->id . '" class="btn btn-warning btn-sm edit-comment">Edit</a>';
                }
            }

           echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';

        if (count($comment->children)) {
            commentRender($comment->children, 0, true);
        }

        echo '</div>';
        $i = $i + 1;
        if ($i != count($comments)) {
            commentRender($comments, $i, $parent);
        }
    }
}

//function commentRender($comments, $i = 0, $parent = false)
//{
//    if (count($comments)) {
//        $comment = $comments[$i];
//        //render main content
//        if ($parent) {
//            echo '<div class="row user-comment-img sub pl-4 w-100 m-0">';
//        } else {
//            echo '<div class="row user-comment-img">';
//        }
//
//        echo '<div class="col-lg-2 col-md-2 hidden-xsd-none d-sm-block">';
//        echo '<figure class="thumbnail">';
//        echo '<img class="img-fluid" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png">';
//        if ($comment->author) {
//            if ($comment->author->isAdministrator()) {
//                echo '<figcaption class="text-center">Admin</figcaption>';
//            } else {
//                echo '<figcaption class="text-center">' . $comment->author->username . '</figcaption>';
//            }
//        } else {
//            echo '<figcaption class="text-center">' . $comment->guest_name . '</figcaption>';
//        }
//
//        echo '</figure>';
//        echo '</div>';
//
//
//        echo '<div class="col-lg-10 col-md-10">';
//        echo '<div class="card arrow left mb-4">';
//        echo '<div class="card-body">';
//        echo '<header class="text-left">';
//        echo '<div class="comment-user"><i class="fa fa-user"></i> That Guy</div>';
//        echo '<time class="comment-date" datetime="' . $comment->created_at . '"><i class="fa fa-clock-o"></i> ' . time_ago($comment->created_at) . '</time>';
//        echo '</header>';
//        echo '<div class="comment-post">';
//        echo '<p>' . $comment->comment . '</p>';
//        echo '</div>';
//        echo '<p class="text-right"><a href="#" data-id="' . $comment->id . '" class="btn btn-secondary btn-sm reply"><i class="fa fa-reply"></i> reply</a></p>';
//        echo '</div>';
//        echo '</div>';
//        echo '</div>';
//
//        if (count($comment->children)) {
//            commentRender($comment->children, 0, true);
//        }
//
//        echo '</div>';
//        $i = $i + 1;
//        if ($i != count($comments)) {
//            commentRender($comments, $i, $parent);
//        }
//    }
//}


function replyRender($replies, $i = 0, $parent = false)
{
    if (count($replies)) {
        $reply = $replies[$i];

        if ($reply->getTable() == 'history') {
            echo '<div class="admin_updated">
<div class="image label label-default"><img src="' . user_avatar($reply->user->id) . '" alt="'.$reply->user->name.'" title="'.$reply->user->name.'"></div>
<p class="font-18 text-gray-clr mb-0"><span class="label label-default">' . $reply->user->name . ' has ' . $reply->body . '</span></p>
</div>';
        } else {
            //render main content
            if ($parent) {
                echo '<div class="clearfix"></div><div class="row user-comment-img sub pl-4 w-100 m-0">';
            } else {
                echo '<div class="row user-comment-img">';
            }

            echo '<div class="col-lg-2 col-md-2 hidden-xsd-none d-sm-block">';
            echo '<figure class="thumbnail">';
            echo '<img class="img-fluid" src="' . user_avatar($reply->author->id) . '" alt="'.$reply->user->name.'" title="'.$reply->user->name.'">';
            if ($reply->author) {
                if ($reply->author->isAdministrator()) {
                    echo '<figcaption class="text-center">Admin</figcaption>';
                } else {
                    echo '<figcaption class="text-center">' . $reply->author->username . '</figcaption>';
                }
            } else {
                echo '<figcaption class="text-center">' . $reply->guest_name . '</figcaption>';
            }

            echo '</figure>';
            echo '</div>';


            echo '<div class="col-lg-10 col-md-10">';
            echo '<div class="card arrow left mb-4">';
            echo '<div class="card-body">';
            echo '<header class="text-left">';
            echo '<div class="comment-user"><i class="fa fa-user"></i> That Guy</div>';
            echo '<time class="comment-date" datetime="' . $reply->created_at . '"><i class="fa fa-clock-o"></i> ' . time_ago($reply->created_at) . '</time>';
            echo '</header>';
            echo '<div class="comment-post">';
            echo '<p>' . $reply->reply . '</p>';
            echo '</div>';
            echo '<p class="text-right"><a href="#" data-id="' . $reply->id . '" class="btn btn-transp btn-sm reply rounded-0"><i class="fa fa-reply"></i> reply</a></p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            if (count($reply->children)) {
                replyRender($reply->children, 0, true);
            }
            echo '</div>';
        }


        $i = $i + 1;
        if ($i != count($replies)) {
            replyRender($replies, $i, $parent);
        }
    }
}


function renderCategory($replies, $i = 0, $parent = false)
{
    if (count($replies)) {
        $reply = $replies[$i];
        //render main content
        if ($parent) {
            echo '<ul class="sub-list">';
        } else {
            echo '<ul class="list-unstyled list-category">';
        }
        $active = ($i == 0 && $parent == false) ? "active" : "";
        echo '<li><a href="javasript:void(0);" data-uid="' . $reply->id . '" class="btn btn-primary cat-link select-faq-category ' . $active . '">' . $reply->name . '</a>';

        if (count($reply->children)) {
            renderCategory($reply->children, 0, true);
        }
        echo '</li>';


        $i = $i + 1;
        if ($i != count($replies)) {
            renderCategory($replies, $i, $parent);
        }
        echo '</ul>';
    }
}


function time_ago($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function stockSeo($stock)
{
    $lang=app()->getLocale();
    $settings=new Settings();
    $seo = $stock->seo;
    $general = $settings->getEditableData('seo_stocks')->toArray();
    $robot = $settings->getEditableData('seo_robot_stocks');
    $r = (is_null($seo) || is_null($seo->robots)) ?  $robot->robots : $seo->robots;
    if (!$r) return null;
    $HTML = '';
    $keywords=get_translated($seo,strtolower($lang),'keywords');
    $title=get_translated($seo,strtolower($lang),'title');
    $description=get_translated($seo,strtolower($lang),'description');
    $image=get_translated($seo,strtolower($lang),'image');
    $HTML .= ($title)?'<title>'.$title.'</title>':'<title>'.getSeo($general,'og:title',$stock).'</title>';
    $HTML.=($keywords)? Html::meta('keywords',$keywords)->toHtml():Html::meta('keywords',getSeo($general,'og:keywords',$stock))->toHtml();
    $HTML.=($title)? Html::meta('og:title',$title)->toHtml():Html::meta('og:title',getSeo($general,'og:title',$stock))->toHtml();
    $HTML.=($description)? Html::meta('og:description',$description)->toHtml():Html::meta('og:description',getSeo($general,'og:description',$stock))->toHtml();
    $HTML .=($image)? Html::meta('og:image',$image)->toHtml():Html::meta('og:image',getSeo($general,'og:image',$stock))->toHtml();


    $HTML.=($title)? Html::meta('title',$title)->toHtml():Html::meta('title',getSeo($general,'og:title',$stock))->toHtml();
    $HTML.=($description)? Html::meta('description',$description)->toHtml():Html::meta('description',getSeo($general,'og:description',$stock))->toHtml();
    $HTML .=($image)? Html::meta('image',$image)->toHtml():Html::meta('image',getSeo($general,'og:image',$stock))->toHtml();

    return $HTML;
}
function postSeo($stock)
{
    $lang=app()->getLocale();
    $settings=new Settings();
    $seo = $stock->seo;
    $general = $settings->getEditableData('seo_posts')->toArray();
    $robot = $settings->getEditableData('seo_robot_posts');
    $r = (is_null($seo) || is_null($seo->robots)) ?  $robot->robots : $seo->robots;
    if (!$r) return null;
    $HTML = '';
    $keywords=get_translated($seo,strtolower($lang),'keywords');
    $title=get_translated($seo,strtolower($lang),'title');
    $description=get_translated($seo,strtolower($lang),'description');
    $image=get_translated($seo,strtolower($lang),'image');
    $HTML .= ($title)?'<title>'.$title.'</title>':'<title>'.getSeo($general,'og:title',$stock).'</title>';
    $HTML.=($keywords)? Html::meta('keywords',$keywords)->toHtml():Html::meta('keywords',getSeo($general,'og:keywords',$stock))->toHtml();
    $HTML.=($title)? Html::meta('og:title',$title)->toHtml():Html::meta('og:title',getSeo($general,'og:title',$stock))->toHtml();
    $HTML.=($description)? Html::meta('og:description',$description)->toHtml():Html::meta('og:description',getSeo($general,'og:description',$stock))->toHtml();
    $HTML .=($image)? Html::meta('og:image',$image)->toHtml():Html::meta('og:image',getSeo($general,'og:image',$stock))->toHtml();


    $HTML.=($title)? Html::meta('title',$title)->toHtml():Html::meta('title',getSeo($general,'og:title',$stock))->toHtml();
    $HTML.=($description)? Html::meta('description',$description)->toHtml():Html::meta('description',getSeo($general,'og:description',$stock))->toHtml();
    $HTML .=($image)? Html::meta('image',$image)->toHtml():Html::meta('image',getSeo($general,'og:image',$stock))->toHtml();

    return $HTML;
}
function brandSeo($brand=null)
{
    if (!$brand) return null;
    $lang=app()->getLocale();
    $settings=new Settings();
    $seo = $brand->seo;
    $general = $settings->getEditableData('seo_brand')->toArray();
    $robot = $settings->getEditableData('seo_robot_brand');
    $r = (is_null($seo) || is_null($seo->robots)) ?  $robot->robots : $seo->robots;
    if (!$r) return null;
    $HTML = '';
    $keywords=get_translated($seo,strtolower($lang),'keywords');
    $title=get_translated($seo,strtolower($lang),'name');
    $description=get_translated($seo,strtolower($lang),'description');
    $image=get_translated($seo,strtolower($lang),'image');
    $HTML .= ($title)?'<title>'.$title.'</title>':'<title>'.getSeo($general,'og:title',$brand).'</title>';
    $HTML.=($keywords)? Html::meta('keywords',$keywords)->toHtml():Html::meta('keywords',getSeo($general,'og:keywords',$brand))->toHtml();
    $HTML.=($title)? Html::meta('og:title',$title)->toHtml():Html::meta('og:title',getSeo($general,'og:title',$brand))->toHtml();
    $HTML.=($description)? Html::meta('og:description',$description)->toHtml():Html::meta('og:description',getSeo($general,'og:description',$brand))->toHtml();
    $HTML .=($image)? Html::meta('og:image',$image)->toHtml():Html::meta('og:image',getSeo($general,'og:image',$brand))->toHtml();


    $HTML.=($title)? Html::meta('title',$title)->toHtml():Html::meta('title',getSeo($general,'og:title',$brand))->toHtml();
    $HTML.=($description)? Html::meta('description',$description)->toHtml():Html::meta('description',getSeo($general,'og:description',$brand))->toHtml();
    $HTML .=($image)? Html::meta('image',$image)->toHtml():Html::meta('image',getSeo($general,'og:image',$brand))->toHtml();

    return $HTML;
}


function meta($object, $type = 'seo_posts')
{

    $settings = new \App\Models\Settings();
    $metaTags = $settings->getEditableData($type);
    if (!$metaTags) return null;
    $metaTags = $metaTags->toArray();
    $columns = $object->toArray();
    $HTML = "";
    if ($object->image) {
        $HTML .= Html::meta('og:image', url($object->image))->toHtml() . "\n\r";
    }
    foreach ($metaTags as $name => $metaTag) {
        if (!is_null($metaTag)) {
            $objSeo = $object->seo()->where('name', $name)->where('type', 'general')->first();
            if (!$objSeo) {
                $value = parametazor($metaTag, $object);
            } else {
                $value = $objSeo->content;
            }
            $HTML .= Html::meta($name, $value)->toHtml() . "\n\r";
        }
    }
    return $HTML;
}

function parametazor($string, $object)
{
    preg_match('/{(.*?)}/', $string, $matches);

    if (count($matches)) {
        $string = str_replace($matches[0], $object->{$matches[1]}, $string);
        $string = parametazor($string, $object);
    }
    return $string;
}

function getSeo(array $seo, $index, $object)
{
    if ($seo && is_object($object) && isset($seo[$index])) return parametazor($seo[$index], $object);
    return null;
}

function mergeCollections($collection1, $collection2)
{
    $collection = collect();

    foreach ($collection1 as $col1)
        $collection->push($col1);
    foreach ($collection2 as $col2)
        $collection->push($col2);
    $data = $collection->sortBy('created_at');
    return $data->merge([]);
}

function getImage($url)
{
    $url = explode('/', $url);
    $name = end($url);
    return \App\Models\Media\Items::where('original_name', $name)->first();
}

function generateRandomString($length = 7)
{
    return substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function check_customer_number($number)
{
    return \DB::table('users')->where('customer_number', $number)->first();
}

function check_order_number($number)
{
    return \DB::table('orders')->where('order_number', $number)->first();
}

function generate_number($prefix)
{
    return $prefix . "-" . generateRandomString();
}

function get_customer_number()
{
    $code = get_site_code();
    $number = generate_number($code.'-C-');
    $data = check_customer_number($number);
    if ($data) {
        get_customer_number();
    }

    return $number;
}

function get_order_number()
{
    $code = get_site_code();
    $number = generate_number($code.'-O-');
    $data = check_order_number($number);
    if ($data) {
        get_order_number();
    }

    return $number;
}

function get_stock_variation($id, $column = 'name')
{
    $v = \App\Models\StockVariation::find($id);
    return ($v) ? $v->{$column} : null;
}

function get_user($id, $column = 'name')
{
    $v = \App\User::find($id);
    return ($v) ? $v->{$column} : null;
}

function get_footer_links()
{
    return \App\Models\FooterLinks::leftJoin('footer_links_translations', 'footer_links.id', '=', 'footer_links_translations.footer_links_id')
        ->whereNull('footer_links.parent_id')
        ->select('footer_links.*', 'footer_links_translations.title', 'footer_links_translations.locale')
        ->where('footer_links_translations.locale', app()->getLocale())
        ->with('children')->get()->toArray();
}

function get_general_settings(){
    $settings = new Settings();
    $model = $settings->getEditableData('admin_general_settings');

    return $model;
}

function get_social_icons(){
    $settings = new Settings();
    $model = $settings->getEditableData('admin_general_settings');
    $icons = ($model && $model->social_media) ? json_decode($model->social_media,true) : [];
    return $icons;
}

function colors()
{
    return [
        "aliceblue" => "#f0f8ff",
        "antiquewhite" => "#faebd7",
        "aqua" => "#00ffff",
        "aquamarine" => "#7fffd4",
        "azure" => "#f0ffff",
        "beige" => "#f5f5dc",
        "bisque" => "#ffe4c4",
        "black" => "#000000",
        "blanchedalmond" => "#ffebcd",
        "blue" => "#0000ff",
        "blueviolet" => "#8a2be2",
        "brown" => "#a52a2a",
        "burlywood" => "#deb887",
        "cadetblue" => "#5f9ea0",
        "chartreuse" => "#7fff00",
        "chocolate" => "#d2691e",
        "coral" => "#ff7f50",
        "cornflowerblue" => "#6495ed",
        "cornsilk" => "#fff8dc",
        "crimson" => "#dc143c",
        "cyan" => "#00ffff",
        "darkblue" => "#00008b",
        "darkcyan" => "#008b8b",
        "darkgoldenrod" => "#b8860b",
        "darkgray" => "#a9a9a9",
        "darkgreen" => "#006400",
        "darkgrey" => "#a9a9a9",
        "darkkhaki" => "#bdb76b",
        "darkmagenta" => "#8b008b",
        "darkolivegreen" => "#556b2f",
        "darkorange" => "#ff8c00",
        "darkorchid" => "#9932cc",
        "darkred" => "#8b0000",
        "darksalmon" => "#e9967a",
        "darkseagreen" => "#8fbc8f",
        "darkslateblue" => "#483d8b",
        "darkslategray" => "#2f4f4f",
        "darkslategrey" => "#2f4f4f",
        "darkturquoise" => "#00ced1",
        "darkviolet" => "#9400d3",
        "deeppink" => "#ff1493",
        "deepskyblue" => "#00bfff",
        "dimgray" => "#696969",
        "dimgrey" => "#696969",
        "dodgerblue" => "#1e90ff",
        "firebrick" => "#b22222",
        "floralwhite" => "#fffaf0",
        "forestgreen" => "#228b22",
        "fuchsia" => "#ff00ff",
        "gainsboro" => "#dcdcdc",
        "ghostwhite" => "#f8f8ff",
        "gold" => "#ffd700",
        "goldenrod" => "#daa520",
        "gray" => "#808080",
        "green" => "#008000",
        "greenyellow" => "#adff2f",
        "grey" => "#808080",
        "honeydew" => "#f0fff0",
        "hotpink" => "#ff69b4",
        "indianred" => "#cd5c5c",
        "indigo" => "#4b0082",
        "ivory" => "#fffff0",
        "khaki" => "#f0e68c",
        "lavender" => "#e6e6fa",
        "lavenderblush" => "#fff0f5",
        "lawngreen" => "#7cfc00",
        "lemonchiffon" => "#fffacd",
        "lightblue" => "#add8e6",
        "lightcoral" => "#f08080",
        "lightcyan" => "#e0ffff",
        "lightgoldenrodyellow" => "#fafad2",
        "lightgray" => "#d3d3d3",
        "lightgreen" => "#90ee90",
        "lightgrey" => "#d3d3d3",
        "lightpink" => "#ffb6c1",
        "lightsalmon" => "#ffa07a",
        "lightseagreen" => "#20b2aa",
        "lightskyblue" => "#87cefa",
        "lightslategray" => "#778899",
        "lightslategrey" => "#778899",
        "lightsteelblue" => "#b0c4de",
        "lightyellow" => "#ffffe0",
        "lime" => "#00ff00",
        "limegreen" => "#32cd32",
        "linen" => "#faf0e6",
        "magenta" => "#ff00ff",
        "maroon" => "#800000",
        "mediumaquamarine" => "#66cdaa",
        "mediumblue" => "#0000cd",
        "mediumorchid" => "#ba55d3",
        "mediumpurple" => "#9370db",
        "mediumseagreen" => "#3cb371",
        "mediumslateblue" => "#7b68ee",
        "mediumspringgreen" => "#00fa9a",
        "mediumturquoise" => "#48d1cc",
        "mediumvioletred" => "#c71585",
        "midnightblue" => "#191970",
        "mintcream" => "#f5fffa",
        "mistyrose" => "#ffe4e1",
        "moccasin" => "#ffe4b5",
        "navajowhite" => "#ffdead",
        "navy" => "#000080",
        "oldlace" => "#fdf5e6",
        "olive" => "#808000",
        "olivedrab" => "#6b8e23",
        "orange" => "#ffa500",
        "orangered" => "#ff4500",
        "orchid" => "#da70d6",
        "palegoldenrod" => "#eee8aa",
        "palegreen" => "#98fb98",
        "paleturquoise" => "#afeeee",
        "palevioletred" => "#db7093",
        "papayawhip" => "#ffefd5",
        "peachpuff" => "#ffdab9",
        "peru" => "#cd853f",
        "pink" => "#ffc0cb",
        "plum" => "#dda0dd",
        "powderblue" => "#b0e0e6",
        "purple" => "#800080",
        "rebeccapurple" => "#663399",
        "red" => "#ff0000",
        "rosybrown" => "#bc8f8f",
        "royalblue" => "#4169e1",
        "saddlebrown" => "#8b4513",
        "salmon" => "#fa8072",
        "sandybrown" => "#f4a460",
        "seagreen" => "#2e8b57",
        "seashell" => "#fff5ee",
        "sienna" => "#a0522d",
        "silver" => "#c0c0c0",
        "skyblue" => "#87ceeb",
        "slateblue" => "#6a5acd",
        "slategray" => "#708090",
        "slategrey" => "#708090",
        "snow" => "#fffafa",
        "springgreen" => "#00ff7f",
        "steelblue" => "#4682b4",
        "tan" => "#d2b48c",
        "teal" => "#008080",
        "thistle" => "#d8bfd8",
        "tomato" => "#ff6347",
        "turquoise" => "#40e0d0",
        "violet" => "#ee82ee",
        "wheat" => "#f5deb3",
        "white" => "#ffffff",
        "whitesmoke" => "#f5f5f5",
        "yellow" => "#ffff00",
        "yellowgreen" => "#9acd32"
    ];
}

function site_currencies()
{
    return (new \App\Models\SiteCurrencies())->pluck('symbol', 'code')->all();
}

function site_default_currency()
{
    return (new \App\Models\SiteCurrencies())->where('is_default', true)->first();
}

function convert_price($price, $currency, $number_format = true, $withoutSymbol = false, $round_thousand = false)
{
    $default = site_default_currency();
    if ($default) {
        if ($default->code == $currency) {
            if ($round_thousand) {
                $price = round($price, -3);
            }
            if ($number_format) {
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    $price = number_format($price);
                } else {
                    $price = money_format('%(#10n',$price);
                }

            }
            return ($withoutSymbol) ? $price : $default->symbol . "" . $price;
        } else {
            $changed = (new \App\Models\SiteCurrencies())->where('code', $currency)->first();
            if ($changed) {
                $price = $price * $changed->rate;
                if ($round_thousand) {
                    $price = round($price, -3);
                }
                if ($number_format) {
                    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                        $price = number_format($price);
                    } else {
                        $price = money_format('%(#10n',$price);
                    }
                }
                return ($withoutSymbol) ? $price : $changed->symbol . "" . $price;
            }
        }
    }

    return $price;
}

function get_currency()
{
    $default = site_default_currency();

    return (\Cookie::get('currency') && \App\Models\SiteCurrencies::where('code',\Cookie::get('currency'))->exists()) ? \Cookie::get('currency')
        : (($default) ? $default->code : null);
}

function get_symbol()
{
    $default = site_default_currency();
    $code = (\Cookie::get('currency')) ? \Cookie::get('currency')
        : (($default) ? $default->code : null);

    return (new \App\Models\SiteCurrencies())->where('code', $code)->value('symbol');
}


[['code' => 'referral_name', 'description' => 'Invited user name'],
    ['code' => 'referral_last_name', 'description' => 'Invited user last name'],
    ['code' => 'referral_email', 'description' => 'Invited user name'],
    ['code' => 'invitation_date', 'description' => 'data when user inserted referred by code'],
    ['code' => 'bonus_name', 'description' => 'Name of the coupon'],
    ['code' => 'bonus_coupon_code', 'description' => 'Coupon code what can be used in shopping cart'],
    ['code' => 'bonus_coupon_start_date', 'description' => 'Data when coupon will be active'],
    ['code' => 'bonus_coupon_end_date', 'description' => 'Data when coupon will be expired'],];

function referral_name($user, $external)
{
    return $external['referral']['name'];
}

function referral_last_name($user, $referral)
{
    return $referral['referral']['last_name'];
}

function referral_email($user, $external)
{
    return $external['referral']['email'];
}

function invitation_date($user, $external)
{
    return BBgetDateFormat($user->referralBonus()->where('bonus_bringing_user_id', $external['referral']['id'])->first()->created_at);
}

function bonus_name($user, $external)
{
    return $external['bonus']['name'];
}

function bonus_coupon_code($user, $external)
{
    return $external['bonus']['code'];
}

function bonus_coupon_start_date($user, $external)
{
    return BBgetDateFormat($external['bonus']['start_date']);
}

function bonus_coupon_end_date($user, $external)
{
    return BBgetDateFormat($external['bonus']['end_date']);
}

function user_can_claim($user)
{
    if ($user->inviter && $user->orders()->count() == 1) {
        $bonus = $user->inviter->referral_bonuses()->wherePivot('bonus_bringing_user_id', $user->id)->first();
        if ($bonus) {
            return !(bool)$bonus->pivot->status;
        }
    }
    return false;
}

function checkImage($img,$type=null)
{
        switch ($type){
            case 'stock':$img= (File::exists(base_path().$img)) ? $img : stock_default_image();break;
            case 'item':$img= (File::exists(base_path().$img)) ? $img : item_default_image();break;
        }
        return $img;

}
function stock_default_image(){
    $settings= new Settings();
    $settings = $settings->getEditableData('admin_defaults_settings');
    return ($settings->stock_image)?$settings->stock_image:null;
}
function item_default_image(){
    $settings= new Settings();
    $settings = $settings->getEditableData('admin_defaults_settings');
    return ($settings->stock_image)?$settings->item_image:null;
}

function no_image()
{
    return "/public/images/no_image.png";
}

function media_image_tmb($path)
{
    $e = explode('/', $path);
    $image = 'public/media/tmp/' . end($e);
    return (File::exists(base_path($image)) && !File::isDirectory(base_path($image))) ? url($image) : no_image();

}
function media_image_tmb_path($path)
{
    $e = explode('/', $path);
    $image = 'public'.DS.'media'.DS.'tmp'.DS. end($e);
    return (File::exists(base_path($image)) && !File::isDirectory(base_path($image))) ? base_path($image) : false;

}

function user_avatar($id = null)
{
    if ($id) {
        $userRepo = new \App\User();
        $user = $userRepo->find($id);
        if ($user) {
            if ($user->avatar) {
                return "/storage/app/images/users/$user->id/" . $user->avatar;
            }
        }
    } else {
        if (Auth::check()) {
            if (Auth::user()->avatar) {
                return "/storage/app/images/users/".Auth::id() . "/" . Auth::user()->avatar;
            }
        }
    }

    return '/public/img/user.svg';
}

function user_avatar_class($id = null)
{
    if ($id) {
        $userRepo = new \App\User();
        $user = $userRepo->find($id);
        if ($user) {
            if ($user->avatar) {
                return false;
            }
        }
    } else {
        if (Auth::check()) {
            if (Auth::user()->avatar) {
                return false;
            }
        }
    }

    return true;
}


function has_permission($role, $permission)
{
    if (!$role || !$permission) return false;
    if ($role->slug == 'superadmin') return true;
    $role_perms = $role->permissions->pluck('slug', 'slug');
    return isset($role_perms[$permission]);

}

function render_widgets($placeholder)
{
    $widgets = \App\Models\Dashboard::where('placeholder', $placeholder)->where('user_id', Auth::id())->orderBy('position')->get();
    $html = '';
    $permissions = config('widgets');
    foreach ($widgets as $widget) {
        if (has_permission(Auth::user()->role, $widget->widget) && isset($permissions[$widget->widget])) {
            $content = view($permissions[$widget->widget]['view'])->render();
            $html .= '

            <div id="' . $widget->widget . '" style="position: relative" class="box--wall">
                      <div class="card panel panel-default dashboard--panel">
  <div class="card-header panel-heading box-header">
  <h4 class="panel-title">' . $widget->widget . '</h4>
  <div class="panel-heading-btn">
  <a class="max--widget btn btn-max">
  <i class="fa fa-expand" aria-hidden="true"></i>
  </a>
  <a class="min--widget btn btn-minus">
  <i class="fa fa-minus" aria-hidden="true"></i>
  </a>
  <a class="delete-widget btn btn-del">
  <i class="fa fa-times" aria-hidden="true"></i>
  </a>
  </div>
    </div>
  <div class="card-body panel-body"><div class="ui-sortable-handle">
                  ' . $content . '
                </div></div>
</div>

            </div>';
        }

    }

    return $html;
}

function getItemStockVariations($group, array $items = [])
{
    return \App\Models\StockVariation::where('variation_id', $group)->whereIn('item_id', $items)->get();
}


function out_of_stock($item)
{
    if ($item) {
        $qty = $item->item->qty;
        $settings = new \App\Models\Settings();
        $model = $settings->getEditableData('store_out_of_stock');

        if ($qty <= 0 && $model->out_of_stock_status == 0) {
            return 1;
        }
    }

    return 0;
}

function out_of_stock_msg($item)
{
    if ($item) {
        $qty = $item->item->qty;
        $settings = new \App\Models\Settings();
        $model = $settings->getEditableData('store_out_of_stock');

        if ($qty <= 0) {
            if ($model->out_of_stock_status == 0) {
                return "(Out of stock)";
            } else {
                return "(Back order)";
            }
        }
    }

    return null;
}

function get_breadcrumb_previous_url($breadcrumbs)
{
    $length = count($breadcrumbs);
    return $breadcrumbs[$length - 2]->url;
}

function getClient()
{
    $client = new Google_Client();
    $client->setClientId(env('GOOGLE_CLIENT_ID', 'client_id'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET', 'client_secret'));
    $client->setRedirectUri(url(env('GOOGLE_REDIRECT_URI')));
    $client->setApplicationName('Google Classroom API PHP Quickstart');
    $client->setScopes(Google_Service_Classroom::CLASSROOM_COURSES_READONLY);

    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    foreach (config('gmail.scopes') as $scopes) {
        $client->addScope($scopes);
    }
    foreach (config('gmail.additional_scopes') as $scopes) {
        $client->addScope($scopes);
    }
    $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
    $client->addScope(Google_Service_Directory::ADMIN_DIRECTORY_GROUP);
    $client->addScope(Google_Service_Directory::ADMIN_DIRECTORY_USER_ALIAS);
    $client->addScope(Google_Service_Directory::ADMIN_DIRECTORY_CUSTOMER);
    $accessToken = Gmail::refreshToken();
    if (is_array($accessToken)) {
        $client->setAccessToken($accessToken);
    }
    return $client;
}

function getGoogleAlians()
{
    // Get the API client and construct the service object.
    if (!\App\Models\Gmail::check()) return collect([]);
    $client = getClient();
    $service = new Google_Service_Directory($client);

// Print the first 10 users in the domain.
    $optParams = array(
        'customer' => 'my_customer',
        'maxResults' => 10,
        'orderBy' => 'email',
    );
    $results = $service->users->listUsers($optParams);
    $users = [];
    $emails = [];
    if (count($results->getUsers()) == 0) {
        return [];
    } else {
        foreach ($results->getUsers() as $user) {
            $users[$user->getPrimaryEmail()] = $user->aliases;
        }
        if (is_array($users[Gmail::user()])) {

            foreach ($users[Gmail::user()] as $email) {
                $emails[$email] = $email;
            }
        }
        return collect($emails);
    }
}

function main_pages_seo($main_page=null){
    $HTML=' ';
    if($main_page){
       $seo= \App\Models\MainPagesSeo::where('page_name',$main_page)->first();
       if($seo){
           $HTML .= '<title>'.$seo->title.'</title>' . "\n\r";
           $HTML .= '<meta property="og:image" content="'.$seo->image.'">' . "\n\r";
           $HTML .= '<meta property="og:image:type" content="image/jpeg" />' . "\n\r";
           $HTML .= '<meta property="og:image:width" content="400" />' . "\n\r";
           $HTML .= '<meta property="og:image:height" content="300" />' . "\n\r";
           $HTML .= '<meta property="og:title" content="'.$seo->title.'">' . "\n\r";
           $HTML .= '<meta property="og:description" content="'.$seo->description.'">' . "\n\r";
           $HTML .= '<meta property="og:keywords" content="'.$seo->keywords.'">' . "\n\r";
       }

    }
    return $HTML;
}


function rich(){

    $localBusiness = \Spatie\SchemaOrg\Schema::product()
        ->name('Spatie')
        ->image('https://e-cigar.com/public/media/drive/12/ff39e4af551574b9911e15aaedfb9119.png');

    echo $localBusiness->toScript();
}

function UR_exists($url){
    $headers=get_headers($url);
    return stripos($headers[0],"200 OK")?true:false;
}
function getItemShortname($id){
    $item=\App\Models\Items::find($id);
    if($item){
        return $item->short_name;
    }
    return null;

}

