<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClientController extends Controller {
    public function index() {
        $clients = User::get();
        return view( 'dashboard.client.index', compact( 'clients' ) );
    }

    public function store(Request $request) {
        $path     = 'uploads/avatar';
        $filename = Str::slug( uniqid( 'pass-port-entry' ) . time() ) . "." . $request->file( 'avatar' )->extension();
        $avatar   = $request->file( 'avatar' )->storeAs( $path, $filename, 'public' );
        $client   = User::create( [
            ...$request->except( '_token' ),
            'avatar' => $avatar,
        ] );
        notify()->success( 'Client created successfully!' );
        return back();
    }


    public function destroy(User $client) {
        $client->delete();
        notify()->success( 'Client deleted successfully' );
        return back();
    }
}
