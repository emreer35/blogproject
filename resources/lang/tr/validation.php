<?php
return [

    'accepted' => ':attribute kabul edilmelidir.',
    'active_url' => ':attribute geçerli bir URL olmalıdır.',
    'after' => ':attribute, :date\'den sonra bir tarih olmalıdır.',
    'after_or_equal' => ':attribute, :date\'den sonra veya ona eşit bir tarih olmalıdır.',
    'alpha' => ':attribute sadece harf içermelidir.',
    'alpha_dash' => ':attribute sadece harf, rakam ve tire içerebilir.',
    'alpha_num' => ':attribute sadece harf ve rakam içerebilir.',
    'array' => ':attribute bir dizi olmalıdır.',
    'before' => ':attribute, :date\'den önce bir tarih olmalıdır.',
    'before_or_equal' => ':attribute, :date\'den önce veya ona eşit bir tarih olmalıdır.',
    'between' => ':attribute, :min ile :max arasında olmalıdır.',
    'boolean' => ':attribute doğru veya yanlış olmalıdır.',
    'confirmed' => ':attribute onayı eşleşmiyor.',
    'date' => ':attribute geçerli bir tarih olmalıdır.',
    'date_equals' => ':attribute, :date\'ye eşit bir tarih olmalıdır.',
    'date_format' => ':attribute, :format formatına uymalıdır.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'digits' => ':attribute, :digits rakam olmalıdır.',
    'digits_between' => ':attribute, :min ile :max arasında rakam olmalıdır.',
    'dimensions' => ':attribute geçersiz görsel boyutlarına sahip.',
    'distinct' => ':attribute alanında tekrar eden değerler var.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanı zorunludur.',
    'gt' => ':attribute, :value\'dan büyük olmalıdır.',
    'gte' => ':attribute, :value\'ya eşit veya büyük olmalıdır.',
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçersiz.',
    'in_array' => ':attribute, :other içinde mevcut değil.',
    'integer' => ':attribute bir tamsayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json' => ':attribute geçerli bir JSON dizgesi olmalıdır.',
    'lt' => ':attribute, :value\'dan küçük olmalıdır.',
    'lte' => ':attribute, :value\'ya eşit veya küçük olmalıdır.',
    'max' => [
        'numeric' => ':attribute, :max\'dan büyük olamaz.',
        'file' => ':attribute dosyasının boyutu :max kilobayt\'tan fazla olamaz.',
        'string' => ':attribute :max karakterden uzun olamaz.',
        'array' => ':attribute, :max\'tan fazla öğe içermemelidir.',
    ],
    'mimes' => ':attribute şunlardan biri olmalıdır: :values.',
    'mimetypes' => ':attribute şunlardan biri olmalıdır: :values.',
    'min' => [
        'numeric' => ':attribute en az :min olmalıdır.',
        'file' => ':attribute dosyasının boyutu en az :min kilobayt olmalıdır.',
        'string' => ':attribute en az :min karakter uzunluğunda olmalıdır.',
        'array' => ':attribute, en az :min öğe içermelidir.',
    ],
    'not_in' => 'Seçilen :attribute geçersiz.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'password' => 'Şifre yanlış.',
    'present' => ':attribute alanı mevcut olmalıdır.',
    'regex' => ':attribute formatı geçersiz.',
    'required' => ':attribute alanı zorunludur.',
    'required_if' => ':attribute, :other :value olduğunda zorunludur.',
    'required_unless' => ':attribute, :other :value olmadığı sürece zorunludur.',
    'required_with' => ':attribute, :values mevcut olduğunda zorunludur.',
    'required_with_all' => ':attribute, :values mevcut olduğunda zorunludur.',
    'required_without' => ':attribute, :values mevcut olmadığında zorunludur.',
    'required_without_all' => ':attribute, :values hiçbiri mevcut olmadığında zorunludur.',
    'same' => ':attribute ve :other eşleşmelidir.',
    'size' => [
        'numeric' => ':attribute, :size olmalıdır.',
        'file' => ':attribute dosyasının boyutu :size kilobayt olmalıdır.',
        'string' => ':attribute :size karakter uzunluğunda olmalıdır.',
        'array' => ':attribute, :size öğe içermelidir.',
    ],
    'starts_with' => ':attribute şu değerlerden biri ile başlamalıdır: :values.',
    'string' => ':attribute bir yazı olmalıdır.',
    'timezone' => ':attribute geçerli bir zaman dilimi olmalıdır.',
    'unique' => ':attribute daha önce alınmış.',
    'uploaded' => ':attribute yüklenirken bir hata oluştu.',
    'url' => ':attribute geçerli bir URL olmalıdır.',
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',

    /*
|--------------------------------------------------------------------------
| Custom Validation Language Lines
|--------------------------------------------------------------------------
|
| Here you may specify custom validation messages for attributes using the
| convention "attribute.rule" to name the lines. You may use this to
| specify a custom language line for a specific attribute rule.
|
*/

    'custom' => [
        'email' => [
            'required' => 'E-posta adresi gereklidir.',
            'email' => 'Geçerli bir e-posta adresi girin.',
        ],
        'password' => [
            'required' => 'Şifre gereklidir.',
            'string' => 'Şifre metin olarak girilmelidir.',
        ],
    ],

    /*
|--------------------------------------------------------------------------
| Custom Validation Attributes
|--------------------------------------------------------------------------
|
| The following language lines are used to swap attribute placeholders
| with something more reader friendly such as E-Mail Address instead of
| "email". This simply helps us make our message more expressive.
|
*/

    'attributes' => [
        'email' => 'E-posta',
        'password' => 'Şifre',
    ],

];
