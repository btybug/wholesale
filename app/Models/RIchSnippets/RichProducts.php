<?php


namespace App\Models\RIchSnippets;


use App\Models\Settings;
use App\Models\Stock;

class RichProducts
{

    protected $related = Stock::class;
    public $properties = [
        'name' => [
            'label' => 'Name',
            'db_column' => 'name',
            'default' => '{name}'
        ],
        'image' => [
            'label' => 'Image',
            'db_column' => 'image',
            'default' => '{image}'
        ],
        'url' => [
            'label' => 'Url',
            'db_column' => 'slug',
            'default' => '{url}'
        ],
        'brand' => [
            'label' => 'Brand',
            'db_column' => 'brand.name',
            'default' => '{brandName}'
        ],
        'category' => [
            'label' => 'Category',
            'db_column' => 'category.name',
            'default' => '{categories}'
        ],

    ];

    public $settings = [];
    public $stock;
    public $url_param;

    public function __construct()
    {
        $this->settings = (new Settings())->getEditableData('rich_stocks')->toArray();
        $this->related = new $this->related();
    }

    public function name()
    {
        return $this->stock->name;
    }

    public function image()
    {
        return ($this->stock->image) ?url($this->stock->image) : '';
    }

    public function brandName()
    {
        return $this->stock->brand->name;
    }

    public function categories()
    {
        return '?';
    }

    public function url()
    {
        return route('product_single', [$this->url_param, $this->stock->slug]);
    }

    public static function create($id, $type)
    {
        $_this = new self();
        if (!count($_this->settings)) return null;

        $_this->url_param = $type;

        $_this->stock = $_this->related->findOrFail($id);

        $localBusiness = \Spatie\SchemaOrg\Schema::product();
        foreach ($_this->settings as $key => $value) {
            $localBusiness->$key($_this->parametazor($value));
        }

        return $localBusiness->toScript();

    }

    public function parametazor($string)
    {
        preg_match('/{(.*?)}/', $string, $matches);
        if (count($matches)) {
            $string = str_replace($matches[0], $this->{$matches[1]}(), $string);
            $string = $this->parametazor($string);
        }
        return $string;
    }

}
