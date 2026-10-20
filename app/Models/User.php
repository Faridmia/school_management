<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'user_type',
        'phone',
        'admission_number',
        'roll_number',
        'class_id',
        'gender',
        'date_of_birth',
        'caste',
        'religion',
        'mobile_number',
        'admission_date',
        'profile_pic',
        'blood_group',
        'height',
        'weight',
        'parent_id',
        'occupation',
        'address',
        'marital_status',
        'date_of_joining',
        'permanent_address',
        'qualification',
        'work_experience',
        'note',
        'status',
        'is_admin',
        'is_delete',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getTeacher()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);

        if (!empty(Request::get('name'))) {
            $return = $return->where(function($query) {
                $query->where('users.name', 'like', '%' . trim(Request::get('name')) . '%')
                      ->orWhere('users.last_name', 'like', '%' . trim(Request::get('name')) . '%');
            });
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . trim(Request::get('last_name')) . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . trim(Request::get('email')) . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', trim(Request::get('gender')));
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . trim(Request::get('mobile_number')) . '%');
        }
        if (!empty(Request::get('marital_status'))) {
            $return = $return->where('users.marital_status', 'like', '%' . trim(Request::get('marital_status')) . '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . trim(Request::get('address')) . '%');
        }
        if (Request::get('status') !== null && Request::get('status') !== '') {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(Request::get('date_of_joining'))) {
            $return = $return->whereDate('users.date_of_joining', '=', Request::get('date_of_joining'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getParent()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 4)
            ->where('users.is_delete', '=', 0);

        if (!empty(Request::get('name'))) {
            $return = $return->where(function($query) {
                $query->where('users.name', 'like', '%' . trim(Request::get('name')) . '%')
                      ->orWhere('users.last_name', 'like', '%' . trim(Request::get('name')) . '%');
            });
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . trim(Request::get('email')) . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', trim(Request::get('gender')));
        }
        if (!empty(Request::get('occupation'))) {
            $return = $return->where('users.occupation', 'like', '%' . trim(Request::get('occupation')) . '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . trim(Request::get('address')) . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . trim(Request::get('mobile_number')) . '%');
        }
        if (Request::get('status') !== null && Request::get('status') !== '') {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static public function getSearchStudent()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email'))) {
            $return = self::select('users.*', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
                ->leftJoin('users as parent', 'parent.id', '=', 'users.parent_id')
                ->where('users.user_type', '=', 3)
                ->where('users.is_delete', '=', 0);

            if (!empty(Request::get('id'))) {
                $return = $return->where('users.id', '=', trim(Request::get('id')));
            }
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%' . trim(Request::get('name')) . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%' . trim(Request::get('last_name')) . '%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%' . trim(Request::get('email')) . '%');
            }

            $return = $return->orderBy('users.id', 'desc')
                ->limit(50)
                ->get();

            return $return;
        }
        return [];
    }

    static public function getMyStudent($parent_id)
    {
        $return = self::select('users.*', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->leftJoin('users as parent', 'parent.id', '=', 'users.parent_id')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'desc')
            ->get();

        return $return;
    }

    static public function getStudent()
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->leftJoin('class', 'class.id', '=', 'users.class_id')
            ->leftJoin('users as parent', 'parent.id', '=', 'users.parent_id')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . trim(Request::get('name')) . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . trim(Request::get('last_name')) . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . trim(Request::get('email')) . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . trim(Request::get('admission_number')) . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . trim(Request::get('roll_number')) . '%');
        }
        if (!empty(Request::get('class'))) {
            $return = $return->where('class.name', 'like', '%' . trim(Request::get('class')) . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', '=', trim(Request::get('gender')));
        }
        if (!empty(Request::get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . trim(Request::get('caste')) . '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . trim(Request::get('religion')) . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . trim(Request::get('mobile_number')) . '%');
        }
        if (!empty(Request::get('blood_group'))) {
            $return = $return->where('users.blood_group', 'like', '%' . trim(Request::get('blood_group')) . '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('users.created_at', '=', Request::get('date'));
        }
        if (Request::get('status') !== null && Request::get('status') !== '') {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->where('users.status', '=', $status);
        }

        $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);

        return $return;
    }

    static function getAdminList()
    {
        return User::select('users.*')
            ->where('user_type', 1)
            ->where('is_delete', 0 )
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getProfilePicUrl()
    {
        if (!empty($this->profile_pic) && file_exists(public_path('upload/profile/' . $this->profile_pic))) {
            return asset('upload/profile/' . $this->profile_pic);
        }
        return asset('assets/img/user1-128x128.jpg');
    }

    public function getProfile()
    {
        return $this->getProfilePicUrl();
    }
}
