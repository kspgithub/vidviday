<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\Order;
use App\Models\OrderNote;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Providers\RouteServiceProvider;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    //

    public function index()
    {
        return view('profile.index');
    }


    public function update(UpdateProfileRequest $request)
    {
        $this->validate($request, [
            'avatar_upload' => ['nullable', 'file', 'max:500']
        ]);

        $user = current_user();

        if($request->current_password) {
            if(!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withFlashError('Неправильний пароль');
            }
        }

        if($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        $user->fill($request->validated());

        $user->save();

        if ($request->hasFile('avatar_upload')) {
            $user->uploadAvatar($request->file('avatar_upload'));
        }

        if ($request->ajax()) {
            return response()->json(['result' => 'OK']);
        }
        return redirect()->back()->withFlashSuccess('Профіль оновлено');
    }

    public function orders()
    {
        $user = current_user();
        $orders = $user->orders()->with(['tour', 'notes'])->paginate(20);
        return view('profile.orders', ['orders' => $orders]);
    }


    public function addNote(Request $request)
    {
        $request->validate(['text' => 'required']);
        $user = current_user();
        $text = $request->input('text', '');
        if (!empty($text)) {
            /**
             * @var Order $order
             */
            $order = $user->orders()->findOrFail($request->input('order_id', 0));

            $note = new OrderNote(['text' => $text, 'order_id' => $order->id]);
            $note->save();

            if ($request->ajax()) {
                return response()->json(['result' => 'success', 'note' => $note]);
            }
        }
        return redirect()->back()->withFlashSuccess(__('Notes added'));
    }


    public function history(Request $request)
    {

        $user = current_user();
        if ($request->ajax()) {
            return $user->tourHistory()->search(false)->paginate(12);
        }

        return view('profile.history');
    }


    public function favourites(Request $request)
    {
        $user = current_user();
        if ($request->ajax()) {
            return $user->tourFavourites()->search(false)->paginate(12);
        }
        return view('profile.favourites');
    }


    public function deleteAccount()
    {

        return view('profile.delete');
    }

    public function confirmDelete(Request $request)
    {
        $this->service->deleteAccount(current_user()->id);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::put('deletedUser', true);

        return redirect()->route('delete.successfully-deleted');
    }

    public function successfullyDeleted(Request $request) {
        if (!Session::get('deletedUser')) {
            return redirect(RouteServiceProvider::HOME);
        }

        Session::put('deletedUser', false);

        return view('profile.successfully-deleted');
    }
}
