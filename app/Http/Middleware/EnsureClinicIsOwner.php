<?php

namespace App\Http\Middleware;

use App\Models\Patient;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureClinicIsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $patientClinic = Patient::find($request->route('id'))->medical_unit_id;
        $currentClinic = Auth::user()->medical_unit_id;

        if($patientClinic != $currentClinic) {
            return abort(403, 'No tienes permiso para acceder a esta ruta.');
        }

        return $next($request);
    }
}
