<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeskeraModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DSK_Invoice extends Model
{
    use HasFactory;
    protected $deskera;
    protected $path;

    public function __construct(DeskeraModel $deskeraModel)
    {
        $this->deskera = $deskeraModel;
        $this->path = '/rest/v1/transaction/invoice';
    }

    public function getInvoiceInfo()
    {
        $request = [
            "username" => "admin",
            "termvalue" => "NET 1",
            "subTotal" => "200",
            "duedate" => "Apr 30, 2022 11:30:00 AM",
            "sequenceformatvalue" => "INV000000",
            "invoicenumber" => "REST_SO_05",
            "includeprotax" => true,
            "gstIncluded" => true,
            "costcentervalue" => "Cost Center Two",
            "salespersonvalue" => "Person 1",
            "paymentmethodname" => "KBZ Bank",
            "invoicedetail" => [
                "discountispercent" => "",
                "taxamount" => "",
                "quantity" => "211111111111111111",
                "uomvalue" => "Pcs",
                "rate" => "100",
                "discount" => "10",
                "desc" => "Description1",
                "productvalue" => "P000290",
                "producttaxvalue" => "",
                "baseuomrate" => "1",
                "customfield" => [
                    "fieldlabel" => "Line_Text",
                    "value" => "Line ABC"
                ]
            ],
            "customfield" => [
                "fieldlabel" => "Global_Text",
                "value" => "ABC"
            ],
            "incash" => false,
            "customervalue" => "C001",
            "currencyvalue" => "MMK",
            "cdomain" => "shwetechinternal",
            "invoicedate" => "April 25, 2022 10:30:00 AM",

        ];
        return $request;
    }

    public function postInvoice()
    {
        $request = $this->getInvoiceInfo();
        $client = new Client([
            'base_uri' => $this->deskera->account_url
        ]);

        $response = $client->request('POST', $this->path . '?token=' . $this->deskera->token, [
            'json' => $request
        ]);
        return Log::channel('deskera')->info($response->getBody()->getContents());
    }

    public function getLastInvoiceIdfromDeskera()
    {
        $client = new Client([
            'base_uri' => $this->deskera->account_url
        ]);

        $response = $client->request('GET', $this->path . '?request={"cdomain":"shwetechinternal"}&token=' . $this->deskera->token);
        $result = json_decode($response->getBody()->getContents(), true);
        $lastIndex = $result['totalCount'] - 1;
        $lastCustomerId = $result['data'][$lastIndex]['customercode'];
        return Log::channel('deskera')->info($lastCustomerId);
        // return $result;
    }

    // public function InvoicetoOntheGo() {
    //     $results = $this->getLastInvoiceIdfromDeskera();

    //     return Log::channel('deskera')->info($results);

    // }
}
