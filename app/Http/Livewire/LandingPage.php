<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;

class LandingPage extends Component
{
    public $email;
    public $showSubscribe = false;
    public $showSuccess = false;

    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email',
    ];

    public function mount(Request $request){

        if ($request->has('verified') && $request->verified == 1){
            $this->showSuccess = true;
        }
    }

    public function subscribe()
    {
        // Log::debug($this->email);
        // valida las reglas establecidas, para proseguir en las lineas de codigo siguientes
        // Si existe un error se renderizara la vista junto con la informacion del error en $errors
        $this->validate();

        DB::transaction(function () {

            $subscriber = Subscriber::create([
                'email' => $this->email
            ]);

            $notification =  new VerifyEmail;

            $notification::createUrlUsing(function($notifiable) {
                return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(30),
                    [
                        'subscriber' => $notifiable->getKey(),
                    ]
                );
            });

            $subscriber->notify($notification);

        }, $deadlockRetries = 5);

        // asigna el valor inicial
        $this->reset('email');
        $this->showSubscribe = false;
        $this->showSuccess = true;
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
