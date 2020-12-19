<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community\BeneficiaryInstitution;
use Illuminate\Support\Facades\Storage;
use App\Models\Ignug\Address;


class beneficiaryInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $beneficiary_institution )
    {
        //img 
        $filePath = !!$beneficiary_institution["logo"] <> null?
        $beneficiary_institution["logo"]->storeAs('charitable_institution',  $beneficiary_institution["name"]. '.png', 'public')
        :null;  
        //address
        $address= new Address;
        $address->location_id=$beneficiary_institution["address"]["location"]["id"];
        $address->principal_street=$beneficiary_institution["address"]["main_street"];
        $address->secondary_street=$beneficiary_institution["address"]["secondary_street"];
        $address->state_id=1;
        $address->save();
        $fkadress=Address::where('principal_street',$beneficiary_institution["address"]["main_street"])
            ->where("secondary_street",$beneficiary_institution["address"]["secondary_street"])
            ->where("location_id",$beneficiary_institution["address"]["location"]["id"])
            ->first();
        //files

        //institution 
        $CharitableInstitution= new BeneficiaryInstitution; 
        $CharitableInstitution->state_id=1;
        $CharitableInstitution->logo=$filePath;
        $CharitableInstitution->ruc=$beneficiary_institution["ruc"];
        $CharitableInstitution->name=$beneficiary_institution["name"];
        $CharitableInstitution->address=$fkadress;///aadress de la parroquia
        $CharitableInstitution->function=$beneficiary_institution["function"];
        $CharitableInstitution->save();
        return BeneficiaryInstitution::where('ruc', $beneficiary_institution["ruc"])->first()->id;
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function show(Modelo1 $modelo1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function update($beneficiary_institution)
    {
         //img 
        $filePath = !!$beneficiary_institution["logo"] <> null?
        $beneficiary_institution["logo"]->storeAs('charitable_institution',  $beneficiary_institution["name"]. '.png', 'public')
        :null; 
        //address
        $address= Address::find($beneficiary_institution["address"]["id"]);
        $address->location_id=$beneficiary_institution["address"]["location"]["id"];
        $address->principal_street=$beneficiary_institution["address"]["main_street"];
        $address->location=$beneficiary_institution["address"]["secondary_street"];
        $address->save();
        //institution 
        $CharitableInstitution= BeneficiaryInstitution::find($beneficiary_institution["id"]); 
        $CharitableInstitution->state_id=1;
        $CharitableInstitution->logo=$filePath;
        $CharitableInstitution->ruc=$beneficiary_institution["ruc"];
        $CharitableInstitution->name=$beneficiary_institution["name"];
        $CharitableInstitution->function=$beneficiary_institution["function"];
        $CharitableInstitution->save();
        return BeneficiaryInstitution::where('ruc', $beneficiary_institution["ruc"])->first()->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cecy\Modelo1  $modelo1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelo1 $modelo1)
    {
        //
    }
    public function search(Request $request)
    {
        $charitable=!!BeneficiaryInstitution::where('ruc',$request->ruc)->first()?
        BeneficiaryInstitution::where('ruc',$request->ruc)->first():
        [];
        return $charitable;
    }
     //pdf o documentos escaneados
    // $beneficiary = BeneficiaryInstitution::findOrFail($request->user_id);
    //       $filePath = $request->beneficiary_institution["file"]
    //            ->storeAs('avatars', $user->username . '.png', 'public');
    //           $pdf = new File([
    //            // 'fileable';
                    // 'name'=>$request->beneficiary_institution["name"],
                    // 'description=>documentos',
                    // 'uri'=>filePath
                    // 'type'=>'community';
    //           ]);
    //           $pdf->fileable()->associate($beneficiary);
    //           $avatar->state()->associate(State::where('code', '1')->first());
    //           $avatar->save();
}
