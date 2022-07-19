<?php

namespace App\Http\Livewire;

use App\Models\Token;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CheckPrice extends Component
{
    public $response, $rapi, $fecha_actual, $expiry_time, $token, $responseCotizacion, $switchCotizacion = false;
    public $nombre_1, $nombre_2, $apellido_1, $apellido_2, $fecha_nacimiento, $paquete, $plan, $inicio_viaje, $fin_viaje;
    public $fFechaNacimiento, $fInicioViaje, $fFinViaje;

    protected $rules = [
        'nombre_1' => 'required|max:50|regex:/^([a-zA-ZùÙüÜäàáëèéïìíöòóüùúÄÀÁËÈÉÏÌÍÖÒÓÜÚñÑ\s]+)$/',
        'nombre_2' => 'max:50',
        'apellido_1' => 'required|max:50|regex:/^([a-zA-ZùÙüÜäàáëèéïìíöòóüùúÄÀÁËÈÉÏÌÍÖÒÓÜÚñÑ\s]+)$/',
        'apellido_2' => 'max:50',
        'fecha_nacimiento' => 'required',
        'paquete' => 'required',
        'plan' => 'required',
        'inicio_viaje' => 'required',
        'fin_viaje' => 'required',
    ];

    protected $messages = [
        'nombre_1.required' => 'Este campo es obligatorio',
        'nombre_1.max' => 'Máximo 50 caracteres',
        'nombre_1.regex' => 'Este campo solo debe contener letras y espacios',
        'nombre_2.max' => 'Máximo 50 caracteres',
        'apellido_1.required' => 'Este campo es obligatorio',
        'apellido_1.max' => 'Máximo 50 caracteres',
        'apellido_2.regex' => 'Este campo solo debe contener letras y espacios',
        'apellido_2.max' => 'Máximo 50 caracteres',
        'fecha_nacimiento.required' => 'Esta campo es obligatorio',
        'paquete.required' => 'Esta campo es obligatorio',
        'plan.required' => 'Esta campo es obligatorio',
        'inicio_viaje.required' => 'Esta campo es obligatorio',
        'fin_viaje.required' => 'Esta campo es obligatorio',
    ];


    public function render()
    {
        return view('livewire.check-price');
    }

    public function checkToken()
    {
        $this->response = Token::latest()->first();
        $this->response != null ? $this->checkExpiryTime() : $this->createToken();
    }

    public function createToken()
    {
        $this->rapi = Http::asForm()->post('https://apiintegracion.ins-cr.com/v1/connect/token', [
            'grant_type' => 'client_credentials',
            'client_id' => '3101571319',
            'client_secret' => '4ea792b2-a70f-ce74-9646-b07a823ab669',
            'allowed_scopes' => '',
        ]);

        $this->response = $this->rapi->collect($key = null)->all();
        $this->token = $this->response['access_token'];
        $this->expiry_time = Carbon::now()->addSeconds(3600);
        $this->uploadTokenToDb($this->response, $this->expiry_time);
    }

    public function checkExpiryTime()
    {
        $this->fecha_actual = Carbon::now();
        if ($this->response->expiry_time < $this->fecha_actual) {
            $this->response->delete();
            $this->createToken();
        } else {
            $this->token = $this->response->access_token;
            $this->checkPrice();
        }
    }

    public function uploadTokenToDb($response, $expiry_time)
    {
        Token::create([
            'access_token' => $response['access_token'],
            'expires_in' => $response['expires_in'],
            'expiry_time' => $expiry_time,
            'token_type' => $response['token_type'],
            'scope' => $response['scope']
        ]);
        $this->checkToken();
    }

    public function checkPrice()
    {
        $this->validate();

        try {
            $this->formatDateData();

            $this->responseCotizacion = Http::withToken($this->token)
                ->acceptJson()
                ->post('https://apiintegracion.ins-cr.com/v1/polizas/cotizacion', [
                    "consecutivoConfiguracion" => $this->paquete,
                    "parametros" => [
                        "TIPOIDCLI" => "",
                        "IDENTCLI" => "",
                        "PRIAPELLIDOCLI" => $this->apellido_1,
                        "SEGAPELLIDOCLI" => $this->apellido_2,
                        "PRINOMBRECLI" => $this->nombre_1,
                        "SEGNOMBRECLI" => $this->nombre_2,
                        "NOMCOMPLETOCLI" => "",
                        "GENEROCLI" => "",
                        "FECNACICLI" => $this->fFechaNacimiento,
                        "TIPOTELCLI" => "",
                        "NUMTELCLI" => "",
                        "PROVCLI" => "",
                        "CANTCLI" => "",
                        "DISTCLI" => "",
                        "CORREOE" => "",
                        "VIGDESDE" => $this->fInicioViaje,
                        "VIGHASTA" => $this->fFinViaje,
                        "NUMPOLIZA" => "",
                        "SUCEMI" => "18",
                        "AGENTE" => "6600100",
                        "FORMAPAGO" => "",
                        "DIRECRSGO" => "",
                        "MONTO2" => "",
                        "NUMOPERACION" => "",
                        "OBSERVACIONES" => "",
                        "MONTO1" => "",
                        "CBEDAD" => "34",
                        "TIPOACTRSGO" => "0010",
                        "MOASR" => "",
                        "TIPORIESGOCOB" => "01",
                        "TIPOTARIFACOB" => "0126",
                        "SUMASEGRSGO" => "",
                        "PHOSINBUC" => "",
                        "DIRECSINBUC" => "",
                        "PROVSINBUC" => "",
                        "DIASVIAJE" => "7",
                        "CLASERSGO" => $this->plan,
                        "TIPOIDBENEF1" => "",
                        "IDBENEF1" => "",
                        "NOMCOMPBENEF1" => "",
                        "PARENTESCOBENEF1" => "",
                        "PORCENTAJEBENEF1" => "",
                        "NOMBENEF1" => "",
                        "PRIAPEBENEF1" => "",
                        "SEGAPEBENEF1" => "",
                        "TIPOIDBENEF2" => "",
                        "IDBENEF2" => "",
                        "NOMCOMPBENEF2" => "",
                        "PARENTESCOBENEF2" => "",
                        "PORCENTAJEBENEF2" => "",
                        "NOMBENEF2" => "",
                        "PRIAPEBENEF2" => "",
                        "SEGAPEBENEF2" => "",
                        "TIPOIDBENEF3" => "",
                        "IDBENEF3" => "",
                        "NOMCOMPBENEF3" => "",
                        "PARENTESCOBENEF3" => "",
                        "PORCENTAJEBENEF3" => "",
                        "NOMBENEF3" => "",
                        "PRIAPEBENEF3" => "",
                        "SEGAPEBENEF3" => "",
                        "TIPOIDBENEF4" => "",
                        "IDBENEF4" => "",
                        "NOMCOMPBENEF4" => "",
                        "PARENTESCOBENEF4" => "",
                        "PORCENTAJEBENEF4" => "",
                        "NOMBENEF4" => "",
                        "PRIAPEBENEF4" => "",
                        "SEGAPEBENEF4" => ""
                    ]
                ]);
            $this->switchCotizacion = true;
            $this->responseCotizacion = $this->responseCotizacion->collect($key = null)->all();
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function formatDateData()
    {
        $this->fFechaNacimiento = Carbon::parse($this->fecha_nacimiento)->format('d/m/Y');
        $this->fInicioViaje = Carbon::parse($this->inicio_viaje)->format('d/m/Y');
        $this->fFinViaje = Carbon::parse($this->fin_viaje)->format('d/m/Y');
        $this->nombre_2 == null ? $this->nombre_2 = '' : '';
        $this->apellido_2 == null ? $this->apellido_2 = '' : '';
    }

    public function backToForm(){
        $this->switchCotizacion = false;
    }
}
