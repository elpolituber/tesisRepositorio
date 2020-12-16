<?php

namespace App\Http\Controllers\Community;

use App\Models\Cecy\Modelo1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Community\BeneficiaryInstitution;
use Illuminate\Support\Facades\Storage;

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
        $CharitableInstitution= new BeneficiaryInstitution; 
        $CharitableInstitution->state_id=1;
        $CharitableInstitution->logo=$filePath;
        $CharitableInstitution->ruc=$beneficiary_institution["ruc"];
        $CharitableInstitution->name=$beneficiary_institution["name"];
        $CharitableInstitution->address= $beneficiary_institution["address"];///aadress de la parroquia
        $CharitableInstitution->legal_representative_name=$beneficiary_institution["legal_representative_name"];
        $CharitableInstitution->legal_representative_lastname=$beneficiary_institution["legal_representative_lastname"];//boorar state-holder 
        $CharitableInstitution->legal_representative_identification=$beneficiary_institution["legal_representative_identification"];
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
        $CharitableInstitution= BeneficiaryInstitution::find($beneficiary_institution["id"]); 
        $CharitableInstitution->state_id=1;
        $CharitableInstitution->logo=$filePath;
        $CharitableInstitution->ruc=$beneficiary_institution["ruc"];
        $CharitableInstitution->name=$beneficiary_institution["name"];
        $CharitableInstitution->address= $beneficiary_institution["address"];
        $CharitableInstitution->legal_representative_name=$beneficiary_institution["legal_representative_name"];
        $CharitableInstitution->legal_representative_lastname=$beneficiary_institution["legal_representative_lastname"];
        $CharitableInstitution->legal_representative_identification=$beneficiary_institution["legal_representative_identification"];
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
