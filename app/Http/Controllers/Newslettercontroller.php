<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Newslettercontroller extends Controller
{
    public function subscribe(Request $request)
    {
        
        $email = $request->input('email');

        if ($this->isSubscribed($email)) {
            return  redirect()->back()->with('info', 'You are already subscribed.');
        }

        $response = $this->addSubscriber($email);

        if ($response->id) {
            return redirect()->back()->with('success', 'You have been subscribed to our newsletter!');
        } else {
            return redirect()->back()->with('error', 'Failed to subscribe. Please try again later.');
        }
    }

    private function isSubscribed($email)
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us8'
        ]);

        try {
            $response = $mailchimp->lists->getListMember('25c7ac747c', md5(strtolower($email)));
            return !empty($response);
        } catch (\Exception $e) {
            return false;
        }
    }

    private function addSubscriber($email)
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us8'
        ]);

        return $mailchimp->lists->addListMember('25c7ac747c', [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }





}
