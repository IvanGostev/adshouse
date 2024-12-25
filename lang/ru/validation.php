<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute поле должно быть принято.',
    'accepted_if' => ':attribute поле должно быть принято, когда :other есть :value.',
    'active_url' => ':attribute поле должно содержать действительный URL-адрес.',
    'after' => ':attribute поле должно содержать дату после :date.',
    'after_or_equal' => ':attribute поле должно содержать дату, следующую за или равную :date.',
    'alpha' => ':attribute поле должно содержать только буквы.',
    'alpha_dash' => ':attribute поле должно содержать только буквы, цифры, тире и символы подчеркивания.',
    'alpha_num' => ':attribute поле должно содержать только буквы и цифры.',
    'array' => ':attribute поле должно быть массивом.',
    'ascii' => ':attribute поле должно содержать только однобайтовые буквенно-цифровые символы.',
    'before' => ':attribute в поле должна быть указана дата до :date.',
    'before_or_equal' => ':attribute поле должно содержать дату, предшествующую или равную :date.',
    'between' => [
        'array' => ':attribute поле должно иметь между :min и :max они.',
        'file' => ':attribute поле должно находиться между :min и :max килобайты.',
        'numeric' => ':attribute поле должно находиться между :min и :max.',
        'string' => ':attribute поле должно находиться между :min и :max персонажи.',
    ],
    'boolean' => ':attribute поле должно быть истинным или ложным.',
    'can' => ':attribute поле содержит несанкционированное значение.',
    'confirmed' => ':attribute поле подтверждения не совпадает.',
    'contains' => ':attribute в поле отсутствует требуемое значение.',
    'current_password' => 'введен неверный пароль.',
    'date' => ':attribute в поле должна быть указана действительная дата.',
    'date_equals' => ':attribute поле должно содержать дату, равную :date.',
    'date_format' => ':attribute поле должно соответствовать формату :format.',
    'decimal' => ':attribute поле должно содержать :decimal разряды после запятой.',
    'declined' => ':attribute поле должно быть отклонено.',
    'declined_if' => ':attribute поле должно быть отклонено, если :other это :value.',
    'different' => ':attribute поле и :other должно быть, все по-другому.',
    'digits' => ':attribute поле должно быть :digits цифры.',
    'digits_between' => ':attribute поле должно находиться между :min and :max цифры.',
    'dimensions' => ':attribute поле имеет недопустимые размеры изображения.',
    'distinct' => ':attribute поле имеет повторяющееся значение.',
    'doesnt_end_with' => ':attribute поле не должно заканчиваться одним из следующих символов: :values.',
    'doesnt_start_with' => ':attribute поле не должно начинаться с одного из следующих символов: :values.',
    'email' => ':attribute в поле должен быть указан действительный адрес электронной почты.',
    'ends_with' => ':attribute поле должно заканчиваться одним из следующих символов: :values.',
    'enum' => 'выбранный :attribute является недействительным.',
    'exists' => 'выбранный :attribute является недействительным.',
    'extensions' => ':attribute поле должно иметь одно из следующих расширений: :values.',
    'file' => ':attribute поле должно быть файлом.',
    'filled' => ':attribute поле должно иметь значение.',
    'gt' => [
        'array' => ':attribute поле должно содержать более :value вещи.',
        'file' => ':attribute поле должно быть больше, чем :value килобайты.',
        'numeric' => ':attribute поле должно быть больше, чем :value.',
        'string' => ':attribute поле должно быть больше, чем :value символы.',
    ],
    'gte' => [
        'array' => ':attribute field must have :value items or more.',
        'file' => ':attribute поле должно быть больше, чем или равно :value килобайты.',
        'numeric' => ':attribute поле должно быть больше, чем или равно :value.',
        'string' => ':attribute поле должно быть больше, чем или равно :value символы.',
    ],
    'hex_color' => ':attribute поле должно быть допустимого шестнадцатеричного цвета.',
    'image' => ':attribute поле должно быть изображением.',
    'in' => 'выбранный :attribute является недействительным.',
    'in_array' => ':attribute поле должно существовать в :other.',
    'integer' => ':attribute поле должно быть целым числом.',
    'ip' => ':attribute поле должно содержать действительный IP-адрес.',
    'ipv4' => ':attribute поле должно содержать действительный IPv4-адрес.',
    'ipv6' => ':attribute поле должно содержать действительный IPv6-адрес.',
    'json' => ':attribute поле должно быть допустимой строкой в формате JSON.',
    'list' => ':attribute поле должно быть списком.',
    'lowercase' => ':attribute поле должно быть написано строчными буквами.',
    'lt' => [
        'array' => ':attribute поле должно иметь размер менее :value предметы.',
        'file' => ':attribute поле должно быть меньше :value килобайты.',
        'numeric' => ':attribute поле должно быть меньше :value.',
        'string' => ':attribute поле должно быть меньше :value символы.',
    ],
    'lte' => [
        'array' => ':attribute поле должно содержать не более :value предметы.',
        'file' => ':attribute поле должно быть меньше или равно :value килобайты.',
        'numeric' => ':attribute поле должно быть меньше или равно :value.',
        'string' => ':attribute поле должно быть меньше или равно :value символы.',
    ],
    'mac_address' => ':attribute поле должно содержать действительный MAC-адрес.',
    'max' => [
        'array' => ':attribute поле должно содержать не более :max items.',
        'file' => ':attribute должно быть больше, чем :max килобайты.',
        'numeric' => ':attribute должно быть больше, чем :max.',
        'string' => ':attribute должно быть больше, чем :max символы.',
    ],
    'max_digits' => ':attribute field must not have more than :max digits.',
    'mimes' => ':attribute полем, должно быть a file of type: :values.',
    'mimetypes' => ':attribute полем, должно быть a file of type: :values.',
    'min' => [
        'array' => ':attribute field must have at least :min items.',
        'file' => ':attribute полем, должно быть at least :min килобайты.',
        'numeric' => ':attribute полем, должно быть at least :min.',
        'string' => ':attribute полем, должно быть at least :min символы.',
    ],
    'min_digits' => ':attribute field must have at least :min digits.',
    'missing' => ':attribute полем, должно быть missing.',
    'missing_if' => ':attribute полем, должно быть пропал без вести, когда :other is :value.',
    'missing_unless' => ':attribute полем, должно быть missing unless :other is :value.',
    'missing_with' => ':attribute полем, должно быть пропал без вести, когда :values is present.',
    'missing_with_all' => ':attribute полем, должно быть пропал без вести, когда :values are present.',
    'multiple_of' => ':attribute полем, должно быть a multiple of :value.',
    'not_in' => 'выбранный :attribute является недействительным.',
    'not_regex' => ':attribute формат поля является недействительным.',
    'numeric' => ':attribute полем, должно быть a number.',
    'password' => [
        'letters' => ':attribute поле должно содержать по крайней мере, один письмо.',
        'mixed' => ':attribute поле должно содержать по крайней мере, один верхний регистр и одна строчная буква.',
        'numbers' => ':attribute поле должно содержать по крайней мере, один номер.',
        'symbols' => ':attribute поле должно содержать по крайней мере, один символ.',
        'uncompromised' => 'дайте :attribute возникла в результате утечки данных. Пожалуйста, выберите другой :attribute.',
    ],
    'present' => ':attribute полем, должно быть present.',
    'present_if' => ':attribute полем, должно быть присутствовать, когда :other это :value.',
    'present_unless' => ':attribute полем, должно быть присутствует, если только :other это :value.',
    'present_with' => ':attribute полем, должно быть present when :values is present.',
    'present_with_all' => ':attribute полем, должно быть present when :values are present.',
    'prohibited' => ':attribute field is prohibited.',
    'prohibited_if' => ':attribute field is prohibited when :other is :value.',
    'prohibited_unless' => ':attribute field is prohibited unless :other is in :values.',
    'prohibits' => ':attribute field prohibits :other from being present.',
    'regex' => ':attribute формат поля является недействительным.',
    'required' => ':attribute field is required.',
    'required_array_keys' => ':attribute поле должно содержать entries for: :values.',
    'required_if' => ':attribute field is required when :other is :value.',
    'required_if_accepted' => ':attribute field is required when :other is accepted.',
    'required_if_declined' => ':attribute field is required when :other is declined.',
    'required_unless' => ':attribute field is required unless :other is in :values.',
    'required_with' => ':attribute field is required when :values is present.',
    'required_with_all' => ':attribute field is required when :values are present.',
    'required_without' => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same' => ':attribute field must match :other.',
    'size' => [
        'array' => ':attribute поле должно содержать :size items.',
        'file' => ':attribute полем, должно быть :size килобайты.',
        'numeric' => ':attribute полем, должно быть :size.',
        'string' => ':attribute полем, должно быть :size символы.',
    ],
    'starts_with' => ':attribute поле должно начинаться с одного из следующих символов: :values.',
    'string' => ':attribute поле должно быть строкой.',
    'timezone' => ':attribute в поле должен быть указан допустимый часовой пояс.',
    'unique' => ':attribute уже принят.',
    'uploaded' => ':attribute не удалось загрузить файл.',
    'uppercase' => ':attribute поле должно быть заглавным.',
    'url' => ':attribute поле должно содержать действительный URL-адрес.',
    'ulid' => ':attribute поле должно содержать действительный идентификатор ULID.',
    'uuid' => ':attribute поле должно иметь действительный UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
