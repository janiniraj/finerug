<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        // Where to redirect users after registering
        $this->redirectTo = route(homeRoute());

        $this->user = $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerAjax(Request $request)
    {
        $postData = $request->all();

        $success = true;

        if($this->user->query()->where('email', $request->only('email'))->count() > 0)
        {
            $success = false;
            $errorMessage[] = "User Already Exist With same Email.";
        }

        if($postData['password'] != $postData['password_confirmation'])
        {
            $success = false;
            $errorMessage[] = "The password confirmation does not match.";
        }

        if($success == true)
        {
            if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
                $user = $this->user->create($request->only('first_name', 'last_name', 'email', 'password'));
                event(new UserRegistered($user));

                $response = [
                    'success' => true,
                    'redirectPath' => $this->redirectPath(),
                    'error' => false,
                    'message' => config('access.users.requires_approval') ?
                        trans('exceptions.frontend.auth.confirmation.created_pending') :
                        trans('exceptions.frontend.auth.confirmation.created_confirm')
                ];
                
            } else {
                access()->login($this->user->create($request->only('first_name', 'last_name', 'email', 'password')));
                event(new UserRegistered(access()->user()));

                $response = [
                    'success' => true,
                    'redirectPath' => $this->redirectPath(),
                    'error' => false,
                    'message' => 'Thank you for Account Creation.'
                ];
            }

            return Response::json($response);
        }
        else
        {
            return Response::json([
                'success' => $success,
                'redirectPath' => false,
                'error' => implode("<br/>", $errorMessage)
            ]);
        }        
    }

    public function register(RegisterRequest $request)
    {
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            $user = $this->user->create($request->only('first_name', 'last_name', 'email', 'password'));
            event(new UserRegistered($user));

            return redirect($this->redirectPath())->withFlashSuccess(
                config('access.users.requires_approval') ?
                    trans('exceptions.frontend.auth.confirmation.created_pending') :
                    trans('exceptions.frontend.auth.confirmation.created_confirm')
            );
        } else {
            access()->login($this->user->create($request->only('first_name', 'last_name', 'email', 'password')));
            event(new UserRegistered(access()->user()));

            return redirect($this->redirectPath());
        }
    }
}
