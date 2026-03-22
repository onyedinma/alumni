<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Services\AlumniIdService;
use Illuminate\Http\Request;

class AlumniIdController extends Controller
{
    protected AlumniIdService $alumniIdService;

    public function __construct(AlumniIdService $alumniIdService)
    {
        $this->alumniIdService = $alumniIdService;
    }

    /**
     * Show ID card page
     */
    public function show()
    {
        $user = auth()->user();

        $data['title'] = __('Alumni ID Card');
        $data['user'] = $user;
        $data['hasIdCard'] = !is_null($user->alumni_id_number);

        if ($data['hasIdCard']) {
            $data['idCardData'] = $this->alumniIdService->generateIdCard($user);
        }

        return view('alumni.id-card.show', $data);
    }

    /**
     * Generate ID card for current user
     */
    public function generate()
    {
        $user = auth()->user();

        $this->alumniIdService->generateIdCard($user);

        return redirect()
            ->route('alumniUser.id-card.show')
            ->with('success', __('Your Alumni ID Card has been generated!'));
    }

    /**
     * Download ID card as PDF (printable version)
     */
    public function download()
    {
        $user = auth()->user();

        if (!$user->alumni_id_number) {
            return redirect()
                ->route('alumniUser.id-card.show')
                ->with('error', __('Please generate your ID card first.'));
        }

        $data = $this->alumniIdService->generateIdCard($user);

        // Return printable HTML view (user can use browser print to PDF)
        return view('alumni.id-card.print', ['data' => $data]);
    }

    /**
     * Public verification page
     */
    public function verify(string $alumniId)
    {
        $user = $this->alumniIdService->verifyAlumniId($alumniId);

        $data['title'] = __('Verify Alumni');
        $data['alumniId'] = $alumniId;
        $data['verified'] = !is_null($user);

        if ($user) {
            $data['alumni'] = [
                'name' => $user->name,
                'id' => $user->alumni_id_number,
                'graduation_year' => $user->alumni?->passing_year ?? 'N/A',
                'photo' => $user->image ? getFileUrl($user->image) : null,
            ];
        }

        return view('frontend.verify-alumni', $data);
    }
}
