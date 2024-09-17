<?php

namespace MyApp\Core;

class Validation
{
    const DEFAULT_VALIDATION_ERRORS = [
        'required' => 'Data %s harus diisi',
        'email' => '%s email tidak valid',
        'min' => '%s harus lebih dari %d karakter',
        'max' => '%s harus kurang dari %d karakter',
        'between' => '%s harus di antara %d dan %d karakter',
        'same' => '%s dan %s tidak sama',
        'alphanumeric' => '%s harus diisi huruf dan angka',
        'secure' => '%s harus di antara 8 dan 64 karakter dan mengandung angka, huruf besar, huruf kecil, dan karakter khusus',
        'unique' => '%s sudah ada'
    ];

    public function validate(array $data, array $fields, array $messages = []): array
    {
        $split = fn($str, $separator) => array_map('trim', explode($separator, $str));
        $rule_messages = array_filter($messages, fn($message) => is_string($message));
        $validation_errors = array_merge(self::DEFAULT_VALIDATION_ERRORS, $rule_messages);
        $errors = [];

        foreach ($fields as $field => $option) {
            $rules = $split($option, '|');
            foreach ($rules as $rule) {
                $params = [];
                if (strpos($rule, ':')) {
                    [$rule_name, $param_str] = $split($rule, ':');
                    $params = $split($param_str, ',');
                } else {
                    $rule_name = trim($rule);
                }

                $fn = 'is_' . $rule_name;
                if (method_exists($this, $fn)) {
                    $pass = $this->$fn($data, $field, ...$params);
                    if (!$pass) {
                        array_push($errors, sprintf(
                            $messages[$field][$rule_name] ?? $validation_errors[$rule_name],
                            str_replace("_", "", $field),
                            ...$params
                        ));
                    }
                }
            }
        }
        return $errors;
    }

    public function is_required(array $data, string $field): bool
    {
        return isset($data[$field]) && trim($data[$field]) !== '';
    }

    public function is_email(array $data, string $field): bool
    {
        if (empty($data[$field])) {
            return true;
        }
        return filter_var($data[$field], FILTER_VALIDATE_EMAIL) !== false;
    }

    public function is_min(array $data, string $field, int $min): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        return mb_strlen($data[$field]) >= $min;
    }

    public function is_max(array $data, string $field, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
        return mb_strlen($data[$field]) <= $max;
    }

    public function is_between(array $data, string $field, int $min, int $max): bool
    {
        if (!isset($data[$field])) {
            return true;
        }
        $len = mb_strlen($data[$field]);
        return $len >= $min && $len <= $max;
    }

    public function is_same(array $data, string $field, string $other): bool
    {
        return isset($data[$field], $data[$other]) && $data[$field] === $data[$other];
    }

    public function is_alphanumeric(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        // Memperbolehkan huruf, angka, dan spasi
        return preg_match('/^[a-zA-Z0-9\s]+$/', $data[$field]) === 1;
    }

    public function is_secure(array $data, string $field): bool
    {
        if (!isset($data[$field])) {
            return true;
        }

        $pattern = "#^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";

        return preg_match($pattern, $data[$field]) === 1;
    }

    public function is_unique(array $data, string $field, string $table = '', string $column = ''): bool
    {
        // Implement the unique check here (e.g., query the database)
        // As an example, we'll return true as a placeholder
        return true;
    }
}
