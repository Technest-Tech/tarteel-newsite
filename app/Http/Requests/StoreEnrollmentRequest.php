<?php

namespace App\Http\Requests;

use App\Models\Enrollment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The locale the visitor was using when the form was submitted. Every
     * validation message and the success panel are rendered in it.
     */
    public function locale(): string
    {
        return $this->string('source_locale')->value() === 'ar' ? 'ar' : 'en';
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'source_locale' => $this->locale(),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:filter', 'max:180'],
            'phone' => ['required', 'string', 'max:40'],
            'country' => ['nullable', 'string', 'max:100'],
            'student_type' => ['required', Rule::in(Enrollment::allowed('student_type'))],
            'age' => ['nullable', 'integer', 'min:4', 'max:100'],
            'program' => ['required', Rule::in(Enrollment::allowed('program'))],
            'preferred_language' => ['required', Rule::in(Enrollment::allowed('preferred_language'))],
            'availability' => ['nullable', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:1500'],
            'source_locale' => ['required', Rule::in(['ar', 'en'])],

            // Honeypot: a field real visitors never see and never fill in. It is
            // hidden from assistive technology too, so it costs nobody anything.
            'website' => ['nullable', 'prohibited'],
        ];
    }

    public function messages(): array
    {
        if ($this->locale() === 'ar') {
            return [
                'required' => 'يرجى إدخال :attribute.',
                'email' => 'يرجى إدخال بريد إلكتروني صحيح.',
                'in' => 'يرجى اختيار أحد الخيارات المتاحة في حقل :attribute.',
                'integer' => 'يرجى إدخال :attribute كرقم.',
                'age.min' => 'يجب ألا يقل العمر عن 4 سنوات.',
                'age.max' => 'يرجى إدخال عمر صحيح.',
                'max' => 'حقل :attribute أطول من اللازم.',
                'website.prohibited' => 'تعذّر إرسال طلبك، يرجى المحاولة مرة أخرى.',
            ];
        }

        return [
            'required' => 'Please fill in your :attribute.',
            'email' => 'Please enter a valid :attribute.',
            'in' => 'Please choose one of the available options for :attribute.',
            'integer' => 'Please enter your :attribute as a number.',
            'age.min' => 'The student should be at least 4 years old.',
            'age.max' => 'Please enter a valid age.',
            'max' => 'Your :attribute is a little too long.',
            'website.prohibited' => 'Your request could not be submitted. Please try again.',
        ];
    }

    public function attributes(): array
    {
        $labels = [
            'ar' => [
                'name' => 'الاسم الكامل',
                'email' => 'البريد الإلكتروني',
                'phone' => 'رقم الهاتف',
                'country' => 'الدولة',
                'student_type' => 'نوع الطالب',
                'age' => 'العمر',
                'program' => 'البرنامج',
                'preferred_language' => 'لغة الشرح',
                'availability' => 'الأوقات المناسبة',
                'message' => 'الملاحظات',
            ],
            'en' => [
                'name' => 'full name',
                'email' => 'email address',
                'phone' => 'phone number',
                'country' => 'country',
                'student_type' => 'student type',
                'age' => 'age',
                'program' => 'program',
                'preferred_language' => 'support language',
                'availability' => 'preferred times',
                'message' => 'notes',
            ],
        ];

        return $labels[$this->locale()];
    }
}
