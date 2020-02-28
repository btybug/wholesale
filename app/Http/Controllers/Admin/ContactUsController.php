<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 1/24/2019
 * Time: 2:47 PM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Gmail;
use App\Models\MailTemplates;
use App\Services\ShortCodes;
use Dacastro4\LaravelGmail\Services\Message\Mail;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $view = 'admin.blog.contact_us';

    public function index()
    {
        return $this->view('index');
    }

    public function getView($id)
    {
        $model = ContactUs::findOrFail($id);
        $model->is_readed = 1;
        $model->timestamps = false;
        $model->save();
        $model->children()->update(['is_readed' => 1]);
        return $this->view('view', compact('model'));
    }

    public function postReplay($id, Request $request)
    {


        $mail = ContactUs::findOrfail($id);
//        $gmail = \App\Models\Gmail::message()->subject($mail->uniq_id)->preload()->all();
//        foreach ($gmail as $key => $email) {
//            echo "key=$key <br> name=" . $email->getFrom()['name'] . "<br> email=" . $email->getFrom()['email'] . "<br>";
//        };
//        die;
        $mailTemplate = MailTemplates::where('slug', 'new_contact_us')
            ->where('is_active', '1')
            ->first();
        $last_message = $mail->children->last();
        $last_message=($last_message)??$mail;
        $data = [
            'name' => $mail->name,
            'phone' => $mail->phone,
            'category' => $mail->category,
            'email' => $mail->email,
            'message' => $request->get('reply'),
        ];
        $Shortcodes=new ShortCodes();
        $message = \View::make('email.contact', compact('data','Shortcodes','mail','mailTemplate'))->render();
        $gmail = Gmail::message()
            ->get($last_message->gmail_id)
            ->from($mail->email, $mail->name)
            ->to($last_message->email, $last_message->name)
            ->message($message)->reply();
        $data['gmail_id']=$gmail->getId();
        $data['message']=Gmail::getEncodedBody(Gmail::getDecodedBody($mail->message).$message);
        $mail->children()->create($data);
        return redirect()->back();
    }
}
