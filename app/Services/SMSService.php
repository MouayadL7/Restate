<?php

namespace App\Services;

use Twilio\Rest\Client;

class SMSService
{
    protected $twilioClient;

    public function __construct()
    {
        $this->twilioClient = new Client(config('twilio.sid'), config('twilio.auth_token'));
    }

    /**
     * Send an SMS to a given phone number
     *
     * @param string $phone
     */
    public function sendOTP(string $phone)
    {
        try {
            // Generate OTP
            $otp = mt_rand(100000, 999999);

            // Sending OTP using Twilio Client
            $this->twilioClient->messages->create(
                $phone, // The phone number you're sending the OTP to
                [
                    'from' => config('twilio.phone_number'), // Your Twilio phone number
                    'body' => "Your verification code is: " . $otp . "\nFor your security, do not share this code with anyone."
                ]
            );

        } catch (\Exception $ex) {
            throw $ex; // Rethrow the exception
        }
    }
}
