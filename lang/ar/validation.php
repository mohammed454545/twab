<?php

return [

    /*
    |--------------------------------------------------------------------------
    | رسائل التحقق من صحة البيانات
    |--------------------------------------------------------------------------
    |
    | تحتوي هذه القائمة على الرسائل الافتراضية المستخدمة بواسطة
    | نظام التحقق من صحة البيانات في Laravel.
    | يمكن تخصيص هذه الرسائل بحسب متطلبات التطبيق.
    |
    */

    'accepted' => 'يجب الموافقة على :attribute.',
    'accepted_if' => 'يجب الموافقة على :attribute عندما تكون قيمة :other هي :value.',
    'active_url' => 'يجب أن يكون :attribute رابط URL صالحًا.',
    'after' => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخًا يساوي :date أو يأتي بعده.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'any_of' => 'قيمة :attribute غير صالحة.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'array_keys' => 'يجب أن يحتوي :attribute على المفاتيح التالية فقط: :values.',
    'ascii' => 'يجب أن يحتوي :attribute على أحرف وأرقام ورموز أحادية البايت فقط.',
    'base64' => 'يجب أن يكون :attribute نصًا صالحًا بترميز Base64.',
    'before' => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخًا يساوي :date أو يسبقه.',

    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد عناصر يتراوح بين :min و:max.',
        'file' => 'يجب أن يكون حجم :attribute بين :min و:max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و:max.',
        'string' => 'يجب أن يكون طول :attribute بين :min و:max حرفًا.',
    ],

    'boolean' => 'يجب أن تكون قيمة :attribute صحيحة أو خاطئة.',
    'can' => 'يحتوي :attribute على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'contains' => 'يفتقد :attribute إلى قيمة مطلوبة.',
    'current_password' => 'كلمة المرور الحالية غير صحيحة.',
    'date' => 'يجب أن يكون :attribute تاريخًا صالحًا.',
    'date_equals' => 'يجب أن يكون :attribute تاريخًا يساوي :date.',
    'date_format' => 'يجب أن يتطابق :attribute مع تنسيق التاريخ :format.',
    'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما تكون قيمة :other هي :value.',
    'different' => 'يجب أن تختلف قيمة :attribute عن :other.',
    'digits' => 'يجب أن يتكون :attribute من :digits أرقام.',
    'digits_between' => 'يجب أن يتكون :attribute من عدد أرقام يتراوح بين :min و:max.',
    'dimensions' => 'أبعاد الصورة في :attribute غير صالحة.',
    'distinct' => 'يحتوي :attribute على قيمة مكررة.',
    'doesnt_contain' => 'يجب ألا يحتوي :attribute على أي من القيم التالية: :values.',
    'doesnt_end_with' => 'يجب ألا ينتهي :attribute بأي من القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ :attribute بأي من القيم التالية: :values.',
    'email' => 'يجب أن يكون :attribute بريدًا إلكترونيًا صالحًا.',
    'encoding' => 'يجب أن يستخدم :attribute الترميز :encoding.',
    'ends_with' => 'يجب أن ينتهي :attribute بإحدى القيم التالية: :values.',
    'enum' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'exists' => 'القيمة المحددة للحقل :attribute غير موجودة.',
    'extensions' => 'يجب أن يكون امتداد ملف :attribute أحد الامتدادات التالية: :values.',
    'file' => 'يجب أن يكون :attribute ملفًا.',
    'filled' => 'يجب ألا يكون :attribute فارغًا.',

    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عناصر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من :value حرفًا.',
    ],

    'gte' => [
        'array' => 'يجب أن يحتوي :attribute على :value عناصر على الأقل.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من أو يساوي :value حرفًا.',
    ],

    'hex_color' => 'يجب أن يكون :attribute لونًا صالحًا بالنظام الست عشري.',
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => 'القيمة المحددة للحقل :attribute غير صالحة.',
    'in_array' => 'يجب أن تكون قيمة :attribute موجودة ضمن :other.',
    'in_array_keys' => 'يجب أن يحتوي :attribute على مفتاح واحد على الأقل من المفاتيح التالية: :values.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صالحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صالحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صالحًا.',
    'json' => 'يجب أن يكون :attribute نص JSON صالحًا.',
    'list' => 'يجب أن يكون :attribute قائمة مرتبة الفهارس.',
    'lowercase' => 'يجب أن يحتوي :attribute على أحرف صغيرة فقط.',

    'lt' => [
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من :value حرفًا.',
    ],

    'lte' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عناصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من أو يساوي :value حرفًا.',
    ],

    'mac_address' => 'يجب أن يكون :attribute عنوان MAC صالحًا.',

    'max' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عناصر.',
        'file' => 'يجب ألا يتجاوز حجم :attribute مقدار :max كيلوبايت.',
        'numeric' => 'يجب ألا تتجاوز قيمة :attribute مقدار :max.',
        'string' => 'يجب ألا يتجاوز طول :attribute مقدار :max حرفًا.',
    ],

    'max_digits' => 'يجب ألا يتجاوز عدد أرقام :attribute مقدار :max.',
    'mimes' => 'يجب أن يكون :attribute ملفًا من أحد الأنواع التالية: :values.',
    'mimetypes' => 'يجب أن يكون نوع ملف :attribute أحد الأنواع التالية: :values.',

    'min' => [
        'array' => 'يجب أن يحتوي :attribute على :min عناصر على الأقل.',
        'file' => 'يجب ألا يقل حجم :attribute عن :min كيلوبايت.',
        'numeric' => 'يجب ألا تقل قيمة :attribute عن :min.',
        'string' => 'يجب ألا يقل طول :attribute عن :min حرفًا.',
    ],

    'min_digits' => 'يجب أن يحتوي :attribute على :min أرقام على الأقل.',
    'missing' => 'يجب عدم إرسال الحقل :attribute.',
    'missing_if' => 'يجب عدم إرسال الحقل :attribute عندما تكون قيمة :other هي :value.',
    'missing_unless' => 'يجب عدم إرسال الحقل :attribute إلا إذا كانت قيمة :other هي :value.',
    'missing_with' => 'يجب عدم إرسال الحقل :attribute عند وجود :values.',
    'missing_with_all' => 'يجب عدم إرسال الحقل :attribute عند وجود جميع الحقول التالية: :values.',
    'multiple_of' => 'يجب أن تكون قيمة :attribute من مضاعفات :value.',
    'not_in' => 'القيمة المحددة للحقل :attribute غير مسموح بها.',
    'not_regex' => 'تنسيق :attribute غير صالح.',
    'numeric' => 'يجب أن يكون :attribute رقمًا.',

    'password' => [
        'letters' => 'يجب أن يحتوي :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي :attribute على حرف كبير وحرف صغير على الأقل.',
        'numbers' => 'يجب أن يحتوي :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي :attribute على رمز خاص واحد على الأقل.',
        'uncompromised' => 'ظهرت قيمة :attribute في تسريب سابق للبيانات. يرجى اختيار قيمة أخرى.',
    ],

    'present' => 'يجب أن يكون الحقل :attribute موجودًا.',
    'present_if' => 'يجب أن يكون الحقل :attribute موجودًا عندما تكون قيمة :other هي :value.',
    'present_unless' => 'يجب أن يكون الحقل :attribute موجودًا إلا إذا كانت قيمة :other هي :value.',
    'present_with' => 'يجب أن يكون الحقل :attribute موجودًا عند وجود :values.',
    'present_with_all' => 'يجب أن يكون الحقل :attribute موجودًا عند وجود جميع الحقول التالية: :values.',
    'prohibited' => 'غير مسموح بإرسال قيمة للحقل :attribute.',
    'prohibited_if' => 'غير مسموح بإرسال قيمة للحقل :attribute عندما تكون قيمة :other هي :value.',
    'prohibited_if_accepted' => 'غير مسموح بإرسال قيمة للحقل :attribute عند الموافقة على :other.',
    'prohibited_if_declined' => 'غير مسموح بإرسال قيمة للحقل :attribute عند رفض :other.',
    'prohibited_unless' => 'غير مسموح بإرسال قيمة للحقل :attribute إلا إذا كانت قيمة :other ضمن :values.',
    'prohibits' => 'لا يُسمح بإرسال :other مع الحقل :attribute.',
    'regex' => 'تنسيق :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'يجب أن يحتوي :attribute على المفاتيح التالية: :values.',
    'required_if' => 'حقل :attribute مطلوب عندما تكون قيمة :other هي :value.',
    'required_if_accepted' => 'حقل :attribute مطلوب عند الموافقة على :other.',
    'required_if_declined' => 'حقل :attribute مطلوب عند رفض :other.',
    'required_unless' => 'حقل :attribute مطلوب إلا إذا كانت قيمة :other ضمن :values.',
    'required_with' => 'حقل :attribute مطلوب عند وجود :values.',
    'required_with_all' => 'حقل :attribute مطلوب عند وجود جميع الحقول التالية: :values.',
    'required_without' => 'حقل :attribute مطلوب عند عدم وجود :values.',
    'required_without_all' => 'حقل :attribute مطلوب عند عدم وجود أي من الحقول التالية: :values.',
    'same' => 'يجب أن تتطابق قيمة :attribute مع :other.',

    'size' => [
        'array' => 'يجب أن يحتوي :attribute على :size عناصر.',
        'file' => 'يجب أن يكون حجم :attribute مساويًا لـ :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'string' => 'يجب أن يكون طول :attribute مساويًا لـ :size حرفًا.',
    ],

    'starts_with' => 'يجب أن يبدأ :attribute بإحدى القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'timezone' => 'يجب أن يكون :attribute منطقة زمنية صالحة.',
    'unique' => 'قيمة :attribute مستخدمة بالفعل.',
    'uploaded' => 'فشل رفع الملف :attribute.',
    'uppercase' => 'يجب أن يحتوي :attribute على أحرف كبيرة فقط.',
    'url' => 'يجب أن يكون :attribute رابط URL صالحًا.',
    'ulid' => 'يجب أن يكون :attribute معرّف ULID صالحًا.',
    'uuid' => 'يجب أن يكون :attribute معرّف UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | رسائل التحقق المخصصة
    |--------------------------------------------------------------------------
    |
    | يمكن هنا تعريف رسائل مخصصة لحقول وقواعد تحقق محددة.
    | تُستخدم الصيغة attribute.rule لتحديد الرسالة المطلوبة.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'رسالة تحقق مخصصة.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | أسماء الحقول المخصصة
    |--------------------------------------------------------------------------
    |
    | تُستخدم هذه القائمة لاستبدال أسماء الحقول التقنية
    | بأسماء واضحة ومفهومة للمستخدم.
    |
    */

    'attributes' => [],

];