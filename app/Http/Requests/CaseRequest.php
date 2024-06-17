<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;

class CaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'case_plaintiff' => 'required',
            'case_defendant' => 'required',
            'case_relation' => 'required',
            'case_type' => 'required',
            'case_status' => 'required',
            'case_description' => 'required',
            'case_docsready' => 'required',
            'case_date' => 'required',
            'client_company' => 'required',
            'client_representative' => 'required',
            'client_email' => 'required',
            'client_mobile' => 'required',
            'courts.*.row_id'=>"required",
            'courts.*.court_name'=>"required",
            'courts.*.court_address'=>"required",
            'courts.*.court_date'=>"required",


        ];
    }

    public function separatedRequest()
    {
        $data = $this->validated();

        return [
            'caseData' => Arr::only($data, ['case_plaintiff', 'case_defendant', 'case_relation','case_type','case_status', 'case_description', 'case_docsready', 'case_date']),
            'clientData' => Arr::only($data, ['client_company', 'client_representative', 'client_email', 'client_mobile']),
            'courtData' => $data['courts'] ?? [],
        ];
    }

    public function messages()
    {
        //'required' => 'The :attribute field is required.',
        return [
            'case_plaintiff.required' => 'Please provide a name for plaintiff.',
            'case_defendant.required' => 'Please provide a name for defendant.',
            'case_relation.required' => 'The seet relation field is required.',
            'case_type.required' => 'Set the type of case.',
            'case_status.required' => 'Set the status of the case.',
            'case_description.required' => 'Provide description to the case.',
            'case_docsready.required' => 'Please confirm the documents.',
            'case_date.required' => 'Set the date of the case.',
            'client_representative.required' => 'Provide the name of the repesentative.',
            'client_mobile.required' => 'Enter the client\'s mobile number.',
            'client_email.required' => 'Enter the client\'s email.',
            'client_company.required' => 'Provide the name of the company.',
            'court_name.required' => 'The court name field is required.',
            'court_address.required' => 'Add the address of the court.',
            'court_date.required' => 'Provide the date for the court.',
        ];
    }
}
