<?php

namespace App\Models\Authentication;

use App\Models\Ignug\Catalogue;
use App\Models\Ignug\Image;
use App\Models\Ignug\State;
use App\Models\Ignug\Teacher;
use App\Models\JobBoard\Company;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, Notifiable, HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql-authentication';

    protected $fillable = [
        'identification',
        'first_name',
        'second_name',
        'first_lastname',
        'second_lastname',
        'personal_email',
        'birthdate',
        'username',
        'email',
        'email_verified_at',
        'password',
        'change_password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rules()
    {
        return [
            'email.unique' => 'The email has already been taken.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'username.unique' => 'The username has already been taken.',
        ];
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function professional()
    {
        return $this->hasOne(Professional::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function ethnicOrigin()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function location()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function identificationType()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function sex()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function gender()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
