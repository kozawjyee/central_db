<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Models\DeskeraModel;
use GuzzleHttp\Client;
use App\Models\Customer;

class DSK_Customer extends Model
{
    use HasFactory;

    protected $deskera;
    protected $requestBody;
    protected $dsk_lastCustomerCode;

    public function __construct(DeskeraModel $deskera){
        $this->deskera = $deskera;
    }

    public function getCustomerInfo(){
        $request = [
            "username" => "admin",
            "companyid" => "",
            "userid" => "9a7deb4e-a273-4a5b-b579-7b3691007552",
            "accname" => "Trade Debtors",
            "debitType" => true,
            "sequenceformat" => "402880ce552a14ec01552a368718000d",
            "currencyid" => "6",
            "mappingcusaccid" => "402880505a026a07015a03993f5403d6",
            "termid" => "ff8080814d4cdde1014d50ea331d0142",
            "from" => "402880ce552a14ec01552a3684518000d",
            "customername" => "Moe Thu Zar",
            "isdefaultHeaderMap" => true,
            "userfullname" => "admin",
            "cdomain" => "shwetechinternal",
            "customercode" => "C1",
            "accountcode" => "Trade Debtors",
            "acccode" => "CID000013",
            "termvalue" => "NET10",
            "creationDate" => "Aug 01, 2017 12:00:00 AM",
            "currencycode" => "MMK",
            "isVendor" => false,
            "addressDetail" => 
            [
                [
                "aliasNameID" => "Billing Address1",
                "aliasName" => "Billing Address1",
                "address" => "KUDALWADI, CHIKHALI,",
                "county" => "",
                "city" => "Pune City",
                "state" => "Maharashtra",
                "stateCode" => "",
                "country" => "India",
                "postalCode" => "412114",
                "phone" => "",
                "mobileNumber" => "9822070458 MR.NAIK",
                "fax" => "",
                "emailID" => "",
                "recipientName" => "",
                "contactPerson" => "",
                "contactPersonNumber" => "",
                "contactPersonDesignation" => "",
                "website" => "",
                "isBillingAddress" => true,
                "isDefaultAddress" => true
                ],
                [
                "aliasNameID" => "Shipping Address1",
                "aliasName" => "Shipping Address1",
                "address" => "KUDALWADI, CHIKHALI,",
                "county" => "",
                "city" => "",
                "state" => "",
                "stateCode" => "",
                "country" => "",
                "postalCode" => "",
                "phone" => "",
                "mobileNumber" => "",
                "fax" => "",
                "emailID" => "",
                "recipientName" => "",
                "contactPerson" => "",
                "contactPersonNumber" => "",
                "contactPersonDesignation" => "",
                "website" => "",
                "shippingRoute" => "",
                "isBillingAddress" => false,
                "isDefaultAddress" => true
                ]
            ]
        ];
        return $request;
    }

    public function postCustomer(){
        $request = $this->getCustomerInfo();
        $client = new Client([
            'base_uri' => $this->deskera->account_url
        ]);

        $response = $client->request('POST', '/rest/v1/master/customer?token='.$this->deskera->token, [
            'json' => $request
        ]);
        return Log::channel('deskera')->info($response->getBody()->getContents());
    }

    public function getLastCustomerIdfromDeskera(){
        $client = new Client([
            'base_uri' => $this->deskera->account_url
        ]);

        $response = $client->request('GET', '/rest/v1/master/customer?request={cdomain:shwetechinternal}&token='.$this->deskera->token);
        $result = json_decode($response->getBody()->getContents(), true);
        $lastIndex = $result['totalCount'] - 1;
        $lastCustomerId = $result['data'][$lastIndex]['customercode'];
        $this->dsk_lastCustomerCode = $lastCustomerId;
        return Log::channel('deskera')->info($lastCustomerId);
    }


    public function getAddedCustomer(){

    }
}