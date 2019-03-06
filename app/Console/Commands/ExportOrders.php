<?php

namespace App\Console\Commands;

use App\Models\OrdersJob;
use App\Services\ManagerApiRequest;
use Illuminate\Console\Command;

class ExportOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ManagerApiRequest $request)
    {
//        $request = new ManagerApiRequest;
     //   \File::put(public_path('test.txt'), now());
         $redayJobs = OrdersJob::where('status', '<', 3)->first();
         if($redayJobs){


         try{
            $result = $request->exportOrder($redayJobs->order_id);
         }catch (\Exception $exception){
             $redayJobs->log= $redayJobs->log.'\r\n'.$exception->getMessage();
             $redayJobs->status=$redayJobs->status+1;
             $redayJobs->save();
             echo $exception->getMessage();die;
         }
         if($result['error']){
             $redayJobs->log= $redayJobs->log.'\r\n'.$result['message'];
             $redayJobs->status=$redayJobs->status+1;
             $redayJobs->save();
             echo $result['message'];die;
         }
             $redayJobs->status=4;
             $redayJobs->save();
         echo 'success';die;
         }
         echo 'no order available to export';die;
    }
}
