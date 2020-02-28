<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Statuses;
use App\Services\FileService;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    protected $view = 'admin.reviews';

    private $user;
    private $fileService;
    private $settings;

    public function __construct(
        User $user,
        FileService $fileService,
        Settings $settings
    )
    {
        $this->user = $user;
        $this->fileService = $fileService;
        $this->settings = $settings;
    }

    public function index()
    {
        return $this->view('index');
    }
}
