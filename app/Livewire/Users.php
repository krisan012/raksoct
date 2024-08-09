<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;

    public function mount()
    {
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.users');
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);

        if($user){
            $user->delete();
            session()->flash('message', 'user deleted successfully');
            $this->fetchUsers();
        }
    }
}
