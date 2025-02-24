<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    // public function newsLetterRequest(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email']
    //     ]);

    //     $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

    //     if(!empty($existSubscriber) && count($existSubscriber)>0){
    //         if($existSubscriber->is_verified == 0){
    //             $existSubscriber->verified_token = \Str::random(25);
    //             $existSubscriber->save();
    //             // Set Mail Config
    //             MailHelper::setMailConfig();

    //             // Send Mail
    //             Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));

    //             return response(['status' => 'success', 'message' => 'You Already Subscribed with this Email!']);

    //         }elseif($existSubscriber->is_verified == 1){
    //             return response(['status' => 'error', 'message' => 'You Already Subscribed with this Email!']);
    //         }else{
    //             $subscriber = new NewsletterSubscriber();
    //             $subscriber->email = $request->email;
    //             $subscriber->verified_token = \Str::random(25);
    //             $subscriber->is_verified = 0;
    //             $subscriber->save();

    //             // Set Mail Config
    //             MailHelper::setMailConfig();

    //             // Send Mail
    //             Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

    //             return response(['status' => 'success', 'message'=> 'Verification link has been sent to your email.']);            }
    //     }
    // }
    public function newsLetterRequest(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if (!empty($existSubscriber)) {
            if ($existSubscriber->is_verified == 0) {
                $existSubscriber->verified_token = \Str::random(25);
                $existSubscriber->save();
                // Set Mail Config
                MailHelper::setMailConfig();

                // Send Mail
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));

                return response(['status' => 'success', 'message' => 'You Already Subscribed with this Email!']);
            } elseif ($existSubscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => 'You Already Subscribed with this Email!']);
            }
        } else {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = \Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // Set Mail Config
            MailHelper::setMailConfig();

            // Send Mail
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

            return response(['status' => 'success', 'message' => 'Verification link has been sent to your email.']);
        }
    }
    
    public function newsLetterEmailVerify($token)
    {
        $verify = NewsletterSubscriber::where('verified_token', $token)->first();
        if ($verify) {
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();

            toastr('Email Verified Successfully!', 'sucess');
            return redirect()->route('home');
        } else {
            toastr('Invalid Token!', 'error');
            return redirect()->route('home');
        }
    }
}
