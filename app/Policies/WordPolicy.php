<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Word;
use Illuminate\Auth\Access\HandlesAuthorization;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Word $word)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Auth\Access\Response|bool
     */
   
    // در فایل app/Policies/WordPolicy.php

public function update(User $user, Word $word)
{
    
    // شرطی که تعیین می‌کند آیا کاربر اجازه ویرایش دارد یا خیر
    // مثلا می‌توانید بررسی کنید که آیا کاربر همان کاربری است که این کلمه را ایجاد کرده است یا خیر
    // به عنوان مثال: return $user->id === $word->user_id;
    // در اینجا، فرض می‌کنیم فقط کاربر با شناسه 1 اجازه ویرایش دارد
    return $user->id === 1;
}


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Word $word)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Word $word)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Word $word)
    {
        //
    }
}
