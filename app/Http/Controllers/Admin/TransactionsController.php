<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 10/10/2018
 * Time: 4:24 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\Requests\OrderHistoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Coupons;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrdersJob;
use App\Models\Statuses;
use App\Models\Settings;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\StripePayments;
use App\Models\ZoneCountries;
use App\Services\CartService;
use App\Services\ManagerApiRequest;
use App\User;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use PragmaRX\Countries\Package\Countries;
use App\Models\GeoZones;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    protected $view = 'admin.transactions';

    private $statuses;
    private $settings;

    public function __construct(
        Statuses $statuses,
        Settings $settings
    )
    {
        $this->statuses = $statuses;
        $this->settings = $settings;
    }

    public function getIndex()
    {
        return $this->view('index');
    }

    public function getView($id)
    {

        return $this->view('view', compact(''));
    }

}