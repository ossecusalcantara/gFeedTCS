<?php 

if(!function_exists('formatCnpjCpf')) {
    function formatCnpjCpf($value)
    {
      $CPF_LENGTH = 11;
      $cnpjCpf = preg_replace("/\D/", '', $value);
      
      if (strlen($cnpjCpf) === $CPF_LENGTH) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpjCpf);
      } 
      
      return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpjCpf);
    }
}

if(!function_exists('formatPhone')) {
    function formatPhone($value)
    {
        $phone = $value;
        return "(" . substr($phone, 0, 2) . ") " . substr($phone, 2, 4) . "-" . substr($phone, -4);
    }
}

if(!function_exists('formatData')) {
    function formatData($value)
    {
        $birth = explode('-', $value);
        
        if(count( (array) $birth) != 3)
            return "";

        $birth = $birth[2] . '/' . $birth[1] . '/' . $birth[0];
        return $birth;
    }
}

if(!function_exists('formatType')) {
    function formatType($value)
    {
        return $value == '1' ? 'Soft Skill' : 'Hard Skill';
    }
}

if(!function_exists('formatGender')) {
    function formatGender($value)
    {
        return $value == 'M' ? 'Masculino' : 'Feminino';
    }
}

if(!function_exists('removeCpfFormatting')) {
    function removeCpfFormatting($cpf) {
        return preg_replace('/[^0-9]/', '', $cpf);
    }
}