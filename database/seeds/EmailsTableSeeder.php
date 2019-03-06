<?php

use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locale='gb';
        $email = new \App\Models\MailTemplates(['slug' => 'confirm_email','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'please confirm';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'reset_password','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'Reset password';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'forgot_password','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'Forgot password';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'ticket','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'New Ticket';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'order_is_submitted','from'=>'hr@hook.am','module'=>'orders']);
        $email->save();
        $email->translateOrNew($locale)->subject = '';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'order_is_Canceled','from'=>'hr@hook.am','module'=>'orders']);
        $email->save();
        $email->translateOrNew($locale)->subject = '';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'order_is_completely_collected','from'=>'hr@hook.am','module'=>'orders']);
        $email->save();
        $email->translateOrNew($locale)->subject = '';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'order_is_completed','from'=>'hr@hook.am','module'=>'orders']);
        $email->save();
        $email->translateOrNew($locale)->subject = '';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'verify_id','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'Verify ID';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'reject_verify_id','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'Reject Verification ID';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'approve_verify_id','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'Approve Verification ID';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'new_referral','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'You have new referral';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'referral_bonus_claim','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'You can claim your bonus';
        $email->translateOrNew($locale)->content = '';
        $email->save();

        $email = new \App\Models\MailTemplates(['slug' => 'referral_bonus','from'=>'hr@hook.am']);
        $email->save();
        $email->translateOrNew($locale)->subject = 'Bonus from your referral';
        $email->translateOrNew($locale)->content = '';
        $email->save();
    }
}
