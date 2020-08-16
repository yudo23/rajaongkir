<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RajaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rajaapi');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function rajaapi_get_provinsi(){
        $curl = curl_init();
        $data_json = [];
        $output = json_decode($this->rajaapi_get_token());
        $token = $output->token;


        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://x.rajaapi.com/MeP7c5ne'.$token.'/m/wilayah/provinsi',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo $err;
        } else {

            echo $response;  
        }
    }
    public function rajaapi_get_kota(Request $request){
        $curl = curl_init();
        $data_json = [];
        $output = json_decode($this->rajaapi_get_token());
        $token = $output->token;


        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://x.rajaapi.com/MeP7c5ne'.$token.'/m/wilayah/kabupaten?idpropinsi='.$request->input('id_provinsi'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo $err;
        } else {

            echo $response;  
        }
    }
    public function rajaapi_get_kecamatan(Request $request){
        $curl = curl_init();
        $data_json = [];
        $output = json_decode($this->rajaapi_get_token());
        $token = $output->token;


        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://x.rajaapi.com/MeP7c5ne'.$token.'/m/wilayah/kecamatan?idkabupaten='.$request->input('id_kota'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo $err;
        } else {

            echo $response;  
        }
    }
    public function rajaapi_get_kelurahan(Request $request){
        $curl = curl_init();
        $data_json = [];
        $output = json_decode($this->rajaapi_get_token());
        $token = $output->token;


        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://x.rajaapi.com/MeP7c5ne'.$token.'/m/wilayah/kelurahan?idkecamatan='.$request->input('id_kecamatan'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo $err;
        } else {

            echo $response;  
        }
    }
    public function rajaapi_get_token(){
        $curl = curl_init();
        $data_json = [];

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://x.rajaapi.com/poe",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return $err;
        } else {
            return $response;  
        }
    }
    // public function wilayah(){
    //     $curl = curl_init();
    //     $data_json = [];

    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 30,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "GET",
    //       CURLOPT_HTTPHEADER => array(
    //         "key: b6403a6a525624cae2980106377216c3"
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //       echo $err;
    //     } else {
    //         echo $response;  
    //     }
    // }
    // public function kota(Request $request){
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$request->input('id_wilayah'),
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 30,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "GET",
    //       CURLOPT_HTTPHEADER => array(
    //         "key: b6403a6a525624cae2980106377216c3"
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //       echo $err;
    //     } else {
    //       echo $response;
    //     }
    // }
}
