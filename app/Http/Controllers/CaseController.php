<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaseRequest;
use App\Models\CaseFile;
use App\Models\ClientCase;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CaseController extends Controller
{
    public function view(int $id): View
    {
        $case = ClientCase::with('client', 'court')->where('id', $id)->first();

        return view('cases.view')->with('case', $case);
    }

    public function viewFiles(int $id, string $case_number): View
    {
        $files = CaseFile::where('case_id', $id)->paginate(3);
        $case = ClientCase::where('id', $id)->first();

        return view('cases.view-files')->with([
            'files' => $files,
            'case' => $case,
        ]);
    }

    public function streamFile(string $path)
    {
        $file = Storage::path("public/uploads/{$path}");

        return response()->file($file);
    }

    public function destroyFile(CaseFile $file)
    {
        $file->delete();

        return redirect()->back()->with('success', 'Deleted successully.');
    }

    public function create(CaseRequest $caseRequest): RedirectResponse
    {
        $data = $caseRequest->validated();
        $courts = $caseRequest->validate([
            'court_name' => 'required',
            'court_address' => 'required',
            'court_date' => 'required',
        ]);
        $filesValidate = $caseRequest->validate([
            'case_files.*' => 'file|max:2048',
        ]);

        try {
            $case = ClientCase::create($data);
            $case->client()->create($data);
            $case->court()->create($courts);
            if (! empty($filesValidate['case_files'])) {
                foreach ($filesValidate['case_files'] as $file) {
                    $filename = $file->getClientOriginalName();
                    $removeExtensionName = pathinfo($filename, PATHINFO_FILENAME);
                    $removeExtensionName = preg_replace('/[^a-zA-Z0-9]/', '', $removeExtensionName);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $filteredFileName = "{$removeExtensionName}.{$extension}";
                    $filePath = $file->storeAs('uploads', $filteredFileName, 'public');
                    $files = [
                        'case_filename' => $removeExtensionName,
                        'case_filepath' => $filePath,
                        'case_fileuploader' => auth()->user()->name,
                    ];
                    $case->files()->create($files);
                }
            }

            return redirect()->back()->with('success', 'Case created.');
        } catch (Exception $exception) {
            Log::error('@case', [
                'msg' => $exception->getMessage(),
            ]);

            return redirect()->back()->with('failed', 'Failed to create a new case.');
        }
    }

    public function uploadFIles(Request $request, int $id)
    {
        try {
            if (! empty($request['case_files'])) {
                foreach ($request['case_files'] as $file) {
                    $filename = $file->getClientOriginalName();
                    $removeExtensionName = pathinfo($filename, PATHINFO_FILENAME);
                    $removeExtensionName = preg_replace('/[^a-zA-Z0-9]/', '', $removeExtensionName);
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $filteredFileName = "{$removeExtensionName}.{$extension}";
                    $filePath = $file->storeAs('uploads', $filteredFileName, 'public');
                    $files = [
                        'case_id' => $id,
                        'case_filename' => $removeExtensionName,
                        'case_filepath' => $filePath,
                        'case_fileuploader' => auth()->user()->name,
                    ];
                    CaseFile::create($files);
                }
            } else {
                return redirect()->back()->with('failed', 'No files were uploaded.');
            }

            return redirect()->back()->with('success', 'New files were uploaded.');
        } catch (Exception $exception) {
            Log::error('@case', [
                'msg' => $exception->getMessage(),
            ]);

            return redirect()->back()->with('failed', 'Failed to upload a new files.');
        }
    }

    public function add(Request $request, ClientCase $case): RedirectResponse
    {
        $data = $request->validate([
            'court_name' => 'required',
            'court_address' => 'required',
            'court_date' => 'required',
        ]);
        try {
            $case->court()->create($data);

            return redirect()->back()->with('success', 'New court added.');
        } catch (Exception $exception) {
            Log::error('@court_add', [
                'msg' => $exception->getMessage(),
            ]);

            return redirect()->back()->with('failed', 'Failed to add a new court.');
        }
    }

    public function update(CaseRequest $caseRequest, ClientCase $case)
    {
        $data = $caseRequest->separatedRequest();
        try {
            $case->update($data['caseData']);
            $case->client()->update($data['clientData']);
            foreach ($data['courtData'] as $court) {

                $row = $case->court()->find($court['row_id']);
                if ($row) {
                    $row->update($court);
                }
            }

            return redirect()->back()->with('success', 'Updated successfully.');
        } catch (Exception $exception) {
            Log::error('@update_case', [
                'msg' => $exception->getMessage(),
            ]);

            return redirect()->back()->with('failed', 'Failed to update.');
        }
    }

    public function destroy(ClientCase $case)
    {
        $title = $case->case_title;
        $case->delete();

        return redirect()->route('case')->with('success', "{$title} case has successully deleted.");
    }
}
