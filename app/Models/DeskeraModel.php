<?php

/**
 * ==========================
 * Development By InnoScript
 * ==========================
 * Author       InnoScript Team
 * Email        dev@innoscript.co
 * Phone        09421038123
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Log;
use Exception;

class DeskeraModel extends Model
{
    use HasFactory;

    protected $token_url;

    public $retry;
    public $timeout;
    public $token;
    public $master_url;
    public $cdomain;
    public $account_url;

    public function __construct(){
        $this->token_url = env('DESKERA_TOKEN_URL');
        $this->master_url = env('DESKERA_MASTER');
        $this->account_url = env('DESKERA_ACCOUNT');
        $this->retry = env('HTTP_RETRY');
        $this->timeout = env('HTTP_TIMEOUT');
        $this->cdomain = env('DESKERA_CODOMAIN');
    }

    public function generateToken(){

        try{
            $response = Http::retry($this->retry, $this->timeout)->get($this->token_url);
            $status = $response->status();

            if($status === 200){
                $data = json_decode($response->body(), true);
                $this->token = $data['token'];
                return $this->token;
            }
        }catch(Exception $e){
            Log::channel('deskera')->info($e);
        }
    }

}
