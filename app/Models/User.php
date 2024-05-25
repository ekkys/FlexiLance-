<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'connect',
        'occupation'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
        //satu user satu wallet
    }

    public function walletTransaction()
    {
        //satu user banyak transaksi
        return $this->hasMany(WalletTransaction::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id')->orderByDesc('id');
        //satu user banyak project
        //client_id perlu di definisikan sebab aslinya user_id
        // cara akses $user->projects() .... menampilkan seluruh project dari user tersebut
        // dibuat supaya ketika menampilkan data tidak perlu query di viewnya sehingga lebih ringan
    }

    public function proposals()
    {
        return $this->hasMany(ProjectApplicant::class, 'freelancer_id', 'id');
        // untuk menampilkan user ini sudah apply project apa saja?
    }

    public function hasAppliedProject($projectId)
    {
        return ProjectApplicant::where('project_id', $projectId)
            ->where('freelancer_id', $this->id)
            ->exists(); // true or flase
        //satu freelancer hanya applied 1 project dalam 1 waktu,
        //jika selesai baru bisa applied lagi
        // id nya di ambilkan pas login
    }
}
