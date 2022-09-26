<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeskeraModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DSK_Item extends Model
{
    use HasFactory;
    protected $deskera;
    protected $token;
    protected $path;

    public function __construct(DeskeraModel $deskeraModel)
    {
        $this->deskera = $deskeraModel;
        $this->path = '/rest/v1/master/product';
        $this->token = $deskeraModel->token;
    }

    public function getItemInfo()
    {
        $request = [
            "cdomain" => "shwetechinternal",
            "username" => "admin",
            "producttypevalue" => "Inventory Part",
            "productname" => "Wallet 4",
            "sequenceformatvalue" => "NA",
            "productID" => "Wallet04",
            "currencyvalue" => "SGD",
            "asOfDate" => "May 21, 2019 12:00:00 AM",
            "purchaseAccountValue" => "Purchases",
            "purchaseReturnAccountValue" => "Purchases",
            "purchaseuom" => "Pcs",
            "salesAccountValue" => "Sales",
            "salesReturnAccountValue" => "Sales",
            "salesuom" => "Pcs",
            "stockuom" => "Pcs",
            "uom" => "Pcs",
            "warehouseValue" => "COMMERZONE",
            "locationValue" => "Pune",
            "stockAdjustmentAccountValue" => "Advertising",
            "inventoryAccountValue" => "Advertising",
            "costOfGoodsSoldAccountValue" => "Advertising",
            "isWarehouseForProduct" => "true",
            "isLocationForProduct" => "true"
        ];
        return json_encode($request);
    }

    public function postItem()
    {
        $request = $this->getItemInfo();
        $item = new Client([
            'base_uri' => $this->deskera->account_url
        ]);

        $response = $item->request('POST', $this->path . '?token=' . $this->token . '&request=' . $request);
        return Log::channel('deskera')->info($response->getBody()->getContents());
    }
}
