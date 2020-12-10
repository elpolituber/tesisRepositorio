<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ignug\Catalogue;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::connection('pgsql-community')->table('beneficiary_institutions')->insert([    
            'state_id'=>1,
            'ruc'=>'1234567891',
            'name'=>"FUNDACION VISTA PARA TODOS",
            //'address'=>1, //fk propia
            //
            'legal_representative_name'=>"RODRIGO",
            'legal_representative_lastname'=>"nogales",
            'legal_representative_identification'=>1725485277,
            'function'=>1,//CARGO
            //
            ]);
        
            DB::connection('pgsql-community')->table('projects')->insert([  
            'beneficiary_institution'=>1,                 
            'career_id'=>1,
          //  'assigned_line_id'=>4,//pendiente//lineas de investigacion
            'code'=>'yavirac1223',
            'title'=>'Systema ayuda a los pobres',
            'status_id'=>1,//catalogo propio una fk 
            'state_id'=>1,
            'field'=>"campo",//campo de area de vinculacion
            'direct_beneficiaries'=> json_encode(['VISTA PARA TODOS']),
            'indirect_beneficiaries'=> json_encode([ 'bio']),
            //'aim'=>'objeto',//objeto
            'frequency_activities'=>4,//frecuencia de actividades
            //'cycle'=>"121",//ciclo
            'location_id'=>1,
            'lead_time'=>3,//plazo de ejecucion
            /* 'delivery_date'=>01/05/2020,// tiempo
            'start_date'=>11/05/2020,// tiempo
            'end_date'=>11/07/2020, */
            'description'=>'ofdasdsafsda',//DESCRIPCION GENERAL  DEL PROYECTO.
            // 'coordinator_name'=>'OLIVER',
            // 'coordinator_lastname'=>'NESTLES',
            // 'coordinator_postition'=>'POSITION',
            // 'coordinator_funtion'=>'coordinator',
            'introduction'=>'AFDSFDSDDSAFASSD',
            'situational_analysis'=>'AASDSDDSAAFDSSAF',//ANALISIS SITUACIONAL (DIAGNOSTICO)
            'foundamentation'=>'SADADASD',
            'justification'=>"ADSSDFDSF",
            'create_by'=>1,
            'bibliografia'=>json_encode(["SE PONE LA BIBLIOGRAFIA"])
            ]);
            //Objetivo general
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Número de estudiantes capacidades en el área de informática ",
                'means_verification'=>json_encode(['Listado de asistencia']),
                'description'=>'Brindar una capacitación en ofimática básica a niños de 8 a 12 años mediante talleres y trabajos dirigidas para su desarrollo educativo',//linea base
                'type'=>Catalogue::where('code','aims_types_1')->first('id')->id,//crear tipo de catologos
                'children'=>null,//tabla recusiva               
            ]);
            //Objetivo especifico
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Número de máquinas por realizar mantenimiento ",
                'means_verification'=>json_encode(['Informe de estado de maquinas ']),
                'description'=>'Analizar el estado general  de las maquinas mediante una revisión preliminar para verificar el estado y las condiciones de los equipos informáticos',//linea base
                'type'=>Catalogue::where('code','aims_types_2')->first('id')->id,//crear tipo de catologos
                'children'=>1,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Número de máquinas formateadas",
                'means_verification'=>json_encode(['Informe de finalización de mantenimiento']),
                'description'=>'Realizar el mantenimiento del centro de cómputo de CENIT para tener un mejor funcionamiento de los equipos.',//linea base
                'type'=>Catalogue::where('code','aims_types_2')->first('id')->id,//crear tipo de catologos
                'children'=>1,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Listado de temas a tratar ",
                'means_verification'=>json_encode(['Cronograma de actividades']),
                'description'=>'Iniciar las capacitación en ofimática básica para el desarrollo estudiantil de los niños que acuden al centro cenit',//linea base
                'type'=>Catalogue::where('code','aims_types_2')->first('id')->id,//crear tipo de catologos
                'children'=>1,//tabla recusiva               
            ]);
            //Resultados
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'Conocer el número de máquinas que tienen inconvenientes para su funcionamiento ',//linea base
                'type'=>Catalogue::where('code','aims_types_4')->first('id')->id,//crear tipo de catologos
                'children'=>2,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'Realización de mantenimiento preventivo y correctivo a las maquinas del centro',//linea base
                'type'=>Catalogue::where('code','aims_types_4')->first('id')->id,//crear tipo de catologos
                'children'=>3,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Número de estudiantes aprobados",
                'means_verification'=>json_encode(['Calificaciones']),
                'description'=>'Estudiantes capacitados',//linea base
                'type'=>Catalogue::where('code','aims_types_4')->first('id')->id,//crear tipo de catologos
                'children'=>4,//tabla recusiva               
            ]);
            //Actividades
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'1.1.1 Reconocimiento del área de trabajo',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>2,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'1.1.2 Revisión preliminar de las maquinas',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>2,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'1.1.3 Entrega de informe de estado de las maquinas',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>2,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'2.1.1 Tareas dirigidas a los niños',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>3,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Documentación técnica",
                'means_verification'=>json_encode(['Informe técnico']),
                'description'=>'Avance del mantenimiento de las maquinas',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>3,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Número de estudiantes aprobados",
                'means_verification'=>json_encode(['Lista de estudiantes']),
                'description'=>'3.1.1 Clases básicas de ofimática ',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>4,//tabla recusiva               
            ]);
            DB::connection('pgsql-community')->table('objectives')->insert([  
                'state_id'=>1,
                'project_id'=>1,
                'indicator'=>"Número de estudiantes",
                'means_verification'=>json_encode(['Lista de estudiantes']),
                'description'=>'3.1.1 Número de estudiantes capacitados y aprobados',//linea base
                'type'=>Catalogue::where('code','aims_types_3')->first('id')->id,//crear tipo de catologos
                'children'=>4,//tabla recusiva               
            ]);

            DB::connection('pgsql-community')->table('activities')->insert([
                'state_id'=>1,
                'project_id'=>1,
                'type_id'=>Catalogue::where('code','assigned_line_1')->first('id')->id,//un catalogo unico de la tabla
                'description'=>"esto es una prueba"    
            ]);
            DB::connection('pgsql-community')->table('stake_holders')->insert([
                'name'=>'pepito de los palotes',
                'identification'=>'1212321323',
                'position'=>'conserje',
                'state_id'=>1,
                'type'=>Catalogue::where('code','cargo_5')->first('id')->id,//
                'function'=>1,
                'project_id'=>1
            ]);
            DB::connection('pgsql-community')->table('participants')->insert([
                'state_id'=>1,
                'user_id'=>1,
                'project_id'=>1,
                'type'=>1,
                'position'=>'noce para esto',
                'project_id'=>1,
                'working_hours'=>1000,//horas de trabajo
                'function'=>Catalogue::where('code','cargo_7')->first('id')->id//rol asignado catalogo
            ]); 

    /* 
    {
        "id": 1,
        "beneficiary_institution": {
            "id": 1,
            "state_id": 1,
            "logo": null,
            "ruc": "1234567891",
            "name": "FUNDACION VISTA PARA TODOS",
            "address": null,
            "legal_representative_name": "RODRIGO",
            "legal_representative_lastname": "nogales",
            "legal_representative_identification": "1725485277",
            "function": "1",
            "created_at": null,
            "updated_at": null,
            "state": {
                "id": 1,
                "code": "1",
                "name": "ACTIVE"
            }
        },
        "school_period": 1,
        "career_id": 1,
        "code": "yavirac1223",
        "title": "Systema ayuda a los pobres",
        "status_id": 1,
        "state_id": 1,
        "field": "campo",
        "frequency_activities": {
            "id": 4,
            "parent_id": null,
            "code": "status_1",
            "name": "EN PROCESO",
            "type": "status_vinculacion",
            "icon": "facere",
            "state_id": 1,
            "created_at": "2020-12-09T16:08:27.000000Z",
            "updated_at": "2020-12-09T16:08:27.000000Z"
        },
        "cycle": ["hola"],
        "location_id": 1,
        "lead_time": 3,
        "delivery_date": null,
        "start_date": null,
        "end_date": null,
        "description": "ofdasdsafsda",
        "indirect_beneficiaries": ["bio"],
        "direct_beneficiaries": ["VISTA PARA TODOS"],
        "introduction": "AFDSFDSDDSAFASSD",
        "situational_analysis": "AASDSDDSAAFDSSAF",
        "foundamentation": "SADADASD",
        "justification": "ADSSDFDSF",
        "create_by": 1,
        "observations": ["qasad","hola"],
        "bibliografia": ["SE PONE LA BIBLIOGRAFIA" ],
        "created_at": null,
        "updated_at": null,
        "status": {
            "id": 1,
            "parent_id": null,
            "code": "attendance",
            "name": "ATTENDANCE",
            "type": "systems",
            "icon": "alias",
            "state_id": 1,
            "created_at": "2020-12-09T16:08:26.000000Z",
            "updated_at": "2020-12-09T16:08:26.000000Z"
        },
        "career": {
            "id": 1,
            "institution_id": 1,
            "code": "c12",
            "name": "desarrollo de software",
            "description": "assdadasdljafhjkasn",
            "modality_id": 67,
            "resolution_number": null,
            "title": "asdasffdsadsf",
            "acronym": "desarrollo",
            "type_id": 1,
            "state_id": 1,
            "created_at": null,
            "updated_at": null,
            "state": {
                "id": 1,
                "code": "1",
                "name": "ACTIVE"
            },
            "modality": {
                "id": 67,
                "parent_id": null,
                "code": "4",
                "name": "DUAL",
                "type": "career_modality",
                "icon": "quia",
                "state_id": 1,
                "created_at": "2020-12-09T16:08:27.000000Z",
                "updated_at": "2020-12-09T16:08:27.000000Z",
                "state": {
                    "id": 1,
                    "code": "1",
                    "name": "ACTIVE"
                }
            }
        },
        "location": {
            "id": 1,
            "parent_id": null,
            "code": "attendance",
            "name": "ATTENDANCE",
            "type": "systems",
            "icon": "alias",
            "state_id": 1,
            "created_at": "2020-12-09T16:08:26.000000Z",
            "updated_at": "2020-12-09T16:08:26.000000Z"
        },
        "participant": [
            {
                "id": 1,
                "state_id": 1,
                "user_id": 1,
                "project_id": 1,
                "position": "noce para esto",
                "type": {
                    "id": 1,
                    "parent_id": null,
                    "code": "attendance",
                    "name": "ATTENDANCE",
                    "type": "systems",
                    "icon": "alias",
                    "state_id": 1,
                    "created_at": "2020-12-09T16:08:26.000000Z",
                    "updated_at": "2020-12-09T16:08:26.000000Z",
                    "state": {
                        "id": 1,
                        "code": "1",
                        "name": "ACTIVE"
                    }
                },
                "working_hours": 1000,
                "function": {
                    "id": 74,
                    "parent_id": null,
                    "code": "cargo_7",
                    "name": "PROFESOR",
                    "type": "cargo_vincualcion",
                    "icon": "voluptate",
                    "state_id": 1,
                    "created_at": "2020-12-09T16:08:27.000000Z",
                    "updated_at": "2020-12-09T16:08:27.000000Z",
                    "state": {
                        "id": 1,
                        "code": "1",
                        "name": "ACTIVE"
                    }
                },
                "created_at": null,
                "updated_at": null,
                "user": {
                    "id": 1,
                    "ethnic_origin_id": null,
                    "address_id": null,
                    "identification_type_id": null,
                    "identification": "9861411111",
                    "first_name": null,
                    "second_name": null,
                    "first_lastname": null,
                    "second_lastname": null,
                    "sex_id": null,
                    "gender_id": null,
                    "personal_email": null,
                    "birthdate": null,
                    "blood_type_id": null,
                    "username": "1234567890",
                    "email": "rutherford.antwon@example.org",
                    "email_verified_at": null,
                    "change_password": false,
                    "state_id": 1,
                    "created_at": "2020-12-09T16:08:26.000000Z",
                    "updated_at": "2020-12-09T16:08:26.000000Z",
                    "state": {
                        "id": 1,
                        "code": "1",
                        "name": "ACTIVE"
                    }
                }
            }
        ],
        "activities": [
            {
                "id": 1,
                "state_id": 1,
                "project_id": 1,
                "type_id": 16,
                "description": "esto es una prueba",
                "created_at": null,
                "updated_at": null,
                "state": {
                    "id": 1,
                    "code": "1",
                    "name": "ACTIVE"
                },
                "type": {
                    "id": 16,
                    "parent_id": null,
                    "code": "assigned_line_1",
                    "name": "GESTION DE INTEGRACION DEL PROYECTO",
                    "type": "assigned_line_vinculacion",
                    "icon": "rerum",
                    "state_id": 1,
                    "created_at": "2020-12-09T16:08:27.000000Z",
                    "updated_at": "2020-12-09T16:08:27.000000Z",
                    "state": {
                        "id": 1,
                        "code": "1",
                        "name": "ACTIVE"
                    }
                }
            }
        ],
        "stake_holder": [
            {
                "id": 1,
                "state_id": 1,
                "project_id": 1,
                "name": "pepito de los palotes",
                "lastname": null,
                "identification": "1212321323",
                "position": "conserje",
                "type": {
                    "id": 72,
                    "parent_id": null,
                    "code": "cargo_5",
                    "name": "COORDINADOR DE VINCUALCION(EMPRESA)",
                    "type": "cargo_vincualcion",
                    "icon": "dolorum",
                    "state_id": 1,
                    "created_at": "2020-12-09T16:08:27.000000Z",
                    "updated_at": "2020-12-09T16:08:27.000000Z"
                },
                "function":{"id": 1},
                "created_at": null,
                "updated_at": null,
                "state": {
                    "id": 1,
                    "code": "1",
                    "name": "ACTIVE"
                }
            }
        ],
        "objetive": [
            {
                "id": 1,
                "state_id": 1,
                "project_id": 1,
                "indicator": "Número de estudiantes capacidades en el área de informática ",
                "means_verification": [
                    "Listado de asistencia"
                ],
                "description": "Brindar una capacitación en ofimática básica a niños de 8 a 12 años mediante talleres y trabajos dirigidas para su desarrollo educativo",
                "type": {
                    "id": 25,
                    "parent_id": null,
                    "code": "aims_types_1",
                    "name": "OBJETIVO GENERAL",
                    "type": "aims_types_vinculacion",
                    "icon": "hic",
                    "state_id": 1,
                    "created_at": "2020-12-09T16:08:27.000000Z",
                    "updated_at": "2020-12-09T16:08:27.000000Z"
                },
                "children": [
                    {
                        "id": 2,
                        "state_id": 1,
                        "project_id": 1,
                        "indicator": "Número de máquinas por realizar mantenimiento ",
                        "means_verification": [
                            "Informe de estado de maquinas "
                        ],
                        "description": "Analizar el estado general  de las maquinas mediante una revisión preliminar para verificar el estado y las condiciones de los equipos informáticos",
                        "type": 26,
                        "children": [
                            {
                                "id": 5,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "Conocer el número de máquinas que tienen inconvenientes para su funcionamiento ",
                                "type": 28,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 8,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "1.1.1 Reconocimiento del área de trabajo",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 9,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "1.1.2 Revisión preliminar de las maquinas",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 10,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "1.1.3 Entrega de informe de estado de las maquinas",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            }
                        ],
                        "created_at": null,
                        "updated_at": null
                    },
                    {
                        "id": 3,
                        "state_id": 1,
                        "project_id": 1,
                        "indicator": "Número de máquinas formateadas",
                        "means_verification": [
                            "Informe de finalización de mantenimiento"
                        ],
                        "description": "Realizar el mantenimiento del centro de cómputo de CENIT para tener un mejor funcionamiento de los equipos.",
                        "type": 26,
                        "children": [
                            {
                                "id": 6,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "Realización de mantenimiento preventivo y correctivo a las maquinas del centro",
                                "type": 28,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 11,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "2.1.1 Tareas dirigidas a los niños",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 12,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Documentación técnica",
                                "means_verification": [
                                    "Informe técnico"
                                ],
                                "description": "Avance del mantenimiento de las maquinas",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            }
                        ],
                        "created_at": null,
                        "updated_at": null
                    },
                    {
                        "id": 4,
                        "state_id": 1,
                        "project_id": 1,
                        "indicator": "Listado de temas a tratar ",
                        "means_verification": [
                            "Cronograma de actividades"
                        ],
                        "description": "Iniciar las capacitación en ofimática básica para el desarrollo estudiantil de los niños que acuden al centro cenit",
                        "type": 26,
                        "children": [
                            {
                                "id": 7,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Número de estudiantes aprobados",
                                "means_verification": [
                                    "Calificaciones"
                                ],
                                "description": "Estudiantes capacitados",
                                "type": 28,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 13,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Número de estudiantes aprobados",
                                "means_verification": [
                                    "Lista de estudiantes"
                                ],
                                "description": "3.1.1 Clases básicas de ofimática ",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            },
                            {
                                "id": 14,
                                "state_id": 1,
                                "project_id": 1,
                                "indicator": "Número de estudiantes",
                                "means_verification": [
                                    "Lista de estudiantes"
                                ],
                                "description": "3.1.1 Número de estudiantes capacitados y aprobados",
                                "type": 27,
                                "children": [],
                                "created_at": null,
                                "updated_at": null
                            }
                        ],
                        "created_at": null,
                        "updated_at": null
                    }
                ],
                "created_at": null,
                "updated_at": null
            }
        ]
    }
*/
    }
}
