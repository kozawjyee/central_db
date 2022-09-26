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
    protected $token;
    protected $path;

    public function __construct(DeskeraModel $deskeraModel)
    {
        $this->deskera = $deskeraModel;
        $this->token = $deskeraModel->token;
        $this->path = '/rest/v1/transaction/invoice';
    }

    public function getInvoiceInfo()
    {
        $request = [
            "username" => "admin",
            "termvalue" => "NET 10",
            "subTotal" => "200",
            "duedate" => "Apr 30, 2022 11:30:00 AM",
            "sequenceformatvalue" => "INV000000",
            "invoicenumber" => "REST_SO_05",
            "includeprotax" => "true",
            "gstIncluded" => "true",
            "costcentervalue" => "Cost Center Two",
            "salespersonvalue" => "Person 1",
            "paymentmethodname" => "CB Bank",
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
            "incash" => "false",
            "customervalue" => "C000031",
            "currencyvalue" => "MMK",
            "cdomain" => "shwetechpte",
            "invoicedate" => "April 25, 2022 10:30:00 AM",

        ];
        return json_encode($request);
    }

    public function postInvoice() {
        $request = $this->getInvoiceInfo();
        $invoice = new Client([
            'base_uri' => $this->deskera->account_url
        ]);

        $response = $invoice->request('POST', $this->path . '?request=' . $request . '&token=' . $this->token );
        return Log::channel('deskera')->info($response->getBody()->getContents());
    }
}
