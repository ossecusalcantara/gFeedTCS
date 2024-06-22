<?php 
use Carbon\Carbon;


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

        
        if(mb_strlen($value) != 10) {

            $data = Carbon::parse($value);

            return $data->format('d/m/Y');
        }

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

if(!function_exists('formattDateActivitie')) {
    function formattDateActivitie($data) {
        $dataInicio = Carbon::parse($data);
        $dataFim = Carbon::now();
        $diferencaHoras = $dataInicio->diffInHours($dataFim, true);

        if($diferencaHoras > 24) {
            return $dataInicio->format('d/m');
        }

        return $diferencaHoras;
    }
}