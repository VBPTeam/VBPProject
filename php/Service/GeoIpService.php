<?php

class GeoIpService extends Controller
{
    private $apiKey = '0727c18692d5a8a739296642fad8100e48b48856aac7340fd502b3ce56567577';
    private $location;

    public function __construct()
    {
        include('location.class.php');

        $ipLite = new ip2location_lite;
        $ipLite->setKey($this->apiKey);

        $fake_ip = $this->getOptions('fake_ip');
        if ($fake_ip) {
            $ip = $fake_ip;
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $locations = $ipLite->getCity($ip);
        $errors = $ipLite->getError();

        if (!$errors) {
            $this->location = $locations;
        } else {
            throw new Exception('GeoIp error');
        }
    }
    /**
     * @return array
     * @throws Exception
     */
    public function getFullLocation()
    {
        return $this->location;
    }

    public function getCountryCode()
    {
        return $this->location['countryCode'];
    }

}
