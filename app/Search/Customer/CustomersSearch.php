<?php


namespace App\Search\Customer;


use App\User;
use Illuminate\Http\Request;

class CustomersSearch
{
    protected $model;

    public function __construct()
    {
        $this->model =  new User();
    }

    public static function apply(Request $request)
    {
        return (new self())->run($request)->get();
    }

    public function name($value)
    {
        return $this->model->where('users.name', 'LIKE', "%" . $value . "%");
    }

    public function last_name($value)
    {
        return $this->model->where('users.last_name', 'LIKE', "%" . $value . "%");
    }

    public function phone($value)
    {
        return $this->model->where('users.phone', 'LIKE', "%" . $value . "%");
    }

    public function email($value)
    {
        return $this->model->where('users.email', 'LIKE', "%" . $value . "%");
    }

    public function run($request)
    {
        $fields = $request->all();
        foreach ($fields as $key => $value) {
            if ($value && is_callable(array($this, $key))) {
                $this->model=$this->$key($value);
            }
        }
        return $this;
    }

    public function get()
    {
       return $this->model->get();
    }
}
